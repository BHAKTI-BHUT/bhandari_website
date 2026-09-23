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

                if ($host_setting && !empty($host_setting->value)) $smtp_host = trim($host_setting->value);
                if ($port_setting && !empty($port_setting->value)) $smtp_port = intval($port_setting->value);
                if ($user_setting && !empty($user_setting->value)) $smtp_user = trim($user_setting->value);
                if ($pass_setting && !empty($pass_setting->value)) $smtp_pass = str_replace(' ', '', $pass_setting->value);
                if ($crypto_setting && !empty($crypto_setting->value)) $smtp_crypto = trim($crypto_setting->value);
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
        // Default: send notification to the SMTP sender's inbox itself
        $smtp_user = !empty($this->config['smtp_user']) ? $this->config['smtp_user'] : 'info@bhandaripackersandmovers.in';
        $settings = array(
            'to_email'   => $smtp_user,
            'from_email' => $smtp_user,
            'from_name'  => 'Bhandari Packers and Movers'
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
        } catch (Exception $e) {
            log_message('error', 'get_email_settings error: ' . $e->getMessage());
        }

        // For Gmail SMTP, if from_email doesn't match smtp_user domain/email, use smtp_user to avoid 550 Unauthenticated error
        if (strpos($this->config['smtp_host'], 'gmail') !== false && !empty($this->config['smtp_user'])) {
            $settings['from_email'] = $this->config['smtp_user'];
        }

        return $settings;
    }

    public function get_location_service_settings()
    {
        $settings = array(
            'allowed_pickup_cities' => 'Delhi, Noida, Greater Noida, Gurugram, Gurgaon, Ghaziabad, Faridabad, Sonipat, Sonepat, Jhajjar, Rohtak, Bahadurgarh, Manesar, Ballabhgarh, Meerut, Gautam Buddha Nagar, New Delhi',
            'max_relocation_distance_km' => 300
        );

        try {
            $admin_db = $this->load->database('admin_hub', TRUE);
            if ($admin_db && $admin_db->conn_id) {
                // Check settings table
                if ($admin_db->table_exists('settings')) {
                    $row_cities = $admin_db->where('key', 'allowed_pickup_cities')->get('settings')->row();
                    if ($row_cities && !empty($row_cities->value)) {
                        $settings['allowed_pickup_cities'] = $row_cities->value;
                    }
                    $row_dist = $admin_db->where('key', 'max_relocation_distance_km')->get('settings')->row();
                    if ($row_dist && !empty($row_dist->value)) {
                        $settings['max_relocation_distance_km'] = floatval($row_dist->value);
                    }
                }
                // Check pricing_settings table
                if ($admin_db->table_exists('pricing_settings')) {
                    $row_cities2 = $admin_db->where('key', 'allowed_pickup_cities')->get('pricing_settings')->row();
                    if ($row_cities2 && !empty($row_cities2->value)) {
                        $settings['allowed_pickup_cities'] = $row_cities2->value;
                    }
                    $row_dist2 = $admin_db->where('key', 'max_relocation_distance_km')->get('pricing_settings')->row();
                    if ($row_dist2 && !empty($row_dist2->value)) {
                        $settings['max_relocation_distance_km'] = floatval($row_dist2->value);
                    }
                }
            }
        } catch (\Exception $e) {
        } catch (\Throwable $e) {
        }

        return $settings;
    }

    public function send_mail($message, $subject = null)
    {
        $this->load->library('email');
        $this->email->initialize($this->config);
        $this->email->clear(TRUE);
        $this->email->set_newline("\r\n");
        $this->email->set_crlf("\r\n");

        $mail_settings = $this->get_email_settings();

        $this->email->to($mail_settings['to_email']);
        if (!empty($this->config['smtp_user']) && $this->config['smtp_user'] !== $mail_settings['to_email']) {
            $this->email->bcc($this->config['smtp_user']); // Force BCC to the SMTP user
        }
        $this->email->from($mail_settings['from_email'], $mail_settings['from_name']);
        $final_subject = !empty($subject) ? $subject : ('New Booking Received - ' . $mail_settings['from_name']);
        $this->email->subject($final_subject);
        $this->email->message($message);
        if ($this->email->send()) {
            log_message('error', 'send_mail() - Email sent successfully to: ' . $mail_settings['to_email']);
            return true;
        } else {
            $err = 'Error: send_mail() - Email failed: ' . $this->email->print_debugger();
            log_message('error', $err);
            return $err;
        }
    }
    
    public function insert()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $msg = $this->input->post('message');
        $phn = $this->input->post('phone');
        $mfrom = $this->input->post('mfrom');
        $category = $this->input->post('category');

        $this->db->insert('contacts', array("name" => $name, "email" => $mfrom, "mfrom" => $email, "phone" => $phn, "message" => $msg, "category" => $category));
        $message = "<div style='padding:30px;background: #e6e6e6;font-size: 18px !important;'>Client's Query: <h3>$category</h3><b><q>$msg</q></b><br><br>Client's Name:  <b>$name</b><br><br>Phone Number:  <b>$phn</b><b>$mfrom</b><br><br> Email: <b> $email</b></div>";

        $this->send_mail($message, 'New Contact Message Received');

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
                        $user_role = $admin_db->where('name', 'Customer')->get('roles')->row();
                        if (!$user_role) {
                            $user_role = $admin_db->where('name', 'User')->get('roles')->row();
                        }
                        $role_id = $user_role ? $user_role->id : 11;

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

        // ─── 3. Professional Responsive Email Notification to Admin ──────────
        try {
            $submission_time = date('D, d M Y \a\t h:i A');
            $safe_name  = $name ? htmlspecialchars($name, ENT_QUOTES, 'UTF-8') : 'Not specified';
            $safe_phone = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
            $safe_mfrom = !empty($mfrom) ? htmlspecialchars($mfrom, ENT_QUOTES, 'UTF-8') : 'Not specified';
            $safe_mto   = !empty($mto)   ? htmlspecialchars($mto,   ENT_QUOTES, 'UTF-8') : 'Not specified';
            $safe_date  = !empty($date)  ? htmlspecialchars(date('d M Y', strtotime($date)), ENT_QUOTES, 'UTF-8') : 'Not specified';
            $safe_time  = !empty($shifting_time) ? htmlspecialchars($shifting_time, ENT_QUOTES, 'UTF-8') : 'Not specified';

            $verified_badge_html = ($is_verified == '1')
                ? "<span style='display:inline-block;background:#e6f4ea;color:#137333;font-size:12px;font-weight:700;padding:4px 12px;border-radius:12px;'>&#10004; Verified Mobile</span>"
                : "<span style='display:inline-block;background:#feefc3;color:#b06000;font-size:12px;font-weight:700;padding:4px 12px;border-radius:12px;'>&#9888; Lead Enquiry</span>";

            $adminMessage = "
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>New Shifting Quote Request</title>
</head>
<body style='margin:0;padding:0;background-color:#f4f6f9;font-family:Segoe UI,Arial,sans-serif;'>
  <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:#f4f6f9;'>
    <tr>
      <td align='center' style='padding:30px 15px;'>
        <table width='600' cellpadding='0' cellspacing='0' border='0' style='max-width:600px;width:100%;background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.08);'>

          <!-- Header -->
          <tr>
            <td style='background:linear-gradient(135deg,#FC5D09,#DD3802);padding:30px 35px;text-align:center;'>
              <h1 style='margin:0;color:#ffffff;font-size:22px;font-weight:700;letter-spacing:0.5px;'>
                &#128230; New Shifting Quote Request
              </h1>
              <p style='margin:8px 0 0;color:rgba(255,255,255,0.85);font-size:14px;'>
                Bhandari Packers and Movers &mdash; Lead Enquiry Received
              </p>
            </td>
          </tr>

          <!-- Alert bar -->
          <tr>
            <td style='background:#fff8f5;border-left:4px solid #FC5D09;padding:12px 35px;'>
              <table width='100%' cellpadding='0' cellspacing='0' border='0'>
                <tr>
                  <td>
                    <p style='margin:0;font-size:13px;color:#555;'>
                      &#128197; Received on: <strong style='color:#FC5D09;'>{$submission_time}</strong>
                    </p>
                  </td>
                  <td align='right'>
                    {$verified_badge_html}
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style='padding:30px 35px;'>

              <!-- Customer Details -->
              <h2 style='margin:0 0 15px;font-size:15px;color:#0b2356;text-transform:uppercase;letter-spacing:1px;border-bottom:2px solid #f0f0f0;padding-bottom:8px;'>
                Customer Details
              </h2>

              <!-- Name -->
              <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-bottom:12px;'>
                <tr>
                  <td width='40' style='vertical-align:top;padding-top:2px;'>
                    <div style='width:36px;height:36px;background:#fff3ee;border-radius:50%;text-align:center;line-height:36px;font-size:17px;'>&#128100;</div>
                  </td>
                  <td style='padding-left:12px;'>
                    <p style='margin:0;font-size:11px;color:#999;text-transform:uppercase;letter-spacing:0.8px;'>Full Name</p>
                    <p style='margin:3px 0 0;font-size:16px;font-weight:600;color:#1a1a2e;'>{$safe_name}</p>
                  </td>
                </tr>
              </table>

              <!-- Phone -->
              <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-bottom:22px;'>
                <tr>
                  <td width='40' style='vertical-align:top;padding-top:2px;'>
                    <div style='width:36px;height:36px;background:#fff3ee;border-radius:50%;text-align:center;line-height:36px;font-size:17px;'>&#128222;</div>
                  </td>
                  <td style='padding-left:12px;'>
                    <p style='margin:0;font-size:11px;color:#999;text-transform:uppercase;letter-spacing:0.8px;'>Mobile Number</p>
                    <p style='margin:3px 0 0;font-size:16px;font-weight:600;color:#1a1a2e;'>
                      <a href='tel:{$safe_phone}' style='color:#FC5D09;text-decoration:none;'>{$safe_phone}</a>
                    </p>
                  </td>
                </tr>
              </table>

              <!-- Relocation Details -->
              <h2 style='margin:0 0 15px;font-size:15px;color:#0b2356;text-transform:uppercase;letter-spacing:1px;border-bottom:2px solid #f0f0f0;padding-bottom:8px;'>
                Relocation Details
              </h2>

              <div style='background:#f8f9fc;border-radius:8px;padding:20px;border-left:4px solid #FC5D09;margin-bottom:20px;'>
                <!-- Pickup -->
                <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-bottom:14px;'>
                  <tr>
                    <td width='30' style='vertical-align:top;padding-top:2px;'>
                      <span style='font-size:18px;'>&#128205;</span>
                    </td>
                    <td>
                      <p style='margin:0;font-size:11px;color:#888;text-transform:uppercase;letter-spacing:0.8px;'>Pickup Location (From)</p>
                      <p style='margin:3px 0 0;font-size:15px;font-weight:600;color:#222;'>{$safe_mfrom}</p>
                    </td>
                  </tr>
                </table>

                <!-- Drop -->
                <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-bottom:14px;'>
                  <tr>
                    <td width='30' style='vertical-align:top;padding-top:2px;'>
                      <span style='font-size:18px;'>&#127919;</span>
                    </td>
                    <td>
                      <p style='margin:0;font-size:11px;color:#888;text-transform:uppercase;letter-spacing:0.8px;'>Drop Location (To)</p>
                      <p style='margin:3px 0 0;font-size:15px;font-weight:600;color:#222;'>{$safe_mto}</p>
                    </td>
                  </tr>
                </table>

                <!-- Date & Time Row -->
                <table width='100%' cellpadding='0' cellspacing='0' border='0' style='border-top:1px dashed #e0e0e0;padding-top:12px;margin-top:10px;'>
                  <tr>
                    <td width='50%' style='vertical-align:top;'>
                      <p style='margin:0;font-size:11px;color:#888;text-transform:uppercase;letter-spacing:0.8px;'>Shifting Date</p>
                      <p style='margin:3px 0 0;font-size:14px;font-weight:600;color:#FC5D09;'>&#128197; {$safe_date}</p>
                    </td>
                    <td width='50%' style='vertical-align:top;'>
                      <p style='margin:0;font-size:11px;color:#888;text-transform:uppercase;letter-spacing:0.8px;'>Shifting Time Slot</p>
                      <p style='margin:3px 0 0;font-size:14px;font-weight:600;color:#0b2356;'>&#9200; {$safe_time}</p>
                    </td>
                  </tr>
                </table>
              </div>

              <!-- CTA Buttons -->
              <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-top:25px;'>
                <tr>
                  <td style='padding-bottom:10px;'>
                    <a href='tel:{$safe_phone}'
                       style='display:block;width:100%;box-sizing:border-box;background:#FC5D09;color:#ffffff;padding:14px 20px;border-radius:8px;text-decoration:none;font-weight:700;font-size:15px;text-align:center;letter-spacing:0.3px;'>
                      &#128222;&nbsp;&nbsp;Call Customer Now ({$safe_phone})
                    </a>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style='background:#f8f9fc;border-top:1px solid #eee;padding:20px 35px;text-align:center;'>
              <p style='margin:0;font-size:12px;color:#999;'>
                This email was generated automatically by the shifting quote form on
                <a href='https://bhandaripackersandmovers.in' style='color:#FC5D09;text-decoration:none;'>bhandaripackersandmovers.in</a>
              </p>
              <p style='margin:6px 0 0;font-size:12px;color:#bbb;'>
                &copy; " . date('Y') . " Bhandari Packers and Movers. All rights reserved.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>";

            $this->send_mail($adminMessage, 'New Shifting Quote Request from ' . $safe_name);
        } catch (\Throwable $e) {
            log_message('error', 'Booking quote email send error: ' . $e->getMessage());
        }

        return true;
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
        $name  = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $qry   = $this->input->post('message');

        // ── 1. Save to local contacts table ──────────────────────────────────
        try {
            $this->db->insert('contacts', array(
                "name"    => $name,
                "phone"   => $phone,
                "message" => $qry,
                "email"   => $email
            ));
        } catch (\Exception $e) {}

        // ── 2. Save to admin contact_messages table ───────────────────────────
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

        // ── 3. Send professional responsive HTML email ────────────────────────
        if (!empty($this->config['smtp_pass'])) {
            try {
                $submission_time = date('D, d M Y \a\t H:i A');
                $safe_name    = htmlspecialchars($name,  ENT_QUOTES, 'UTF-8');
                $safe_email   = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
                $safe_phone   = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
                $safe_message = nl2br(htmlspecialchars($qry, ENT_QUOTES, 'UTF-8'));

                $message = "
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>New Contact Enquiry</title>
</head>
<body style='margin:0;padding:0;background-color:#f4f6f9;font-family:Segoe UI,Arial,sans-serif;'>
  <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color:#f4f6f9;'>
    <tr>
      <td align='center' style='padding:30px 15px;'>
        <table width='600' cellpadding='0' cellspacing='0' border='0' style='max-width:600px;width:100%;background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.08);'>

          <!-- Header -->
          <tr>
            <td style='background:linear-gradient(135deg,#FC5D09,#DD3802);padding:30px 35px;text-align:center;'>
              <h1 style='margin:0;color:#ffffff;font-size:22px;font-weight:700;letter-spacing:0.5px;'>
                &#128233; New Contact Enquiry
              </h1>
              <p style='margin:8px 0 0;color:rgba(255,255,255,0.85);font-size:14px;'>
                Bhandari Packers and Movers &mdash; Contact Form Submission
              </p>
            </td>
          </tr>

          <!-- Alert bar -->
          <tr>
            <td style='background:#fff8f5;border-left:4px solid #FC5D09;padding:12px 35px;'>
              <p style='margin:0;font-size:13px;color:#555;'>
                &#128197; Received on: <strong style='color:#FC5D09;'>{$submission_time}</strong>
              </p>
            </td>
          </tr>

          <!-- Body -->
          <tr>
            <td style='padding:30px 35px;'>
              <h2 style='margin:0 0 20px;font-size:16px;color:#0b2356;text-transform:uppercase;letter-spacing:1px;border-bottom:2px solid #f0f0f0;padding-bottom:10px;'>
                Sender Details
              </h2>

              <!-- Name -->
              <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-bottom:15px;'>
                <tr>
                  <td width='40' style='vertical-align:top;padding-top:2px;'>
                    <div style='width:36px;height:36px;background:#fff3ee;border-radius:50%;text-align:center;line-height:36px;font-size:17px;'>&#128100;</div>
                  </td>
                  <td style='padding-left:12px;'>
                    <p style='margin:0;font-size:11px;color:#999;text-transform:uppercase;letter-spacing:0.8px;'>Full Name</p>
                    <p style='margin:3px 0 0;font-size:16px;font-weight:600;color:#1a1a2e;'>{$safe_name}</p>
                  </td>
                </tr>
              </table>

              <!-- Phone -->
              <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-bottom:15px;'>
                <tr>
                  <td width='40' style='vertical-align:top;padding-top:2px;'>
                    <div style='width:36px;height:36px;background:#fff3ee;border-radius:50%;text-align:center;line-height:36px;font-size:17px;'>&#128222;</div>
                  </td>
                  <td style='padding-left:12px;'>
                    <p style='margin:0;font-size:11px;color:#999;text-transform:uppercase;letter-spacing:0.8px;'>Phone Number</p>
                    <p style='margin:3px 0 0;font-size:16px;font-weight:600;color:#1a1a2e;'>
                      <a href='tel:{$safe_phone}' style='color:#FC5D09;text-decoration:none;'>{$safe_phone}</a>
                    </p>
                  </td>
                </tr>
              </table>

              <!-- Email -->
              <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-bottom:25px;'>
                <tr>
                  <td width='40' style='vertical-align:top;padding-top:2px;'>
                    <div style='width:36px;height:36px;background:#fff3ee;border-radius:50%;text-align:center;line-height:36px;font-size:17px;'>&#9993;</div>
                  </td>
                  <td style='padding-left:12px;'>
                    <p style='margin:0;font-size:11px;color:#999;text-transform:uppercase;letter-spacing:0.8px;'>Email Address</p>
                    <p style='margin:3px 0 0;font-size:16px;font-weight:600;color:#1a1a2e;'>
                      <a href='mailto:{$safe_email}' style='color:#FC5D09;text-decoration:none;'>{$safe_email}</a>
                    </p>
                  </td>
                </tr>
              </table>

              <!-- Message -->
              <h2 style='margin:0 0 12px;font-size:16px;color:#0b2356;text-transform:uppercase;letter-spacing:1px;border-bottom:2px solid #f0f0f0;padding-bottom:10px;'>
                Message
              </h2>
              <div style='background:#f8f9fc;border-radius:8px;padding:18px 20px;border-left:4px solid #FC5D09;'>
                <p style='margin:0;font-size:15px;color:#333;line-height:1.7;'>{$safe_message}</p>
              </div>

              <!-- CTA Buttons - full width equal size on all screens -->
              <table width='100%' cellpadding='0' cellspacing='0' border='0' style='margin-top:28px;'>
                <tr>
                  <td style='padding-bottom:10px;'>
                    <a href='tel:{$safe_phone}'
                       style='display:block;width:100%;box-sizing:border-box;background:#FC5D09;color:#ffffff;padding:14px 20px;border-radius:8px;text-decoration:none;font-weight:700;font-size:15px;text-align:center;letter-spacing:0.3px;'>
                      &#128222;&nbsp;&nbsp;Call Now
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href='mailto:{$safe_email}'
                       style='display:block;width:100%;box-sizing:border-box;background:#0b2356;color:#ffffff;padding:14px 20px;border-radius:8px;text-decoration:none;font-weight:700;font-size:15px;text-align:center;letter-spacing:0.3px;'>
                      &#9993;&nbsp;&nbsp;Reply via Email
                    </a>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style='background:#f8f9fc;border-top:1px solid #eee;padding:20px 35px;text-align:center;'>
              <p style='margin:0;font-size:12px;color:#999;'>
                This email was generated automatically by the contact form on
                <a href='https://bhandaripackersandmovers.in' style='color:#FC5D09;text-decoration:none;'>bhandaripackersandmovers.in</a>
              </p>
              <p style='margin:6px 0 0;font-size:12px;color:#bbb;'>
                &copy; " . date('Y') . " Bhandari Packers and Movers. All rights reserved.
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>";

                $mail_settings = $this->get_email_settings();

                $this->load->library('email');
                $this->email->initialize($this->config);
                $this->email->clear(TRUE);
                $this->email->set_newline("\r\n");
                $this->email->set_crlf("\r\n");
                $this->email->to($mail_settings['to_email']);
                $this->email->from($mail_settings['from_email'], $mail_settings['from_name']);
                if ($email) {
                    $this->email->reply_to($email, $name);
                }
                $this->email->subject('New Contact Enquiry from ' . $safe_name . ' — Bhandari Packers');
                $this->email->message($message);

                $send_result = $this->email->send();
                if (!$send_result) {
                    log_message('error', 'Contact email FAILED. To: ' . $mail_settings['to_email']
                        . ' | From: ' . $mail_settings['from_email']
                        . ' | SMTP: ' . $this->config['smtp_host'] . ':' . $this->config['smtp_port']
                        . ' | Debugger: ' . $this->email->print_debugger());
                } else {
                    log_message('info', 'Contact email sent OK to: ' . $mail_settings['to_email']);
                }

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
