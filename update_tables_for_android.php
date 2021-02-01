<?php
    $dic_name = "";
    include ("connection.php");






    function check_letter($glyph_id, $langtype){
      $dic_name = "";
  include ("connection.php");
  $table_to_search = "";
  $column_to_search = "";
  $btn_display = "";

  if($langtype==1){
      $table_to_search = "forms";
      $column_to_search = "vernacular";

      $glyphs = array();
      $entries_list = array();
      
      try{
          $result = $link->query("SELECT * FROM letters_source WHERE glyph_id = '$glyph_id'");
    
    
          if($result->rowCount()>0){
            //$key=0;
            foreach ($result as $key => $row){
                $glyph_other=$row["glyph_other"];
                $glyphs[] = $glyph_other;
              } //foreach
          
          }else{
            //echo "A busca não retornou nenhum resultado.";
        } // if
    
      } catch(PDOException $e){
        echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
      } // try
    
    



  }elseif($langtype==2){
      $table_to_search = "glosses";
      $column_to_search = "gloss";


      try{
          $result = $link->query("SELECT * FROM letters_target WHERE glyph_id = '$glyph_id'");
    
    
          if($result->rowCount()>0){
            //$key=0;
            foreach ($result as $key => $row){
                $glyph_other=$row["glyph_other"];
                $glyphs[] = $glyph_other;
              } //foreach
          
          }else{
            //echo "A busca não retornou nenhum resultado.";
        } // if
    
      } catch(PDOException $e){
        echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
      } // try
        

  }//if
  $glyphs_in = "'" . implode( "','", $glyphs ) . "'";
      

  try {
      $result = $link->query("SELECT * FROM $table_to_search WHERE LEFT ($column_to_search, 1) IN ($glyphs_in)");
        
          if($result->rowCount()>0){
              $btn_display = "1";
          }
          else{ 
              //$btn_display = "";
              $btn_display = "0";
          } // if                    
        } catch(PDOException $e){
          echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
      } // try
  
  return($btn_display);
}










    try {
        //session_start();
        $sql = "CREATE TABLE IF NOT EXISTS entries_vernacular (entry_bundle_id INT(5) NOT NULL, entry_id INT(5) NOT NULL, form_bundle_id INT(5) NOT NULL, form_id INT(5) NOT NULL, entry_vernacular_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, form_order INT(2) NOT NULL, source_lang INT(1) NOT NULL, lang_code VARCHAR(7), vernacular VARCHAR(100), glyph_id INT(2)) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_bin'";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }






      try {
        //session_start();
        $sql = "CREATE TABLE IF NOT EXISTS entries_vernacular_sds (entry_bundle_id INT(5) NOT NULL, entry_id INT(5) NOT NULL, sense_bundle_id INT(5) NOT NULL, form_bundle_id INT(5) NOT NULL, form_id INT(5) NOT NULL, entry_vernacular_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, form_order INT(2) NOT NULL, source_lang INT(1) NOT NULL, lang_code VARCHAR(7), vernacular VARCHAR(100) NOT NULL, sd_id INT(5), sd_name VARCHAR(50), sd_target_lang INT(1) NOT NULL, sd_lang_code VARCHAR(7)) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_bin'";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }



      

      try {
        //session_start();
        $sql = "CREATE TABLE IF NOT EXISTS entries_sds (entry_sd_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, target_lang INT(1) NOT NULL, lang_code VARCHAR(7), sd_id INT(5), sd_name VARCHAR(50)) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_bin'";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }


      
      try {
        //session_start();
        $sql = "CREATE TABLE IF NOT EXISTS entries_glosses (entry_bundle_id INT(5) NOT NULL, entry_id INT(5) NOT NULL, sense_bundle_id INT(5) NOT NULL, gloss_id INT(5) NOT NULL, entry_gloss_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, gloss_order INT(2) NOT NULL, target_lang INT(1) NOT NULL, lang_code VARCHAR(7) NOT NULL, gloss VARCHAR(100) NOT NULL, class_id INT(5) NOT NULL, class_name VARCHAR(100) NOT NULL, glyph_id INT(2)) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_bin'";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }


            
      try {
        //session_start();
        $sql = "CREATE TABLE IF NOT EXISTS entries_glosses_sds (entry_bundle_id INT(5) NOT NULL, entry_id INT(5) NOT NULL, sense_bundle_id INT(5) NOT NULL, gloss_id INT(5) NOT NULL, entry_gloss_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, gloss_order INT(2) NOT NULL, target_lang INT(1) NOT NULL, lang_code VARCHAR(7) NOT NULL, gloss VARCHAR(100) NOT NULL, class_id INT(5) NOT NULL, class_name VARCHAR(100) NOT NULL, sd_id INT(5), sd_name VARCHAR(50) NOT NULL) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_bin'";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }


      try {
        //session_start();
        $sql = "CREATE TABLE IF NOT EXISTS entries_defs (entry_bundle_id INT(5) NOT NULL, entry_id INT(5) NOT NULL, sense_bundle_id INT(5) NOT NULL, sense_id INT(5) NOT NULL, entry_def_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, sense_order INT(2) NOT NULL, target_lang INT(1) NOT NULL, lang_code VARCHAR(7) NOT NULL, def VARCHAR(100) NOT NULL, class_id INT(5) NOT NULL, class_name VARCHAR(100) NOT NULL) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_bin'";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }
      




      try {
        //session_start();
        $sql = "CREATE TABLE IF NOT EXISTS entries_source_letters (entry_letter_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, glyph_id INT(5) NOT NULL, glyph VARCHAR(7), glyph_order INT(2) NOT NULL, display_btn INT(1) NOT NULL, position_btn INT(5) NOT NULL) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_bin'";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }
      

      try {
        //session_start();
        $sql = "CREATE TABLE IF NOT EXISTS entries_target_letters (entry_letter_id INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, glyph_id INT(5) NOT NULL, glyph VARCHAR(7), glyph_order INT(2) NOT NULL, display_btn INT(1) NOT NULL, position_btn INT(5) NOT NULL) ENGINE=InnoDB CHARACTER SET 'utf8' COLLATE 'utf8_bin'";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }
      



      try {
        //session_start();
        $sql = "TRUNCATE TABLE entries_vernacular";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }
      try {
        //session_start();
        $sql = "TRUNCATE TABLE entries_glosses";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }

 

      try {
        //session_start();
        $sql = "TRUNCATE TABLE entries_vernacular_sds";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }

      try {
        //session_start();
        $sql = "TRUNCATE TABLE entries_sds";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }

      try {
        //session_start();
        $sql = "TRUNCATE TABLE entries_glosses_sds";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }

      try {
        //session_start();
        $sql = "TRUNCATE TABLE entries_defs";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }
      try {
        //session_start();
        $sql = "TRUNCATE TABLE entries_source_letters";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }
      try {
        //session_start();
        $sql = "TRUNCATE TABLE entries_target_letters";
        $stmnt = $link->prepare($sql);
      
        $stmnt->execute();
      
      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }
      



    try{
    
      $sql = "SELECT * FROM forms";
        $result = $link->query($sql);
        //$stmnt->execute();
        //$result = $stmnt->fetch(PDO::FETCH_ASSOC);

        $entry_bundle_id = ""; 
        $entry_id = ""; 
        $form_bundle_id = ""; 
        $form_id = ""; 
        $form_order = ""; 
        $source_lang = ""; 
        $lang_code= ""; 
        $vernacular= ""; 
        $glyph_id = "";
        foreach ($result as $row){
          $form_bundle_id = $row["form_bundle_id"];
          $form_id = $row["form_id"];
          $form_order = $row["form_order"];
          $vernacular = $row["vernacular"];
          $lang_code = $row["lang_code"];
          $source_lang = $row["source_lang"];

          $first_letter = substr($vernacular, 0, 1);


          $sql12 = "SELECT * FROM letters_source WHERE glyph_other = '$first_letter'";
          $result12 = $link->query($sql12);
  
          foreach ($result12 as $row){
            $glyph_id = $row["glyph_id"];
  
          }


          $sql2 = "SELECT entry_id FROM form_bundles WHERE form_bundle_id = '$form_bundle_id'";
          $result2 = $link->query($sql2);
  
          foreach ($result2 as $row){
            $entry_id = $row["entry_id"];
  

            $sql3 = "SELECT entry_bundle_id FROM entries WHERE entry_id = '$entry_id'";
            $result3 = $link->query($sql3);
    
            foreach ($result3 as $row){
              $entry_bundle_id = $row["entry_bundle_id"];




              $sql6 = "INSERT INTO entries_vernacular (entry_bundle_id, entry_id, form_bundle_id, form_id, form_order, source_lang, lang_code, vernacular, glyph_id) 
              VALUES (:entry_bundle_id, :entry_id, :form_bundle_id, :form_id, :form_order, :source_lang, :lang_code, :vernacular, :glyph_id)";
              $data_entry_glosses = [':entry_bundle_id'=>$entry_bundle_id,':entry_id'=>$entry_id,':form_bundle_id'=>$form_bundle_id, ':form_id'=>$form_id,':form_order'=>$form_order, ':source_lang'=>$source_lang, ':lang_code'=>$lang_code, ':vernacular'=>$vernacular, ':glyph_id'=>$glyph_id];
              $stmnt = $link->prepare($sql6);
              $stmnt->execute($data_entry_glosses);
            

              


            }






          } 





        }
    
    } catch(PDOException $e){
      echo "Erro: ".$e->getMessage();
    }


    
    try {

        //$entry_data = [':sense_bundle_id'=>$sense_bundle_id,':sense_order'=>$bundle_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':def'=>''];
        //$stmnt->execute($entry_data);

        //VALUES (:sense_bundle_id, 'entry_ref', :sense_order, :target_lang, :lang_code, 'gloss', 'class', :def)";
        //session_start();
        $sql = "SELECT * FROM senses";
        $result = $link->query($sql);
        //$stmnt->execute();
        //$result = $stmnt->fetch(PDO::FETCH_ASSOC);
        $entry_bundle_id = ""; 
        $entry_id = ""; 
        $form_bundle_id = ""; 
        $form_id = ""; 
        $form_order = ""; 
        $source_lang = ""; 
        $lang_code= ""; 
        $vernacular= ""; 
        $glyph_id = "";
        
        foreach ($result as $row){
          $sense_bundle_id = $row["sense_bundle_id"];
          $sense_id = $row["sense_id"];
          $sense_order = $row["sense_order"];
          $def = $row["def"];
          $lang_code = $row["lang_code"];
          $target_lang = $row["target_lang"];


          $sql4 = "SELECT class_id FROM classes WHERE sense_bundle_id = '$sense_bundle_id'";
          $result4 = $link->query($sql4);
  
          foreach ($result4 as $row){
            $class_id = $row["class_id"];

            $sql5 = "SELECT class_name FROM class_names WHERE (class_id = '$class_id' AND lang_code = '$lang_code')";
            $result5 = $link->query($sql5);
    
            foreach ($result5 as $row){
              $class_name = $row["class_name"];
              //echo $class_name."<br/>";

            }


            


          }





          $sql2 = "SELECT entry_id FROM sense_bundles WHERE sense_bundle_id = '$sense_bundle_id'";
          $result2 = $link->query($sql2);
  
          foreach ($result2 as $row){
            $entry_id = $row["entry_id"];
  

            $sql3 = "SELECT entry_bundle_id FROM entries WHERE entry_id = '$entry_id'";
            $result3 = $link->query($sql3);
    
            foreach ($result3 as $row){
              $entry_bundle_id = $row["entry_bundle_id"];




              $sql6 = "INSERT INTO entries_defs (entry_bundle_id, entry_id, sense_bundle_id, sense_id, sense_order, target_lang, lang_code, def, class_id, class_name) 
              VALUES (:entry_bundle_id, :entry_id, :sense_bundle_id, :sense_id, :sense_order, :target_lang, :lang_code, :def, :class_id, :class_name)";
              $data_entry_glosses = [':entry_bundle_id'=>$entry_bundle_id,':entry_id'=>$entry_id,':sense_bundle_id'=>$sense_bundle_id, ':sense_id'=>$sense_id,':sense_order'=>$sense_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':def'=>$def, ':class_id'=>$class_id, ':class_name' =>$class_name];
              $stmnt = $link->prepare($sql6);
              $stmnt->execute($data_entry_glosses);
            

              


            }






          }  




        }
    
    
    } catch(PDOException $e){
      echo "Erro: ".$e->getMessage();
    }
      
    

    
    try {

      //$entry_data = [':sense_bundle_id'=>$sense_bundle_id,':sense_order'=>$bundle_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':def'=>''];
      //$stmnt->execute($entry_data);

      //VALUES (:sense_bundle_id, 'entry_ref', :sense_order, :target_lang, :lang_code, 'gloss', 'class', :def)";
      //session_start();
      $sql = "SELECT * FROM glosses";
      $result = $link->query($sql);
      //$stmnt->execute();
      //$result = $stmnt->fetch(PDO::FETCH_ASSOC);
      $entry_bundle_id = ""; 
        $entry_id = ""; 
        $form_bundle_id = ""; 
        $form_id = ""; 
        $form_order = ""; 
        $source_lang = ""; 
        $lang_code= ""; 
        $vernacular= ""; 
        $glyph_id = "";
        
        foreach ($result as $row){
        $sense_bundle_id = $row["sense_bundle_id"];
        $gloss_id = $row["gloss_id"];
        $gloss = $row["gloss"];
        $gloss_order = $row["gloss_order"];
        $lang_code = $row["lang_code"];
        $target_lang = $row["target_lang"];


        $first_letter = substr($gloss, 0, 1);


        $sql12 = "SELECT * FROM letters_target WHERE glyph_other = '$first_letter'";
        $result12 = $link->query($sql12);

        foreach ($result12 as $row){
          $glyph_id = $row["glyph_id"];

        }

        $sql4 = "SELECT class_id FROM classes WHERE sense_bundle_id = '$sense_bundle_id'";
        $result4 = $link->query($sql4);

        foreach ($result4 as $row){
          $class_id = $row["class_id"];

          $sql5 = "SELECT class_name FROM class_names WHERE (class_id = '$class_id' AND lang_code = '$lang_code')";
          $result5 = $link->query($sql5);
  
          foreach ($result5 as $row){
            $class_name = $row["class_name"];
            //echo $class_name."<br/>";

          }


          


        }





        $sql2 = "SELECT entry_id FROM sense_bundles WHERE sense_bundle_id = '$sense_bundle_id'";
        $result2 = $link->query($sql2);

        foreach ($result2 as $row){
          $entry_id = $row["entry_id"];


          $sql3 = "SELECT entry_bundle_id FROM entries WHERE entry_id = '$entry_id'";
          $result3 = $link->query($sql3);
  
          foreach ($result3 as $row){
            $entry_bundle_id = $row["entry_bundle_id"];



            $sql6 = "INSERT INTO entries_glosses (entry_bundle_id, entry_id, sense_bundle_id, gloss_id, gloss_order, target_lang, lang_code, gloss, class_id, class_name, glyph_id) 
            VALUES (:entry_bundle_id, :entry_id, :sense_bundle_id, :gloss_id, :gloss_order, :target_lang, :lang_code, :gloss, :class_id, :class_name, :glyph_id)";
            $data_entry_glosses = [':entry_bundle_id'=>$entry_bundle_id,':entry_id'=>$entry_id,':sense_bundle_id'=>$sense_bundle_id, ':gloss_id'=>$gloss_id,':gloss_order'=>$gloss_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':gloss'=>$gloss, ':class_id'=>$class_id, ':class_name' =>$class_name, ':glyph_id' =>$glyph_id];
            $stmnt = $link->prepare($sql6);
            $stmnt->execute($data_entry_glosses);
          
          







            


          }






        }  




      }
  
  
  } catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
  }
    





   
    try {

      //$entry_data = [':sense_bundle_id'=>$sense_bundle_id,':sense_order'=>$bundle_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':def'=>''];
      //$stmnt->execute($entry_data);

      //VALUES (:sense_bundle_id, 'entry_ref', :sense_order, :target_lang, :lang_code, 'gloss', 'class', :def)";
      //session_start();
      $sql = "SELECT * FROM sd_names";
      $result = $link->query($sql);
      //$stmnt->execute();
      //$result = $stmnt->fetch(PDO::FETCH_ASSOC);
      $entry_bundle_id = ""; 
        $entry_id = ""; 
        $form_bundle_id = ""; 
        $form_id = ""; 
        $form_order = ""; 
        $source_lang = ""; 
        $lang_code= ""; 
        $vernacular= ""; 
        $glyph_id = "";
        
        foreach ($result as $row){
        $sd_name = $row["sd_name"];
        $sd_id = $row["sd_id"];
        $lang_code = $row["lang_code"];
        $target_lang = $row["target_lang"];


        $sql12 = "SELECT * FROM sds WHERE sd_id = '$sd_id'";
        $result12 = $link->query($sql12);

        foreach ($result12 as $row){
          $sense_bundle_id = $row["sense_bundle_id"];






          $sql4 = "SELECT class_id FROM classes WHERE sense_bundle_id = '$sense_bundle_id'";
          $result4 = $link->query($sql4);
  
          foreach ($result4 as $row){
            $class_id = $row["class_id"];
  
            $sql5 = "SELECT class_name FROM class_names WHERE (class_id = '$class_id' AND lang_code = '$lang_code')";
            $result5 = $link->query($sql5);
    
            foreach ($result5 as $row){
              $class_name = $row["class_name"];
              //echo $class_name."<br/>";
  
            }
  
  
            
  
  
          }
  




          
        $sql13 = "SELECT * FROM glosses WHERE sense_bundle_id = '$sense_bundle_id' and target_lang = '$target_lang'";
        $result13 = $link->query($sql13);

        foreach ($result13 as $row){
          $gloss_id = $row["gloss_id"];
          $gloss = $row["gloss"];
          $gloss_order = $row["gloss_order"];



        $sql14 = "SELECT entry_id FROM sense_bundles WHERE sense_bundle_id = '$sense_bundle_id'";
        $result14 = $link->query($sql14);

        foreach ($result14 as $row){
          $entry_id = $row["entry_id"];



          $sql3 = "SELECT entry_bundle_id FROM entries WHERE entry_id = '$entry_id'";
          $result3 = $link->query($sql3);
  
          foreach ($result3 as $row){
            $entry_bundle_id = $row["entry_bundle_id"];













          


            $sql6 = "INSERT INTO entries_glosses_sds (entry_bundle_id, entry_id, sense_bundle_id, gloss_id, gloss_order, target_lang, lang_code, gloss, class_id, class_name, sd_id, sd_name) 
            VALUES (:entry_bundle_id, :entry_id, :sense_bundle_id, :gloss_id, :gloss_order, :target_lang, :lang_code, :gloss, :class_id, :class_name, :sd_id, :sd_name)";
            $data_entry_glosses = [':entry_bundle_id'=>$entry_bundle_id,':entry_id'=>$entry_id,':sense_bundle_id'=>$sense_bundle_id, ':gloss_id'=>$gloss_id,':gloss_order'=>$gloss_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':gloss'=>$gloss, ':class_id'=>$class_id, ':class_name' =>$class_name, ':sd_id' =>$sd_id, ':sd_name'=>$sd_name];
            $stmnt = $link->prepare($sql6);
            $stmnt->execute($data_entry_glosses);
          
          






          }
            


          }


        }



        }  

      }


  
  } catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
  }
    






   
  try {

    //$entry_data = [':sense_bundle_id'=>$sense_bundle_id,':sense_order'=>$bundle_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':def'=>''];
    //$stmnt->execute($entry_data);

    //VALUES (:sense_bundle_id, 'entry_ref', :sense_order, :target_lang, :lang_code, 'gloss', 'class', :def)";
    //session_start();



    $sql24 = "SELECT * FROM sd_list";
    $result24 = $link->query($sql24);

    $entry_bundle_id = ""; 
      $entry_id = ""; 
      $form_bundle_id = ""; 
      $form_id = ""; 
      $form_order = ""; 
      $source_lang = ""; 
      $lang_code= ""; 
      $vernacular= ""; 
      $glyph_id = "";
      

    foreach ($result24 as $row){
      $sd_id = $row["sd_id"];




    $sql = "SELECT * FROM sd_names WHERE sd_id = '$sd_id'";
    $result = $link->query($sql);
    //$stmnt->execute();
    //$result = $stmnt->fetch(PDO::FETCH_ASSOC);
      foreach ($result as $row){
      $sd_name = $row["sd_name"];
      $lang_code = $row["lang_code"];
      $target_lang = $row["target_lang"];




          $sql6 = "INSERT INTO entries_sds (target_lang, lang_code, sd_id, sd_name) 
          VALUES (:target_lang, :lang_code, :sd_id, :sd_name)";
          $data_entry_glosses = [':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':sd_id' =>$sd_id, ':sd_name'=>$sd_name];
          $stmnt = $link->prepare($sql6);
          $stmnt->execute($data_entry_glosses);
        
        



        }


        }
          


       
} catch(PDOException $e){
  echo "Erro: ".$e->getMessage();
}



  
   
  try {

    //$entry_data = [':sense_bundle_id'=>$sense_bundle_id,':sense_order'=>$bundle_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':def'=>''];
    //$stmnt->execute($entry_data);

    //VALUES (:sense_bundle_id, 'entry_ref', :sense_order, :target_lang, :lang_code, 'gloss', 'class', :def)";
    //session_start();
    $sql = "SELECT * FROM sd_names";
    $result = $link->query($sql);
    //$stmnt->execute();
    //$result = $stmnt->fetch(PDO::FETCH_ASSOC);
    $entry_bundle_id = ""; 
      $entry_id = ""; 
      $form_bundle_id = ""; 
      $form_id = ""; 
      $form_order = ""; 
      $source_lang = ""; 
      $lang_code= ""; 
      $sd_target_lang = ""; 
      $sd_lang_code= ""; 
      $vernacular= ""; 
      $glyph_id = "";
      
      foreach ($result as $row){
      $sd_name = $row["sd_name"];
      $sd_id = $row["sd_id"];
      $sd_lang_code = $row["lang_code"];
      $sd_target_lang = $row["target_lang"];


      $sql12 = "SELECT * FROM sds WHERE sd_id = '$sd_id'";
      $result12 = $link->query($sql12);

      foreach ($result12 as $row){
        $sense_bundle_id = $row["sense_bundle_id"];




      $sql14 = "SELECT entry_id FROM sense_bundles WHERE sense_bundle_id = '$sense_bundle_id'";
      $result14 = $link->query($sql14);

      foreach ($result14 as $row){
        $entry_id = $row["entry_id"];



        $sql3 = "SELECT entry_bundle_id FROM entries WHERE entry_id = '$entry_id'";
        $result3 = $link->query($sql3);

        foreach ($result3 as $row){
          $entry_bundle_id = $row["entry_bundle_id"];









          $sql21 = "SELECT form_bundle_id FROM form_bundles WHERE entry_id = '$entry_id'";
          $result21 = $link->query($sql21);
  
          foreach ($result21 as $row){
            $form_bundle_id = $row["form_bundle_id"];
  

            $sql32 = "SELECT * FROM forms WHERE form_bundle_id = '$form_bundle_id'";
            $result32 = $link->query($sql32);
    
            foreach ($result32 as $row){
              $form_id = $row["form_id"];
              $form_order = $row["form_order"];
              $vernacular = $row["vernacular"];
              $source_lang = $row["source_lang"];
              $lang_code = $row["lang_code"];





              $sql6 = "INSERT INTO entries_vernacular_sds (entry_bundle_id, entry_id, sense_bundle_id, form_bundle_id, form_id, form_order, source_lang, lang_code, vernacular, sd_id, sd_name, sd_target_lang, sd_lang_code) 
              VALUES (:entry_bundle_id, :entry_id, :sense_bundle_id, :form_bundle_id, :form_id, :form_order, :source_lang, :lang_code, :vernacular, :sd_id, :sd_name, :sd_target_lang, :sd_lang_code)";
              $data_entry_glosses = [':entry_bundle_id'=>$entry_bundle_id,':entry_id'=>$entry_id,':sense_bundle_id'=>$sense_bundle_id,':form_bundle_id'=>$form_bundle_id, ':form_id'=>$form_id,':form_order'=>$form_order, ':source_lang'=>$source_lang, ':lang_code'=>$lang_code, ':vernacular'=>$vernacular, ':sd_id'=>$sd_id, ':sd_name'=>$sd_name, ':sd_target_lang' =>$sd_target_lang, ':sd_lang_code'=>$sd_lang_code];
              $stmnt = $link->prepare($sql6);
              $stmnt->execute($data_entry_glosses);
            






          }
    
    
    
          }  
            
          


        }


      }



      }  

    }



} catch(PDOException $e){
  echo "Erro: ".$e->getMessage();
}
  










  
  try{
    $glyphs = array();

    $sql = "SELECT * FROM alpha_order_source";
      $result = $link->query($sql);
      //$stmnt->execute();
      //$result = $stmnt->fetch(PDO::FETCH_ASSOC);
      $position_btn = 0;
      foreach ($result as $row){
        $glyph_id = $row["glyph_id"];
        $glyph = $row["glyph"];
        $glyph_order = $row["glyph_order"];
        $display_btn = check_letter($glyph_id, 1);
        $glyphs = array();
  

        if ($display_btn == 1){


          try{
            $result2 = $link->query("SELECT * FROM letters_source WHERE glyph_id = '$glyph_id'");
      
      
            if($result2->rowCount()>0){
              //$key=0;
              foreach ($result2 as $key => $row){
                  $glyph_other=$row["glyph_other"];
                  $glyphs[] = $glyph_other;
                } //foreach
            
            }else{
              //echo "A busca não retornou nenhum resultado.";
          } // if
      
        } catch(PDOException $e){
          echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
        } // try
          
  
    $glyphs_in = "'" . implode( "','", $glyphs ) . "'";
        
  
      $sql3 = "SELECT * FROM entries_vernacular WHERE LEFT (vernacular, 1) IN ($glyphs_in)";
      $result3 = $link->query($sql3);
      $position_btn2 = $result3->rowCount();
      
          $sql6 = "INSERT INTO entries_source_letters (glyph_id, glyph, glyph_order, display_btn, position_btn) 
          VALUES (:glyph_id, :glyph, :glyph_order, :display_btn, :position_btn)";
          $data_entry_source_letters = [':glyph_id'=>$glyph_id,':glyph'=>$glyph,':glyph_order'=>$glyph_order, ':display_btn'=>$display_btn, ':position_btn'=>$position_btn];
          $stmnt = $link->prepare($sql6);
          $stmnt->execute($data_entry_source_letters);
        
          $position_btn = $position_btn + $position_btn2;
    
    
    


    }//if

        }




  
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }
      




      
  try{

    $sql = "SELECT * FROM alpha_order_target";
      $result = $link->query($sql);
      //$stmnt->execute();
      //$result = $stmnt->fetch(PDO::FETCH_ASSOC);
      $position_btn = 0;
      foreach ($result as $row){
        $glyph_id = $row["glyph_id"];
        $glyph = $row["glyph"];
        $glyph_order = $row["glyph_order"];
        $display_btn = check_letter($glyph_id, 2);
        $glyphs = array();
  

        if ($display_btn == 1){


          try{
            $result2 = $link->query("SELECT * FROM letters_target WHERE glyph_id = '$glyph_id'");
      
      
            if($result2->rowCount()>0){
              //$key=0;
              foreach ($result2 as $key => $row){
                  $glyph_other=$row["glyph_other"];
                  $glyphs[] = $glyph_other;
                } //foreach
            
            }else{
              //echo "A busca não retornou nenhum resultado.";
          } // if
      
        } catch(PDOException $e){
          echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
        } // try
          
  
    $glyphs_in = "'" . implode( "','", $glyphs ) . "'";
        
  
      $sql3 = "SELECT * FROM entries_glosses WHERE LEFT (gloss, 1) IN ($glyphs_in)";
      $result3 = $link->query($sql3);
      $position_btn2 = $result3->rowCount();


          $sql6 = "INSERT INTO entries_target_letters (glyph_id, glyph, glyph_order, display_btn, position_btn) 
          VALUES (:glyph_id, :glyph, :glyph_order, :display_btn, :position_btn)";
          $data_entry_target_letters = [':glyph_id'=>$glyph_id,':glyph'=>$glyph,':glyph_order'=>$glyph_order, ':display_btn'=>$display_btn, ':position_btn'=>$position_btn];
          $stmnt = $link->prepare($sql6);
          $stmnt->execute($data_entry_target_letters);
          
          $position_btn = $position_btn + $position_btn2;
    
    



        }





  
      }      
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
      }
      




    ?>