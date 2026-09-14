<?php
$host = 'smtp.gmail.com';
$port = 587;
$user = 'hi@bhandaripackersandmovers.in';
$pass = 'womdstqljptuvpmk';

echo "Testing $host with $user...\n";
$fp = @fsockopen($host, $port, $errno, $errstr, 10);
if (!$fp) { echo "Connection failed: $errstr\n"; exit; }
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
fputs($fp, base64_encode($user) . "\r\n");
fgets($fp, 512);
fputs($fp, base64_encode($pass) . "\r\n");
$auth = fgets($fp, 512);
echo "Auth result: " . $auth . "\n";
fputs($fp, "QUIT\r\n");
fclose($fp);
