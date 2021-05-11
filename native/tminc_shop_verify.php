<?php
        if ($_GET['auth_token'] === "q/Q@[29NZQMQ.J?"){
        include('../cred.php');
        if ($con = mysqli_connect($server, $user, $pass, $db)){
                $sql = "SELECT * FROM `shops` WHERE `mail` LIKE '".$_GET['tminc_user']."' AND `password` LIKE '".$_GET['tminc_pass']."'";
                if ($run = mysqli_query($con, $sql)){
                        if (0 < mysqli_num_rows($run)){
                                while ($row = mysqli_fetch_array($run)){
                                        echo $row['name']."<tminc>".$row['loc']."<tminc>".$row['address']."<tminc>".$row['phone'];
                                }
                        }
                }
        }
        }
?>