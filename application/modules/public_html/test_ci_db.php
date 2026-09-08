<?php
// Enable full error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASEPATH', 'system');
define('APPPATH', 'application/');
define('VIEWPATH', 'application/views/');
define('ENVIRONMENT', 'production');

require_once 'application/config/database.php';

echo "=== Admin Database Tables list ===\n";
$conn = @new mysqli('localhost', $db_username, $db_password, $db_admin_name);
if ($conn->connect_error) {
    echo "❌ Admin Database Connection Failed: " . $conn->connect_error . "\n";
} else {
    echo "✅ Admin Database Connected Successfully!\n";
    $result = $conn->query("SHOW TABLES");
    if ($result) {
        echo "Tables in $db_admin_name:\n";
        while ($row = $result->fetch_row()) {
            echo " - " . $row[0] . "\n";
        }
    } else {
        echo "❌ Could not retrieve tables.\n";
    }
    $conn->close();
}
