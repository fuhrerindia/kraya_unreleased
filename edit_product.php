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
    <script src="https://cdn.ckeditor.com/4.15.1/basic/ckeditor.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/add_edit.css">
    <?php
        include('head.php');
    ?>
    <title><?php prl("उत्पाद की जानकारी", "Edit Product Details"); ?> &bull; <?php prl("मिंक", "TMINC"); ?></title>
    <?php
        include('header.php');
        echo "\n";
    ?>
</head>
<body><?php 
    include('nav.php');
?><style>
@media screen and (max-width:900px){
    .form-up{
        width: 94%!important;;
    }
}
</style>
<div class="form-up">

<?php
include('cred.php');
$con = mysqli_connect($server, $user, $pass, $db);
$sql = "SELECT * FROM `products` WHERE `id` LIKE '".$_GET['e']."' AND `shop` LIKE '".base64_decode($_COOKIE['Id'])."'";

    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
?>

<form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $_GET['e']; ?>" required>
    <input type="text" name="name" placeholder="<?php prl("उत्पाद का नाम*", "Product Name*"); ?>" value="<?php echo $row['name']; ?>" required><br>
    <div id="descsnap" style="font-weight:bold;"><span><?php prl("विवरण - ", "Description : "); ?></span></div>
    <textarea name="desc" placeholder="Product Description*" id="editor1" required><?php echo $row['detail']; ?></textarea><br>
    <script>
                        CKEDITOR.replace('editor1');
                </script>
    <input type="text" name="price" placeholder="<?php prl("दाम (रुपयों में)*","Price* (In ₹)"); ?>"  value="<?php echo $row['price']; ?>" required><br>
    <input type="hidden" name="pic" value="<?php echo $row['img']; ?>">
    <br><label><?php prl("उत्पाद की तस्वीर* - ", "Product Image : "); ?></label><br>
    <input type="file" name="uploadfile"  value="<?php echo $row['img']; ?>" required />
    <br>
    <?php
            }
        }else{
            ?><script>
            alert('<?php prl('ऐसा प्रतीत हो रहा है की यह उत्पाद आपके दूकान का नहीं है।', 'It seems that this product don\'t belong to your shop.'); ?>');
            window.location="dashboard.php";
            </script><?php
        }
    }
    ?>
    <input type="submit" value="<?php prl("बदले", "Update"); ?>" name="add">
</form>
</div>
</body>
</html>
<?php
        }
?>
<?php
    if (isset($_POST['add'])){
        $size = $_FILES['uploadfile']['size'];
        if ($size < 1000000 * 2){
        $filename = $_FILES['uploadfile']['name'];
        $namear = explode(".", $filename);
        $fname = date("Ymd") ."". time()."".$namear[0].".".$namear[1];
        $tempname = $_FILES['uploadfile']['tmp_name'];
        $folder = "pimg/".$fname;
        move_uploaded_file($tempname, $folder);

$file_pointer = $_POST['pic']; 

    $delete = unlink($file_pointer);




        include('cred.php');
        $con = mysqli_connect($server, $user, $pass, $db);
        $sql = "UPDATE `products` SET `name`='".str_replace("'", "<%up%>", $_POST['name'])."',`img`='".$folder."',`detail`='".str_replace("'", "<%up%>", $_POST['desc'])."',`price`='".str_replace("'", "<%up%>", $_POST['price'])."',`keyword`='".str_replace("'", "<%up%>", $_POST['desc']).", ".str_replace("'", "<%up%>", $_POST['name'])."' WHERE `id` LIKE '".$_POST['id']."' AND `shop` LIKE '".base64_decode($_COOKIE['Id'])."'";
        $run = mysqli_query($con, $sql);
        if ($run){
            ?>
                <script>
                    alert('<?php prl('उत्पाद की जानकारी बदल दी गई है।', 'Product Updated Successfully'); ?>');
                    // window.location="edit.php";
                </script>
            <?php
        }else{
            ?>
            <script>
                alert('<?php prl('या तो हैक करने का प्रयास किया गया है, या कोई अंधरुनि समस्या हुई है। कृपया इस दिक्कत को मिंक को बताये।', 'Either hacking attampt was done or some internal error is caused, please report the issue at tminc.ml'); ?>');
                window.location="edit.php";
            </script>
        <?php
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