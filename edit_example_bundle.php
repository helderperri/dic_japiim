<?php
include ("functions.php");
    $dic_name = "";
    include ("connection.php");


if(isset($_POST['translation_id'])){

  $translation_id = $_POST['translation_id'];
  
    }else{

} 

if(isset($_POST['translation'])){

  $translation = $_POST['translation'];
  
    }else{

} 

if(isset($_POST['entry_ref'])){

  $entry_ref = $_POST['entry_ref'];
  
    }else{

} 

if(isset($_POST['source_lang'])){

  $source_lang = $_POST['source_lang'];
  
    }else{

} 

if(isset($_POST['target_lang'])){

  $target_lang = $_POST['target_lang'];
  
    }else{

} 

if(isset($_POST['lang_code'])){

    $lang_code = $_POST['lang_code'];
    
      }else{
  
} 
  
  
if(isset($_POST['example_bundle'])){

    $example_bundle_id = $_POST['example_bundle'];
    
}else{
  
}
if(isset($_POST['example_phonetic'])){

  $example_phonetic = $_POST['example_phonetic'];
  
}else{

}

if(isset($_POST['count_sense_bundle'])){

    $count_sense_bundle = $_POST['count_sense_bundle'];
    
}else{
  
}

  if(isset($_POST['example_id'])){

    $example_id = $_POST['example_id'];
    
      }else{
  
  }
  
  if(isset($_POST['example_pron_id'])){

    $example_pron_id = $_POST['example_pron_id'];
    
      }else{
  
  }

  if(isset($_POST['example'])){

    $example = $_POST['example'];
    
      }else{
  
  }

  if(isset($_POST['example_order'])){

    $example_order = $_POST['example_order'];
    
      }else{
  
  }

  if(isset($_POST['translation_order'])){

    $translation_order = $_POST['translation_order'];
    
      }else{
  
  }

  if(isset($_POST['items'])){

    $items = $_POST['items'];
    
      }else{
  
  }

  if(isset($_POST['sense_bundle'])){

    $sense_bundle_id = $_POST['sense_bundle'];
    
      }else{
  
  }

if(isset($_POST['add_example_bundle'])){
  $bundle_order = $items+1;
  try {
    //session_start();
    $sql = "INSERT INTO example_bundles (sense_bundle_id, entry_ref, bundle_order) 
    VALUES (:sense_bundle_id, 'entry_ref', :bundle_order)";
    $stmnt = $link->prepare($sql);

    $entry_data = [':sense_bundle_id'=>$sense_bundle_id,':bundle_order'=>$bundle_order];
    $stmnt->execute($entry_data);
 


  } catch(PDOException $e){
      echo "Erro: ".$e->getMessage();
  }


  example_bundle_output_edit($sense_bundle_id, $count_sense_bundle);


  ?>
    
  

  <?php

}

if(isset($_POST['del_example_bundle'])){

  bck_all_example_vernacular ($example_bundle_id);
  bck_all_example_translation ($example_bundle_id);
  bck_example_bundle ($example_bundle_id);
  //bck_all_vernaculares ($example_bundle_id);
  //bck_all_scns ($example_bundle_id);
  //bck_all_example_bundles ($example_bundle_id);
  del_example_vernacular ($example_bundle_id);
  del_example_translation ($example_bundle_id);
  del_example_bundle ($example_bundle_id);
  //del_all_vernaculares ($example_bundle_id);
  //del_all_scns ($example_bundle_id);
  //del_all_example_bundles ($example_bundle_id);
  //del_example_bundle ($example_bundle_id);
  //example_bundle_output($sense_bundle_id);
  example_bundle_output_edit($sense_bundle_id, $count_sense_bundle);

  ?>

  <?php

}//if(isset($_POST['del_example']))

if(isset($_POST['del_example_vernacular'])){
      $dic_name = "";
    include ("connection.php");
  bck_single_example_vernacular($example_id);
  

  try {
    //session_start();
    $sql = "DELETE FROM examples WHERE example_id = :example_id";
    $stmnt = $link->prepare($sql);

    $entry_data = [':example_id'=>$example_id];
    $stmnt->execute($entry_data);
 


  } catch(PDOException $e){
      echo "Erro:xxxxzzzz ".$e->getMessage();
  }
  $new=1;
  example_vernacular_edit($example_bundle_id, $entry_ref, $lang_code, $source_lang, $new);

  ?>

  <?php

  

}



if(isset($_POST['del_example_translation'])){
      $dic_name = "";
    include ("connection.php");
  $target_lang = "";
  try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM translations WHERE lang_code = '$lang_code' AND example_bundle_id = '$example_bundle_id'");

    if($result->rowCount()>0){
      
      foreach ($result as $row){
        $example_bundle_id=$row["example_bundle_id"];
        $entry_ref=$row["entry_ref"];
        $translation_id=$row["translation_id"];
        $translation_order=$row["translation_order"];
        $target_lang=$row["target_lang"];
        $lang_code=$row["lang_code"];
        $translation_style=$row["translation_style"];
        $translation=$row["translation"];
        $translation_author=$row["translation_author"];
        $example_ref=$row["example_ref"];
      
      
        if (strlen($translation)==0){

        }else{        
              try{
                  $sql = "INSERT INTO translations_bck (example_bundle_id, entry_ref, translation_id, translation_order, target_lang, lang_code, translation_style, translation, example_ref, translation_author) 
                  VALUES (:example_bundle_id, :entry_ref, :translation_id, :translation_order, :target_lang, :lang_code, :translation_style, :translation, :example_ref, :translation_author)";
                  $stmnt = $link->prepare($sql);
              
                  $entry_data = [':example_bundle_id'=>$example_bundle_id, ':entry_ref'=>$entry_ref, ':translation_id'=>$translation_id, ':translation_order'=>$translation_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':translation_style'=>$translation_style, ':translation'=>$translation, ':example_ref'=>$example_ref, ':translation_author'=>$translation_author];
                  $stmnt->execute($entry_data);
              

              } catch(PDOException $e){
                  echo "Erro:8797 ".$e->getMessage();
              }//try
  
  
          }//if


        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if



  
  } catch(PDOException $e){
    echo "Erro: oi3".$e->getMessage();
  }




  try {
    //session_start();
    $sql = "DELETE FROM translations WHERE example_bundle_id = :example_bundle_id AND lang_code = :lang_code";
    $stmnt = $link->prepare($sql);

    $entry_data = [':example_bundle_id'=>$example_bundle_id, ':lang_code'=>$lang_code];
    $stmnt->execute($entry_data);
 


  } catch(PDOException $e){
      echo "Erro:xxxxzzzz ".$e->getMessage();
  }
  $new=1;
  example_translation_edit($example_bundle_id, $lang_code, $target_lang, $new);

  ?>


  <?php

  
}


if(isset($_POST['create_example_vernacular'])){

  try {
    //session_start();
    $sql = "INSERT INTO examples (example_bundle_id, entry_ref, example_order, vernacular, source_lang, lang_code) 
    VALUES (:example_bundle_id, :entry_ref, :example_order, '', :source_lang, :lang_code)";
    $stmnt = $link->prepare($sql);

    $entry_data = [':example_bundle_id'=>$example_bundle_id, ':entry_ref'=>$entry_ref, ':example_order'=>$example_order, ':source_lang'=>$source_lang, ':lang_code'=>$lang_code];
    $stmnt->execute($entry_data);
 


  } catch(PDOException $e){
      echo "Erro:xxxx ".$e->getMessage();
  }
  $new=1;
  example_vernacular_edit($example_bundle_id, $entry_ref, $lang_code, $source_lang, $new);

  ?>


  <?php

}//if(isset($_POST['del_example']))




if(isset($_POST['create_example_translation'])){

  try {
    //session_start();
    $sql = "INSERT INTO translations (example_bundle_id, entry_ref, translation_order, translation, target_lang, lang_code) 
    VALUES (:example_bundle_id, 'entry_ref', :translation_order, '', :target_lang, :lang_code)";
    $stmnt = $link->prepare($sql);

    $entry_data = [':example_bundle_id'=>$example_bundle_id, ':translation_order'=>$translation_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code];
    $stmnt->execute($entry_data);
 


  } catch(PDOException $e){
      echo "Erro:dsad ".$e->getMessage();
  }
  $new = 1;
  example_translation_edit($example_bundle_id, $lang_code, $target_lang, $new);

  ?>

  <?php



}//if(isset($_POST['create_example_translation']))


if(isset($_POST['bck_translation'])){

  try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM translations WHERE translation_id = '$translation_id'");

    if($result->rowCount()>0){
      
      foreach ($result as $row){
        $example_bundle_id=$row["example_bundle_id"];
        $entry_ref=$row["entry_ref"];
        $translation_id=$row["translation_id"];
        $translation_order=$row["translation_order"];
        $target_lang=$row["target_lang"];
        $lang_code=$row["lang_code"];
        $translation_style=$row["translation_style"];
        $translation=$row["translation"];
        $translation_author=$row["translation_author"];
        $example_ref=$row["example_ref"];
      
      
        if (strlen($translation)==0){

        }else{

              try{
                  $sql = "INSERT INTO translations_bck (example_bundle_id, entry_ref, translation_id, translation_order, target_lang, lang_code, translation_style, translation, example_ref, translation_author) 
                  VALUES (:example_bundle_id, :entry_ref, :translation_id, :translation_order, :target_lang, :lang_code, :translation_style, :translation, :example_ref, :translation_author)";
                  $stmnt = $link->prepare($sql);
              
                  $entry_data = [':example_bundle_id'=>$example_bundle_id, ':entry_ref'=>$entry_ref, ':translation_id'=>$translation_id, ':translation_order'=>$translation_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':translation_style'=>$translation_style, ':translation'=>$translation, ':example_ref'=>$example_ref, ':translation_author'=>$translation_author];
                  $stmnt->execute($entry_data);
              

              } catch(PDOException $e){
                  echo "Erro:8797 ".$e->getMessage();
              }//try

          }//if


        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if



  
  } catch(PDOException $e){
    echo "Erro: oi3".$e->getMessage();
  }
}//if(isset($_POST['bck_translation']))




    
if(isset($_POST['update_translation'])){

  if (strlen($translation)==0){

  }else{

  try {
    //session_start();
    $sql = "UPDATE translations SET translation = :translation WHERE translation_id=:translation_id";
    $stmnt = $link->prepare($sql);

    $entry_data = [':translation'=>$translation,':translation_id'=>$translation_id];
    $stmnt->execute($entry_data);
 



} catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
}

}
}//if(isset($_POST['update_translation']))

if(isset($_POST['bck_example'])){

  bck_single_example_vernacular($example_id);
  }//if(isset($_POST['bck_example']))
  
  
  
  
    
  if(isset($_POST['update_example'])){
  
    if (strlen($example)==0){

    }else{
  
  try {
    //session_start();
    $sql = "UPDATE examples SET vernacular = :vernacular WHERE example_id=:example_id";
    $stmnt = $link->prepare($sql);
  
    $entry_data = [':vernacular'=>$example,':example_id'=>$example_id];
    $stmnt->execute($entry_data);
  
  
  
  
  } catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
  }
    }  
  }//if(isset($_POST['update_example']))


  if(isset($_POST['add_example_pron'])){

    $example_pron_order=$items+1;;
    $wav="";
    $mp3="";
    $mp4="";
    $wma="";
    $speaker="";
    $vernacular_ref="";
    $phonetic="";

        try{
            $sql = "INSERT INTO example_prons (example_id, entry_ref, example_pron_order, source_lang, lang_code, vernacular_ref, phonetic, wav, mp3, mp4, wma, speaker) 
            VALUES (:example_id, :entry_ref, :example_pron_order, :source_lang, :lang_code,  :vernacular_ref, :phonetic, :wav, :mp3, :mp4, :wma, :speaker)";
            $stmnt = $link->prepare($sql);
        
            $entry_data = [':example_id'=>$example_id, ':entry_ref'=>$entry_ref, ':example_pron_order'=>$example_pron_order, ':source_lang'=>$source_lang, ':lang_code'=>$lang_code, ':vernacular_ref'=>$vernacular_ref, ':phonetic'=>$phonetic, ':wav'=>$wav, ':mp3'=>$mp3, ':mp4'=>$mp4, ':wma'=>$wma, ':speaker'=>$speaker];
            $stmnt->execute($entry_data);
        

        } catch(PDOException $e){
            echo "Erro: oi1".$e->getMessage();
        }//try

        example_prons_edit($example_id, $entry_ref, $lang_code, $source_lang);

  }
  

  
  if(isset($_POST['bck_example_pron'])){
        $dic_name = "";
    include ("connection.php");
    
    bck_example_pron($example_pron_id);
  }
  
  
  
if(isset($_POST['del_example_pron'])){
      $dic_name = "";
    include ("connection.php");


  try {
    //session_start();
    $sql = "DELETE FROM example_prons WHERE example_pron_id = :example_pron_id";
    $stmnt = $link->prepare($sql);

    $entry_data = [':example_pron_id'=>$example_pron_id];
    $stmnt->execute($entry_data);
 


  } catch(PDOException $e){
      echo "Erro:xxxxzzzz ".$e->getMessage();
  }
  $new=1;
  example_prons_edit($example_id, $entry_ref, $lang_code, $source_lang);

  ?>

  <?php

  

}

if (isset($_FILES['file'])){
  $file         = $_FILES['file'];
  $fileName     = $_FILES['file']['name'];
  $fileTmpName  = $_FILES['file']['tmp_name'];
  $fileSize     = $_FILES['file']['size'];
  $fileError    = $_FILES['file']['error'];
  $fileType     = $_FILES['file']['type'];
  //$extension = end(explode(".", $_FILES["file"]["name"]));

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));
  $allowed = array('wav', 'mp3', 'mp4', 'wma');
  $formErrors = array();

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 1000000) {

        $fileNameNew = uniqid('', true).".".$fileActualExt;
        $fileDestination = 'assets/audio/' .$fileName;
        move_uploaded_file($fileTmpName, $fileDestination);
      } else {
        $formErrors[] = "file size must be under 2mb";
      }
    } else {
      $formErrors[] = 'error';
    }
  } else {
    $formErrors[] = 'file not uploaded..!';
  }

  
  if (empty($formErrors)) {
    try{
      $data = [
        'wav' => $fileName,
        'example_pron_id' => $example_pron_id,
      ];

    $sql = "UPDATE example_prons SET wav=:wav WHERE example_pron_id=:example_pron_id";
    $stmt= $link->prepare($sql);
    $stmt->execute($data);
    
      }catch(PDOException $e){
        echo "Erro: oi1".$e->getMessage();
      }//try

    }else{
      echo implode($formErrors);
    }//if

    example_prons_edit($example_id, $entry_ref, $lang_code, $source_lang);

}

if(isset($_POST['create_example_phonetic'])){
      $dic_name = "";
    include ("connection.php");


  try{
    $data = [
      'phonetic' => "[  ]",
      'example_pron_id' => $example_pron_id,
    ];

  $sql = "UPDATE example_prons SET phonetic=:phonetic WHERE example_pron_id=:example_pron_id";
  $stmt= $link->prepare($sql);
  $stmt->execute($data);
  
    }catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
    }//try


  example_prons_edit($example_id, $entry_ref, $lang_code, $source_lang);
?>

  <?php

  

}




if(isset($_POST['update_example_phonetic'])){
      $dic_name = "";
    include ("connection.php");

  if($_POST['bck_example_phonetic']==1){

    bck_example_pron($example_pron_id);

  }else{


  }

  try{
    $data = [
      'phonetic' => "$example_phonetic",
      'example_pron_id' => $example_pron_id,
    ];

  $sql = "UPDATE example_prons SET phonetic=:phonetic WHERE example_pron_id=:example_pron_id";
  $stmt= $link->prepare($sql);
  $stmt->execute($data);
  
    }catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
    }//try


  //example_prons($example_id, $entry_ref, $lang_code, $source_lang);
?>

  <?php

  

}


if(isset($_POST['delete_example_phonetic'])){
      $dic_name = "";
    include ("connection.php");


  try{
    $data = [
      'phonetic' => "",
      'example_pron_id' => $example_pron_id,
    ];

  $sql = "UPDATE example_prons SET phonetic=:phonetic WHERE example_pron_id=:example_pron_id";
  $stmt= $link->prepare($sql);
  $stmt->execute($data);
  
    }catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
    }//try


  example_prons_edit($example_id, $entry_ref, $lang_code, $source_lang);
?>

  <?php

  

}
