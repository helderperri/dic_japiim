<?php
    $dic_name = "";
    include ("connection.php");
    include ("functions.php");


if(isset($_POST['lang_code'])){

    $lang_code = $_POST['lang_code'];
    
      }else{
  
  } 
  
  if(isset($_POST['bundle'])){

    $sense_bundle_id = $_POST['bundle'];
    
      }else{
  
  }

  if(isset($_POST['scn_id'])){

    $scn_id = $_POST['scn_id'];
    
      }else{
  
  }

  if(isset($_POST['scn_order'])){

    $scn_order = $_POST['scn_order'];
    
      }else{
  
  }

  if(isset($_POST['scn'])){

    $scn = $_POST['scn'];
    
      }else{
  
  }

  if(isset($_POST['items'])){

    $items = $_POST['items'];
    
      }else{
  
  }

if(isset($_POST['add_scn'])){

  try {
    //session_start();
    $sql = "INSERT INTO scns (sense_bundle_id, entry_ref, scn_order, lang_code, scn) 
    VALUES (:sense_bundle_id, 'entry_ref', :scn_order, :lang_code,  :scn)";
    $stmnt = $link->prepare($sql);

    $entry_data = [':sense_bundle_id'=>$sense_bundle_id,':scn_order'=>$items+1, ':lang_code'=>$lang_code, ':scn'=>''];
    $stmnt->execute($entry_data);
 




} catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
}
scns_edit ($sense_bundle_id);


}



if(isset($_POST['save_scn'])){

    try {
      //session_start();
      $sql = "UPDATE scns SET scn = :scn WHERE scn_id=:scn_id";
      $stmnt = $link->prepare($sql);
  
      $entry_data = [':scn'=>$scn,':scn_id'=>$scn_id];
      $stmnt->execute($entry_data);
   
  
  
  
  } catch(PDOException $e){
      echo "Erro: ".$e->getMessage();
  }

  scns_edit ($sense_bundle_id);

  }



if(isset($_POST['del_scn'])){

    try {
      //session_start();
      //session_start();
      $result = $link->query("SELECT * FROM scns WHERE scn_id = '$scn_id'");

      if($result->rowCount()>0){
        
        foreach ($result as $row){
            $scn=$row["scn"];
            $entry_ref=$row["entry_ref"];
            $target_lang=1;
            $scn_order=$row["scn_order"];
            
            if ($scn==""){

            }else{
  
                try{
                    $sql = "INSERT INTO scns_bck (sense_bundle_id, entry_ref, scn_id, scn_order, lang_code, scn) 
                    VALUES (:sense_bundle_id, :entry_ref, :scn_id, :scn_order, :lang_code, :scn)";
                    $stmnt = $link->prepare($sql);
                
                    $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':scn_id'=>$scn_id, ':scn_order'=>$scn_order, ':lang_code'=>$lang_code, ':scn'=>$scn];
                    $stmnt->execute($entry_data);
                

                } catch(PDOException $e){
                    echo "Erro: ".$e->getMessage();
                }//try
  
            }//if


          } // foreach      
  
        }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if


try{
      $sql2 = "DELETE FROM scns WHERE scn_id = :scn_id";
      $stmnt2 = $link->prepare($sql2);
  
      $entry_data2 = [':scn_id'=>$scn_id];
      $stmnt2->execute($entry_data2);
   

  
    
    } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
    }

    
    
    } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
    }

    scns_edit ($sense_bundle_id);

}//if(isset($_POST['del_scn']))

if(isset($_POST['restore_scn'])){

  try {
  //session_start();
  //session_start();
  $result = $link->query("SELECT * FROM scns_bck WHERE scn_id = '$scn_id'");

  if($result->rowCount()>0){
      
      foreach ($result as $row){
          $scn=$row["scn"];
          $entry_ref=$row["entry_ref"];
          $target_lang=0;
          

      
              try{
                  $sql = "INSERT INTO scns (sense_bundle_id, entry_ref, scn_order, lang_code, scn) 
                  VALUES (:sense_bundle_id, :entry_ref, :scn_order, :lang_code, :scn)";
                  $stmnt = $link->prepare($sql);
              
                  $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':scn_order'=>$scn_order, ':lang_code'=>$lang_code, ':scn'=>$scn];
                  $stmnt->execute($entry_data);
              

              } catch(PDOException $e){
                  echo "Erro: ".$e->getMessage();
              }//try



      } // foreach      

      }else{
      //echo "A busca não retornou nenhum resultado.";
  } // if



  $sql2 = "DELETE FROM scns_bck WHERE scn_id = :scn_id";
  $stmnt2 = $link->prepare($sql2);

  $entry_data2 = [':scn_id'=>$scn_id];
  $stmnt2->execute($entry_data2);



} catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
}

scns_edit ($sense_bundle_id);

}//if(isset($_POST['del_scn']))




