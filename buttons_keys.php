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


if(isset($_POST['btn_display'])){
    $btn_display_new="";

    $btn_display = $_POST['btn_display'];

    if($btn_display == 1){

        $btn_display_new=0;


    }elseif($btn_display == 0){
        $btn_display_new=1;

    }


}else{
}

if(!empty($_POST['lang_number'])){

    $lang_number = $_POST['lang_number'];


    if($langtype==1){

        


        $_SESSION['config_sls_'.$dic_name][$lang_number-1]['search_display']=$btn_display_new;
        
    }elseif($langtype==2){

        $_SESSION['config_tls'][$lang_number-1]['search_display']=$btn_display_new;
        

    }





}else{

}



if(!empty($_POST['searchtype'])){

    $searchtype = $_POST['searchtype'];


}else{
    $searchtype=1;
}

if(!empty($_POST['btn_display'])){

    $btn_display = $_POST['btn_display'];


}else{
    $btn_display=1;
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
        <select class="custom-select-primary btn btn-primary btn-sm p-1" style="font-size:small;" id="langtype_search">
    <option id="langtype_search_direct" searchtype="<?php echo $searchtype; ?>" langtype="1" value="1" class="langtype_search" <?php echo $selected_dir; ?>>Direta</option>
    <option id="langtype_search_reverse" searchtype="<?php echo $searchtype; ?>" langtype="2" value="2" class="langtype_search" <?php echo $selected_rev; ?>>Reversa</option>
  
  </select>   

        <?php
        
        if(!empty($_POST['reload'])){

            ?>
            <script type='text/javascript' src="js/langtype_search.js"></script>
             <?php
         
            }else{
            }


}


function button_keys_output ($searchtype, $langtype){
    
    ?>
    <div class="input-group mb-2">
  <div class="input-group-prepend">
<?php
  langtype_search($searchtype, $langtype)// WHAT IS  THIS?
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
        <input type="submit" btn_id="<?php echo $btn_id; ?>" id="panel_btn_<?php echo $btn_id; ?>" searchtype="<?php echo $searchtype; ?>" langtype="<?php echo $langtype; ?>"  style="min-width:2.15em; width:auto; min-height:2em; height: auto; float:left; z-index:2;" class="btn btn-primary btn-sm btn-xs panel_btn <?php echo $flex_fill; ?> <?php echo $btn_type; ?>" value='<?php echo $btn_value; ?>' <?php echo $btn_display; ?>>






            <?php



        }

    


    }else{

    }

    ?>
    </div>
    <?php
        if(!empty($_POST['reload'])){

            ?>
            <script type='text/javascript' src="js/panel_btn.js"></script>
            <script type='text/javascript' src="js/search_text.js"></script>
             <?php
         
            }else{
            }


    ?>

    <?php



}





function btn_array($searchtype, $langtype, $flex_fill){
        $dic_name = "";
    include ("connection.php");
  
    $btn_display = "";
    $mdarray = array();
    $count=0;
  
  
    if($searchtype==1){

        $flex_fill = "";

            if($langtype==2){

                $btn_type = "alphabtn";
                $alpha_order = "alpha_order_target";
        
                }elseif($langtype==1){
        
        
        
                $btn_type = "alphabtn";
                $alpha_order = "alpha_order_source";
        
                }


                try {
                    $result = $link->query("SELECT * FROM $alpha_order WHERE display_btn = 1 ORDER BY glyph_order");
                      
                          if($result->rowCount()>0){
                
                            foreach ($result as $row){
                                $btn_id=$row["glyph_id"];
                                $btn_value=$row["glyph"];
                                $btn_display = check_letter($btn_id, $langtype);            
                                $zero_col=$count;
                                $mdarray[$zero_col] = array("btn_id" => $btn_id, "btn_value" => $btn_value, "btn_type" => $btn_type, "flex_fill" => $flex_fill, "btn_display" => $btn_display, "langtype" => $langtype);
                                $count++;
                                      } // foreach     
                      
                
                            }else{
                              echo "A busca não retornou nenhum resultado.";
                          } // if
                
                            
                      } catch(PDOException $e){
                        echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                    } // try                
            return $mdarray;
                    
    }elseif($searchtype==2){

        $flex_fill = "btn-xs flex-fill";
        
        if($langtype==2){

            $btn_type = "sembtn_rev";
    

            }elseif($langtype==1){



            $btn_type = "sembtn";
    
            }
            try {
                $result = $link->query("SELECT * FROM sd_list");
                  
                      if($result->rowCount()>0){
            
                        foreach ($result as $row){
                            $btn_id=$row["sd_id"];
                            $btn_value=$row["sd_name_ref"];
                            $btn_display = check_sd($btn_id);
                            $zero_col=$count;
                            $mdarray[$zero_col] = array("btn_id" => $btn_id, "btn_value" => $btn_value, "btn_type" => $btn_type, "flex_fill" => $flex_fill, "btn_display" => $btn_display, "langtype"=>$langtype);
                            $count++;
                            } // foreach     
                  
            
                        }else{
                          echo "A busca não retornou nenhum resultado.";
                      } // if
            
                        
                  } catch(PDOException $e){
                    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                } // try

        return $mdarray;




        }elseif($searchtype==3){

            $flex_fill = "btn-xs flex-fill";
            
        
        if($langtype==2){

            
            $btn_type = "classbtn_rev";

        }elseif($langtype==1){

            $btn_type = "classbtn";
        }

        try {
            $result = $link->query("SELECT * FROM class_list");
              
                  if($result->rowCount()>0){
        
                    foreach ($result as $row){
                        $btn_id=$row["class_id"];
                        $btn_value=$row["class_name_ref"];
                        $btn_display = check_class($btn_id);
                        $zero_col=$count;
                        $mdarray[$zero_col] = array("btn_id" => $btn_id, "btn_value" => $btn_value, "btn_type" => $btn_type, "flex_fill" => $flex_fill, "btn_display" => $btn_display);
                        $count++;
                    } // foreach     
              
        
                    }else{
                      echo "A busca não retornou nenhum resultado.";
                  } // if
        
                    
              } catch(PDOException $e){
                echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
            } // try

    return $mdarray;

    }
    
}   

function check_letter($btn_id, $langtype){
        $dic_name = "";
    include ("connection.php");
    $table_to_search = "";
    $column_to_search = "";
    $btn_display = "";

    if($langtype==1){
        $table_to_search = "forms";
        $column_to_search = "vernacular";

        $glyphs = array();
        $entries_list = array();
        
        try{
            $result = $link->query("SELECT * FROM letters_source WHERE glyph_id = '$btn_id'");
      
      
            if($result->rowCount()>0){
              //$key=0;
              foreach ($result as $key => $row){
                  $glyph_other=$row["glyph_other"];
                  $glyphs[] = $glyph_other;
                } //foreach
            
            }else{
              //echo "A busca não retornou nenhum resultado.";
          } // if
      
        } catch(PDOException $e){
          echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
        } // try
      
      



    }elseif($langtype==2){
        $table_to_search = "glosses";
        $column_to_search = "gloss";


        try{
            $result = $link->query("SELECT * FROM letters_target WHERE glyph_id = '$btn_id'");
      
      
            if($result->rowCount()>0){
              //$key=0;
              foreach ($result as $key => $row){
                  $glyph_other=$row["glyph_other"];
                  $glyphs[] = $glyph_other;
                } //foreach
            
            }else{
              //echo "A busca não retornou nenhum resultado.";
          } // if
      
        } catch(PDOException $e){
          echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
        } // try
          

    }//if
    $glyphs_in = "'" . implode( "','", $glyphs ) . "'";
        

    try {
        $result = $link->query("SELECT * FROM $table_to_search WHERE LEFT ($column_to_search, 1) IN ($glyphs_in)");
          
            if($result->rowCount()>0){
                $btn_display = "";
            }
            else{ 
                //$btn_display = "";
                $btn_display = "hidden";
            } // if                    
          } catch(PDOException $e){
            echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
        } // try
    
    return($btn_display);
}



function check_sd($btn_id){
        $dic_name = "";
    include ("connection.php");
    $table_to_search = "sds";
    $column_to_search = "sd_id";
    $btn_display = "";

    try {
        $result = $link->query("SELECT * FROM $table_to_search WHERE $column_to_search = '$btn_id'");
          
            if($result->rowCount()>0){
                $btn_display = "";
            }
            else{ 
                $btn_display = "hidden";
            } // if                    
          } catch(PDOException $e){
            echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
        } // try

    //$btn_display = "disabled";
    return($btn_display);  
}



function check_class($btn_id){
        $dic_name = "";
    include ("connection.php");
    $table_to_search = "classes";
    $column_to_search = "class_id";
    $btn_display = "";

    try {
        $result = $link->query("SELECT * FROM $table_to_search WHERE $column_to_search = '$btn_id'");
            
            if($result->rowCount()>0){
                $btn_display = "";
            }
            else{ 
                $btn_display = "hidden";
            } // if                    
            } catch(PDOException $e){
            echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
        } // try

    return($btn_display);  
}
    



button_keys_output ($searchtype, $langtype);


    ?>
