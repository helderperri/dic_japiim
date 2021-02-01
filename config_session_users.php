<?php
    

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }
  
//$dic_name = $_SESSION['dic_name'];


$dic_name = "";

include ("connection.php");
include ("config_functions.php");



/*
if(isset($_SESSION["user_sub"])){
  
  $user_sub = $_SESSION["user_sub"];

}else{

if(isset($_COOKIE["user_sub"])){

  $user_sub = $_SESSION["user_sub"];


}else{





}

}

*/
$user_sub = $_SESSION["user_sub"];







/*


*/

          $result3 = $link->query("SELECT * FROM config_search_users WHERE user_sub = $user_sub");
        
          if($result3->rowCount() > 0){
        
          //USER ALREADY REGISTERED IN THIS DICTIONARY //DO SOMETHING
        
          $config_search = array();
          unset($_SESSION['config_search_'.$dic_name]);
            
          $_SESSION['config_search_'.$dic_name] = array();
          $index = 1;
        
          foreach ($result3 as $row){
              
              $search_type=$row["search_type"];
              $lang_type=$row["lang_type"];
              $number_of_sls =$row["number_of_sls"];
              $number_of_tls =$row["number_of_tls"];
              $image = $row["image"];
              $video = $row["video"];
              $scn = $row["scn"];
              //$mode = 2;
              $mode = $row["mode"];
              //$entry_bundle_id = 139;
              $entry_bundle_id = $row["entry_bundle_id"];
              $btn_id = $row["btn_id"];
              $config_search[$index] = array('index'=>$index, 'search_type' => $search_type, 'lang_type' => $lang_type, 'number_of_sls'=>$number_of_sls, 'number_of_tls'=>$number_of_tls, 'scn'=>$scn, 'image'=>$image, 'video'=>$video, 'mode'=>$mode, 'entry_bundle_id' => $entry_bundle_id, 'btn_id' => $btn_id);
              $_SESSION['config_search_'.$dic_name][] = $config_search[$index]; 
        
              
        
         
          } // foreach   




          $config_sls = array();
          unset($_SESSION['config_sls_'.$dic_name]);
          $_SESSION['config_sls_'.$dic_name] = array();
      
          try {
            $result = $link->query("SELECT * FROM languages_users WHERE (user_sub = $user_sub) AND (source_lang > 0)");
              
                  if($result->rowCount()>0){
      
                    $index = 1;
                    foreach ($result as $row){
                        $lang_code = $row['lang_code'];
                        $source_lang = $row['source_lang'];
                        $native_name = $row['native_name'];
                        $search_display = $row['search_display'];
                        $vernacular = $row['vernacular'];
                        $phonemic = $row['phonemic'];
                        $phonetic = $row['phonetic'];
                        $pronunciation = $row['pronunciation'];
                        $example = $row['example'];
                        $example_audio = $row['example_audio'];
                        $example_phonetic = $row['example_phonetic'];
                        $comments = $row['comments'];
                        $lang_code_display = $row['lang_code_display'];
                        $image_caption = $row['image_caption'];
                        $video_caption = $row['video_caption'];
                        $config_sls[$index] = array('index'=>$index, 'lang_code'=>$lang_code, 'source_lang'=>$source_lang, 'native_name' => $native_name, 'search_display' => $search_display, 'vernacular' => $vernacular, 'phonemic' => $phonemic, 'phonetic' => $phonetic, 'pronunciation' => $pronunciation, 'example' => $example, 'example_audio' => $example_audio, 'example_phonetic' => $example_phonetic, 'comments' => $comments, 'lang_code_display' => $lang_code_display, 'image_caption' => $image_caption, 'video_caption' => $video_caption); 
                        $_SESSION['config_sls_'.$dic_name][] = $config_sls[$index];
                        $index = $index+1;





                    } // foreach     
      
        
                    }else{
                      //echo "A busca não retornou nenhum resultado.";
                  } // if
        
                    
              } catch(PDOException $e){
                echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
            } // try


            unset($_SESSION['config_tls_'.$dic_name]);

            $config_tls = array();
            $_SESSION['config_tls_'.$dic_name] = array();
            
            try {
              $result = $link->query("SELECT * FROM languages_users WHERE (user_sub = $user_sub) AND (target_lang > 0)");
                
                    if($result->rowCount()>0){
                      $index = 1;
          
                      foreach ($result as $row){
                          $lang_code = $row['lang_code'];
                          $target_lang = $row['target_lang'];
                          $native_name = $row['native_name'];
                          $search_display = $row['search_display'];
                          $class = $row['class'];
                          $gloss = $row['gloss'];
                          $def = $row['def'];
                          $example_translation = $row['example_translation'];
                          $semantic = $row['semantic'];
                          $comments = $row['comments'];
                          $lang_code_display = $row['lang_code_display'];
                          $image_caption = $row['image_caption'];
                          $video_caption = $row['video_caption'];
                          $config_tls[$index] = array('index'=>$index, 'lang_code'=>$lang_code, 'target_lang'=>$target_lang, 'native_name' => $native_name, 'search_display' => $search_display, 'class' => $class, 'gloss' => $gloss, 'def' => $def, 'example_translation' => $example_translation, 'semantic' => $semantic, 'comments' => $comments, 'lang_code_display' => $lang_code_display, 'image_caption' => $image_caption, 'video_caption' => $video_caption);
                          $_SESSION['config_tls_'.$dic_name][] = $config_tls[$index];
                          $index = $index+1;
          
                      } // foreach     
          
          
                
          
                      }else{
                        //echo "A busca não retornou nenhum resultado.";
                    } // if
          
                      
                } catch(PDOException $e){
                  echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
              } // try
          


          }else{


            $user_register = check_user_register_dic ($user_sub);

                if($user_register > 0){


                }else{

                register_user_dic ($user_sub);
                }
           
            $config_search = array();

       
            unset($_SESSION['config_search_'.$dic_name]);
            $_SESSION['config_search_'.$dic_name] = array();
            $index = 1;
          
            try {
              $result = $link->query("SELECT * FROM config_search");
                
                    if($result->rowCount()>0){
                      
                      foreach ($result as $key => $row){
                          
                          $search_type=$row["search_type"];
                          $lang_type=$row["lang_type"];
                          $number_of_sls =$row["number_of_sls"];
                          $number_of_tls =$row["number_of_tls"];
                          $image = $row["image"];
                          $video = $row["video"];
                          $scn = $row["scn"];
                          $mode = $row["mode"];
                          $entry_bundle_id = $row["entry_bundle_id"];
                          $btn_id = $row["btn_id"];
                          $config_search[$index] = array('index'=>$index, 'search_type' => $search_type, 'lang_type' => $lang_type, 'number_of_sls'=>$number_of_sls, 'number_of_tls'=>$number_of_tls, 'scn'=>$scn, 'image'=>$image, 'video'=>$video, 'mode'=>$mode, 'entry_bundle_id' => $entry_bundle_id, 'btn_id' => $btn_id);
                          $_SESSION['config_search_'.$dic_name][] = $config_search[$index]; 
                          $index = $index+1;
                          
          
                      
                      } // foreach   
                      
                
          
                      }else{
                        //echo "A busca não retornou nenhum resultado.";
                    } // if
          
                      
                } catch(PDOException $e){
                  echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
              } // try
        
            try {
              //session_start();
              $sql = "INSERT INTO config_search_users (user_sub, search_type, lang_type, number_of_sls, number_of_tls, image, video, scn, mode, entry_bundle_id, btn_id) 
              VALUES (:user_sub, :search_type, :lang_type, :number_of_sls, :number_of_tls, :image, :video, :scn, :mode, :entry_bundle_id, :btn_id)";
              $stmnt = $link->prepare($sql);
        
              $user_data2 = [':user_sub'=> $user_sub, ':search_type'=> $config_search[1]['search_type'], ':lang_type'=> $config_search[1]['lang_type'], ':number_of_sls'=> $config_search[1]['number_of_sls'], ':number_of_tls'=> $config_search[1]['number_of_tls'], ':image'=> $config_search[1]['image'], ':video'=> $config_search[1]['video'], ':scn'=> $config_search[1]['scn'], ':mode'=> $config_search[1]['mode'], ':entry_bundle_id'=> $config_search[1]['entry_bundle_id'], ':btn_id'=> $config_search[1]['btn_id']];
              $stmnt->execute($user_data2);
        
            } catch(PDOException $e){
                echo "Erro: ".$e->getMessage();
            }



            $config_sls = array();
            unset($_SESSION['config_sls_'.$dic_name]);
            $_SESSION['config_sls_'.$dic_name] = array();
        
            try {
              $result = $link->query("SELECT * FROM languages WHERE source_lang > 0");
                
                    if($result->rowCount()>0){
        
                      $index = 1;
                      foreach ($result as $row){
                          $lang_code = $row['lang_code'];
                          $lang_id = $row['lang_id'];
                          $pt_name  = $row['pt_name']; 
                          $es_name = $row['es_name']; 
                          $en_name = $row['en_name']; 
                          $fr_name = $row['fr_name']; 
                          $iso_639_3 = $row['iso_639_3']; 
                          $glottocode = $row['glottocode']; 
                          $source_lang = $row['source_lang'];
                          $native_name = $row['native_name'];
                          $active = $row['active'];
                          $search_display = $row['search_display'];
                          $vernacular = $row['vernacular'];
                          $phonemic = $row['phonemic'];
                          $phonetic = $row['phonetic'];
                          $pronunciation = $row['pronunciation'];
                          $example = $row['example'];
                          $example_audio = $row['example_audio'];
                          $example_phonetic = $row['example_phonetic'];
                          $comments = $row['comments'];
                          $lang_code_display = $row['lang_code_display'];
                          $image_caption = $row['image_caption'];
                          $video_caption = $row['video_caption'];
                          $config_sls[$index] = array('index'=>$index, 'lang_code'=>$lang_code, 'source_lang'=>$source_lang, 'native_name' => $native_name, 'search_display' => $search_display, 'vernacular' => $vernacular, 'phonemic' => $phonemic, 'phonetic' => $phonetic, 'pronunciation' => $pronunciation, 'example' => $example, 'example_audio' => $example_audio, 'example_phonetic' => $example_phonetic, 'comments' => $comments, 'lang_code_display' => $lang_code_display, 'image_caption' => $image_caption, 'video_caption' => $video_caption); 
                          $_SESSION['config_sls_'.$dic_name][] = $config_sls[$index];
                          $index = $index+1;



                          try {
                            //session_start();
                            $sql3 = "INSERT INTO languages_users (user_sub, lang_id, lang_code, native_name, pt_name, es_name, en_name, fr_name, iso_639_3, glottocode, source_lang, active, search_display, vernacular, phonemic, phonetic, pronunciation, example, example_audio, example_phonetic, comments, lang_code_display, image_caption, video_caption) 
                            VALUES (:user_sub, :lang_id, :lang_code, :native_name, :pt_name, :es_name, :en_name, :fr_name, :iso_639_3, :glottocode, :source_lang, :active, :search_display, :vernacular, :phonemic, :phonetic, :pronunciation, :example, :example_audio, :example_phonetic, :comments, :lang_code_display, :image_caption, :video_caption)";
                            $stmnt3 = $link->prepare($sql3);
                      
                            $user_data3 = [':user_sub' => $user_sub, ':lang_id' => $lang_id, ':lang_code' => $lang_code, ':native_name' => $native_name, ':pt_name' => $pt_name, ':es_name' => $es_name, ':en_name' => $en_name, ':fr_name' => $fr_name, ':iso_639_3' => $iso_639_3, ':glottocode' => $glottocode, ':source_lang' => $source_lang, ':active' => $active, ':search_display' => $search_display, ':vernacular' => $vernacular, ':phonemic' => $phonemic, ':phonetic' => $phonetic, ':pronunciation' => $pronunciation, ':example' => $example, ':example_audio' => $example_audio, ':example_phonetic' => $example_phonetic, ':comments' => $comments, ':lang_code_display' => $lang_code_display, ':image_caption' => $image_caption, ':video_caption' => $video_caption];
                            $stmnt3->execute($user_data3);
                      
                          } catch(PDOException $e){
                              echo "Erro: ".$e->getMessage();
                          }


                      } // foreach     
        
          
                      }else{
                        //echo "A busca não retornou nenhum resultado.";
                    } // if
          
                      
                } catch(PDOException $e){
                  echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
              } // try


              unset($_SESSION['config_tls_'.$dic_name]);

              $config_tls = array();
              $_SESSION['config_tls_'.$dic_name] = array();
              
              try {
                $result7 = $link->query("SELECT * FROM languages WHERE target_lang > 0");
                  
                      if($result7->rowCount()>0){
                        $index = 1;
            
                        foreach ($result7 as $row){
                          $lang_code = $row['lang_code'];
                          $lang_id = $row['lang_id'];
                          $pt_name  = $row['pt_name']; 
                          $es_name = $row['es_name']; 
                          $en_name = $row['en_name']; 
                          $fr_name = $row['fr_name']; 
                          $iso_639_3 = $row['iso_639_3']; 
                          $glottocode = $row['glottocode']; 
                          $target_lang = $row['target_lang'];
                          $native_name = $row['native_name'];
                          $active = $row['active'];
                          $search_display = $row['search_display'];
                          $class = $row['class'];
                          $gloss = $row['gloss'];
                          $def = $row['def'];
                          $example_translation = $row['example_translation'];
                          $semantic = $row['semantic'];
                          $comments = $row['comments'];
                          $lang_code_display = $row['lang_code_display'];
                          $image_caption = $row['image_caption'];
                          $video_caption = $row['video_caption'];
                          $config_tls[$index] = array('index'=>$index, 'lang_code'=>$lang_code, 'target_lang'=>$target_lang, 'native_name' => $native_name, 'search_display' => $search_display, 'class' => $class, 'gloss' => $gloss, 'def' => $def, 'example_translation' => $example_translation, 'semantic' => $semantic, 'comments' => $comments, 'lang_code_display' => $lang_code_display, 'image_caption' => $image_caption, 'video_caption' => $video_caption);
                          $_SESSION['config_tls_'.$dic_name][] = $config_tls[$index];
                          $index = $index+1;


                            
                          try {
                            //session_start();
                            $sql4 = "INSERT INTO languages_users (user_sub, lang_id, lang_code, native_name, pt_name, es_name, en_name, fr_name, iso_639_3, glottocode, target_lang, active, search_display, class, gloss, def, example_translation, semantic, comments, lang_code_display, image_caption, video_caption) 
                            VALUES (:user_sub, :lang_id, :lang_code, :native_name, :pt_name, :es_name, :en_name, :fr_name, :iso_639_3, :glottocode, :target_lang, :active, :search_display, :class, :gloss, :def, :example_translation, :semantic, :comments, :lang_code_display, :image_caption, :video_caption)";
                            $stmnt4 = $link->prepare($sql4);
                      
                            $user_data4 = [':user_sub' => $user_sub, ':lang_id' => $lang_id, ':lang_code' => $lang_code, ':native_name' => $native_name, ':pt_name' => $pt_name, ':es_name' => $es_name, ':en_name' => $en_name, ':fr_name' => $fr_name, ':iso_639_3' => $iso_639_3, ':glottocode' => $glottocode, ':target_lang' => $target_lang, ':active' => $active, ':search_display' => $search_display, 'class' => $class, 'gloss' => $gloss, 'def' => $def, 'example_translation' => $example_translation, 'semantic' => $semantic, 'comments' => $comments, 'lang_code_display' => $lang_code_display, 'image_caption' => $image_caption, 'video_caption' => $video_caption];
                            $stmnt4->execute($user_data4);
                      
                          } catch(PDOException $e){
                              echo "Erro: ".$e->getMessage();
                          }
            
                        } // foreach     
            
            
                  
            
                        }else{
                          //echo "A busca não retornou nenhum resultado.";
                      } // if
            
                        
                  } catch(PDOException $e){
                    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                } // try
            
  
          }//if



