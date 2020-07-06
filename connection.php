<?php
$link = new mysqli("localhost", "root", "", "taurepang");

if(mysqli_connect_error()){
    die('ERROR: Unable to connect:' . mysqli_connect_error()); 
    echo "<script>window.alert('Sorry!')</script>";
}else{

}


 $link->set_charset("utf8");

    ?>