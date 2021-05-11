<?php
ob_start();
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
        <h2>Sign in</h2>
        <span>to continue to TMINC Store - SHOP ADMIN LOGIN</span>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="pass" placeholder="Password" required><br>
            <a href="forgot_shop_password.php" class="left" style="margin-top:1px;">Forgot password?</a>
            <?php
                if (isset($_GET['mw'])){
                    echo "<article class='err'>You have entered wrong E-Mail, please try again.</article>";
                }
                if (isset($_GET['pw'])){
                    echo "<article class='err'>You have entered wrong Password, please try again.</article>";
                }
            ?>
            <p>Sign in to TMINC STORE SHOP ADMIN PANEL with respective details.</p>
        <div>
    <a href="register.php" class="left">Register Shop</a><input type="submit" value="Next" name="signin"> </form>
        </div>
    </div>
</body>
</html>
<?php

    if (isset($_POST['signin'])){
        $sql = "SELECT * FROM `shops` WHERE `mail` LIKE '".base64_encode($_POST['email'])."' AND `password` LIKE '".md5($_POST['pass'])."'";
        include('cred.php');
        $con = mysqli_connect($server, $user, $pass, $db);
        if ($con){
            if ($result = mysqli_query($con, $sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                    setcookie("Mail", $row['mail'], time() + (86400 * 30), "/"); // 86400 = 1 day 
                    setcookie("Pass", base64_encode($row['password']), time() + (86400 * 30), "/"); // 86400 = 1 day      
                    setcookie("Address", $row['address'], time() + (86400 * 30), "/"); // 86400 = 1 day 
                    setcookie("Phone", $row['phone'], time() + (86400 * 30), "/"); // 86400 = 1 day  
                    setcookie("Name", $row['name'], time() + (86400 * 30), "/"); // 86400 = 1 day  
                    setcookie("Type", "Shop", time()+(86400 * 30), "/"); // 86400 = 1 day 
                    setcookie("Id", base64_encode($row['loc']), time()+(86400 * 30), "/"); // 86400 = 1 day 
                            ?>
                               
                            <?php
                    }?>
                    <script>
                    window.location="dashboard.php";
                </script><?php
                }else{
                    ?>
                        <script>
                            alert('Wrong E-Mail or Password');
                            window.location="";
                        </script>
                    <?php
                }
            }

        }else{
            echo "<font color='red'>Error</font>";
        }
    }
?>