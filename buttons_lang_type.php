<?php
include("connection.php");


if(!empty($_POST['langtype'])){

    $langtype = $_POST['langtype'];


}else{
    $langtype=1;
}

if(!empty($_POST['searchtype'])){

    $searchtype = $_POST['searchtype'];


}else{
    $searchtype=1;
}





function lang_type_buttons($langtype, $searchtype){


    ?>
    <li>
    <div class="dropdown-header"><small>Direção da Pesquisa</small></div>                           

    <div class="form-group dropdown-item d-flex d-warp" style="width:auto;" id="lang_type_panel">
    <?php    

        ?>
        <input style='float:left;' id="primary" langtype="1" searchtype="<?php echo $searchtype;?>" style="size:small;" type="submit" class="btn btn-primary btn-sm langtype active" value="Direta">
        
        <input style='float:left;' id="reverse" langtype="2" searchtype="<?php echo $searchtype;?>" style="size:small;" type="submit" class="btn btn-primary btn-xs langtype" value="Reversa">
        <?php



    ?>
               </div>
               </li>
               <li>

           <div id="lang_choice" class="form-group dropdown-item">

    <?php

        include("buttons_lang_type_choice.php");

        ?>
        
        </div>
        </li>
        <script type='text/javascript' src="js/buttons_lang_type.js"></script>

        <?php
        
        }



            
    lang_type_buttons($langtype, $searchtype);







    ?>