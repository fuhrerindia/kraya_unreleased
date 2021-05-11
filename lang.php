<?php
    function prl($hindi, $english){
        if (@$_COOKIE["lang"] === "en"){
            echo $english;
        }else{
            echo "".$hindi."";
        }
    }    
    function rrl($hindi, $english){
        if (@$_COOKIE["lang"] === "en"){
            return $english;
        }else{
            return "".$hindi."";
        }
    }  
?>