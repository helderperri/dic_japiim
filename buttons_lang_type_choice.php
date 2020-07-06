<?php

include ("connection.php");
include ("lang_check.php");


if(isset($_POST['langtype'])){

    $langtype = $_POST['langtype'];


}else{
    $langtype=1;
}





if(isset($_POST['btn1'])){

    $btn1_status = $_POST['btn1'];


}else{
    $btn1_status=1;
}

if(isset($_POST['btn2'])){

    $btn2_status = $_POST['btn2'];


}else{
    $btn2_status=1;
}

function lang_type_choice_buttons($langtype, $btn1_status, $btn2_status){

    include ("connection.php");
    include ("lang_check.php");
    
if($btn1_status == 0){
    $btn1_active = "";
}else{
    $btn1_active = "checked";
}


if($btn2_status==0){
    $btn2_active = "";
}else{
    $btn2_active = "checked";
}

?>
    <div class="dropdown-header"><small>Línguas da Pesquisa</small></div>                           

 <div class="dropdown-item" id="lang_type_panel">
<div class="custom-control custom-switch">
  <input id="lang_btn1" btn_number="1" btndisplay="<?php echo $btn1_status;?>" langtype="<?php echo $langtype;?>" type="checkbox" class="custom-control-input langchoice" <?php echo $btn1_active;?>>
  <label class="custom-control-label" for="lang_btn1"><?php if($langtype==1){echo $lang_code_sl1;}elseif($langtype==2){echo $lang_code_tl1;}?></label>
</div>
<div class="custom-control custom-switch">
  <input id="lang_btn2" btn_number="2" btndisplay="<?php echo $btn2_status;?>" langtype="<?php echo $langtype;?>" type="checkbox" class="custom-control-input langchoice" <?php echo $btn2_active;?>>
  <label class="custom-control-label" for="lang_btn2"><?php if($langtype==1){echo $lang_code_sl2;}elseif($langtype==2){echo $lang_code_tl2;}?></label>
</div>
 </div>
<?php


    ?>
    
<script type='text/javascript' src="js/buttons_lang_type_choice.js"></script>

    <?php
    
    }


    if(($langtype==1 && !empty( $lang_code_sl2)) || ($langtype==2 && !empty( $lang_code_tl2)) ){
    
    lang_type_choice_buttons($langtype, $btn1_status, $btn2_status);
    
}else{

}



?>

 
