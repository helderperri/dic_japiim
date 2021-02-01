<?php


$dic_name = "";

include ("connection.php");
//include ("config_functions.php");


$entry_bundle_id = "";
$vernacular = "";
$phonemic = "";
$def = array();
$class = array();
$ex_vernacular = array();
$ex_translation = array();

if(isset($_GET["entry"])){

  $entry_bundle_id = $_GET["entry"];
}


if(isset($_POST["entry_bundle_id"])){
  $entry_bundle_id = $_POST["entry_bundle_id"];
}

try {

  $result = $link->query("SELECT * FROM entries WHERE entry_bundle_id  = '$entry_bundle_id' ORDER BY entry_bundle_id");

  if($result->rowCount()>0){
    foreach ($result as $key => $row){
      $entry_id=$row["entry_id"]; 





          try {

          $result1 = $link->query("SELECT * FROM form_bundles WHERE entry_id  = '$entry_id'");

          if($result1->rowCount()>0){
            
            foreach ($result1 as $key => $row){    

              $form_bundle_id=$row["form_bundle_id"];
              $entry_ref2= $row["entry_ref"];
          
                //$source_lang = $source_lang_info['source_lang'];
                //$lang_code = $source_lang_info['lang_code'];
                try {

                  $result2 = $link->query("SELECT * FROM forms WHERE form_bundle_id  = '$form_bundle_id' ORDER BY form_id");
                  
                  if($result2->rowCount()>0){
                  
                    foreach ($result2 as $key => $row){    
                          $form_id=$row["form_id"];
                          $vernacular= $row["vernacular"];
                          try {
            
                            $result3 = $link->query("SELECT * FROM phonemic WHERE form_id = '$form_id' ORDER BY phonemic_id");
                        
                      
                            if($result3->rowCount()>0){
                            
                              foreach ($result3 as $key => $row){    
                                  $phonemic_id=$row["phonemic_id"];
                                  $phonemic=$row["phonemic"];




                                if(empty($phonemic)){


                                    try {
            
                                        $result4 = $link->query("SELECT * FROM phonetic WHERE phonemic_id = '$phonemic_id' ORDER BY phonetic_id");
                                    
                                  
                                        if($result4->rowCount()>0){
                                        
                                          foreach ($result4 as $key => $row){    
                                              $phonetic_id=$row["phonetic_id"];
                                              $phonemic=$row["phonetic"];
            



                                            } // foreach   
                                        }else{
                                            //echo "A busca não retornou nenhum resultado.";
                                        } // if
                                      } catch(PDOException $e){
                                        echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                                      } // try  
            


                                }














                                  
                                

                              } // foreach   
                            }else{
                                //echo "A busca não retornou nenhum resultado.";
                            } // if
                          } catch(PDOException $e){
                            echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                          } // try  


                    } // foreach   
                  }else{
                      //echo "A busca não retornou nenhum resultado.";
                  } // if
                  } catch(PDOException $e){
                  echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                  } // try    
              
            } // foreach   
          }else{
              //echo "A busca não retornou nenhum resultado.";
          } // if
          } catch(PDOException $e){
          echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
          } // try
          //END //form bundles //END
















          $dic_name = "";
          include ("connection.php");
          //START //sense bundles //START
          try {
        
            $result = $link->query("SELECT * FROM sense_bundles WHERE entry_id  = '$entry_id'");
        
            if($result->rowCount()>0){
              
              foreach ($result as $key => $row){    
                $sense_bundle_id=$row["sense_bundle_id"];
        
              
                  $target_lang = 1;
                  $lang_code = "por";

                  



                  try {
  
                    $result = $link->query("SELECT * FROM senses WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY sense_id");
                    
                    if($result->rowCount()>0){
              
                            $index = 0;
                              foreach ($result as $key => $row){    
                                $sense_id=$row["sense_id"];
                                $def[$index]= $row["def"];
                                
                  

                                






                                $index = $index + 1;


                            } // foreach
                     
                            }else{
                          //echo "A busca não retornou nenhum resultado.";
                          } // if
                  
                      
                  } catch(PDOException $e){
                    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                  } // try





                  try {
  
                    $result2 = $link->query("SELECT * FROM classes WHERE sense_bundle_id  = '$sense_bundle_id'");
                    
                    if($result2->rowCount()>0){
              
                            $index = 0;
                              foreach ($result2 as $key => $row){    
                                //$class_id=$row["class_id"];
                                $class[$index]= "(".$row['class_name_ref'].")";
                                
                  
              




                                $index = $index + 1;


                            } // foreach
                     
                            }else{
                          //echo "A busca não retornou nenhum resultado.";
                          } // if
                  
                      
                  } catch(PDOException $e){
                    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                  } // try






                  try {
  
                    $result = $link->query("SELECT * FROM example_bundles WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY example_bundle_id");
                
                    if($result->rowCount()>0){
                      foreach ($result as $key => $row){
                        $example_bundle_id=$row["example_bundle_id"];
                        $index = 0;
                      
                 
                        try {
  
                            $result = $link->query("SELECT * FROM examples WHERE example_bundle_id  = '$example_bundle_id' ORDER BY example_id");
                        
                            if($result->rowCount()>0){
                              foreach ($result as $key => $row){
                                $example_id=$row["example_id"];                    
                                $ex_vernacular[$index]=$row["vernacular"];
                      
                                $index = $index + 1;

                              } // foreach     
                            }else{
                                //echo "A busca não retornou nenhum resultado.";
                            } // if
                          } catch(PDOException $e){
                            echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                          } // try


                          $index2 = 0;
                          try {
  
                            $result = $link->query("SELECT * FROM translations WHERE example_bundle_id  = '$example_bundle_id' ORDER BY translation_id");
                        
                            if($result->rowCount()>0){
                              foreach ($result as $key => $row){
                                $translation_id=$row["translation_id"];                    
                                $ex_translation[$index2]=$row["translation"];
                      
                                $index2 = $index2 + 1;

                              } // foreach     
                            }else{
                                //echo "A busca não retornou nenhum resultado.";
                            } // if
                          } catch(PDOException $e){
                            echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                          } // try



              
                            //example_translation($example_bundle_id, $lang_code, $target_lang);
              
              
                        } // foreach
                  
                      
                      }else{
                          //echo "A busca não retornou nenhum resultado.";
                      } // if
                    } catch(PDOException $e){
                      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                    } // try      








                
              } // foreach   
            }else{
                //echo "A busca não retornou nenhum resultado.";
            } // if
          } catch(PDOException $e){
            echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
          } // try
          //END // sense bundles //END




















   } // foreach
 }else{
     //echo "A busca não retornou nenhum resultado.";
 } // if
} catch(PDOException $e){
 echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
}

















        $downloadFileName = "dic_".$dic_name."_".$def[0]."_".$entry_bundle_id.".png";
        header('Content-Description: File Transfer');
        header('Content-Type: image/png');
        header('Content-Disposition: attachment; filename='.$downloadFileName);
              $string = "Entrada".$entry_bundle_id."sub_entrada".$entry_bundle_id."";
        $im     = imagecreatefrompng("icons/prodoclin_card_white.png");
        $blue = imagecolorallocate($im, 0, 0, 255);
        $grey = imagecolorallocate($im, 64, 64, 64);
        $black = imagecolorallocate($im, 0, 0, 0);
        $px     = (imagesx($im) - 7.5 * strlen($string)) / 2;



        //$class0 = $class[0];
        


        
        // The text to draw
        $text = "Novo_Entrada".$entry_bundle_id."sub_entrada".$entry_bundle_id."";
        // Replace path by your own font path
        $font1 = 'fonts/calibriz.ttf';
        $font2 = 'fonts/calibrii.ttf';
        $font3 = 'fonts/calibrib.ttf';
        $font4 = 'fonts/calibri.ttf';




        list($left1,, $right1) = imageftbbox(30, 0, $font1, $vernacular);

        $width_vern = $right1 - $left1;
        //$phon_x = 120+strlen($vernacular)*25;
        $phon_x = 120+10+$width_vern;


        list($left2,, $right2) = imageftbbox(15, 0, $font4, $class[0]);

        $width_class = $right2 - $left2;
        //$def_x = 120+strlen($class[0])*15;

        $def_x = 150+10+$width_class;
        


        list($left3,, $right3) = imageftbbox(25, 0, $font4, $def[0]);

        $width_def = $right3 - $left3;
        //$def_x = 120+strlen($class[0])*15;

        $ex1_x = ($def_x)+$width_def+10;
        

        


        // Add the vernacular
        imagettftext($im, 30, 0, 120, 130, $black, $font1, $vernacular);

        // Add the vernacular
        imagettftext($im, 20, 0, $phon_x, 130, $black, $font2, $phonemic);

        imagettftext($im, 15, 0, 150, 200, $grey, $font4, $class[0]);

        imagettftext($im, 25, 0, $def_x, 200, $black, $font3, $def[0]);

        imagettftext($im, 20, 0, 150, 250, $black, $font1, $ex_vernacular[0]);

        imagettftext($im, 20, 0, 150, 280, $grey, $font2, $ex_translation[0]);

        //imagestring($im, 25, $px, 109, $string, $orange);


        imagepng($im);
 

  ob_clean();
  flush();
  readfile($im);





       imagedestroy($im);
       exit;

        ?>
</head>

</html>



    