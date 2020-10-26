<?php
    $dic_name = "";
    include ("connection.php");

//$dic_name = $_SESSION['dic_name'];

if(isset($_POST['langtype'])){

    $langtype = $_POST['langtype'];
  }else{
    $config_search= $_SESSION['config_search_'.$dic_name][0];
  
    $langtype = $config_search['langtype'];  
  
}


if(isset($_POST['searchtype'])){

    $searchtype = $_POST['searchtype'];
  }else{
    $config_search = $_SESSION['config_search_'.$dic_name][0];
  
    $searchtype = $config_search['searchtype'];  
  
}
 


function langtype_buttons($langtype, $searchtype){


    ?>
    <li>
    <div class="dropdown-header"><small>Direção da Pesquisa</small></div>                           

    <div class="form-group dropdown-item d-flex d-warp" style="width:auto;" id="langtype_panel">
    <?php    

        ?>
        <input style='float:left;' id="primary" langtype="1" searchtype="<?php echo $searchtype;?>" style="size:small;" type="submit" class="btn btn-primary btn-xs langtype active" value="Direta">
        
        <input style='float:left;' id="reverse" langtype="2" searchtype="<?php echo $searchtype;?>" style="size:small;" type="submit" class="btn btn-primary btn-xs langtype" value="Reversa">
        <?php



    ?>
               </div>
               </li>
               <li>

           <div id="lang_choice" class="form-group dropdown-itemd-flex d-warp p-0">

    <?php

        include("buttons_lang_type_choice.php");

        ?>
        
        </div>
        </li>

        <?php
        
}
            
    langtype_buttons($langtype, $searchtype);


    ?>
