<?php
ob_start();
?><?php
    $password = base64_decode($_COOKIE['Pass']);
    $mail = $_COOKIE['Mail'];
    $sql = "SELECT * FROM `users` WHERE `mail` LIKE '".$mail."'";
    include('cred.php');
    $connect = mysqli_connect($server, $user, $pass, $db);
    if ($values = mysqli_query($connect, $sql)){
        if(mysqli_num_rows($values) > 0){
            while($col = mysqli_fetch_array($values)){
                if ($col['password'] === $password){
                    ?>
<?php

    //CODE BY PAURUSH SINHA ; tminc.ml
    if (!isset($_GET['s'])){
        $_GET['s'] = "";
    }
    if (isset($_POST['id'])){
    $new = array($_POST['id'], $_POST['shop'], $_POST['quant'], $_POST['name'], $_POST['cost']);
    session_start();
        if (isset($_SESSION['selection'])){
            if ($_SESSION['selection'] === ""){
                $ss = array();
            }else{
            $ss = $_SESSION['selection'];
            }
        }else{
            $ss = array();
        }
            array_unshift($ss, $new);
            $_SESSION['selection'] = $ss;
            ?>
                <script>
                window.location="index.php?s=<?php echo $_GET['s'] ?>";
                </script>
            <?php
        }else{
        ?>
            <script>
                window.location="index.php?s=<?php echo $_GET['s'] ?>";
            </script>
        <?php
    }
?>
                    <?php
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
                            alert('Signed Out, Password Changes');
                            window.location="signin.php";
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
                    alert('Signed Out, Password Changes');
                    window.location="signin.php";
                </script>
            <?php
        }
    }
?>