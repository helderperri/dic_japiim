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



function search_type_buttons($langtype, $searchtype){


    ?>
    <div class="dropdown-header"><small>Tipo de Pesquisa</small></div>                           
    <div class="form-group dropdown-item d-flex flex-wrap align-items-center"  style="width: 20em;" role="group" id="search_type_panel">
        <input id="alphabetic" langtype="<?php echo $langtype; ?>" searchtype="1" type="submit" class="btn btn-primary btn-sm searchtype active" value="Alfabética">
        <input id="semantic" type="submit" langtype="<?php echo $langtype; ?>" searchtype="2" class="btn btn-primary btn-sm searchtype" value="Semântica">
        <input id="class" type="submit" langtype="<?php echo $langtype; ?>" searchtype="3" class="btn btn-primary btn-sm searchtype" value="Classe de Palavra">
    </div>


    <?php

        ?>
                 <script type='text/javascript' src="js/buttons_search_type.js"></script>
    

        <?php
        
}


    search_type_buttons($langtype, $searchtype);







    ?>