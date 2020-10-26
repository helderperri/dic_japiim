<?php
include ("functions.php");
    $dic_name = "";
    include ("connection.php");


if(isset($_POST['video_id'])){

  $video_id = $_POST['video_id'];
  
    }else{

} 


if(isset($_POST['video_caption_id'])){

  $video_caption_id = $_POST['video_caption_id'];
  
    }else{

} 
  

if(isset($_POST['video_caption'])){

  $video_caption = $_POST['video_caption'];
  
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

if(isset($_POST['sense_bundle_id'])){

    $sense_bundle_id = $_POST['sense_bundle_id'];
    
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
  $allowed = array('mp4', 'flv', 'ogv');
  $formErrors = array();

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 20000000) {

        $fileNameNew = uniqid('', true).".".$fileActualExt;
        $fileDestination = 'assets/video/' .$fileName;
        move_uploaded_file($fileTmpName, $fileDestination);
      } else {
        $formErrors[] = "file size must be under 20mb";
      }
    } else {
      $formErrors[] = 'error';
    }
  } else {
    $formErrors[] = 'file not uploaded..!';
  }

  
  if (empty($formErrors)) {
      

    $video_order=$items+1;;
    $mp4 = $fileName;
    $flv="";
    $ogv="";
    $video_author="";

        try{
            $sql = "INSERT INTO videos (sense_bundle_id, entry_ref, video_order, mp4, flv, ogv, video_author) 
            VALUES (:sense_bundle_id, :entry_ref, :video_order, :mp4, :flv, :ogv, :video_author)";
            $stmnt = $link->prepare($sql);
        
            $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':video_order'=>$video_order, ':mp4'=>$mp4, ':flv'=>$flv, ':ogv'=>$ogv, ':video_author'=>$video_author];
            $stmnt->execute($entry_data);
        

        } catch(PDOException $e){
            echo "Erro: oi1".$e->getMessage();
        }//try

    }else{

      echo implode($formErrors);
    }//if


    videos_edit ($sense_bundle_id, $entry_ref);

    
}


if(isset($_POST['del_video'])){

    try {
      //session_start();
      //session_start();
      $result = $link->query("SELECT * FROM videos WHERE video_id = '$video_id'");

      if($result->rowCount()>0){
        
        foreach ($result as $row){
            $sense_bundle_id=$row["sense_bundle_id"];
            $entry_ref=$row["entry_ref"];
            $video_order=$row["video_order"];
            $mp4=$row["mp4"];
            $flv=$row["flv"];
            $ogv=$row["ogv"];
            $video_author=$row["video_author"];

           
  
                try{
                    $sql = "INSERT INTO videos_bck (sense_bundle_id, entry_ref, video_id, video_order, mp4, flv, ogv, video_author) 
                    VALUES (:sense_bundle_id, :entry_ref, :video_id, :video_order, :mp4, :flv, :ogv, :video_author)";
                    $stmnt = $link->prepare($sql);
                
                    $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':video_id'=>$video_id, ':video_order'=>$video_order, ':mp4'=>$mp4, ':flv'=>$flv, ':ogv'=>$ogv, ':video_author'=>$video_author];
                    $stmnt->execute($entry_data);
                

                } catch(PDOException $e){
                    echo "Erro: ".$e->getMessage();
                }//try
  


          } // foreach      
  
        }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if


            try{
                $sql2 = "DELETE FROM videos WHERE video_id = :video_id";
                $stmnt2 = $link->prepare($sql2);
            
                $entry_data2 = [':video_id'=>$video_id];
                $stmnt2->execute($entry_data2);
            

            
                
                } catch(PDOException $e){
                    echo "Erro: ".$e->getMessage();
                }

    
    
    } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
    }
    




    videos_edit ($sense_bundle_id, $entry_ref);


}//if(isset($_POST['del_gloss']))



if(isset($_POST['create_video_caption'])){
        $dic_name = "";
    include ("connection.php");
  
  
    
      try {
        //session_start();
        $sql = "INSERT INTO video_captions (video_id, entry_ref, lang_code, video_caption, caption_author) 
        VALUES (:video_id, :entry_ref, :lang_code, :video_caption, :caption_author)";
        $stmnt = $link->prepare($sql);
    
        $entry_data = [
            'video_caption' => "",
            'video_id' => $video_id,
            'lang_code' => "$lang_code",
            'entry_ref' => "$entry_ref",
            'caption_author' => "",
            
          ];
        $stmnt->execute($entry_data);
     
    
        video_captions_edit ($video_id, $entry_ref);
        
      } catch(PDOException $e){
          echo "Erro:xxxx ".$e->getMessage();
      }
    ?>
  
    <?php
  
    
  
  }
  
  if(isset($_POST['del_video_caption'])){
        $dic_name = "";
    include ("connection.php");
  
  
    try {
      //session_start();
      $sql = "DELETE FROM video_captions WHERE video_caption_id = :video_caption_id";
      $stmnt = $link->prepare($sql);
  
      $entry_data = [':video_caption_id'=>$video_caption_id];
      $stmnt->execute($entry_data);
   
  
  
    } catch(PDOException $e){
        echo "Erro:xxxxzzzz ".$e->getMessage();
    }
    video_captions_edit ($video_id, $entry_ref);
  
    ?>
  
    <?php
  
    
  
  }
  

  
  
    
  if(isset($_POST['update_video_caption'])){
  
    if (strlen($video_caption)==0){
  
    }else{
  
  try {
    //session_start();
    $sql = "UPDATE video_captions SET video_caption = :video_caption WHERE video_caption_id=:video_caption_id";
    $stmnt = $link->prepare($sql);
  
    $entry_data = [':video_caption'=>$video_caption,':video_caption_id'=>$video_caption_id];
    $stmnt->execute($entry_data);
  
  
  
  
  } catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
  }
    }  
  }//if(isset($_POST['update_video_caption']))

  