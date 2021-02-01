<?php
    $dic_name = "";
    include ("connection.php");

//$dic_name = $_SESSION['dic_name'];



$searchtype="";
$langtype="";
$number_of_sls ="";
$number_of_tls ="";
$image = "";
$video = "";
$scn = "";
//$mode = 2;
$mode = "";
//$entry_bundle_id = 139;
$entry_bundle_id = "";
$btn_id = "";



if(!empty($_SESSION['config_search_'.$dic_name])){

  foreach($_SESSION['config_search_'.$dic_name] as $row){
  
  $searchtype=$row["search_type"];
  $langtype=$row["lang_type"];
  $number_of_sls =$row["number_of_sls"];
  $number_of_tls =$row["number_of_tls"];
  $image = $row["image"];
  $video = $row["video"];
  $scn = $row["scn"];
  //$mode = 2;
  $mode = $row["mode"];
  //$entry_bundle_id = 139;
  $entry_bundle_id = $row["entry_bundle_id"];
  $btn_id = $row["btn_id"];

  }

  //$btn_id = $_SESSION['config_search_'.$dic_name][0]['btn_id'];

}





if(isset($_POST['langtype'])){

    $langtype = $_POST['langtype'];
    $_SESSION['config_search_'.$dic_name][0]['lang_type'] = $langtype;
  }


if(isset($_POST['searchtype'])){

    $searchtype = $_POST['searchtype'];
    $_SESSION['config_search_'.$dic_name][0]['search_type'] = $langtype;


  }else{
    //$config_search = $_SESSION['config_search_'.$dic_name][0];
  
    //$searchtype = $config_search['searchtype'];  
  
}
 


function langtype_buttons($langtype, $searchtype){



    $active_direct = "";
    $active_reverse = "";

    
    if($langtype == 1){
        $active_direct = "active";
        $active_reverse = "";


    }elseif($langtype == 2){
        $active_direct = "";
        $active_reverse = "active";


    }

    ?>
    <li>
    <div class="dropdown-header"><small>Direção da Pesquisa</small></div>                           

    <div class="form-group dropdown-item d-flex d-warp" style="width:auto;" id="langtype_panel">
    <?php    

        ?>
        <input style='float:left;' id="primary" langtype="1" searchtype="<?php echo $searchtype;?>" style="size:small;" type="submit" class="btn btn-primary btn-xs langtype <?php echo $active_direct; ?>" value="Direta">
        
        <input style='float:left;' id="reverse" langtype="2" searchtype="<?php echo $searchtype;?>" style="size:small;" type="submit" class="btn btn-primary btn-xs langtype <?php echo $active_reverse; ?>" value="Reversa">
        <?php



    ?>
               </div>
               </li>
               <li>

           <div id="lang_choice" class="form-group dropdown-itemd-flex d-warp p-0">

    <?php

        include ("buttons_lang_type_choice.php");

        ?>
        
        </div>
        </li>

        <?php
        
}
            
    langtype_buttons($langtype, $searchtype);


    ?>
