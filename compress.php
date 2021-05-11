<?php
ob_start("ob_gzhandler"); 
ob_start("ob_html_compress2");
//compress html php
function ob_html_compress2($buf){
    return str_replace(array("\n","\r","\t"),'',$buf);
}

/*You should also enable GZIP in the PHP config using zlib.outputcompression rather than using obgzhander() as your ob_start() callback.
https://coderwall.com/p/fatjmw/compressing-html-output-with-php
https://github.com/jenstornell/tiny-html-minifier/blob/master/tiny-html-minifier.php
https://www.textfixer.com/html/javascript-pop-up-window.php
But of course it might be a good idea to extend the obhtmlcompress function to filter out a bit more of unnecessary output, if you just replace the function body with.
*/
function ob_html_compress($buf){

    return preg_replace(array('/<!--(.*)-->/Uis',"/[[:blank:]]+/"),array('',' '),str_replace(array("\n","\r","\t"),'',$buf));
}
?>
<!--TMINC-->