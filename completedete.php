<?php
ob_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp to TMINC</title>
    <link rel="icon" type="image/png" href="http://tminc.ml/images/7.png">
    <meta name="robots" content="noindex" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        .box{border:0;width:81%;margin-top:0;}
    }
</style>
    <div class="box">
        <img src="assets/icon.png" class="logo"><br>
        <h2>Complete Info</h2>
        <span>to place order to TMINC Kraya</span>
        <form action="" method="POST">
            <input type="tel" name="phone" placeholder="Contact Number (Without STD Code)*" value="<?php 
                if (isset($_COOKIE['Phone'])){
                    echo base64_decode($_COOKIE['Phone']);
                }
            ?>" required><br>
            <textarea placeholder="Full Address*" name="address" style="height:105px;" required><?php
                if (isset($_COOKIE['Address'])){
                    echo base64_decode($_COOKIE['Address']);
                }
            ?></textarea>
                    <div>
                    <p>These info is required and will be visible to shop when you order something from them. These info will be hidden once order is delivered/cancelled or order is cancelled by shop or you</p>
    <input type="submit" value="Continue" name="create"> </form>
        </div>
    </div>
</body>
</html>
<?php
    if (isset($_POST['create'])){
        include('cred.php');
        $sql = "UPDATE `users` SET `phone`='".base64_encode($_POST['phone'])."',`address`='".base64_encode($_POST['address'])."' WHERE `mail` LIKE '".$_COOKIE['Mail']."' AND `password` LIKE '".$_COOKIE['Pass']."'";
        $con = mysqli_connect($server, $user, $pass, $db);
        if ($save = mysqli_query($con, $sql)){
            setcookie('Phone', base64_encode($_POST['phone']), time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie('Address', base64_encode($_POST['address']), time() + (86400 * 30), "/"); // 86400 = 1 day
            ?>
            <script>
                window.location='cont.php?s=<?php echo $_GET['s']; ?>';
            </script>
            <?php
        }else{
            ?>
            <script>
            alert('ERROR SAVING DATA');
            </script>
            <?php
        }
        
    }
?>