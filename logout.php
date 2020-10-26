<?php
    require_once ("..//..//config.php");

    
if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }else{
  }


if($_SESSION["gmail"] == 1){
    $token = $_SESSION["accessToken"];
    
$googleClient->revokeToken($token);
session_destroy();
header("Location:index.php");
}else{
  session_destroy();
    header("Location:index.php");
    
}
?>