<?php
// Quick MSG91 SMS delivery diagnostic
// Run: php c:\xampp\htdocs\bhandari_website\test_otp_delivery.php

$authKey    = "556182T8qj8j5D9j6a6f0ae7P1";
$templateId = "6a7a05b775108125180a1a63";
$senderId   = "BMOVER";
$dltId      = "1277178638247818736";
$widgetId   = "36686266774e343530343138";
$mobile10   = "7016370260";
$mobile91   = "917016370260";
$otp        = "456789";

echo "=== MSG91 OTP DELIVERY DIAGNOSTIC ===\n\n";

// Test A: v5/otp with 91XXXXXXXXXX (no country param)
echo "[A] v5/otp - mobile=917016370260 (no country param)\n";
$urlA = "https://control.msg91.com/api/v5/otp?template_id={$templateId}&mobile={$mobile91}&authkey={$authKey}&otp={$otp}&sender={$senderId}&DLT_TE_ID={$dltId}&unicode=0";
$chA = curl_init(); curl_setopt_array($chA,[CURLOPT_URL=>$urlA,CURLOPT_RETURNTRANSFER=>true,CURLOPT_TIMEOUT=>10,CURLOPT_CUSTOMREQUEST=>"POST",CURLOPT_POSTFIELDS=>json_encode(["otp"=>$otp,"var1"=>$otp,"VAR1"=>$otp,"OTP"=>$otp]),CURLOPT_HTTPHEADER=>["authkey: $authKey","Content-Type: application/json"]]);
$resA = curl_exec($chA); curl_close($chA);
echo "Response: $resA\n\n";

// Test B: v5/otp with 10-digit + country=91
echo "[B] v5/otp - mobile=7016370260 + country=91\n";
$urlB = "https://control.msg91.com/api/v5/otp?template_id={$templateId}&mobile={$mobile10}&country=91&authkey={$authKey}&otp={$otp}&sender={$senderId}&DLT_TE_ID={$dltId}&unicode=0";
$chB = curl_init(); curl_setopt_array($chB,[CURLOPT_URL=>$urlB,CURLOPT_RETURNTRANSFER=>true,CURLOPT_TIMEOUT=>10,CURLOPT_CUSTOMREQUEST=>"POST",CURLOPT_POSTFIELDS=>json_encode(["otp"=>$otp,"var1"=>$otp,"VAR1"=>$otp,"OTP"=>$otp]),CURLOPT_HTTPHEADER=>["authkey: $authKey","Content-Type: application/json"]]);
$resB = curl_exec($chB); curl_close($chB);
echo "Response: $resB\n\n";

// Test C: Widget API sendOtp
echo "[C] Widget API sendOtp\n";
$chC = curl_init("https://control.msg91.com/api/v5/widget/sendOtp");
curl_setopt_array($chC,[CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>json_encode(['widgetId'=>$widgetId,'tokenAuth'=>$authKey,'identifier'=>$mobile91]),CURLOPT_RETURNTRANSFER=>true,CURLOPT_TIMEOUT=>10,CURLOPT_HTTPHEADER=>['Content-Type: application/json']]);
$resC = curl_exec($chC); curl_close($chC);
echo "Response: $resC\n\n";

// Test D: v5/flow API
echo "[D] v5/flow API\n";
$chD = curl_init("https://control.msg91.com/api/v5/flow/");
curl_setopt_array($chD,[CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>json_encode(["template_id"=>$templateId,"sender"=>$senderId,"short_url"=>"0","recipients"=>[["mobiles"=>$mobile91,"otp"=>$otp,"var1"=>$otp,"VAR1"=>$otp]]]),CURLOPT_RETURNTRANSFER=>true,CURLOPT_TIMEOUT=>10,CURLOPT_HTTPHEADER=>["authkey: $authKey","Content-Type: application/json"]]);
$resD = curl_exec($chD); curl_close($chD);
echo "Response: $resD\n\n";

echo "OTP used for ALL tests: $otp\n";
echo "Check your phone for SMS with OTP $otp\n";
echo "If received, note WHICH test (A/B/C/D) delivered it.\n";
