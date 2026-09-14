<?php
// Test email using CodeIgniter
define('ENVIRONMENT', 'development');
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
define('BASEPATH', FCPATH . 'system/');
define('APPPATH', FCPATH . 'application/');

require BASEPATH . 'core/Common.php';

// I will just use raw PHP logic matching the model to test
$db = new mysqli('localhost', 'root', '', 'service_hub');
$res = $db->query("SELECT `key`, `value` FROM settings WHERE `key` LIKE '%mail%'");
$settings = [];
while($row = $res->fetch_assoc()){
    $settings[$row['key']] = $row['value'];
}

require_once BASEPATH . 'libraries/Email.php';

$config['protocol'] = 'smtp';
$config['smtp_host'] = $settings['mail_host'];
$config['smtp_port'] = $settings['mail_port'];
$config['smtp_user'] = $settings['mail_username'];
$config['smtp_pass'] = $settings['mail_password'];
$config['smtp_crypto'] = $settings['mail_encryption'] ?: 'tls';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['newline'] = "\r\n";
$config['crlf'] = "\r\n";

$email = new CI_Email($config);
$email->set_newline("\r\n");

$email->from($settings['mail_from_address'], $settings['mail_from_name']);
$email->to('bhakti.bhut@gmail.com'); // Put a dummy email here just to see if sending works
$email->subject('Test Email from App Password');
$email->message('This is a test email.');

if ($email->send()) {
    echo "Email sent successfully.\n";
} else {
    echo "Error sending email:\n";
    echo $email->print_debugger();
}
