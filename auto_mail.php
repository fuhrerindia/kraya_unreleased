<?php
ob_start();
?><?php
    if (!isset($_COOKIE['Type'])){
        ?>
            <script>
                window.location="shop_login.php";
            </script>
        <?php
    }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/add_edit.css">
    <title>Shop Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <style>
        .l-i{width: 60%;transition:0.3s;
    display: inline-block;
    height: 60px;
    box-shadow: 0 0 10px #ddd;
    border-radius: 10px;
    padding: 10px;margin:10px;
    text-align: left;}
    .l-i ul{    list-style: none;
    display: flex;
    margin: 19px;}
    .l-i ul li{margin-right:10px;}
    body a{color:#404040;text-decoration:none;}
    .l-i:hover{box-shadow:0 0 20px #000;}
    input[type="text"], input[type="password"]{    width: 70%;
    border-radius: 11px;
    height: 35px;
    border: 1px solid #404040;
    padding-left: 11px;
    margin: 11px;}
    @media screen and (max-width:480px){
        .l-i{width:100%;margin:0;border-radius:0;box-shadow:none;border-bottom:1px solid #ddd}
    }
    </style>
    <?php
        include('header.php');
    ?>
</head>
<body>
<!--<img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://shop.tminc.ml?s=25">-->
<?php
    include('nav.php');
    $_COOKIE['shop'] = "1";
?>
<main>
<center>
        <span><br>

            Your Online Shop URL:         <a href=" " 
  target="popup" 
  onclick="window.open('/?s=<?php echo base64_decode($_COOKIE['Id']); ?>','popup','width=600,height=600,scrollbars=no,resizable=yes'); return false;">
  http://kraya.tminc.ml?s=<?php echo base64_decode($_COOKIE['Id']); ?>
</a><br>
<strong>Shop Code:&nbsp;</strong><?php echo base64_decode($_COOKIE['Id']); ?>
           <!-- <a href="link.php">Link Your Own Domain (URL) with your Shop</a>-->
        </span>
</center>
<br>
    <?php 
        include('cred.php');
        if ($con = mysqli_connect($server, $user, $pass, $db)){
            $sql = "SELECT * FROM `shops` WHERE `loc` LIKE '".base64_decode($_COOKIE['Id'])."'";
            if ($data = mysqli_query($con, $sql)){
                while ($row = mysqli_fetch_array($data)){
                    $mail = $row['int_mail'];
                    $pass = $row['int_pass'];
                    $hindi = $row['hindi'];
                }
            }else{
                ?><script>
                    console.warn("SOMETHING WENT WRONG WHILE FETCHING DATA FROM SERVER.");
                </script><?php
            }
        }else{
            ?>
                <script>
                    console.warn("SOMETHING WENT WRONG WHILE CONNECTING SERVER.");
                </script>
            <?php
        }
    ?>
    <form action="" method="post">
        <input type="text" name="email" placeholder="E-Mail Address" value="<?php echo base64_decode($mail); ?>" required><br>
        <input type="password" name="password" placeholder="E-Mail Password" value="<?php echo base64_decode($pass); ?>" required><br>
            <input type="submit" value="Save" name="save" style="    margin: 20px;
    width: 40%;
    height: 40px;
    cursor: pointer;
    background: #404040;
    color: #fff;
    width: fit-content;
    height: 40px;
    width: 88px;
    border-radius: 13px;
    border: 0;">
    </form>
    </main>
</body>
</html>
<?php
    }
?>
<?php
    if (isset($_POST['save'])){

        // SAVE LANGUAGE IN VARIABLE AS STRING
        if (isset($_POST['hindi'])){
            $lang = "checked";
        }else{
            $lang = "";
        }
        include('cred.php');

        $sqltosave = "UPDATE `shops` SET `int_mail`='".base64_encode($_POST['email'])."', `int_pass`='".base64_encode($_POST['password'])."', `hindi`='".$lang."' WHERE `loc` LIKE '".base64_decode($_COOKIE['Id'])."'";
        if ($connect = mysqli_connect($server, $user, $pass, $db)){
            if (mysqli_query($connect, $sqltosave)){
                ?><script>alert('Credentials Saved, Push Mails will be sent to customers about order updates and you will receive mail whenever a new order is placed or order is cancelled.');
                window.location="dashboard.php";
                </script><?php
            }else{
                echo "ERROR SAVING CREDENTIAL, REPORT BUG.";
            }
        }else{
            echo "ERROR IN CONNECTING DATABASE, REPORT THIS BUG.";
        }
    }
?>