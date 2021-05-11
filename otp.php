<?php
ob_start();
?><?php
    $mail = $_POST['data'];
    $otp = "99";
    $sent = mail($mail, "OTP for Signing Up to TMINC", "Your OTP for Signing Up to TMINC is ".$otp, "From: info@localhost");
    if ($sent){
        echo "sent";
    }
?>