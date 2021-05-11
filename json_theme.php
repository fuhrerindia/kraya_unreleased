<?php
ob_start();
?><?php
    $sql = "SELECT `color` FROM `shops` WHERE `loc` LIKE '".$_GET['s']."'";
    include('cred.php');
    $con = mysqli_connect($server, $user, $pass, $db);
    if ($con){
        $result = mysqli_query($con, $sql);
        if ($result){
            if (0 < mysqli_num_rows($result)){
                $color = mysqli_fetch_array($result)[0];
                if("" === $color){
                    echo "DEFAULT";
                }else{
                    $array = explode("hash", $color);
                    echo "#".$array[1];               
                }   
                     }else{
                echo "SHOP NOT FOUND";
            }
        }else{
            echo "<font color='red'>Call Error</font>";
        }
    }else{
        echo "<font color=red>Connection Error</font>";
    }
?>