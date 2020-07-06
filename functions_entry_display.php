  <?php

  //START // function form_bundle_output //START


  function form_bundle_output($entry_id){

    include('connection.php');
    
    //BEGINING //form bundles //BEGINING
    
    $sql1="SELECT * FROM form_bundles WHERE entry_id  = '$entry_id'";
    
    
    if($result1 = mysqli_query($link, $sql1)){
      
      if(mysqli_num_rows($result1)>0){
        
        $form_bundle_id="";
        
        while($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
          
          if($form_bundle_id!=$row["form_bundle_id"]){
            $form_bundle_id=$row["form_bundle_id"];
            $entry_ref2= $row["entry_ref"];
      //      $firstChar= $_GET['letter'];
    
      
          }else{ 
    
          }
          
    
          vernacular($form_bundle_id,1);
          vernacular($form_bundle_id,2);
    
      
      // BELOW END BRACKET OF WHILE STATEMENT IN form_bundles     
      }
      // ABOVE END BRACKET OF WHILE STATEMENT IN form_bundles     
    

      
      //close the result set  
      mysqli_free_result($result1);
      
      }else{  
      // echo "<p>Não foram encontrados resultados para a busca1.</p>";
      }
      
    
      }else{
      
      echo "<p>Não foi possível executar: $sql1. " . mysqli_error($link) ."</p>";
      
      }
    
    //END // form bundles //END//BEGINING //sense bundles //BEGINING
    
    
    }




  //END // function form_bundle_output //END

    
  //START // function vernacular //START
  function vernacular($form_bundle_id, $source_lang){

        include('connection.php');
        
        //BEGINING //forms //BEGINING
        
              $sql2="SELECT * FROM forms WHERE form_bundle_id  = '$form_bundle_id' AND source_lang = '$source_lang' ORDER BY form_id";
              
              if($result2 = mysqli_query($link, $sql2)){
                
                if(mysqli_num_rows($result2)>0){
                  
                  $form_id="";
              
                  ?>
                  <div id="form_bundle_sl<?php echo $source_lang; ?>" class="form_bundle sl<?php echo $source_lang; ?>">

                  <?php
                  while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                    
                    if($form_id!=$row["form_id"]){
                      
                      $form_id=$row["form_id"];
                      
                      $vernacular= $row["vernacular"];
                      $lang_code = $row["lang_code"];
                      $source_lang = $row["source_lang"];
                      
            //          $firstChar= $_GET['letter'];
            ?>
                  <div id="form_bundle_<?php echo $form_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight form_bundle sl<?php echo $source_lang; ?>">
                  <div id="lang_code_<?php echo $form_id; ?>" class="mr-auto pl-1 lang_code sl<?php echo $source_lang; ?>">
                  <?php echo "[$lang_code]"; ?>
                  </div>
                  <div id="vernacular_<?php echo $form_id; ?>" class="ml-auto vernacular sl<?php echo $source_lang; ?>">
                  <b><?php echo "$vernacular"; ?></b>
                  </div>
            
            
      <?php

                                      
                      phonemic($form_id);
                  
                      ?>  
                      </div>
                      <?php
  

        
                    }else{
        
                    }

        }
        ?>
        </div>

        <?php

        //close the result set
        mysqli_free_result($result2);
        
        }else{
        // echo "<p>Não foram encontrados resultados para a busca2.</p>";
        }
        
        }else{
        echo "<p>Não foi possível executar: $sql2. " . mysqli_error($link) ."</p>";
        }
        
        //END //forms //END
        
        
        
        }

  //END // function vernacular // END //


  //START // function phonemic_output //START
  function phonemic($form_id){

    include('connection.php');
    
                //BEGINING //phonemic //BEGINING
    
    
                $sql3="SELECT * FROM phonemic WHERE form_id = '$form_id' ORDER BY phonemic_id";
                
                if($result3 = mysqli_query($link, $sql3)){
                  
                  if(mysqli_num_rows($result3)>0){
                    
                    $phonemic_id="";
                    
                    while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                      
                      if($phonemic_id!=$row["phonemic_id"]){
                        
                        $phonemic_id=$row["phonemic_id"];
                        $source_lang=$row["source_lang"];
                        
                        $phonemic=$row["phonemic"];
                        $entry_ref= $row["entry_ref"];
                        
                        
          //              $firstChar= $_GET['letter'];
    

          ?>
                <div id="phonemic_bundle_<?php echo $phonemic_id; ?>" class="ml-auto d-flex flex-row p-2 bd-highlight phonemic_bundle sl<?php echo $source_lang; ?>">
                <div id="phonemic_<?php echo $phonemic_id; ?>" class="phonemic sl<?php echo $source_lang; ?>">
                <?php echo "$phonemic"; ?>
                </div>
          <?php
              prons($phonemic_id);
    
              ?>
              </div>

    <?php

            }
 
 
                    else{
    
                    }
                    
    
    
    
    
    
                  }
    
    
    //close the result set
    
    mysqli_free_result($result3);
    
    }else{
    
    // echo "<p>Não foram encontrados resultados para a busca3.</p>";
    
    }}else
    {
      echo "<p>Não foi possível executar: $sql3. " . mysqli_error($link) ."</p>";
    
    }
    
    
    
    
    //END //phonemic //END
    
    
    
    }

  //END // function phonemic // END //


  //START // function prons //START
  function prons($phonemic_id){

    include('connection.php');
    
    
                        //BEGINING //prons //BEGINING
    
                          $sql4="SELECT * FROM prons WHERE phonemic_id = '$phonemic_id' ORDER BY pron_id";
                
                          if($result4 = mysqli_query($link, $sql4)){
                            
                            if(mysqli_num_rows($result4)>0){
                              
                              $pron_id="";
                              
                              while($row = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                                
                                if($pron_id!=$row["pron_id"]){
                                  
                                  $pron_id=$row["pron_id"];
                                  
                                  $entry_ref= $row["entry_ref"];
                                  
                                  $phonetic= $row["phonetic"];
                                  $source_lang=$row["source_lang"];
                                  
                                  $wav= $row["wav"];
                                  //$ogg= $row["ogg"];
                                  $mp3= $row["mp3"];
                                  
            //                       $firstChar= $_GET['letter'];
              ?>
              
              <div id="pron_bundle_<?php echo $phonetic ?>" class="d-inline-flex p-0 bd-highlight pron_bundle sl<?php echo $source_lang ?>">
                            <div id="pron_<?php echo $phonetic ?>" class="phonetic sl<?php echo $source_lang ?>">
                              &nbsp; <?php echo $phonetic; ?>
                            </div>


                      <?php

                            if(!empty($wav)){
                      ?>
                                <button id='<?php echo $pron_id;?>' type="button"  audio="assets/audio/<?php echo $wav?>" class='btn btn-default btn-sm btnpron d-inline-flex p-0'>
                                    <span class="material-icons md-18">volume_up</span>
                                </button>
                                <audio controls hidden id="audio_<?php echo $pron_id;?>">

                                    <source id="<?php echo $pron_id;?>_wav" src="assets/audio/<?php echo $wav?>" type="audio/wav">
                                   <!-- <source id="<?php echo $pron_id;?>_ogg" src="#" type="audio/ogg">
                                   <source id="<?php echo $pron_id;?>_mp3" src="assets/audio/<?php echo $mp3?>" type="audio/mpeg">
    -->
                                </audio> 


                                <?php

                            }else{

                            }



                            ?>


                              </div>
                  
              <?php
              
              
                                }
                                else{
              
                                }
                                
              
              
              
              
              
                            }
              
              
              //close the result set
              
              mysqli_free_result($result4);
              
              }else{
              
              // echo "<p>Não foram encontrados resultados para a busca4.</p>";
              
              }}else
              {
                echo "<p>Não foi possível executar: $sql4. " . mysqli_error($link) ."</p>";
              
              }
              
              //END //prons //END
              
    
    }
  //END // function prons // END//
  //END // PART 1 - FORM // END//



  // BEGINING // PART 2 - SENSE //BEGINING
  // BEGINING //sense_bundle_output function //BEGINING
  function sense_bundle_output ($entry_id){

    //BEGINING //sense bundles //BEGINING
    include('connection.php');
    
    $sql1="SELECT * FROM sense_bundles WHERE entry_id  = '$entry_id'";
    
    
    if($result1 = mysqli_query($link, $sql1)){
      
      if(mysqli_num_rows($result1)>0){
        
        $sense_bundle_id="";
        
        while($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
          
          if($sense_bundle_id!=$row["sense_bundle_id"]){
            $sense_bundle_id=$row["sense_bundle_id"];
            $entry_ref2= $row["entry_ref"];
    //       $firstChar= $_GET['letter'];
            
      
    
    // BELOW IS THE CLOSING BRACKET OF THE IF STATEMENT INSIDE THE WHILE STATEMENT IN sense_bundles      
          }else{ 
    
          }
    // ABOVE IS THE CLOSING BRACKET OF THE IF STATEMENT INSIDE THE WHILE STATEMENT IN sense_bundles      
          
    
    

    senses ($sense_bundle_id, 1);
    senses ($sense_bundle_id, 2);
    scns ($sense_bundle_id);
    example_bundle_output($sense_bundle_id);
    images($sense_bundle_id);
    videos($sense_bundle_id);
    comments($sense_bundle_id);
    sds($sense_bundle_id, 1);
    
    
    
      
    // BELOW IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN sense_bundles      
        }
    // ABOVE IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN sense_bundles      
    
    
    
        //close the result set  
      mysqli_free_result($result1);
    
      
      
      }else{  
      // echo "<p>Não foram encontrados resultados para a busca.</p>";
      }
      
    
      }else{
      
      echo "<p>Não foi possível executar: $sql1. " . mysqli_error($link) ."</p>";
      
      }
    
    //END // sense bundles //END
    
    }
    
  //END // sense bundles function //END


  // BEGINING //senses function //BEGINING
  function senses ($sense_bundle_id, $target_lang){
    include('connection.php');

        //BEGINING //senses //BEGINING

        $sql2="SELECT * FROM senses WHERE sense_bundle_id  = '$sense_bundle_id' AND target_lang = '$target_lang' ORDER BY sense_id";

        if($result2 = mysqli_query($link, $sql2)){
          
          if(mysqli_num_rows($result2)>0){
            
            $sense_id="";
            
            while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
              
              if($sense_id!=$row["sense_id"]){
                
                $sense_id=$row["sense_id"];
                
                $class= $row["class"];
                $gloss= $row["gloss"];
                $def= $row["def"];
                $lang_code= $row["lang_code"];
                
            //    $firstChar= $_GET['letter'];
        
        ?>
                    <div class="sense_bundle tl<?php echo $target_lang;?>">
                      <div id="sense_bundle_<?php echo $sense_id ?>" class="col-9 offset-3 col-xl-9 offset-3 p-0 d-flex bd-highlight sense_bundle2 tl<?php echo $target_lang;?>">
                      <div id="lang_code_<?php echo $sense_id; ?>" class="mr-auto pl-1 lang_code tl<?php echo $target_lang;?>">
                        <?php echo "[$lang_code]"; ?>
                      </div>
                      <div class="ml-auto d-flex p-2">
                        <div id="gloss_<?php echo $sense_id ?>" class="ml-auto p-2 mr-4 gloss tl<?php echo $target_lang;?>">
                          <?php echo $gloss;?>
                        </div>

                        <?php
                          classes ($sense_bundle_id, $target_lang);
                        ?>


                      </div>
      <!--                        <div id="def_<?php echo $sense_id ?>" class="ml-auto def tl<?php echo $target_lang;?>">
                        <b><?php echo $def;?></b>
                        </div>
              -->          
              
                      </div>
                    </div>

                      <?php
              }else{
        
              }
        
        
        // BELOW IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN senses      
        }
        // ABOVE IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN senses      
        
        
        
        //close the result set
        mysqli_free_result($result2);
        
        }else{
        // echo "<p>Não foram encontrados resultados para a busca.</p>";
        }
        
        }else{
        echo "<p>Não foi possível executar: $sql2. " . mysqli_error($link) ."</p>";
        }
        
        //END //senses //END



  }
  //END // sense function // END





  //BEGINING //scns function //BEGINING
  function scns ($sense_bundle_id){

    include ('connection.php');
    //BEGINING //scn //BEGINING
            
                  $sql3="SELECT * FROM scns WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY scn_order";
            
                  if($result3 = mysqli_query($link, $sql3)){
                    
                  if(mysqli_num_rows($result3)>0){
                    
                    $scn_id="";
                    ?>
                    <div id="scn_bundle" class="scn">
                    <?php              
                    while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                      
                      if($scn_id!=$row["scn_id"]){
                        
                        $scn_id=$row["scn_id"];
                        
                        $scn= $row["scn"];
                        
                    //    $firstChar= $_GET['letter'];
                  
                  ?>
                          <div id="scn_<?php echo $scn_id ?>" class="d-inline-flex p-0 bd-highlight scn">
                          <b><?php echo "$scn";?></b>
                          </div>

                                <?php
                      }else{
                  
                      }
                  
                  
                      
                  
                  
                  
          // BELOW IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN scns     
          }
          // ABOVE IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN scns      
                
          ?>
          </div>
          <?php              
            
          
                  //close the result set
                  mysqli_free_result($result3);
                  
                  }else{
                  // echo "<p>Não foram encontrados resultados para a busca vid.</p>";
                  }
                  
                  }else{
                  echo "<p>Não foi possível executar: $sql3. " . mysqli_error($link) ."</p>";
                  }
                  
                  //END //scns //END
                }
    
  //END //scns function//END

  // BEGINING //sds function //BEGINING
  function sds ($sense_bundle_id, $target_lang){
    include('connection.php');

        //BEGINING //sds //BEGINING

        $sql2="SELECT * FROM sds WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY sd_id";

        if($result2 = mysqli_query($link, $sql2)){
          
          if(mysqli_num_rows($result2)>0){
            
            $sd_id="";
            ?>
            <div id="sd_bundle" class="sd mt-2">

            <div id="sd_panel" class="form-group d-flex flex-row-reverse pr-2 bd-highlight sd tl<?php echo $target_lang ?>">

            <?php
            while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
              
              if($sd_id!=$row["sd_id"]){
                
                $sd_id=$row["sd_id"];
                $sd_name_ref=$row["sd_name_ref"];
                
        

                
        ?>
        <?php

        ?>
                     <input type="submit" id="<?php echo $sd_id; ?>"  style="min-width:2.3em; width:auto; min-height:2em; height: auto;" class="btn btn-primary btn-xs sembtn_display" value='<?php echo $sd_name_ref; ?>'>


                      <?php
              }else{
        
              }
        
        
        // BELOW IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN sds      
        }
        // ABOVE IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN sds      
        
        ?>
        </div>
        </div>


        <?php

        
        //close the result set
        mysqli_free_result($result2);
        
        }else{
        // echo "<p>Não foram encontrados resultados para a busca.</p>";
        }
        
        }else{
        echo "<p>Não foi possível executar: $sql2. " . mysqli_error($link) ."</p>";
        }
        
        //END //sds //END



  }
  //END // sds function // END


  function classes ($sense_bundle_id, $target_lang){
    
    include ('connection.php');

        //BEGINING //sds //BEGINING

        $sql2="SELECT * FROM classes WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY class_id";

        if($result2 = mysqli_query($link, $sql2)){
          
          if(mysqli_num_rows($result2)>0){
            
            $class_id="";
            ?>
            <div id="part_of_speech_bundle" class="part_of_speech p-0 align-self-end">



            <div id="part_of_speech_<?php echo $sense_bundle_id ?>" class="form-group d-flex mb-2 p-0 pr-2 bd-highlight ml-auto part_of_speech tl<?php echo $target_lang;?>">
   
            <?php
            while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
              
              if($class_id!=$row["class_id"]){
                
                $class_id=$row["class_id"];
                $class_name_ref=$row["class_name_ref"];
                
        

                
        ?>
        <?php

        ?>
                     <a type="submit" class="classbtn_display" id="<?php echo $class_id;?>"><?php echo "(".$class_name_ref.")";?>
                      	</a>


                      <?php
              }else{
        
              }
        
        
        // BELOW IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN sds      
        }
        // ABOVE IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN sds      
        
        ?>
                                </div>
            </div>
        </div>
        </div>


        <?php

        
        //close the result set
        mysqli_free_result($result2);
        
        }else{
        // echo "<p>Não foram encontrados resultados para a busca.</p>";
        }
        
        }else{
        echo "<p>Não foi possível executar: $sql2. " . mysqli_error($link) ."</p>";
        }
        
        //END //sds //END



  }
  //END // sds function // END


  //BEGINING //example_bundle_output function  //BEGINING
  function example_bundle_output ($sense_bundle_id){
    include ('connection.php');
    //BEGINING //example_bundles //BEGINING
          
                $sql3="SELECT * FROM example_bundles WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY example_bundle_id";
          
                if($result3 = mysqli_query($link, $sql3)){
                  
                if(mysqli_num_rows($result3)>0){
                  
                  $example_bundle_id="";
                  
                  while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                    
                    if($example_bundle_id!=$row["example_bundle_id"]){
                      
                      $example_bundle_id=$row["example_bundle_id"];
                      
                      
                    }else{
                
                    }
                    ?>

                   <div class="example_bundle sl1">
                    <?php
                
                example_vernacular($example_bundle_id, 1);

                ?>

                  </div>
                  
                  
                  <div class="example_bundle sl2">
                 <?php


                example_vernacular($example_bundle_id, 2);
                    
                
                ?>

                  </div> 
                 <?php

                
        // BELOW IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN example_bundles      
        }
        // ABOVE IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN example_bundles      
              
                    
        
                //close the result set
                mysqli_free_result($result3);
                
                }else{
    //              echo "<p>Não foram encontrados resultados para a busca example_bundle.</p>";
                }
                
                }else{
                echo "<p>Não foi possível executar: $sql3. " . mysqli_error($link) ."</p>";
                }
                
                //END //example_bundles //END
              }

  //END //example_bundle_output function//END


  //BEGINING //example_vernacular function  //BEGINING
  function example_vernacular ($example_bundle_id, $source_lang){
    include ('connection.php');
    //BEGINING //example_bundles //BEGINING
          
                $sql3="SELECT * FROM examples WHERE example_bundle_id  = '$example_bundle_id' AND source_lang='$source_lang' ORDER BY example_id";
          
                if($result3 = mysqli_query($link, $sql3)){
                  
                if(mysqli_num_rows($result3)>0){
                  
                  $example_id="";
                  
                  while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                    
                    if($example_id!=$row["example_id"]){
                      
                      $example_id=$row["example_id"];
                      
                      $ex_vernacular=$row["vernacular"];
                      $ex_phonetic=$row["phonetic"];
                      
                      $wav=$row["wav"];
                      $lang_code = $row["lang_code"];
                  //    $firstChar= $_GET['letter'];
                
            ?>
              
              <div class="sl<?php echo $source_lang; ?>">
              <div class="d-flex flex-wrap">

              <div id="lang_code_<?php echo $example_id; ?>" class="mr-auto pl-1 lang_code sl<?php echo $source_lang; ?>">
                        <?php echo "[$lang_code]"; ?>
                      </div>
  
              <div id="example_<?php echo $example_id; ?>" class="d-flex ml-auto pr-2 bd-highlight example sl<?php echo $source_lang;?>">
              <div class="ex_vernacular"><?php echo $ex_vernacular; ?></div>


      <?php


            if(!empty($wav)){
      ?>
                <button id="ex_audio_<?php echo $example_id;?>" type="button"  audio="assets/audio/<?php echo $wav;?>" class='btn btn-default btn-sm d-inline-flex p-0 btnex sl<?php echo $source_lang;?>'>
                    <span class="material-icons md-18">volume_up</span>
                </button>
                <audio controls hidden id="control_ex_audio_<?php echo $example_id;?>">

                    <source id="<?php echo $example_id;?>_wav" src="assets/audio/<?php echo $wav?>" type="audio/wav">
                   <!-- <source id="<?php echo $example_id;?>_ogg" src="#" type="audio/ogg">
                   <source id="<?php echo $example_id;?>_mp3" src="assets/audio/<?php echo $mp3?>" type="audio/mpeg">
    -->
                </audio> 


                <?php




                    }else{

                    }



                    ?>


                      </div>
              </div>
              <?php
                    
                    if(!empty($ex_phonetic)){
    ?>
                  <div class="d-flex flex-wrap">

            <div class="d-flex ml-auto pr-4 ex_phonetic"><?php echo $ex_phonetic; ?></div>
                  </div>
              <?php

                  }else{

                  }

          ?>

                      <?php


                example_translation($example_bundle_id, 1);
                example_translation($example_bundle_id, 2);
              ?>
              </div>


                    <?php

                    }else{
                
                    }
                
        // BELOW IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN examples      
        }
        // ABOVE IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN examples      
                //close the result set
                mysqli_free_result($result3);
                
                }else{
    //           echo "<p>Não foram encontrados resultados para a busca examples.</p>";
                }
                
                }else{
                echo "<p>Não foi possível executar: $sql3. " . mysqli_error($link) ."</p>";
                }
                
                //END //examples //END
              }

  //END //example_vernacular function//END


  //BEGINING //example_translation function  //BEGINING
function example_translation ($example_bundle_id, $target_lang){
    include ('connection.php');
    //BEGINING //translations //BEGINING
          
                $sql3="SELECT * FROM translations WHERE example_bundle_id  = '$example_bundle_id' AND target_lang='$target_lang' ORDER BY translation_id";
          
                if($result3 = mysqli_query($link, $sql3)){
                  
                if(mysqli_num_rows($result3)>0){
                  
                  $translation_id="";
                  
                  while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                    
                    if($translation_id!=$row["translation_id"]){
                      
                      $translation_id=$row["translation_id"];
                      
                      $translation=$row["translation"];
                      
                      $lang_code = $row["lang_code"];
                      $target_lang = $row["target_lang"];

                  //    $firstChar= $_GET['letter'];
                
                ?>
                              <div class="d-flex flex-wrap pb-2">

                    <div id="lang_code_<?php echo $translation_id; ?>" class="mr-auto pl-1 lang_code tl<?php echo $target_lang;?>">
                        <?php echo "[$lang_code]"; ?>
                      </div>
  
                      <div id="translation_<?php echo $translation_id ?>" class="ml-auto pr-4 translation tl<?php echo $target_lang ?>">
                          <?php echo "$translation";?>
                      </div>
                              </div>
                              <?php
                    }else{
                
                    }
                
                
                    
                
                
                
        // BELOW IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN examples      
        }
        // ABOVE IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN examples      
              
                    
        
                //close the result set
                mysqli_free_result($result3);
                
                }else{
                // echo "<p>Não foram encontrados resultados para a busca translation.</p>";
                }
                
                }else{
                echo "<p>Não foi possível executar: $sql3. " . mysqli_error($link) ."</p>";
                }
                
                //END //translations //END
}
  //END //example_tranlation function//END



  //BEGINING //images function //BEGINING
function images ($sense_bundle_id){
    include ('connection.php');
    //BEGINING //images //BEGINING
          

                $sql3="SELECT * FROM images WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY image_id";
          
                if($result3 = mysqli_query($link, $sql3)){
                  
                if(mysqli_num_rows($result3)>0){
                  

                  

                  $image_id="";
    ?>

                <div id="image_panel" class="image"">
                <div id="image_panel_<?php echo $image_id ?>" class="d-flex justify-content-around p-0 bd-highlight image_panel">

    <?php                  
                  while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                    
                    if($image_id!=$row["image_id"]){
                      
                      $image_id=$row["image_id"];
                      
                      $jpg= $row["jpg"];
                      
                  //    $firstChar= $_GET['letter'];
                
                ?>
                                  <a class="image-popup-vertical-fit" href="assets/image/<?php echo $jpg;?>" title="">
                                  <img src="assets/image/<?php echo $jpg;?>" id="image_<?php echo $image_id; ?>" class="img rounded" width="200" height="auto" alt="...">
                                  </a>

                              <?php

                              
                    }else{
                
                    }
                
                
                    
                
                
                
        // BELOW IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN images      
        }
        // ABOVE IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN images      
              
        ?>
                                  </div>

      </div>

    <?php                  

                //close the result set
                mysqli_free_result($result3);
                
                }else{
                // echo "<p>Não foram encontrados resultados para a busca img.</p>";
                }
                
                }else{
                echo "<p>Não foi possível executar: $sql3. " . mysqli_error($link) ."</p>";
                }
                
                //END //images //END
}
  //END //images function//END


//BEGINING //videos function //BEGINING
function videos ($sense_bundle_id){

    include ('connection.php');
    //BEGINING //videos //BEGINING
            
                  $sql3="SELECT * FROM videos WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY video_id";
            
                  if($result3 = mysqli_query($link, $sql3)){
                    
                  if(mysqli_num_rows($result3)>0){
                    
                    $video_id="";
                    
                    while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                      
                      if($video_id!=$row["video_id"]){
                        
                        $video_id=$row["video_id"];
                        
                        $mp4= $row["mp4"];
                        
                    //    $firstChar= $_GET['letter'];
                  
                  ?>
                                  <p id="<?php echo $video_id; ?>" class="list-group-item list-group-item-action"><b><?php echo "$mp4";?></b></p>
                                
                                <?php
                      }else{
                  
                      }
                  
                  
                      
                  
                  
                  
          // BELOW IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN videos      
          }
          // ABOVE IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN videos      
                
                      
          
                  //close the result set
                  mysqli_free_result($result3);
                  
                  }else{
                  // echo "<p>Não foram encontrados resultados para a busca vid.</p>";
                  }
                  
                  }else{
                  echo "<p>Não foi possível executar: $sql3. " . mysqli_error($link) ."</p>";
                  }
                  
                  //END //videos //END
}    
//END //videos function//END



  //BEGINING //comments function //BEGINING

  function comments ($sense_bundle_id){

    include ('connection.php');
    //BEGINING //videos //BEGINING
            
                  $sql3="SELECT * FROM comments WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY comment_id";
            
                  if($result3 = mysqli_query($link, $sql3)){
                    
                  if(mysqli_num_rows($result3)>0){
                    
                    $comment_id="";
                    
                    while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                      
                      if($comment_id!=$row["comment_id"]){
                        
                        $comment_id=$row["comment_id"];
                        
                        $comment= $row["comment"];
                        $lang_code= $row["lang_code"];
                        
                    //    $firstChar= $_GET['letter'];
                  
                  ?>
                      <div id="comment_<?php echo $comment_id;?>" class="d-inline-flex p-0 bd-highlight comment <?php echo $lang_code ?>">
                      <b><?php echo "$comment";?></b><span><small><?php echo "[$lang_code]"; ?></small></span>
                      </div>
                                
                                <?php
                      }else{
                  
                      }
                  
                  
                      
                  
                  
                  
          // BELOW IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN comments      
          }
          // ABOVE IS THE CLOSING BRACKET OF THE WHILE STATEMENT IN comments      
                
                      
          
                  //close the result set
                  mysqli_free_result($result3);
                  
                  }else{
                  // echo "<p>Não foram encontrados resultados para a busca vid.</p>";
                  }
                  
                  }else{
                  echo "<p>Não foi possível executar: $sql3. " . mysqli_error($link) ."</p>";
                  }
                  
                  //END //comments //END
}   
//END //comments function//END
//END //Part 2 - Sense//END


?>


