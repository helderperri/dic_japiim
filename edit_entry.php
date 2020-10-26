<?php

    $dic_name = "";
    include ("connection.php");
    require_once ("functions.php");

    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }else{
    }
    

    if(isset($_POST['items'])){

        $items = $_POST['items'];
    
        }else{
    
    }    

    if(isset($_POST['entry_bundle_id'])){

        $entry_bundle_id = $_POST['entry_bundle_id'];
    
        }else{
    
    }    
        


$source_langs_info = $_SESSION['config_sls_'.$dic_name];

if(isset($_POST['new_entry'])){

    $e = "";
    $sl_count = $_POST['sl_count'];
    
    foreach($source_langs_info as $source_lang_info){
        $lang_code = $source_lang_info['lang_code'];
        $source_lang = $source_lang_info['source_lang'];
        $form = $_POST['form_sl'.$source_lang];


    if($source_lang ==1){

      try {
        //session_start();
        $sql = "INSERT INTO entry_bundles (entry_ref, homonym) 
        VALUES (:entry_ref, :homonym)";
        $stmnt = $link->prepare($sql);
    
        $entry_data = [
            'entry_ref' => $form,
            'homonym' => 0
            
          ];
        $stmnt->execute($entry_data);
     
    
        
      } catch(PDOException $e){
          echo "Erro:xxxx ".$e->getMessage();
      }


      try {
        //session_start();
        $result2 = $link->query("SELECT * FROM entry_bundles ORDER BY entry_bundle_id DESC LIMIT 1");

        if($result2->rowCount()>0){

            foreach($result2 as $row){

                $entry_bundle_id =$row["entry_bundle_id"];


              }
            }
        
            } catch(PDOException $e){
                echo "Erro:xxxx ".$e->getMessage();
            }
    

                try {
                        //session_start();
                        $sql2 = "INSERT INTO entries (entry_bundle_id, entry_ref, entry_order, entry_homonym) 
                        VALUES (:entry_bundle_id, :entry_ref, :entry_order, :entry_homonym)";
                        $stmnt = $link->prepare($sql2);
                    
                        $entry_data2 = [
                            'entry_bundle_id' => $entry_bundle_id,
                            'entry_ref' => $form,
                            'entry_order' => 1,
                            'entry_homonym' => 0
                            
                        ];
                        $stmnt->execute($entry_data2);
                    
                    
                        
                    } catch(PDOException $e){
                        echo "Erro:xxxx ".$e->getMessage();
                    }



                    try {
                        //session_start();
                        $result3 = $link->query("SELECT * FROM entries ORDER BY entry_id DESC LIMIT 1");
                
                        if($result3->rowCount()>0){
                
                            foreach($result3 as $row){
                
                                $entry_id =$row["entry_id"];
                
                
                              }
                            }
                        
                            } catch(PDOException $e){
                                echo "Erro:xxxx ".$e->getMessage();
                            }
                    
                
                                try {
                                        //session_start();
                                        $sql3 = "INSERT INTO form_bundles (entry_id, entry_ref, bundle_order) 
                                        VALUES (:entry_id, :entry_ref, :bundle_order)";
                                        $stmnt3 = $link->prepare($sql3);
                                    
                                        $entry_data3 = [
                                            'entry_id' => $entry_id,
                                            'entry_ref' => $form,
                                            'bundle_order' => 1
                                        ];
                                        $stmnt3->execute($entry_data3);
                                    
                                    
                                        
                                    } catch(PDOException $e){
                                        echo "Erro:xxxx ".$e->getMessage();
                                    }
                
                
                





        
    }

    if(strlen($form) == 0){

    }else{



    try {
        //session_start();
        $result4 = $link->query("SELECT * FROM form_bundles ORDER BY form_bundle_id DESC LIMIT 1");

        if($result4->rowCount()>0){

            foreach($result4 as $row){

                $form_bundle_id =$row["form_bundle_id"];


              }
            }
        
            } catch(PDOException $e){
                echo "Erro:xxxx ".$e->getMessage();
            }
    

                try {
                        //session_start();
                        $sql4 = "INSERT INTO forms (form_bundle_id, entry_ref, form_order, source_lang, lang_code, vernacular) 
                        VALUES (:form_bundle_id, :entry_ref, :form_order, :source_lang, :lang_code, :vernacular)";
                        $stmnt4 = $link->prepare($sql4);
                    
                        $entry_data4 = [
                            'form_bundle_id' => $form_bundle_id,
                            'entry_ref' => $form,
                            'form_order' => 1,
                            'source_lang' => $source_lang,
                            'lang_code' => $lang_code,
                            'vernacular' => $form
                        ];
                        $stmnt4->execute($entry_data4);
                    
                    
                        
                    } catch(PDOException $e){
                        echo "Erro:xxxx ".$e->getMessage();
                    }



    




    }//if(strlen($form) == 0) (else)

}//foreach



$entry_bundle_id = "";

try {
    //session_start();
    $result2 = $link->query("SELECT * FROM entry_bundles ORDER BY entry_bundle_id DESC LIMIT 1");

    if($result2->rowCount()>0){

        foreach($result2 as $row){

            $entry_bundle_id =$row["entry_bundle_id"];
           
        if(isset($_SESSION['entry_bundle_id'])){
            unset($_SESSION['entry_bundle_id']);
        }
        $_SESSION['entry_bundle_id'] = $entry_bundle_id;

          }
        }
    
        } catch(PDOException $e){
            echo "Erro:xxxx ".$e->getMessage();
        }

    
    if(isset($_SESSION['new_entry_update'])){
        unset($_SESSION['new_entry_update']);
    }

        $_SESSION['new_entry_update'] = 1;




if(empty($e)){

    echo "<div id='new_entry_alert' class='alert alert-success mr-2 ml-2 flex-grow-1'>Entrada inserida com sucesso!</div>";            

}            





    }//if


    if(isset($_POST['update_entry'])){
        //$entry_bundle_id = "";

        //header("Location: ./");
        
 
    }

    

    if(isset($_POST['update_new_entry_nav'])){

                include ("nav_new_entry.php");

    }

    

    if(isset($_POST['reload_js'])){

        include ("new_entry_nav_js.php");

}


if(isset($_POST['del_entry'])){

    bck_whole_entry_bundle($entry_bundle_id);
    del_whole_entry_bundle($entry_bundle_id);
}

