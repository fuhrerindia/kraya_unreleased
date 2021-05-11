<?php
ob_start();
include("lang.php");
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
    include('cred.php');
    $_COOKIE['shop'] = $_COOKIE['Id'];
     $sql = "SELECT * FROM `orders` WHERE `shop` LIKE '".base64_decode($_COOKIE['Id'])."' AND `deny` NOT LIKE '1' AND `deny` NOT LIKE '3' order by `id` desc";
                    $con = mysqli_connect($server, $user, $pass, $db);
                    $result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en" id="html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/data.css">
    <title>(<?php echo mysqli_num_rows($result); ?>) - <?php prl("अपूर्ण आर्डर", "Pending Orders"); ?></title>
    <link rel="stylesheet" type="text/css" href="css/nav.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
<script src="java/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
</script>
<form action="delete.php" method="POST">

<!-- DELIVERED BUTTON \|/ -->
<input type="submit" value="done" name="del" class="material-icons btn-dt" style="color:green;font-weight:bold;">

<!-- OUT FOR DELIVERY BUTTON -->
<input type="submit" value="directions_walk" name="out" class="material-icons btn-dt" style="color=orange;font-weight:bold;">
<!-- <a href="new.php" class="c-add">New Product</a>&nbsp;<a href="edit.php" class="c-edit">Edit Product</a><br> -->

<!-- ERROR BUTTON BELOW -->
<input type="submit" value="error" name="mrk" class="material-icons btn-dt" style="color:red;"><br>
<div class="t-m" style="display:inline-block;width:70%">
    <table>
        <thead>
            <tr>
                <td>
                <input type="checkbox" name="" id="select_all">
                </td>
                <td>
                    <?php prl("नाम", "Name"); ?>
                    </td>
                    <td>
                    <?php prl("पता", "Address"); ?>
                    </td>
                    <td>
                    <?php prl("दूरभाष", "Phone"); ?>
                    </td>
                    <td>
                    <?php prl("आर्डर", "Order"); ?>
                    </td>
            </tr>
        </thead>
        <tbody>
            <?php
                    if($result = mysqli_query($con, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                                ?>
                                <tr>
                <td data-label="<?php prl("चुने", "Select"); ?>">
                <input type="checkbox" name="todel[]" value="<?php echo $row['id']; ?>" class="checkbox">
                </td>
                <td data-label="<?php prl("नाम", "Name"); ?>">
                    <?php echo base64_decode(base64_decode($row['name']))?>
                    </td>
                    <td data-label="<?php prl("पता", "Address"); ?>">
                    <?php echo base64_decode($row['address']);?>
                    </td>
                    <td data-label="<?php prl("दूरभाष", "Phone"); ?>">
                    <a href="tel:<?php echo base64_decode($row['phone']); ?>"><?php echo base64_decode($row['phone']); ?></a>
                    </td>
                    <td data-label="<?php prl("आर्डर", "Order"); ?>">
                    <?php prl(str_replace("Price each: ", "हर एक का दाम - ", str_replace("Total Cost: ", "कुल दाम - ", str_replace("TOTAL PRICE: ", "कुल दाम - ", base64_decode($row['order'])))), base64_decode($row['order'])); ?>    
                    </td>
                    </tr>
                    <?php
                            }
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<img src='assets/bee.png' style='width:60%;height:unset'><br><span class='error'>No Order is Available<strong>.</strong></span>
                            <style>table{display:none!important}</style>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
            ?>
        </tbody>
    </table>
    </div>
    </form>
    </main>
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