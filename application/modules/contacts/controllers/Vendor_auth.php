<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Vendor_auth Controller
 * Handles REST API for Vendor OTP-based login and registration in the mobile app.
 * - Static OTP: 123456 (for testing)
 * - Assigns role_id = 2 (Vendor)
 */
class Vendor_auth extends MX_Controller
{
    const STATIC_OTP = '123456';

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        header('Content-Type: application/json');
    }

    // ─── Send OTP ────────────────────────────────────────────────────────────
    public function send_otp()
    {
        $name   = $this->input->post('name', TRUE);
        $email  = $this->input->post('email', TRUE);
        $mobile = $this->input->post('mobile', TRUE);

        // Validate mobile
        if (!$mobile || strlen(preg_replace('/\D/', '', $mobile)) !== 10) {
            echo json_encode([
                'success' => false,
                'message' => 'Please enter a valid 10-digit mobile number.'
            ]);
            return;
        }

        $mobile = preg_replace('/\D/', '', $mobile);

        // Check if database connects
        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if (!$admin_db || !is_object($admin_db)) {
                echo json_encode(['success' => false, 'message' => 'Failed to connect to database (admin_hub).']);
                return;
            }
            $admin_db->initialize();
        } catch (\Throwable $e) {
            echo json_encode(['success' => false, 'message' => 'Database admin_hub connection failed.']);
            return;
        }

        // Check if user exists
        $existing = $admin_db->where('mobile', $mobile)->get('users')->row();
        if (!$existing) {
            echo json_encode([
                'success' => false,
                'is_registered' => false,
                'message' => 'Mobile number is not registered. Please register first.'
            ]);
            return;
        }

        // Generate real-time 6-digit dynamic OTP
        $otp = str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

        // Send OTP via MSG91 v5 OTP API
        try {
            $authKey    = "556182T8qj8j5D9j6a6f0ae7P1";
            $templateId = "6a7a05b775108125180a1a63";
            $senderId   = "BMOVER";
            $dltId      = "1277178638247818736";

            $rawMobile = preg_replace('/\D/', '', $mobile);
            $mobile10  = substr($rawMobile, -10);
            $mobile91  = '91' . $mobile10;

            $apiUrl = "https://control.msg91.com/api/v5/otp"
                . "?template_id=" . urlencode($templateId)
                . "&mobile=" . urlencode($mobile91)
                . "&authkey=" . urlencode($authKey)
                . "&otp=" . urlencode($otp)
                . "&DLT_TE_ID=" . urlencode($dltId)
                . "&sender=" . urlencode($senderId);

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $apiUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode([
                    "var1" => (string) $otp,
                ]),
                CURLOPT_HTTPHEADER => [
                    "authkey: " . $authKey,
                    "Content-Type: application/json"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);

            log_message('error', 'Vendor OTP request for ' . $mobile10 . ' | HTTP: ' . $httpCode . ' | Res: ' . $response . ' | Err: ' . $err);

            if ($err) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Could not reach MSG91: ' . $err
                ]);
                return;
            }

            $resObj = json_decode($response, true);
            $isSuccess = (is_array($resObj) && isset($resObj['type']) && strtolower($resObj['type']) === 'success');

            if (!$isSuccess) {
                $errMsg = ($resObj && isset($resObj['message'])) ? $resObj['message'] : ($response ?: 'MSG91 OTP API failed');
                echo json_encode([
                    'success' => false,
                    'message' => 'MSG91 Delivery Failed: ' . $errMsg
                ]);
                return;
            }
        } catch (\Throwable $e) {
            log_message('error', 'Vendor MSG91 Exception: ' . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Server error while contacting MSG91: ' . $e->getMessage()
            ]);
            return;
        }

        // Store details in session for stateful clients
        $this->session->set_userdata('vendor_otp_pending', [
            'name'    => $existing->name ?: 'Vendor Member',
            'email'   => $existing->email ?: $email,
            'mobile'  => $mobile,
            'otp'     => (string)$otp,
            'sent_at' => time()
        ]);

        $masked = str_repeat('*', 6) . substr($mobile, -4);

        echo json_encode([
            'success' => true,
            'message' => 'OTP sent successfully!',
            'masked'  => $masked
        ]);
    }

    // ─── Verify OTP & Login/Register ──────────────────────────────────────────
    public function verify_otp()
    {
        $mobile      = preg_replace('/\D/', '', $this->input->post('mobile', TRUE));
        $entered_otp = trim($this->input->post('otp', TRUE));
        $name        = $this->input->post('name', TRUE);
        $email       = $this->input->post('email', TRUE);

        $pending = $this->session->userdata('vendor_otp_pending');

        // Retrieve values either from session or fallback to POST inputs (stateless client support)
        if ($pending) {
            $mobile = $pending['mobile'];
            $name   = $pending['name'];
            $email  = $pending['email'];

            if ($entered_otp && (string)$entered_otp !== (string)$pending['otp'] && $entered_otp !== self::STATIC_OTP && $entered_otp !== '123456') {
                echo json_encode(['success' => false, 'message' => 'Invalid OTP. Please enter the code sent to your mobile.']);
                return;
            }
        }

        if (!$mobile || strlen($mobile) !== 10) {
            echo json_encode(['success' => false, 'message' => 'Invalid or missing mobile number.']);
            return;
        }

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if (!$admin_db || !is_object($admin_db)) {
                echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
                return;
            }
            $admin_db->initialize();

            // Check if user already exists
            $existing = $admin_db->where('mobile', $mobile)->get('users')->row();

            if ($existing) {
                $user_id   = $existing->id;
                $user_name = $existing->name;

                // Check if they already have the Vendor role (role_id = 2)
                $has_role = $admin_db->where('role_id', 2)
                                     ->where('model_id', $user_id)
                                     ->where('model_type', 'App\\Models\\User')
                                     ->get('model_has_roles')
                                     ->row();

                if (!$has_role) {
                    // Assign Vendor role (role_id = 2)
                    $admin_db->insert('model_has_roles', [
                        'role_id'    => 2,
                        'model_type' => 'App\\Models\\User',
                        'model_id'   => $user_id
                    ]);
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'is_registered' => false,
                    'message' => 'Mobile number is not registered. Please register first.'
                ]);
                return;
            }

            // Clear pending OTP
            $this->session->unset_userdata('vendor_otp_pending');

            // Return vendor details to the app
            echo json_encode([
                'success' => true,
                'message' => 'Logged in successfully!',
                'vendor'  => [
                    'id'     => $user_id,
                    'name'   => $user_name,
                    'mobile' => $mobile,
                    'role'   => 'vendor'
                ]
            ]);

        } catch (\Throwable $e) {
            echo json_encode(['success' => false, 'message' => 'Database operation failed: ' . $e->getMessage()]);
        }
    }
}
