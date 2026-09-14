<?php
$db = new mysqli('localhost', 'root', '', 'service_hub');
$res = $db->query("SELECT `value` FROM settings WHERE `key`='mail_password'");
$password = $res->fetch_assoc()['value'];

// Test 1: info@bhandaripackersandmovers.in with this password on Hostinger
$accounts = [
    'info@bhandaripackersandmovers.in',
    'hi@bhandaripackersandmovers.in'
];

foreach ($accounts as $user) {
    echo "=== Testing Hostinger SMTP with $user ===\n";
    $fp = @fsockopen('smtp.hostinger.com', 587, $errno, $errstr, 10);
    if (!$fp) { echo "Connection failed\n\n"; continue; }
    fgets($fp, 512);
    fputs($fp, "EHLO localhost\r\n");
    while($line = fgets($fp, 512)) { if (substr($line, 3, 1) == " ") break; }
    fputs($fp, "STARTTLS\r\n");
    fgets($fp, 512);
    stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
    fputs($fp, "EHLO localhost\r\n");
    while($line = fgets($fp, 512)) { if (substr($line, 3, 1) == " ") break; }
    fputs($fp, "AUTH LOGIN\r\n");
    fgets($fp, 512);
    fputs($fp, base64_encode($user) . "\r\n");
    fgets($fp, 512);
    fputs($fp, base64_encode($password) . "\r\n");
    $auth = fgets($fp, 512);
    $code = substr(trim($auth), 0, 3);
    if ($code === '235') {
        echo "✅ SUCCESS! Auth accepted for $user\n\n";
    } else {
        echo "❌ FAILED: " . trim($auth) . "\n\n";
    }
    fputs($fp, "QUIT\r\n");
    fclose($fp);
}

// Also try with the hardcoded fallback password
echo "=== Testing with fallback Hostinger password ===\n";
$fallback_pass = '4kguKm3ygsyuYlHapreJ(GmQu';
foreach ($accounts as $user) {
    echo "Testing $user with fallback pw... ";
    $fp = @fsockopen('smtp.hostinger.com', 587, $errno, $errstr, 10);
    if (!$fp) { echo "Connection failed\n"; continue; }
    fgets($fp, 512);
    fputs($fp, "EHLO localhost\r\n");
    while($line = fgets($fp, 512)) { if (substr($line, 3, 1) == " ") break; }
    fputs($fp, "STARTTLS\r\n");
    fgets($fp, 512);
    stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
    fputs($fp, "EHLO localhost\r\n");
    while($line = fgets($fp, 512)) { if (substr($line, 3, 1) == " ") break; }
    fputs($fp, "AUTH LOGIN\r\n");
    fgets($fp, 512);
    fputs($fp, base64_encode($user) . "\r\n");
    fgets($fp, 512);
    fputs($fp, base64_encode($fallback_pass) . "\r\n");
    $auth = fgets($fp, 512);
    $code = substr(trim($auth), 0, 3);
    echo ($code === '235') ? "✅ SUCCESS!\n" : "❌ FAILED: " . trim($auth) . "\n";
    fputs($fp, "QUIT\r\n");
    fclose($fp);
}
