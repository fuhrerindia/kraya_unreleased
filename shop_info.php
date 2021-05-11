<?php
ob_start();
?><?php include('compress.php'); 
    include('lang.php');
?>
<?php
 if (!isset($_GET['s'])){
    ?>
        <script>
            window.location="start.php";
 </script>
    <?php
}
    if (!isset($_COOKIE['Mail'])){
        ?>
            <script>
                window.location="signin.php?s=<?php echo $_GET['s']; ?>";
            </script>
        <?php
    }else{
    $password = base64_decode($_COOKIE['Pass']);
    $mail = $_COOKIE['Mail'];
    $sql = "SELECT * FROM `users` WHERE `mail` LIKE '".$mail."'";
    include('cred.php');
    $connect = mysqli_connect($server, $user, $pass, $db);
    if ($values = mysqli_query($connect, $sql)){
        if(mysqli_num_rows($values) > 0){
            while($col = mysqli_fetch_array($values)){
                if ($col['password'] === $password){


    if (isset($_GET['s'])){
        $selshop = "`shop` LIKE '".$_GET['s']."'";
    }else{
        $selshop = "1";
        $_GET['s'] = "%%";
    }
    if (!isset($_COOKIE['Mail']) || $_COOKIE['Mail'] === ""){
        ?>
            <script>
                window.location="signin.php?s=<?php echo $_GET['s']; ?>";
            </script>
        <?php
    }else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php
        if (!isset($_GET['s']) || $_GET['s'] === ""){
            $heading =  "TMINC Store";
        }else{
            include('cred.php');
            $con = mysqli_connect($server, $user, $pass, $db);
            $sql = "SELECT * FROM `shops` WHERE `loc` LIKE '".$_GET['s']."'";
            if($result = mysqli_query($con, $sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        $heading =  $row['name'];
                        $rowdata = $row;
                        $col =  $row['color'];
                        echo str_replace("<%up%>", "'", $row['header'])."\n";
                    }
                }
            }
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include('head.php');
    ?>
    <title><?php prl("दूकान की जानकारी &bull; मिंक", "About Shop &bull; TMINC"); ?></title>
    <?php
        include('header.php');
        echo "\n";
?>
<?php
        if ($col === "" || empty($col)){
            echo "";
        }else{
            $colors = explode("hash", $col);
            ?>
                <style>
                .header{background:#<?php echo $colors[1];?>;}
                body{background:#<?php echo $colors[2];?>;}
                .product span{color:#<?php echo $colors[3];?>!important;}
                input[type="search"]{background:#<?php echo $colors[4]?>}
                .headtitle, .dowhite, .searchbtn{color:#<?php echo $colors[5];?>!important;}
                .product{background:#<?php echo $colors[6]?>!important;}
                .product button, .noti{background:#<?php echo $colors[7];?>!important;color:#<?php echo $colors[12];?>!important}
                .btntxtnew{color:#<?php echo $colors[12];?>!important;}
                .product:hover{box-shadow:0 0 51px #<?php echo $colors[8]?>!important}
                .product button:hover, .noti:hover{background:#<?php echo $colors[9]?>!important}
                .product h2, *{color:#<?php echo $colors[10];?>!important}
                a{color:#<?php echo $colors[11]; ?>!important;}
                </style>
            <?php
        }
    ?>
  
    <style>

        main{text-align:center;width:100%;}
        .hidden{display:none;}
        .product img{display:inline-block;margin:3px;width:80%;height:auto;}
        .product h2{font-family:sans-serif;color:#272727;font-size:20px;margin:3px;}
        .product:hover{box-shadow: 0 0 51px #000;}
        .product{display:inline-block;transition:0.3s;text-align:center;width:200px;border:1px solid #ddd;box-shadow:0 0 8px #aaa9a9;padding:3px;margin:10px;border-radius:0;}
        .product button{    width: 60%;margin:3px;
    border: 0;transition:0.3s;
    padding: 5px;
    background: <?php echo $color; ?>;
    color: #fff;
    cursor:pointer;
    border-radius: 9px;}
    .product span{color:green;font-family:sans-serif;}
    .product button:hover{background:#a75a16}
    .card{    width: 60%;
    display: inline-block;
    box-shadow: 0px 0px 13px #404040;
    border-radius: 8px;
    padding: 15px;
    text-align: left;
    line-height: 29px;
    background:#fff;
    font-family: sans-serif;}
    .card a{text-decoration:underline;color:inherit}
    body{
        background:#ededed;
    }
    .noti{    position: fixed;
    bottom: 0;
    right: 0;
    height: 25px;
    background: #FF9800;
    padding: 20px;
    width:100%;
    border-radius: 0;
   <?php if ($col === ""){
            echo "";
        }else{echo "/*";}?> color: #fff;  <?php if ($col === ""){
            echo "";
        }else{echo "*/";}?>
    font-family: sans-serif;
    margin: 0;
    box-shadow: 0 0 20px #666;
}
@media screen and (max-width: 900px) {
    .product{
        width:98%;
        margin:0;
        border-radius:0;
        box-shadow:none;
        text-align:left;
    }
    .product img{width:100px !important;height:100px !important;float:left;margin:5px;}
    .product button{width:200px;}
    .product span, .product button, .product h2{margin-left:20px;display:inline-block;}
    .product span{display:table-caption;}
    .hidden{display:block;}
}
@media screen and (max-width:355px){
    .product{text-align:center;}
    .product span{display:block;}
    .product img{float:none;}
}
@media screen and (max-width:230px){
    .product button{width:150px;}
}
    </style>
</head>
<body><?php 
    include('nav.php');
?>
<br>
    <main>
    <?php
    session_start();
    if (isset($_SESSION['selection'])){
        if ($_SESSION['selection'] === ""){
            echo "";
        }else{
        $list = sizeof($_SESSION['selection']);
        if ($_SESSION['selection'] == 1){
            $itemc = "items ";
        }else{
            $itemc= "item ";
        }
        ?>
            <a href="cont.php?s=<?php echo $_GET['s']; ?>"><div class="noti" onclick="order()">
                <span class="btntxtnew">
                    <?php echo strtoupper($list." ".$itemc."in cart"); ?>
                </span>
            </div></a>
        <?php
        }
    }
    ?>
    <div id="get"></div>
    <?php
    include('cred.php');
    $con = mysqli_connect($server, $user, $pass, $db);
    $sql = "SELECT * FROM `products` WHERE ".$selshop." order by `id` desc";
    ?>
    <div class="card" style="width:unset">
        <strong><?php prl("दूकान का नाम", "Shop Name"); ?>: </strong><?php echo base64_decode($heading); ?><br>
        <strong><?php prl("दूकान का मालिक", "Shop Owner"); ?>: </strong><?php echo base64_decode($rowdata['owner']); ?><br>
        <strong><?php prl("दूकान का मेल", "Shop E-Mail"); ?>: </strong><a href="mailto:<?php echo base64_decode($rowdata['mail']); ?>"><?php echo base64_decode($rowdata['mail']); ?></a><br>
        <strong><?php prl("दूकान का दूरभाष", "Shop Phone"); ?>: </strong><a href="tel:<?php echo base64_decode($rowdata['phone']); ?>"><?php echo base64_decode($rowdata['phone']); ?></a><br>
        <strong><?php prl("दूकान का पता", "Shop Address"); ?>: </strong><a href="https://www.google.com/maps/search/<?php echo base64_decode($rowdata['address']); ?>" target=_blank><?php echo base64_decode($rowdata['address']); ?></a><br>
    </div>
<br><br>
<br><br><br><br><br>
    </main>
</body>
</html>
<?php
               
            }
        }else{
                    ?>
                        <script>
                            document.cookie = "Id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                            document.cookie = "Mail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                            document.cookie = "Pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                            document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                            document.cookie = "Address=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                            document.cookie = "Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                            document.cookie = "Phone=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                            document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                            alert('Signed Out, Password Changes');
                            <?php
                                if(isset($_GET['s'])){
                                    $s = $_GET['s'];
                                }else{
                                    $s = "%%";
                                }
                            ?>
                            window.location="signin.php?s=<?php echo $s; ?>";
                        </script>
                    <?php
                }
            }
        }else{
            ?>
                <script>
                    document.cookie = "Id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Mail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Address=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "Phone=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    alert('Signed Out, Password Changes');
                    <?php
                                if(isset($_GET['s'])){
                                    $s = $_GET['s'];
                                }else{
                                    $s = "%%";
                                }
                            ?>
                            window.location="signin.php?s=<?php echo $s; ?>";
                </script>
            <?php
        }
    }
?>
<?php
    }

?>