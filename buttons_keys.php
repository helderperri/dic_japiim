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


function langtype_search($searchtype, $langtype){
    
$selected_dir = "";
$selected_rev = "";

if($langtype==1){
    $selected_dir = "selected";
    $selected_rev = "";
    
}else if($langtype==2){

    $selected_dir = "";
    $selected_rev = "selected";

}


    ?>
        <select class="custom-select-primary btn btn-primary btn-sm p-1" type="checkbox" style="font-size:small;" id="langtype_search">
    <option searchtype="<?php echo $searchtype; ?>" langtype="1" value="1" class="langtype_search" <?php echo $selected_dir; ?>>Direta</option>
    <option searchtype="<?php echo $searchtype; ?>" langtype="2" value="2" class="langtype_search" <?php echo $selected_rev; ?>>Reversa</option>
  
  </select>

    <?php

}


function button_keys_output ($searchtype, $langtype){
    
    ?>
    <div class="input-group mb-2">
  <div class="input-group-prepend">
<?php
  langtype_search($searchtype, $langtype)
?>

  </div>
  <input class="form-control" style="font-size:small;" type="text" name="search" id="search_text" langtype="<?php echo $langtype; ?>" placeholder="Digite uma palavra">
</div>
    <!-- END SEARCH INPUT TEXT AREA -->
    <div class="form-group d-flex flex-wrap mb-1"  id="keys" style='width:auto; position:relative; z-index: 5;'>

    <?php

    $mdarray_end = btn_array($searchtype, $langtype, 'flex-fill', 'disabled');


    if (!empty($mdarray_end)){

    asort($mdarray_end);
    $mdarray_orded = array_values($mdarray_end);

    

    for ($i = 0; $i < count($mdarray_end); $i++){
        $btn_id = $mdarray_orded[$i]["btn_id"];
        $btn_value = $mdarray_orded[$i]["btn_value"];
        $btn_type = $mdarray_orded[$i]["btn_type"];
        $flex_fill = $mdarray_orded[$i]["flex_fill"];
        $btn_display = $mdarray_orded[$i]["btn_display"];
        
        
        ?>
        <input type="submit" id="<?php echo $btn_id; ?>"  style="min-width:2.15em; width:auto; min-height:2em; height: auto; float:left; z-index:2;" class="btn btn-primary btn-sm btn-xs <?php echo $flex_fill; ?> <?php echo $btn_type; ?>" value='<?php echo $btn_value; ?>' <?php echo $btn_display; ?>>
        <?php



        }

    


    }else{

    }




    ?>
    </div>

    <script type='text/javascript' src="js/buttons_keys.js"></script>


    <?php



}





function btn_array($searchtype, $langtype, $flex_fill){

    include ('connection.php');
  
    $btn_display = "";
    $mdarray = array();
    $count=0;
  
  
    if($searchtype==1){

        $flex_fill = "";

            if($langtype==2){

                $btn_type = "alphabtn_rev";
                $alpha_order = "alpha_order_target";
        
                }elseif($langtype==1){
        
        
        
                $btn_type = "alphabtn";
                $alpha_order = "alpha_order_source";
        
                }
            $sql="SELECT * FROM $alpha_order WHERE display_btn = 1 ORDER BY glyph_order";

            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result)>0){
                $btn_id="";
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    if($btn_id!=$row["glyph_id"]){
                    $btn_id=$row["glyph_id"];
                    $btn_value=$row["glyph"];
                    $btn_display = check_letter($btn_value, $langtype);

                    $zero_col=$count;
                    $mdarray[$zero_col] = array("btn_id" => $btn_id, "btn_value" => $btn_value, "btn_type" => $btn_type, "flex_fill" => $flex_fill, "btn_display" => $btn_display);
                    $count++;
                
                }

                }

            }
        

            }

        
            return $mdarray;
                    
    }elseif($searchtype==2){

        $flex_fill = "btn-xs flex-fill";
        
        if($langtype==2){

            $btn_type = "sembtn_rev";
    

            }elseif($langtype==1){



            $btn_type = "sembtn";
    
            }



            $sql="SELECT * FROM sd_list";

        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result)>0){
            $btn_id="";
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                if($btn_id!=$row["sd_id"]){
                $btn_id=$row["sd_id"];
                $btn_value=$row["sd_name_ref"];
                $btn_display = check_sd($btn_id);
                $zero_col=$count;
                $mdarray[$zero_col] = array("btn_id" => $btn_id, "btn_value" => $btn_value, "btn_type" => $btn_type, "flex_fill" => $flex_fill, "btn_display" => $btn_display);
                $count++;
            
            }

            }

        }


        }


        return $mdarray;




    }elseif($searchtype==3){

        $flex_fill = "btn-xs flex-fill";
        
    
    if($langtype==2){

        
        $btn_type = "classbtn_rev";

    }elseif($langtype==1){

        $btn_type = "classbtn";
    }
    $sql="SELECT * FROM class_list";

    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result)>0){ 
            $btn_id="";
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            if($btn_id!=$row["class_id"]){
            $btn_id=$row["class_id"];
            $btn_value=$row["class_name_ref"];
            $btn_display = check_class($btn_id);
            $zero_col=$count;
            $mdarray[$zero_col] = array("btn_id" => $btn_id, "btn_value" => $btn_value, "btn_type" => $btn_type, "flex_fill" => $flex_fill, "btn_display" => $btn_display);
            $count++;
            
        }

        }

    }


    }


    return $mdarray;



    
    }
    
}   

function check_letter($btn_value, $langtype){
    include ('connection.php');
    $table_to_search = "";
    $column_to_search = "";
    $btn_display = "";

    if($langtype==1){
        $table_to_search = "forms";
        $column_to_search = "vernacular";

    }elseif($langtype==2){
        $table_to_search = "senses";
        $column_to_search = "gloss";

    }
    

    $sql="SELECT * FROM $table_to_search WHERE $column_to_search LIKE '$btn_value%'";


    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result)>0){

            $btn_display = "";

        }
        else{ 
            $btn_display = "hidden";
    }
    }

    //$btn_display = "disabled";


    return($btn_display);
    }



    function check_sd($btn_id){
        include ('connection.php');
        $table_to_search = "sds";
        $column_to_search = "sd_id";
        $btn_display = "";
 
    $sql="SELECT * FROM $table_to_search WHERE $column_to_search = '$btn_id'";


    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result)>0){

            $btn_display = "";

        }
        else{ 
            $btn_display = "hidden";
    }
    }

    //$btn_display = "disabled";


    return($btn_display);  
      }
    


      function check_class($btn_id){
        include ('connection.php');
        $table_to_search = "classes";
        $column_to_search = "class_id";
        $btn_display = "";
 
    $sql="SELECT * FROM $table_to_search WHERE $column_to_search = '$btn_id'";


    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result)>0){

            $btn_display = "";

        }
        else{ 
            $btn_display = "hidden";
    }
    }

    //$btn_display = "disabled";


    return($btn_display);  
      }
    



button_keys_output ($searchtype, $langtype);
    ?>
