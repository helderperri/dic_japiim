<?php
    $dic_name = "";
    include ("connection.php");
include ("functions.php");



if(isset($_POST['lang_code'])){

    $lang_code = $_POST['lang_code'];
    
      }else{
  
  }
  
if(isset($_POST['target_lang'])){

    $target_lang = $_POST['target_lang'];
    
      }else{
  
  } 
  
  
  if(isset($_POST['bundle'])){

    $sense_bundle_id = $_POST['bundle'];
    
      }else{
  
  }

  if(isset($_POST['sd_id'])){

    $sd_id = $_POST['sd_id'];
    
      }else{
  
  }

  if(isset($_POST['sd_order'])){

    $sd_order = $_POST['sd_order'];
    
      }else{
  
  }

  if(isset($_POST['sd'])){

    $sd = $_POST['sd'];
    
      }else{
  
  }

  if(isset($_POST['sd_name_ref'])){

    $sd_name_ref = $_POST['sd_name_ref'];
    
      }else{
  
  }

  if(isset($_POST['items'])){

    $items = $_POST['items'];
    
      }else{
  
  }

  if(isset($_POST['target_lang'])){

    $target_lang = $_POST['target_lang'];
    
      }else{
  
  }

  function searchMultiArray($val, $array) {
    foreach ($array as $element) {
      if ($element['target_lang'] == $val) {
        return $element['lang_code'];
      }
    }
    return null;
  }

  $target_langs_info = $_SESSION['config_tls_'.$dic_name];



  if(isset($_POST['add_sd'])){

    $entry_ref="entry_ref";


        try{
            $sql = "INSERT INTO sds (sense_bundle_id, entry_ref, sd_order, sd_id, sd_name_ref) 
            VALUES (:sense_bundle_id, :entry_ref, :sd_order, :sd_id, :sd_name_ref)";
            $stmnt = $link->prepare($sql);
        
            $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':sd_order'=>$sd_order, ':sd_id'=>$sd_id, ':sd_name_ref'=>$sd_name_ref];
            $stmnt->execute($entry_data);
        

        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }//try

   
  }




  if(isset($_POST['del_sd'])){

    $entry_ref="entry_ref";

    try{
        $sql2 = "DELETE FROM sds WHERE sense_bundle_id = :sense_bundle_id AND sd_id = :sd_id";
        $stmnt2 = $link->prepare($sql2);
    
        $entry_data2 = [':sense_bundle_id'=>$sense_bundle_id, ':sd_id'=>$sd_id];
        $stmnt2->execute($entry_data2);
     
  
    
      
      } catch(PDOException $e){
          echo "Erro: ".$e->getMessage();
      }



   
  }





if(isset($_POST['update_sd'])){

  $lang_code = searchMultiArray($target_lang, $target_langs_info);
    
    
    try {

        ?>
        
    
         <?php
         
         try{
          $result4 = $link->query("SELECT * FROM sds WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY sd_id");
          
         } catch(PDOException $e){
           echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
       } // try
         
    
    
           if($result4->rowCount()>0){
            ?>
    
                <div id="sd_panel" class="form-group d-flex flex-row-reverse pr-2 bd-highlight sd tl<?php echo $target_lang ?>" style="display: true;">
    
            <?php
            foreach ($result4 as $key => $row){    
              
              $sd_id=$row["sd_id"];
              try {
                $result5 = $link->query("SELECT * FROM sd_names WHERE sd_id  = '$sd_id' AND lang_code = '$lang_code'");
                  
                      if($result5->rowCount()>0){
            
                        foreach ($result5 as $row){
            
                          $sd_name_id=$row["sd_name_id"];
                          $sd_name=$row["sd_name"];
                          
                ?>
                
                <input type="submit" id="<?php echo $sd_id; ?>"  style="min-width:2.3em; width:auto; min-height:2em; height: auto;" class="btn btn-primary btn-xs sembtn_display" value='<?php echo $sd_name; ?>'>
                <?php
      
                      } // foreach     
                  
            
                        }else{
                          //echo "A busca não retornou nenhum resultado.";
                      } // if
            
                        
                  } catch(PDOException $e){
                    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                } // try
                  } // foreach
    
                  ?>
    
                </div>
     
    
                  <?php
    
                }else{
                  //echo "A busca não retornou nenhum resultado.";
              } // if
            ?>        
                           
           <?php
                        
        } catch(PDOException $e){
          echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
        } // try

        
     

    }


if(isset($_POST['update_sd_final'])){



  foreach ($target_langs_info as $target_lang_info){
        
    $target_lang = $target_lang_info['target_lang'];
    $lang_code = $target_lang_info['lang_code'];
    sds_edit ($sense_bundle_id, $target_lang, $lang_code);

  }//foreach

?>


<?php

      
    

  }    