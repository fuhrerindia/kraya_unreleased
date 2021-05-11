<?php
ob_start();
include('cred.php');
include('lang.php');
if ($con = mysqli_connect($server, $user, $pass, $db)){
    $sql = "SELECT * FROM `users` WHERE `mail` LIKE '".$_COOKIE['Mail']."' AND `password` LIKE '".base64_decode($_COOKIE['Pass'])."'";
    if ($var = mysqli_query($con, $sql)){
        if (0 < mysqli_num_rows($var)){
            while ($rows = mysqli_fetch_array($var)){
            $name = $rows['name'];
            $mail = $rows['mail'];
            $phone = $rows['phone'];
            $address = $rows['address'];
            }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/nav.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php prl("अकाउंट", "Account"); ?></title>
    <meta name="robots" content="noindex" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <?php
include('nav.php');
?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');
    *{color:#666;text-align:center;margin:0;font-size:14px;padding:0;font-family: 'Noto Sans', sans-serif;}
    .box{padding:20px;margin-top:9vh;padding-bottom:36px;border:1px solid #ddd;border-radius:8px;width:445px;display:inline-block;background:#fff;}
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
    input[type="text"], input[type="email"]{background:#ededed;}
    @media screen and (max-width:450px){
        .box{border:0;width:81%;margin-top:0;}
    }
</style>
    <div class="box">
        <img src="assets/icon.png" class="logo"><br>
        <h2><?php prl("उपयोगकर्ता जानकारी", "User Settings"); ?></h2>
        <span><?php prl("मिंक क्राया लिए", "for TMINC Kraya"); ?></span>
        <form action="" method="POST">
            <input type="text" name="name" placeholder="Name*" value="<?php echo base64_decode($name); ?>" readonly><br>
            <input type="email" id="mailin" name="mail" placeholder="E-Mail*" value="<?php echo base64_decode($mail); ?>" readonly required><br>
            <input type="tel" name="phone" placeholder="<?php prl("दूरभाष अंक (बिना एस. टी. डी. संख्या के)*", "Contact Number (Without STD Code)*"); ?>" value="<?php echo base64_decode($phone);?>" required><br>
            <textarea placeholder="<?php prl("पूरा पता", "Full Address*"); ?>" name="address" style="height:105px;"><?php echo base64_decode($address); ?></textarea>
        <div>
    <input type="submit" value="<?php prl("जानकारी बदले", "Change"); ?>" name="create"> </form>
        </div>
    </div>
</body>
</html>
<?php
    if (isset($_POST['create'])){
      $naddress = base64_encode($_POST['address']);
      $nphone = base64_encode($_POST['phone']);
      $sql = "UPDATE `users` SET `phone`='".$nphone."',`address`='".$naddress."' WHERE `mail` LIKE '".$_COOKIE['Mail']."' AND `password` LIKE '".base64_decode($_COOKIE['Pass'])."'";
      if ($updated = mysqli_query($con, $sql)){
        setcookie('Address', $naddress, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('Phone', $nphone, time() + (86400 * 30), "/"); // 86400 = 1 day

          ?>
            <script>
                alert('Details Updates');
                window.location="";
            </script>
          <?php
      }else{
          ?>
            <script>
                alert('ERROR');
                window.location="";
            </script>
          <?php
      }
    }
?>

<?php
}else{
            //ELSE
            ?>
                <script>
                    document.cookie = "Id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Mail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Address=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Phone=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    alert('Signed Out, Password Changes');
                    <?php
                                if(isset($_GET['s'])){
                                    $s = $_GET['s'];
                                }else{
                                    $s = "%%";
                                }
                            ?>
                            window.location="signin.php?s=<?php echo $s; ?>";
                </script>
            <?php
        }
    }else{
        //ELSE
        ?>
                <script>
                    document.cookie = "Id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Mail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Address=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Phone=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    alert('Signed Out, Password Changes');
                    <?php
                                if(isset($_GET['s'])){
                                    $s = $_GET['s'];
                                }else{
                                    $s = "%%";
                                }
                            ?>
                            window.location="signin.php?s=<?php echo $s; ?>";
                </script>
            <?php
    }
}else{
    //ELSE
    ?>
                <script>
                    document.cookie = "Id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Mail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Address=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Phone=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    alert('Signed Out, Password Changes');
                    <?php
                                if(isset($_GET['s'])){
                                    $s = $_GET['s'];
                                }else{
                                    $s = "%%";
                                }
                            ?>
                            window.location="signin.php?s=<?php echo $s; ?>";
                </script>
            <?php
}
?>