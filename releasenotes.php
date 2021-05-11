<?php
    include_once("lang.php");
?>
<style>
                #over-dialog{width: 100%;
    height: 100vh;
    position: fixed;
    top: 0;
    display:none;
    text-align:center;
    left: 0;
    z-index: 3;
    backdrop-filter: blur(3px);}
    #dialog-release{
        width: 60%;
    background: #fff;
    padding: 31px;
    border-radius: 15px;
    box-shadow: 0 0 44px #404040;
    display: inline-block;
    text-align: left;
    margin-top: 10vh;
    max-height:69vh;
}
    #over-dialog h4, #over-dialog h3, p, div{
        font-family:sans-serif;
    }
        </style>
        <div id="over-dialog">
            <div id="dialog-release">
            <div id="closebtnalign" style="width:100%;text-align:right"><button style="color:red;font-weight:bold;font-size:30px;cursor:pointer;background:transparent;border:0" class="material-icons" id="close-release-notes-button">clear</button></div>
                <h3 style="color:#3d3d3d">
                    <?php prl("रिलीज़ नोट्स - क्या नया है?", "Release Notes - What's New?"); ?> 
                </h3>
                <hr style="margin:21px;">
                <div style="    color: #222;
    margin: 10px;
    overflow-y: scroll;
    height: 48vh;line-height:30px;">
        <?php prl('<h4>ग्राहक की तरफ</h4>
        <ul style="list-style:inside;">
            <li>एन्ड टू एन्ड एन्क्रिप्शन</li>
            <li>फ्रंट एन्ड बग ठीक किये गए</li>
            <li>बैक एन्ड बग ठीक किये गए</li>
            <li>रिलीज़ नोट का विकल्प बनाया गया</li>
            <li>\'होम\' का नाम बदल कर \'सबकुछ\' किया गया </li>
            <li>हिंदी भाषा को जोड़ा गया</li>
            <li>हिंदी भाषा को पूर्व स्थापित गया</li>
        </ul>
        <h4>दूकान की तरफ</h4>
        <ul style="list-style:inside;">
            <li>उत्पादों के अलावा हर चीज़ को एन्ड-टू -एन्ड एन्क्रिप्टेड किआ गया</li>
            <li>ऑर्डर्स को एन्ड-टू-टू एन्क्रिप्टेड किया गया</li>
            <li>बग के बारे में मिंक को सूचित करने का बटन</li>
            <li>दूकान की जानकारी बदलने का विकल्प</li>
            <li>लॉंग आउट करने का बटन</li>
            <li>मिंक को सुझाव देने का विकल्प</li>
            <li>यु. आई. सुधारा गया</li>
            <li>रिलीज़ नोट जोड़ा गया</li>
            <li>हिंदी भाषा को जोड़ा गया</li>
            <li>हिंदी भाषा को पूर्व स्थापित गया</li>
        </ul>
        <h4>मिंक अकाउंट मे</h4>
        <ul style="list-style:inside;">
        <li>एन्ड टू एन्ड एन्क्रिप्शन</li>
        <li>ओ. टी. पी. वेरिफिकेशन</li>
        <li>अंधरुनि दिक्कते सुधरी गई</li>
        <li>अकाउंट रिकवरी जोड़ा गया</li>
        <li>सुरक्षा बधाई गई</li>
        </ul>','<h4>User\'s End</h4>
        <ul style="list-style:inside;">
            <li>End-to-End Encryption</li>
            <li>Frontend Bugs Fixed</li>
            <li>Backend Bugs Fixed</li>
            <li>Added Release Notes Button</li>
            <li>Home Renamed with "Everything"</li>
        </ul>
        <h4>Shop\'s End</h4>
        <ul style="list-style:inside;">
            <li>End-to-End Encryption except Products.</li>
            <li>Orders are encrypted.</li>
            <li>Report Bug Option</li>
            <li>Edit Shop Info Option</li>
            <li>Log Out at a click feature</li>
            <li>Send suggestions to TMINC button</li>
            <li>UI Fixation</li>
            <li>Added Release Notes Button</li>
        </ul>
        <h4>TMINC Account</h4>
        <ul style="list-style:inside;">
        <li>End-to-End encryption</li>
        <li>OTP Verification</li>
        <li>Bugs fixed</li>
        <li>Account Recovery</li>
        <li>Enhanched Security</li>
        </ul>'); ?>
    </div>
            </div>
        </div>

        <div id="langdropoverlay" style="    width: 100%;
    height: 100vh;
    position: fixed;
    display:none;
    top: 0;
    left: 0;
    text-align: center;
    backdrop-filter: blur(4px);
    z-index: 18;">
            <div class="langdialog" style="    background: #fff;
    margin-top: 22vh;
    width: fit-content;
    display: inline-block;
    padding: 27px;
    border-radius: 15px;
    box-shadow: 0 0 38px #404040;
}">
<div class="tocloselangbutton" style="width: 100%;
    text-align: right;"><button class="material-icons" style="    background: #fff;
    border: 0;
    color: red;
    cursor: pointer;
    margin-bottom: 12px;" onclick="document.getElementById('langdropoverlay').style.display = 'none';">clear</button></div>
                <h3 style="    margin-bottom: 25px;"><?php prl("भाषा चुने", "Select Language"); ?></h3>
                <select name="langselect" id="langselect" style="padding: 7px;
    border-radius: 15px;
    background: #fff;
}">
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
    document.getElementById("langselect").addEventListener("change", ()=>{
        createCookie("lang", document.getElementById("langselect").value);
        window.location="";
    });
    </script>