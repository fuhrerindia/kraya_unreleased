<?php
ob_start();
?><?php
 if (!isset($_GET['s'])){
    $_GET['s'] = "";    
}
    if (!isset($_COOKIE['Mail'])){
        ?>
            <script>
                window.location="signin.php?s=<?php echo $_GET['s']; ?>";
            </script>
        <?php
    }else{
    session_start();
    $id = $_POST['id'];
    unset($_SESSION['selection'][$id]);
    $array = $_SESSION['selection'];
    $new_array = array();
    foreach($array as $each){
        array_push($new_array, $each);
    }
    $_SESSION['selection'] = $new_array;
    ?>
    <script>
    window.location="cont.php?s=<?php echo $_GET['s']; ?>";
    </script>
    <?php
    }
?>