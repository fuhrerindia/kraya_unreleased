<?php
ob_start();
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<?php
if (isset($_POST['change_password'])){
    if ($_POST['cp'] === $_POST['cop'] && strlen($_POST['cp']) > 8){
    include('cred.php');
    $do_more = false;
    if ($reach = mysqli_connect($server, $user, $pass, $db)){
        $sql = "UPDATE `shops` SET `password` = '".md5($_POST['cp'])."'";
        if (mysqli_query($reach, $sql)){
            ?><script>
                alert('Password is now changed, now please signin.');
                window.location = "shop_login.php";
            </script><?php
        }else{
            echo "ERROR";
        }
    }else{
        echo "ERROR";
    }
}
}
if (isset($_POST['send_otp'])){
    include('cred.php');
    if ($conn = mysqli_connect($server, $user, $pass, $db)){
        $sql = "SELECT * FROM `shops` WHERE `mail` LIKE '".base64_encode($_POST['email'])."'";
        if ($get = mysqli_query($conn, $sql)){
            if (0 < mysqli_num_rows($get)){
                while ($list = mysqli_fetch_array($get)){
                    $owner_name = base64_decode($list['owner']);
                }
                $otp = rand(100000, 999999);
                setcookie(md5("SHOP_OTP"), md5($otp), time() + 1200, "/"); //SAVE FOR 20 MIN ONLY
                setcookie(md5("SHOP_MAIL"), base64_encode($_POST['email']), time() + 1200, "/"); //SAVE FOR 20 MIN ONLY
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = "true";
                $mail->isHTML(true);
                $mail->SMTPSecure = "tls";
                $mail->Port = "587";
                $mail->Username = "tmincidhelp@gmail.com";
                $mail->Password = "tmincdcin1@2020";
                $mail->Subject = "Verify your E-Mail - TMINC";
                $mail->setFrom("no-reply@tminc.ml");
                function mailbody($name, $otp){
                    return("
                    <style>*{margin:0;padding:0;font-family:sans-serif;color:#1c1c1c}</style>
                    <div style='width:100%;height:100vh;background:#ededed;text-align:center'>
                                    <div class='child' style='display:inline-block;background:#ffffff;width:80%;height:80vh;border-radius:15px;box-shadow:0 0 30px #ddd;margin-top:8vh'>
                                        <h3 style='margin-top:5vh'>Hi! {$name}</h3>
                                        <p style='margin:10px;'>Your OTP for E-Mail Verification is<br></p>
                                        <h2>T - {$otp}</h2>
                                        <p style='margin:20pxline-height:25px;text-align:justify'>This E-Mail is sent because you requested to recover your TMINC KRAYA SHOP account.</p>
                                        <p style='margin:20px;line-height:25px;text-align:justify'>This is for One Use only, this OTP is valid for 20 Minutes only. Enter the OTP provided above in the opened page and verify your E-Mail Address. Please do not share this OTP with anybody, this may affect your privacy.</p>
                                        <p style='margin:20px;line-height:25px;text-align:justify'>Download or Open WebApp from <a href='http://tminc.ml/apps'>here.</a></p>
                                        <p style='margin:20px;line-height:25px;text-align:center'>By creating account on TMINC you agree to our Privacy Policy, which can be accessed on our <a href='http://tminc.ml'>official website</a>.</p>
                                    </div>
                                </div>
                    ");    
                }
                $mail->Body = mailbody($owner_name, $otp);
                $mail->addAddress($_POST['email']);
                if ($mail->Send()){
                    $do_more = false;
                    ?>
                        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Sign In - TMINC Kraya</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');
    *{color:#666;text-align:center;margin:0;font-size:14px;padding:0;font-family: 'Noto Sans', sans-serif;}
    .box{padding:20px;margin-top:15vh;padding-bottom:36px;border:1px solid #ddd;border-radius:8px;width:445px;display:inline-block;box-shadow: 0 0 31px #ddd;background:#fff;}
    .logo{height:50px;display:inline-block;margin:40px;margin-bottom:0px}
    h2{color:#202124;margin-bottom:10px;font-size:24px;font-weight:100;}
    p{width:90%;text-align:left;margin:30px;display:inline-block;}
    a{text-decoration:none;color:#ff5722;font-weight:5px;font-weight:bold;}
    .left{float:left;}
    .err{color:red !important;display: inline-block;}
    span{display:block;margin:10px;}
    input[type="password"],input[type="email"],input[type="text"]{width:90%;padding:13px 15px;margin:5px;font-size:16px;text-align:left;color:#404040;border-radius:4px;border:1px solid #ddd;padding-top:10px;padding-bottom:10px;}
    input[type="submit"]{float:right;cursor:pointer;outline:0;background:#ff5722;color:#fff;font-family: 'Noto Sans', sans-serif;border:0;width:85px;height:40px;border-radius:5px;}
    .left, input[type="submit"]{margin:20px;}
    body{background: #ededed;}
    @media screen and (max-width:450px){
        .box{margin: 0;
    width: 91%;
}

    }
</style>
</head>
<body>
<div class="box">
        <img src="assets/icon.png" class="logo"><br>
        <h2>Verify</h2>
        <span>To Recover Shop Account</span>
        <form action="" method="POST">
            <input type="text" name="otp" placeholder="OTP" required><br>
            <input type="submit" value="Next" name="verify_otp">
                <?php
                if (isset($_GET['mw'])){
                    echo "<article class='err'>You have entered wrong E-Mail, please try again.</article>";
                }
                if (isset($_GET['pw'])){
                    echo "<article class='err'>You have entered wrong Password, please try again.</article>";
                }
            ?>
            <p>OTP is sent to <strong><?php echo $_POST['email']; ?></strong>, Please enter OTP.</p>
        <div></form>
        </div>
    </div>
</body>
</html>
                    <?php
                }else{
                    ?><script>
                        alert('Due to heavy traffic, we are unable to send OTP to you, please try again after 24 hrs.');
                        window.location="start.php";
                    </script><?php
                }
            }else{
                ?>
                <script>alert('Account Not Found!');
                    window.location="shop_login.php";
                </script><?php
            }
        }
    }else{  
        echo "INTERNAL ERROR";
    }
}
//  <!-- VERIFYING OTP BELOW -->

if (isset($_POST['verify_otp'])){
    include('cred.php');
    if ($conn = mysqli_connect($server, $user, $pass, $db)){
        $sql = "SELECT * FROM `shops` WHERE `mail` LIKE '".$_COOKIE[md5('SHOP_MAIL')]."'";
        if ($get = mysqli_query($conn, $sql)){
            if (0 < mysqli_num_rows($get)){
                while ($list = mysqli_fetch_array($get)){
                    $owner_name = base64_decode($list['owner']);
                }
                    $do_more = false;
                    if (md5($_POST['otp']) === $_COOKIE[md5('SHOP_OTP')]){
                    ?>
                        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Sign In - TMINC Kraya</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');
    *{color:#666;text-align:center;margin:0;font-size:14px;padding:0;font-family: 'Noto Sans', sans-serif;}
    .box{padding:20px;margin-top:15vh;padding-bottom:36px;border:1px solid #ddd;border-radius:8px;width:445px;display:inline-block;box-shadow: 0 0 31px #ddd;background:#fff;}
    .logo{height:50px;display:inline-block;margin:40px;margin-bottom:0px}
    h2{color:#202124;margin-bottom:10px;font-size:24px;font-weight:100;}
    p{width:90%;text-align:left;margin:30px;display:inline-block;}
    a{text-decoration:none;color:#ff5722;font-weight:5px;font-weight:bold;}
    .left{float:left;}
    .err{color:red !important;display: inline-block;}
    span{display:block;margin:10px;}
    input[type="password"],input[type="email"],input[type="text"]{width:90%;padding:13px 15px;margin:5px;font-size:16px;text-align:left;color:#404040;border-radius:4px;border:1px solid #ddd;padding-top:10px;padding-bottom:10px;}
    input[type="submit"], #done{float:right;cursor:pointer;outline:0;background:#ff5722;color:#fff;font-family: 'Noto Sans', sans-serif;border:0;width:85px;height:40px;border-radius:5px;}
    .left, input[type="submit"], #done{margin:20px;}
    .errornotice{    width: fit-content;
    background: #f2bbbb;
    color: red;
    padding: 8px;
    border-bottom-right-radius: 12px;
    display:none;
    border-bottom-left-radius: 12px;
    margin-top: -11px;}
    body{background: #ededed;}
    @media screen and (max-width:450px){
        .box{margin: 0;
    width: 91%;
}

    }
</style>
</head>
<body>
<div class="box">
        <img src="assets/icon.png" class="logo"><br>
        <h2>Verify</h2>
        <span>To Recover Shop Account</span>
        <form action="" method="POST" id="form">
            <input type="password" name="cp" id="cp" placeholder="New Password" required><br>
            <span class="errornotice" id="reqcp">This field is required*</span>
            <input type="password" name="cop" id="cop" placeholder="Confirm Password" required>
            <span class="errornotice" id="reqcop">This field is required*</span>
            <input type="checkbox" name="change_password" style="display:none;" checked>
                <?php
                if (isset($_GET['mw'])){
                    echo "<article class='err'>You have entered wrong E-Mail, please try again.</article>";
                }
                if (isset($_GET['pw'])){
                    echo "<article class='err'>You have entered wrong Password, please try again.</article>";
                }
            ?>
            <p>OTP is sent to <strong><?php echo base64_decode($_COOKIE[md5('SHOP_MAIL')]); ?></strong>, Please enter OTP.</p>
        <div></form>
        </div>
        <button id="done">Done</button>
        <script>
                                            const done = document.getElementById("done");
                                            const cp = document.getElementById("cp");
                                            const cop = document.getElementById("cop");
                                            function g_focus(id, snap){
                                                document.getElementById(id).focus();
                                                document.getElementById(id).style.border = "1px solid red";
                                                document.getElementById(snap).style.display = "block";
                                            }
                                            function l_focus(id, snap){
                                                document.getElementById(id).style.border = "1px solid #ddd";
                                                document.getElementById(snap).style.display = "none";
                                            }
                                            done.addEventListener("click", ()=>{
                                                if (cp.value === cop.value && cp.value.length > 8){
                                                    document.getElementById("form").submit();
                                                }else{
                                                    if (cp.value !== cop.value){
                                                        g_focus("cop", "reqcop");
                                                        g_focus("cp", "reqcp");
                                                        document.getElementById("reqcp").innerHTML = "Passwords do not match";
                                                        document.getElementById("reqcop").innerHTML = "Passwords do not match";
                                                    }else{
                                                        l_focus("cop", "reqcop");
                                                        l_focus("cp", "reqcp");
                                                        document.getElementById("reqcp").innerHTML = "Above Field is Required";
                                                        document.getElementById("reqcop").innerHTML = "Above Field is Required";
                                                    }
                                                    if (cp.value === ""){
                                                        g_focus("cp", "reqcp");
                                                    }
                                                    if (cop.value === ""){
                                                        g_focus('cop', "reqcop");
                                                    }

                                                    if (cp.value.length  < 9){
                                                        g_focus("cp", "reqcp");
                                                        document.getElementById("reqcp").innerHTML = "Password should be longer.";
                                                    }else{
                                                        document.getElementById("reqcp").innerHTML = "Above Field is Required";
                                                        l_focus("cp", "reqcp");
                                                    }
                                                }
                                            });
                                        </script>
    </div>
</body>
</html>
                    <?php
                    }else{
                        ?>
                        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Sign In - TMINC Kraya</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');
    *{color:#666;text-align:center;margin:0;font-size:14px;padding:0;font-family: 'Noto Sans', sans-serif;}
    .box{padding:20px;margin-top:15vh;padding-bottom:36px;border:1px solid #ddd;border-radius:8px;width:445px;display:inline-block;box-shadow: 0 0 31px #ddd;background:#fff;}
    .logo{height:50px;display:inline-block;margin:40px;margin-bottom:0px}
    h2{color:#202124;margin-bottom:10px;font-size:24px;font-weight:100;}
    p{width:90%;text-align:left;margin:30px;display:inline-block;}
    a{text-decoration:none;color:#ff5722;font-weight:5px;font-weight:bold;}
    .left{float:left;}
    .err{color:red !important;display: inline-block;}
    span{display:block;margin:10px;}
    input[type="password"],input[type="email"],input[type="text"]{width:90%;padding:13px 15px;margin:5px;font-size:16px;text-align:left;color:#404040;border-radius:4px;border:1px solid #ddd;padding-top:10px;padding-bottom:10px;}
    input[type="submit"]{float:right;cursor:pointer;outline:0;background:#ff5722;color:#fff;font-family: 'Noto Sans', sans-serif;border:0;width:85px;height:40px;border-radius:5px;}
    .left, input[type="submit"]{margin:20px;}
    body{background: #ededed;}
    @media screen and (max-width:450px){
        .box{margin: 0;
    width: 91%;
}

    }
</style>
</head>
<body>
<div class="box">
        <img src="assets/icon.png" class="logo"><br>
        <h2>Verify</h2>
        <span>To Recover Shop Account</span>
        <span style="color:red;font-weight:bold">You have enterred wrong OTP.</span>
        <form action="" method="POST">
            <input type="text" name="otp" placeholder="OTP" required><br>
            <input type="submit" value="Next" name="verify_otp">
            <p>OTP is sent to <strong><?php echo base64_decode($_COOKIE[md5('SHOP_MAIL')]); ?></strong>, Please enter OTP.</p>
        <div></form>
        </div>
    </div>
</body>
</html>
                        <?php
                    }
            }else{
                ?>
                <script>
                alert('Account Not Found!');
                    window.location="shop_login.php";
                </script><?php
                
            }
        }
    }else{  
        echo "INTERNAL ERROR";
    }
}
?>


<?php
    if (!isset($do_more)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Sign In - TMINC Kraya</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');
    *{color:#666;text-align:center;margin:0;font-size:14px;padding:0;font-family: 'Noto Sans', sans-serif;}
    .box{padding:20px;margin-top:15vh;padding-bottom:36px;border:1px solid #ddd;border-radius:8px;width:445px;display:inline-block;box-shadow: 0 0 31px #ddd;background:#fff;}
    .logo{height:50px;display:inline-block;margin:40px;margin-bottom:0px}
    h2{color:#202124;margin-bottom:10px;font-size:24px;font-weight:100;}
    p{width:90%;text-align:left;margin:30px;display:inline-block;}
    a{text-decoration:none;color:#ff5722;font-weight:5px;font-weight:bold;}
    .left{float:left;}
    .err{color:red !important;display: inline-block;}
    span{display:block;margin:10px;}
    input[type="password"],input[type="email"],input[type="text"]{width:90%;padding:13px 15px;margin:5px;font-size:16px;text-align:left;color:#404040;border-radius:4px;border:1px solid #ddd;padding-top:10px;padding-bottom:10px;}
    input[type="submit"]{float:right;cursor:pointer;outline:0;background:#ff5722;color:#fff;font-family: 'Noto Sans', sans-serif;border:0;width:85px;height:40px;border-radius:5px;}
    .left, input[type="submit"]{margin:20px;}
    body{background: #ededed;}
    @media screen and (max-width:450px){
        .box{margin: 0;
    width: 91%;
}

    }
</style>
</head>
<body>
<div class="box">
        <img src="assets/icon.png" class="logo"><br>
        <h2>Verify</h2>
        <span>To Recover Shop Account</span>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="submit" value="Send OTP" name="send_otp">
                <?php
                if (isset($_GET['mw'])){
                    echo "<article class='err'>You have entered wrong E-Mail, please try again.</article>";
                }
                if (isset($_GET['pw'])){
                    echo "<article class='err'>You have entered wrong Password, please try again.</article>";
                }
            ?>
            <p>We will send OTP to your registered E-Mail Address, please enter your registered E-Mail.</p>
        <div></form>
        </div>
    </div>
</body>
</html>
<?php
    }
?>  