<?php
ob_start();
include("lang.php");
?><?php

$_GET['s'] = $_POST['s'];
$_GET['shop'] = $_POST['s'];
$_GET['i'] = $_POST['i'];

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
        $sql = "INSERT INTO `orders`(`id`, `name`, `address`, `phone`, `order`, `shop`, `mail`, `deny`) VALUES (NULL,'".base64_encode($_COOKIE['Name'])."','".base64_encode($_POST['address'])."','".base64_encode($_POST['phone'])."','".base64_encode($prod)."', '".$_GET['shop']."', '".base64_encode($_COOKIE['Mail'])."', '0')";
        $con = mysqli_connect($server, $user, $pass, $db);
        $run = mysqli_query($con, $sql);
        if ($run){
            $_SESSION['selection'] = "";
            ?>
                <script>
                    alert("<?php prl("आपका आर्डर दूकान गया है, अगर जरुरत पड़ें तो आप दूकान के दूरभाष अंको पे संपर्क कर सकते है ", "Order Sent to Shop, You may contact to shop via their contact numbers."); ?>");
                    window.location="index.php?s=<?php echo $_GET['s'] ?>";
                </script>
            <?php
        }else{
            ?>
                <script>
                    alert("<?php prl("आर्डर भेजने में कुछ बाधा आ गई है, कृपया दूकान से स्वयं संपर्क करे", "Order Can not be made, contact shop via their number manually"); ?>");
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