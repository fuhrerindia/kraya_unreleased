<?php
ob_start();
?><?php

if (!isset($_GET['q'])){
    ?>
        <script>
            window.location="edit.php";
        </script>
    <?php
}else{
        if (!isset($_COOKIE['Type'])){
        ?>
            <script>
                window.location="shop_login.php";
            </script>
        <?php
    }else{

    include('cred.php');
    $_COOKIE['shop'] = $_COOKIE['Id'];
     $sql = "SELECT * FROM `products` WHERE `keyword` LIKE '%".$_GET['q']."%' AND `shop` LIKE '".base64_decode($_COOKIE['shop'])."' order by `id` desc";
                    $con = mysqli_connect($server, $user, $pass, $db);
                    $result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="icon/png" href="http://tminc.ml/images/7.png">
    <link rel="stylesheet" type="text/css" href="css/data.css">
    <title>(<?php echo mysqli_num_rows($result); ?>) - All Products</title>
    <link rel="stylesheet" type="text/css" href="css/nav.css">
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
<form action="search_edit.php" method="GET">
        <input type="search" name="q" placeholder="<?php prl("उत्पाद ढूंढे", "Search Your Product"); ?>" style="width:60%;" value="<?php echo $_GET['q'];?>">
        <input type="submit" style="display:none;">
</form>
<form action="delete_pro.php" method="POST">
<input type="submit" value="delete" name="del" class="material-icons btn-dt">
<a href="new.php" class="material-icons c-add">add</a>&nbsp;<a href="edit.php" class="material-icons c-edit">data</a>
<br>    
<div class="t-m" style="display:inline-block;width:70%">
    <table>
        <thead>
            <tr>
                <td>
                <?php prl("चुने", "Select"); ?>
                </td>
                <td>
                <?php prl("तस्वीर", "Image"); ?>
                    </td>
                    <td>
                    <?php prl("नाम", "Name"); ?>
                    </td>
                    <td>
                    <?php prl("मूल्य", "Price"); ?>
                    </td>
                    <td>
                    <?php prl("बदले", "Edit"); ?>
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
                <input type="checkbox" name="todel[]" value="<?php echo $row['id']; ?>">
                </td>
                <td data-label="<?php prl("तस्वीर", "Image"); ?>">
                    <img src="<?php echo $row['img']?>">
                    </td>
                    <td data-label="<?php prl("नाम", "Name"); ?>">
                    <?php echo $row['name'];?>
                    </td>
                    <td data-label="<?php prl("मूल्य", "Price"); ?>">
                   <?php echo $row['price']; ?>
                    </td>
                    <td data-label="<?php prl("बदले", "Edit"); ?>">
                    <a href="edit_product.php?e=<?php echo $row['id']; ?>" class="material-icons">edit</a>
                    </td>
                    <?php
                            }
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<br>No Product Found. Add <a href=\"new.php\">new</a>.";
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
}
?>