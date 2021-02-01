<?php
/*
        function getData(){
                $url = "http://www.sandesh.com/article.aspx?newsid=119068";
                //$url = "http://www.sandesh.com/article.aspx?newsid=115627";
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                $output = curl_exec($curl);
                curl_close($curl);
                $DOM = new DOMDocument;
                $output = mb_convert_encoding($output, 'HTML-ENTITIES', "UTF-8");
                @$DOM->loadHTML($output);
                $items = $DOM -> getElementById('lblNews');

                return trim($items -> nodeValue);
        }
*/
// Set the content-type
//mb_internal_encoding("UTF-8");
// require_once('seven.php');
// Create the image
$im = imagecreatetruecolor(400, 400);

// Create some colors
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, ImageSX($im), ImageSY($im), $white);

// The text to draw
//$text = getData();//'કેમ છો ?';
$text = "test";

//echo $text;
// Replace path by your own font path
$font = 'fonts/cmunci.ttf';

// Add some shadow to the text
imagettftext($im, 20, 0, 11, 21, $grey, $font, $text);

// Add the text
imagettftext($im, 20, 0, 10, 20, $black, $font, $text);

// Using imagepng() results in clearer text compared with imagejpeg()
header('Content-Type: image/png');
imagepng($im);
imagedestroy($im);

?>