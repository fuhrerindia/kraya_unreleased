<?php
ob_start();
?><?php
    // CONNECT AND GET MAIL DETAILS FROM DATABASE
        // INCLUDING MAIL CREDENTIALS
        include('cred.php');
        include('lang.php');
        $connect_to_verify = mysqli_connect($server, $user, $pass, $db);
        if ($connect_to_verify){
            $query_to_verify = "SELECT * FROM `shops` WHERE `mail` LIKE '".$_COOKIE['Mail']."' AND `password` LIKE '".base64_decode($_COOKIE['Pass'])."'";
            if ($get_shop_from_table = mysqli_query($connect_to_verify, $query_to_verify)){
                if (0 < mysqli_num_rows($get_shop_from_table)){

if (isset($_POST['del'])){
if (isset($_POST['todel'])){
    $td = $_POST['todel'];
    $i = 1;
    $qd = "";
    foreach ($td as $e){
        if ($i == 1){
            $qd = "`id` LIKE '".$e."'";
        }else{
            $qd = $qd." OR `id` LIKE '".$e."'";
        }
        $i++;
    }
    include('cred.php');
    $mail_sql = "SELECT * FROM `orders` WHERE ".$qd;
    $sql = "UPDATE `orders` SET `deny` = '3' WHERE ".$qd;
    $con = mysqli_connect($server, $user, $pass, $db);
    if ($get = mysqli_query($con, $mail_sql)){
        $all_users = mysqli_fetch_array($get);
    }
    $del = mysqli_query($con, $sql);
    if ($del){
        ?>
            <script>
                alert('<?php prl("रिकॉर्ड हटा दिए गए", "Records Removed"); ?>');
                window.location="shop.php";
            </script>
        <?php

        // MAILING TO USER ABOUT STATUS


    
    }else{
        ?>
            <script>
                alert('<?php prl("रिकॉर्ड हटाने में कोई समस्या आ गई", "Records Can\'t be Removed"); ?>');
                window.location="shop.php";
            </script>
        <?php
    }
}else{
    ?>
        <script>
            alert('<?php prl("रिकॉर्ड हटाने के लिए काम से काम एक आर्डर चुने", "Select Atleast one record to delete"); ?>');
            window.location="shop.php";
        </script>
    <?php
}
}else if(isset($_POST['mrk'])){
    if (isset($_POST['todel'])){
        $td = $_POST['todel'];
        $i = 1;
        $qd = "";
        foreach ($td as $e){
            if ($i == 1){
                $qd = "`id` LIKE '".$e."'";
            }else{
                $qd = $qd." OR `id` LIKE '".$e."'";
            }
            $i++;
        }
        include('cred.php');
        $sql = "UPDATE `orders` SET `deny`='1' WHERE ".$qd;
        $con = mysqli_connect($server, $user, $pass, $db);
        $del = mysqli_query($con, $sql);
        if ($del){
            ?>
                <script>
                    alert('<?php prl("रिकॉर्ड को चिह्नित कर दिया गया है", "Records Marked, User will be notified."); ?>');
                    window.location="shop.php";
                </script>
            <?php
        }else{
            ?>
                <script>
                    alert('<?php prl("रिकॉर्ड नहीं हटाया जा सका है।", "Records Can\'t be Removed"); ?>');
                    window.location="shop.php";
                </script>
            <?php
        }
    }else{
        ?>
            <script>
            alert('<?php prl("रिकॉर्ड हटाने के लिए काम से काम एक आर्डर चुने", "Select Atleast one record to delete"); ?>');
                window.location="shop.php";
            </script>
        <?php
    } 
}if (isset($_POST['out'])){
    if (isset($_POST['todel'])){
        $td = $_POST['todel'];
        $i = 1;
        $qd = "";
        foreach ($td as $e){
            if ($i == 1){
                $qd = "`id` LIKE '".$e."'";
            }else{
                $qd = $qd." OR `id` LIKE '".$e."'";
            }
            $i++;
        }
        include('cred.php');
        $sql = "UPDATE `orders` SET `deny` = '2' WHERE ".$qd;
        $con = mysqli_connect($server, $user, $pass, $db);
        $del = mysqli_query($con, $sql);
        if ($del){
            ?>
                <script>
                    alert('<?php prl("रिकार्ड्स ठीक किये गए है", "Records Updated"); ?>');
                    window.location="shop.php";
                </script>
            <?php
        }else{
            ?>
                <script>
                    alert('<?php prl("रिकॉर्ड नहीं हटाया जा सका", "Records Can\'t be Removed"); ?>');
                    window.location="shop.php";
                </script>
            <?php
        }
    }else{
        ?>
            <script>
            alert('<?php prl("रिकॉर्ड हटाने के लिए काम से काम एक आर्डर चुने", "Select Atleast one record to delete"); ?>');
                window.location="shop.php";
            </script>
        <?php
    }
    }


}else{
    ?><script>
        document.cookie = "Id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Mail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Address=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Phone=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                            alert("<?php prl("आप को साइन आउट किया जा रहा है", "You are now logged out."); ?>");
        window.location = "shop_login.php";
    </script><?php
}
}else{
?>
<script>
alert('<?php prl("सर्वर एरर", "Server Error"); ?>');
document.cookie = "Id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Mail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Address=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Phone=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
</script>
<?php 
}
}else{
?>
<script>
alert('<?php prl("सर्वर एरर", "Server Error"); ?>');
document.cookie = "Id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Mail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Address=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Phone=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
</script>
<?php
}
?>