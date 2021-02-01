<?php


include ("config_japiim.php");


if(isset($_POST["add_word"])){


    $lang_code = $_POST['lang_code'];
    $form_bundle_id = $_POST['form_bundle_id'];
    $form_id = $_POST['form_id'];
    $user_id = $_POST['user_id'];
    $dic_name = $_POST['dic_name'];




    try {
        //session_start();
        $sql = "INSERT INTO users_words (user_id, dic_name, lang_code, form_bundle_id, form_id) 
        VALUES (:user_id, :dic_name, :lang_code, :form_bundle_id, :form_id)";
        $stmnt = $link_japiim->prepare($sql);
    
        $entry_data = [
            'user_id' => "$user_id",
            'dic_name' => "$dic_name",
            'lang_code' => "$lang_code",
            'form_bundle_id' => "$form_bundle_id",
            'form_id' => "$form_id",
            
          ];
        $stmnt->execute($entry_data);
     
        
      } catch(PDOException $e){
          echo "Erro:xxxx ".$e->getMessage();
      }





}

