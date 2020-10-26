<?php
    $dic_name = "";
    include ("connection.php");



if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


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



function searchtype_buttons($langtype, $searchtype){


        ?>
    <div id="searchtype_panel_all" style='float:left;'>
        <div class="dropdown-header"><small>Tipo de Pesquisa</small></div>                           
        <div class="form-group dropdown-item d-flex flex-wrap align-items-center"  style="width: 20em;" role="group" id="searchtype_panel">
            <input id="alphabetic" langtype="<?php echo $langtype; ?>" searchtype="1" type="submit" class="btn btn-primary btn-xs searchtype active" value="Alfabética">
            <input id="semantic" type="submit" langtype="<?php echo $langtype; ?>" searchtype="2" class="btn btn-primary btn-xs searchtype" value="Semântica">
            <input id="class" type="submit" langtype="<?php echo $langtype; ?>" searchtype="3" class="btn btn-primary btn-xs searchtype" value="Classe de Palavra">
        </div>

    </div>        
        

            <?php
            
}


    searchtype_buttons($langtype, $searchtype);







    ?>