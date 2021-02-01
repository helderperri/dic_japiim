<?php
 

 if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

//$dic_name = $_SESSION['dic_name'];



$dic_name = "";

include ("connection.php");



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
      
      
  