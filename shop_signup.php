<?php
ob_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Shop</title>
    <link rel="icon" type="image/png" href="http://tminc.ml/images/7.png">
    <meta name="robots" content="noindex" />
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
    body{background:#ededed;}
    input[type="text"],input[type="email"],input[type="password"],input[type="tel"],textarea{margin:5px;width:90%;padding:13px 15px;font-size:16px;text-align:left;color:#404040;border-radius:4px;border:1px solid #ddd;padding-top:10px;padding-bottom:10px;}
    input[type="submit"]{float:right;cursor:pointer;outline:0;background:#311B92;color:#fff;font-family: 'Noto Sans', sans-serif;border:0;width:85px;height:40px;border-radius:5px;}
    .left, input[type="submit"]{margin:20px;}
    @media screen and (max-width:450px){
        .box{border:0;width:100%;margin-top:0;}
    }
</style>
    <div class="box">
        <img src="assets/icon.png" class="logo"><br>
        <h2>Sign Up</h2>
        <span>to continue to TMINC Store</span>
        <form action="" method="POST">
            <input type="text" name="name" placeholder="Name*" required><br>
            <input type="email" name="mail" placeholder="E-Mail*" required><br>
            <input type="tel" name="phone" placeholder="Contact Number (Without STD Code)*" required><br>
            <input type="password" name="cp" placeholder="Create Password*" required><br>
            <input type="password" name="cop" placeholder="Confirm Password*" required><br>
            <textarea placeholder="Full Address*" name="address" style="height:105px;"></textarea>
            <input type="hidden" name="shop" value="<?php echo $_GET['s']; ?>">
            <p>Not your computer? Use a private browsing window to sign up.
        <div>
    <a href="signin.php?s=<?php 
        if (isset($_GET['s'])){
            echo $_GET['s'];
        }else{
            echo "%%";
        }
    ?>" class="left">Already have an account? Login</a><input type="submit" value="Next" name="create"> </form>
        </div>
    </div>
</body>
</html>
<?php
    if (isset($_POST['create'])){
        include('cred.php');
        $sql = "SELECT * FROM `users` WHERE `mail` LIKE '".$_POST['mail']."'";
        $con = mysqli_connect($server, $user, $pass, $db);
        if($result = mysqli_query($con, $sql)){
            if(mysqli_num_rows($result) > 0){
                ?>
                    <script>
                        alert('Account Already Exist with this E-Mail');
                    </script>   
                <?php
                // Free result set
                mysqli_free_result($result);
            } else{
                if ($_POST['cp'] === $_POST['cop']){
                    $conn = mysqli_connect($server, $user, $pass, $db);
                $sqli = "INSERT INTO `users`(`id`, `name`, `mail`, `password`, `phone`, `address`) VALUES (NULL,'".str_replace("'", " ", $_POST['name'])."','".str_replace("'", " ", $_POST['mail'])."','".str_replace("'", " ", $_POST['cp'])."','".str_replace("'", " ", $_POST['phone'])."','".str_replace("'", " ", $_POST['address'])."')";
                    $new_user = mysqli_query($conn, $sqli);
                    if ($new_user){
                        setcookie("Mail", $_POST['mail'], time() + (86400 * 30), "/"); // 86400 = 1 day 
                    setcookie("Pass", $_POST['cp'], time() + (86400 * 30), "/"); // 86400 = 1 day      
                    setcookie("Address", $_POST['address'], time() + (86400 * 30), "/"); // 86400 = 1 day 
                    setcookie("Phone", $_POST['phone'], time() + (86400 * 30), "/"); // 86400 = 1 day  
                    setcookie("Name", $_POST['name'], time() + (86400 * 30), "/"); // 86400 = 1 day  
                    ?>
                        <script>
                            window.location="index.php?s=<?php echo $_POST['shop']; ?>";
                        </script>
                    <?php
                    }else{
                        alert('There was an error while creating your account.');
                    }
            }else{
                ?>
                    <script>
                        alert('Entered Password Doesn\'t Match');
                        window.location="signup.php?s=<?php $_POST['shop']?>";
                    </script>
                <?php
            }
        }
        } else{
            echo "ERROR: Could not able to execute ".$sql;
        }
    }
?>