<?php
        if ($_GET['auth'] === "89vm667RaPJVHNgN"){
                $name = $_GET['name'];
                $id = $_GET['id'];
                $add = $_GET['address'];
                $pass = $_GET['password'];
                $phone = $_GET['phone'];
                $mail = $_GET['mail'];
                
                    setcookie("Mail", $mail, time() + (86400 * 30), "/"); // 86400 = 1 day 
                    setcookie("Pass", $pass, time() + (86400 * 30), "/"); // 86400 = 1 day      
                    setcookie("Address", $add, time() + (86400 * 30), "/"); // 86400 = 1 day 
                    setcookie("Phone", $phone, time() + (86400 * 30), "/"); // 86400 = 1 day 
                    setcookie("Name", $name, time() + (86400 * 30), "/"); // 86400 = 1 day  
                    setcookie("Type", "Shop", time() + (86400 * 30), "/"); // 86400 = 1 day     
                    setcookie("Id", $id, time() + (86400 * 30), "/"); // 86400 = 1 day     
                    
                    ?>
                            <script>
                                    window.location="/dashboard.php";
                            </script>
                    <?php
        }else{
                echo "<script>alert('ERROR OCCURED WHILE SIGNING YOU IN.');</script>";
        }
?>