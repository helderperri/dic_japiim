<?php

    $dic_name = "";
    include ("connection.php");
//include ("lang_check.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if(isset($_POST['langtype'])){

    $langtype = $_POST['langtype'];
  }else{
    $config_search= $_SESSION['config_search_'.$dic_name][0];
  
    $langtype = $config_search['langtype'];  
  
}





function langtype_choice_buttons($langtype){

    $dic_name = "";
    include ("connection.php");
//    include ("lang_check.php");



$config_search = $_SESSION['config_search_'.$dic_name][0];
$number_of_sls = $config_search["number_of_sls"];
$searchtype =  $config_search["searchtype"];
if($number_of_sls > 1){

    $is_hidden = "";

    if($langtype == 2){
        
        //$is_hidden = "hidden";
    }
?>
    <div id="langtype_panel_sl" <?php echo $is_hidden; ?> style='float:left;'>
        <div class="dropdown-element" ><small>Direta em:</small></div>

        

<?php
$index = 1;
    
foreach ($_SESSION['config_sls_'.$dic_name] as $row){
    $lang_code = $row['lang_code'];
    $is_checked = "";
    $btn_status = 0;
    $search_display = $row['search_display'];
    if($search_display == 1){
        $btn_status = 1;
        $is_checked = "checked";
    }
?>
        <div class="dropdown-item" >
            <div class="custom-control custom-switch">
                <input id="sl_choice_btn_<?php echo $index; ?>" btn_number="<?php echo $index; ?>" btndisplay="<?php echo $btn_status;?>" langtype="1" searchtype="<?php echo $searchtype;?>" style="size:small;" type="checkbox" class="custom-control-input langchoice" <?php echo $is_checked;?>>
                <label class="custom-control-label" for="sl_choice_btn_<?php echo $index; ?>"><small><?php echo $lang_code;?></small></label>
            </div>
        </div> 

    <?php
    $index = $index+1;
}//foreach

?>
      
  </div>
<?php


}

$number_of_tls = $config_search["number_of_tls"];

if($number_of_tls > 1){

    $is_hidden = "";

    if($langtype==1){
        
        //$is_hidden = "hidden";
    }
?>
<div id="langtype_panel_tl" <?php echo $is_hidden; ?> style='float:left;' >
    <div class="dropdown-element" ><small>Reversa em:</small></div>


<?php
$index = 1;
    
foreach ($_SESSION['config_tls_'.$dic_name] as $row){
    //$index = $row['index'];
    
    $lang_code = $row['lang_code'];
    $is_checked = "";
    $btn_status = 0;
    $search_display = $row['search_display'];
    if($search_display == 1){
        $btn_status = 1;
        $is_checked = "checked";
    }
?>
    <div class="dropdown-item" >

    <div class="custom-control custom-switch">
        <input id="tl_choice_btn_<?php echo $index; ?>" btn_number="<?php echo $index; ?>" btndisplay="<?php echo $btn_status;?>" langtype="2" searchtype="<?php echo $searchtype;?>" type="checkbox" class="custom-control-input langchoice" <?php echo $is_checked;?>>
        <label class="custom-control-label" for="tl_choice_btn_<?php echo $index; ?>"><small><?php echo $lang_code;?></small></label>
    </div>
 </div>

    <?php

$index = $index+1;
}//foreach
?>
 
  </div>  


    <?php

}
    
    }    

langtype_choice_buttons($langtype);


?>

 
