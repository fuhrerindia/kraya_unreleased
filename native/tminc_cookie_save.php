<?php
        if ($_GET['auth'] === "89vm667RaPNgN"){
                $address = $_GET['add'];
                $phone = $_GET['ph'];
                $pass = $_GET['pass'];
                $name = $_GET['name'];
                $mail = $_GET['mail'];
                $id = $_GET['shop'];
                
                    setcookie("Mail", $mail, time() + (86400 * 30), "/"); // 86400 = 1 day 
                    setcookie("Pass", $pass, time() + (86400 * 30), "/"); // 86400 = 1 day      
                    setcookie("Address", $address, time() + (86400 * 30), "/"); // 86400 = 1 day 
                    setcookie("Phone", $phone, time() + (86400 * 30), "/"); // 86400 = 1 day 
                    setcookie("Name", $name, time() + (86400 * 30), "/"); // 86400 = 1 day  

                    
                    ?>
                            <script>
                                    window.location="/index.php?s=<?php echo $id; ?>";
                            </script>
                    <?php
        }else{
                echo "<script>alert('ERROR OCCURED WHILE SIGNING YOU IN.');</script>";
        }
?>