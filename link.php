<?php
ob_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include('head.php');
    ?>
    <title>Buy Kirana &bull; TMINC</title>
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
}
    </style>
</head>
<body>
<?php include('nav.php');?>
</body>
</html>