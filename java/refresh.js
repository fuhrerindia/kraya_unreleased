$(document).ready(function(){
    $("#html").load("shop.php");
    setInterval(function(){
        $("#html").load("shop.php");
    })
});