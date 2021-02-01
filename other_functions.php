<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}


function logged_in(){
  if(isset($_SESSION["user_sub"])){
      return true;
    //$user_sub = $_SESSION["user_sub"];
  
  }else{
  
      return false;
   
  
  }
  
  }



