<?php
        if ($_GET['auth_token'] === "q/Q@[29NRMQ.J?"){
        include('../cred.php');
        if ($con = mysqli_connect($server, $user, $pass, $db)){
                $sql = "SELECT * FROM `users` WHERE `mail` LIKE '".$_GET['tminc_user']."' AND `password` LIKE '".$_GET['tminc_pass']."'";
                if ($run = mysqli_query($con, $sql)){
                        if (0 < mysqli_num_rows($run)){
                                while ($row = mysqli_fetch_array($run)){
                                        echo $row['name']."<tminc>".$row['phone']."<tminc>".$row['address'];
                                }
                        }
                }
        }
        }
?>