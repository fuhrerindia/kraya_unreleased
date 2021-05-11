<?php
ob_start();
?><?php include('compress.php'); ?>
    <?php
    if (!isset($_COOKIE['Type'])){
        ?>
            <script>
                window.location="shop_login.php";
            </script>
        <?php
    }else{
    include('cred.php');
    $_COOKIE['shop'] = $_COOKIE['Id'];
    $all = $_POST['full'];
    $uid = $_POST['uid'];
    $all_arr = json_decode($all);
    $var = "";
    foreach($all_arr as $e){
            $var = $var." AND `id` NOT LIKE '".$e."'";
    }
     $sql = "SELECT * FROM `products` WHERE `shop` LIKE '".$_COOKIE['shop']."' ".$var." order by `id` desc";
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
        <input type="search" name="q" placeholder="Search Your Product" style="width:60%;">
        <input type="submit" style="display:none;">
</form>
<form action="" method="POST">
<input type="text" name="title" placeholder="Section Title" value="<?php echo $_POST['section_name']; ?>" required><br>
<input type="hidden" name="old_data" value='<?php echo $all; ?>' required><!--IMPORTANT VERY MUCH OP*100-->
<input type="hidden" name="uid" value="<?php echo $uid; ?>">
<span>Select Product to add under the section</span>
<br>    
<div class="t-m" style="display:inline-block;width:70%">
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
    <table>
        <thead>
            <tr>
                <td>
                <input type="checkbox" name="" id="select_all">
                </td>
                <td>
                    Image
                    </td>
                    <td>
                    Name
                    </td>
                    <td>
                    Price
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
                <td data-label="Select">
                <input type="checkbox" name="todel[]" value="<?php echo $row['id']; ?>" class="checkbox">
                </td>
                <td data-label="Image">
                    <img src="<?php echo $row['img']?>">
                    </td>
                    <td data-label="Name">
                    <?php echo $row['name'];?>
                    </td>
                    <td data-label="Price">
                   <?php echo $row['price']; ?>
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
    </div><br>
    <input type="submit" name="save" value="Update">
    </form>
    </main>
</body>
</html>
<?php
    if (isset($_POST['save'])){
        if ($_POST['todel'][0] === ""){
            $sql = "UPDATE `feed` SET `title`='".$_POST['title']."'";
    }else{
        $old = $_POST['old_data'];
        $old = json_decode($old);
        $arr = array();
        foreach($old as $e){
            array_push($arr, $e);
        }
        foreach($_POST['todel'] as $each){
            array_push($arr, $each);
        }
        $data = json_encode($arr);
        $sql = "UPDATE `feed` SET `title`='".$_POST['title']."', `data`='".$data."'";
    }
    include('cred.php');
    if ($con = mysqli_connect($server, $user, $pass, $db)){
        if ($run = mysqli_query($con, $sql)){
            ?>
                <script>
                window.location="edit_section.php";
                </script>
            <?php
        }
    }else{
        echo "ERR";
    }
    }
}
?>