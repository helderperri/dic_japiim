<?php
include ("functions.php");
    $dic_name = "";
    include ("connection.php");


if(isset($_POST['image_id'])){

  $image_id = $_POST['image_id'];
  
    }else{

} 


if(isset($_POST['comment_id'])){

  $comment_id = $_POST['comment_id'];
  
    }else{

} 
  

if(isset($_POST['comment'])){

  $comment = $_POST['comment'];
  
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

  
  if(isset($_POST['del_comment'])){
        $dic_name = "";
    include ("connection.php");
  
  
    try {
      //session_start();
      $sql = "DELETE FROM comments WHERE comment_id = :comment_id";
      $stmnt = $link->prepare($sql);
  
      $entry_data = [':comment_id'=>$comment_id];
      $stmnt->execute($entry_data);
   
  
  
    } catch(PDOException $e){
        echo "Erro:xxxxzzzz ".$e->getMessage();
    }
    comments_edit ($sense_bundle_id, $entry_ref);
  
    ?>
  
    <?php
  
    
  
  }
  

  if(isset($_POST['create_comment'])){
        $dic_name = "";
    include ("connection.php");
  
      try {
        //session_start();
        $sql = "INSERT INTO comments (sense_bundle_id, entry_ref, comment_order, lang_code, comment, comment_author) 
        VALUES (:sense_bundle_id, :entry_ref, :comment_order, :lang_code, :comment, :comment_author)";
        $stmnt = $link->prepare($sql);
    
        $entry_data = [
            'comment' => "",
            'sense_bundle_id' => $sense_bundle_id,
            'lang_code' => "$lang_code",
            'entry_ref' => "$entry_ref",
            'comment_order' => 1,
            'comment_author' => "",
            
          ];
        $stmnt->execute($entry_data);
     
    
        comments_edit ($sense_bundle_id, $entry_ref);
        
      } catch(PDOException $e){
          echo "Erro:xxxx ".$e->getMessage();
      }
    ?>
  
    <?php
  
    
  
  }
  
  
  
    
  if(isset($_POST['update_comment'])){
  
    if (strlen($comment)==0){
  
    }else{
  
  try {
    //session_start();
    $sql = "UPDATE comments SET comment = :comment WHERE comment_id=:comment_id";
    $stmnt = $link->prepare($sql);
  
    $entry_data = [':comment'=>$comment,':comment_id'=>$comment_id];
    $stmnt->execute($entry_data);
  
  
  
  
  } catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
  }
    }  
  }//if(isset($_POST['update_comment']))

  