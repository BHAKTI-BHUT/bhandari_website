<?php
header('Content-Type: text/plain');

$username = 'u466475909_bhandari_user';
$password = 'Bh@ndari2026Bp!';
$db_admin = 'u466475909_bhandari_admin';
$db_web   = 'u466475909_bhandari_web';

echo "=== DATABASE CONNECTION TEST ===\n\n";

// Test connection to admin database
$conn_admin = @new mysqli('localhost', $username, $password, $db_admin);
if ($conn_admin->connect_error) {
    echo "❌ Admin Database ($db_admin) Connection Failed:\n";
    echo "   Error: " . $conn_admin->connect_error . "\n\n";
} else {
    echo "✅ Admin Database ($db_admin) Connected Successfully!\n";
    // Check if users table exists
    $result = $conn_admin->query("SHOW TABLES LIKE 'users'");
    if ($result && $result->num_rows > 0) {
        echo "   -> 'users' table exists!\n\n";
    } else {
        echo "   -> ⚠️ 'users' table does NOT exist in Admin Database!\n\n";
    }
    $conn_admin->close();
}

// Test connection to web database
$conn_web = @new mysqli('localhost', $username, $password, $db_web);
if ($conn_web->connect_error) {
    echo "❌ Web Database ($db_web) Connection Failed:\n";
    echo "   Error: " . $conn_web->connect_error . "\n\n";
} else {
    echo "✅ Web Database ($db_web) Connected Successfully!\n";
    $conn_web->close();
}
