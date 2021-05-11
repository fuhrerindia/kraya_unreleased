<?php
ob_start();
?><?php
    $base = basename($_SERVER['PHP_SELF']);
    $sql = "SELECT `loc` FROM `shops` WHERE `domain` LIKE '".$base."'";
    include('cred.php');
    $con = mysqli_connect($server, $user, $pass, $db);
    if ($con){
        if($result = mysqli_query($con, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    ?>
                    <script>
                        window.location="index.php?s=<?php echo $row[0]; ?>";
                    </script>
                    <?php
                }
            }
        }
    }
?>