<?php
include ("functions.php");
    $dic_name = "";
    include ("connection.php");


if(isset($_POST['translation_id'])){

  $translation_id = $_POST['translation_id'];
  
    }else{

} 

if(isset($_POST['translation'])){

  $translation = $_POST['translation'];
  
    }else{

} 

if(isset($_POST['source_lang'])){

  $source_lang = $_POST['source_lang'];
  
    }else{

} 

if(isset($_POST['target_lang'])){

  $target_lang = $_POST['target_lang'];
  
    }else{

} 

if(isset($_POST['lang_code'])){

    $lang_code = $_POST['lang_code'];
    
      }else{
  
} 
  
  
if(isset($_POST['example_bundle'])){

    $example_bundle_id = $_POST['example_bundle'];
    
}else{
  
}

if(isset($_POST['count_sense_bundle'])){

    $count_sense_bundle = $_POST['count_sense_bundle'];
    
}else{
  
}

  if(isset($_POST['example_id'])){

    $example_id = $_POST['example_id'];
    
      }else{
  
  }
  if(isset($_POST['phonetic_id'])){

    $phonetic_id = $_POST['phonetic_id'];
    
      }else{
  
  }

  if(isset($_POST['entry_ref'])){

    $entry_ref = $_POST['entry_ref'];
    
      }else{
  
  }
  if(isset($_POST['phonemic_id'])){

    $phonemic_id = $_POST['phonemic_id'];
    
      }else{
  
  }

  if(isset($_POST['phonetic'])){

    $phonetic = $_POST['phonetic'];
    
      }else{
  
  }

  if(isset($_POST['example'])){

    $example = $_POST['example'];
    
      }else{
  
  }

  if(isset($_POST['example_order'])){

    $example_order = $_POST['example_order'];
    
      }else{
  
  }

  if(isset($_POST['translation_order'])){

    $translation_order = $_POST['translation_order'];
    
      }else{
  
  }

  if(isset($_POST['items'])){

    $items = $_POST['items'];
    
      }else{
  
  }

  if(isset($_POST['sense_bundle'])){

    $sense_bundle_id = $_POST['sense_bundle'];
    
      }else{
  
  }
  
  
  if(isset($_POST['form_bundle_id'])){

    $form_bundle_id = $_POST['form_bundle_id'];
    
      }else{
  
  }

  if(isset($_POST['bck_phonetic'])){

    bck_phonetic($phonetic_id);
}


if(isset($_POST['update_phonetic'])){

      try{
        $sql = "UPDATE phonetic SET phonetic = :phonetic WHERE phonetic_id = :phonetic_id";
        $stmnt = $link->prepare($sql);
    
        $entry_data = [':phonetic_id'=>$phonetic_id, ':phonetic'=>$phonetic];
        $stmnt->execute($entry_data);
    

        } catch(PDOException $e){
            echo "Erro: oi1".$e->getMessage();
        }//try

    


}



if(isset($_POST['del_phonetic'])){
  
  del_phonetic ($phonetic_id);

      try{
        $result = $link->query("SELECT * FROM form_bundles WHERE form_bundle_id = '$form_bundle_id'");
        if($result->rowCount()>0){
            foreach ($result as $row){
            $entry_id = $row['entry_id']; 
    
            }//foreach
        }else{}//if
    

    } catch(PDOException $e){
        echo "Erro: oi1".$e->getMessage();
    }//try


 
      form_bundle_output_edit($entry_id);

      ?>

      <script type='text/javascript' src="js/edit_form.js"></script>
      <script type='text/javascript' src="js/edit_phonemic.js"></script>
      <script type='text/javascript' src="js/edit_phonetic.js"></script>
      <script type='text/javascript' src="js/edit_pron.js"></script>

      <?php

}





if(isset($_POST['add_phonetic'])){

              $phonetic_order=$items+1;;
               $phonetic="[  ]";
    
    
                  try{
                      $sql = "INSERT INTO phonetic (phonemic_id, entry_ref, phonetic_order, source_lang, lang_code, phonetic) 
                      VALUES (:phonemic_id, :entry_ref, :phonetic_order, :source_lang, :lang_code, :phonetic)";
                      $stmnt = $link->prepare($sql);
                  
                      $entry_data = [':phonemic_id'=>$phonemic_id, ':entry_ref'=>$entry_ref, ':phonetic_order'=>$phonetic_order, ':source_lang'=>$source_lang, ':lang_code'=>$lang_code, ':phonetic'=>$phonetic];
                      $stmnt->execute($entry_data);
                  
    
                  } catch(PDOException $e){
                      echo "Erro: oi1".$e->getMessage();
                  }//try
    
                
      try{
        $result = $link->query("SELECT * FROM form_bundles WHERE form_bundle_id = '$form_bundle_id'");
        if($result->rowCount()>0){
            foreach ($result as $row){
            $entry_id = $row['entry_id']; 
    
            }//foreach
        }else{}//if
    

    } catch(PDOException $e){
        echo "Erro: oi1".$e->getMessage();
    }//try


 
      form_bundle_output_edit($entry_id);

      ?>
            <script type='text/javascript' src="js/edit_phonemic.js"></script>
        <script type='text/javascript' src="js/edit_phonetic.js"></script>
        <script type='text/javascript' src="js/edit_pron.js"></script>

      <?php
          
                }
