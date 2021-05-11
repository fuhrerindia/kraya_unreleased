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
    <script src="https://cdn.ckeditor.com/4.15.1/basic/ckeditor.js"></script>

    <?php
        include('head.php');
    ?>
    <title><?php prl("नया उत्पाद", "Add Products"); ?> &bull; <?php prl("मिंक", "TMINC"); ?></title>
    <?php
        include('header.php');
        echo "\n";
    ?>
</head>
<body><?php 
    include('nav.php');
?>
<div class="form-up">
<form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="<?php prl("उत्पाद का नाम*", "Product Name*"); ?>" required><br>
    <div id="descsnap" style="font-weight:bold;"><span><?php prl("विवरण - ", "Description : "); ?></span></div>
    <textarea name="desc" placeholder="Product Description*" id="editor1" required></textarea><br>
    <script>
                        CKEDITOR.replace('editor1');
                </script>
    <input type="text" name="price" placeholder="<?php prl("दाम (रुपयों में)*","Price* (In ₹)"); ?>" required><br>
   
    <div id="filepicker">
        <ul>
            <li class="fpsnap">    <label><?php prl("उत्पाद की तस्वीर* - ", "Product Image : "); ?></label></li>
            <li>    <input type="file" name="uploadfile" value="" accept=".jpg, .jpeg, .png, .webp" required />
</li>
        </ul>
    </div>
    <br>
    <input type="submit" value="<?php prl("जोड़े", "Add"); ?>" name="add">
</form>
</div>
</body>
</html>
<?php
        }
?>
<?php
    if (isset($_POST['add'])){
        ?>
        <?php
        $size = $_FILES['uploadfile']['size'];
        if ($size < 1000000 * 2){
        $filename = $_FILES['uploadfile']['name'];
        $namear = explode(".", $filename);
        $fname = date("Ymd") ."". time()."".$namear[0].".".$namear[1];
        $tempname = $_FILES['uploadfile']['tmp_name'];
        $folder = "pimg/".$fname;
        move_uploaded_file($tempname, $folder);
        include('cred.php');
        $con = mysqli_connect($server, $user, $pass, $db);
        $sql = "INSERT INTO `products`(`id`, `name`, `img`, `detail`, `price`, `keyword`, `shop`) VALUES (NULL,'".str_replace("'", "<%up%>", $_POST['name'])."','".$folder."','".str_replace("'", "<%up%>", $_POST['desc'])."','".str_replace("'", "<%up%>", $_POST['price'])."','".str_replace("'", "<%up%>", $_POST['desc']).", ".str_replace("'", "<%up%>", $_POST['name'])."','".base64_decode($_COOKIE['Id'])."')";
        $run = mysqli_query($con, $sql);
        if ($run){
            ?>
                <script>
                    alert('<?php prl('उत्पाद बिना किसी समस्या के जोड़ा जा चूका है।', 'Product Added Successfully'); ?>');
                    window.location="new.php";
                </script>
            <?php
        }else{
            ?>
            <script>
                alert('<?php prl('कुछ समस्या गई!', 'Some Error Encountered'); ?>');
                // window.location="new.php";
            </script>
        <?php
            echo $sql;
        }
        }else{
            ?>
                <script>
                    alert('<?php prl('तसवीराकार दो एम. बी. से अधिक है।', 'File size is greater than 2MB'); ?>');
                </script>
            <?php
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