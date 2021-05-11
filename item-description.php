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
    

    include('cred.php');
    $con = mysqli_connect($server, $user, $pass, $db);
    $sql = "SELECT * FROM `products` WHERE `id` LIKE'".$_GET['i']."' order by `id` desc";
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                    $desc = $row['detail'];
                    $name = $row['name'];
                    $img = $row['img'];
                    $cost = $row['price'];
                    $shop = $row['shop'];
                    $val = 1;
                    }
            // Free result set
            mysqli_free_result($result);
        } else{
            echo "<span class=error>No Product Found.</span>";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    if ($val == 1){
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <meta name="description" content="<?php echo str_replace("&nbsp;", " ", strip_tags($desc)); ?>">
    <meta name="keywords" content="<?php echo str_replace("<%up%>", "'", $name).", ".str_replace("&nbsp;", " ", strip_tags($desc)) ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "<?php echo base64_decode($name); ?>",
  "image": "<?php echo $img; ?>",
  "description": "<?php echo str_replace("&nbsp;", " ", strip_tags($desc)); ?>",
  "offers": {
    "@type": "AggregateOffer",
    "url": "<?php echo "?i=".$_GET['i']."&s=".$_GET['s']; ?>",
    "priceCurrency": "INR",
    "lowPrice": "<?php echo $cost; ?>",
    "highPrice": "<?php echo $cost + 20; ?>"
  }
}
</script>
    <title><?php echo str_replace("<%up%>", "'", $name); ?> &bull; <?php prl("मिंक क्राया", "TMINC Kraya"); ?></title>
    <?php
        include('head.php');
    ?>
       <?php
        include('header.php');
        echo "\n";
    ?>
 
    <style>
        .left img{width:60%;}
        .left{float:left;width:50%;text-align:center}
        .right{font-family: sans-serif;
    color: #1f1f1f;float:right;width:50%;}.right h2{font-family: 'Roboto', sans-serif;font-size: 18px;margin:0px;
}
.green{color: green;
    font-size: 15px;
    margin-left: 0px;}
    label{margin-right:20px}
    input[type="number"]{width: 35px;
    border: 1px solid #000;
    padding:5px;
    text-align: center;}
    .navigation{    position: unset;
    padding: 0;
    width: 26px;
    background: transparent;
    cursor:pointer;
    border: 1px solid #b75219;
    padding:5px;
    color: #b75219;
    font-size: 13px;}
    .contact{text-align:center;width:max-content;margin:10px;}
    button{       padding: 15px;
    border-radius: 10px;
    border: 0;
    background: #EF6C00;
    color: #fff;
    cursor: pointer;
    margin: 0px;
    transition: 0.3s;
    margin-top: 0;
    position: fixed;
    bottom: 0;
    width: 50%;
    border-radius: 0;}
    .headtitle{font-weight:unset;   }
    p{    margin: 20px;
    line-height: 28px;
    color: #404040;}
    a{color:#404040;text-decoration:none;font-weight:bold;}
    button:hover{background:#E65100}
    @media screen and (max-width:900px){
        .left, .right{float:none;width:100%}
        .right{text-align:center;}
        .contact{display:inline-block;}
        p{text-align:center;}
    }
        </style>
        <script src="https://cdn.ckeditor.com/4.15.1/basic/ckeditor.js"></script>
</head>
<body>
<?php 
    include('nav.php');
?>
<br>
<div class="left">
    <img src="<?php echo $img ?>" alt="<?php echo $name; ?>">
</div>
<div class="right">
        <h2><?php echo str_replace("<%up%>", "'", $name); ?></h2><br>
        <?php
    include('cred.php');
    $con = mysqli_connect($server, $user, $pass, $db);
    $sql = "SELECT * FROM `shops` WHERE `loc` LIKE '".$shop."'";
    if($result = mysqli_query($con, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $shop = $row['name'];
                $addr = $row['address'];
                $loc = $row['loc'];
                $phone = $row['phone'];
                $col =  $row['color'];
                }
            // Free result set
            mysqli_free_result($result);
        } else{
            echo "<span class=error>No Shop Found.</span>";
        }
    } else{
        echo "ERROR: Could not able to execute ".$sql;
    }
    ?>   <?php
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
            .product{background:#<?php echo $colors[6]?>!important;}
            .button{background:#<?php echo $colors[7];?>!important;color:#<?php echo $colors[12];?>!important}
            .product:hover{box-shadow:0 0 51px #<?php echo $colors[8]?>!important}
            .button:hover{background:#<?php echo $colors[9]?>!important}
            .product h2, *{color:#<?php echo $colors[10];?>!important}
            a{color:#<?php echo $colors[11]; ?>!important;}
            .navigation{border: 1px solid #<?php echo $colors[7];?>!important;
                color: #<?php echo $colors[7];?>!important;}
            </style>
        <?php
    }
?>
        <span style="    font-size: 14px;
    color: #404040;"><?php prl(base64_decode(str_replace("<%up%>", "'", $shop))." द्वारा बेचा जा रहा है", "Sold By ".base64_decode(str_replace("<%up%>", "'", $shop))); ?></span><br><br>
        ₹<span class="green" id="pricebox"><?php echo $cost;?></span><br>
        <form action="order.php?s=<?php echo $_GET['s']?>" method="POST"><br>
            <span class="navigation" onclick="add()">+</span><input type="number" id="quantbox" name="quant" value=1 min=1 readonly required><span class="navigation" onclick="min()">-</span>
            <script>
function add(){
	input = document.getElementById("quantbox");
    input.value = parseInt(input.value) + 1;
    updateprice(input.value);
}
function updateprice(value){
    oldprice = document.getElementById("pricebox");
    oldprice.innerHTML = value * <?php echo $cost; ?> ;
    document.getElementById("costhidded").value=value*<?php echo $cost; ?>;
}
function min(){
	input = document.getElementById("quantbox");
    if (parseInt(input.value) == 1){
    	console.log('1 is minimun');
    }else{
    input.value = parseInt(input.value) - 1;
    }
    updateprice(input.value);
}
</script>
            <br>
            <div class="contact">
            </div>
            <input type="hidden" name="name" value="<?php echo $name; ?>" required>
            <input type="hidden" name="id" value="<?php echo $_GET['i']?>" required>
            <input type="hidden" name="shop" value="<?php echo $loc?>" required>
            <input type="hidden" id="costhidded" name="cost" value="<?php echo $cost; ?>" required><br>
            <button onclick="window.location='tel:<?php echo $phone;?>'" style="background:#404040;left:0;"><?php prl("कॉल", "Call"); ?></button>
            <button type="submit" class="button"><?php prl("कार्ट में डाले", "Add To Cart"); ?></button>
            
</form> 
</div>     </div>
<img src="assets/wa.png" alt="whatsapp" onclick="window.location='http:/\/wa.me/91<?php echo $phone; ?>'" style="    width: 60px;
    height: 60px;
    position: fixed;
    bottom: 55px;
    cursor:pointer;
    right: 15px;">
<p>
        <?php echo str_replace("\n", "<br>", str_replace("<%up%>", "'", $desc)); ?>
    </p>
    <div style="height:50px"></div>
 
</body>
</html>
<?php
    }else{
        ?>
            <script>
                window.location="index.php";
    </script>
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
                            alert("<?php prl('आपको साइन आउट किया जा रहा है', 'Signed Out, Password Changes'); ?>");
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
                    alert("<?php prl('आपको साइन आउट किया जा रहा है', 'Signed Out, Password Changes'); ?>");
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