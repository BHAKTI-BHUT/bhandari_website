<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * User_auth Controller
 * Handles OTP-based login for the public booking form.
 *
 * ARCHITECTURE (works on localhost AND live server without IPBlocked):
 * ─────────────────────────────────────────────────────────────────────
 *  1. Browser JS → prepare_otp()   : validate input, store name/email/mobile in session
 *  2. Browser JS → MSG91 Widget JS : sendOtp called DIRECTLY from user's browser (no server IP!)
 *  3. Browser JS → verify_otp()    : sends reqId + OTP entered by user
 *  4. PHP → MSG91 Widget verifyOtp : server verifies token (verifyOtp is never IPBlocked)
 *  5. PHP → DB : create/find user, set CI session
 *
 * This approach works everywhere because the OTP SEND happens browser-side.
 */
class User_auth extends MX_Controller
{
    const MSG91_WIDGET_ID  = '36686266774e343530343138';
    const MSG91_TOKEN_AUTH = '556182T8qj8j5D9j6a6f0ae7P1';
    const MSG91_WIDGET_URL = 'https://control.msg91.com/api/v5/widget';

    function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
    }

    // ─── Check if user is already logged in ──────────────────────────────────
    public function check_login()
    {
        $user = $this->session->userdata('web_user');
        if ($user) {
            echo json_encode(['logged_in' => true, 'user' => $user]);
        } else {
            echo json_encode(['logged_in' => false]);
        }
    }

    // ─── Check if mobile is already registered (returning user) ──────────────
    public function check_mobile()
    {
        $mobile = $this->input->post('mobile', TRUE);
        $mobile = preg_replace('/\D/', '', $mobile);

        if (!$mobile || strlen($mobile) !== 10) {
            echo json_encode(['exists' => false]);
            return;
        }

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if (!$admin_db || !is_object($admin_db)) {
                echo json_encode(['exists' => false]);
                return;
            }
            $admin_db->initialize();
            $query = $admin_db->where('mobile', $mobile)->get('users');
            $user  = ($query && is_object($query)) ? $query->row() : NULL;

            if ($user) {
                echo json_encode(['exists' => true, 'name' => $user->name, 'mobile' => $mobile]);
            } else {
                echo json_encode(['exists' => false]);
            }
        } catch (\Throwable $e) {
            echo json_encode(['exists' => false]);
        }
    }

    // ─── STEP 1: Prepare OTP session (browser will send OTP via Widget JS) ───
    // Validates input, does DB checks, stores pending data in session.
    // Supports:
    //  - Direct Quick Login (Mobile number only -> existing user or auto-register)
    //  - Registration (Name + Mobile + Email)
    //  - Returning User (from localStorage)
    public function prepare_otp()
    {
        $name      = trim((string)$this->input->post('name',      TRUE));
        $email     = trim((string)$this->input->post('email',     TRUE));
        $mobile    = trim((string)$this->input->post('mobile',    TRUE));
        $returning = $this->input->post('returning', TRUE);
        $is_register = $this->input->post('is_register', TRUE);

        $cleanMobile = preg_replace('/\D/', '', $mobile);
        if (!$cleanMobile || strlen($cleanMobile) !== 10) {
            echo json_encode(['success' => false, 'message' => 'Please enter a valid 10-digit mobile number.']);
            return;
        }

        // DB validation & connection
        $admin_db = NULL;
        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if (!$admin_db || !is_object($admin_db)) {
                echo json_encode(['success' => false, 'message' => 'Database connection failed (admin_hub).']);
                return;
            }
            $admin_db->initialize();
        } catch (\Throwable $e) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
            return;
        }

        // Check if mobile is already registered in DB
        $existing_user = NULL;
        try {
            $existing_user = $admin_db->where('mobile', $cleanMobile)->get('users')->row();
        } catch (\Throwable $e) {
            log_message('error', 'User lookup error: ' . $e->getMessage());
        }

        if ($existing_user) {
            // Existing user found in DB
            $finalName = !empty($existing_user->name) ? $existing_user->name : (!empty($name) ? $name : 'Customer');
            $finalEmail = !empty($existing_user->email) ? $existing_user->email : $email;

            $this->session->set_userdata('otp_pending', [
                'name'         => $finalName,
                'email'        => $finalEmail,
                'mobile'       => $cleanMobile,
                'is_existing'  => true,
                'sent_at'      => time()
            ]);

            echo json_encode([
                'success'       => true,
                'is_existing'   => true,
                'name'          => $finalName,
                'mobile'        => $cleanMobile,
                'mobile91'      => '91' . $cleanMobile,
                'message'       => 'OTP ready.'
            ]);
            return;
        }

        // New user / not yet in DB
        // If coming from explicit registration tab, validate name
        if ($is_register) {
            if (empty($name) || strlen($name) < 2) {
                echo json_encode(['success' => false, 'message' => 'Please enter your full name.']);
                return;
            }
        }

        // Check email uniqueness if email provided
        if (!empty($email)) {
            try {
                $email_user = $admin_db->where('email', $email)
                                       ->where('mobile !=', $cleanMobile)
                                       ->get('users')->row();
                if ($email_user) {
                    echo json_encode(['success' => false, 'message' => 'This email is already registered with another mobile number.']);
                    return;
                }
            } catch (\Throwable $e) {}
        }

        // Resolve name for new user
        $finalName = !empty($name) ? $name : 'Customer';

        // Store pending data in session
        $this->session->set_userdata('otp_pending', [
            'name'        => $finalName,
            'email'       => $email,
            'mobile'      => $cleanMobile,
            'is_existing' => false,
            'sent_at'     => time()
        ]);

        echo json_encode([
            'success'     => true,
            'is_existing' => false,
            'name'        => $finalName,
            'mobile'      => $cleanMobile,
            'mobile91'    => '91' . $cleanMobile,
            'message'     => 'OTP ready.'
        ]);
    }

    // ─── Direct / Resend send_otp ──────────────────────────────────────────
    // Handles direct quote submissions from new devices AND modal resends.
    public function send_otp()
    {
        $name   = $this->input->post('name', TRUE);
        $email  = $this->input->post('email', TRUE);
        $mobile = $this->input->post('mobile', TRUE);
        $pending = $this->session->userdata('otp_pending');

        if (!$mobile && $pending && !empty($pending['mobile'])) {
            $mobile = $pending['mobile'];
            $name   = $name ?: ($pending['name'] ?? '');
            $email  = $email ?: ($pending['email'] ?? '');
        }

        $cleanMobile = preg_replace('/\D/', '', (string)$mobile);
        if (strlen($cleanMobile) < 10) {
            echo json_encode(['success' => false, 'message' => 'Please enter a valid 10-digit mobile number.']);
            return;
        }
        $cleanMobile = substr($cleanMobile, -10);

        // Load admin database
        $admin_db = NULL;
        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if ($admin_db && is_object($admin_db)) {
                $admin_db->initialize();
            }
        } catch (\Throwable $e) {}

        // Resolve user name if not supplied
        if (empty($name) || strlen(trim($name)) < 2) {
            if ($admin_db) {
                $existingUser = $admin_db->where('mobile', $cleanMobile)->get('users')->row();
                $name = $existingUser ? $existingUser->name : 'Member';
            } else {
                $name = 'Member';
            }
        }

        // Generate dynamic 6-digit OTP
        $otp = str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

        // Store in Session
        $this->session->set_userdata('otp_pending', [
            'name'    => $name,
            'email'   => $email,
            'mobile'  => $cleanMobile,
            'otp'     => $otp,
            'sent_at' => time()
        ]);

        // Store / Update in DB (otp_verifications) if available
        if ($admin_db) {
            try {
                $admin_db->where('mobile', $cleanMobile)
                         ->where('verified_at IS NULL', NULL, FALSE)
                         ->update('otp_verifications', ['expires_at' => date('Y-m-d H:i:s')]);

                $admin_db->insert('otp_verifications', [
                    'mobile'     => $cleanMobile,
                    'otp'        => $otp,
                    'expires_at' => date('Y-m-d H:i:s', time() + 600),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            } catch (\Throwable $e) {
                log_message('error', 'otp_verifications insert failed: ' . $e->getMessage());
            }
        }

        // Send SMS via MSG91 v5 OTP API
        $smsSent = $this->send_msg91_otp_sms($cleanMobile, $otp);

        echo json_encode([
            'success'  => true,
            'message'  => 'OTP sent successfully to your mobile.',
            'masked'   => '+91 ••••••' . substr($cleanMobile, -4),
            'mobile91' => '91' . $cleanMobile,
            'resend'   => true
        ]);
    }

    // ─── STEP 2: Verify OTP ──────────────────────────────────────────────────
    public function verify_otp()
    {
        $entered_otp      = trim((string)$this->input->post('otp', TRUE));
        $req_id           = trim((string)$this->input->post('req_id', TRUE));
        $browser_verified = trim((string)$this->input->post('browser_verified', TRUE));
        $mobile_param     = trim((string)$this->input->post('mobile', TRUE));
        $pending          = $this->session->userdata('otp_pending');

        $cleanMobile = $pending['mobile'] ?? (strlen(preg_replace('/\D/', '', $mobile_param)) >= 10 ? substr(preg_replace('/\D/', '', $mobile_param), -10) : NULL);

        if (!$pending && !$cleanMobile) {
            echo json_encode(['success' => false, 'message' => 'Session expired. Please request a new OTP.']);
            return;
        }

        if ($pending && (time() - $pending['sent_at']) > 900) {
            $this->session->unset_userdata('otp_pending');
            echo json_encode(['success' => false, 'message' => 'OTP expired. Please request a new one.']);
            return;
        }

        if (!preg_match('/^\d{4,8}$/', $entered_otp)) {
            echo json_encode(['success' => false, 'message' => 'Please enter the OTP sent to your mobile.']);
            return;
        }

        $isValid = false;

        // 1. Browser-side Widget already verified
        if ($browser_verified == '1') {
            $isValid = true;
        }

        // 2. Direct Session OTP match
        if (!$isValid && !empty($pending['otp']) && $entered_otp === (string)$pending['otp']) {
            $isValid = true;
        }

        // 3. MSG91 Widget verification if req_id is provided
        if (!$isValid && !empty($req_id)) {
            try {
                $verification = $this->msg91_widget_request('verifyOtp', [
                    'widgetId'  => self::MSG91_WIDGET_ID,
                    'tokenAuth' => self::MSG91_TOKEN_AUTH,
                    'reqId'     => $req_id,
                    'otp'       => $entered_otp,
                ]);

                if (isset($verification['type']) && strtolower($verification['type']) === 'success') {
                    $isValid = true;
                }
            } catch (\Throwable $e) {
                log_message('error', 'MSG91 verifyOtp error: ' . $e->getMessage());
            }
        }

        // 4. DB fallback check in otp_verifications
        $admin_db = NULL;
        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if ($admin_db && is_object($admin_db)) {
                $admin_db->initialize();
            }
        } catch (\Throwable $e) {}

        if (!$isValid && $admin_db && $cleanMobile) {
            try {
                $dbOtp = $admin_db->where('mobile', $cleanMobile)
                                 ->where('otp', $entered_otp)
                                 ->where('expires_at >', date('Y-m-d H:i:s'))
                                 ->order_by('id', 'DESC')
                                 ->get('otp_verifications')->row();
                if ($dbOtp) {
                    $isValid = true;
                    $admin_db->where('id', $dbOtp->id)->update('otp_verifications', ['verified_at' => date('Y-m-d H:i:s')]);
                }
            } catch (\Throwable $e) {}
        }

        if (!$isValid) {
            echo json_encode(['success' => false, 'message' => 'Invalid OTP. Please enter the correct code.']);
            return;
        }

        // OTP verified — find or create user in DB
        $userMobile = $cleanMobile;
        $userName   = !empty($pending['name']) ? $pending['name'] : 'Customer';
        $userEmail  = !empty($pending['email']) ? $pending['email'] : '';

        try {
            if (!$admin_db) {
                $admin_db = $this->load->database('admin_hub', TRUE);
                $admin_db->initialize();
            }

            $existing = $admin_db->where('mobile', $userMobile)->get('users')->row();

            if ($existing) {
                $user_id = $existing->id;

                // Update name if new specific name provided and old name was generic
                if (!empty($userName) && $userName !== 'Customer' && $userName !== 'Member' && (empty($existing->name) || in_array($existing->name, ['Customer', 'Member', 'Website Lead']))) {
                    $admin_db->where('id', $user_id)->update('users', ['name' => $userName, 'updated_at' => date('Y-m-d H:i:s')]);
                    $user_name = $userName;
                } else {
                    $user_name = !empty($existing->name) ? $existing->name : $userName;
                }

                // Ensure existing user has 'User' or 'Customer' role assigned
                try {
                    $has_user_role = $admin_db->query("
                        SELECT mhr.* FROM model_has_roles mhr 
                        JOIN roles r ON r.id = mhr.role_id 
                        WHERE mhr.model_id = ? AND mhr.model_type = 'App\\\\Models\\\\User' 
                        AND r.name IN ('User', 'Customer')
                    ", [$user_id])->row();

                    if (!$has_user_role) {
                        $user_role = $admin_db->where('name', 'Customer')->get('roles')->row();
                        if (!$user_role) {
                            $user_role = $admin_db->where('name', 'User')->get('roles')->row();
                        }
                        $role_id = $user_role ? $user_role->id : 11;
                        $admin_db->insert('model_has_roles', [
                            'role_id'    => $role_id,
                            'model_type' => 'App\\Models\\User',
                            'model_id'   => $user_id
                        ]);
                    }
                } catch (\Throwable $e) {
                    log_message('error', 'Role assignment check for existing user failed: ' . $e->getMessage());
                }
            } else {
                $email_val = ($userEmail && trim($userEmail))
                    ? trim($userEmail)
                    : $userMobile . '@bhandari.guest';

                $admin_db->insert('users', [
                    'name'            => $userName,
                    'email'           => $email_val,
                    'mobile'          => $userMobile,
                    'phone'           => $userMobile,
                    'password'        => password_hash('guest_' . $userMobile, PASSWORD_BCRYPT),
                    'status'          => 'active',
                    'registered_from' => 'web',
                    'created_at'      => date('Y-m-d H:i:s'),
                    'updated_at'      => date('Y-m-d H:i:s'),
                ]);
                $user_id   = $admin_db->insert_id();
                $user_name = $userName;

                // Assign default Customer / User role
                $user_role = $admin_db->where('name', 'Customer')->get('roles')->row();
                if (!$user_role) {
                    $user_role = $admin_db->where('name', 'User')->get('roles')->row();
                }
                $role_id = $user_role ? $user_role->id : 11;

                $admin_db->insert('model_has_roles', [
                    'role_id'    => $role_id,
                    'model_type' => 'App\\Models\\User',
                    'model_id'   => $user_id
                ]);
            }

            $this->session->set_userdata('web_user', [
                'id'     => $user_id,
                'name'   => $user_name,
                'mobile' => $userMobile,
            ]);
            $this->session->unset_userdata('otp_pending');

            echo json_encode([
                'success'   => true,
                'message'   => 'Login successful! Welcome, ' . $user_name . '.',
                'user_id'   => $user_id,
                'user_name' => $user_name,
                'mobile'    => $userMobile
            ]);

        } catch (\Throwable $e) {
            log_message('error', 'User_auth verify_otp DB error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
        }
    }

    // ─── Private Helper: Send MSG91 OTP SMS ──────────────────────────────────
    private function send_msg91_otp_sms($mobile10, $otp)
    {
        try {
            $authKey    = "556182T8qj8j5D9j6a6f0ae7P1";
            $templateId = "6a7a05b775108125180a1a63";
            $senderId   = "BMOVER";
            $dltId      = "1277178638247818736";
            $mobile91   = '91' . $mobile10;

            $apiUrl = "https://control.msg91.com/api/v5/otp"
                . "?template_id=" . urlencode($templateId)
                . "&mobile=" . urlencode($mobile91)
                . "&authkey=" . urlencode($authKey)
                . "&otp=" . urlencode($otp)
                . "&DLT_TE_ID=" . urlencode($dltId)
                . "&sender=" . urlencode($senderId);

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL            => $apiUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT        => 10,
                CURLOPT_CUSTOMREQUEST  => "POST",
                CURLOPT_POSTFIELDS     => json_encode(["var1" => (string)$otp]),
                CURLOPT_HTTPHEADER     => [
                    "authkey: " . $authKey,
                    "Content-Type: application/json"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            log_message('error', 'User OTP sent to ' . $mobile10 . ' | HTTP: ' . $httpCode . ' | Res: ' . $response);
            return empty($err);
        } catch (\Throwable $e) {
            log_message('error', 'send_msg91_otp_sms Exception: ' . $e->getMessage());
            return false;
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('web_user');
        echo json_encode(['success' => true]);
    }

    // ─── DB Diagnostics ──────────────────────────────────────────────────────
    public function test_db()
    {
        $status = [];
        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if ($admin_db && is_object($admin_db)) {
                $admin_db->initialize();
                $status['admin_hub'] = ['success' => true, 'connected' => $admin_db->conn_id ? 'Yes' : 'No'];
            } else {
                $status['admin_hub'] = ['success' => false, 'message' => 'Failed to load database object.'];
            }
        } catch (\Throwable $e) {
            $status['admin_hub'] = ['success' => false, 'message' => $e->getMessage()];
        }
        echo json_encode($status);
    }

    // ─── MSG91 Widget API Helper ──────────────────────────────────────────────
    private function msg91_widget_request($action, array $payload)
    {
        $curl = curl_init(self::MSG91_WIDGET_URL . '/' . $action);
        curl_setopt_array($curl, [
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Accept: application/json',
            ],
        ]);

        $response = curl_exec($curl);
        $error    = curl_error($curl);
        $status   = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($response === false) {
            throw new \RuntimeException($error ?: 'Unable to connect to MSG91.');
        }

        $data = json_decode($response, true);
        if (!is_array($data)) {
            throw new \RuntimeException('MSG91 returned invalid response (HTTP ' . $status . '): ' . $response);
        }

        return $data;
    }
}
