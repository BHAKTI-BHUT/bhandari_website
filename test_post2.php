<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://localhost/bhandari_website/contacts/booking");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "name=TestUser&email=test@example.com&phone=9999999999&mfrom=Delhi&mto=Mumbai&date=2024-12-12&shifting_time=Morning&is_verified=1");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close($ch);
echo $server_output;
