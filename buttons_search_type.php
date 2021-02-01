<?php
    $dic_name = "";
    include ("connection.php");




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




if(!empty($_POST['langtype'])){

    $langtype = $_POST['langtype'];


}

if(!empty($_POST['searchtype'])){

    $searchtype = $_POST['searchtype'];


}


function searchtype_buttons($langtype, $searchtype){


    $active_alpha = "";
    $active_sem = "";
    $active_class = "";


    if($searchtype == 1){
        $active_alpha = "active";
        $active_sem = "";
        $active_class = "";


    }elseif($searchtype == 2){
        $active_alpha = "";
        $active_sem = "active";
        $active_class = "";


    }elseif($searchtype == 3){
        $active_alpha = "";
        $active_sem = "";
        $active_class = "active";


    }




        ?>
    <div id="searchtype_panel_all" style='float:left;'>
        <div class="dropdown-header"><small>Tipo de Pesquisa</small></div>                           
        <div class="form-group dropdown-item d-flex flex-wrap align-items-center"  style="width: 20em;" role="group" id="searchtype_panel">
            <input id="alphabetic" langtype="<?php echo $langtype; ?>" searchtype="1" type="submit" class="btn btn-primary btn-xs searchtype <?php echo $active_alpha; ?>" value="Alfabética">
            <input id="semantic" type="submit" langtype="<?php echo $langtype; ?>" searchtype="2" class="btn btn-primary btn-xs searchtype <?php echo $active_sem; ?>" value="Semântica">
            <input id="class" type="submit" langtype="<?php echo $langtype; ?>" searchtype="3" class="btn btn-primary btn-xs searchtype <?php echo $active_class; ?>" value="Classe de Palavra">
        </div>

    </div>        
        

            <?php
            
}


    searchtype_buttons($langtype, $searchtype);







    ?>