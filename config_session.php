<?php
    $dic_name = "";
    include ("connection.php");

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}else{
  
}
//$dic_name = $_SESSION['dic_name'];



if(isset($_POST['lang_number'])){

  $lang_number = $_POST['lang_number'];

};

if(isset($_POST['field'])){

  $field = $_POST['field'];

};

if(isset($_POST['display'])){

  $display = $_POST['display'];

};
if(isset($_POST['update_session'])){

  if($_POST['direction'] == "source"){


    $_SESSION['config_sls_'.$dic_name][$lang_number-1][$field] = $display;

  }elseif(($_POST['direction'] == "target")){

    $_SESSION['config_tls_'.$dic_name][$lang_number-1][$field] = $display;


  }

}elseif(isset($_POST['login_google'])){

  $_SESSION['login_source'] = $_POST['login_source'];

}else{

  if(isset($_SESSION['config_search_'.$dic_name])){

  }else{

  try {
    $result = $link->query("SELECT * FROM config_search");
      
          if($result->rowCount()>0){
             
            $config_search = array();
            $_SESSION['config_search_'.$dic_name] = array();
            $index = 1;

            foreach ($result as $key => $row){
                
                $searchtype=$row["search_type"];
                $langtype=$row["lang_type"];
                $number_of_sls =$row["number_of_sls"];
                $number_of_tls =$row["number_of_tls"];
                $image = $row["image"];
                $video = $row["video"];
                $scn = $row["scn"];
                $mode = $row["mode"];
                $config_search[$index] = array('index'=>$index, 'searchtype' => $searchtype, 'langtype' => $langtype, 'btn_id'=> 1, 'number_of_sls'=>$number_of_sls, 'number_of_tls'=>$number_of_tls, 'scn'=>$scn, 'image'=>$image, 'video'=>$video, 'mode'=>$mode);
                $_SESSION['config_search_'.$dic_name][] = $config_search[$index]; 
           
            } // foreach   
            
      

            }else{
              //echo "A busca não retornou nenhum resultado.";
          } // if

            
      } catch(PDOException $e){
        echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try


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
      }//if (isset($_SESSION['config_search'])
      }//if(isset($_POST['update_session'])//else
?>