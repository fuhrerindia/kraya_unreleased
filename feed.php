<?php
ob_start();
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
<!--<img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://shop.tminc.ml?s=25">-->
<?php
    include('nav.php');
    $_COOKIE['shop'] = "1";
?>
<main>
    <?php
        include('cred.php');
        $con = mysqli_connect($server, $user, $pass, $db);
        $sql = "SELECT * FROM `shops` WHERE `loc` LIKE '".$_COOKIE['Id']."'";
        $result = mysqli_query($con, $sql);
        if($result){
            if(mysqli_num_rows($result) > 0){
                while($col = mysqli_fetch_array($result)){
                    if ($col['feed'] === ""){
                        ?>
                           <p>No Section found, Create <a href="new_section.php">new here</a></p>
                        <?php
                    }else{
                        $sec = explode("<and>", $col['feed']);
                        foreach($sec as $key=>$each){
                            ?>
                                
        <a href="edit_section.php?sec=<?php echo $key; ?>">
        <div class="l-i">
            <ul>
                <li class="material-icons">
                section
                </li>
                <li>
                <?php $arr = explode("<c>", $each);
                echo $arr[0];
                ?>
                </li>
            </ul>
        </div>
        </a>
                            <?php
                        }
                    }
                }
            }else{
                echo "<font color='red'>Shop Not Found</font>";
            }
        }else{
            echo "<font color='red'>Fetching Error</font>";
        }
    ?>
    </main>
</body>
</html>
<?php
    }
?>