<?php
ob_start();
include_once('lang.php');
?><?php
if (!isset($_GET['q'])){
    $_GET['q'] ="";
}
?>
<script src="java/root.js"></script>
<header><div class="header">
<?php 
    if (isset($_COOKIE['Type'])){
        $link = "dashboard.php";
    }else{
        $link = "index.php?s=".$_GET['s'];
    }
if (!isset($_COOKIE['Id'])){
    ?>
    <i class="material-icons orderbtn" id="menubtn" style="cursor:pointer;">menu</i>
    <script>
        $(document).ready(function(){
            $("#menubtn").click(function(){
                if ($("#menubtn").html() === "menu"){
                    $("#menuul").show();
                    $("#menuprnt").show(300);
                    $("#menubtn").html("clear");
                }else{
                    $("#menuul").hide();
                $("#menuprnt").hide(300);
                $("#menubtn").html("menu");
                }
                

            });
        });
    </script>
    <?php
    if (basename($_SERVER['PHP_SELF']) === "your_order.php"){
    ?>
    <i class="material-icons orderbtn"><a href="index.php?s=<?php echo $_GET['s']; ?>" class="dowhite"></a></i><?php }else{?>
    <i class="material-icons orderbtn"><a href="your_order.php?s=<?php echo $_GET['s']; ?>" class="dowhite"></a></i><?php
}

    }?>
<span class="title-f" style="    display: inline-block;
    margin: 15px;
    margin-left:15px;
    font-size:14px  ;
    color: #fff;font-weight:unset;
    font-family: sans-serif;">
    <a href="<?php echo $link; ?>" class="headtitle" id="title">
    <?php
    if (!isset($heading)){
        if (!isset($_GET['s']) || $_GET['s'] === ""){
            echo "<img src='assets/logo.png' style='    width: 35px;
            margin: -7px;
            height:35px;
            margin-left: 10px;'>";
        }else{
            include('cred.php');
            $con = mysqli_connect($server, $user, $pass, $db);
            $sql = "SELECT `name`, `color` FROM `shops` WHERE `loc` LIKE '".$_GET['s']."'";
            if($result = mysqli_query($con, $sql)){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                        echo base64_decode($row[0]);
                        $col =  $row[1];
                    }
                }
            }
        }
    }else{
        echo base64_decode(str_replace("<%up%>", "'", $heading));
    }
    ?>
    </a>
</span><?php
if (!isset($_COOKIE['Type'])){
      ?>
      <button class="material-icons searchbtn" id="searchbtn" style="    position: unset;
    width: unset;
    border: unset;
    padding-top: 11px;
    margin-right: 7px;
    margin: unset;">search&nbsp;</button>
        <div class="form"><form action="search.php" method="GET">
    <input type="hidden" name="s" value="<?php echo $_GET['s']?>">
        <input type="search" name="q" placeholder="<?php prl("सामान ढूंढे", "Search for Products"); ?>" value="<?php echo $_GET['q']; ?>" class="searchbox" id="searchbox" style="text-align:left" required><input type="submit" style="display:none">
    </form></div>
      <?php
    }
    ?>
    <script src="java/togglenew.js"></script>
    </div>
<div class="jagah"></div></header>
<div class="menubox" id="menuprnt">
<style>
    .menubox{height: 100vh;
    position: fixed;
    left: 0;
    display:none;
    width: 20%;
    background: #fff;
    box-shadow: 0 0 10px #404040;}
    .menulist li a{
        text-decoration:none;
        color:#000;

    }
    .menulist li{
        width: 100%;
    text-align: center;
    margin: 10px;
    margin-left: 0;
    font-family: sans-serif;
    padding-top: 6px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 12px;
    }
    @media screen and (max-width: 900px){
        .menubox{width:95%}
    }
</style>
<?php
if (!isset($_COOKIE['Type'])){ 
    include('releasenotes.php');
}
    ?>
    <ul class="menulist" id="menuul">
        <li>
            <a href="index.php?s=<?php echo $_GET['s']?>">
            <?php prl("सब कुछ", "EVERYTHING"); ?>
        </a>
        </li>
        <li>
            <a href="cont.php?s=<?php echo $_GET['s']?>">
            <?php prl("कार्ट", "CART"); ?>
        </a>
        </li>
        <li>
            <a href="your_order.php?s=<?php echo $_GET['s']?>"><?php prl("अपूर्ण आर्डर", "PENDING ORDERS"); ?></a>
        </li>
        <li>
        <a href="shop_info.php?s=<?php echo $_GET['s']?>"><?php prl("दूकान", "SHOP INFO"); ?></a>
        </li>
        <li>
            <a href="account.php?s=<?php echo $_GET['s']?>"><?php prl("अकाउंट", "ACCOUNT"); ?></a>
        </li>
        <li>
            <a style="cursor:pointer" onclick="document.getElementById('langdropoverlay').style.display='block'"><?php prl("भाषा", "LANGUAGE"); ?></a>
        </li>
        <li>
            <a href="http://tminc.ml/bug?app=Kraya User"><?php prl("दिक्कत साझा करे", "REPORT ISSUE"); ?></a>
        </li>
        <?php
        if (!isset($_COOKIE['Type'])){ 
            ?>
        <li>
            <a id="show-release-notes-button" style="cursor:pointer;"><?php prl("रिलीज़ नोट", "RELEASE NOTES"); ?></a>
        </li>
        <script src="java/release.js"></script>
<?php } ?>
        <li style="cursor:pointer;">
            <a onclick="deleteAllCookies()"><?php prl("लोग आउट", "LOG OUT"); ?></a>
            <script>
                function deleteAllCookies() {
            document.cookie = "Id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "Mail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "User=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "Pass=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "Type=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "Address=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "Name=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "Phone=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "id=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            alert("<?php prl('आपको साइन आउट किया जा रहा है', 'Signed Out, Password Changes'); ?>");
            <?php
                                if(isset($_GET['s'])){
                                    $s = $_GET['s'];
                                }else{
                                    $s = "%%";
                                }
                            ?>
                            window.location="signin.php?s=<?php echo $s; ?>";
                }
            </script>
        </li>
    </ul>
</div>