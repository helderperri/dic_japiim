<?php



      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }
  
//$dic_name = $_SESSION['dic_name'];



$dic_name = "";

include ("connection.php");
include ("config_functions.php");


if(isset($_POST['lang_number'])){

  $lang_number = $_POST['lang_number'];

};

if(isset($_POST['field'])){

  $field = $_POST['field'];

};



if(isset($_POST['display'])){

  $display = $_POST['display'];

};


function update_user_entry_id ($user_sub, $entry_bundle_id){


  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

//$dic_name = $_SESSION['dic_name'];

$dic_name = "";

include ("connection.php");


$data = [
  'entry_bundle_id' => $entry_bundle_id,
  'user_sub' => $user_sub
];
$sql = "UPDATE config_search_users SET entry_bundle_id=:entry_bundle_id WHERE user_sub=:user_sub";
$stmt= $link->prepare($sql);
$stmt->execute($data);




}



function update_user_config($user_sub, $field, $display){


  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

//$dic_name = $_SESSION['dic_name'];

$dic_name = "";

include ("connection.php");


$data = [
  'display' => $display,
  'user_sub' => $user_sub
];
$sql = "UPDATE config_search_users SET $field=:display WHERE user_sub=:user_sub";
$stmt= $link->prepare($sql);
$stmt->execute($data);




}


function  update_languages_users_config($user_sub, $lang_direction, $lang_number, $field, $display){





  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

//$dic_name = $_SESSION['dic_name'];

$dic_name = "";

include ("connection.php");


$data = [
  'display' => $display,
  'lang_number' => $lang_number,
  'user_sub' => $user_sub
];
$sql = "UPDATE languages_users SET $field=:display WHERE (user_sub=:user_sub) AND ($lang_direction = :lang_number)";
$stmt= $link->prepare($sql);
$stmt->execute($data);




}

function check_unckeck_all_sls_users($user_sub, $lang_number, $display){





  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

//$dic_name = $_SESSION['dic_name'];

$dic_name = "";

include ("connection.php");


$data = [
  'lang_number' => $lang_number,
  'user_sub' => $user_sub,
  'vernacular' => $display, 'phonemic' => $display, 'phonetic' => $display, 'pronunciation' => $display, 'example' => $display, 'example_audio' => $display, 'example_phonetic' => $display, 'comments' => $display, 'lang_code_display' => $display, 'image_caption' => $display, 'video_caption' => $display
];
$sql = "UPDATE languages_users SET vernacular = :vernacular, phonemic = :phonemic, phonetic = :phonetic, pronunciation = :pronunciation, example = :example, example_audio = :example_audio, example_phonetic = :example_phonetic, comments = :comments, lang_code_display = :lang_code_display, image_caption = :image_caption, video_caption = :video_caption WHERE (user_sub=:user_sub) AND (source_lang = :lang_number)";
$stmt= $link->prepare($sql);
$stmt->execute($data);






}


function check_unckeck_all_tls_users($user_sub, $lang_number, $display){






  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

//$dic_name = $_SESSION['dic_name'];

$dic_name = "";

include ("connection.php");


$data = [
  'lang_number' => $lang_number,
  'user_sub' => $user_sub,
  'class' => $display, 'gloss' => $display, 'def' => $display, 'example_translation' => $display, 'semantic' => $display, 'comments' => $display, 'lang_code_display' => $display, 'image_caption' => $display, 'video_caption' => $display
];
$sql = "UPDATE languages_users SET class = :class, gloss = :gloss, def = :def, example_translation = :example_translation, semantic = :semantic, comments = :comments, lang_code_display = :lang_code_display, image_caption = :image_caption, video_caption = :video_caption WHERE (user_sub=:user_sub) AND (target_lang = :lang_number)";
$stmt= $link->prepare($sql);
$stmt->execute($data);



}





if(isset($_POST['update_config_session'])){


  if(isset($_POST['langtype'])){

    $display = $_POST['langtype'];
    $field = 'lang_type';
    $_SESSION['config_search_'.$dic_name][0]['lang_type'] = $display;


    if(isset($_SESSION['user_sub'])){
      $user_sub = $_SESSION['user_sub'];
      update_user_config($user_sub, $field, $display);
    }






  }


  
  if(isset($_POST['searchtype'])){

    $display = $_POST['searchtype'];
    $field = 'search_type';
    $_SESSION['config_search_'.$dic_name][0]['search_type'] = $display;


    if(isset($_SESSION['user_sub'])){
      $user_sub = $_SESSION['user_sub'];
      update_user_config($user_sub, $field, $display);
    }






  }



  if(isset($_POST['mode'])){

    $display = $_POST['mode'];
    $field = 'mode';
    $_SESSION['config_search_'.$dic_name][0]['mode'] = $display;


    if(isset($_SESSION['user_sub'])){
      $user_sub = $_SESSION['user_sub'];
      update_user_config($user_sub, $field, $display);
    }






  }

  
  if(isset($_POST['btn_id'])){

    $display = $_POST['btn_id'];
    $field = 'btn_id';
    $_SESSION['config_search_'.$dic_name][0]['btn_id'] = $display;


    if(isset($_SESSION['user_sub'])){
      $user_sub = $_SESSION['user_sub'];
      update_user_config($user_sub, $field, $display);
    }






  }




}elseif(isset($_POST['update_entry'])){

      $entry_bundle_id = $_POST['entry_bundle_id'];
      $_SESSION['config_search_'.$dic_name][0]['entry_bundle_id'] = $entry_bundle_id;

      if(isset($_SESSION['user_sub'])){
        $user_sub = $_SESSION['user_sub'];
        update_user_entry_id ($user_sub, $entry_bundle_id);
      }







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



        if(isset($_SESSION['user_sub'])){
          $user_sub = $_SESSION['user_sub'];
  
          check_unckeck_all_sls_users($user_sub, $lang_number, $display);
  
        }
  





      }else{

        $_SESSION['config_sls_'.$dic_name][$lang_number-1][$field] = $display;
        

      if(isset($_SESSION['user_sub'])){
        $user_sub = $_SESSION['user_sub'];
        $lang_direction = 'source_lang';

        update_languages_users_config($user_sub, $lang_direction, $lang_number, $field, $display);

      }







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

        if(isset($_SESSION['user_sub'])){
          $user_sub = $_SESSION['user_sub'];
  
          check_unckeck_all_tls_users($user_sub, $lang_number, $display);
  
        }
  


      }else{

        $_SESSION['config_tls_'.$dic_name][$lang_number-1][$field] = $display;




      if(isset($_SESSION['user_sub'])){
        $user_sub = $_SESSION['user_sub'];
        $lang_direction = 'target_lang';

        update_languages_users_config($user_sub, $lang_direction, $lang_number, $field, $display);

      }




      }




    }elseif($_POST['direction'] == "no_lang"){


      
      if(isset($_SESSION['user_sub'])){
        $user_sub = $_SESSION['user_sub'];
        update_user_config($user_sub, $field, $display);
      }


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

}else{

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
                //$entry_bundle_id = 2;
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

                   
    $config_sls = array();
    $_SESSION['config_sls_'.$dic_name] = array();

    try {
      $result = $link->query("SELECT * FROM languages WHERE source_lang > 0");
        
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
  
      $_SESSION['config_tls_'.$dic_name] = array(); 
      $config_tls = array();
      $index = 1;

      try {
      $result = $link->query("SELECT * FROM languages WHERE target_lang > 0");
        
            if($result->rowCount()>0){

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









?>
