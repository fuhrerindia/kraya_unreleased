<?php
ob_start();
?><?php
    function s_err($msg){
        echo "<font color='red'>".$msg."</font>";
    }
    function box($id, $img, $ttl, $sec, $full){
        ?>
            <div class="dialog">
                <img src="<?php echo $img; ?>" width=100><br>
                <h4><?php echo $ttl; ?></h4>
                <form action="" method="POST">
                    <input type="hidden" name="lab" value="<?php echo $id; ?>">
                    <input type="hidden" name="sec" value="<?php echo $sec; ?>">
                    <input type="hidden" name="full" value='<?php echo $full;?>'>
                    <input type="submit" class="material-icons" value="clear" name="delete-itm">
                </form>
            </div>
        <?php
    }
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
    <link rel="icon" type="icon/png" href="http://tminc.ml/images/7.png">
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
            $sql = "SELECT * FROM `feed` WHERE `shop` LIKE '".$_COOKIE['Id']."' order by `id` desc";
            if ($con){
                $result = mysqli_query($con, $sql);
                if ($result){
                    if (mysqli_num_rows($result) > 0){
                        while ($row = mysqli_fetch_array($result)){
                            if ($row['data'] === "" || $row['data'] === "[]"){
                                ?>
                                    No Feed Found
                                <?php
                            }else{
                            ?>
                                <h2>
                                <form action="" method="POST">
                                    <input type="hidden" name="std" value="<?php echo $row['id']?>" required>
                                    <input type="submit" class="material-icons" name="section" value="clear">
                                </form>
                                    <?php echo $row['title'];?>
                                </h2>
                                <form action="add_into.php" method="POST">
                                <!-- full, uid, section_name -->
                                <input type="hidden" name="full" value='<?php echo $row['data'];?>'>
                                <input type="hidden" name="uid" value="<?php echo $row['id'];?>">
                                <input type="hidden" name="section_name" value="<?php echo $row['title'];?>">
                                <input type="submit" value="edit">
                                </form>
                                <?php
                                    $conn = mysqli_connect($server, $user, $pass, $db);
                                    $list = json_decode($row['data']);
                                    $i = 0;
                                    $var = "";
                                    foreach($list as $e){
                                        if ($i == 0){
                                            $var = "`id` LIKE '".$e."'";
                                        }else{
                     //EDITED                       $var = $var." OR `id` LIKE '".$e."'";
                                        }
                                        $i++;
                                    }
                                    $sqli = "SELECT * FROM `products` WHERE ".$var;
                                    if ($conn){
                                        $result = mysqli_query($conn, $sqli);
                                        if ($result){
                                            if (0 < mysqli_num_rows($result)){
                                                while ($r = mysqli_fetch_array($result)){
                                                    box($r['id'], $r['img'], $r['name'], $row['id'], $row['data']);
                                                }
                                            }else{
                                                s_err("Nothing Found");
                                            }
                                        }else{
                                            s_err("QUERY ERROR");
                                        }
                                    }else{
                                        s_err("Connection Fault");
                                    }
?>
                            <?php
                        }
                    }
                    }else{
                        s_err("No Feed Found, create new");
                    }
                }else{
                    s_err("Error in Query");
                }
            }else{
                s_err("Error While Connection");
            }
        ?>
    </main>
</body>
</html>
<?php
    }
?>
<?php
    if (isset($_POST['section'])){
        $sql = "DELETE FROM `feed` WHERE `id` LIKE '".$_POST['std']."'";
        include('cred.php');
        if($con = mysqli_connect($server, $user, $pass, $db)){
            if ($result = mysqli_query($con, $sql)){
                ?>
                    <script>
                        window.location="edit_section.php";
                    </script>
                <?php
            }else{
                s_err("Error While Deleting");
            }
        }else{
            s_err("Connection Err");
        }
    }
    if (isset($_POST['delete-itm'])){
        $w = $_POST['full'];
        $sect = $_POST['sec'];
        $l = $_POST['lab'];
        $array = json_decode($w);
            unset($array[array_search($l,$array)]);
            $new_array = array();
            foreach($array as $each){
                array_push($new_array, $each);
            }
            $json = json_encode($new_array);
            if ($json === "[]"){
                $sql = "DELETE FROM `feed` WHERE `id` LIKE '".$sect."'";
            }else{
            $sql = "UPDATE `feed` SET `data`='".$json."' WHERE `id` LIKE '".$sect."'";
            }
            include('cred.php');
            if ($con = mysqli_connect($server, $user, $pass, $db)){
                if ($run = mysqli_query($con, $sql)){
                    ?>
                        <script>
                            window.location="edit_section.php";
                        </script>
                    <?php
                }else{
                    s_err("QUERY ERR");
                }
            }else{
                s_err("CONNECTION ERROR");
            }
    }
?>