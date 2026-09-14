<?php
$db = new mysqli('localhost', 'root', '', 'service_hub');
$res = $db->query("SELECT `key`, `value` FROM settings WHERE `key` LIKE '%mail%'");
echo "=== Current SMTP Settings ===\n";
while($row = $res->fetch_assoc()){
    if ($row['key'] === 'mail_password') {
        echo $row['key'] . ' => ' . str_repeat('*', strlen($row['value'])) . ' (length: ' . strlen($row['value']) . ")\n";
    } else {
        echo $row['key'] . ' => ' . $row['value'] . "\n";
    }
}

// Now test Hostinger SMTP with current username
$res2 = $db->query("SELECT `value` FROM settings WHERE `key`='mail_username'");
$username = $res2->fetch_assoc()['value'];
$res3 = $db->query("SELECT `value` FROM settings WHERE `key`='mail_password'");
$password = $res3->fetch_assoc()['value'];

echo "\n=== Testing smtp.hostinger.com:587 with $username ===\n";
$fp = @fsockopen('smtp.hostinger.com', 587, $errno, $errstr, 10);
if (!$fp) {
    echo "Connection failed: $errstr\n";
    exit;
}
echo fgets($fp, 512);
fputs($fp, "EHLO localhost\r\n");
while($line = fgets($fp, 512)) { echo $line; if (substr($line, 3, 1) == " ") break; }
fputs($fp, "STARTTLS\r\n");
echo fgets($fp, 512);
stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
fputs($fp, "EHLO localhost\r\n");
while($line = fgets($fp, 512)) { if (substr($line, 3, 1) == " ") break; }
fputs($fp, "AUTH LOGIN\r\n");
fgets($fp, 512);
fputs($fp, base64_encode($username) . "\r\n");
fgets($fp, 512);
fputs($fp, base64_encode($password) . "\r\n");
$auth = fgets($fp, 512);
echo "Auth result: " . $auth;
fputs($fp, "QUIT\r\n");
fclose($fp);
