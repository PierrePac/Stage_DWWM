<?php
function verifCaptcha($captchaResponse){
    if(isset($captchaResponse)){
        $captcha=$captchaResponse;
    }
    if(!$captcha){
        //echo '<h2>Please check the the captcha form.</h2>';
        header("location:../emploi.php?message=errorcaptcha");
        exit;
    }
    $secretKey = "6Le-kzsgAAAAAIpe89Q2Xk6j2Y0wK-YTSlsQVCZK";
    $ip = $_SERVER['REMOTE_ADDR'];
    // post request to server
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);
    // should return JSON with success as true
    if($responseKeys["success"]) {
        $sendEmail = 1;
    } else {
        $sendEmail = 0;
    }
}