<?php
ob_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp to TMINC</title>
    <link rel="icon" type="image/png" href="http://tminc.ml/images/7.png">
    <meta name="robots" content="noindex" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<?php
    setcookie("SHOP", $_GET['s'], time() + 1200, "/"); //SAVE FOR 20 MIN ONLY

?>
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
    #alreadymail{display:none;  }
    body{background:#ededed;}
    #passerror{display:none}
    #loading_animation{height:0px;}
    input[type="text"],input[type="email"],input[type="password"],input[type="tel"],textarea{margin:5px;width:90%;padding:13px 15px;font-size:16px;text-align:left;color:#404040;border-radius:4px;border:1px solid #ddd;padding-top:10px;padding-bottom:10px;}
    input[type="submit"], .submit{float:right;display:none;cursor:pointer;outline:0;background:#311B92;color:#fff;font-family: 'Noto Sans', sans-serif;border:0;width:85px;height:40px;border-radius:5px;}
    .left, input[type="submit"]{margin:20px;}
    .requirednotice{color:red;text-align:left;display:none;    background: #ff00004d;
    padding: 7px;
    width: fit-content;
    border-bottom-right-radius: 13px;
    border-bottom-left-radius: 13px;
    margin-top: -9px;}
    #passlength{display:none;}
    @media screen and (max-width:450px){
        .box{border:0;width:81%;margin-top:0;}
    }
</style>
    <div class="box">
        <img src="assets/icon.png" class="logo"><br>
        <h2>Sign Up</h2>
        <span>to continue to TMINC</span>
        <noscript><strong>Please enable JavaScript in your browser or upgrade to latest browser to use ths page.</strong></noscript>
        <form action="verify_email.php" id="signupform" method="POST">
            <input type="text" name="name" placeholder="Name*" id="namef" required><br>
            <span class="requirednotice" id="reqname">Above Field Is Required!</span>
            <input type="email" id="mailin" name="mail" placeholder="E-Mail*" required><br>
            <div id="alreadymail" style="    background: #ff949469;
    border-radius: 15px;
    padding: 10px;
    margin: 15px;
    text-align: left;
    color: red;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    width: fit-content;
    margin-top: -10px;">This E-Mail Already exists.</div>
            <span class="requirednotice" id="reqmail">Above Field Is Required!</span>
            <input type="tel" name="phone" id="phonein" placeholder="Contact Number (Without STD Code)*" required><br>
            <span class="requirednotice" id="reqphone">Above Field Is Required!</span>
            <input type="password" name="cp" id="cp" placeholder="Create Password*" required><br>
            <span class="requirednotice" id="reqcp">Above Field Is Required!</span>
            <div id="passerror" style="
    background: red;
    color: #ffff;
    border-radius: 15px;
    padding: 10px;
    margin: 15px;
">Please enter same password in both fields.
</div>
<div id="passlength" style="
    background: red;
    color: #ffff;
    border-radius: 15px;
    padding: 10px;
    margin: 15px;
">Password should be longer than 8 charecters.
</div>
            <input type="password" name="cop" id="cop" placeholder="Confirm Password*" required><br>
            <span class="requirednotice" id="reqcop">Above Field Is Required!</span>
            <textarea placeholder="Full Address*" id="addin" name="address" style="height:105px;" required></textarea>
            <span class="requirednotice" id="reqaddr">Above Field Is Required!</span>
            <img src="assets/loading.gif" alt="" id="loading_animation" style="width:50px;border-radius:25px;">
            <input type="hidden" name="shop" value="<?php echo $_GET['s']; ?>">
            <p>Not your computer? Use a private browsing window to sign up.
        <div>
    <a href="signin.php?s=<?php 
        if (isset($_GET['s'])){
            echo $_GET['s'];
        }else{
            echo "%%";
        }
    ?>" class="left">Already have an account? Login</a>
    <!-- <input type="submit" value="Next">  -->
    </form>
        </div>
        <button class="submit" id="submit">Next</button>
        <script>
            document.getElementById("submit").style.display = "block";
        </script>
        <script>
            document.getElementById("addin").addEventListener("keydown", (e)=>{
                if (e.keyCode === 13){
                    document.getElementById("submit").click();
                }
            });
        </script>
        <script>
            const next = document.getElementById("submit");
            const cp = document.getElementById("cp");
            const cop = document.getElementById("cop");
            const form = document.getElementById("signupform");

            function g_focus(textbox, required){
                document.getElementById(required).style.display = "block";
                document.getElementById(textbox).focus();
                document.getElementById(textbox).style.border="1px solid red";
            }
            function l_focus(id, tb){
                document.getElementById(id).style.display = "none";
                document.getElementById(tb).style.border="1px solid #ddd";
            }
            function fet(id){
                return document.getElementById(id).value;
            }
            function check_password(){
                if (document.getElementById("cp").value.length > 8){
                    return true;
                }else{
                    return false;
                }
            }
            next.addEventListener("click", ()=>{
                if (document.getElementById("namef").value === ""){
                    g_focus("namef", "reqname");
                }else{
                    l_focus("reqname", "namef");
                }

                if (fet("mailin") === ""){
                    g_focus("mailin", "reqmail");
                }else{
                    l_focus("reqmail", "mailin");
                }

                if (fet("phonein") === ""){
                    g_focus("phonein", "reqphone");
                }else{
                    l_focus("reqphone", "phonein");
                }

                if (fet("cp") === ""){
                    g_focus("cp", "reqcp");
                }else{
                    l_focus("reqcp", "cp");
                }

                if (fet("cop") === ""){
                    g_focus("cop", "reqcop");
                }else{
                    l_focus("reqphone", "cop");
                }

                if (fet("addin") === ""){
                    g_focus("addin", "reqaddr");
                }else{
                    l_focus("reqaddr", "addin");
                }

                if (fet("phonein") === ""){
                    g_focus("phonein", "reqphone");
                }else{
                    l_focus("reqphone", "phonein");
                }                
                function validateEmail(email) 
                    {
                        var re = /\S+@\S+\.\S+/;
                        return re.test(email);
                    }

                if (fet("namef") !== "" && fet("mailin") !== "" && fet("phonein") !== "" && fet("cp") !== "" && fet("cop") !== "" && cp.value === cop.value && document.getElementById("cp").value.length > 8){
                    // form.submit();
                    
                    $("#loading_animation").animate({height: "50px"}, 250);
                        $.post("if_exists.php", {mail: document.getElementById("mailin").value}, function(result){
                            $("#loading_animation").animate({height: "0px"}, 250);
                            if (result === "true"){
                                document.getElementById("alreadymail").style.display = "none";
                                document.getElementById("mailin").style.border = "1px solid #ddd";
                                if(validateEmail(document.getElementById("mailin").value)){
                                    form.submit();
                                }else{
                                    g_focus("mailin", "reqmail");
                                    document.getElementById("reqmail").innerHTML = "This is not a Valid E-Mail";
                                }
                            }else{
                                document.getElementById("alreadymail").style.display = "block";
                                document.getElementById("mailin").style.border = "1px solid red";
                            }
                        });
                }   
                    if (fet("cp") === fet("cop")){
                        document.getElementById("passerror").style.display="none";
                    }else{
                        document.getElementById("passerror").style.display="block";
                    }
                    if (document.getElementById("cp").value.length < 9){
                        document.getElementById("reqcop").innerHTML = "Password should be longer";
                        cp.style.border = "1px solid red";
                        cop.style.border = "1px solid red";
                        document.getElementById("reqcop").style.display = "block";
                    }else{
                        cp.style.border = "1px solid #ddd";
                        cop.style.border = "1px solid #ddd";
                        document.getElementById("reqcop").style.display = "Above Field is required";
                        if (document.getElementById("reqcop").value === ""){
                            document.getElementById("reqcop").style.display = "block";
                        }else{
                            document.getElementById("reqcop").style.display = "none";
                            
                        }
                    }

            });
        </script>
    </div>
</body>
</html>