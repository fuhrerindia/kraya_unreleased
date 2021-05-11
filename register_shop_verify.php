<?php
    ob_start();
        require 'includes/PHPMailer.php';
        require 'includes/SMTP.php';
        require 'includes/Exception.php';
    
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
    function scook($key, $val){
        setcookie(md5($key), base64_encode($val), time() + 1200, "/"); //SAVE FOR 20 MIN ONLY
    }
    if (isset($_POST['done_otp'])){
        if (md5($_POST['otp']) === $_COOKIE[md5("SHOP_OTP")]){
            include('cred.php');
            $con = mysqli_connect($server, $user, $pass, $db);
                        $conn = mysqli_connect($server, $user, $pass, $db);
                        $user_name = $_COOKIE[md5('NAME')];
                        $user_mail = $_COOKIE[md5('TEMP_FMAIL')];
                        $user_shop = $_COOKIE[md5('SHOPNAME')];
                        $user_phone = $_COOKIE[md5('PHONE')];
                        $user_password = md5(base64_decode($_COOKIE[md5('TEMP_ID')]));
                        $shop_address = $_COOKIE[md5('TEMP_ADDRESS')];
                        $sqli = "INSERT INTO `shops`(`loc`, `owner`, `name`, `address`, `phone`, `mail`, `password`) VALUES (NULL, '".$user_name."', '".$user_shop."', '".$shop_address."','".$user_phone."','".$user_mail."', '".$user_password."')";
                        $new_user = mysqli_query($conn, $sqli);
                        if ($new_user){
                        ?>
                            <script>
                                window.location="shop_login.php";
                            </script>       
                        <?php
                        }else{
                            ?>
                            <script>
                            alert('There was an error while creating your account.');
                                                    </script>
                            <?php
                            // echo $sqli;
                        }
            
        }else{
            ?><!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Verify E-Mail - TMINC</title>
            </head>
            <body>
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');
                *{color:#666;text-align:center;margin:0;font-size:14px;padding:0;font-family: 'Noto Sans', sans-serif;}
                .box{padding:20px;margin-top:15vh;padding-bottom:36px;border:1px solid #ddd;border-radius:8px;width:445px;display:inline-block;background:#fff;}
                .logo{height:50px;display:inline-block;margin:40px;margin-bottom:0px}
                h2{color:#202124;margin-bottom:10px;font-size:24px;font-weight:100;}
                p{width:90%;text-align:left;margin:30px;display:inline-block;}
                a{text-decoration:none;color:#311B92;font-weight:5px}
                .left{float:left;}
                span{display:block;margin:10px;}
                #alreadymail{display:none;  }
                body{background:#ededed;}
                #passerror{display:none}
                #loading_animation{height:0px;}
                input[type="text"],input[type="email"],input[type="password"],input[type="tel"],textarea{margin:5px;width:70%;padding:13px 15px;font-size:16px;text-align:left;color:#404040;border-radius:4px;border:1px solid #ddd;padding-top:10px;padding-bottom:10px;}
                input[type="submit"], .submit{float:right;cursor:pointer;outline:0;background:#311B92;color:#fff;font-family: 'Noto Sans', sans-serif;border:0;width:85px;height:40px;border-radius:5px;}
                .left, input[type="submit"]{margin:20px;    margin-right: 56px;}
                .requirednotice{color:red;text-align:left;display:none;    background: #ff00004d;
                padding: 7px;
                width: fit-content;
                border-bottom-right-radius: 13px;
                border-bottom-left-radius: 13px;
                margin-top: -9px;}
                #passlength{display:none;}
                @media screen and (max-width:450px){
                    .box{border:0;width:81%;margin-top:0;}
                }
            </style>
            <div class="box">
            <img src="assets/icon.png" class="logo"><br>
                <h2>Verify</h2>
                <span>to continue to TMINC</span>
                <noscript><strong>Please enable JavaScript in your browser or upgrade to latest browser to use ths page.</strong></noscript>
                <form action="" method="post">
                    <p>OTP is sent to <strong><?php echo base64_decode($_COOKIE[md5('TEMP_FMAIL')]); ?></strong>, please enter the 6 digit OTP below. If OTP is not found check Spam / Snoozed / Social folders too. If still not found, wait for a while.</p>
                    <p style="    position: fixed;
    top: 0;
    left: 0;
    margin: 0;
    width: 100%;
    background: red;
    color: #fff;
    text-align: center;
    padding: 15px;
    font-weight: bold;">OTP You enterred is wrong, try again.</p>
                    <strong>T</strong>&nbsp;-&nbsp;<input type="text" name="otp" id="otp" placeholder="Enter OTP" required><br>
                    <input type="submit" value="Done" name="done_otp">
                </form>
            </div>
            </body>
            </html><?php
            $do_more = false;
        }


    }
    if (isset($_POST['name'])){
        if ($_POST['name'] !== "" && $_POST['mail'] !== "" && $_POST['shop_name'] !== "" && $_POST['phone'] !== "" && strlen($_POST['cp']) > 8 && $_POST['cp'] === $_POST['cop'] && filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) && $_POST['address'] !== ""){
            scook("NAME", $_POST['name']);
            scook("TEMP_FMAIL", $_POST['mail']);
            scook("SHOPNAME", $_POST['shop_name']);
            scook("PHONE", $_POST['phone']);
            scook("TEMP_ID", $_POST['cp']);
            scook("TEMP_ADDRESS", $_POST['address']);

            include('cred.php');
            if ($cone = mysqli_connect($server, $user, $pass, $db)){
                $sql = "SELECT * FROM `shops` WHERE `mail` LIKE '".base64_encode($_POST['mail'])."'";
                if ($ver = mysqli_query($cone, $sql)){
                    if (0 < mysqli_num_rows($ver)){
                        echo "BAKAITI NAHI!";
                    }else{
                        // VERIFICATION HERE
                        if (!isset($do_more)){
                        $otp = rand(100000, 999999);
                            setcookie(md5("SHOP_OTP"), md5($otp), time() + 1200, "/"); //SAVE FOR 20 MIN ONLY
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
                                                    <p style='margin:20px;line-height:25px;text-align:justify'>This is for One Use only, this OTP is valid for 20 Minutes only. Enter the OTP provided above in the opened page and verify your E-Mail Address. Please do not share this OTP with anybody, this may affect your privacy.</p>
                                                    <p style='margin:20px;line-height:25px;text-align:justify'>Download or Open WebApp from <a href='http://tminc.ml/apps'>here.</a></p>
                                                    <p style='margin:20px;line-height:25px;text-align:center'>By creating account on TMINC you agree to our Privacy Policy, which can be accessed on our <a href='http://tminc.ml'>official website</a>.</p>
                                                </div>
                                            </div>
                                ");    
                            }
                            $mail->Body = mailbody($_POST['name'], $otp);
                            $mail->addAddress($_POST['mail']);
                            if ($mail->Send()){
                                ?>
                                <!DOCTYPE html>
                                <html lang="en">
                                <head>
                                    <meta charset="UTF-8">
                                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                    <title>Verify E-Mail - TMINC</title>
                                </head>
                                <body>
                                <style>
                                    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');
                                    *{color:#666;text-align:center;margin:0;font-size:14px;padding:0;font-family: 'Noto Sans', sans-serif;}
                                    .box{padding:20px;margin-top:15vh;padding-bottom:36px;border:1px solid #ddd;border-radius:8px;width:445px;display:inline-block;background:#fff;}
                                    .logo{height:50px;display:inline-block;margin:40px;margin-bottom:0px}
                                    h2{color:#202124;margin-bottom:10px;font-size:24px;font-weight:100;}
                                    p{width:90%;text-align:left;margin:30px;display:inline-block;}
                                    a{text-decoration:none;color:#311B92;font-weight:5px}
                                    .left{float:left;}
                                    span{display:block;margin:10px;}
                                    #alreadymail{display:none;  }
                                    body{background:#ededed;}
                                    #passerror{display:none}
                                    #loading_animation{height:0px;}
                                    input[type="text"],input[type="email"],input[type="password"],input[type="tel"],textarea{margin:5px;width:70%;padding:13px 15px;font-size:16px;text-align:left;color:#404040;border-radius:4px;border:1px solid #ddd;padding-top:10px;padding-bottom:10px;}
                                    input[type="submit"], .submit{float:right;cursor:pointer;outline:0;background:#311B92;color:#fff;font-family: 'Noto Sans', sans-serif;border:0;width:85px;height:40px;border-radius:5px;}
                                    .left, input[type="submit"]{margin:20px;    margin-right: 56px;}
                                    .requirednotice{color:red;text-align:left;display:none;    background: #ff00004d;
                                    padding: 7px;
                                    width: fit-content;
                                    border-bottom-right-radius: 13px;
                                    border-bottom-left-radius: 13px;
                                    margin-top: -9px;}
                                    #passlength{display:none;}
                                    @media screen and (max-width:450px){
                                        .box{border:0;width:81%;margin-top:0;}
                                    }
                                </style>
                                <div class="box">
                                <img src="assets/icon.png" class="logo"><br>
                                    <h2>Verify</h2>
                                    <span>to continue to TMINC</span>
                                    <noscript><strong>Please enable JavaScript in your browser or upgrade to latest browser to use ths page.</strong></noscript>
                                    <form action="" method="post">
                                        <p>OTP is sent to <strong><?php echo $_POST['mail']; ?></strong>, please enter the 6 digit OTP below. If OTP is not found check Spam / Snoozed / Social folders too. If still not found, wait for a while.</p>
                                        <strong>T</strong>&nbsp;-&nbsp;<input type="text" name="otp" id="otp" placeholder="Enter OTP" required><br>
                                        <input type="submit" value="Done" name="done_otp">
                                    </form>
                                </div>
                                </body>
                                </html>
                                <?php
                            }else{
                                ?><script>
                                    alert('Due to heavy traffic on TMINC Server, we can\'t process your request. Please try again after 24 hrs.');
                                    window.location="start.php";
                                </script><?php
                            }
                            }
                    }
                }else{
                    echo "ERROR!";
                }
            }else{
                echo "ERROR!";
            }
        }
    }
?>