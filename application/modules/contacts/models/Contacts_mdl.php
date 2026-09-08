<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Contacts_mdl extends CI_Model
{
    private $config;
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        
        // Hostinger SMTP Credentials
        $smtp_host = 'smtp.hostinger.com';
        $smtp_port = 587;
        $smtp_user = 'info@bhandaripackersandmovers.in';
        $smtp_pass = '4kguKm3ygsyuYlHapreJ(GmQu';
        $smtp_crypto = 'tls';

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('settings')) {
                $host_setting = $admin_db->where('key', 'mail_host')->get('settings')->row();
                $port_setting = $admin_db->where('key', 'mail_port')->get('settings')->row();
                $user_setting = $admin_db->where('key', 'mail_username')->get('settings')->row();
                $pass_setting = $admin_db->where('key', 'mail_password')->get('settings')->row();
                $crypto_setting = $admin_db->where('key', 'mail_encryption')->get('settings')->row();

                if ($host_setting && !empty($host_setting->value)) $smtp_host = $host_setting->value;
                if ($port_setting && !empty($port_setting->value)) $smtp_port = intval($port_setting->value);
                if ($user_setting && !empty($user_setting->value)) $smtp_user = $user_setting->value;
                if ($pass_setting && !empty($pass_setting->value)) $smtp_pass = $pass_setting->value;
                if ($crypto_setting && !empty($crypto_setting->value)) $smtp_crypto = $crypto_setting->value;
            }
        } catch (Exception $e) {}

        $this->config = array(
            'protocol' => 'smtp',
            'smtp_host' => $smtp_host,
            'smtp_port' => $smtp_port,
            'smtp_user' => $smtp_user,
            'smtp_pass' => $smtp_pass,
            'smtp_crypto' => ($smtp_crypto === 'none') ? '' : $smtp_crypto,
            'smtp_timeout' => 10,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'crlf' => "\r\n"
        );
    }

    private function get_email_settings()
    {
        $settings = array(
            'to_email' => 'info@bhandaripackersandmovers.in',
            'from_email' => $this->config['smtp_user'] ?: 'info@bhandaripackersandmovers.in',
            'from_name' => 'Packers and Movers'
        );

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if ($admin_db && $admin_db->table_exists('settings')) {
                $to_setting = $admin_db->where('key', 'admin_notification_email')->get('settings')->row();
                if ($to_setting && !empty($to_setting->value)) {
                    $settings['to_email'] = $to_setting->value;
                }
                $from_name_setting = $admin_db->where('key', 'mail_from_name')->get('settings')->row();
                if ($from_name_setting && !empty($from_name_setting->value)) {
                    $settings['from_name'] = $from_name_setting->value;
                }
                $from_email_setting = $admin_db->where('key', 'mail_from_address')->get('settings')->row();
                if ($from_email_setting && !empty($from_email_setting->value)) {
                    $settings['from_email'] = $from_email_setting->value;
                }
            }
        } catch (Exception $e) {}

        return $settings;
    }

    public function send_mail($message)
    {
        $this->load->library('email', $this->config);
        $this->email->set_newline("\r\n");

        $mail_settings = $this->get_email_settings();

        $this->email->to($mail_settings['to_email']);
        $this->email->from($mail_settings['from_email'], $mail_settings['from_name']);
        $this->email->subject('New Booking Received - ' . $mail_settings['from_name']);
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        } else {
            return 'Error: send_mail() - Email failed: ' . $this->email->print_debugger();
        }
    }

    public function insert()
    {
        $this->load->library('email', $this->config);
        $this->email->set_newline("\r\n");
        $this->email->set_crlf("\r\n");

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $msg = $this->input->post('message');
        $phn = $this->input->post('phone');
        $mfrom = $this->input->post('mfrom');
        $category = $this->input->post('category');

        $this->db->insert('contacts', array("name" => $name, "email" => $mfrom, "mfrom" => $email, "phone" => $phn, "message" => $msg, "category" => $category));
        $message = "<div style='padding:30px;background: #e6e6e6;font-size: 18px !important;'>Client's Query: <h3>$category</h3><b><q>$msg</q></b><br><br>Client's Name:  <b>$name</b><br><br>Phone Number:  <b>$phn</b><b>$mfrom</b><br><br> Email: <b> $email</b></div>";

        $mail_settings = $this->get_email_settings();

        $this->email->to($mail_settings['to_email']);
        $this->email->from($mail_settings['from_email'], $mail_settings['from_name']);
        if (@$email)
            $this->email->reply_to(@$email);
        $this->email->subject('New Contact Message Received - ' . $mail_settings['from_name']);
        $this->email->message($message);
        $this->email->send();

        return true;
    }


    public function bookings()
    {
        $this->load->library('email', $this->config);
        $this->email->set_newline("\r\n");
        $this->email->set_crlf("\r\n");

        $name        = $this->input->post('name');
        $phone       = $this->input->post('phone');
        $mfrom       = $this->input->post('mfrom');
        $mto         = $this->input->post('mto');
        $date        = $this->input->post('date');
        $shifting_time = $this->input->post('shifting_time');
        $is_verified = $this->input->post('is_verified');

        // ─── 1. Purana table (service_hub_web.bookings) ───── Optional
        try {
            // Ensure phone column is VARCHAR(20) to prevent integer overflow
            try {
                $this->db->query("ALTER TABLE `bookings` MODIFY COLUMN `phone` VARCHAR(20) DEFAULT NULL");
            } catch (\Throwable $e) {
                // Ignore
            }

            $this->db->insert('bookings', array(
                "name"   => $name ? $name : '',
                "phone"  => $phone,
                "mfrom"  => $mfrom,
                "mto"    => $mto,
            ));
        } catch (\Throwable $e) {
            // Local bookings table is optional now
        }

        // ─── 2. Admin Panel table (service_hub.booking_requests) ───────────────────
        try {
            $web_user = $this->session->userdata('web_user');
            if ($web_user && isset($web_user['id'])) {
                $customer_id = $web_user['id'];
            } else {
                $admin_db = $this->load->database('admin_hub', TRUE);
                $user = $admin_db->where('mobile', $phone)->get('users')->row();
                if ($user) {
                    $customer_id = $user->id;
                } else {
                    $admin_db->insert('users', [
                        'name'            => $name ? $name : 'Website Lead',
                        'email'           => $phone . '@bhandari.guest',
                        'mobile'          => $phone,
                        'phone'           => $phone,
                        'password'        => password_hash('guest_' . $phone, PASSWORD_BCRYPT),
                        'status'          => 'active',
                        'registered_from' => 'website_lead',
                        'created_at'      => date('Y-m-d H:i:s'),
                        'updated_at'      => date('Y-m-d H:i:s'),
                    ]);
                    $customer_id = $admin_db->insert_id();
                    if ($customer_id) {
                        $user_role = $admin_db->where('name', 'User')->get('roles')->row();
                        if (!$user_role) {
                            $user_role = $admin_db->where('name', 'Customer')->get('roles')->row();
                        }
                        $role_id = $user_role ? $user_role->id : 12;

                        $admin_db->insert('model_has_roles', [
                            'role_id'    => $role_id,
                            'model_type' => 'App\\Models\\User',
                            'model_id'   => $customer_id
                        ]);
                    } else {
                        $customer_id = 49;
                    }
                }
            }

            $admin_db = $this->load->database('admin_hub', TRUE);
            $admin_db->insert('booking_requests', array(
                'customer_id'      => $customer_id,
                'phone_number'     => $phone,
                'pickup_location'  => $mfrom ? $mfrom : 'Not specified',
                'drop_location'    => $mto   ? $mto   : 'Not specified',
                'shifting_date'    => $date  ? $date  : date('Y-m-d'),
                'shifting_time'    => $shifting_time ? date('H:i:s', strtotime($shifting_time)) : null,
                'estimated_amount' => 0.00,
                'status'           => 'pending', // pending lead inquiry
                'source'           => ($is_verified == '1' ? 'website (verified)' : 'website (unverified)'),
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ));
        } catch (Exception $e) {
            log_message('error', 'Admin DB booking request insert failed: ' . $e->getMessage());
        }

        // ─── 3. Email notification to admin ──────────────────────────────────
        $verified_badge = ($is_verified == '1') ? "<span style='color:green;font-weight:bold;'>(Verified Mobile)</span>" : "<span style='color:orange;font-weight:bold;'>(Unverified / Skipped OTP)</span>";
        $adminMessage = "<div style='padding:30px;background:#e6e6e6;font-size: 18px !important;'>"
            . "Client's Name: <b>" . ($name ? htmlspecialchars($name) : 'Not specified') . "</b><br><br>"
            . "Phone Number: <b><a href='tel:$phone'>$phone</a></b> $verified_badge<br><br>"
            . "From: <b>" . htmlspecialchars($mfrom) . "</b><br><br>"
            . "To: <b>" . htmlspecialchars($mto) . "</b><br><br>"
            . "Moving Date: <b>" . htmlspecialchars($date) . "</b><br><br>"
            . "Moving Time: <b>" . htmlspecialchars($shifting_time) . "</b></div>";

        // $this->send_mail($adminMessage); // Commented out mail sending on booking creation
        return true;
    }

    public function newsletter()
    {
        $email = $this->input->post('email');
        $this->db->insert('newsletter', array("email" => $email));
        return true;
    }
    public function faq()
    {
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $question = $this->input->post('question');
        $this->db->insert('faq', array("phone" => $phone, "name" => $name, "question" => $question));
        return true;
    }
    public function contact()
    {
        $this->load->library('email', $this->config);
        $this->email->set_newline("\r\n");
        $this->email->set_crlf("\r\n");
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $qry = $this->input->post('message');

        try {
            $this->db->insert('contacts', array("name" => $name, "phone" => $phone, "message" => $qry, "email" => $email));
        } catch (\Exception $e) {}

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if ($admin_db && $admin_db->table_exists('contact_messages')) {
                $admin_db->insert('contact_messages', [
                    'name'       => $name,
                    'email'      => $email,
                    'phone'      => $phone,
                    'message'    => $qry,
                    'status'     => 'new',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        } catch (\Exception $e) {
            log_message('error', 'Contact message admin_db insert error: ' . $e->getMessage());
        }

        if (!empty($this->config['smtp_pass'])) {
            try {
                $message = "<div style='padding:30px;background:#e6e6e6;font-size: 18px !important;'>Client's Query: <b><q>$qry</q></b><br><br>Client's Name:  <b>$name</b><br><br>Phone Number: <b><a href='tel:$phone'>$phone</a></b><br><br>Email: <b> $email</b></div>";
                $mail_settings = $this->get_email_settings();
                
                $this->load->library('email', $this->config);
                $this->email->set_newline("\r\n");
                $this->email->set_crlf("\r\n");
                $this->email->to($mail_settings['to_email']);
                $this->email->from($mail_settings['from_email'], $mail_settings['from_name']);
                if (@$email)
                    $this->email->reply_to(@$email);
                $this->email->subject('New Contacts Enquiry Received - ' . $mail_settings['from_name']);
                $this->email->message($message);
                @$this->email->send();
            } catch (\Exception $e) {
                log_message('error', 'Contact email send error: ' . $e->getMessage());
            }
        }
        return true;
    }

    public function send_whatsapp($to, $message)
    {
        $to = preg_replace('/\D/', '', $to);
        if ($this->is_blocked_whatsapp_recipient($to)) {
            log_message('error', 'Blocked WhatsApp send to configured owner/admin number.');
            return false;
        }
        if (strlen($to) === 10) {
            $to = '91' . $to;
        }

        $phone_number_id = '377580928772785';
        $access_token = 'EAAZABJeMywrsBSIlJT4LjJDHeUhodHmGsWUAQmdGDk8eIfQaAQFjRPfD852ox6L0MLo2JSZBCgQ4NvyiJGedmhgIcPr7S2TPJ7NSVQlCZCqVYbrzFnULZCEWZA59dLrlLGFvZBh4fFygtuTUDjEN6MUaNfLhlUgXeLVPjIlJZAkwwp2PTPJ6isyI66zIqBZBlQZDZD';

        $url = "https://graph.facebook.com/v21.0/{$phone_number_id}/messages";

        $data = array(
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $to,
            'type' => 'text',
            'text' => array(
                'body' => $message
            )
        );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $access_token,
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    /**
     * Template messages may be sent outside WhatsApp's 24-hour customer
     * service window. Use this for booking confirmations instead of free text.
     */
    public function send_booking_confirmation_template($to, $customer_name, $booking_number, $shifting_date, $shifting_time, $pickup, $drop, $total_amount, $advance_amount, $invoice_url)
    {
        $to = preg_replace('/\D/', '', (string) $to);
        if ($this->is_blocked_whatsapp_recipient($to)) {
            log_message('error', 'Blocked booking confirmation to configured owner/admin number.');
            return false;
        }
        if (strlen($to) === 10) {
            $to = '91' . $to;
        }

        $phone_number_id = '377580928772785';
        $access_token = 'EAAZABJeMywrsBSIlJT4LjJDHeUhodHmGsWUAQmdGDk8eIfQaAQFjRPfD852ox6L0MLo2JSZBCgQ4NvyiJGedmhgIcPr7S2TPJ7NSVQlCZCqVYbrzFnULZCEWZA59dLrlLGFvZBh4fFygtuTUDjEN6MUaNfLhlUgXeLVPjIlJZAkwwp2PTPJ6isyI66zIqBZBlQZDZD';

        $payload = array(
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $to,
            'type' => 'template',
            'template' => array(
                'name' => 'booking_confirmation_full',
                'language' => array('code' => 'en'),
                'components' => array(array(
                    'type' => 'body',
                    'parameters' => array(
                        array('type' => 'text', 'text' => (string) $customer_name),
                        array('type' => 'text', 'text' => (string) $booking_number),
                        array('type' => 'text', 'text' => (string) $shifting_date),
                        array('type' => 'text', 'text' => (string) $shifting_time),
                        array('type' => 'text', 'text' => (string) $pickup),
                        array('type' => 'text', 'text' => (string) $drop),
                        array('type' => 'text', 'text' => (string) $total_amount),
                        array('type' => 'text', 'text' => (string) $advance_amount),
                        array('type' => 'text', 'text' => (string) $invoice_url),
                    ),
                )),
            ),
        );

        $ch = curl_init("https://graph.facebook.com/v21.0/{$phone_number_id}/messages");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $access_token,
            'Content-Type: application/json'
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        $decoded = json_decode((string) $response, true);
        $sent = empty($curl_error) && $http_code >= 200 && $http_code < 300 && !empty($decoded['messages'][0]['id']);

        if (!$sent) {
            log_message('error', 'WhatsApp booking confirmation failed for ' . $to . ': HTTP ' . $http_code . ' ' . ($curl_error ?: (string) $response));
        }

        return $sent;
    }

    private function is_blocked_whatsapp_recipient($number)
    {
        $number = preg_replace('/\D/', '', (string) $number);
        if (strlen($number) === 12 && substr($number, 0, 2) === '91') $number = substr($number, 2);
        $configured = getenv('WHATSAPP_BLOCKED_RECIPIENTS');
        $blocked = ($configured !== false && trim($configured) !== '') ? explode(',', $configured) : ['9716349811', '7303257332', '9999119611'];
        foreach ($blocked as $candidate) {
            $candidate = preg_replace('/\D/', '', trim($candidate));
            if (strlen($candidate) === 12 && substr($candidate, 0, 2) === '91') $candidate = substr($candidate, 2);
            if ($candidate !== '' && hash_equals($candidate, $number)) return true;
        }
        return false;
    }

    /**
     * Auto-assign all active vendors and send push notifications + in-app notification records.
     */
    public function notify_vendors_for_booking($booking_id, $booking_number, $admin_db = null)
    {
        try {
            if (!$admin_db) {
                $admin_db = $this->load->database('admin_hub', TRUE);
            }

            // 1. Fetch active vendors
            $vendors_q = $admin_db->query("SELECT u.id, u.name, u.fcm_token FROM users u JOIN model_has_roles mhr ON u.id = mhr.model_id JOIN roles r ON mhr.role_id = r.id WHERE r.name = 'Vendor' AND u.status = 'active'");
            $vendors_list = $vendors_q ? $vendors_q->result() : [];
            if (empty($vendors_list)) {
                return false;
            }

            // 2. Fetch template
            $tpl = $admin_db->where('key', 'admin_assigned_vendor')->get('notification_templates')->row();
            $title = $tpl ? $tpl->title : 'New Shifting Job Request';
            $body  = $tpl ? $tpl->body : 'You have received a new shifting booking request {booking_number} from Admin. Please accept or reject it.';
            $title = str_replace('{booking_number}', $booking_number, $title);
            $body  = str_replace('{booking_number}', $booking_number, $body);

            foreach ($vendors_list as $v_item) {
                // Ensure booking_vendor_requests row exists
                $chk = $admin_db->where('booking_id', $booking_id)->where('vendor_id', $v_item->id)->get('booking_vendor_requests')->row();
                if (!$chk) {
                    $admin_db->insert('booking_vendor_requests', array(
                        'booking_id' => $booking_id,
                        'vendor_id'  => $v_item->id,
                        'status'     => 'pending',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ));
                }

                // Insert into user_notifications table for vendor in-app inbox
                $admin_db->insert('user_notifications', array(
                    'user_id'    => $v_item->id,
                    'title'      => $title,
                    'body'       => $body,
                    'type'       => 'admin_assigned_vendor',
                    'data'       => json_encode(array('booking_id' => strval($booking_id), 'type' => 'new_request')),
                    'is_read'    => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ));
            }

            // 3. Trigger Firebase Push via local/production admin API
            $laravel_url = "https://bhandaripackersandmovers.in/admin";
            if (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
                $laravel_url = "http://127.0.0.1:8000";
            }
            $api_url = $laravel_url . "/api/internal/notify-vendor-requests/" . $booking_id;

            $ch = curl_init($api_url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['booking_id' => $booking_id]));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 3);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            @curl_exec($ch);
            @curl_close($ch);

            return true;
        } catch (\Throwable $e) {
            log_message('error', 'notify_vendors_for_booking error: ' . $e->getMessage());
            return false;
        }
    }
}
