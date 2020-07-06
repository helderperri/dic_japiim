<?php
include("connection.php");
include("functions_search_panel.php");



$langtype = $_POST['langtype'];

if(!empty($_POST['class_id'])){

    $class_id = $_POST['class_id'];
  
  
  }else{
    $class_id=2;
  }





if($langtype==1){

    $source_lang = $_POST['lang'];
    class_panel ($class_id, $source_lang);


}elseif($langtype==2){

    $target_lang = $_POST['lang'];
    class_panel_reverse ($class_id, $target_lang);

}



    ?>
<script type='text/javascript' src="js/panel.js"></script>             
<?php
?>
