<?php
// ──────────────────────────────────────────────────────────────────────────────
// SMTP Email Test — visit: http://localhost/bhandari_website/smtp_test.php
// DELETE THIS FILE AFTER TESTING
// ──────────────────────────────────────────────────────────────────────────────
define('BASEPATH', true);

// Load admin DB config to read SMTP settings
$db_config = require_once 'application/config/database.php';

// Try to connect to admin DB and read settings
$smtp_host   = 'smtp.gmail.com';
$smtp_port   = 587;
$smtp_user   = 'bbhut586@rku.ac.in';
$smtp_pass   = ''; // Will be read from DB
$smtp_crypto = 'tls';
$to_email    = '';

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=service_hub;charset=utf8',
        'root',
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    $stmt = $pdo->query("SELECT `key`, `value` FROM settings WHERE `key` IN ('mail_host','mail_port','mail_username','mail_password','mail_encryption','admin_notification_email','mail_from_address')");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $r) {
        if ($r['key'] == 'mail_host'       && $r['value']) $smtp_host   = $r['value'];
        if ($r['key'] == 'mail_port'       && $r['value']) $smtp_port   = (int)$r['value'];
        if ($r['key'] == 'mail_username'   && $r['value']) $smtp_user   = $r['value'];
        if ($r['key'] == 'mail_password'   && $r['value']) $smtp_pass   = $r['value'];
        if ($r['key'] == 'mail_encryption' && $r['value']) $smtp_crypto = $r['value'];
        if ($r['key'] == 'admin_notification_email' && $r['value']) $to_email = $r['value'];
        if ($r['key'] == 'mail_from_address' && $r['value'] && !$to_email) $to_email = $r['value'];
    }
    echo "<p>✅ Admin DB connected. Settings loaded.</p>";
} catch (Exception $e) {
    echo "<p>⚠️ Could not read admin DB: " . $e->getMessage() . "</p>";
}

if (!$to_email) $to_email = $smtp_user;

echo "<pre>";
echo "SMTP Host   : $smtp_host\n";
echo "SMTP Port   : $smtp_port\n";
echo "SMTP User   : $smtp_user\n";
echo "SMTP Pass   : " . (empty($smtp_pass) ? '(EMPTY - this is the problem!)' : str_repeat('*', strlen($smtp_pass))) . "\n";
echo "Encryption  : $smtp_crypto\n";
echo "To Email    : $to_email\n";
echo "</pre>";

if (empty($smtp_pass)) {
    echo "<p style='color:red;font-weight:bold;'>❌ SMTP Password is empty! Set it in Admin → Settings → SMTP & Mail</p>";
    exit;
}

// Now try sending actual email using PHP mail via SMTP with stream
$send_btn = isset($_GET['send']) && $_GET['send'] == '1';

if ($send_btn) {
    // Use PHPMailer-style via raw SMTP
    require_once 'c:/xampp/htdocs/bhandari_website/index.php';
} else {
    echo "<p><a href='?send=1' style='background:#FC5D09;color:#fff;padding:10px 20px;border-radius:5px;text-decoration:none;'>▶ Send Test Email via CodeIgniter</a></p>";
}

// CI-based test
if ($send_btn) {
    // Bootstrap CI
    define('FCPATH', __DIR__ . '/');
    define('SELF', basename(__FILE__));
    define('EXT', '.php');
    define('SYSDIR', 'system');
    define('APPPATH', FCPATH . 'application/');

    $config_arr = array(
        'protocol'    => 'smtp',
        'smtp_host'   => $smtp_host,
        'smtp_port'   => $smtp_port,
        'smtp_user'   => $smtp_user,
        'smtp_pass'   => $smtp_pass,
        'smtp_crypto' => ($smtp_crypto === 'none') ? '' : $smtp_crypto,
        'smtp_timeout'=> 15,
        'mailtype'    => 'html',
        'charset'     => 'utf-8',
        'newline'     => "\r\n",
        'crlf'        => "\r\n",
    );

    // Use CI email library via raw loading
    if (!class_exists('CI_Email')) {
        require_once 'c:/xampp/system/libraries/Email.php';
    }
    $email = new CI_Email();
    $email->initialize($config_arr);
    $email->set_newline("\r\n");
    $email->to($to_email);
    $email->from($smtp_user, 'Bhandari Packers Test');
    $email->subject('✅ SMTP Test Email - Bhandari Packers');
    $email->message("<h2>SMTP Test Email</h2><p>If you received this, SMTP is working correctly!</p><p>Sent at: " . date('Y-m-d H:i:s') . "</p>");
    $result = $email->send();
    if ($result) {
        echo "<p style='color:green;font-size:18px;font-weight:bold;'>✅ Email sent successfully to: $to_email</p>";
    } else {
        echo "<p style='color:red;font-size:16px;font-weight:bold;'>❌ Email FAILED!</p>";
        echo "<pre>" . htmlspecialchars($email->print_debugger()) . "</pre>";
    }
}
