<?php
ob_start();
?><?php
include('lang.php');
$password = base64_decode($_COOKIE['Pass']);
$mail = $_COOKIE['Mail'];
$sql = "SELECT * FROM `users` WHERE `mail` LIKE '".$mail."'";
include('cred.php');
$connect = mysqli_connect($server, $user, $pass, $db);
if ($values = mysqli_query($connect, $sql)){
    if(mysqli_num_rows($values) > 0){
        while($col = mysqli_fetch_array($values)){
            if ($col['password'] === $password){

    if (!isset($_GET['s']) || $_GET['s'] === ""){
        $_GET['s'] = "%%";
    }
    if(isset($_GET['i']) && $_GET['i'] === "1"){
        session_start();
        $_GET['shop'] = $_GET['s'];
        $i = "0";
        $prod = "";
        include('cred.php');
        $totalprice = 0;
        foreach($_SESSION['selection'] as $pro){
            $prod = $pro[2]." ".$pro[3]." (".$pro[0].")" . "&nbsp;&nbsp;<em>Total Cost: ".$pro[4].", Price each: ".$pro[4]/$pro[2]."</em><br><hr><br>".$prod;
            $totalprice = $totalprice + $pro[4];
        }
        $prod = $prod."<strong>TOTAL PRICE: </strong>".$totalprice;
        $sql = "INSERT INTO `orders`(`id`, `name`, `address`, `phone`, `order`, `shop`, `mail`, `deny`) VALUES (NULL,'".base64_encode($_COOKIE['Name'])."','".@$_COOKIE['Address']."','".@$_COOKIE['Phone']."','".base64_encode($prod)."', '".$_GET['shop']."', '".base64_encode($_COOKIE['Mail'])."', '0')";
        $con = mysqli_connect($server, $user, $pass, $db);
        if (!isset($_COOKIE['Address']) || $_COOKIE['Address'] === "" || !isset($_COOKIE['Phone']) || $_COOKIE['Phone'] === ""){
            setcookie('kraya_q', base64_encode($sql), time() + (86400 * 30), "/"); // 86400 = 1 day
            ?>
                <script>
                    alert("<?php prl('अकाउंट की कुछ जानकारियों की कमी है, कृपया सम्पूर्ण जानकारिया दे।', 'Some Account Details are missing to place order'); ?> ");
                    window.location="completedete.php?s=<?php echo $_GET['s']; ?>";
                </script>
            <?php
        }else{
        $run = mysqli_query($con, $sql);
        setcookie('kraya_q', '', time() + (86400 * 30), "/"); // 86400 = 1 day
        }
        if (@$run){
            $_SESSION['selection'] = "";
            ?>
                <script>
                    alert("<?php prl("आर्डर दूकान में भेज दिया गया है, आप दूकान से दिए दूरभाष अंको द्वारा संपर्क कर सकते है।", "Order Sent to Shop, You may contact to shop via their contact numbers."); ?>");
                    window.location="index.php?s=<?php echo $_GET['s'] ?>";
                </script>
                <?php 

        }else{
            ?>
                <script>
                    alert("<?php prl("आर्डर भेजने में कुछ बाधा आ गई है। आप दूकान से स्वयं संपर्क कर सकते है।", "Order Can not be made, contact shop via their number manually"); ?>");
                    window.location="index.php";
                </script>
            <?php
        }
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
                            window.location="signin.php?s=<?php echo $s; ?>";</script>
<?php
}
}
?>