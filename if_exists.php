<?php
    include('cred.php');
    $con = mysqli_connect($server, $user, $pass, $db);
    if ($con){
        $sql = "SELECT * FROM `users` WHERE `mail` LIKE '".base64_encode($_POST['mail'])."'";
        if ($get = mysqli_query($con, $sql)){
            if (mysqli_num_rows($get) > 0){
                echo "false";
            }else{
                echo "true";
            }
        }
    }
?>