<?php
    if (isset($_POST['email'])){
    include('cred.php');
    if ($conn = mysqli_connect($server, $user, $pass, $db)){
        if ($fetch = mysqli_query($conn, "SELECT * FROM `shops` WHERE `mail` LIKE '".base64_encode($_POST['email'])."'")){
            if (0 < mysqli_num_rows($fetch)){
                echo "false";
            }else{
                echo "true";
            }
        }
    }
}
?>