<?php
include ("functions.php");
    $dic_name = "";
    include ("connection.php");


if(isset($_POST['image_id'])){

  $image_id = $_POST['image_id'];
  
    }else{

} 


if(isset($_POST['image_caption_id'])){

  $image_caption_id = $_POST['image_caption_id'];
  
    }else{

} 
  

if(isset($_POST['image_caption'])){

  $image_caption = $_POST['image_caption'];
  
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
  $allowed = array('jpg', 'png', 'tif');
  $formErrors = array();

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 1000000) {

        $fileNameNew = uniqid('', true).".".$fileActualExt;
        $fileDestination = 'assets/image/' .$fileName;
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
      

    $image_order=$items+1;;
    $jpg = $fileName;
    $png="";
    $tif="";
    $image_author="";

        try{
            $sql = "INSERT INTO images (sense_bundle_id, entry_ref, image_order, jpg, png, tif, image_author) 
            VALUES (:sense_bundle_id, :entry_ref, :image_order, :jpg, :png, :tif, :image_author)";
            $stmnt = $link->prepare($sql);
        
            $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':image_order'=>$image_order, ':jpg'=>$jpg, ':png'=>$png, ':tif'=>$tif, ':image_author'=>$image_author];
            $stmnt->execute($entry_data);
        

        } catch(PDOException $e){
            echo "Erro: oi1".$e->getMessage();
        }//try

    }else{

      echo implode($formErrors);
    }//if


    images_edit ($sense_bundle_id, $entry_ref);

    
}


if(isset($_POST['del_image'])){

    try {
      //session_start();
      //session_start();
      $result = $link->query("SELECT * FROM images WHERE image_id = '$image_id'");

      if($result->rowCount()>0){
        
        foreach ($result as $row){
            $sense_bundle_id=$row["sense_bundle_id"];
            $entry_ref=$row["entry_ref"];
            $image_order=$row["image_order"];
            $jpg=$row["jpg"];
            $png=$row["png"];
            $tif=$row["tif"];
            $image_author=$row["image_author"];

           
  
                try{
                    $sql = "INSERT INTO images_bck (sense_bundle_id, entry_ref, image_id, image_order, jpg, png, tif, image_author) 
                    VALUES (:sense_bundle_id, :entry_ref, :image_id, :image_order, :jpg, :png, :tif, :image_author)";
                    $stmnt = $link->prepare($sql);
                
                    $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':image_id'=>$image_id, ':image_order'=>$image_order, ':jpg'=>$jpg, ':png'=>$png, ':tif'=>$tif, ':image_author'=>$image_author];
                    $stmnt->execute($entry_data);
                

                } catch(PDOException $e){
                    echo "Erro: ".$e->getMessage();
                }//try
  


          } // foreach      
  
        }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if


            try{
                $sql2 = "DELETE FROM images WHERE image_id = :image_id";
                $stmnt2 = $link->prepare($sql2);
            
                $entry_data2 = [':image_id'=>$image_id];
                $stmnt2->execute($entry_data2);
            

            
                
                } catch(PDOException $e){
                    echo "Erro: ".$e->getMessage();
                }

    
    
    } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
    }
    




    images_edit ($sense_bundle_id, $entry_ref);


}//if(isset($_POST['del_gloss']))



if(isset($_POST['create_image_caption'])){
        $dic_name = "";
    include ("connection.php");
  
  
    
      try {
        //session_start();
        $sql = "INSERT INTO image_captions (image_id, entry_ref, lang_code, image_caption, caption_author) 
        VALUES (:image_id, :entry_ref, :lang_code, :image_caption, :caption_author)";
        $stmnt = $link->prepare($sql);
    
        $entry_data = [
            'image_caption' => "",
            'image_id' => $image_id,
            'lang_code' => "$lang_code",
            'entry_ref' => "$entry_ref",
            'caption_author' => "",
            
          ];
        $stmnt->execute($entry_data);
     
    
        image_captions_edit ($image_id, $entry_ref);
        
      } catch(PDOException $e){
          echo "Erro:xxxx ".$e->getMessage();
      }
    ?>
  
    <?php
  
    
  
  }
  
  if(isset($_POST['del_image_caption'])){
        $dic_name = "";
    include ("connection.php");
  
  
    try {
      //session_start();
      $sql = "DELETE FROM image_captions WHERE image_caption_id = :image_caption_id";
      $stmnt = $link->prepare($sql);
  
      $entry_data = [':image_caption_id'=>$image_caption_id];
      $stmnt->execute($entry_data);
   
  
  
    } catch(PDOException $e){
        echo "Erro:xxxxzzzz ".$e->getMessage();
    }
    image_captions_edit ($image_id, $entry_ref);
  
    ?>
  
    <?php
  
    
  
  }
  

  
  
    
  if(isset($_POST['update_image_caption'])){
  
    if (strlen($image_caption)==0){
  
    }else{
  
  try {
    //session_start();
    $sql = "UPDATE image_captions SET image_caption = :image_caption WHERE image_caption_id=:image_caption_id";
    $stmnt = $link->prepare($sql);
  
    $entry_data = [':image_caption'=>$image_caption,':image_caption_id'=>$image_caption_id];
    $stmnt->execute($entry_data);
  
  
  
  
  } catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
  }
    }  
  }//if(isset($_POST['update_image_caption']))

  