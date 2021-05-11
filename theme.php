<?php
ob_start();
include('lang.php');
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
    <title><?php prl("थीम के रंग", "Shop Dashboard"); ?></title>
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
<?php
    include('nav.php');
    $_COOKIE['shop'] = "1";
?>
<main>
<?php
                include('cred.php');
                $con = mysqli_connect($server, $user, $pass, $db);
                $sql = "SELECT `color` FROM `shops` WHERE `loc` LIKE '".base64_decode($_COOKIE['Id'])."'";
                if($result = mysqli_query($con, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            $col = $row[0];
                        if ($col === ""){
                            echo "";
                        }else{
                            $col = explode("hash", $col);
                        }
                    }
                }
            }
?>
    <form action="" method="POST">
    <table>
            <tr>
                <td>
        <label><?php prl("हैडर का रंग - ", "Header Colour: "); ?></label>
        </td><td><input type="color" name="header" value="#<?php if ($col === ""){
                    echo "404040";
                }else{
                    echo $col[1];   
                }?>"></td></tr>
                <tr>
                <td>
        <label><?php prl("पीछे का रंग - ", "Background Colour: "); ?></label>
        </td>
        <td><input type="color" name="bg" value="#<?php if ($col === ""){
                    echo "ffffff";
                }else{
                    echo $col[2];   
                }?>"></td></tr>
                <tr>
                <td>
        <label><?php prl("मूल्य का रंग - ", "Price Colour: "); ?></label>
        </td>
        <td><input type="color" name="price" value="#<?php if ($col === ""){
                    echo "008000";
                }else{
                    echo $col[3];   
                }?>"></td></tr>
                <tr><td>
        <label><?php prl("ढूंढ़ने के डब्बे का रंग - ", "Search-Box Colour: "); ?></label></td><td><input type="color" name="sb" value="#<?php if ($col === ""){
                    echo "ffffff";
                }else{
                    echo $col[4];   
                }?>"></td></tr>
                <tr>
                <td>
        <label><?php prl("दूकान के नाम का रंग - ", "Shop Name Colour: "); ?></label></td><td><input type="color" name="sn" value="#<?php if ($col === ""){
                    echo "ffffff";
                }else{
                    echo $col[5];   
                }?>"></td></tr>
                <tr><td>
        <label><?php prl("सूचि के आइटम के पीछे का रंग - ", "List Item Background Colour: "); ?></label></td><td><input type="color" name="libg" value="#<?php if ($col === ""){
                    echo "ffffff";
                }else{
                    echo $col[6];   
                }?>"></td></tr>
                <tr><td>
        <label><?php prl("बटन का रंग - ", "Button Colour: "); ?></label></td><td><input type="color" name="btn" value="#<?php if ($col === ""){
                    echo "ef6c00";
                }else{
                    echo $col[7];   
                }?>"></tr>
                <tr><td>
        <label><?php prl("होवर करने पर छाव का रंग - ", "Hover Shadow Colour: "); ?></label></td><td><input type="color" name="hshadow" value="#<?php if ($col === ""){
                    echo "404040";
                }else{
                    echo $col[8];   
                }?>"></td></tr>
                <tr><td>
        <label><?php prl("होवर करने पे बटन का रंग - ", "Hover Button Colour: "); ?></label></td><td><input type="color" name="hbtn" value="#<?php if ($col === ""){
                    echo "a75a16";
                }else{
                    echo $col[9];   
                }?>"></td></tr>
                <tr><td>
        <label><?php prl("लेख का रंग - ", "Text Colour: "); ?></label></td><td><input type="color" name="txt" value="#<?php if ($col === ""){
                    echo "000000";
                }else{
                    echo $col[10];   
                }?>"></td></tr>
                <tr><td>
        <label><?php prl("लिंक का रंग - ", "Href Colour: "); ?></label></td><td><input type="color" name="href" value="#<?php if ($col === ""){
                    echo "404040";
                }else{
                    echo $col[11];   
                }?>"></td></tr>
                <tr><td>
        <label><?php prl("बटन के लेख का रंग - ", "Button Text Colour: "); ?></label></td><td><input type="color" name="btntxt" value="#<?php if ($col === ""){
                    echo "ffffff";
                }else{
                    echo $col[12];   
                }?>"></td></tr>

<tr><td>
        <label><?php prl("डिलीट बटन का रंग - ", "Delete Icon Colour: "); ?></label></td><td><input type="color" name="delete" value="#<?php if ($col === ""){
                    echo "000";
                }else{
                    echo $col[13];   
                }?>"></td></tr>
                <tr><td>
        <input type="submit" name="change" value="<?php prl("रंग बदले", "Change Colours"); ?>"></td><td><input type="submit" value="<?php prl("पहले जैसा करे", "Set as Default"); ?>" name="default"></tr>
        </table>
    </form>
    </main>
</body>
</html>
<?php
    }
?>
<?php
    if (isset($_POST['change'])){
        $array = array($_POST['header'], $_POST['bg'], $_POST['price'], $_POST['sb'], $_POST['sn'], $_POST['libg'], $_POST['btn'], $_POST['hshadow'], $_POST['hbtn'], $_POST['txt'], $_POST['href'], $_POST['btntxt'], $_POST['delete']);
        $json = "";
        foreach($array as $each){
            $json = $json."".$each;
        }
        $json = str_replace("#", "hash", $json);
        $sql = "UPDATE `shops` SET `color`='".$json."' WHERE `loc` LIKE '".base64_decode($_COOKIE['Id'])."'";
        include('cred.php');
        $con = mysqli_connect($server, $user, $pass, $db);
        if ($con){
            $run = mysqli_query($con, $sql);
            if ($run){
                ?>
                    <script>
                        alert('Colors Updated!');
                        window.location="dashboard.php";
                    </script>
                <?php
            }else{
                echo "<font color=red>Update Error</font>";
                echo "\n".$sql;
            }
        }else{
            echo "<font color=red>Error</font>";
        }
    }
?>
<?php
    if (isset($_POST['default'])){
        $sql = "UPDATE `shops` SET `color`='' WHERE `loc` LIKE '".base64_decode($_COOKIE['Id'])."'";
        include('cred.php');
        $con = mysqli_connect($server, $user, $pass, $db);
        if ($con){
            $run = mysqli_query($con, $sql);
            if ($run){
                ?>
                    <script>
                        alert('Colors Updated!');
                        window.location="dashboard.php";
                    </script>
                <?php
            }else{
                echo "<font color=red>Update Error</font>";
                echo "\n".$sql;
            }
        }else{
            echo "<font color=red>Error</font>";
        }
    }
?>