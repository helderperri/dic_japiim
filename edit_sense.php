<?php
include ("functions.php");
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

  if(isset($_POST['sense_id'])){

    $sense_id = $_POST['sense_id'];
    
      }else{
  
  } 
  
  if(isset($_POST['sense_bundle_id'])){

    $sense_bundle_id = $_POST['sense_bundle_id'];
    
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

  if(isset($_POST['entry_id'])){

    $entry_id = $_POST['entry_id'];
    
      }else{
  
  }

if(isset($_POST['add_sense'])){
  $bundle_order = $items+1;
  try {
    //session_start();
    $sql = "INSERT INTO sense_bundles (entry_id, entry_ref, bundle_order) 
    VALUES (:entry_id, 'entry_ref', :bundle_order)";
    $stmnt = $link->prepare($sql);

    $entry_data = [':entry_id'=>$entry_id,':bundle_order'=>$bundle_order];
    $stmnt->execute($entry_data);
 


} catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
}



$sense_bundle_id = "";

try {
  //session_start();
  $result2 = $link->query("SELECT * FROM sense_bundles WHERE entry_id = '$entry_id' AND bundle_order ='$bundle_order'");
  if($result2->rowCount()>0){
    foreach ($result2 as $key => $row){    
      $sense_bundle_id=$row["sense_bundle_id"];

    }//foreach

  }//if


} catch(PDOException $e){
  echo "Erro: ".$e->getMessage();
}




$target_langs_info = $_SESSION['config_tls_'.$dic_name];
foreach ($target_langs_info as $target_lang_info){

  $target_lang = $target_lang_info['target_lang'];
  $lang_code = $target_lang_info['lang_code'];



  try {
    //session_start();
    $sql = "INSERT INTO senses (sense_bundle_id, entry_ref, sense_order, target_lang, lang_code, gloss, class, def) 
    VALUES (:sense_bundle_id, 'entry_ref', :sense_order, :target_lang, :lang_code, 'gloss', 'class', :def)";
    $stmnt = $link->prepare($sql);
  
    $entry_data = [':sense_bundle_id'=>$sense_bundle_id,':sense_order'=>$bundle_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':def'=>''];
    $stmnt->execute($entry_data);
  
  
  } catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
  }
  


}//foreach

sense_bundle_output_edit($entry_id);

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

  if(isset($_POST['bck_sense'])){

    bck_single_sense ($sense_id);
  }  

if(isset($_POST['del_sense'])){

  bck_whole_sense ($sense_bundle_id);
  bck_all_glosses ($sense_bundle_id);
  bck_all_scns ($sense_bundle_id);
  bck_all_example_bundles ($sense_bundle_id);
  del_whole_sense ($sense_bundle_id);
  del_all_glosses ($sense_bundle_id);
  del_all_scns ($sense_bundle_id);
  del_all_example_bundles ($sense_bundle_id);
  del_sense_bundle ($sense_bundle_id);
  sense_bundle_output_edit($entry_id);
    
}//if(isset($_POST['del_sense']))



if(isset($_POST['create_def'])){

  ?>
  <input id="sense_input_<?php echo $sense_id; ?>" sense_order='<?php echo $sense_order; ?>' first="1" class="form-control form-control-sm ml-auto pr-1 sense_input" sense_id="<?php echo $sense_id; ?>" type="text" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" value="" >


  <script>

      $('#sense_input_<?php echo $sense_id; ?>').keyup(function(){
            var lang_code = $(this).attr('lang_code');
            var bundle = $(this).attr('bundle');
            var first = $(this).attr('first');
            var def = $(this).val();
            //var original = $(this).attr('original');
            var sense_id = $(this).attr('sense_id');
            var update_sense = 1;
 
            $.ajax({
                  url:'edit_sense.php',
                  data:{def:def, sense_id:sense_id, update_sense:update_sense},
                  type: 'POST',
                  success: function(data){
                    /*  if(!data.error){
                          $(def_div).html(data);
              
                      }*/
                  }
                  
              
                })
              

            })

  </script>
<?php

}



if(isset($_POST['restore_sense'])){

    try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM senses_bck WHERE sense_id = '$sense_id'");

    if($result->rowCount()>0){
        
        foreach ($result as $row){
            $def=$row["def"];
            $entry_ref=$row["entry_ref"];
            $target_lang=$row["target_lang"];
            
            $class=$row["class"];

        
                try{
                    $sql = "INSERT INTO senses (sense_bundle_id, entry_ref, sense_order, target_lang, lang_code, class, def) 
                    VALUES (:sense_bundle_id, :entry_ref, :sense_order, :target_lang, :lang_code, :class, :def)";
                    $stmnt = $link->prepare($sql);
                
                    $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':sense_order'=>$sense_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':class'=>$class, ':def'=>$def];
                    $stmnt->execute($entry_data);
                

                } catch(PDOException $e){
                    echo "Erro: ".$e->getMessage();
                }//try



        } // foreach      

        }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if



    $sql2 = "DELETE FROM senses_bck WHERE sense_id = :sense_id";
    $stmnt2 = $link->prepare($sql2);

    $entry_data2 = [':sense_id'=>$sense_id];
    $stmnt2->execute($entry_data2);


  
  } catch(PDOException $e){
      echo "Erro: ".$e->getMessage();
  }
  
}//if(isset($_POST['del_sense']))



