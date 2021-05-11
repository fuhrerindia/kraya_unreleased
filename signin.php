<?php
ob_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin With TMINC</title>
    <link rel="icon" type="image/png" href="http://tminc.ml/images/7.png">
    <meta name="robots" content="noindex" />
</head>
<body>
<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');
    *{color:#666;text-align:center;margin:0;font-size:14px;padding:0;font-family: 'Noto Sans', sans-serif;}
    .box{padding:20px;margin-top:15vh;padding-bottom:36px;border:1px solid #ddd;border-radius:8px;width:445px;display:inline-block;background:#fff;}
    .logo{height:50px;display:inline-block;margin:40px;margin-bottom:0px}
    h2{color:#202124;margin-bottom:10px;font-size:24px;font-weight:100;}
    p{width:90%;text-align:left;margin:30px;display:inline-block;}
    a{text-decoration:none;color:#311B92;font-weight:5px}
    .left{float:left;}
    span{display:block;margin:10px;}
    body{background:#ededed;}
    input[type="text"],input[type="email"]{width:90%;padding:13px 15px;font-size:16px;text-align:left;color:#404040;border-radius:4px;border:1px solid #ddd;padding-top:10px;padding-bottom:10px;}
    input[type="submit"]{float:right;cursor:pointer;outline:0;background:#311B92;color:#fff;font-family: 'Noto Sans', sans-serif;border:0;width:85px;height:40px;border-radius:5px;}
    .left, input[type="submit"]{margin:20px;}
    @media screen and (max-width:450px){
        .box{border:0;width:81%;margin-top:0;}
    }
</style>
    <div class="box">
        <img src="assets/icon.png" class="logo"><br>
        <h2>Sign in</h2>
        <span>to continue to TMINC Store</span>
        <form action="pass.php" method="POST">
            <input type="text" name="mail" placeholder="Email" required><br>
            <input type="hidden" name="shop" value="<?php echo $_GET['s']; ?>">
            <p>Not your computer? Use a private browsing window to sign in.
        <div>
    <a href="signup.php?s=<?php echo $_GET['s']; ?>" class="left">Create account</a><input type="submit" value="Next"> </form>
        </div>
    </div>
</body>
</html>