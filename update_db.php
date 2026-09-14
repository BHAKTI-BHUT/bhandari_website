<?php
$db = new mysqli('localhost', 'root', '', 'service_hub');
$db->query("UPDATE settings SET value='hi@bhandaripackersandmovers.in' WHERE `key` IN ('admin_notification_email', 'contact_email')");
echo 'Updated DB';
