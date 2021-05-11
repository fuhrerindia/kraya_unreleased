<?php
ob_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin With TMINC</title>
    <link rel="icon" type="image/png" href="http://tminc.ml/images/7.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="robots" content="noindex" />
</head>
<body>
<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap');
    *{color:#666;text-align:center;margin:0;font-size:14px;padding:0;font-family: 'Noto Sans', sans-serif;}
    .box{padding:20px;margin-top:15vh;padding-bottom:36px;border:1px solid #ddd;border-radius:8px;width:445px;display:inline-block;background:#fff;}
    .logo{height:50px;display:inline-block;margin:40px;margin-bottom:0px}
    h2{color:#202124;margin-bottom:10px;font-size:24px;font-weight:100;}
    p{width:90%;text-align:left;margin:30px;display:inline-block;}
    a{text-decoration:none;color:#311B92;font-weight:5px}
    .left{float:left;}
    span{display:block;margin:10px;}
    body{background:#ededed;}
    input[type="text"],input[type="email"],input[type="password"],input[type="tel"],textarea{margin:5px;width:90%;padding:13px 15px;font-size:16px;text-align:left;color:#404040;border-radius:4px;border:1px solid #ddd;padding-top:10px;padding-bottom:10px;}
    input[type="submit"], .submit{float:right;cursor:pointer;outline:0;background:#311B92;color:#fff;font-family: 'Noto Sans', sans-serif;border:0;width:85px;height:40px;border-radius:5px;}
    .left, input[type="submit"], .submit{margin:20px;}
    .submit{display:none}
    #loading_animation{height:0px;}
    .reqnotice{    width: fit-content;
    background: #ffe3e3;
    color: red;
    padding: 9px;
    border-bottom-right-radius: 12px;
    display:none;
    border-bottom-left-radius: 12px;
    margin-top: -12px;}
    @media screen and (max-width:450px){
        .box{margin: 0;
    width: 82%;
}
    }
</style>
    <div class="box">
        <img src="assets/icon.png" class="logo"><br>
        <h2>Register Shop</h2>
        <span>to sell with TMINC</span>
        <noscript><strong>Please enable JavaScript in your browser or upgrade to latest browser to fill this form.</strong></noscript>
        <form action="register_shop_verify.php" method="POST" id="registform">
            <input type="text" name="name" placeholder="Owner Name*" class="tbhidden" id="name" required><br>
            <span class="reqnotice" id="reqname">This Field is Required</span>
            <input type="email" name="mail" placeholder="E-Mail*" class="tbhidden" id="mail" required><br>
            <span class="reqnotice" id="reqmail">This Field is Required</span>
            <input type="text" name="shop_name" class="tbhidden" placeholder="Shop Name*" id="shop" required><br>
            <span class="reqnotice" id="reqshop">This Field is Required</span>
            <input type="tel" name="phone" class="tbhidden" placeholder="Contact Number as on WhatsApp (Without +91)*" id="phone" required><br>
            <span class="reqnotice" id="reqphone">This Field is Required</span>
            <input type="password" name="cp" class="tbhidden" placeholder="Create Password*" id="cp" required><br>
            <span class="reqnotice" id="reqcp">This Field is Required</span>
            <input type="password" name="cop" class="tbhidden" placeholder="Confirm Password*" id="cop" required><br>
            <span class="reqnotice" id="reqcop">This Field is Required</span>
            <textarea placeholder="Full Shop Address*" class="tbhidden" name="address" id="addr" style="height:105px;"></textarea>
            <span class="reqnotice" id="reqaddr">This Field is Required</span>
            <input type="hidden" name="shop" value="">
            <img src="assets/loading.gif" alt="" id="loading_animation" style="width:50px;border-radius:25px;">

            <p>Not your computer? Use a private browsing window to sign up.
        <div>
    <a href="shop_login.php" class="left">Already registered? Login</a>
    <!-- <input type="submit" value="Next" name="regis"> -->
     </form>
        </div>
        <button class="submit" id="submit">Next</button>
        <script>
        document.getElementById("addr").addEventListener("keydown", (e)=>{
                if (e.keyCode===13 && e.ctrlKey){
                    document.getElementById("submit").click();
                }
            });
        document.getElementById("submit").style.display = "block";
            function gbid(id){
                return document.getElementById(id);
            }
            function val(id){
                return document.getElementById(id).value;
            }
            function validateEmail(email) 
                    {
                        var re = /\S+@\S+\.\S+/;
                        return re.test(email);
                    }
            function g_focus(tb, rb){
                document.getElementById(tb).style.border = "1px solid red";
                document.getElementById(tb).focus();
                document.getElementById(rb).style.display = "block";
            }
            function l_focus(tb){
                rb = "req" + tb;
                document.getElementById(tb).style.border = "1px solid #ddd";
                document.getElementById(rb).style.display = "none";    
            }
            document.getElementById("submit").addEventListener("click", ()=>{
                if (val("name") !== "" && val("mail") !== "" && val("shop") !== "" && val("phone") !== "" && val("cp") !== "" && val("cop") !== "" && val("addr") !== "" && val("cp") === val("cop") && val("cp").length > 8 && validateEmail(val("mail"))){
                    $(".reqnotice").css("display", "none");
                    $(".tbhidden").css("border", "1px solid #ddd");
                    $("#loading_animation").animate({height: "50px"});
                    $.post("if_shop.php", {email: val("mail")}, function(result){
                        $("#loading_animation").animate({height: "0px"});
                        if (result === "true"){
                            l_focus("mail");
                            gbid("reqmail").innerHTML = "This Field is Required";
                            gbid("registform").submit();
                        }else{
                            g_focus("mail", "reqmail");
                            gbid("reqmail").innerHTML = "Account already exists.";
                        }
                    })
                }else{
                    if (val("name") === ""){
                        g_focus("name", "reqname");
                    }else{
                        l_focus("name");
                    }
                    if (val("mail") === ""){
                        g_focus("mail", "reqmail");
                    }else{
                        l_focus("mail");
                    }
                    if (val("shop") === ""){
                        g_focus("shop", "reqshop");
                    }else{
                        l_focus("shop");
                    }
                    if (val("phone") === ""){
                        g_focus("phone", "reqphone");
                    }else{
                        l_focus("phone");
                    }
                    if (val("cp") === ""){
                        g_focus("cp", "reqcp");
                    }else{
                        l_focus("cp");
                    }
                    if (val("cop") === ""){
                        g_focus("cop", "reqcop");
                    }else{
                        l_focus("cop");
                    }
                    if (val("addr") === ""){
                        g_focus("addr", "reqaddr");
                    }else{
                        l_focus("addr");
                    }
                    if (val("cp") !== val("cop")){
                        gbid("cp").style.border = "1px solid red";
                        gbid("reqcop").innerHTML = "Please enter same password";
                        g_focus("cop", "reqcop");
                    }else{
                        gbid("cp").style.border = "1px solid #ddd";
                        gbid("reqcop").innerHTML = "This Field is Required";
                        if (val("cop") === ""){
                            l_focus("cop");
                            }else{
                                g_focus("cop", "reqcop");
                            }
                    }
                    if (val("cop").length < 9){
                        g_focus("cp", "reqcp");
                        gbid("reqcp").innerHTML = "Password should be longer";
                    }else{
                        l_focus("cp");
                        gbid("reqcp").innerHTML = "This Field is Required";
                    }
                    if (validateEmail(val("mail"))){
                        l_focus("mail");
                        gbid("reqmail").innerHTML = "This Field is Required";
                    }else{
                        g_focus("mail", "reqmail");
                        gbid("reqmail").innerHTML = "Invalid E-Mail";
                    }
                }
            });
        </script>
    </div>
</body>
</html>