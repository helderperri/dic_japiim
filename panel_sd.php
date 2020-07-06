<?php
include("connection.php");
include("functions_search_panel.php");



$langtype = $_POST['langtype'];

if(!empty($_POST['sd_id'])){

    $sd_id = $_POST['sd_id'];
  
  
  }else{
    $sd_id=2;
  }






if($langtype==1){

    $source_lang = $_POST['lang'];
    sd_panel ($sd_id, $source_lang);


}elseif($langtype==2){

    $target_lang = $_POST['lang'];
    sd_panel_reverse ($sd_id, $target_lang);

}



    ?>
<script type='text/javascript' src="js/panel.js"></script>             
<?php
?>
