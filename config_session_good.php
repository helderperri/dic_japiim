<?php



      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }
  
//$dic_name = $_SESSION['dic_name'];



$dic_name = "";

include ("connection.php");


if(isset($_POST['lang_number'])){

  $lang_number = $_POST['lang_number'];

};

if(isset($_POST['field'])){

  $field = $_POST['field'];

};



if(isset($_POST['display'])){

  $display = $_POST['display'];

};

if(isset($_POST['update_entry'])){

      $entry_bundle_id = $_POST['entry_bundle_id'];
      $_SESSION['config_search_'.$dic_name][0]['entry_bundle_id'] = $entry_bundle_id;

}elseif(isset($_POST['update_session'])){
  
    if($_POST['direction'] == "source"){

      if($field == "all"){
        $_SESSION['config_sls_'.$dic_name][$lang_number-1]["vernacular"] = $display;
        $_SESSION['config_sls_'.$dic_name][$lang_number-1]["phonemic"] = $display;
        $_SESSION['config_sls_'.$dic_name][$lang_number-1]["phonetic"] = $display;
        $_SESSION['config_sls_'.$dic_name][$lang_number-1]["pronunciation"] = $display;
        $_SESSION['config_sls_'.$dic_name][$lang_number-1]["example"] = $display;
        $_SESSION['config_sls_'.$dic_name][$lang_number-1]["example_audio"] = $display;
        $_SESSION['config_sls_'.$dic_name][$lang_number-1]["example_phonetic"] = $display;
        $_SESSION['config_sls_'.$dic_name][$lang_number-1]["comments"] = $display;
        $_SESSION['config_sls_'.$dic_name][$lang_number-1]["lang_code_display"] = $display;
        $_SESSION['config_sls_'.$dic_name][$lang_number-1]["image_caption"] = $display;
        $_SESSION['config_sls_'.$dic_name][$lang_number-1]["video_caption"] = $display;


      }else{

        $_SESSION['config_sls_'.$dic_name][$lang_number-1][$field] = $display;

      }




    }elseif($_POST['direction'] == "target"){


      if($field == "all"){
        $_SESSION['config_tls_'.$dic_name][$lang_number-1]["class"] = $display;
        $_SESSION['config_tls_'.$dic_name][$lang_number-1]["gloss"] = $display;
        $_SESSION['config_tls_'.$dic_name][$lang_number-1]["def"] = $display;
        $_SESSION['config_tls_'.$dic_name][$lang_number-1]["example_translation"] = $display;
        $_SESSION['config_tls_'.$dic_name][$lang_number-1]["semantic"] = $display;
        $_SESSION['config_tls_'.$dic_name][$lang_number-1]["comments"] = $display;
        $_SESSION['config_tls_'.$dic_name][$lang_number-1]["lang_code_display"] = $display;
        $_SESSION['config_tls_'.$dic_name][$lang_number-1]["image_caption"] = $display;
        $_SESSION['config_tls_'.$dic_name][$lang_number-1]["video_caption"] = $display;


      }else{

        $_SESSION['config_tls_'.$dic_name][$lang_number-1][$field] = $display;

      }




    }elseif($_POST['direction'] == "no_lang"){


      $_SESSION['config_search_'.$dic_name][0][$field] = $display;
  /*
  //    $_SESSION['config_search_'.$dic_name][1][$field] = $display;
        foreach ($_SESSION['config_search_'.$dic_name] as $key => $item) {
          $item[$field] = $dislay;
          $_SESSION['config_search_'.$dic_name] = $item;
        }
        */

      foreach($_SESSION['config_search_'.$dic_name][0] as $row) {
        $row[$field] = $display;
      }
    //  }
    /*
    foreach($_SESSION['config_search_'.$dic_name] as $key => $value) {
      $_SESSION['config_search_'.$dic_name][$key][$field] = $display;
    }
  */
    }

  
}elseif(isset($_POST['login_google'])){
  
        if(isset($_SESSION['login_source'])){
          unset($_SESSION['login_source']);
        }

        $_SESSION['login_source'] = $_POST['login_source'];

}elseif(isset($_SESSION['user_sub'])){
  
            $user_sub = $_SESSION['user_sub'];
          
        
          $search_type="";
          $lang_type= "";
          $number_of_sls = "";
          $number_of_tls = "";
          $image = "";
          $video = "";
          $scn = "";
          $mode = "";
          $entry_bundle_id = "";
          $btn_id = "";
  
          $config_rows = check_user_register_dic ($user_sub);
          //$config_rows = 0;
          if($config_rows == 1){
  
            //USER ALREADY REGISTERED IN THIS DICTIONARY //DO SOMETHING
            //register_user_dic ($user_sub);
  
          }elseif($config_rows == 0){
                
          
            
            //register_user_dic ($user_sub);
  
  
      }
      //check_user_config_dic ($user_sub);
        $dic_name= "";
      include ("connection.php");
  
          $result3 = $link->query("SELECT * FROM config_search_users WHERE user_sub = $user_sub LIMIT 1");
        
          if($result3->rowCount()== 1000){
        
          //USER ALREADY REGISTERED IN THIS DICTIONARY //DO SOMETHING
        
          $config_search = array();
          $_SESSION['config_search_'.$dic_name] = array();
          $index = 1;
        
          foreach ($result3 as $key => $row){
              
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
        
              
        
         
          } // foreach   

        
          }else{
        
            $config_search = retrieve_original_config_search();
         
        
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
        

            //$dic_name = "";
            include ("connection.php");
            $config_sls = array();
            $_SESSION['config_sls_'.$dic_name] = array();
            //$source_langs_info = array();
            $index5 = 1;
            try {
              $result5 = $link->query("SELECT * FROM languages WHERE source_lang > 0");
                
                    if($result5->rowCount()>0){
                        
                      foreach ($result5 as $row5){
                        $lang_id = $row5['lang_id'];
                        $lang_code = $row5['lang_code'];
                        $native_name = $row5['native_name'];
                        $pt_name = $row5['pt_name'];
                        $es_name = $row5['es_name'];
                        $en_name = $row5['en_name'];
                         //$en_name = "en_name_DONE";
                        $fr_name = $row5['fr_name'];
                        $iso_639_3 = $row5['iso_639_3'];
                        $glottocode = $row5['glottocode'];
                        $source_lang = $row5['source_lang'];
                        $active = $row5['active'];
                        $search_display = $row5['search_display'];
                        $vernacular = $row5['vernacular'];
                        $phonemic = $row5['phonemic'];
                        $phonetic = $row5['phonetic'];
                        $pronunciation = $row5['pronunciation'];
                        $example = $row5['example'];
                        $example_audio = $row5['example_audio'];
                        $example_phonetic = $row5['example_phonetic'];
                        $comments = $row5['comments'];
                        $lang_code_display = $row5['lang_code_display'];
                        $image_caption = $row5['image_caption'];
                        $video_caption = $row5['video_caption'];                
                        $config_sls[$index5] = array('index'=>$index5, ':lang_code' => $lang_code, ':native_name' => $native_name, ':source_lang' => $source_lang, ':active' => $active, ':search_display' => $search_display, ':vernacular' => $vernacular, ':phonemic' => $phonemic, ':phonetic' => $phonetic, ':pronunciation' => $pronunciation, ':example' => $example, ':example_audio' => $example_audio, ':example_phonetic' => $example_phonetic, ':comments' => $comments, ':lang_code_display' => $lang_code_display, ':image_caption' => $image_caption, ':video_caption' => $video_caption); 
                        $_SESSION['config_sls_'.$dic_name][] = $config_sls[$index5];
                          //$source_langs_info[]=$config_sls[$index];
                          $index5 = $index5+1;


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
              //$source_langs_info = $_SESSION['config_sls_'.$dic_name];
              
            //$source_langs_info = $_SESSION['config_sls_'.$dic_name];
         
       



/*
            $target_langs_info = retrieve_original_config_tls();
      
            if(!empty($target_langs_info)){
              $index = 1;
              foreach($target_langs_info as $row){
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



              }


            }
*/





          }//if

          
          //$config_search = retrieve_original_config_search();
          //$source_langs_info = retrieve_original_config_sls();
          //$target_langs_info = retrieve_original_config_tls();
    

    }else{

      retrieve_original_config_search();
     
    try {
      $result = $link->query("SELECT * FROM languages WHERE source_lang > 0");
        
            if($result->rowCount()>0){
               
              $config_sls = array();
              $_SESSION['config_sls_'.$dic_name] = array();

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
  
  try {
      $result = $link->query("SELECT * FROM languages WHERE target_lang > 0");
        
            if($result->rowCount()>0){
              $_SESSION['config_tls_'.$dic_name] = array(); 
              $config_tls = array();
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



      }//if(isset($_POST['update_session'])//else








function retrieve_original_config_search(){
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  $dic_name = "";
  include ("connection.php");
  $config_search = array();
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
                $entry_bundle_id = 2;
                //$entry_bundle_id = $row["entry_bundle_id"];
                $btn_id = $row["btn_id"];
                $config_search[$index] = array('index'=>$index, 'search_type' => $search_type, 'lang_type' => $lang_type, 'number_of_sls'=>$number_of_sls, 'number_of_tls'=>$number_of_tls, 'scn'=>$scn, 'image'=>$image, 'video'=>$video, 'mode'=>$mode, 'entry_bundle_id' => $entry_bundle_id, 'btn_id' => $btn_id);
                $_SESSION['config_search_'.$dic_name][] = $config_search[$index]; 

                

            
            } // foreach   
            
      

            }else{
              //echo "A busca não retornou nenhum resultado.";
          } // if

            
      } catch(PDOException $e){
        echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try

    return $config_search;
}

function retrieve_original_config_sls(){
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  $dic_name = "";
  include ("connection.php");
  $config_sls = array();
  $_SESSION['config_sls_'.$dic_name] = array();
  $source_langs_info = array();
  $index = 1;
  try {
    $result = $link->query("SELECT * FROM languages WHERE source_lang > 0");
      
          if($result->rowCount()>0){
              
            foreach ($result as $row){
              $lang_id = $row['lang_id'];
              $lang_code = $row['lang_code'];
              $native_name = $row['native_name'];
              $pt_name = $row['pt_name'];
              $es_name = $row['es_name'];
              //$en_name = $row['en_name'];
               $en_name = "en_name_DONE";
              $fr_name = $row['fr_name'];
              $iso_639_3 = $row['iso_639_3'];
              $glottocode = $row['glottocode'];
              $source_lang = $row['source_lang'];
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
              $config_sls[$index] = array('index'=>$index, ':lang_id' => $lang_id, ':lang_code' => $lang_code, ':native_name' => $native_name, ':pt_name' => $pt_name, ':es_name' => $es_name, ':en_name' => $en_name, ':fr_name' => $fr_name, ':iso_639_3' => $iso_639_3, ':glottocode' => $glottocode, ':source_lang' => $source_lang, ':active' => $active, ':search_display' => $search_display, ':vernacular' => $vernacular, ':phonemic' => $phonemic, ':phonetic' => $phonetic, ':pronunciation' => $pronunciation, ':example' => $example, ':example_audio' => $example_audio, ':example_phonetic' => $example_phonetic, ':comments' => $comments, ':lang_code_display' => $lang_code_display, ':image_caption' => $image_caption, ':video_caption' => $video_caption); 
                $_SESSION['config_sls_'.$dic_name][] = $config_sls[$index];
                //$source_langs_info[]=$config_sls[$index];
                $index = $index+1;
            } // foreach     


            }else{
              //echo "A busca não retornou nenhum resultado.";
          } // if

      } catch(PDOException $e){
        echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //$source_langs_info = $_SESSION['config_sls_'.$dic_name];
    
    //return $source_langs_info;

    //return $source_langs_info;
}

function retrieve_original_config_tls(){
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  $dic_name = "";
  include ("connection.php");
  $config_tls = array();
  $_SESSION['config_tls_'.$dic_name] = array();
  
  try {
    $result = $link->query("SELECT * FROM languages WHERE target_lang > 0");
      
          if($result->rowCount()>0){
            $_SESSION['config_tls_'.$dic_name] = array(); 
            $config_tls = array();
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

    return $config_tls;
}


function check_user_register_dic ($user_sub){
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
  include ("connection.php");
  $config_rows = "";

  try{
    $result = $link->query("SELECT * FROM users WHERE user_sub = '$user_sub'");

  } catch(PDOException $e){
    echo "Erro: oi19".$e->getMessage();
  }//try
  $config_rows = $result->rowCount();

  return $config_rows;

}
    
function register_user_dic ($user_sub){
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
  include ("config_japiim.php");

  try{
    $result2 = $link_japiim->query("SELECT * FROM users WHERE user_sub = $user_sub ORDER BY user_id DESC LIMIT 1");
    

  } catch(PDOException $e){
    echo "Erro: oi165".$e->getMessage();
    
  }//try
      if($result2->rowCount()>0){

    foreach($result2 as $row){

    $user_sub = $row['user_sub'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name']; 
    $username = $row['username'];
    $password = $row['password'];
    $email = $row['email'];
    $validation_code = $row['validation_code'];
    $active = $row['active'];
    $picture = $row['picture'];
    $comments = $row['comments'];

    include ("connection.php");

    try {
          //session_start();
          $sql = "INSERT INTO users (user_sub, first_name, last_name, username, password, validation_code, email, picture, comments, active, joined, last_login) 
          VALUES (:user_sub, :first_name, :last_name, :username, :password, :validation_code, :email, :picture, :comments, :active, current_date, current_date)";
          $stmnt = $link->prepare($sql);
          $user_data2 = [':user_sub'=> $user_sub, ':first_name'=>$first_name,':last_name'=>$last_name, ':username'=>$username, ':password'=>$password, ':validation_code'=>$validation_code, ':email'=>$email, ':picture'=>$picture, ':comments'=>$comments, ':active'=>$active];
          $stmnt->execute($user_data2);

          $_SESSION['email'] = $email;
          $_SESSION['name'] = $username;
    //        $_SESSION['family_name'] = $family_name;
    //      $_SESSION['given_name'] = $given_name;
    //        $_SESSION['locale'] = $user_data['locale'];
          $_SESSION['user_sub'] = $user_sub;
    //      $_SESSION['client_id'] = $user_data['client_id'];
    //      $_SESSION['issuer'] = $user_data['iss'];
    //      $_SESSION['expires_at'] = $user_data['exp'];
      //     $_SESSION['issued_at'] = $user_data['iat'];
      //    $_SESSION['email_verified'] = $user_data['email_verified'];
          $_SESSION['picture'] = $picture;
          //$_SESSION['gmail'] = 0;
          //$_SESSION['signup_message'] = "Usuário cadastrado com sucesso!";
          //$_SESSION['profile'] = $user_data['profile'];
          //$_SESSION['gmail'] = 1;
          //$_SESSION["gmail"] = 1;

          
          //setcookie("user_sub", $user_sub, time()+86400*7);
          //setcookie("name", $name, time()+86400*7);
          //setcookie("picture", $picture, time()+86400*7);

          //header("Location: index.php");
      

      } catch(PDOException $e){
          echo "Erro: ".$e->getMessage();
      }

    }
  }








}
    
    


?>
