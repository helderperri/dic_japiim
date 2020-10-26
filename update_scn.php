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



if(isset($_POST['bck_scn'])){

    try {
        //session_start();
        //session_start();
        $result = $link->query("SELECT * FROM scns WHERE scn_id = '$scn_id'");
  
        if($result->rowCount()>0){
          
          foreach ($result as $row){
            $sense_bundle_id=$row["sense_bundle_id"];
            $scn=$row["scn"];
              $entry_ref=$row["entry_ref"];
              $target_lang=1;
              $lang_code=$row["lang_code"];
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
  
  
  
  
  
  } catch(PDOException $e){
      echo "Erro: ".$e->getMessage();
  }
  
  }

  if(isset($_POST['update_scn'])){

    try {
        //session_start();
        $sql = "UPDATE scns SET scn = :scn WHERE scn_id=:scn_id";
        $stmnt = $link->prepare($sql);
    
        $entry_data = [':scn'=>$scn,':scn_id'=>$scn_id];
        $stmnt->execute($entry_data);
     
    
    
    
    } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
    }

  }



