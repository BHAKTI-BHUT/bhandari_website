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
