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
    <title><?php prl("दूकान का डैशबोर्ड", "Shop Dashboard"); ?></title>
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

            <?php prl("आपकी ऑनलाइन दूकान का लिंक - ", "Your Online Shop URL:"); ?>         <a href=" " 
  target="popup" 
  onclick="window.open('/?s=<?php echo base64_decode($_COOKIE['Id']); ?>','popup','width=600,height=600,scrollbars=no,resizable=yes'); return false;">
  http://kraya.tminc.ml?s=<?php echo base64_decode($_COOKIE['Id']); ?>
</a><br>
<strong><?php prl("दूकान का कोड - ", "Shop Code:&nbsp;"); ?></strong><?php echo base64_decode($_COOKIE['Id']); ?>
           <!-- <a href="link.php">Link Your Own Domain (URL) with your Shop</a>-->
        </span>
</center>
<br>
        <a href="shop.php">
        <div class="l-i">
            <ul>
                <li class="material-icons">
                    dvr
                </li>
                <li>
                <?php prl("ऑर्डर्स", "Orders"); ?>
                </li>
            </ul>
        </div>
        </a>


        <?php if ("false" === false){ ?>
        <a href="edit_section.php">
        <div class="l-i">
            <ul>
                <li class="material-icons">
                dynamic_feed
                </li>
                <li>
                Home Feed
                </li>
            </ul>
        </div>
        </a>
        <?php } ?>

        <a href="new.php">
        <div class="l-i">
            <ul>
                <li class="material-icons">
                    create
                </li>
                <li>
                <?php prl("नया उत्पाद", "Add Product"); ?>
                </li>
            </ul>
        </div>
        </a>

        <a href="edit.php">
        <div class="l-i">
            <ul>
                <li class="material-icons">
                dehaze
                </li>
                <li>
                <?php prl("उत्पाद की जानकारी बदले", "Edit Product"); ?>
                </li>
            </ul>
        </div>
        </a>

        <a href="header_shop.php">
        <div class="l-i">
            <ul>
                <li class="material-icons">
                    code
                </li>
                <li>
                <?php prl("हैडर कोड", "Header Code"); ?>
                </li>
            </ul>
        </div>
        </a> 
        <a href="edit_shop_info.php">
        <div class="l-i">
            <ul>
                <li class="material-icons">
                    feed
                </li>
                <li>
                <?php prl("दूकान की जानकारी बदले", "Edit Shop Info"); ?>
                </li>
            </ul>
        </div>
        </a>
        <a href="theme.php">
        <div class="l-i">
            <ul>
                <li class="material-icons">
                    color_lens
                </li>
                <li>
                <?php prl("थीम कलर", "Theme Colours"); ?>
                </li>
            </ul>
        </div>
        </a>
        <a style="cursor:pointer" onclick="document.getElementById('langdropoverlay').style.display = 'block';">
        <div class="l-i">
            <ul>
                <li class="material-icons">
                    language
                </li>
                <li>
                <?php prl("भाषा", "Language"); ?>
                </li>
            </ul>
        </div>
        </a>
        <a onclick="alert('<?php prl('नमस्ते! हम प्रत्येक मेल को ध्यान से पढ़ते है पर सबका जवाब नहीं देते है, आप यहाँ पर सुझाव दे सकते है, कोई भी समस्या के लिए \'बग के बारे में सूचित करे\' पर जाए।', 'Hi! We read every mail carefully but we may not respond to each mail, you can give suggestions here, for any issue, navigate to  \'Report Bug\' option below.'); ?>');window.location='mailto:info.themorningindia@gmail.com'" target="_blank">
            <div class="l-i">
                <ul>
                    <li class="material-icons">mail</li>
                    <li>
                        <?php prl("मिंक को लिखे", "Write to Developer - <STRONG>TMINC</STRONG>"); ?>
                    </li>
                </ul>
            </div>
        </a>
        <?php include('releasenotes.php'); ?>
        <a id="show-release-notes-button">
            <div class="l-i" style="cursor:pointer">
                <ul>
                    <li class="material-icons">info</li>
                    <li>
                    <?php prl("रिलीज़ नोट्स - क्या नया है?", "Release Notes - What's New?"); ?>
                    </li>
                </ul>
            </div>
        </a>
        <a href="http://tminc.ml/bug?app=Kraya Shop">
        <div class="l-i">
            <ul>
                <li class="material-icons">
                    bug_report
                </li>
                <li>
                <?php prl("बग के बारे में सूचित करे", "Report Bug"); ?>
                </li>
            </ul>
        </div>
        </a>
        <a onclick="logoutshop()">
            <div class="l-i">
                <ul>
                    <li class="material-icons">logout</li>
                    <li>
                        <?php prl("साइन आऊट", "Log Out"); ?>
                    </li>
                </ul>
            </div>
        </a>
        <script>
            function logoutshop(){
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
            }
        </script>
           <?php
    $code= "";
        ?>

       <!--         <a href="http://api.html2pdfrocket.com/pdf?value=http://tminc.ml/qr.php?s=<?php echo $_COOKIE['Id']; ?>&name=<?Php echo $_COOKIE['Name'];?>&apikey=74749014-a89b-40f6-ba5d-5c03fd8379b6">
        <div class="l-i">
            <ul>
                <li class="material-icons">
                    qr_code
                </li>
                <li>
                Get QR Code
                </li>
            </ul>
        </div>
        </a>   -->    
    </main>
    <script src="java/release.js"></script>
</body>
</html>
<?php
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