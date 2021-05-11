<?php
            require 'includes/PHPMailer.php';
            require 'includes/SMTP.php';
            require 'includes/Exception.php';
        
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\Exception;


            if (isset($_POST['reset_password'])){
                include('cred.php');
                if ($_POST['cp'] === $_POST['cop'] && strlen($_POST['cp']) > 8){
                    $do_more = false;
                    $connection = mysqli_connect($server, $user, $pass, $db);
                    if ($connection){
                        $upsql = "UPDATE `users` SET `password`='".md5($_POST['cp'])."' WHERE `mail` LIKE '".$_COOKIE[md5('TEMP_FMAIL')]."'";
                        if (mysqli_query($connection, $upsql)){
                            $mail = new PHPMailer();
                            $mail->isSMTP();
                            $mail->Host = "smtp.gmail.com";
                            $mail->SMTPAuth = "true";
                            $mail->isHTML(true);
                            $mail->SMTPSecure = "tls";
                            $mail->Port = "587";
                            $mail->Username = "tmincidhelp@gmail.com";
                            $mail->Password = "tmincdcin1@2020";
                            $mail->Subject = "TMINC Account Password was changed";
                            $mail->setFrom("no-reply@tminc.ml");
                            function mailbodynew($name){
                                return("
                                <style>*{margin:0;padding:0;font-family:sans-serif;color:#1c1c1c}</style>
                                <div style='width:100%;height:100vh;background:#ededed;text-align:center'>
                                                <div class='child' style='display:inline-block;background:#ffffff;width:80%;height:80vh;border-radius:15px;box-shadow:0 0 30px #ddd;margin-top:8vh'>
                                                    <h3 style='margin-top:5vh'>Hi! {$name}</h3>
                                                    <h2>Your Password was Changed</h2>
                                                    <p style='margin:20px;line-height:25px;text-align:justify'>We wanted to inform you that your TMINC Account Password was changed, if this was not changed by you, try resetting it.</p>
                                                   </div>
                                            </div>
                                ");    
                            }
                            $mail->Body = mailbodynew(base64_decode($_COOKIE[md5('TEMP_FMAIL')]));
                            $mail->addAddress($target_mail);
                            $mail->Send()
                            ?>
                                <script>
                                    alert('Your Password is now changed, Sign in to continue.');
                                    window.location = "start.php";
                                </script>
                            <?php
                        }else{
                            echo "ERROR CHANGING PASSWORD";
                        }
                    }else{
                        echo "ERROR";
                    }
                }else{
                    ?><script>
                    alert('ERROR');
                        window.location = "start.php";
                    </script><?php
                }
            }

            if (isset($_POST['done']) && isset($_COOKIE[md5('FOTP')]) && isset($_COOKIE[md5('TEMP_FMAIL')])){
                $send_mail = false;
                if ($_COOKIE[md5('FOTP')] === md5($_POST['otp'])){
                   ?>
                    <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Change Password - TMINC</title>
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
                                    .requirednotice{color:red;text-align:left;display:none;margin-left:60px;background: #ff00004d;
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
                    </head>
                    <body>
                                    <div class="box">
                                    <img src="assets/icon.png" class="logo"><br>
                                    <h2>Change Password</h2>
                                    <span>Reset Password to recover account</span>
                                    <span style="border: 1px solid #ddd;
                                    width: fit-content;
                                    display: inherit;
                                    border-radius: 11px;
                                    padding: 6px;
                                }"><?php echo base64_decode($_COOKIE[md5('TEMP_FMAIL')]); ?></span>
                                        <form action="" method="post" id="change_password">
                                            <input type="password" name="cp" id="cp" placeholder="New Password"><br>
                                            <span class="requirednotice" id="reqcp">Above Field Is Required!</span>
                                            <input type="password" name="cop" id="cop" placeholder="Confirm Password"><br>
                                            <span class="requirednotice" id="reqcop">Above Field Is Required!</span>
                                            <input type="checkbox" name="reset_password" style="display:none;" checked>
                                        </form>
                                        <button class="submit" id="done">Done</button>
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
                                                    document.getElementById("change_password").submit();
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

                    $do_more = false;
                }else{
                    ?><div style="    background: red;
                    padding: 12px;
                    color: white;
                    position: fixed;
                    width: 100%;
                    top: 0;
                    text-transform: uppercase;">Incorrect OTP</div><?php
                }
            }
            include('cred.php');
            if (!isset($do_more)){
            $target_mail = base64_decode($_COOKIE[md5("FORGOT_MAIL")]);
            if ($conn = mysqli_connect($server, $user, $pass, $db)){
                $sql = "SELECT * FROM `users` WHERE `mail` LIKE '".base64_encode($target_mail)."'";
                if ($check = mysqli_query($conn, $sql)){
                    if (0 < mysqli_num_rows($check)){
                        while($ros = mysqli_fetch_array($check)){
                            $name = base64_decode($ros['name']);
                        }
                        if (!isset($send_mail)){
                        $otp = rand(100000, 999999);
                            setcookie(md5("FOTP"), md5($otp), time() + 1200, "/"); //SAVE FOR 20 MIN ONLY
                            setcookie(md5("TEMP_FMAIL"), base64_encode($target_mail), time() + 1200, "/"); //SAVE FOR 20 MIN ONLY
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
                                                    <p style='margin:10px;'>Your OTP for Restting Password<br></p>
                                                    <h2>T - {$otp}</h2>
                                                    <p style='margin:20px;line-height:25px;text-align:justify'>This is for One Use only, this OTP is valid for 20 Minutes only. Enter the OTP provided above in the opened page and verify your E-Mail Address. Please do not share this OTP with anybody, this may affect your privacy.</p>
                                                    <p style='margin:20px;line-height:25px;text-align:justify'>Download or Open WebApp from <a href='http://tminc.ml/apps'>here.</a></p>
                                                    <p style='margin:20px;line-height:25px;text-align:center'>By creating account on TMINC you agree to our Privacy Policy, which can be accessed on our <a href='http://tminc.ml'>official website</a>.</p>
                                                </div>
                                            </div>
                                ");    
                            }
                            $mail->Body = mailbody($name, $otp);
                            $mail->addAddress($target_mail);
                            if ($mail->Send()){
                                echo "";
                               
                            }else{
                                ?><script>
                                    alert('Due to heavy traffic on OTP server, we can\'t process your request, please try again after 24 hrs.');
                                    window.location = "start.php";
                                </script><?php
                            }
                        }else{
                            echo "";    
                        }


?><!DOCTYPE html>
                                <html lang="en">
                                <head>
                                    <meta charset="UTF-8">
                                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                    <title>Forgot Password? - TMINC</title>
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
                                    <h2>Forgot Password?</h2>
                                    <span>Verify E-Mail to recover account</span>
                                    <noscript><strong>Please enable JavaScript in your browser or upgrade to latest browser to use ths page.</strong></noscript>
                                    <form action="" method="post">
                                        <p>OTP is sent to <strong><?php echo $target_mail; ?></strong>, please enter the 6 digit OTP below. If OTP is not found check Spam / Snoozed / Social folders too. If still not found, wait for a while.</p>
                                        <strong>T</strong>&nbsp;-&nbsp;<input type="text" name="otp" id="otp" placeholder="Enter OTP" required><br>
                                        <input type="submit" value="Done" name="done">
                                    </form>
                                </div>
                                </body>
                                </html>
                                <?php
                    }else{
                        ?>
                            <script>
                                alert('Account Not Found');
                                window.location="start.php";
                            </script>
                        <?php
                    }
                }else{
                    echo "ERROR CROSS CHECKING";
                }
            }else{
                echo "ERROR CONNECTING...";
            }
        }
                                ?>
<?php

?>