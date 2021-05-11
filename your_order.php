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
                        $colo = $row['color'];
                        echo $row['header']."\n";
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
    <title><?php prl("आपके आर्डर &bull; मिंक", "Your Orders &bull; TMINC"); ?></title>
    <?php
        include('header.php');
        echo "\n";
    ?>
           <?php
    if ($colo === "" || empty($colo)){
        echo "";
    }else{
        $colors = explode("hash", $colo);
        ?>
            <style>
            .header{background:#<?php echo $colors[1];?>;}
            body{background:#<?php echo $colors[2];?>;}
            .product span{color:#<?php echo $colors[3];?>!important;}
            input[type="search"]{background:#<?php echo $colors[4]?>}
            .headtitle, .dowhite, .searchbtn, .none{color:#<?php echo $colors[5];?>!important;}
            .list-item{background:#<?php echo $colors[6]?>!important;}
            .button{background:#<?php echo $colors[7];?>!important;color:#<?php echo $colors[12];?>!important}
            .list-item:hover{box-shadow:0 0 51px #<?php echo $colors[8]?>!important}
            .button:hover{background:#<?php echo $colors[9]?>!important}
            .product h2, *{color:#<?php echo $colors[10];?>!important}
            a{color:#<?php echo $colors[11]; ?>!important;}
            </style>
        <?php
    }
?>
    <style>

        main{text-align:center;width:100%;}
        .cancel-btn:hover{font-size:20px;font-weight:bold}
        .cancel-btn{transition:0.3s;}
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
.list-item{width: 60%;
    border: 1px solid #404040;
    border-radius: 10px;
    padding: 10px;
    font-family: sans-serif;text-align:left;margin:10px;background:#dddddd24;transition:0.3s;
    display: inline-block;}
    body{text-align:center}
    .list-item:hover{box-shadow:0 0 70px #404040;padding:15px;margin-bottom:0px}
    </style>
</head>
<body><?php 
    include('nav.php');
?><br>
<?php
    include('cred.php');
    $sql = "SELECT * FROM `orders` WHERE `mail` LIKE '".base64_encode($_COOKIE['Mail'])."' order by `id` desc";
    $con = mysqli_connect($server, $user, $pass, $db);
    if ($con){
        if($result = mysqli_query($con, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){

                    ?>
                    
                        <div class="list-item"><form action="" method="POST">
                        <input type="hidden" name="tdid" value="<?php echo $row['id']?>" required>
                        <input type="submit" value="<?php prl('रद्द करे', 'Cancel'); ?>" name="cancel" style="    background: transparent;
    border: 0;
    color: red!important;cursor:pointer" class="cancel-btn">
                        </form>
                            <?php echo str_replace("Price each", rrl("हर एक का दाम", "Price each"), str_replace("Total Cost", rrl("कुल लागत", "Total Cost"), str_replace("TOTAL PRICE", rrl("कुल राशि", "TOTAL PRICE"), str_replace("AND", "", base64_decode($row['order']))))); ?><br>
                            <?php prl("स्थिति", "Status"); ?>:
                            <?php
                                if ($row['deny'] === "0"){
                                    echo "<font color='grey'>".rrl("दुकान पर आदेश लंबित है", "Order Pending at Shop")."</font>";
                                }else if($row['deny'] === "1"){
                                    echo "<font color='red'>".rrl("सामन आप तक नहीं पंहुचाया जा सका है", "Order can't be delivered to you.")." <a href=\"\">".rrl("जाने क्यों", "Know why")."</a>.</font><br>
                                        &nbsp;". rrl("यह आइटम अब हटा दिया गया है", "This Item is now deleted.")."
                                    ";
                                }else if($row['deny'] === "2"){
                                    echo "<font color='orange'>". rrl("डिलिवरी के लिए रवाना", "Out for Delivery"). "</font>";
                                }else if($row['deny'] === "3"){
                                    echo "<font color='green'>".rrl("पंहुचा दिया गया है", "Delivered")."</font>";
                                }
                            ?>
                        </div>
                <?php
                    }
                // Free result set
                mysqli_free_result($result);
            } else{
                echo "<img src='assets/bee.png' style='width:60%'><br><span class='error'>Nothing For You<strong>.</strong></span>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }else{
        echo "<font color='red'>Error while connecting.</font>";
    }
    $nsql = "DELETE FROM `orders` WHERE `mail` LIKE '".base64_encode($_COOKIE['Mail'])."' AND `deny` LIKE '1' OR `deny` LIKE '3'";
    $conn = mysqli_connect($server, $user, $pass, $db);
    if ($conn){
        $run = mysqli_query($conn, $nsql);
    }
?>
    </main>
</body>
</html>
<?php
               
            }
            if (isset($_POST['cancel'])){
                $delete = $_POST['tdid'];
                $sqt = "DELETE FROM `orders` WHERE `id` LIKE '".$delete."'";
                include('cred.php');
                $connect = mysqli_connect($server, $user, $pass, $db);
                if ($connect){
                    $delete = mysqli_query($connect, $sqt);
                    if ($delete){
                        ?>
                        <script>
                            alert('<?php prl("आर्डर रद्द कर दिया गया है, अगर आर्डर आप तक पहुँचता है तो आप उसे मना है।  ", "Order is cancelled, in case if delivery comes to your dorestep, you may deny to accept it."); ?>');
                            window.location="";
                        </script>
                        <?php
                    }
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