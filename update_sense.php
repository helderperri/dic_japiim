<?php
    $dic_name = "";
    include ("connection.php");


if(isset($_POST['lang_code'])){

    $lang_code = $_POST['lang_code'];
    
      }else{
  
  } 
  
  if(isset($_POST['bundle'])){

    $sense_bundle_id = $_POST['bundle'];
    
      }else{
  
  }
  if(isset($_POST['sense_bundle_id'])){

    $sense_bundle_id = $_POST['sense_bundle_id'];
    
      }else{
  
  }
  if(isset($_POST['sense_id'])){

    $sense_id = $_POST['sense_id'];
    
      }else{
  
  }

  if(isset($_POST['sense_order'])){

    $sense_order = $_POST['sense_order'];
    
      }else{
  
  }

  if(isset($_POST['def'])){

    $def = $_POST['def'];
    
      }else{
  
  }

  if(isset($_POST['items'])){

    $items = $_POST['items'];
    
      }else{
  
  }



if(isset($_POST['bck_sense'])){

    try {
        //session_start();
        //session_start();
        $result = $link->query("SELECT * FROM senses WHERE sense_id = '$sense_id'");
  
        if($result->rowCount()>0){
          
          foreach ($result as $row){
            $sense_bundle_id=$row["sense_bundle_id"];
            $def=$row["def"];
              $entry_ref=$row["entry_ref"];
              $target_lang=$row["target_lang"];
              $lang_code=$row["lang_code"];
              $sense_order=$row["sense_order"];
              $class=$row["class"];
  
              if ($def==""){
  
              }else{
    
                  try{
                      $sql = "INSERT INTO senses_bck (sense_bundle_id, entry_ref, sense_id, sense_order, target_lang, lang_code, class, def) 
                      VALUES (:sense_bundle_id, :entry_ref, :sense_id, :sense_order, :target_lang, :lang_code, :class, :def)";
                      $stmnt = $link->prepare($sql);
                  
                      $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':sense_id'=>$sense_id, ':sense_order'=>$sense_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':class'=>$class, ':def'=>$def];
                      $stmnt->execute($entry_data);
                  
  
                  } catch(PDOException $e){
                      echo "Erro: ".$e->getMessage();
                  }//try
    
              }//if
  
  
            } // foreach      
    
          }else{
            //echo "A busca não retornou nenhum resultado.";
        } // if
  
  
  
  
  
  } catch(PDOException $e){
      echo "Erro: ".$e->getMessage();
  }
  
  }

  if(isset($_POST['update_sense'])){

    try {
        //session_start();
        $sql = "UPDATE senses SET def = :def WHERE sense_id=:sense_id";
        $stmnt = $link->prepare($sql);
    
        $entry_data = [':def'=>$def,':sense_id'=>$sense_id];
        $stmnt->execute($entry_data);
     
    
    
    
    } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
    }

  }


  if(isset($_POST['create_def'])){

    ?>
    <input id="sense_input_<?php echo $sense_id; ?>" sense_order='<?php echo $sense_order; ?>' first="1" class="form-control form-control-sm ml-auto pr-1 sense_input" sense_id="<?php echo $sense_id; ?>" type="text" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" value="" >
  
  <?php
  
  }