<?php
    $dic_name = "";
    include ("connection.php");


      if (session_status() == PHP_SESSION_NONE) {
        session_start();
      }


      
function logged_in2(){
  if(isset($_SESSION["user_sub"])){
      return true;
    //$user_sub = $_SESSION["user_sub"];
  
  }elseif(isset($_COOKIE["user_sub"])){
    return true;
  }else{

    

  
      return false;
   

}
  
  }


//$dic_name = $_SESSION['dic_name'];

if(isset($_POST['mode'])){

  $mode = $_POST['mode'];
  
  $_SESSION['config_search_'.$dic_name][0]['mode'] = $mode; 
    }else{
  $config_search= $_SESSION['config_search_'.$dic_name][0];
  $mode = $config_search['mode'];   

} 


if(isset($_POST['entry_bundle_id'])){
  $entry_bundle_id = $_POST['entry_bundle_id'];
  $_SESSION['config_search_'.$dic_name][0]['entry_bundle_id'] = $entry_bundle_id;
  entry_output($entry_bundle_id, $mode);
  
  ?>
  
  <script src="https://vjs.zencdn.net/7.8.4/video.js"></script>
  <?php
  
  }else{
  
    $entry_bundle_id = $_SESSION['config_search_'.$dic_name][0]['entry_bundle_id'];
    entry_output($entry_bundle_id, $mode);
    
    ?>
    
    <script src="https://vjs.zencdn.net/7.8.4/video.js"></script>
    <?php
    

  }
  
//START // function form_bundle_output //START
function form_bundle_output($entry_id, $mode){
        $dic_name = "";
    include ("connection.php");    
    //START //form bundles //START
    try {
  
      $result = $link->query("SELECT * FROM form_bundles WHERE entry_id  = '$entry_id'");
  
      if($result->rowCount()>0){
        
        foreach ($result as $key => $row){    
  
          $form_bundle_id=$row["form_bundle_id"];
          $entry_ref2= $row["entry_ref"];
          $source_langs_info = $_SESSION['config_sls_'.$dic_name];
  
          foreach ($source_langs_info as $source_lang_info){
            ?>
 

            <?php
            $source_lang = $source_lang_info['source_lang'];
            $lang_code = $source_lang_info['lang_code'];
            vernacular($form_bundle_id, $source_lang, $lang_code, $mode);
  
          } // foreach   
        } // foreach   
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //form bundles //END
}
//END // function form_bundle_output //END

//START // function vernacular //START
function vernacular($form_bundle_id, $source_lang, $lang_code, $mode){
        $dic_name = "";
    include ("connection.php");  
    //START //forms //START
    try {
  
      $result = $link->query("SELECT * FROM forms WHERE form_bundle_id  = '$form_bundle_id' AND lang_code = '$lang_code' ORDER BY form_id");
  
      $vernacular_display = $_SESSION['config_sls_'.$dic_name][$source_lang-1]['vernacular'];
      $is_hidden = "block";

      if($vernacular_display==0){
        $is_hidden = "none";
      }elseif($vernacular_display==1){
        $is_hidden = "block";
      };

      if($result->rowCount()>0){
        ?>
        <div id="form_bundle_sl<?php echo $source_lang; ?>" class="form_bundle sl<?php echo $source_lang; ?>" style="display:<?php echo $is_hidden;?>">
  
        <?php
      
        foreach ($result as $key => $row){    
              $form_id=$row["form_id"];
              $vernacular= $row["vernacular"];
              $lang_code_display = $_SESSION['config_sls_'.$dic_name][$source_lang-1]['lang_code_display'];
              $is_hidden = "block";
        
              if($lang_code_display==0){
                $is_hidden = "none";
              }elseif($lang_code_display==1){
                $is_hidden = "block";
              };


              $user_id = "";

              if(logged_in2()){

                $is_hidden2 = "block";
                $user_id = $_SESSION["user_sub"];

              }else{
                $is_hidden2 = "none";

              }






          ?>
          <div id="form_bundle_<?php echo $form_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight form_bundle sl<?php echo $source_lang; ?>">
          <button id="add_word_btn_<?php echo $form_id; ?>" user_id = "<?php echo $user_id; ?>" form_id="<?php echo $form_id; ?>" href="#" form_bundle_id = "<?php echo $form_bundle_id; ?>" lang_code = "<?php echo $lang_code; ?>" dic_name = "<?php echo $dic_name; ?>"  type="button" class='btn btn-default mr-auto add_word sl<?php echo $source_lang; ?> p-0 pl-2' style="display:<?php echo $is_hidden2;?>">
                <span class="material-icons md-18">add</span>
              </button>
          
          <div id="lang_code_<?php echo $form_id; ?>" class="mr-auto pl-1 pt-2 lang_code sl<?php echo $source_lang; ?>" style="display:<?php echo $is_hidden;?>">
          <?php echo "[$lang_code]"; ?>
          </div>
          <div id="vernacular_<?php echo $form_id; ?>" class="ml-auto vernacular sl<?php echo $source_lang; ?>">
          <b><?php echo $vernacular; ?></b>
          </div>
          <?php              
              phonemic($form_id, $source_lang, $mode);
          
              ?>  
              </div>
        </div>  

        <script>
        $("#add_word_btn_<?php echo $form_id; ?>").on('click', function(){

          var lang_code = $(this).attr('lang_code');
          var form_bundle_id = $(this).attr('form_bundle_id');
          var form_id = $(this).attr('form_id');
          var user_id = $(this).attr('user_id');
          var dic_name = $(this).attr('dic_name');
          var add_word = 1;
          
          console.log("testando 0");

          

          $.ajax({
                url:'add_word_to_list.php',
                data:{user_id:user_id, dic_name:dic_name, form_bundle_id:form_bundle_id, form_id:form_id, lang_code:lang_code, add_word:add_word},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        //$('#entry_display').html(data);
                    console.log("testando 1");
                    console.log(form_bundle_id);
                    
            
                    }
                }
            })




        })
        
            </script>
        <?php
  
        } // foreach   
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try    
      //END //forms //END      
}
//END // function vernacular // END //


//START // function phonemic_output //START
function phonemic($form_id, $source_lang, $mode){
        $dic_name = "";
    include ("connection.php");
    //START //phonemic //START
    try {
  
      $result = $link->query("SELECT * FROM phonemic WHERE form_id = '$form_id' ORDER BY phonemic_id");
  
      $phonemic_display = $_SESSION['config_sls_'.$dic_name][$source_lang-1]['phonemic'];
      $is_hidden = "";
      if($phonemic_display==0){
        $is_hidden = "none";
      }elseif($phonemic_display==1){
        $is_hidden = "block";
      };

      if($result->rowCount()>0){
      
        foreach ($result as $key => $row){    
            $phonemic_id=$row["phonemic_id"];
            $phonemic=$row["phonemic"];
          ?>
              <div id="phonemic_bundle_<?php echo $phonemic_id; ?>" class="ml-auto d-flex flex-row p-2 bd-highlight phonemic_bundle sl<?php echo $source_lang; ?>">
              <div id="phonemic_<?php echo $phonemic_id; ?>" class="phonemic sl<?php echo $source_lang; ?>" style="display:<?php echo $is_hidden;?>;">
                 <?php
          if($mode==1){
          ?>
          <b><?php echo $phonemic; ?></b>
          <?php
          }elseif($mode==2){
          ?>
          <input class="d-flex form-control form-control-sm" type="text" value="<?php echo $phonemic; ?>" >
          <?php
          }
          ?>
              </div>
          <?php
            phonetic($phonemic_id, $source_lang, $mode);
            ?>
            </div>
        <?php
        } // foreach   
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try    
    //END //phonemic //END   
}
//END // function phonemic // END //

function phonetic($phonemic_id, $source_lang, $mode){
      $dic_name = "";
    include ("connection.php");
  //START // phonetic //START
  try {

    $result = $link->query("SELECT * FROM phonetic WHERE phonemic_id = '$phonemic_id' ORDER BY phonetic_id");

    if($result->rowCount()>0){

      
      $phonetic_display = $_SESSION['config_sls_'.$dic_name][$source_lang-1]['phonetic'];
      $is_hidden = "";
      if($phonetic_display==0){
        $is_hidden = "none";
      }elseif($phonetic_display==1){
        $is_hidden = "block";
      };

    
      foreach ($result as $key => $row){    
        $phonetic_id=$row["phonetic_id"];
        $phonetic= $row["phonetic"];
        ?>
        <div id="phonetic_bundle_<?php echo $phonetic ?>" class="d-inline-flex p-0 bd-highlight phonetic_bundle sl<?php echo $source_lang ?>" >
          <div id="phonetic_<?php echo $phonetic ?>" class="phonetic sl<?php echo $source_lang ?>" style="display:<?php echo $is_hidden;?>;">
          <?php
        if($mode==1){
        ?>
        &nbsp; <?php echo $phonetic; ?>
        <?php
        }elseif($mode==2){
        ?>
        <input class="d-flex form-control form-control-sm" type="text" value="<?php echo $phonetic; ?>" >
        <?php
        }
        ?>
            
          </div>
            <?php

          prons($phonetic_id, $source_lang, $mode)

            ?>

        </div>
        <?php
      } // foreach   
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
  } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
  } // try    
  //END //phonetic //END  
}
//END // function phonetic // END//

//START // function prons //START
function prons($phonetic_id, $source_lang, $mode){
        $dic_name = "";
    include ("connection.php");
    //START // prons //START
    try {
      $result = $link->query("SELECT * FROM prons WHERE phonetic_id = '$phonetic_id' ORDER BY pron_id");
      if($result->rowCount()>0){
          
        foreach ($result as $key => $row){
          $entry_ref =$row["entry_ref"];    
          $lang_code=$row["lang_code"];
          $pron_id=$row["pron_id"];
          $wav=$row["wav"];
          $mp3=$row["mp3"];
          $mp4=$row["mp4"];
          $wma=$row["wma"];

          $pronunciation_display = $_SESSION['config_sls_'.$dic_name][$source_lang-1]['pronunciation'];
          $is_hidden = "";
          if($pronunciation_display==0){
            $is_hidden = "none";
          }elseif($pronunciation_display==1){
            $is_hidden = "block";
          };

        ?>
        <div class="pron sl<?php echo $source_lang ?>" style="display:<?php echo $is_hidden;?>">
            <button id='<?php echo $pron_id;?>' type="button"  audio="assets/audio/<?php echo $wav?>" class='btn btn-default btn-sm btnpron p-0'>
                <span class="material-icons md-18">volume_up</span>
            </button>
        </div>
            <audio controls hidden id="audio_<?php echo $pron_id;?>">
  
            <source id="<?php echo $pron_id;?>_wav" src="assets/audio/<?php echo $wav?>" type="audio/wav">
            <!-- <source id="<?php echo $pron_id;?>_ogg" src="#" type="audio/ogg">
            <source id="<?php echo $pron_id;?>_mp3" src="assets/audio/<?php echo $mp3?>" type="audio/mpeg">
            -->
            </audio>


  
  
              <?php

            prons_meta($pron_id, $source_lang, $mode);

        } // foreach   
        }else{

            //echo "A busca não retornou nenhum resultado.";
      } // if



    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br> 438?".$e->getMessage();
    } // try    
    //END //prons //END 
}
//END // function prons // END//



function prons_meta($pron_id, $source_lang, $mode){
  $dic_name = "";
  include ("connection.php");

  try {
    $result = $link->query("SELECT * FROM prons_meta WHERE pron_id = '$pron_id'");
    if($result->rowCount()>0){
        
      foreach ($result as $key => $row){
        $lang_code=$row["lang_code"];
        $pron_meta_id=$row["pron_meta_id"];
        $file_name=$row["file_name"];
        $collector=$row["collector"];
        $speaker=$row["speaker"];
        $rec_date=$row["rec_date"];
        $rec_place=$row["rec_place"];
        $description=$row["description"];

        /*$pron_meta_display = $_SESSION['config_sls_'.$dic_name][$source_lang-1]['pron_meta_display'];
        $is_hidden = "";
        if($pronunciation_display==0){
          $is_hidden = "none";
        }elseif($pronunciation_display==1){
          $is_hidden = "block";
        };

      <div class="pron_meta sl<?php echo $source_lang ?>" style="display:<?php echo $is_hidden;?>">
        */



        
?>

<div class="pron_meta sl<?php echo $source_lang ?>">
          <button id='<?php echo $pron_id;?>' type="button"  class='btn btn-default btn-sm btn_meta p-0' data-toggle="modal" data-target="#pron_meta_modal_<?php echo $pron_meta_id; ?>">
              <span class="material-icons md-18">info</span>
          </button>
      </div>



  <!-- Modal -->
  <div class="modal fade" id="pron_meta_modal_<?php echo $pron_meta_id; ?>" tabindex="-1" role="dialog" aria-labelledby="pron_meta_modal_title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="pron_meta_modal_title">Metadados</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body" id="pron_meta_panel_<?php echo $pron_meta_id; ?>">

                  <div class="d-flex flex-column">
                  <div id="pron_meta_speaker_<?php echo $pron_meta_id; ?>" class="mr-auto mr-4 pron_meta sl<?php echo $source_lang;?>">
                  <b>Falante:&nbsp;</b><?php echo $speaker; ?>
                  </div>
                  <div id="pron_meta_rec_place<?php echo $pron_meta_id; ?>" class="mr-auto mr-4 pron_meta sl<?php echo $source_lang;?>">
                  <b>Localidade:&nbsp;</b><?php echo $rec_place;?>
                  </div>
                  <div id="pron_meta_rec_date_<?php echo $pron_meta_id; ?>" class="mr-auto mr-4 pron_meta sl<?php echo $source_lang;?>">
                  <b>Data da gravação:&nbsp;</b><?php echo $rec_date; ?>
                  </div>
                  <div id="pron_meta_description_<?php echo $pron_meta_id; ?>" class="mr-auto mr-4 pron_meta sl<?php echo $source_lang;?>">
                  <b>Descrição:&nbsp;</b><?php echo $description; ?>
                  </div>
                  <div id="pron_meta_collector_<?php echo $pron_meta_id; ?>" class="mr-auto mr-4 pron_meta sl<?php echo $source_lang;?>">
                  <b>Coletor:&nbsp;</b><?php echo $collector; ?>
                  </div>
                  <div id="pron_meta_file_name_<?php echo $pron_meta_id; ?>" class="mr-auto mr-4 pron_meta sl<?php echo $source_lang;?>">
                  <b>Nome do arquivo:&nbsp;</b><?php echo $file_name; ?>
                  </div>


                  </div>
               
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
      </div>
  </div>
  </div>
  <!--<script type='text/javascript' src="js/restore_phonemic.js"></script>
    -->




      



            <?php


      } // foreach   
      }else{

          //echo "A busca não retornou nenhum resultado.";
    } // if



  } catch(PDOException $e){
  echo "Opps, houve um erro na sua busca<br><br> 438?".$e->getMessage();
  } // try    



}

//END // PART 1 - FORM // END//
  
  
  
// START // PART 2 - SENSE //START
// START //sense_bundle_output function //START
function sense_bundle_output ($entry_id){
        $dic_name = "";
    include ("connection.php");
    //START //sense bundles //START
    try {
  
      $result = $link->query("SELECT * FROM sense_bundles WHERE entry_id  = '$entry_id'");
  
      if($result->rowCount()>0){
        
        foreach ($result as $key => $row){    
          $sense_bundle_id=$row["sense_bundle_id"];
          $target_langs_info = $_SESSION['config_tls_'.$dic_name];
          $source_langs_info = $_SESSION['config_sls_'.$dic_name];
  
          foreach ($target_langs_info as $target_lang_info){
        
            $target_lang = $target_lang_info['target_lang'];
            $lang_code = $target_lang_info['lang_code'];
            senses ($sense_bundle_id, $target_lang, $lang_code);
        
          }//foreach
          scns ($sense_bundle_id);
          example_bundle_output($sense_bundle_id);
          images($sense_bundle_id);
          videos($sense_bundle_id);
  
          
          foreach ($source_langs_info as $source_lang_info){      
            $source_lang = $source_lang_info['source_lang'];
            $lang_code = $source_lang_info['lang_code'];
            comments($sense_bundle_id, $lang_code);
          }// foreach 
  
  
          foreach ($target_langs_info as $target_lang_info){      
            $target_lang = $target_lang_info['target_lang'];
            $lang_code = $target_lang_info['lang_code'];
            comments($sense_bundle_id, $lang_code);
          }// foreach 
  
          foreach ($target_langs_info as $target_lang_info){
            $target_lang = $target_lang_info['target_lang'];
            $lang_code = $target_lang_info['lang_code'];
            sds ($sense_bundle_id, $target_lang, $lang_code);
          }// foreach 
        } // foreach   
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END // sense bundles //END
}  
//END // sense bundles function //END

// START //senses function //START
function senses ($sense_bundle_id, $target_lang, $lang_code){
        $dic_name = "";
    include ("connection.php");
    //START //senses //START
    try {
  
      $result = $link->query("SELECT * FROM senses WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY sense_id");
  
      if($result->rowCount()>0){

        $lang_code_display = $_SESSION['config_tls_'.$dic_name][$target_lang-1]['lang_code_display'];
        $is_hidden = "block";
  
        $gloss_display = $_SESSION['config_tls_'.$dic_name][$target_lang-1]['gloss'];
        $def_display = $_SESSION['config_tls_'.$dic_name][$target_lang-1]['def'];

        if($lang_code_display==0){
          $is_hidden = "none";
        }elseif($lang_code_display==1 && $gloss_display==0 && $gloss_display==0){
     $is_hidden = "none";
     
        }elseif($lang_code_display==1){
          $is_hidden = "block";
        };


        ?>
          <div class="sense_bundle tl<?php echo $target_lang;?>">
            <div id="sense_bundle_<?php echo $sense_bundle_id ?>" class="col-12 col-xl-12 p-0 d-flex bd-highlight sense_bundle2 tl<?php echo $target_lang;?>">
            <div id="lang_code_<?php echo $sense_bundle_id; ?>" class="mr-auto pl-1 pt-3 lang_code tl<?php echo $target_lang;?>" style="display:<?php echo $is_hidden;?>;">
              <?php echo "[$lang_code]"; ?>
            </div>
        <?php

  
        $gloss_display = $_SESSION['config_tls_'.$dic_name][$target_lang-1]['gloss'];
        $is_hidden = "";
          if($gloss_display==0){
            $is_hidden = "none";
            }elseif($gloss_display==1){
            $is_hidden = "block";
          };



        ?>



            <div class="ml-auto d-flex p-2">
              <div id="gloss_<?php echo $sense_bundle_id ?>" class="ml-auto p-2 mr-4 gloss tl<?php echo $target_lang;?>" style="display:<?php echo $is_hidden;?>;">
  
                <?php
  
                $gloss_array = glosses($sense_bundle_id, $lang_code);
                $glosses = implode(",&nbsp", $gloss_array); 
                echo $glosses;
                
           
                ?>
              </div>
                <?php
                foreach ($result as $key => $row){    
                  $sense_id=$row["sense_id"];
                  $def= $row["def"];
                  
                          
              $def_display = $_SESSION['config_tls_'.$dic_name][$target_lang-1]['def'];
              $is_hidden = "";
              if($def_display==0){
                $is_hidden = "none";
              }elseif($def_display==1){
                $is_hidden = "block";
              };

              classes ($sense_bundle_id, $target_lang, $lang_code);
  
                ?>
              <div id="def_<?php echo $sense_id ?>" class="ml-auto def tl<?php echo $target_lang;?>" style="display:<?php echo $is_hidden;?>;">
              <b><?php echo $def;?></b>
              </div>
                <?php
                } // foreach
                ?>
              </div>
    
                <?php
       
              }else{
            //echo "A busca não retornou nenhum resultado.";
            } // if
    
              ?>
    
            </div>
          </div>
          
      <?php
        
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //senses //END
}
//END // sense function // END

//START // glosses function // START
function glosses($sense_bundle_id, $lang_code){
        $dic_name = "";
    include ("connection.php");
    //START //glosses //START
    try {
  
      $result = $link->query("SELECT * FROM glosses WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY gloss_order");
  
      $gloss_id="";
      $gloss_array = [];    
    if($result->rowCount()>0){
        foreach ($result as $key => $row){    
          $gloss_id=$row["gloss_id"];        
          $gloss_array[]= $row["gloss"];
  
        } // foreach
  
       
  
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if
      return $gloss_array;
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //glosses //END
}
//END // glosses function // END

//START // classes function //START
function classes ($sense_bundle_id, $target_lang, $lang_code){
        $dic_name = "";
    include ("connection.php");
    //START //classes //START
    
    $class_display = $_SESSION['config_tls_'.$dic_name][$target_lang-1]['class'];
    $is_hidden = "block";

    if($class_display==0){
      $is_hidden = "none";
    }elseif($class_display==1){
      $is_hidden = "block";
    };
    try {
  
      $result = $link->query("SELECT * FROM classes WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY class_id");
  
      if($result->rowCount()>0){
        $class_id="";
        ?>
        <div id="part_of_speech_bundle" class="part_of_speech p-0 align-self-end">
        <div id="part_of_speech_<?php echo $sense_bundle_id ?>" class="form-group d-flex mb-2 p-0 pr-2 bd-highlight ml-auto">
        <div class="part_of_speech tl<?php echo $target_lang;?>" style="display:<?php echo $is_hidden;?>">
        <?php
  
        foreach ($result as $key => $row){    
          $class_id=$row["class_id"];
          $class_name="";
          try {
            $result = $link->query("SELECT * FROM class_names WHERE class_id  = '$class_id' AND lang_code = '$lang_code'");
              
                  if($result->rowCount()>0){
        
                    foreach ($result as $row){
                      $class_name_id=$row["class_name_id"];
                      $class_name=$row["class_name"];
                      ?>
                      <a type="submit" class="classbtn_display" id="<?php echo $class_id;?>"><?php echo "(".$class_name.")";?>
                         </a>
              
              
                       <?php
              
                    } // foreach      
              
                    }else{
                      //echo "A busca não retornou nenhum resultado.";
                  } // if
        
                    
              } catch(PDOException $e){
                echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
            } // try
  
            } // foreach
  
            ?>
        </div>
        </div>
        </div>
        
            <?php
  
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //classes //END
}
//END // classes function // END

//START //scns function //START
function scns ($sense_bundle_id){
        $dic_name = "";
    include ("connection.php");
    //START //scn //START
    try {
  
      $result = $link->query("SELECT * FROM scns WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY scn_order");
  
      if($result->rowCount()>0){
        ?>
        <div id="scn_bundle" class="scn">
        <?php              
  
        $gloss_id="";
        $gloss_array = [];    
        foreach ($result as $key => $row){
          $scn_id=$row["scn_id"];              
          $scn= $row["scn"];
          
              ?>
            <div id="scn_<?php echo $scn_id ?>" class="d-inline-flex p-0 bd-highlight scn">
            <b><?php echo "$scn";?></b>
            </div>
              <?php
        } // foreach
  
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //scns //END
}  
//END //scns function//END

// START //sds function //START
function sds ($sense_bundle_id, $target_lang, $lang_code){
        $dic_name = "";
    include ("connection.php");
  
    //START //sds //START
    try {
  
      $result = $link->query("SELECT * FROM sds WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY sd_id");
      
      if($result->rowCount()>0){

          
                          
        $sd_display = $_SESSION['config_tls_'.$dic_name][$target_lang-1]['semantic'];
        $is_hidden = "";
        if($sd_display==0){
          $is_hidden = "none";
        }elseif($sd_display==1){
          $is_hidden = "block";
        };

                ?>
        <div id="sd_bundle" class="sd mt-2" style="display: true;">
          <div id="sd_panel" class="form-group d-flex flex-row-reverse pr-2 bd-highlight sd">
          <div class="sd_div tl<?php echo $target_lang ?>" style="display:<?php echo $is_hidden;?>;">
            <?php
  
        foreach ($result as $key => $row){    
          
          $sd_id=$row["sd_id"];
          try {
            $result = $link->query("SELECT * FROM sd_names WHERE sd_id  = '$sd_id' AND lang_code = '$lang_code'");
              
                  if($result->rowCount()>0){
        
                    foreach ($result as $row){
        
                      $sd_name_id=$row["sd_name_id"];
                      $sd_name=$row["sd_name"];
                      
            ?>
            
            <input type="submit" id="<?php echo $sd_id; ?>"  style="min-width:2.3em; width:auto; min-height:2em; height: auto;" class="btn btn-primary btn-xs sembtn_display" value='<?php echo $sd_name; ?>'>
            <?php
  
                  } // foreach     
              
        ?>
         

        <?php
                    }else{
                      //echo "A busca não retornou nenhum resultado.";
                  } // if
        
                    
              } catch(PDOException $e){
                echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
            } // try
              } // foreach
        ?>
         </div>
          </div>
        </div>
        <?php
  
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //sds //END
}
//END // sds function // END

//START //example_bundle_output function  //START
function example_bundle_output ($sense_bundle_id){
        $dic_name = "";
    include ("connection.php");
    //START //example_bundles //START
    try {
  
      $result = $link->query("SELECT * FROM example_bundles WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY example_bundle_id");
  
      if($result->rowCount()>0){
        foreach ($result as $key => $row){
          $example_bundle_id=$row["example_bundle_id"];
          $source_langs_info = $_SESSION['config_sls_'.$dic_name];
          foreach($source_langs_info as $source_lang_info){
            $index = $source_lang_info['index'];
            $source_lang = $source_lang_info['source_lang']; 
            $lang_code = $source_lang_info['lang_code']; 
            ?>
            <div class="example_bundle sl<?php echo $source_lang;?>">
            <?php
            $new=0;
        
              example_vernacular($example_bundle_id, $lang_code, $source_lang, $new);
    
            ?>
    
            </div>

             <?php
    
          }//foreach
          
          ?>

  <div>
                <?php
                
              $target_langs_info = $_SESSION['config_tls_'.$dic_name];
              foreach($target_langs_info as $target_lang_info){
                $index = $target_lang_info['index'];
                $target_lang = $target_lang_info['target_lang']; 
                $lang_code = $target_lang_info['lang_code'];
                example_translation($example_bundle_id, $lang_code, $target_lang);
              
              }

              ?>
              </div>
            
              
              <?php


          } // foreach
    
        
        }else{
            //echo "A busca não retornou nenhum resultado.";
        } // if
      } catch(PDOException $e){
        echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
      } // try      
      //END //example_bundles //END
}
//END //example_bundle_output function//END

//START //example_vernacular function  //START
function example_vernacular ($example_bundle_id, $lang_code, $source_lang, $new){
        $dic_name = "";
    include ("connection.php");
    //START //examples //START
    try {
  
      $result = $link->query("SELECT * FROM examples WHERE example_bundle_id  = '$example_bundle_id' AND lang_code='$lang_code' ORDER BY example_id");
  
      if($result->rowCount()>0){
        foreach ($result as $key => $row){
          $example_id=$row["example_id"];                    
          $ex_vernacular=$row["vernacular"];
          $lang_code_display = $_SESSION['config_sls_'.$dic_name][$source_lang-1]['lang_code_display'];
          $example_display = $_SESSION['config_sls_'.$dic_name][$source_lang-1]['example'];
          $is_hidden = "block";
    
          if($lang_code_display==0){
            $is_hidden = "none";
          }elseif($lang_code_display==1 && $example_display == 0){
            $is_hidden = "none";
          }elseif($lang_code_display==1){
            $is_hidden = "block";
          };
          ?>
          
        <div class="sl<?php echo $source_lang; ?>">
          <div class="d-flex flex-wrap">
            <div id="lang_code_<?php echo $example_id; ?>" class="mr-auto pl-1 lang_code sl<?php echo $source_lang; ?>" style="display:<?php echo $is_hidden;?>;">
                  <?php echo "[$lang_code]"; ?>
            </div>

        <?php
          $example_display = $_SESSION['config_sls_'.$dic_name][$source_lang-1]['example'];
          $is_hidden = "";
          if($example_display==0){
            $is_hidden = "none";
          }elseif($example_display==1){
            $is_hidden = "block";
          };


        ?>

            <div id="example_<?php echo $example_id; ?>" class="d-flex ml-auto pr-2 bd-highlight example sl<?php echo $source_lang;?>" style="display:<?php echo $is_hidden;?>;">
              
            <div class="ex_vernacular"><?php echo $ex_vernacular; ?>
              </div>
              <?php

              example_prons($example_id, $lang_code, $source_lang);

       
  
                ?>
                
            </div>
          </div>
            <div class="d-flex flex-row-reverse">
            <?php

              example_phonetic($example_id, $lang_code, $source_lang);



  ?>
            </div>

          </div>
          <?php
        } // foreach     
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //examples //END
}
//END //example_vernacular function//END

//START //example_prons function  //START

function example_prons($example_id, $lang_code, $source_lang){
      $dic_name = "";
    include ("connection.php");
  //START //example_prons //START
  try {
  
    $result = $link->query("SELECT * FROM example_prons WHERE example_id  = '$example_id' ORDER BY example_id");

    if($result->rowCount()>0){
      foreach ($result as $key => $row){
        $example_pron_id=$row["example_pron_id"];                    
        $ex_phonetic=$row["phonetic"];                    
        $wav=$row["wav"];
        $mp3=$row["mp3"];
        $mp4=$row["mp4"];
        $wma=$row["wma"];

        
        $example_audio_display = $_SESSION['config_sls_'.$dic_name][$source_lang-1]['example_audio'];
        $is_hidden = "";
        if($example_audio_display==0){
          $is_hidden = "none";
        }elseif($example_audio_display==1){
          $is_hidden = "block";
        };
        ?>
     <div class="example_audio sl<?php echo $source_lang ?>" style="display:<?php echo $is_hidden;?>">
      <button id="ex_audio_<?php echo $example_id;?>" type="button"  audio="assets/audio/<?php echo $wav;?>" class='btn btn-default btn-sm d-inline-flex p-0 btnex sl<?php echo $source_lang;?>'>
          <span class="material-icons md-18">volume_up</span>
      </button>
     </div>
      <audio controls hidden id="control_ex_audio_<?php echo $example_id;?>">
          <source id="<?php echo $example_id;?>_wav" src="assets/audio/<?php echo $wav?>" type="audio/wav">
          <source id="<?php echo $example_id;?>_mp3" src="assets/audio/<?php echo $mp3?>" type="audio/mpeg">
            <!-- 
          <source id="<?php echo $example_id;?>_ogg" src="#" type="audio/ogg">
            -->
      </audio> 
 
    <?php


  }// foreach

  }//if

  } catch(PDOException $e){
  echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
  } // try

}


function example_phonetic($example_id, $lang_code, $source_lang){
  $dic_name = "";
  include ("connection.php");
  //START //example_prons //START
  try {

  $result = $link->query("SELECT * FROM example_prons WHERE example_id  = '$example_id' ORDER BY example_id");

  if($result->rowCount()>0){
    foreach ($result as $key => $row){
      $example_pron_id=$row["example_pron_id"];                    
      $ex_phonetic=$row["phonetic"];                    
      $wav=$row["wav"];
      $mp3=$row["mp3"];
      $mp4=$row["mp4"];
      $wma=$row["wma"];

  
  if(!empty($ex_phonetic)){
  $example_phonetic_display = $_SESSION['config_sls_'.$dic_name][$source_lang-1]['example_phonetic'];
  $is_hidden = "";
  if($example_phonetic_display==0){
    $is_hidden = "none";
  }elseif($example_phonetic_display==1){
    $is_hidden = "block";
  };
  ?>


  <div class="example_phonetic sl<?php echo $source_lang ?>" style="display:<?php echo $is_hidden;?>">
      <div class="d-flex ml-auto pr-4 ex_phonetic"><?php echo $ex_phonetic; ?>
      </div>
    </div>
  <?php
  }else{
  }//if !empty $ex_phonetic

  }// foreach

  }//if

  } catch(PDOException $e){
  echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
  } // try

}


//START //example_translation function  //START
function example_translation ($example_bundle_id, $lang_code, $target_lang){
        $dic_name = "";
    include ("connection.php");
    //START //translations //START
    try {
  
      $result = $link->query("SELECT * FROM translations WHERE example_bundle_id  = '$example_bundle_id' AND lang_code='$lang_code' ORDER BY translation_id");
  
      if($result->rowCount()>0){
        foreach ($result as $key => $row){
          $translation_id=$row["translation_id"];                   
          $translation=$row["translation"];
          $lang_code_display = $_SESSION['config_tls_'.$dic_name][$target_lang-1]['lang_code_display'];
          $example_translation_display = $_SESSION['config_tls_'.$dic_name][$target_lang-1]['example_translation'];
          $is_hidden = "block";
    
          if($lang_code_display==0){
            $is_hidden = "none";
          }elseif($lang_code_display==1 && $example_translation_display==0){
            $is_hidden = "none";
          }elseif($lang_code_display==1){
            $is_hidden = "block";
          };
                     
          ?>
          <div class="d-flex flex-wrap pb-2">
            <div id="lang_code_<?php echo $translation_id; ?>" class="mr-auto pl-1 lang_code tl<?php echo $target_lang;?>" style="display:<?php echo $is_hidden;?>">
                <?php echo "[$lang_code]"; ?>
            </div>
            <?php
                $example_translation_display = $_SESSION['config_tls_'.$dic_name][$target_lang-1]['example_translation'];
                $is_hidden = "";
                if($example_translation_display==0){
                  $is_hidden = "none";
                }elseif($example_translation_display==1){
                  $is_hidden = "block";
                };
            ?>
            <div id="translation_<?php echo $translation_id ?>" class="ml-auto pr-4 translation tl<?php echo $target_lang ?>" style="display:<?php echo $is_hidden;?>">
                <?php echo "$translation";?>
            </div>
          </div>
          <?php
        } // foreach
  
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //translations //END
}
//END //example_tranlation function//END

//START //images function //START
function images ($sense_bundle_id){
        $dic_name = "";
    include ("connection.php");
    //START //images //START
    try {
  
      $result = $link->query("SELECT * FROM images WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY image_id");
  
      if($result->rowCount()>0){
        ?>  
        <div id="image_panel" class="image pb-1">
          <div id="image_panel_<?php echo $sense_bundle_id ?>" class="d-flex justify-content-around p-0 bd-highlight image_panel">
        <?php                  
        foreach ($result as $key => $row){
          $image_id=$row["image_id"];                          
          $jpg= $row["jpg"];
  
             ?>
            <a class="image-popup-vertical-fit" href="assets/image/<?php echo $jpg;?>" title="">
            <img src="assets/image/<?php echo $jpg;?>" id="image_<?php echo $image_id; ?>" class="img rounded" width="200" height="auto" alt="...">
            </a>

               <div id="image_caption_panel_<?php echo $image_id ?>" class="d-flex p-0 bd-highlight image_caption_panel">
 
              <?php
              
              image_captions($image_id);

              ?>
          
            </div>
              <?php  
        
  
        } // foreach
            ?>
          </div>
  
        </div>
          <?php  
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //images //END
}
//END //images function//END
  


function image_captions ($image_id){
      $dic_name = "";
    include ("connection.php");
  //START //image_captions //START

  ?>  
   <?php     

  $source_langs_info = $_SESSION['config_sls_'.$dic_name];
  
  foreach ($source_langs_info as $source_lang_info){
    ?>

    <?php
    $source_lang = $source_lang_info['source_lang'];
    $lang_code = $source_lang_info['lang_code'];
    try {

      $result = $link->query("SELECT * FROM image_captions WHERE image_id  = '$image_id' AND lang_code = '$lang_code'");
                  
    
      if($result->rowCount()>0){
        foreach ($result as $key => $row){
          $image_caption_id=$row["image_caption_id"];                          
          $image_caption=$row["image_caption"];                          
          
             ?>
            <a class="image_caption" title=""><?php echo $image_caption;?></a>
              <?php
      
        } // foreach
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if

  } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
      } // try
  
  } // foreach   



  ?>  
   <?php     

  $target_langs_info = $_SESSION['config_tls_'.$dic_name];
  
  foreach ($target_langs_info as $target_lang_info){
    ?>

    <?php
    $target_lang = $target_lang_info['target_lang'];
    $lang_code = $target_lang_info['lang_code'];
    try {

      $result = $link->query("SELECT * FROM image_captions WHERE image_id  = '$image_id' AND lang_code = '$lang_code'");
                  
    
      if($result->rowCount()>0){
        foreach ($result as $key => $row){
          $image_caption_id=$row["image_caption_id"];                          
          $image_caption=$row["image_caption"];                          
          
             ?>
            <a class="image_caption" title=""><?php echo $image_caption;?></a>
              <?php
      
        } // foreach
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if

  } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
      } // try
  
  } // foreach   

      //END //image_captions //END
}
//END //images function//END


//START //videos function //START
function videos ($sense_bundle_id){
        $dic_name = "";
    include ("connection.php");
    //START //videos //START
    try {
  
      $result = $link->query("SELECT * FROM videos WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY video_id");
      ?>

      <div  class="d-flex justify-content-around">

      <?php

      if($result->rowCount()>0){
        foreach ($result as $key => $row){
          $video_id=$row["video_id"];
          $ogv= $row["ogv"];        
          $mp4= $row["mp4"];        
            ?>
              <button id="video_btn_<?php echo $video_id;?>" type="button"  video="assets/video/<?php echo $mp4;?>" class='btn btn-default btn-sm d-inline-flex p-0 btn_video'>
          <span class="material-icons md-18">movie</span>
      </button>
            <video
                id="video_player_<?php echo $video_id;?>"
                class="video-js vjs-big-play-centered vjs-hidden"
                controls
                preload="auto"
                width="0"
                height="0"
                poster=""
                data-setup="{}"
                
                
                
              >

                <source src="assets/video/<?php echo $mp4;?>" />
  <!--                <source src="assets/video/<?php echo "$ogv";?>" type="video/ogv" />-->
                <p class="vjs-no-js">
                  To view this video please enable JavaScript, and consider upgrading to a
                  web browser that
                  <a href="https://videojs.com/html5-video-support/" target="_blank"
                    >supports HTML5 video</a>
                </p>
              </video>
      <script type="text/javascript">

        $(document).on('fullscreenchange', function()      {
  
          var is_full = document.fullscreenElement;
          if(is_full === null ){
            console.log('Element: exited fullscreen mode.');
            $('.video-js').addClass('vjs-hidden');
            $('video').each(function() {
                   $(this).get(0).pause();
            });
          }else{
            console.log('Element: entered fullscreen mode.');
          }
            
  });
        
          $('#video_btn_<?php echo $video_id;?>').click(function(e) {
              e.preventDefault();
              //$('#video_player_<?php echo $video_id;?>').removeAttr('hidden');
              var video_player = videojs('video_player_<?php echo $video_id;?>');
              video_player.play(); 
              
             $('#video_player_<?php echo $video_id;?> .vjs-fullscreen-control').click();
             $('#video_player_<?php echo $video_id;?>').removeClass('vjs-hidden');
             
 
              //video_player.enterFullWindow();
              
          });
       
      </script>
        <!--    <p id="<?php echo $video_id; ?>" class="list-group-item list-group-item-action"><b><?php echo "$mp4";?></b></p>              
           --> <?php
        } // foreach
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if

      ?>
      </div>

      <?php
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //videos //END
}    
//END //videos function//END

//START //comments function //START
function comments ($sense_bundle_id, $lang_code){
        $dic_name = "";
    include ("connection.php");
    //START //comments //START
    try {
  
      $result = $link->query("SELECT * FROM comments WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY comment_order");
  
      if($result->rowCount()>0){
        foreach ($result as $key => $row){
          $comment_id=$row["comment_id"];    
          $comment= $row["comment"];
          ?>
        <div id="comment_<?php echo $comment_id;?>" class="d-inline-flex p-0 bd-highlight comment <?php echo $lang_code ?>">
        <b><?php echo "$comment";?></b><span><small><?php echo "[$lang_code]"; ?></small></span>
        </div>        
          <?php
        } // foreach
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    }
    //END //comments //END
}   
//END //comments function//END
//END //Part 2 - Sense//END


// CALL FUNCTIONS TO PANEL SEARCH //

function entry_output($entry_bundle_id, $mode){

      $dic_name = "";
    include ("connection.php");
  try {

    $result = $link->query("SELECT * FROM entries WHERE entry_bundle_id  = '$entry_bundle_id' ORDER BY entry_bundle_id");

    if($result->rowCount()>0){
      foreach ($result as $key => $row){
        $entry_id=$row["entry_id"];    

        ?>
   <div id="entry_bundle_id" display_mode="<?php echo $mode;?>" entry_bundle_id="<?php echo $entry_bundle_id;?>" hidden></div>

        <?php
        
        form_bundle_output($entry_id, $mode);
        
        sense_bundle_output($entry_id);
        
      } // foreach
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
  } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
  }

  ?>

  <script type='text/javascript' src="js/sound.js"></script>
  <script type='text/javascript' src="js/image.js"></script>
  <!--<script type='text/javascript' src="js/entry_display_check.js"></script>
  <script type='text/javascript' src="js/panel_search.js"></script>
  <script type='text/javascript' src="js/panel.js"></script>-->

  <?php
}



    ?>