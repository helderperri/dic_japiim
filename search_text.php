<?php 

include("connection.php");
include("functions_search_panel.php");



$search = $_POST['search'];


$langtype = $_POST['langtype'];


if($langtype==1){

    $source_lang = $_POST['lang'];
    search_text_panel ($search, $source_lang);


}elseif($langtype==2){

    $target_lang = $_POST['lang'];
    search_text_panel_reverse ($search, $target_lang);

}






















?>



<script type='text/javascript' src="panel.js"></script>
  <?php       
?>
