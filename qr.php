<?php
ob_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMINC QR CODE</title>
    <style>
        *{color:#404040;font-family:sans-serif;margin:0;padding:0;}
        img, h1, h3{margin:11px;}
        div{height:100vh;border:1px solid #000;width:450px;border-bottom:20px solid orange}
    </style>
</head>
<body><center>
<div><br><br>
    <img src="assets/icon.png" width=50px height=50px><br><br>
    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://localhost/?s=<?php echo $_COOKIE['Id']; ?>" height=300px width=300px>
    <h3>Buy From</h3>
    <h1><?php echo $_COOKIE['Name']; ?></h1>
    <h3>Online</h3>
    </center>
    </div>
</body>
</html>z