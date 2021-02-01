<?php


if (version_compare(phpversion(), '5.4.0', '<')) {
  if(session_id() == '') {
   session_start();
  }
}
else {
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
}

      $dic_name = "";
      include ("connection.php");
  
  
  $source_langs_info = $_SESSION['config_sls_'.$dic_name];
  
?>

