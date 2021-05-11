<?php
ob_start();
?><?php include('compress.php'); 
include('lang.php');
?>
<?php
 if (!isset($_GET['s'])){
    $_GET['s'] = "";    
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

   
    session_start();
    if (empty($_SESSION['selection'])){
        ?>
            <script>
                window.location="index.php?s=<?php echo $_GET['s']; ?>";
            </script>
        <?php
    }else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        include('head.php');
    ?>
    <title><?php prl("कार्ट", "Cart"); ?></title>
    <?php
        include('header.php');
        echo "\n";
    ?>
    <style>

        main{text-align:center;width:100%;}
        .product img{display:inline-block;margin:3px;width:80%;height:auto;}
        .product h2{font-family:sans-serif;color:#272727;font-size:20px;margin:3px;}
        .product:hover{box-shadow:0 0 28px #aaa9a9;}
        .none{background:transparent;color:#404040;border:0;cursor:pointer;}
        a{text-decoration:none;color:#000}
        .product{font-family:sans-serif;padding:20px !important;display:inline-block;transition:0.3s;text-align:center;width:200px;border:1px solid #ddd;box-shadow:0 0 8px #aaa9a9;padding:3px;margin:10px;border-radius:0;width:90%}
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
.flexdata{    display: flex;
    list-style: none;}
.prcd{position: fixed;
    right: 0;
    margin-right: 20px;
    cursor: pointer;
    border: 0;
    background: #EF6C00;
    color: #fff;
    padding: 5px;
    border-radius: 7px;transition:0.2s;}
    .prcd:hover{background:#E65100}
    @media screen and (max-width:900px){
        .product{width:unset}
    }
    </style>

</head>
<body><?php 
    include('nav.php');
?>
       <?php
    if ($col === ""){
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
            .none{color:#<?php echo $colors[13]?>!important;}
            .product{background:#<?php echo $colors[6]?>!important;}
            .button, .prcd{background:#<?php echo $colors[7];?>!important;color:#<?php echo $colors[12];?>!important}
            .product:hover{box-shadow:0 0 51px #<?php echo $colors[8]?>!important}
            .button:hover, .prcd:hover{background:#<?php echo $colors[9]?>!important}
            .product h2, *{color:#<?php echo $colors[10];?>!important}
            a{color:#<?php echo $colors[11]; ?>!important;}
            </style>
        <?php
    }
?>
<br>
    <main>
    <a href="buy.php?i=1&s=<?php echo $_GET['s']; ?>"><button class="prcd">
        <?php prl("खरीदने के लिए आगे बढ़ें", "Proceed To Buy"); ?>
    </button></a><br><br>
    <a href="another.php?i=1&s=<?php echo $_GET['s']; ?>"><button class="prcd">
        <?php prl("दूसरे पते पर खरीदने के लिए आगे बढ़ें", "Proceed To Buy to another contact"); ?>
    </button></a>
    <br><br>
    <?php
    if (isset($_SESSION['selection'])){
        $m = 0;
            foreach($_SESSION['selection'] as $product){
               ?> <div class="product">
               <form action="dismiss.php?s=<?php echo $_GET['s']; ?>" method="POST">
               <ul class="flexdata">
               <li>
                <input type="hidden" value="<?php echo $m; ?>" name="id"><input type="submit" value="delete" class="material-icons none">
               </form>
               </li>
               <li style="    margin-top: 5px;
    margin-left: 5px;">
                <a href="item-description.php?i=<?php echo $product[0]; ?>&s=<?php echo $_GET['s']?>" target=_blank>
               <?php prl($product[2]." ". strtoupper($product[3]).", कुल दाम ".$product[4], strtoupper($product[3]." <strong>".$product[2]."</strong> pieces, total price <strong>".$product[4]."</strong>"));

               ?>
                </a>
                </li>
                </ul>
            </div><?php
            $m = $m + 1;
            }
?>


        <script>
            window.location=<?php echo $url; ?>;
        </script>
    <?php
    }
    ?>
  

    </main>
</body>
</html>
<?php
    function locate($url){
        ?>
            <script>
                window.location=<?php echo $url; ?>;
            </script>
            
        <?php
    }
    ?>
    
    <?php
}
?>
<?php
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
                            alert("<?php prl('आपको साइन आउट किया जा रहा है', 'Signed Out, Password Changes'); ?>");
                            <?php
                                if(isset($_GET['s'])){
                                    $s = $_GET['s'];
                                }else{
                                    $s = "%%";
                                }
                            ?>
                            window.location="signin.php?s=<?php echo $s; ?>";                        </script>
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
                    alert("<?php prl('आपको साइन आउट किया जा रहा है', 'Signed Out, Password Changes'); ?>");
                    <?php
                                if(isset($_GET['s'])){
                                    $s = $_GET['s'];
                                }else{
                                    $s = "%%";
                                }
                            ?>
                            window.location="signin.php?s=<?php echo $s; ?>";                </script>
            <?php
        }
    }
?><?php
    }
?>