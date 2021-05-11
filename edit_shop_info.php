<?php
ob_start();
include('lang.php');
include_once('cred.php');
$connect_to_verify = mysqli_connect($server, $user, $pass, $db);
if ($connect_to_verify){
    $query_to_verify = "SELECT * FROM `shops` WHERE `mail` LIKE '".$_COOKIE['Mail']."' AND `password` LIKE '".base64_decode($_COOKIE['Pass'])."'";
    if ($get_shop_from_table = mysqli_query($connect_to_verify, $query_to_verify)){
        if (0 < mysqli_num_rows($get_shop_from_table)){
?><?php
        if (!isset($_COOKIE['Id'])){
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
    <?php
        include('head.php');
    ?>
    <title><?php prl("दूकान की जानकारी बदले", "Edit Shop Info"); ?> &bull; <?php prl("मिंक", "TMINC"); ?></title>
    <?php
        include('header.php');
        echo "\n";
    ?>
</head>
<body><?php 
    include('nav.php');
?>
<div class="form-up">
<?php
    include('cred.php');
    $conn = mysqli_connect($server, $user, $pass, $db);
    if ($conn){
        $sql = "SELECT * FROM `shops` WHERE `loc` LIKE '".base64_decode($_COOKIE['Id'])."'";
        if ($call = mysqli_query($conn, $sql)){
            if (mysqli_num_rows($call) > 0){
                while ($row = mysqli_fetch_array($call)){
                    $name = base64_decode($row['owner']);
                    $shop = base64_decode($row['name']);
                    $address = base64_decode($row['address']);
                    $phone = base64_decode($row['phone']);
                }
            }else{
                ?>
                    <script>
                        alert('<?php prl("कृपया लॉग आउट करके फिरसे लॉग इन करे", "Please logout and login again."); ?>');
                        window.location = "dashboard.php";
                    </script>
                <?php
            }
        }else{
            echo "ERROR FETCHING YOUR DETAILS.";
        }
    }else{
        echo "ERROR CONNECTING KRAYA";
    }
?>
<form action="" method="post">
            <input type="text" name="name" value="<?php echo $shop; ?>" placeholder="<?php prl("दूकान का नाम", "Shop Name*"); ?>" required><br>
            <input type="text" name="phone" value="<?php echo $phone; ?>" placeholder="<?php prl("दूकान का दूरभाष", "Phone Number*"); ?>" required><br>
            <div style="margin:12px;font-size:12px;"><span><?php prl("फोन नंबर में एक व्हाट्सएप अकाउंट होना चाहिए जो उपयोगकर्ताओं को आप तक पहुंचने में मदद करे। नंबर बिना (+91) के दर्ज करें", "Phone number must have a WhatsApp account helping users to reach you. Enter number without (+91)"); ?></span></div>    
            <input type="text" name="owner" value="<?php echo $name; ?>" placeholder="<?php prl("दूकान के मालिक का नाम", "Owner Name*"); ?>" required><br>
            <textarea name="address" placeholder="<?php prl("दूकान का पता", "Shop Address*"); ?>" required><?php echo $address; ?></textarea>
            <input type="submit" value="Save" name="save">
</form>
</div>
</body>
</html>
<?php
        }
?>
<?php
    if (isset($_POST['save'])){
        include('cred.php');
        if ($est = mysqli_connect($server, $user, $pass, $db)){
            $sql = "UPDATE `shops` SET `owner` = '".base64_encode($_POST['owner'])."', `name`='".base64_encode($_POST['name'])."', `address`='".base64_encode($_POST['address'])."', `phone`='".base64_encode($_POST['phone'])."'";
            if (mysqli_query($est, $sql)){
                ?><script>
                    alert('<?php prl('बदलाव सुरक्षित कर दिया गया है।', 'Changes Saved'); ?>');
                    window.location="dashboard.php";
                </script><?php
            }else{
                ?>
                <script>
                    alert("<?php prl("बदलाव सुरक्षित नहीं किये जा सके है", "Error saving changes."); ?>");
                    window.location="dashboard.php";
                </script>
                <?php
            }
        }else{
            prl("एरर", "ERROR!");
        }
    }

}else{
    ?><script>
        document.cookie = "Id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Mail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Address=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Phone=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                            alert("<?php prl("आप को साइन आउट किया जा रहा है", "You are now logged out."); ?>");
        window.location = "shop_login.php";
    </script><?php
}
}else{
?>
<script>
alert('<?php prl("सर्वर एरर", "Server Error"); ?>');
document.cookie = "Id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Mail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Address=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Phone=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
</script>
<?php 
}
}else{
?>
<script>
alert('<?php prl("सर्वर एरर", "Server Error"); ?>');
document.cookie = "Id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Mail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Address=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Phone=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
</script>
<?php
}
?>