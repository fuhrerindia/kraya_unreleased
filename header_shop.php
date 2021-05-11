<?php
ob_start();
include('lang.php');
include_once('cred.php');
$connect_to_verify = mysqli_connect($server, $user, $pass, $db);
if ($connect_to_verify){
    $query_to_verify = "SELECT * FROM `shops` WHERE `mail` LIKE '".$_COOKIE['Mail']."' AND `password` LIKE '".base64_decode($_COOKIE['Pass'])."'";
    if ($get_shop_from_table = mysqli_query($connect_to_verify, $query_to_verify)){
        if (0 < mysqli_num_rows($get_shop_from_table)){
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/add_edit.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        include('head.php');
    ?>
    <title><?php prl("किराना ख़रीदे", "Buy Kirana"); ?> &bull; <?php prl("मिंक", "TMINC"); ?></title>
    <?php
        include('header.php');
        echo "\n";
    ?>
    <style>

        main{text-align:center;width:100%;}
        .product img{display:inline-block;margin:3px;width:80%;height:auto;}
        .product h2{font-family:sans-serif;color:#272727;font-size:20px;margin:3px;}
        .product:hover{box-shadow: 0 0 51px #000;}
        .product{display:inline-block;transition:0.3s;text-align:center;width:200px;border:1px solid #ddd;box-shadow:0 0 8px #aaa9a9;padding:3px;margin:10px;border-radius:13px;}
        .product button{    width: 60%;margin:3px;
    border: 0;transition:0.3s;
    padding: 5px;
    background: <?php echo $color; ?>;
    color: #fff;
    cursor:pointer;
    border-radius: 9px;}
    .product span{color:green;font-family:sans-serif;}
    .product button:hover{background:#a75a16}
    .noti{    position: fixed;
    bottom: 0;
    right: 0;
    height: 25px;
    background: #FF9800;
    padding: 20px;
    border-radius: 20px;
    color: #fff;
    font-family: sans-serif;
    margin: 10px;
    box-shadow: 0 0 20px #666;
}*{font-family:sans-serif}
@media screen and (max-width:500px){
    textarea{width:90% !important;margin:10px !important;}
}
    </style>
</head>
<body style="text-align:center"><?php 
    include('nav.php');
?>
<?php
    include('cred.php');
    $sql = "SELECT `header` FROM `shops` WHERE `mail` LIKE '".$_COOKIE['Mail']."'";
    $con = mysqli_connect($server, $user, $pass, $db);
    if ($con){
        if($result = mysqli_query($con, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    ?>
                    <form action="" method="POST">
                    <textarea placeholder="<?php prl("यहाँ हैडर कोड पेस्ट करे या हैडर कोड डाले", "Enter or Paste Header Code Here"); ?> " name= "header" style="width:60%;height:200px;margin:20px;padding:20px"><?php echo str_replace("<%up%>", "'", $row[0]); ?></textarea>
                    <br><input type="submit" name="update" value="<?php prl("कोड बदले", "Update Code"); ?>"></form><?php
                }
            }
        }
    }else{
        echo "<font color=red>".rrl("कुछ गड़बड़ हो गई।", "Error")."</font>";
    }
?>
</body>
</html>
<?php
    if(isset($_POST['update'])){
        $code = str_replace("'", "<%up%>", $_POST['header']);
        $sql = "UPDATE `shops` SET `header`='".$code."' WHERE `mail` LIKE '".$_COOKIE['Mail']."'";
        $con = mysqli_connect($server, $user, $pass, $db);
        if ($con){
            $run = mysqli_query($con, $sql);
            if ($run){
                ?>
                    <script>
                        window.location="dashboard.php";
                    </script>
                <?php
            }
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