<?php
include("connection.php");
include("functions_search_panel.php");


if(!empty($_POST['first_letter'])){

    $first_letter = $_POST['first_letter'];
  
  
  }else{
    $first_letter="A";
  }



$langtype = $_POST['langtype'];


if($langtype==1){

    $source_lang = $_POST['lang'];
    alpha_panel ($first_letter, $source_lang);


}elseif($langtype==2){

    $target_lang = $_POST['lang'];
    alpha_panel_reverse ($first_letter, $target_lang);

}




    ?>


<script type='text/javascript' src="js/panel.js"></script>

  <?php

  ?>