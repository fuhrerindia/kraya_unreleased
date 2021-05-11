<?php
ob_start();
?><?php
    //$_POST['mail'] = "info@tminc.ml";
    $mail = $_POST['mail'];
    $err = "display:none;";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Password - TMINC</title>
    <link rel="icon" type="image/png" href="fav.png">
    <meta name="robots" content="noindex" />
</head>
<body>
<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');
body{background:#ededed;}
    *{color:#666;text-align:center;margin:0;font-size:14px;padding:0;font-family: 'Noto Sans', sans-serif;}
    .box{padding:20px;margin-top:15vh;padding-bottom:185px;border:1px solid #ddd;border-radius:8px;width:445px;display:inline-block;background:#fff;}
    .logo{height:50px;display:inline-block;margin:40px;margin-bottom:0px}
    h2{color:#202124;margin-bottom:10px;font-size:24px;font-weight:100;}
    p{width:90%;text-align:left;color:red;margin:0px;display:inline-block;}
    a{text-decoration:none;color:#311B92;font-weight:5px}
    .left{float:left;}
    span{display:inline-block;margin:10px;border:1px solid #ddd;width:fit-content;border-radius:10px;padding:3px;padding-left:10px;padding-right:10px;}
    input[type="password"]{width:90%;padding:13px 15px;font-size:16px;text-align:left;color:#404040;border-radius:4px;border:1px solid #ddd;padding-top:10px;padding-bottom:10px;}
    input[type="submit"]{float:right;cursor:pointer;outline:0;background:#311B92;color:#fff;font-family: 'Noto Sans', sans-serif;border:0;width:85px;height:40px;border-radius:5px;}
    .left, input[type="submit"]{margin:20px;}
    .fill{width:100%; text-align:center;}
    @media screen and (max-width:450px){
        .box{border:0;width:100%;margin-top:0;}
    }
</style>
    <div class="box">
        <img src="assets/icon.png" class="logo"><br>
        <h2>Welcome</h2>
        <div class="fill">
        <span><?php echo $mail; ?></span>
        </div>
        <form action="" method="POST">
        <input type="hidden" name="mail" value="<?php echo $mail; ?>">
        <?php
        setcookie(md5("FORGOT_MAIL"), base64_encode($mail), time() + 1200, "/"); //SAVE FOR 20 MIN ONLY
 ?>
        <input type="hidden" name="shop" value="<?php echo $_POST['shop']; ?>">
            <input type="password" name="pass" placeholder="Enter your Password" required><br>
           <p style="<?php echo $err;?>"> Wrong password. Try again </p>
        <div><p></p>
    <a href="forgot_password.php" class="left">Forgot Password?</a><input type="submit" value="Next" name="signed"> </form>
        </div>
    </div>
</body>
</html>
<?php
    if (isset($_POST['signed'])){
        include('cred.php');
        $con = mysqli_connect($server, $user, $pass, $db);
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $sql = "SELECT * FROM `users` WHERE `mail` LIKE '".base64_encode($mail)."' AND `password` LIKE '".md5($pass)."'";
        if($result = mysqli_query($con, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    setcookie("Mail", $row['mail'], time() + (86400 * 30), "/"); // 86400 = 1 day 
                    setcookie("Pass", base64_encode($row['password']), time() + (86400 * 30), "/"); // 86400 = 1 day      
                    setcookie("Address", $row['address'], time() + (86400 * 30), "/"); // 86400 = 1 day 
                    setcookie("Phone", $row['phone'], time() + (86400 * 30), "/"); // 86400 = 1 day  
                    setcookie("Name", $row['name'], time() + (86400 * 30), "/"); // 86400 = 1 day  
                    ?>
                        <script>
                            window.location="index.php?s=<?php echo $_POST['shop']; ?>";
                        </script>
                    <?php 
                    }
                // Free result set
                mysqli_free_result($result);
            } else{
               ?>
                    <script>
                    alert('Wrong E-Mail or Password');
                        window.location="signin.php?s=<?php echo $_POST['shop']; ?>";
                    </script>
               <?php
            }
        } else{
            echo "ERROR: Could not able to execute $sql. ";
        }
    }
?>