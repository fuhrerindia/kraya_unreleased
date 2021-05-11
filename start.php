<?php 
    include('lang.php');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kraya - TMINC</title>
            <meta name="title" content="TMINC Kraya - Move your shop online easily with TMINC">

    <meta name="Description" content="Move shop online easily for free without ads. ">
<meta name="Keywords" content="tminc kraya, kraya, tminc, move online, online ecommerce, create ecommerce website for free, ecommerce">
        <meta name="robots" content="index, follow">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="English">
        <meta name="revisit-after" content="7 days">
        <meta name="author" content="TMINC">
</head>
<body>
<script src="http://tminc.ml/jq.js"></script>
<script>
    $(document).ready(function(){
        $("#shop").click(function(){
            window.location="register.php";
        });
        $("#admin").click(function(){
            $("#over").show();
        });
        $("#close").click(function(){
            $("#over").hide();
        });
    });
    document.getElementsByTagName("body")[0].addEventListener("keydown", (e)=>{
                if (e.key === "Escape"){
                    $("#over").hide();
                }
            });
</script>
    <style>
    *{
        margin:0;
        padding:0;
        font-family:sans-serif; 
        transition:0.3s;
        outline:0;
    }
        body{
            background: #ddd;
    color: #161616;
    background-size: 100% 100vh;
    background-attachment: fixed;
    padding: 30px;
    text-align: center;
        }
        .material-icons{
            color: #404040;
    font-size: 47px;
        }
        .overlay{
            position: fixed;
    width: 100%;
    height: 100vh;
    background: #000000b0;
    display:none;
    top: 0;
    left: 0;
    backdrop-filter: blur(4px);
        }
        .dialog{
            width: 60%;
    background: #ffffffdb;
    border-radius: 10px;
    margin-top: 20vh;
    margin-left: 21%;
    padding-bottom:14vh;
    text-align:center;
        }
        .dialog h3{
            margin: 25px;
    margin-top: 58px;
    font-size: 29px;
    color: #363636;
        }
        input[type="submit"]{
            cursor: pointer;
    margin-left: -10px;
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;
    border: 1px solid #ddd;
    background: #7c510d;
    color: #fff;
    padding: 6px;
        }
        .cp{
            width:100%;
        }
        .cp i{    float: right;
    margin: 11px;
    font-size: 31px;
    cursor:pointer;
    color: red;}
        input[type="text"]{
            background: #ffffffd4;
    padding: 6px;
    border: 1px solid #404040;
    width: 70%;
    border-radius: 12px;
    border: 1px solid #ddd;
    box-shadow: 0 0 18px #7c7a7a;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
            
        }
        .ele{
            width: 250px;
    margin-top: 10px;
    padding: 10px;
    cursor: pointer;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: saturate(180%) blur(20px)!important;
    height: 250px;
    text-align: center;
    display: inline-block;
    margin: 22px;
        }
        .ele ul li{
            margin: 8px;
        }
        .to{
            margin: 8px;
    font-size: 25px;
        }
        .ele ul{
            
    list-style: none;
    margin-top: 70px;
}
        
        .ele:hover{
            box-shadow: 0 0 30px #000;
        }
        #langselect{width:100%;text-align:right;}
        #langselect select{    padding: 6px;
    border-radius: 12px;
    background: #fff;
}}
        @media screen and (max-width: 500px){
            .ele{
                width:90%;
            }
            .dialog{
                width: 90%;
    margin-left: 15px;
            }
        }
    </style>
    <div id="langselect">
        <select name="language" id="lang">
        <?php
            if ($_COOKIE['lang'] === "en"){
                ?><option value="en">English</option>
                <option value="hi">हिंदी (सलाहित )</option>
                <?php
            }else{
                ?>
                <option value="hi">हिंदी (सलाहित )</option>
                <option value="en">English</option>
                <?php
            }
        ?>
            
        </select>
    </div>
    <script>
        function createCookie(name, value, days) {
    var date, expires;
    if (days) {
        date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        expires = "; expires="+date.toUTCString();
    } else {
        expires = "";
    }
    document.cookie = name+"="+value+expires+"; path=/";
}
    document.getElementById("lang").addEventListener("change", ()=>{
        createCookie("lang", document.getElementById("lang").value);
        window.location="";
    });
    </script><br><br>
    <h1><?php prl("कहा जाये? &bull; मिंक क्राया", "Where to Navigate &bull; TMINC Kraya"); ?></h1>
    <div class="ele" id="admin">
        <ul>
            <li>
                <i class="material-icons">shopping_bag</i>
            </li>
            <li class="to">
                <span><?php prl("ऑनलाइन स्टोर", "Online Store"); ?></span>
            </li>
        </ul>
    </div>

    <div class="ele" id="shop">
        <ul>
            <li>
                <i class="material-icons">store</i>
            </li>
            <li class="to">
                <span><?php prl("दुकान का डैशबोर्ड", "Shop Dashboard"); ?></span>
            </li>
        </ul>
    </div>
    <div class="overlay" id="over">
        <div class="dialog">
        <div class="cp"><i class="material-icons" id="close">clear</i></div>
        <br>
        <h3><?php prl("ऑनलाइन दूकान जाए", "Open Online Store"); ?></h3>
            <form action="" method="post">
                <input type="text" name="id" placeholder="<?php prl("क्राया दूकान कोड या दूकान का लिंक डाले", "Enter Kraya Store ID / URL"); ?>" required>
                <input type="submit" value="<?php prl("चले", "Go"); ?>" name="go">
            </form>
        </div>
    </div>
</body>
<?php
    if (isset($_POST['go'])){
        $in = $_POST['id'];
        if (strpos($in, "kraya")){
            $arr = explode("?s=", $in);
            $val = $arr[1];
        }else{
            $val = $in;
        }?>
        <script>
            window.location="index.php?s=<?php echo $val; ?>";
        </script>
        <?php   
    }
?>
</html>