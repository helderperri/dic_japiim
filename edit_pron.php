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

if(isset($_POST['count_sense_bundle'])){

    $count_sense_bundle = $_POST['count_sense_bundle'];
    
}else{
  
}

  if(isset($_POST['example_id'])){

    $example_id = $_POST['example_id'];
    
      }else{
  
  }
  if(isset($_POST['pron_id'])){

    $pron_id = $_POST['pron_id'];
    
      }else{
  
  }
  if(isset($_POST['entry_id'])){

    $entry_id = $_POST['entry_id'];
    
      }else{
  
  }
  if(isset($_POST['entry_ref'])){

    $entry_ref = $_POST['entry_ref'];
    
      }else{
  
  }
  if(isset($_POST['phonemic_id'])){

    $phonemic_id = $_POST['phonemic_id'];
    
      }else{
  
  }
  
  if(isset($_POST['phonetic_id'])){

    $phonetic_id = $_POST['phonetic_id'];
    
      }else{
  
  }

  if(isset($_POST['pron'])){

    $pron = $_POST['pron'];
    
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

  if(isset($_POST['bck_pron'])){

    bck_pron($pron_id);

    


}


if(isset($_POST['update_pron'])){

      try{
        $sql = "UPDATE prons SET pron = :pron WHERE pron_id = :pron_id";
        $stmnt = $link->prepare($sql);
    
        $entry_data = [':pron_id'=>$pron_id, ':pron'=>$pron];
        $stmnt->execute($entry_data);
    

        } catch(PDOException $e){
            echo "Erro: oi1".$e->getMessage();
        }//try

    


}




if(isset($_POST['del_pron'])){

  del_pron ($pron_id);

    prons_edit($entry_id, $phonetic_id, $source_lang, $lang_code, $entry_ref);



}




if(isset($_POST['add_pron'])){

              $pron_order=$items+1;;
              $wav="";
              $mp3="";
              $mp4="";
              $wma="";
              $speaker="";
    
    
                  try{
                      $sql = "INSERT INTO prons (phonetic_id, entry_ref, pron_order, source_lang, lang_code, wav, mp3, mp4, wma, speaker) 
                      VALUES (:phonetic_id, :entry_ref, :pron_order, :source_lang, :lang_code, :wav, :mp3, :mp4, :wma, :speaker)";
                      $stmnt = $link->prepare($sql);
                  
                      $entry_data = [':phonetic_id'=>$phonetic_id, ':entry_ref'=>$entry_ref, ':pron_order'=>$pron_order, ':source_lang'=>$source_lang, ':lang_code'=>$lang_code, ':wav'=>$wav, ':mp3'=>$mp3, ':mp4'=>$mp4, ':wma'=>$wma, ':speaker'=>$speaker];
                      $stmnt->execute($entry_data);
                  
    
                  } catch(PDOException $e){
                      echo "Erro: oi1".$e->getMessage();
                  }//try
    
                  prons_edit($entry_id, $phonetic_id, $source_lang, $lang_code, $entry_ref);
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
        'pron_id' => $pron_id,
      ];

    $sql = "UPDATE prons SET wav=:wav WHERE pron_id=:pron_id";
    $stmt= $link->prepare($sql);
    $stmt->execute($data);
    
      }catch(PDOException $e){
        echo "Erro: oi1".$e->getMessage();
      }//try

    }//if

    prons_edit($entry_id, $phonetic_id, $source_lang, $lang_code, $entry_ref);

}