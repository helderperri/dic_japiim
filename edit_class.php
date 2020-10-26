
      <?php
    $dic_name = "";
    include ("connection.php");
    include ("functions.php");


    if(isset($_POST['lang_code'])){

      $lang_code = $_POST['lang_code'];
      
        }else{
    
    } 

        
    if(isset($_POST['sense_bundle_id'])){
  
      $sense_bundle_id = $_POST['sense_bundle_id'];
      
        }else{
    
    }
  

    if(isset($_POST['bundle'])){
  
      $sense_bundle_id = $_POST['bundle'];
      
        }else{
    
    }
  
    if(isset($_POST['class_id'])){
  
      $class_id = $_POST['class_id'];
      
        }else{
    
    }
  
    if(isset($_POST['class_order'])){
  
      $class_order = $_POST['class_order'];
      
        }else{
    
    }
  
    if(isset($_POST['class'])){
  
      $class = $_POST['class'];
      
        }else{
    
    }
  
    if(isset($_POST['class_name_ref'])){
  
      $class_name_ref = $_POST['class_name_ref'];
      
        }else{
    
    }
  
    if(isset($_POST['items'])){
  
      $items = $_POST['items'];
      
        }else{
    
    }
  
  
  
  
    if(isset($_POST['del_class'])){
  
      try {
          //session_start();
          $sql = "DELETE FROM classes WHERE sense_bundle_id=:sense_bundle_id";
          $stmnt = $link->prepare($sql);
      
          $entry_data = [':sense_bundle_id'=>$sense_bundle_id];
          $stmnt->execute($entry_data);
       
      
      
      
      } catch(PDOException $e){
          echo "Erro: ".$e->getMessage();
      }
  
  
  
  
      $target_langs_info = $_SESSION['config_tls_'.$dic_name];
      
      foreach ($target_langs_info as $target_lang_info){
    
        $target_lang = $target_lang_info['target_lang'];
        $lang_code = $target_lang_info['lang_code'];
        classes_edit ($sense_bundle_id, $target_lang, $lang_code);
  
  
      }//foreach
       
      
  
    }
  
  
  
  
    if(isset($_POST['update_class'])){
  
      try {
          //session_start();
          $sql = "UPDATE classes SET class_id = :class_id, class_name_ref=:class_name_ref WHERE sense_bundle_id=:sense_bundle_id";
          $stmnt = $link->prepare($sql);
      
          $entry_data = [':sense_bundle_id'=>$sense_bundle_id,':class_id'=>$class_id, ':class_name_ref'=>$class_name_ref];
          $stmnt->execute($entry_data);
       
      
      
      
      } catch(PDOException $e){
          echo "Erro: ".$e->getMessage();
      }
  
  
  
  
      $target_langs_info = $_SESSION['config_tls_'.$dic_name];
      
      foreach ($target_langs_info as $target_lang_info){
    
        $target_lang = $target_lang_info['target_lang'];
        $lang_code = $target_lang_info['lang_code'];
        classes_edit ($sense_bundle_id, $target_lang, $lang_code);
  
  
      }//foreach
       
      
  
    }
  
  
      if(isset($_POST['create_class'])){
      
            $entry_ref="entry_ref";
              $class_order=1;
              $class_id=1;
              $class_name_ref = "adjetivo";
          
                  try{
                      $sql = "INSERT INTO classes (sense_bundle_id, entry_ref, class_order, class_id, class_name_ref) 
                      VALUES (:sense_bundle_id, :entry_ref, :class_order, :class_id, :class_name_ref)";
                      $stmnt = $link->prepare($sql);
                  
                      $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':class_order'=>$class_order, ':class_id'=>$class_id, ':class_name_ref'=>$class_name_ref];
                      $stmnt->execute($entry_data);
                  

                  } catch(PDOException $e){
                      echo "Erro: 21212".$e->getMessage();
                  }//try




                  $target_langs_info = $_SESSION['config_tls_'.$dic_name];
    
                  foreach ($target_langs_info as $target_lang_info){
                
                    $target_lang = $target_lang_info['target_lang'];
                    $lang_code = $target_lang_info['lang_code'];
                    classes_edit ($sense_bundle_id, $target_lang, $lang_code);
              
              
                  }//foreach
                   
                }else{

                  //echo "A busca não retornou nenhum resultado.";
              } // if

                
              