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


