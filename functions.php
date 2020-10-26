<?php

       
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
    $dic_name = "";
    include ("connection.php");



function entry_output_edit($entry_bundle_id){

      $dic_name = "";
    include ("connection.php");
  try {

    $result = $link->query("SELECT * FROM entries WHERE entry_bundle_id  = '$entry_bundle_id' ORDER BY entry_bundle_id");
    $number_of_items=0;
    if($result->rowCount()>0){
      foreach ($result as $key => $row){
        $entry_id=$row["entry_id"];    
        $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);



          $entry_order=$row["entry_order"];    

        ?>
    <!--
                        <div id="entry_bundle_<?php echo $entry_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight entry_bundle">
                        <div id="entry_field_tag_<?php echo $entry_id; ?>" class="field_tag ml-auto">
                            <small>entrada/sub-entrada [<?php echo $entry_id; ?>]</small>
                            </div>
                            <div>
                                <button items="<?php echo $number_of_items; ?>" id='add_subentry_<?php echo $entry_bundle_id; ?>' entry_ref="<?php echo $entry_ref; ?>"  entry_id="<?php echo $entry_id; ?>" type="button"  class='btn btn-default btn-sm p-0 add_entry'>
                                <span class="material-icons md-18">add_box</span>
                                </button>
                            </div>
                            <div>
                            <button id='del_subentry_<?php echo $entry_id; ?>' items="<?php echo $number_of_items; ?>" entry_id="<?php echo $entry_id; ?>" entry_order="<?php echo $entry_order; ?>" entry_ref="<?php echo $entry_ref; ?>" type="button" class='btn btn-default btn-sm p-0 del_entry'>
                                <span class="material-icons md-18">delete</span>
                                </button>
                                </div>
                        </div>
      -->
                        <div id="form_bundle_all_<?php echo $entry_id; ?>" class="form_bundle_all">

                        <?php



                        form_bundle_output_edit($entry_id);

                        ?>
                        </div>
                        <div id="sense_bundle_all_<?php echo $entry_id; ?>" class="sense_bundle_all">

                        <?php

                        sense_bundle_output_edit($entry_id);
                        ?>
                        </div>
                        <?php

                        ?>
                  
  <?php
          $number_of_items++;
          } // foreach
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if
      } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
      }
  

}

//START // function form_bundle_output //START
function form_bundle_output_edit($entry_id){
        $dic_name = "";
    include ("connection.php");    
    //START //form bundles //START
    try {
  
      $result = $link->query("SELECT * FROM form_bundles WHERE entry_id  = '$entry_id'");
  
      if($result->rowCount()>0){
        
        foreach ($result as $key => $row){    
  
          $form_bundle_id=$row["form_bundle_id"];
          $entry_ref_first= $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

          $source_langs_info = $_SESSION['config_sls_'.$dic_name];
          ?>
          <!--<div id="entry_<?php echo $entry_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight entry">
          <div id="form_bundle_field_tag_<?php echo $form_bundle_id; ?>" class="ml-auto field_tag">
                 <small>conjunto de formas [<?php echo $entry_id; ?>]</small>
                 </div>
                     <div>
                     <button id='add_form_bundle_<?php echo $entry_id; ?>' items="̀1" entry_id="<?php echo $entry_id; ?>" type="button"  class='btn btn-default btn-sm p-0 add_entry add_box'>
                     <span class="material-icons md-18">add_box</span>
                     </button>
                 </div>
                 <div>
                 <button id='del_form_bundle_<?php echo $form_bundle_id; ?>' form_bundle_id="<?php echo $form_bundle_id; ?>" items="̀1" entry_id="<?php echo $entry_id; ?>" type="button" class='btn btn-default btn-sm p-0 del_entry delete'>
                     <span class="material-icons md-18">delete</span>
                     </button>
                     </div>
             </div>
        -->

     <?php

          foreach ($source_langs_info as $source_lang_info){
            $source_lang = $source_lang_info['source_lang'];
            $lang_code = $source_lang_info['lang_code'];
            vernacular_edit($entry_id, $form_bundle_id, $source_lang, $lang_code, $entry_ref);
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
function vernacular_edit($entry_id, $form_bundle_id, $source_lang, $lang_code, $entry_ref){
        $dic_name = "";
    include ("connection.php");  
    //START //forms //START
    try {
  
      $result = $link->query("SELECT * FROM forms WHERE form_bundle_id  = '$form_bundle_id' AND lang_code = '$lang_code' ORDER BY form_id");
  
      if($result->rowCount()>0){
        ?>
        <div id="form_bundle_sl<?php echo $source_lang; ?>" class="form_bundle sl<?php echo $source_lang; ?>">
  
        <?php
         $number_of_items = 1;

        foreach ($result as $key => $row){    
              $form_id=$row["form_id"];
              $vernacular= $row["vernacular"];
              $form_order= $row["form_order"];
              //$entry_ref= $row["entry_ref"];
          ?>




          <div id="form_bundle_<?php echo $form_id; ?>" class="col-12 col-xl-12 d-flex flex-column p-0 bd-highlight form_bundle sl<?php echo $source_lang; ?>">
          <div class="pb-1">
          <div id="vernacular_bundle_<?php echo $form_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight form_bundle sl<?php echo $source_lang; ?>">
          <div id="vernacular_field_tag_<?php echo $form_bundle_id; ?>" class="ml-auto field_tag sl<?php echo $source_lang; ?>">
                <small>forma vernácula <?php echo "[$lang_code]"; ?></small>
          </div>
        
        <div>
          <button items="<?php echo $number_of_items; ?>" id='add_form_<?php echo $form_bundle_id; ?>_<?php echo $lang_code; ?>_<?php echo $number_of_items ?>' entry_id="<?php echo $entry_id; ?>" entry_ref="<?php echo $entry_ref; ?>" source_lang="<?php echo $source_lang; ?>" form_bundle_id="<?php echo $form_bundle_id; ?>" form_id="<?php echo $form_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button"  class='btn btn-default btn-sm p-0 add_form'>
                <span class="material-icons md-18">add_box</span>
              </button>
          </div>
        
         </div>
          <div id="vernacular_bundle_<?php echo $form_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight form_bundle sl<?php echo $source_lang; ?>">

          <input id="vernacular_input_<?php echo $form_id; ?>" first="1" lang_code="<?php echo $lang_code; ?>" form_order='<?php echo $form_order; ?>' form_bundle_id='<?php echo $form_bundle_id; ?>' form_id='<?php echo $form_id; ?>' class="form-control form-control-sm ml-auto vernacular"  type="text" value="<?php echo $vernacular;?>" >
          

          <div class="">
          <button id='del_form_<?php echo $form_id; ?>' items="<?php echo $number_of_items; ?>" entry_id="<?php echo $entry_id; ?>" entry_ref="<?php echo $entry_ref; ?>" source_lang="<?php echo $source_lang; ?>" form_id="<?php echo $form_id; ?>" form_order="<?php echo $form_order; ?>" form_bundle_id="<?php echo $form_bundle_id; ?>"  lang_code="<?php echo $lang_code; ?>" type="button" class='btn btn-default btn-sm p-0 del_form'>
                <span class="material-icons md-18">delete</span>
              </button>
        </div>
        </div>
        </div>
          <div id="phonemic_div_<?php echo $form_id; ?>_<?php echo $lang_code; ?>">
          <?php              
              phonemic_edit($entry_id, $form_bundle_id, $form_id, $source_lang, $lang_code, $entry_ref);
          
              ?>  
          </div>
            </div>
              <script>

              $('#del_form_<?php echo $form_id; ?>').on('click', function(){
                var lang_code = $(this).attr('lang_code');
                var source_lang = $(this).attr('source_lang');
                var form_bundle_id =$(this).attr('form_bundle_id');
                var form_id = $(this).attr('form_id');
                
                //var select = document.getElementById('product_id');
              //var index = $('#example').selectedIndex;
              //var given_text = index.options[index].value;
                          //            console.log(search);
                //var form_id = $(this).attr('form_id');
                var add_form_id = "#add_form_".concat(form_id);
                var items = $(add_form_id).attr('items');
                var del_form = 1;
                //var restore_form = 1;
                var entry_id = $(this).attr('entry_id');
                var div = "#form_bundle_all_".concat(entry_id);
                  //var div = "#form_div_".concat(form_id).concat("_").concat(lang_code);
                var items_new = (parseInt(items))-1;
                $(add_form_id).attr('items', items_new);

              
                $.ajax({
                    url:'edit_form.php',
                    data:{form_id:form_id, form_bundle_id:form_bundle_id, lang_code:lang_code, source_lang:source_lang, del_form:del_form},
                    type: 'POST',
                    success: function(data){
                        if(!data.error){
                            $(div).html(data);
                
                        }
                    }
                    
                
                  })
              
            /*      
                $.ajax({
                  url:'modal_update.php',
                  data:{bundle:bundle, lang_code:lang_code, form_id:form_id, form_order:items_new, restore_form:restore_form},
                  type: 'POST',
                  success: function(data){
                      if(!data.error){
                          $('#modal_form_panel').html(data);

                      }
                  }
                  



              })

            */

              
            })

                $('#vernacular_input_<?php echo $form_id; ?>').keyup(function(){
                var lang_code = $(this).attr('lang_code');
                var form_bundle_id = $(this).attr('form_bundle_id');
                var first = $(this).attr('first');
                var form = $(this).val();
                var form_id = $(this).attr('form_id');
                var form_order = $(this).attr('form_order');
                var update_form = 1;
                console.log("form input update")
                console.log(form)
                console.log(form_id)

                if(first==1){

                  console.log("form input update with bck")

                  $(this).attr('first', 0);
                  var bck_vernacular_form = 1;
                  $.ajax({
                  url:'edit_form.php',
                  data:{form_id:form_id, form:form, update_form:update_form, bck_vernacular_form:bck_vernacular_form},
                  type: 'POST',
                  success: function(data){
                    /*  if(!data.error){
                          $(form_div).html(data);
              
                      }*/
                  }
                  
              
                })
              
                }else{

                  console.log("form input update without bck")
                          $.ajax({
                              url:'edit_form.php',
                              data:{form_id:form_id, form:form, update_form:update_form},
                              type: 'POST',
                              success: function(data){
                                /*  if(!data.error){
                                      $(form_div).html(data);
                          
                                  }*/
                              }
                              
                          
                            })
                          
                        
                }

                  /*
                      $.ajax({
                      url:'modal_update.php',
                      data:{bundle:bundle, lang_code:lang_code, form_id:form_id, update_form:update_form},
                      type: 'POST',
                      success: function(data){
                          if(!data.error){
                              $('#modal_form_panel').html(data);

                          }
                      }
                      



                  })

                  */

              
              })
            </script>




        <?php
        $number_of_items++;
        } // foreach   
      ?>
        </div>
      <?php
      }else{

        ?>
        <div id="form_bundle_sl<?php echo $source_lang; ?>" class="form_bundle sl<?php echo $source_lang; ?>">
  
        <?php
         $number_of_items = 1;

          ?>
          <div id="form_bundle_<?php echo $form_bundle_id; ?>_<?php echo $lang_code; ?>_<?php echo $number_of_items ?>" class="col-12 col-xl-12 d-flex flex-column p-0 bd-highlight form_bundle sl<?php echo $source_lang; ?>">
          <div class="pb-1">
          <div id="vernacular_bundle_<?php echo $form_bundle_id; ?>_<?php echo $lang_code; ?>_<?php echo $number_of_items ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight form_bundle sl<?php echo $source_lang; ?>">

          <div id="vernacular_field_tag_<?php echo $form_bundle_id; ?>" class="ml-auto field_tag sl<?php echo $source_lang; ?>">
                <small>forma vernácula <?php echo "[$lang_code]"; ?></small>
          </div>
          <div>

          <button items="<?php echo $number_of_items; ?>" id='add_form_<?php echo $form_bundle_id; ?>_<?php echo $lang_code; ?>_<?php echo $number_of_items ?>' entry_id="<?php echo $entry_id; ?>" entry_ref="<?php echo $entry_ref; ?>" source_lang="<?php echo $source_lang; ?>" form_bundle_id="<?php echo $form_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button"  class='btn btn-default btn-sm p-0 add_form'>
                <span class="material-icons md-18">add_box</span>
              </button>
          </div>
        
        
         </div>
          </div>
            </div>







            
          </div>
        <?php
        


          //echo "A busca não retornou nenhum resultado.";
      } // else

      ?>

      <script>
       

      </script>


      <?php





    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try    
      //END //forms //END      
}
//END // function vernacular // END //


//START // function phonemic_output //START
function phonemic_edit($entry_id, $form_bundle_id, $form_id, $source_lang, $lang_code, $entry_ref){
      $dic_name = "";
    include ("connection.php");
  //START //phonemic //START
  $phonemic_id = 0;
  try {

    $result = $link->query("SELECT * FROM phonemic WHERE form_id  = '$form_id' AND lang_code = '$lang_code' ORDER BY phonemic_order");

  if($result->rowCount()>0){

      foreach ($result as $key => $row){    
          $phonemic_id=$row["phonemic_id"];
          $phonemic=$row["phonemic"];
          $phonemic_order = $row['phonemic_order'];
          $lang_code=$row["lang_code"];
          $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);


              
  
          $number_of_items = $result->rowCount();

          try{

            $result2 = $link->query("SELECT * FROM phonemic_bck WHERE form_id  = '$form_bundle_id' AND lang_code = '$lang_code' ORDER BY phonemic_id");
            $number_of_items_in_modal = $result2->rowCount();

        ?>
        <div id="phonemic_bundle_main_<?php echo $phonemic_id; ?>">

        <div class="pb-1">
           <div id="phonemic_all_<?php echo $form_id ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight pron_bundle sl<?php echo $source_lang; ?>" >
          
          
           <div id="phonemic_field_tag_<?php echo $phonemic_id; ?>" class="pr-1 ml-auto field_tag sl<?php echo $source_lang; ?>">
              <small>forma fonêmica <?php echo "[$lang_code]"; ?></small>
              </div>
           <div>
           <button items="<?php echo $number_of_items; ?>" id='add_phonemic_<?php echo $form_id; ?>_<?php echo $lang_code; ?>' entry_id="<?php echo $entry_id; ?>" entry_ref="<?php echo $entry_ref; ?>" source_lang="<?php echo $source_lang; ?>" form_bundle_id="<?php echo $form_bundle_id; ?>" form_id="<?php echo $form_id; ?>" phonemic_id="<?php echo $phonemic_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button"  class='btn btn-default btn-sm p-0 add_phonemic'>
                <span class="material-icons md-18">add_box</span>
              </button> 
           </div>
           <div class="<?php if($number_of_items_in_modal == 0){ echo "d-none";}else{ } ?>">
              <button id='restore_phonemic_<?php echo $form_id; ?>' lang_code="<?php echo $lang_code; ?>" bundle="<?php echo $form_bundle_id; ?>" type="button"  class='btn btn-default btn-sm p-0' data-toggle="modal" data-target="#restore_phonemic_modal">
                <span class="material-icons md-18">restore</span>
              </button>

              <!-- Modal -->
              <div class="modal fade" id="restore_phonemic_modal" tabindex="-1" role="dialog" aria-labelledby="restore_phonemic_modal_title" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="restore_phonemic_modal_title">Recupere antigas representações fonêmicas</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body" id="modal_phonemic_panel">
                      <?php

                    if($result2->rowCount()>0){
                            foreach ($result2 as $key => $row){    
                              $phonemic_id=$row["phonemic_id"];
                              $phonemic= $row["phonemic"];
                              $phonemic_order= $row["phonemic_order"];
                              $entry_ref_first= $row["entry_ref"];
                              $pattern = array();
                              $pattern[0] = '/\'/i';
                              $pattern[1] = '/\"/i';
                              $entry_ref = preg_replace($pattern, '', $entry_ref_first);


                              ?>
                              <div class="d-flex">
                              <button class='btn btn-default btn-sm p-0 restore_phonemic' id='restore_phonemic_<?php echo $phonemic_id; ?>' phonemic_id='<?php echo $phonemic_id; ?>' lang_code="<?php echo $lang_code; ?>" bundle="<?php echo $form_id; ?>" type="button">
                                  <span class="material-icons md-18">restore</span>
                              </button>
                              <div id="phonemic_<?php echo $form_id; ?>" class="mr-auto mr-4 phonemic tl<?php echo $source_lang;?>">
                              <?php echo $phonemic; ?>
                              </div>
                              </div>
                              <?php
                  
                            }//foreach

                    }//if
                                      
                  } catch(PDOException $e){
                  echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                  } // try
                      ?>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                  </div>
              </div>
              </div>
              <!--<script type='text/javascript' src="js/restore_phonemic.js"></script>
                -->


              </div>


              </div>

                <div id="phonemic_bundle_<?php echo $phonemic_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight phonemic_bundle sl<?php echo $source_lang; ?>">

                <div class="ml-auto">
                <input id="phonemic_input_<?php echo $phonemic_id; ?>" first="1" class="form-control form-control-sm  phonemic_input" phonemic_id="<?php echo $phonemic_id; ?>" type="text" bundle="<?php echo $form_id; ?>" lang_code="<?php echo $lang_code; ?>" value="<?php echo $phonemic;?>" >
                </div>

              <?php
              $phonemic_items = $result->rowCount();
              $item_count=0;
              if($phonemic_items<2){
                ?>
                <div class="d-flex">
              <button id='del_phonemic' items="<?php echo $number_of_items; ?>" entry_id="<?php echo $entry_id; ?>" entry_ref="<?php echo $entry_ref; ?>" source_lang="<?php echo $source_lang; ?>" form_id="<?php echo $form_id; ?>" phonemic_order="<?php echo $phonemic_order; ?>" form_bundle_id="<?php echo $form_bundle_id; ?>"  lang_code="<?php echo $lang_code; ?>" type="button"  phonemic_id="<?php echo $phonemic_id; ?>" class='btn btn-default btn-sm p-0 del_phonemic'>
                <span class="material-icons md-18">delete</span>
              </button>

                    </div>




                <?php
          }//if($phonemic_items==1 || $phonemic_items==0)
          elseif($phonemic_items>=2){
                  
                ?>
                <div class="d-flex">
                <button id='del_phonemic' items="<?php echo $number_of_items; ?>" entry_ref="<?php echo $entry_ref; ?>" entry_id="<?php echo $entry_id; ?>" source_lang="<?php echo $source_lang; ?>" form_id="<?php echo $form_id; ?>" phonemic_order="<?php echo $phonemic_order; ?>" form_bundle_id="<?php echo $form_bundle_id; ?>"  lang_code="<?php echo $lang_code; ?>" type="button"  phonemic_id="<?php echo $phonemic_id; ?>" class='btn btn-default btn-sm p-0 del_phonemic'>
                <span class="material-icons md-18">delete</span>
              </button>
              
              <?php
              /*
                  $item_count= $item_count+1;
                  if($item_count==1){
                      ?>
              <button id='down_phonemic_<?php echo $phonemic_id; ?>' type="button" bundle="<?php echo $form_id; ?>" lang_code="<?php echo $lang_code; ?>" phonemic_id="<?php echo $phonemic_id; ?>" class='btn btn-default btn-sm p-0 down_phonemic'>
                <span class="material-icons md-18">arrow_downward</span>
              </button>
              <?php

                  }else{
                      if($item_count==$phonemic_items){

                          ?>
                          <button id='up_phonemic_<?php echo $phonemic_id; ?>' type="button" bundle="<?php echo $form_id; ?>" lang_code="<?php echo $lang_code; ?>" phonemic_id="<?php echo $phonemic_id; ?>" class='btn btn-default btn-sm p-0 up_phonemic'>
                            <span class="material-icons md-18">arrow_upward</span>
                          </button>
                          <?php
          
                          
                      }else{

                          ?>
              <button id='down_phonemic_<?php echo $form_bundle_id; ?>_<?php echo $lang_code; ?>' type="button" bundle="<?php echo $form_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" phonemic_id="<?php echo $phonemic_id; ?>" class='btn btn-default btn-sm p-0 down_phonemic'>
                <span class="material-icons md-18">arrow_downward</span>
              </button>
                          <button id='up_phonemic_<?php echo $form_bundle_id; ?>_<?php echo $lang_code; ?>' type="button" bundle="<?php echo $form_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" phonemic_id="<?php echo $phonemic_id; ?>" class='btn btn-default btn-sm p-0 up_phonemic'>
                            <span class="material-icons md-18">arrow_upward</span>
                          </button>
                          <?php
          
                      }

                

                  }
*/
                  ?>
                     </div>
 
 
                   <?php
          ?>

                <?php
          }//elseif
        
          ?>
             </div>
            <div id="phonetic_div_<?php echo $phonemic_id; ?>">
                    <?php

          phonetic_edit($entry_id, $form_bundle_id, $phonemic_id, $source_lang, $lang_code, $entry_ref);

              ?>
            </div>
            </div>
            </div> 


    <?php
      } // foreach


  }else{

    $phonemic_order = 0;
    $number_of_items = 0;
    try{

      $result2 = $link->query("SELECT * FROM phonemic_bck WHERE form_id  = '$form_id' AND lang_code = '$lang_code' ORDER BY phonemic_id");

      $number_of_items_in_modal=$result2->rowCount();
  ?>
  <div id="phonemic_bundle_main_<?php echo $form_id; ?>">

  <div class="pb-1">
     <div id="phonemic_all_<?php echo $form_id ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight pron_bundle sl<?php echo $source_lang; ?>" >
     <div id="phonemic_field_tag_<?php echo $phonemic_id; ?>" class="ml-auto field_tag sl<?php echo $source_lang; ?>">
              <small>forma fonêmica <?php echo "[$lang_code]"; ?></small>
              </div>
      
       <div>
          <button items="<?php echo $number_of_items; ?>" id='add_phonemic_<?php echo $form_id; ?>_<?php echo $lang_code; ?>' entry_id="<?php echo $entry_id; ?>" entry_ref="<?php echo $entry_ref; ?>" source_lang="<?php echo $source_lang; ?>" form_bundle_id="<?php echo $form_bundle_id; ?>" form_id="<?php echo $form_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button"  class='btn btn-default btn-sm p-0 add_phonemic'>
              <span class="material-icons md-18">add_box</span>
            </button> 
          </div>
        <div>
        <button id='restore_phonemic_<?php echo $form_id; ?>' lang_code="<?php echo $lang_code; ?>" bundle="<?php echo $form_bundle_id; ?>" type="button"  class='btn btn-default btn-sm p-0 <?php if($number_of_items_in_modal == 0){ echo "d-none";}else{ } ?>' data-toggle="modal" data-target="#restore_phonemic_modal_<?php echo $form_id; ?>">
          <span class="material-icons md-18">restore</span>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="restore_phonemic_modal_<?php echo $form_id; ?>" tabindex="-1" role="dialog" aria-labelledby="restore_phonemic_modal_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restore_phonemic_modal_title">Recupere antigas representações fonêmicas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal_phonemic_panel">
                <?php
              if($result2->rowCount()>0){
                      foreach ($result2 as $key => $row){    
                        $phonemic_id=$row["phonemic_id"];
                        $phonemic= $row["phonemic"];
                        $phonemic_order= $row["phonemic_order"];
                        $entry_ref_first= $row["entry_ref"];
                        $pattern = array();
                        $pattern[0] = '/\'/i';
                        $pattern[1] = '/\"/i';
                        $entry_ref = preg_replace($pattern, '', $entry_ref_first);
                  

                        ?>
                        <div class="d-flex">
                        <button class='btn btn-default btn-sm p-0 restore_phonemic' id='restore_phonemic_<?php echo $phonemic_id; ?>' phonemic_id='<?php echo $phonemic_id; ?>' lang_code="<?php echo $lang_code; ?>" bundle="<?php echo $form_id; ?>" type="button">
                            <span class="material-icons md-18">restore</span>
                        </button>
                        <div id="phonemic_<?php echo $form_id; ?>" class="mr-auto mr-4 phonemic tl<?php echo $source_lang;?>">
                        <?php echo $phonemic; ?>
                        </div>
                        </div>
                        <?php
            
                      }//foreach

              }//if
                                
            } catch(PDOException $e){
            echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
            } // try
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
         <!--<script type='text/javascript' src="js/restore_phonemic.js"></script>
                -->
        </div>


        </div>

  
      </div>
      </div> 

    <?php    
      //echo "A busca não retornou nenhum resultado.";
  } // if($phonemic_items>=2)

  } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
  } // try
  //END //phonemic //END

}
//END // phonemic function // END

//START // function prons //START
function phonetic_edit($entry_id, $form_bundle_id, $phonemic_id, $source_lang, $lang_code, $entry_ref){
        $dic_name = "";
    include ("connection.php");
    //START // prons //START
    try {
      $result = $link->query("SELECT * FROM phonetic WHERE phonemic_id = '$phonemic_id' ORDER BY phonetic_order");
      $count_phonetic = $result->rowCount();
      ?>

      <div id="phonetic_bundle_<?php echo $phonemic_id; ?>">
            <div class="pb-1">
              
              <div id="phonetic_<?php echo $phonemic_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight phonetic_bundle sl<?php echo $source_lang; ?>">
              <div id="phonetic_field_tag_<?php echo $phonemic_id; ?>" class="ml-auto field_tag sl<?php echo $source_lang; ?>">
              <small>formas fonéticas <?php echo "[$lang_code]"; ?></small>
              
              <button id='add_phonetic_<?php echo $phonemic_id; ?>' entry_id="<?php echo $entry_id; ?>" form_bundle_id="<?php echo $form_bundle_id; ?>" items="<?php echo $count_phonetic; ?>" lang_code="<?php echo $lang_code; ?>" entry_ref="<?php echo $entry_ref; ?>" source_lang="<?php echo $source_lang; ?>" phonemic_id="<?php echo $phonemic_id; ?>" type="button"  class='btn btn-default btn-sm p-0 add_phonetic'>
                  <span class="material-icons md-18">add_box</span>
                </button>


              </div>



            
                </div>


        <?php
      
      if($result->rowCount()>0){

        
        foreach ($result as $key => $row){
          $entry_ref_first= $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);
          $lang_code=$row["lang_code"];
          $phonetic_id=$row["phonetic_id"];
          $phonetic=$row["phonetic"];
          $phonetic_order=$row["phonetic_order"];
          
          ?>
  
                  <div id="phonetic_bundle_<?php echo $phonetic_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight phonetic_bundle sl<?php echo $source_lang; ?>">
              
                  <input id="phonetic_input_<?php echo $phonetic_id; ?>" lang_code='<?php echo $lang_code; ?>' source_lang='<?php echo $source_lang; ?>' entry_ref='<?php echo $entry_ref; ?>' first="1" phonetic_order="<?php echo $phonetic_order; ?>" class="form-control form-control-sm ml-auto pr-1 phonetic_input" phonetic_id="<?php echo $phonetic_id; ?>" type="text" phonemic_id="<?php echo $phonemic_id; ?>" value="<?php echo $phonetic;?>" >
                  
                  <button id='del_phonetic_<?php echo $phonetic_id; ?>'  entry_id="<?php echo $entry_id; ?>" form_bundle_id="<?php echo $form_bundle_id; ?>" phonetic_id="<?php echo $phonetic_id; ?>" type="button" phonemic_id="<?php echo $phonemic_id; ?>"  lang_code='<?php echo $lang_code; ?>' source_lang='<?php echo $source_lang; ?>' entry_ref='<?php echo $entry_ref; ?>'  items="<?php echo $count_phonetic; ?>" phonetic_order="<?php echo $phonetic_order; ?>" class='btn btn-default btn-sm p-0 del_phonetic'>
                  <span class="material-icons md-18">delete</span>
                </button>
              </div>

                  <div id="pron_div_<?php echo $phonetic_id; ?>">
              <?php

              prons_edit($entry_id, $phonetic_id, $source_lang, $lang_code, $entry_ref);
            ?>
                  </div>
            <?php
        } // foreach   
      }else{

          //echo "A busca não retornou nenhum resultado.";
      } // if

      ?>
            </div>
        </div>
        
      <?php

    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br> 368?".$e->getMessage();
    } // try    
    //END //phonetic //END  
}
//END // function phonetic // END//
  
function prons_edit($entry_id, $phonetic_id, $source_lang, $lang_code, $entry_ref){
      $dic_name = "";
    include ("connection.php");
  try {
    $result = $link->query("SELECT * FROM prons WHERE phonetic_id = '$phonetic_id' ORDER BY pron_id");
    $items = $result->rowCount();
  ?>
  <div class="pb-1">
    <div id="pron_<?php echo $phonetic_id ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight pron_bundle sl<?php echo $source_lang; ?>">
    

      <div class="d-flex ml-auto">
      <div id="pron_field_tag_<?php echo $phonetic_id; ?>" class="pr-1 field_tag sl<?php echo $source_lang; ?>">
              <small>pronúncia (áudio) <?php echo "[$lang_code]"; ?></small>
              </div>

      <button id='add_pron_<?php echo $phonetic_id; ?>' phonetic_id='<?php echo $phonetic_id; ?>' entry_id="<?php echo $entry_id; ?>" entry_ref='<?php echo $entry_ref; ?>' lang_code='<?php echo $lang_code; ?>' source_lang='<?php echo $source_lang; ?>' items='<?php echo $items; ?>' type="button"  class='btn btn-default btn-sm p-0 add_pron'>
        <span class="material-icons md-18">add_box</span>
      </button>
      </div>

      </div>

  <?php
    if($result->rowCount()>0){

      
      foreach ($result as $key => $row){
        $entry_ref_first= $row["entry_ref"];
        $pattern = array();
        $pattern[0] = '/\'/i';
        $pattern[1] = '/\"/i';
        $entry_ref = preg_replace($pattern, '', $entry_ref_first);
        $lang_code=$row["lang_code"];
        $pron_id=$row["pron_id"];
        $wav=$row["wav"];
        $mp3=$row["mp3"];
        $mp4=$row["mp4"];
        $wma=$row["wma"];

        if(empty($wav) && empty($mp3) && empty($mp4) && empty($wma)){

          ?>
          <div hidden>
      <form enctype="multipart/form-data" id="form_<?php echo $pron_id;?>" method="post">
    <input id="input_<?php echo $pron_id;?>" type="file" accept=".wav, .mp3, .mp4, .wma" name="file" required="required">

    </form> 
          </div>
      <div class="col-12 col-xl-12 p-0 bd-highlight d-flex pron_bundle sl<?php echo $source_lang; ?>">
     
      <a id="pron_file_<?php echo $pron_id; ?>" class="ml-auto"><small></small></a>
        <div  id="pron_file_upload_<?php echo $pron_id; ?>" entry_id="<?php echo $entry_id; ?>" class="" ><button id='upload_pron_<?php echo $pron_id; ?>' type="button"  class='btn btn-default btn-sm p-0 upload_pron'>
        <span class="material-icons md-18">cloud_upload</span>
        </div>
        <div  id="pron_file_del_<?php echo $pron_id; ?>" class="" ><button id='del_pron_<?php echo $pron_id; ?>' type="button" entry_id="<?php echo $entry_id; ?>" pron_id='<?php echo $pron_id; ?>' phonetic_id='<?php echo $phonetic_id; ?>' entry_ref='<?php echo $entry_ref; ?>' lang_code='<?php echo $lang_code; ?>' source_lang='<?php echo $source_lang; ?>' items='<?php echo $items; ?>' class='btn btn-default btn-sm p-0 del_pron'>
        <span class="material-icons md-18">delete</span>
        </div>

      </div>
        

          <?php
           
        }else{

    ?>

        <div id="pron_bundle_<?php echo $pron_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight pron_bundle sl<?php echo $source_lang; ?>">

        <a id="pron_<?php echo $pron_id; ?>" class="pr-1 pron ml-auto"  type="text"><small><?php echo $wav?></small></a>
        <button id='del_pron_<?php echo $pron_id; ?>' type="button" entry_id="<?php echo $entry_id; ?>" pron_id='<?php echo $pron_id; ?>' phonetic_id='<?php echo $phonetic_id; ?>' entry_ref='<?php echo $entry_ref; ?>' lang_code='<?php echo $lang_code; ?>' source_lang='<?php echo $source_lang; ?>' items='<?php echo $items; ?>' class='btn btn-default btn-sm p-0 del_pron'>
        <span class="material-icons md-18">delete</span>
        
     
  <button id='btnpron_<?php echo $pron_id;?>' pron_id='<?php echo $pron_id;?>' type="button"  audio="assets/audio/<?php echo $wav?>" class='btn btn-default btn-sm btnpron d-inline-flex p-0'>
      <span class="material-icons md-18">volume_up</span>
  </button>
  <audio controls hidden id="audio_<?php echo $pron_id;?>">

  <source id="<?php echo $pron_id;?>_wav" src="assets/audio/<?php echo $wav?>" type="audio/wav">
  <source id="<?php echo $example_id;?>_mp3" src="assets/audio/<?php echo $mp3?>" type="audio/mpeg">

  <!-- <source id="<?php echo $pron_id;?>_ogg" src="#" type="audio/ogg">
  <source id="<?php echo $pron_id;?>_mp3" src="assets/audio/<?php echo $mp3?>" type="audio/mpeg">
  -->
  </audio>   
      </div>
  

    <?php
    }


    ?>
      <script>
          
          $('#btnpron_<?php echo $pron_id;?>').click(function() {
          
          
          var pron_id = $(this).attr('pron_id');
          
          var audio_id = "#audio_".concat(pron_id);
          var audio_play = $(audio_id).get(0);
          audio_play.load();
          audio_play.play();
          
          
          });
          </script>
          
      <script>
            $("#pron_file_upload_<?php echo $pron_id; ?>").click(function () {
              $("#input_<?php echo $pron_id;?>").trigger('click');
          });
          </script>

          <script type="application/javascript">
              $('#input_<?php echo $pron_id;?>').change(function(e){
                  var fileName = e.target.files[0].name;
                  //$('#pron_file_<?php echo $pron_id; ?>').html(fileName);
                  //$("#save_pron_<?php echo $pron_id; ?>").prop('disabled', false);

                  var div= "#pron_div_<?php echo $phonetic_id; ?>";
                  var formData = new FormData($("#form_<?php echo $pron_id;?>")[0]);
                  formData.append('pron_id', <?php echo $pron_id; ?>); //id is the variable that has the data that I need
                  formData.append('phonetic_id', <?php echo $phonetic_id; ?>); //id is the variable that has the data that I need
                  formData.append('source_lang', <?php echo $source_lang; ?>); //id is the variable that has the data that I need
                  formData.append('lang_code', '<?php echo $lang_code; ?>'); //id is the variable that has the data that I need
                  formData.append('entry_ref', '<?php echo $entry_ref;?>');
                  formData.append('entry_id', '<?php echo $entry_id;?>');
                  //formData.append('entry_ref', <?php echo $entry_ref; ?>); //id is the variable that has the data that I need
                  //formData.append('entry_ref', <?php echo $entry_ref; ?>); //id is the variable that has the data that I need
                  
                  $.ajax({
                      url: "edit_pron.php",
                      type: "POST",
                      data: formData,
                      contentType: false,
                      processData: false,
                      success: function (data) {
                            if(!data.error){
                            $(div).html(data);
                
                        }
                      }
                  });
              });
              
          </script>


          <script>
            
            
            $('#del_pron_<?php echo $pron_id; ?>').on('click', function(){
              //var lang_code = $(this).attr('lang_code');
              //var bundle = $(this).attr('bundle');
              //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
                        //            console.log(search);
              var lang_code = $(this).attr('lang_code');
              var entry_id=$(this).attr('entry_id');

              var entry_ref=$(this).attr('entry_ref');
              var source_lang=$(this).attr('source_lang');
              var phonetic_id = $(this).attr('phonetic_id');
              var pron_id = $(this).attr('pron_id');
              var items = $(this).attr('items');
              var add_pron_id = "#add_pron_".concat(phonetic_id);
              //var count_phonemic_bundle = $(this).attr('count_phonemic_bundle');
              //var select = document.getElementById('product_id');
              //var index = $('#pron').selectedIndex;
              //var given_text = index.options[index].value;
                          //            console.log(search);
              var div = "#pron_div_".concat(phonetic_id);
              //var items = $(add_pron_id).attr('items');
              var del_pron = 1;
              var bck_pron = 1;
              var items_new = (parseInt(items))-1;
              $(add_pron_id).attr('items', items_new);

            
            $.ajax({
                url:'edit_pron.php',
                data:{phonetic_id:phonetic_id, lang_code:lang_code, entry_ref:entry_ref, entry_id:entry_id, source_lang:source_lang, pron_id:pron_id, bck_pron:bck_pron, del_pron:del_pron},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(div).html(data);
            
                    }
                }
                
            
              })
            
            /*    
            $.ajax({
              url:'modal_update.php',
              data:{bundle:bundle, lang_code:lang_code, pron_id:pron_id, pron_order:items_new, restore_pron:restore_pron},
              type: 'POST',
              success: function(data){
                  if(!data.error){
                      $('#modal_pron_panel').html(data);

                  }
              }
              



          })

          */

            
            })

          </script>


    <?php
            } // foreach   
        }else{
           //echo "A busca não retornou nenhum resultado.";
        } // if


        ?>
        </div>

        <script>
        
        $('#add_pron_<?php echo $phonetic_id; ?>').on('click', function(){

        var lang_code = $(this).attr('lang_code');
        var entry_ref=$(this).attr('entry_ref');
        var source_lang=$(this).attr('source_lang');
        var entry_id=$(this).attr('entry_id');
          var phonetic_id = $(this).attr('phonetic_id');
        //var pron = $(this).attr('pron');
        var items = $(this).attr('items');
        //var count_phonemic_bundle = $(this).attr('count_phonemic_bundle');
        //var select = document.getElementById('product_id');
        //var index = $('#pron').selectedIndex;
        //var given_text = index.options[index].value;
                    //            console.log(search);
        var div = "#pron_div_".concat(phonetic_id);
        var add_pron = 1;
        //$(this).attr('items', items_new);
        console.log("add pron");
        console.log(div);
        console.log(phonetic_id);
        console.log(lang_code);
        console.log(entry_ref);
        console.log(source_lang);
        console.log(items);

        $.ajax({
            url:'edit_pron.php',
            data:{phonetic_id:phonetic_id, add_pron:add_pron, entry_ref:entry_ref, entry_id:entry_id, source_lang:source_lang, lang_code:lang_code, items:items},
            type: 'POST',
            success: function(data){
                if(!data.error){
                    $(div).html(data);

                }
            }
            



        })


        })



    </script>

      <?php

    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br> 438?".$e->getMessage();
    } // try    
    //END //prons //END  


}
//END // function prons // END//
//END // PART 1 - FORM // END//

// START // PART 2 - SENSE //START
// START //sense_bundle_output function //START
function sense_bundle_output_edit ($entry_id){
        $dic_name = "";
    include ("connection.php");
    //START //sense bundles //START
    try {
  
      $result = $link->query("SELECT * FROM sense_bundles WHERE entry_id  = '$entry_id'");
  
      $count_sense_bundle = 0;     

      if($result->rowCount()>0){
   
        foreach ($result as $key => $row){    
          $sense_bundle_id=$row["sense_bundle_id"];
          $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

              
  
          $target_langs_info = $_SESSION['config_tls_'.$dic_name];
          $source_langs_info = $_SESSION['config_sls_'.$dic_name];
          $count_sense_bundle = $count_sense_bundle +1;
        
          ?>
          <div id="sense_bundle_all_<?php echo $count_sense_bundle; ?>" class="sense_bundle_all_<?php echo $count_sense_bundle; ?>">
          <div id="sense_bundle_panel_<?php echo $count_sense_bundle; ?>" class="d-flex sense_bundle_all_<?php echo $count_sense_bundle; ?>">
          <div id="sense_bundle_count_field_tag_<?php echo $count_sense_bundle; ?>" class="pr-1 ml-auto field_tag">
              <small>Sentido <?php echo $count_sense_bundle; ?></small>
              </div>
                <?php

                $number_of_items = $result->rowCount();
                ?>
                <button items="<?php echo $number_of_items; ?>" id='add_sense_<?php echo $sense_bundle_id; ?>' entry_id="<?php echo $entry_id; ?>" type="button"  class='btn btn-default btn-sm p-0 add_sense'>
                  <span class="material-icons md-18">add_box</span>
                </button>
                <button items="<?php echo $number_of_items; ?>" id='del_sense_<?php echo $sense_bundle_id; ?>' bundle="<?php echo $sense_bundle_id;?>" entry_id="<?php echo $entry_id; ?>" type="button"  class='btn btn-default btn-sm p-0 del_sense'>
                  <span class="material-icons md-18">delete</span>
                </button>
                </div>
               
          <?php
                





          foreach ($target_langs_info as $target_lang_info){
        
            $target_lang = $target_lang_info['target_lang'];
            $lang_code = $target_lang_info['lang_code'];
            senses_edit ($entry_id, $sense_bundle_id, $target_lang, $lang_code, $count_sense_bundle);
        
                 }//foreach
          
          ?>
           <script>
                  
              $('#add_sense_<?php echo $sense_bundle_id; ?>').on('click', function(){

                  //var lang_code = $(this).attr('lang_code');
                  //var bundle = $(this).attr('bundle');
                  var entry_id = $(this).attr('entry_id');
                  var items = $(this).attr('items');
                  //var select = document.getElementById('product_id');
                  //var index = $('#example').selectedIndex;
                  //var given_text = index.options[index].value;
                            //            console.log(search);
                  var div = "#sense_bundle_all_".concat(entry_id);
                  var add_sense = 1;
                  //$(this).attr('items', items_new);


                  $.ajax({
                      url:'edit_sense.php',
                      data:{entry_id:entry_id, add_sense:add_sense, items:items},
                      type: 'POST',
                      success: function(data){
                          if(!data.error){
                              $(div).html(data);

                          }
                      }
                      



                  })


                  })
              </script>
              <script>

              $('#del_sense_<?php echo $sense_bundle_id; ?>').on('click', function(){
                      //var lang_code = $(this).attr('lang_code');
                      var bundle = $(this).attr('bundle');
                      //var select = document.getElementById('product_id');
                    //var index = $('#example').selectedIndex;
                    //var given_text = index.options[index].value;
                                //            console.log(search);
                      var div = "#sense_bundle_all_<?php echo $entry_id; ?>";
                      var add_sense_id = "#add_sense_"+bundle;
                      var items = $(add_sense_id).attr('items');
                      var del_sense = 1;
                      var restore_sense = 1;
                      //var sense_id = $(this).attr('sense_id');
                      var items_new = (parseInt(items))-1;
                      $(add_sense_id).attr('items', items_new);
                      console.log(items_new);
                      console.log(div);
                      console.log(items);
                      console.log(add_sense_id);
                      console.log("del_sense");
                      var entry_id = $(this).attr('entry_id');
                    
                    $.ajax({
                        url:'edit_sense.php',
                        data:{bundle:bundle, items:items, entry_id:entry_id, del_sense:del_sense},
                        type: 'POST',
                        success: function(data){
                            if(!data.error){
                                $(div).html(data);
                    
                            }
                        }
                        
                    
                      })
                    
                        /*
                    $.ajax({
                      url:'modal_update.php',
                      data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, sense_order:items_new, restore_sense:restore_sense},
                      type: 'POST',
                      success: function(data){
                          if(!data.error){
                              $('#modal_def_panel').html(data);

                          }
                      }
                      



                  })

                  */



                    
                    })

          </script>

          <?php

                    
          foreach ($target_langs_info as $target_lang_info){
        
            $target_lang = $target_lang_info['target_lang'];
            $lang_code = $target_lang_info['lang_code'];
            glosses_edit ($sense_bundle_id, $target_lang, $lang_code);
        
          }//foreach
          
          ?>
          <div id="scn_div_<?php echo $sense_bundle_id;?>">

            <?php
          scns_edit ($sense_bundle_id);
          
          ?>
          </div>
          
          <div id="class_div_<?php echo $sense_bundle_id;?>">

            <?php
          $target_langs_info = $_SESSION['config_tls_'.$dic_name];

          foreach ($target_langs_info as $target_lang_info){
        
            $target_lang = $target_lang_info['target_lang'];
            $lang_code = $target_lang_info['lang_code'];
            classes_edit ($sense_bundle_id, $target_lang, $lang_code);
        
          }//foreach
            ?>

          </div>
          
          <div id="sd_div_<?php echo $sense_bundle_id;?>">

            <?php
          
          foreach ($target_langs_info as $target_lang_info){
        
            $target_lang = $target_lang_info['target_lang'];
            $lang_code = $target_lang_info['lang_code'];
            sds_edit ($sense_bundle_id, $target_lang, $lang_code);
        
          }//foreach
            ?>
          </div>

          <div id="example_bundle_div_<?php echo $sense_bundle_id;?>">
       
            <?php

          example_bundle_output_edit($sense_bundle_id, $count_sense_bundle);
          
          ?>
          </div>
          
          <div id="image_panel_all_<?php echo $sense_bundle_id;?>" class="image">

          <?php

          images_edit($sense_bundle_id, $entry_ref);

          ?>
          </div>
          

          <div id="video_panel_all_<?php echo $sense_bundle_id;?>" class="video">

          <?php

          videos_edit($sense_bundle_id, $entry_ref);

          ?>
          </div>
        <div id="comment_panel_all_<?php echo $sense_bundle_id;?>" class="comment">
          <div id="comment_bundle_<?php echo $sense_bundle_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight comment_bundle">
      
      <div id="comment_panel_tag_<?php $sense_bundle_id; ?>" class="ml-auto pr-1 lang_code">
      <small>comentários</small>
      </div>
      <div>


      
      </div>
      </div>
      
      <div id="comment_panel_<?php echo $sense_bundle_id; ?>" class="d-flex flex-wrap col-12 col-xl-12 p-0 bd-highlight comment_panel">
            
            <?php
          comments_edit ($sense_bundle_id, $entry_ref);
  
          ?>
      </div>
        </div>
          </div>
          <?php

        } // foreach   
      }else{

        $number_of_items = 0;

        ?>          <div id="sense_bundle_all_<?php echo $count_sense_bundle; ?>" class="sense_bundle_all_<?php echo $count_sense_bundle; ?>" >
          <div id="sense_bundle_panel_<?php echo $count_sense_bundle; ?>" class="d-flex sense_bundle_all_<?php echo $count_sense_bundle; ?>">
          <div id="sense_bundle_count_field_tag_<?php echo $count_sense_bundle; ?>" class="pr-1 ml-auto field_tag">
              <small>Sentido <?php echo $count_sense_bundle; ?></small>
              </div>
              
                <button items="<?php echo $number_of_items; ?>" id='add_first_sense_<?php echo $entry_id; ?>' entry_id="<?php echo $entry_id; ?>" type="button"  class='btn btn-default btn-sm p-0 add_sense'>
                  <span class="material-icons md-18">add_box</span>
                </button>
             
                </div>
          </div>

          <script>
                  
                  $('#add_first_sense_<?php echo $entry_id; ?>').on('click', function(){
    
                      //var bundle = $(this).attr('bundle');
                      var entry_id = $(this).attr('entry_id');
                      var items = $(this).attr('items');
                      //var select = document.getElementById('product_id');
                      //var index = $('#example').selectedIndex;
                      //var given_text = index.options[index].value;
                                //            console.log(search);
                      var def_div = "#sense_bundle_all_".concat(entry_id);
                      var add_sense = 1;
                      //$(this).attr('items', items_new);
    
    
                      $.ajax({
                          url:'edit_sense.php',
                          data:{entry_id:entry_id, add_sense:add_sense, items:items},
                          type: 'POST',
                          success: function(data){
                              if(!data.error){
                                  $(def_div).html(data);
    
                              }
                          }
                          
    
    
    
                      })
    
    
                      })
                  </script>
          <?php


          //echo "A busca não retornou nenhum resultado.";
      } // if

      
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END // sense bundles //END
}  
//END // sense bundles function //END

// START //senses function //START
function senses_edit ($entry_id, $sense_bundle_id, $target_lang, $lang_code){
        $dic_name = "";
    include ("connection.php");
    //START //senses //START
    try {
  
      $result = $link->query("SELECT * FROM senses WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY sense_id");
  
      if($result->rowCount()>0){

        try{

          $result2 = $link->query("SELECT * FROM senses_bck WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY sense_id");
          $number_of_items_in_modal = $result2->rowCount();


        ?>
       <div class="pb-1">
          <div id="sense_bundle_<?php echo $sense_bundle_id?>" class="col-12 col-xl-12 p-0 d-flex bd-highlight sense_bundle2 tl<?php echo $target_lang;?>" ">
          
          <div id="sense_field_tag_<?php echo $sense_bundle_id; ?>" class="pr-1 ml-auto field_tag tl<?php echo $target_lang; ?>">
              <small>definição <?php echo "[$lang_code]"; ?></small>
              </div>

                <button id='restore_sense_<?php echo $sense_bundle_id; ?>' lang_code="<?php echo $lang_code; ?>" bundle="<?php echo $sense_bundle_id; ?>" type="button"  class='btn btn-default btn-sm p-0 <?php if($number_of_items_in_modal == 0){ echo "d-none";}else{ } ?>' data-toggle="modal" data-target="#restore_sense_modal_<?php echo $sense_bundle_id; ?>_<?php echo $lang_code; ?>">
                  <span class="material-icons md-18">restore</span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="restore_sense_modal_<?php echo $sense_bundle_id; ?>_<?php echo $lang_code; ?>"  tabindex="-1" role="dialog" aria-labelledby="restore_sense_modal_title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="restore_sense_modal_title">Recupere antigas definições</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal_sense_panel_<?php echo $sense_bundle_id; ?>">
                        <?php
                    
                      if($result2->rowCount()>0){
                              foreach ($result2 as $key => $row){    
                                $sense_id=$row["sense_id"];
                                $sense= $row["def"];

                                ?>
                                <div class="d-flex">
                                <button class='btn btn-default btn-sm p-0 restore_sense' id='restore_sense_<?php echo $sense_id; ?>' sense_id='<?php echo $sense_id; ?>' lang_code="<?php echo $lang_code; ?>" bundle="<?php echo $sense_bundle_id; ?>" type="button">
                                    <span class="material-icons md-18">restore</span>
                                </button>
                                <div id="sense_<?php echo $sense_bundle_id ?>" class="mr-auto mr-4 sense tl<?php echo $target_lang;?>">
                                <?php echo $sense; ?>
                                </div>
                                </div>

                                <script type='text/javascript'>
              
              $('#restore_sense_<?php echo $sense_id; ?>').on('click', function(){
                var lang_code = $(this).attr('lang_code');
                var bundle = $(this).attr('bundle');
                //var select = document.getElementById('product_id');
              //var index = $('#example').selectedIndex;
              //var given_text = index.options[index].value;
                          //            console.log(search);
                var def_div = "#def_bundle_".concat(bundle).concat("_").concat(lang_code);
                var add_sense_id = "#add_def_".concat(bundle).concat("_").concat(lang_code);
                var items = $(add_sense_id).attr('items');
                var restore_sense = 1;
                var sense_id = $(this).attr('sense_id');
                var items_new = (parseInt(items))+1;
                $(add_sense_id).attr('items', items_new);

              
              $.ajax({
                  url:'edit_sense.php',
                  data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, sense_order:items_new, restore_sense:restore_sense},
                  type: 'POST',
                  success: function(data){
                      if(!data.error){
                          $(def_div).html(data);
              
                      }
                  }
                  
              
              
              
              })
              

              var modal_div = "#modal_sense_panel_".concat(bundle);
              $.ajax({
                url:'modal_update.php',
                data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, sense_order:items_new, restore_sense:restore_sense},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(modal_div).html(data);

                    }
                }
                



            })


              })

          </script>

                                <?php

                    
                              }//foreach

                      }//if
                                        
                    } catch(PDOException $e){
                    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                    } // try
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                    </div>
                </div>
                </div>
                <?php



                ?>
                </div>
                  <div id="sense_bundle_<?php echo $sense_bundle_id."_".$lang_code; ?>" class="col-12 col-xl-12 d-flex flex-column p-0 bd-highlight sense_bundle sl<?php echo $target_lang; ?>">

       

                <?php
                $sense_items = $result->rowCount();
                $item_count=0;
                if($sense_items>0){
                foreach ($result as $sense_item){
                    $item_count= $item_count+1;

                    $sense_id = $sense_item['sense_id'];
                    $sense_order = $sense_item['sense_order'];
                    $sense = $sense_item['def'];
                    $entry_ref_first = $sense_item["entry_ref"];
                    $pattern = array();
                    $pattern[0] = '/\'/i';
                    $pattern[1] = '/\"/i';
                    $entry_ref = preg_replace($pattern, '', $entry_ref_first);

            ?>
             
            <?php
                    if (strlen($sense) == 0){

                      ?>
         <div class="d-flex" id="div_create_def_<?php echo $lang_code; ?>_<?php echo $sense_id; ?>">
         
        <button sense_order='<?php echo $sense_order; ?>' id='create_def_<?php echo $lang_code; ?>_<?php echo $sense_id; ?>'  entry_ref="<?php echo $entry_ref; ?>" target_lang="<?php echo $target_lang; ?>" lang_code="<?php echo $lang_code; ?>" sense_bundle_id="<?php echo $sense_bundle_id; ?>" sense_id="<?php echo $sense_id; ?>" type="button"  class='btn btn-default ml-auto btn-sm p-0 create_def'>
            <span class="material-icons md-18">create</span>
          </button>                       
        </div>

       <script>
         $('#create_def_<?php echo $lang_code; ?>_<?php echo $sense_id; ?>').click(function(){
           console.log("ok");
           var lang_code = $(this).attr('lang_code');
           var sense_bundle_id = $(this).attr('sense_bundle_id');
           var sense_order = $(this).attr('sense_order');
           var div = "#div_create_def_<?php echo $lang_code; ?>_<?php echo $sense_id; ?>";
           //var original = $(this).attr('original');
           var sense_id = $(this).attr('sense_id');
           var create_def = 1;

           $.ajax({
             url:'edit_sense.php',
             data:{create_def:create_def, sense_bundle_id:sense_bundle_id, sense_id:sense_id, lang_code:lang_code, sense_order:sense_order},
             type: 'POST',
             success: function(data){
                 if(!data.error){
                     $(div).html(data);

                 }
             }
             

           })




         })

         </script>
                          <?php
                      

                    }else{
                  ?>

                  





                  <div class="d-flex">
             
                <input id="sense_input_<?php echo $sense_id; ?>" sense_order='<?php echo $sense_order; ?>' first="1" class="form-control form-control-sm ml-auto pr-1 sense_input" sense_id="<?php echo $sense_id; ?>" type="text" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" value="<?php echo $sense;?>" >
                          </div>

          <script>
            $('#sense_input_<?php echo $sense_id; ?>').keyup(function(){
              var lang_code = $(this).attr('lang_code');
              var bundle = $(this).attr('bundle');
              var first = $(this).attr('first');
              var def = $(this).val();
              //var original = $(this).attr('original');
              var sense_id = $(this).attr('sense_id');
              var update_sense = 1;

              if(first==1){
                $(this).attr('first', 0);
                var bck_sense = 1;
                $.ajax({
                url:'edit_sense.php',
                data:{def:def, sense_id:sense_id, bck_sense:bck_sense, update_sense:update_sense},
                type: 'POST',
                success: function(data){
                  /*  if(!data.error){
                        $(def_div).html(data);

                    }*/
                }
                

              })



              }else{

                
                $.ajax({
                    url:'edit_sense.php',
                    data:{def:def, sense_id:sense_id, update_sense:update_sense},
                    type: 'POST',
                    success: function(data){
                      /*  if(!data.error){
                            $(def_div).html(data);
                
                        }*/
                    }
                    
                
                  })

              }

              
              $.ajax({
              url:'modal_update.php',
              data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, update_sense:update_sense},
              type: 'POST',
              success: function(data){
                  if(!data.error){
                      $('#modal_def_panel').html(data);

                  }
                }
                  
              })

            })

            </script>
                  <?php
                  }//else
                }//foreach

            }//if($sense_items==1 || $sense_items==0)
            
                ?>
              </div>
       </div>
    
                <?php

                ?>

            <?php



                ?>
            
    
                <?php
       
              }else{



            //echo "A busca não retornou nenhum resultado.";
            } // if
    
              ?>
    
          
        <?php
        
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //senses //END
}
//END // sense function // END


//START // glosses function // START
function glosses_edit($sense_bundle_id, $target_lang, $lang_code){
        $dic_name = "";
    include ("connection.php");
    //START //glosses //START
    $gloss_id="";
    $gloss_array = [];
    //$dic_name = $_SESSION['dic_name'];

    $config_search = $_SESSION['config_search_'.$dic_name][0];   
    $number_of_tls =$config_search['number_of_tls'];


  try {
  
      $result = $link->query("SELECT * FROM glosses WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY gloss_order");
  
    if($result->rowCount()>0){

        foreach ($result as $key => $row){    
          
          $new_gloss_array =  array (
            'gloss_id' => $row["gloss_id"],
            'gloss_order' => $row["gloss_order"],
            'gloss' => $row["gloss"],
            'target_lang' => $row["target_lang"],

          ); 

          $gloss_array[]= $new_gloss_array;

        } // foreach
  
  
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if

    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //glosses //END
    $number_of_items = count($gloss_array);
    try{

      $result2 = $link->query("SELECT * FROM glosses_bck WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY gloss_id");
      $number_of_items_in_modal = $result2->rowCount(); 
      ?>

      <div class="pb-1">
             <div id="gloss_all_<?php echo $sense_bundle_id ?>_<?php echo $target_lang; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight pron_bundle sl<?php echo $target_lang; ?>" >
              
          <div id="gloss_field_tag_<?php echo $sense_bundle_id; ?>" class="pr-1 ml-auto field_tag tl<?php echo $target_lang; ?>">
              <small>glosas <?php echo "[$lang_code]"; ?></small>
              </div>
            
                <button id='restore_gloss_<?php echo $sense_bundle_id; ?>_<?php echo $target_lang;?>' lang_code="<?php echo $lang_code; ?>" bundle="<?php echo $sense_bundle_id; ?>" type="button"  class='btn btn-default btn-sm p-0 <?php if($number_of_items_in_modal == 0){ echo "d-none";}else{ } ?>' data-toggle="modal" data-target="#restore_gloss_modal_<?php echo $sense_bundle_id; ?>_<?php echo $target_lang;?>">
                  <span class="material-icons md-18">restore</span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="restore_gloss_modal_<?php echo $sense_bundle_id; ?>_<?php echo $target_lang;?>" tabindex="-1" role="dialog" aria-labelledby="restore_gloss_modal_title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="restore_gloss_modal_title">Recupere antigas glosas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal_gloss_panel_<?php echo $sense_bundle_id; ?>_<?php echo $lang_code;?>">
                        <?php
                   
  
                      if($result2->rowCount()>0){
                              foreach ($result2 as $key => $row){    
                                $gloss_id_bck=$row["gloss_id_bck"];
                                $gloss_bck= $row["gloss"];
                                $class_bck = $row["class"];

                                ?>
                                <div class="d-flex">
                                <button items="<?php echo $number_of_items; ?>" class='btn btn-default btn-sm p-0 restore_gloss' id='restore_gloss_<?php echo $gloss_id_bck; ?>' gloss_id='<?php echo $gloss_id_bck; ?>' lang_code="<?php echo $lang_code; ?>" bundle="<?php echo $sense_bundle_id; ?>" type="button">
                                    <span class="material-icons md-18">restore</span>
                                </button>
                                <div id="gloss_<?php echo $sense_bundle_id ?>" class="mr-auto mr-4 gloss tl<?php echo $target_lang;?>">
                                <?php echo $gloss_bck; ?>
                                </div>
                                </div>
  
                        <script>
                                $('#restore_gloss_<?php echo $gloss_id_bck; ?>').on('click', function(){
                                  var lang_code = $(this).attr('lang_code');
                                  var bundle = $(this).attr('bundle');
                                  var gloss_div = "#gloss_bundle_"+bundle+"_"+lang_code;
                                  var add_gloss_id = "#add_gloss_"+bundle+"_"+lang_code;
                                  var items = $(add_gloss_id).attr('items');
                                  var restore_gloss = 1;
                                  var gloss_id = $(this).attr('gloss_id');
                                  var items_new = (parseInt(items))+1;

                                  $(add_gloss_id).attr('items', items_new);


                                  $.ajax({
                                      url:'edit_gloss.php',
                                      data:{bundle:bundle, lang_code:lang_code, gloss_id:gloss_id, gloss_order:items_new, restore_gloss:restore_gloss},
                                      type: 'POST',
                                      success: function(data){
                                          if(!data.error){
                                              $(gloss_div).html(data);

                                          }
                                      }
                                      



                                  })

                                  var update_gloss = 1;
                                  var div_modal="#modal_gloss_panel_".concat(bundle).concat("_").concat(lang_code);
                                  console.log(div_modal);
                                  $.ajax({
                                  url:'modal_update.php',
                                  data:{bundle:bundle, lang_code:lang_code, gloss_id:gloss_id, update_gloss:update_gloss},
                                  type: 'POST',
                                  success: function(data){
                                      if(!data.error){
                                          $(div_modal).html(data);

                                      }
                                  }



                                  })

                                })
                              </script>
                                      <?php
                    
                              }//foreach

                      }//if
                                        
                    } catch(PDOException $e){
                    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                    } // try
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
                </div>
                  
                <?php



                ?>
                <button items="<?php echo $number_of_items; ?>" id='add_gloss_<?php echo $sense_bundle_id; ?>_<?php echo $lang_code; ?>' bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button"  class='btn btn-default btn-sm p-0 add_gloss'>
                  <span class="material-icons md-18">add_box</span>
                </button>
                
                </div>

                  <div id="gloss_bundle_<?php echo $sense_bundle_id; ?>_<?php echo $lang_code;?>" class="col-12 col-xl-12 d-flex flex-column p-0 bd-highlight gloss_bundle sl<?php echo $target_lang; ?>">

                  <script>
                    
                $('#add_gloss_<?php echo $sense_bundle_id; ?>_<?php echo $lang_code; ?>').on('click', function(){
                    
                    var lang_code = $(this).attr('lang_code');
                    var bundle = $(this).attr('bundle');
                    var items = $(this).attr('items');
                  //var select = document.getElementById('product_id');
                  //var index = $('#example').selectedIndex;
                  //var given_text = index.options[index].value;
                              //            console.log(search);
                    var gloss_div = "#gloss_bundle_"+bundle+"_"+lang_code;
                    var add_gloss = 1;
                    var items_new = parseInt(items)+1;
                    $(this).attr('items', items_new);
                  
                  
                  $.ajax({
                      url:'edit_gloss.php',
                      data:{bundle:bundle, lang_code:lang_code, add_gloss:add_gloss, items:items},
                      type: 'POST',
                      success: function(data){
                          if(!data.error){
                              $(gloss_div).html(data);
                  
                          }
                      }
                      
                  
                  
                  
                  })
                  
                  
                  })
                  
  
  
                  </script>

       

                <?php
                $gloss_items = count($gloss_array);
                $item_count=0;
                if($gloss_items<2){
                foreach ($gloss_array as $gloss_item){
                    $item_count= $item_count+1;

                    $gloss_id = $gloss_item['gloss_id'];
                    $gloss_order = $gloss_item['gloss_order'];
                    $gloss = $gloss_item['gloss'];
                    $target_lang = $gloss_item['target_lang'];

                  ?>
                  <div class="d-flex">

                <input gloss_order="<?php echo $gloss_order; ?>" id="gloss_input_<?php echo $gloss_id; ?>" first="1" class="form-control form-control-sm ml-auto pr-1 gloss_input" gloss_id="<?php echo $gloss_id; ?>" type="text" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" value="<?php echo $gloss;?>" >  
                <button id='del_gloss_<?php echo $gloss_id; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" gloss_id="<?php echo $gloss_id; ?>" class='btn btn-default btn-sm p-0 del_gloss'>
                  <span class="material-icons md-18">delete</span>
                </button>
                          </div>

                          <script type='text/javascript'> 
          $('#del_gloss_<?php echo $gloss_id; ?>').on('click', function(){
            
            var lang_code = $(this).attr('lang_code');
            var bundle = $(this).attr('bundle');
            var gloss_div = "#gloss_bundle_"+bundle+"_"+lang_code;
            var add_gloss_id = "#add_gloss_"+bundle+"_"+lang_code;
            var items = $(add_gloss_id).attr('items');
            var del_gloss = 1;
            var restore_gloss = 1;
            var gloss_id = $(this).attr('gloss_id');
            var items_new = (parseInt(items))-1;
            console.log(lang_code);
            console.log(gloss_id);
            console.log(bundle);
            console.log(add_gloss_id);
            console.log(gloss_div);

            $(add_gloss_id).attr('items', items_new);
            
            $.ajax({
                url:'edit_gloss.php',
                data:{bundle:bundle, lang_code:lang_code, gloss_id:gloss_id, del_gloss:del_gloss},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(gloss_div).html(data);

                    }
                }
                

              })

                
            $.ajax({
              url:'modal_update.php',
              data:{bundle:bundle, lang_code:lang_code, gloss_id:gloss_id, gloss_order:items_new, restore_gloss:restore_gloss},
              type: 'POST',
              success: function(data){
                  if(!data.error){
                      $('#modal_gloss_panel').html(data);

                  }
              }
              



            })




          })
      </script>
    <script type='text/javascript'>
      $('#gloss_input_<?php echo $gloss_id; ?>').keyup(function(){
        var lang_code = $(this).attr('lang_code');
        var bundle = $(this).attr('bundle');
        var first = $(this).attr('first');
        var gloss = $(this).val();
        var gloss_id = $(this).attr('gloss_id');

        if(first==1){
          $(this).attr('first', 0);
          var bck_gloss = 1;
          console.log(gloss);
          $.ajax({
          url:'update_gloss.php',
          data:{gloss_id:gloss_id, bck_gloss:bck_gloss},
          type: 'POST',
          /*success: function(data){
              if(!data.error){
                  $(gloss_div).html(data);

              }
          }*/
          

        })
          var update_gloss = 1;
          var div_modal="#modal_gloss_panel_".concat(bundle).concat("_").concat(lang_code);
          console.log(div_modal);
        $.ajax({
          url:'modal_update.php',
          data:{bundle:bundle, lang_code:lang_code, gloss_id:gloss_id, update_gloss:update_gloss},
          type: 'POST',
          success: function(data){
              if(!data.error){
                  $(div_modal).html(data);

              }
          }
          
        

        })


        }

        var update_gloss = 1;

        $.ajax({
            url:'update_gloss.php',
            data:{gloss:gloss, gloss_id:gloss_id, update_gloss:update_gloss},
            type: 'POST',
            success: function(data){
                
            }
            

          })

    })
      </script>

                  <?php
                  



                }//foreach
            }//if($gloss_items==1 || $gloss_items==0)
            elseif($gloss_items>=2){
                foreach ($gloss_array as $gloss_item){
                    $gloss_id = $gloss_item['gloss_id'];
                    $gloss_order = $gloss_item['gloss_order'];
                    $gloss = $gloss_item['gloss'];
                    $target_lang = $gloss_item['target_lang'];
                    


                    
                  ?>
                  <div class="d-flex">
                <?php
                
                    $item_count= $item_count+1;
                    if($item_count==1){
                        ?>
                        <!--
                <button id='down_gloss_<?php echo $gloss_id; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" gloss_id="<?php echo $gloss_id; ?>" class='btn btn-default btn-sm p-0 down_gloss'>
                  <span class="material-icons md-18">arrow_downward</span>
                </button>
                    -->
                <?php

                    }else{
                        if($item_count==$gloss_items){

                            ?>
                            <!--
                            <button id='up_gloss_<?php echo $gloss_id; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" gloss_id="<?php echo $gloss_id; ?>" class='btn btn-default btn-sm p-0 up_gloss'>
                              <span class="material-icons md-18">arrow_upward</span>
                            </button>
                        -->
                            <?php
            
                            
                        }else{

                            ?>
                            <!--
                <button id='down_gloss_<?php echo $gloss_id; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" gloss_id="<?php echo $gloss_id; ?>" class='btn btn-default btn-sm p-0 down_gloss'>
                  <span class="material-icons md-18">arrow_downward</span>
                </button>
                            <button id='up_gloss_<?php echo $gloss_id; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" gloss_id="<?php echo $gloss_id; ?>" class='btn btn-default btn-sm p-0 up_gloss'>
                              <span class="material-icons md-18">arrow_upward</span>
                            </button>
                        -->
                            <?php
            
                        }


                    }

                ?>

                <input gloss_order="<?php echo $gloss_order; ?>" id="gloss_input_<?php echo $gloss_id; ?>" first="1" class="form-control form-control-sm ml-auto pr-1 gloss_input" gloss_id="<?php echo $gloss_id; ?>" type="text" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" value="<?php echo $gloss;?>" >
                <button id='del_gloss_<?php echo $gloss_id; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" gloss_id="<?php echo $gloss_id; ?>" class='btn btn-default btn-sm p-0 del_gloss'>
                  <span class="material-icons md-18">delete</span>
                </button>

                          </div>

      <script type='text/javascript'> 
          $('#del_gloss_<?php echo $gloss_id; ?>').on('click', function(){
            
            var lang_code = $(this).attr('lang_code');
            var bundle = $(this).attr('bundle');
            var gloss_div = "#gloss_bundle_"+bundle+"_"+lang_code;
            var add_gloss_id = "#add_gloss_"+bundle+"_"+lang_code;
            var items = $(add_gloss_id).attr('items');
            var del_gloss = 1;
            var restore_gloss = 1;
            var gloss_id = $(this).attr('gloss_id');
            var items_new = (parseInt(items))-1;
            console.log(lang_code);
            console.log(gloss_id);
            console.log(bundle);
            console.log(add_gloss_id);
            console.log(gloss_div);

            $(add_gloss_id).attr('items', items_new);
            
            $.ajax({
                url:'edit_gloss.php',
                data:{bundle:bundle, lang_code:lang_code, gloss_id:gloss_id, del_gloss:del_gloss},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(gloss_div).html(data);

                    }
                }
                

              })

                
            $.ajax({
              url:'modal_update.php',
              data:{bundle:bundle, lang_code:lang_code, gloss_id:gloss_id, gloss_order:items_new, restore_gloss:restore_gloss},
              type: 'POST',
              success: function(data){
                  if(!data.error){
                      $('#modal_gloss_panel').html(data);

                  }
              }
              



            })




          })
      </script>
    <script type='text/javascript'>
      $('#gloss_input_<?php echo $gloss_id; ?>').keyup(function(){
        var lang_code = $(this).attr('lang_code');
        var bundle = $(this).attr('bundle');
        var first = $(this).attr('first');
        var gloss = $(this).val();
        var gloss_id = $(this).attr('gloss_id');

        if(first==1){
          $(this).attr('first', 0);
          var bck_gloss = 1;
          console.log(gloss);
          $.ajax({
          url:'update_gloss.php',
          data:{gloss_id:gloss_id, bck_gloss:bck_gloss},
          type: 'POST',
          /*success: function(data){
              if(!data.error){
                  $(gloss_div).html(data);

              }
          }*/
          

        })
          var update_gloss = 1;
          var div_modal="#modal_gloss_panel_".concat(bundle).concat("_").concat(lang_code);
          console.log(div_modal);
        $.ajax({
          url:'modal_update.php',
          data:{bundle:bundle, lang_code:lang_code, gloss_id:gloss_id, update_gloss:update_gloss},
          type: 'POST',
          success: function(data){
              if(!data.error){
                  $(div_modal).html(data);

              }
          }
          
        

        })


        }

        var update_gloss = 1;

        $.ajax({
            url:'update_gloss.php',
            data:{gloss:gloss, gloss_id:gloss_id, update_gloss:update_gloss},
            type: 'POST',
            success: function(data){
                
            }
            

          })

    })
      </script>
                  <?php
                }//foreach
            }//else

                ?>
              </div>
        </div>

      


      <?php


}
//END // glosses function // END

//START // classes function //START
function classes_edit ($sense_bundle_id, $target_lang, $lang_code){
        $dic_name = "";
    include ("connection.php");
    //START //classes //START
   
 try {
        
        $result = $link->query("SELECT * FROM classes WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY class_id");


  
      ?>
        
          

      <div class="pb-1">
      <div id="class_<?php echo $sense_bundle_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight class_bundle">
                        
      <div id="class_field_tag_<?php echo $sense_bundle_id; ?>" class="pr-1 ml-auto field_tag tl<?php echo $target_lang; ?>">
              <small>classe <?php echo "[$lang_code]"; ?></small>
              </div>
        
          <div>
          <div class="pb-1 d-flex" id="class_bundle_<?php echo $sense_bundle_id; ?>_<?php echo $lang_code; ?>">



        
      <?php
     
            if($result->rowCount()>0){
              $class_id="";
            ?>
      <select class="custom-select custom-select-sm ml-auto input_part_of_speech" bundle="<?php echo $sense_bundle_id; ?>" id="input_part_of_speech_<?php echo $sense_bundle_id; ?>_<?php echo $target_lang; ?>">

            <?php
              foreach ($result as $key => $row){    
                $class_id=$row["class_id"];
                
                try {
                  $result = $link->query("SELECT * FROM class_names WHERE class_id  = '$class_id' AND lang_code = '$lang_code'");
                    
                        if($result->rowCount()>0){
              
                          foreach ($result as $row){
                            $class_name_id_selected=$row["class_name_id"];
                          }//foreach
                  
                        }else{
                          $class_name_id_selected=14;

                          //echo "A busca não retornou nenhum resultado.";
                      } // if


                    } catch(PDOException $e){
                      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                    } // try


            
                          try{
                            $result2 = $link->query("SELECT * FROM class_names WHERE lang_code = '$lang_code'");
                            if($result2->rowCount()>0){
              
                              foreach ($result2 as $row){
                                $class_id=$row["class_id"];
                                $class_name_id=$row["class_name_id"];
                                $class_name=$row["class_name"];
                                if($class_name_id == $class_name_id_selected){
                                  $selected = "selected"; 
                                }else{
                                  $selected = "";
                                }

                                ?>
                                <option <?php echo $selected; ?> name_ref="<?php echo $class_name; ?>" value="<?php echo $class_id; ?>"><?php echo $class_name; ?></option>
                              <?php
                    


                              }//foreach
                      
                            }else{
          
                              //echo "A busca não retornou nenhum resultado.";
                          } // if
          
                            
                          
                    } catch(PDOException $e){
                      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                  } // try
        
                  } // foreach
                ?>
            </select>
            <button id='del_part_of_speech__<?php echo $sense_bundle_id; ?>_<?php echo $target_lang; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" class='btn btn-default btn-sm p-0 del_part_of_speech'>
                  <span class="material-icons md-18">delete</span>
                </button>
                


                <script type='text/javascript'> 
          $('#del_part_of_speech__<?php echo $sense_bundle_id; ?>_<?php echo $target_lang; ?>').on('click', function(){
         
               var bundle = $(this).attr('bundle');
                console.log(bundle);

                div = "#class_div_".concat(bundle);
                console.log(div);
                del_class = 1;

            
            $.ajax({
                url:'edit_class.php',
                data:{bundle:bundle, del_class:del_class},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(div).html(data);

                    }
                }
                

              })

               



          })
      </script>
            <script>

              
            $('#input_part_of_speech_<?php echo $sense_bundle_id; ?>_<?php echo $target_lang; ?>').change(function(){
                var bundle = $(this).attr('bundle');
                var class_name_ref = $("option:selected", this).attr('name_ref');
                var class_id = this.value;
                console.log(class_name_ref);
                console.log(class_id);
                console.log(bundle);

                div = "#class_div_".concat(bundle);
                console.log(div);
                    $.ajax({
                        url:'edit_class.php',
                        data:{class_id:class_id, bundle:bundle, class_name_ref:class_name_ref, update_class:1},
                        type: 'POST',
                        success: function(data){
                                if(!data.error){
                                $(div).html(data);
                    
                                }
                        }
                    
                        })


                    })
                  




              </script>


                <?php
            }else{

              ?>

          <button id='create_class_btn_<?php echo $lang_code; ?>_<?php echo $sense_bundle_id; ?>'  target_lang="<?php echo $target_lang; ?>" lang_code="<?php echo $lang_code; ?>" sense_bundle_id="<?php echo $sense_bundle_id; ?>" type="button"  class='btn btn-default ml-auto btn-sm p-0 create_class'>
            <span class="material-icons md-18">create</span>
          </button>  
      <script>
      $('#create_class_btn_<?php echo $lang_code; ?>_<?php echo $sense_bundle_id; ?>').on('click', function(){
        console.log("oir");
        var lang_code = $(this).attr('lang_code');
        var sense_bundle_id = $(this).attr('sense_bundle_id');
        //var select = document.getElementById('product_id');
      //var index = $('#example').selectedIndex;
      //var given_text = index.options[index].value;
                  //            console.log(search);
        var div = "#class_div_".concat(sense_bundle_id);
        var create_class = 1;
        var target_lang = $(this).attr('target_lang');
    
      
      $.ajax({
          url:'edit_class.php',
          data:{sense_bundle_id:sense_bundle_id, lang_code:lang_code, target_lang:target_lang, create_class:create_class},
          type: 'POST',
          success: function(data){
              if(!data.error){
                  $(div).html(data);
      
              }
          }
          
      
        })
      
          
    
      
      })
      </script>
          <?php
          //echo "A busca não retornou nenhum resultado.";
      } // if


      
            ?>
          </div>
          </div>
        </div>
      </div>
      

     <?php

    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //classes //END
}
//END // classes function // END

//START //scns function //START
function scns_edit ($sense_bundle_id){
        $dic_name = "";
    include ("connection.php");
    
    //START //scn //START
    $lang_code = "lat";
    $target_lang = 1;

    try{

      $result2 = $link->query("SELECT * FROM scns_bck WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY scn_id");
       

    ?>


    <div class="pb-1">
             <div id="scn_all_<?php echo $sense_bundle_id ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight pron_bundle sl<?php echo $target_lang; ?>" >
              
                  
          <div id="scn_field_tag_<?php echo $sense_bundle_id; ?>" class="pr-1 ml-auto field_tag tl<?php echo $target_lang; ?>">
              <small>nome científico <?php echo "[$lang_code]"; ?></small>
              </div>
        
                <div>
                <button id='restore_scn_<?php echo $sense_bundle_id; ?>' lang_code="<?php echo $lang_code; ?>" bundle="<?php echo $sense_bundle_id; ?>" type="button"  class='btn btn-default btn-sm p-0 <?php $number_of_items_in_modal = $result2->rowCount(); if($number_of_items_in_modal == 0){ echo "d-none";}else{ } ?>' data-toggle="modal" data-target="#restore_scn_modal_<?php echo $sense_bundle_id; ?>">
                  <span class="material-icons md-18">restore</span>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="restore_scn_modal_<?php echo $sense_bundle_id; ?>" tabindex="-1" role="dialog" aria-labelledby="restore_scn_modal_<?php echo $sense_bundle_id; ?>_title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="restore_scn_modal_<?php echo $sense_bundle_id; ?>_title">Recupere antigos nomes científicos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal_scn_panel_<?php echo $sense_bundle_id; ?>">
                        <?php
                   
                      if($result2->rowCount()>0){
                              foreach ($result2 as $key => $row){    
                                $scn_id=$row["scn_id"];
                                $scn= $row["scn"];

                                ?>
                                <div class="d-flex">
                                <button class='btn btn-default btn-sm p-0 restore_scn' id='btn_restore_scn_<?php echo $scn_id; ?>' scn_id='<?php echo $scn_id; ?>' lang_code="<?php echo $lang_code; ?>" bundle="<?php echo $sense_bundle_id; ?>" type="button">
                                    <span class="material-icons md-18">restore</span>
                                </button>
                                <div id="scn_<?php echo $sense_bundle_id ?>" class="mr-auto mr-4 scn tl<?php echo $target_lang;?>">
                                <?php echo $scn; ?>
                                </div>
                                </div>

                                <script type='text/javascript'>
              
              $('#btn_restore_scn_<?php echo $scn_id; ?>').on('click', function(){
                  var lang_code = $(this).attr('lang_code');
                  var bundle = $(this).attr('bundle');
                  //var select = document.getElementById('product_id');
                //var index = $('#example').selectedIndex;
                //var given_text = index.options[index].value;
                            //            console.log(search);
                  var scn_div = "#scn_div_".concat(bundle);
                  var add_scn_id = "#add_scn_".concat(bundle).concat("_").concat(lang_code);
                  var items = $(add_scn_id).attr('items');
                  var restore_scn = 1;
                  var scn_id = $(this).attr('scn_id');
                  var items_new = (parseInt(items))+1;
                  $(add_scn_id).attr('items', items_new);

                
                $.ajax({
                    url:'edit_scn.php',
                    data:{bundle:bundle, lang_code:lang_code, scn_id:scn_id, scn_order:items_new, restore_scn:restore_scn},
                    type: 'POST',
                    success: function(data){
                        if(!data.error){
                            $(scn_div).html(data);
                
                        }
                    }
                    
                
                
                
                })
                

                
                $.ajax({
                  url:'modal_update.php',
                  data:{bundle:bundle, lang_code:lang_code, scn_id:scn_id, scn_order:items_new, restore_scn:restore_scn},
                  type: 'POST',
                  success: function(data){
                      if(!data.error){
                          $('#modal_scn_panel').html(data);

                      }
                  }
                  



              })


                })

              </script>

                                <?php
                    
                              }//foreach

                      }//if
                                        
                  
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
                </div>
                <?php
          } catch(PDOException $e){
            echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
            } // try
 
                    try {
                    
                        $result = $link->query("SELECT * FROM scns WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY scn_order");
                        $scn_items = $result->rowCount();
                        $item_count=0;
                        ?>

                        <button items="<?php echo $scn_items; ?>" id='add_scn_<?php echo $sense_bundle_id; ?>' bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button"  class='btn btn-default btn-sm p-0 add_scn'>
                          <span class="material-icons md-18">add_box</span>
                        </button>
                        </div>
                        </div>
        
                        <div id="scn_bundle_<?php echo $sense_bundle_id."_".$lang_code; ?>" class="col-12 col-xl-12 d-flex flex-column p-0 bd-highlight scn_bundle sl<?php echo $target_lang; ?>">
                              <div class="ml-auto"></div>
                              <?php            
                        
                        if($result->rowCount()>0){
                                      

                          foreach ($result as $key => $row){
                            $item_count= $item_count+1;
                            $scn_id=$row["scn_id"];
                            $scn=$row["scn"];
                            $scn_order = $row['scn_order'];
                            $lang_code="lat";

                          ?>
                                <div class="d-flex ml-auto">
                           
                          <?php
                              if($scn_items<2){

                                ?>
                           
                                <?php
                          }//if($scn_items==1 || $scn_items==0)
                          elseif($scn_items>=2){
                            
                                  
                                ?>
                              <?php
                              
                                  if($item_count==1){
                                      ?>
                              <button id='down_scn_<?php echo $sense_bundle_id; ?>_<?php echo $lang_code; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" scn_id="<?php echo $scn_id; ?>" class='btn btn-default btn-sm p-0 down_scn'>
                                <span class="material-icons md-18">arrow_downward</span>
                              </button>
                              <?php

                                  }else{
                                      if($item_count==$scn_items){

                                          ?>
                                          <button id='up_scn_<?php echo $sense_bundle_id; ?>_<?php echo $lang_code; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" scn_id="<?php echo $scn_id; ?>" class='btn btn-default btn-sm p-0 up_scn'>
                                            <span class="material-icons md-18">arrow_upward</span>
                                          </button>
                                          <?php
                          
                                          
                                      }else{

                                          ?>
                              <button id='down_scn_<?php echo $sense_bundle_id; ?>_<?php echo $lang_code; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" scn_id="<?php echo $scn_id; ?>" class='btn btn-default btn-sm p-0 down_scn'>
                                <span class="material-icons md-18">arrow_downward</span>
                              </button>
                                          <button id='up_scn_<?php echo $sense_bundle_id; ?>_<?php echo $lang_code; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" scn_id="<?php echo $scn_id; ?>" class='btn btn-default btn-sm p-0 up_scn'>
                                            <span class="material-icons md-18">arrow_upward</span>
                                          </button>
                                          <?php
                          
                                      }


                                  }

                             
                             
                          }//else

                          ?>

              <input id="scn_input_<?php echo $scn_id; ?>" first="1" class="form-control form-control-sm pr-1 scn_input" scn_id="<?php echo $scn_id; ?>" type="text" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" value="<?php echo $scn;?>" >
              <button id='del_scn_<?php echo $scn_id; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" scn_id="<?php echo $scn_id; ?>" class='btn btn-default btn-sm p-0 del_scn'>
                <span class="material-icons md-18">delete</span>
              </button>

                          </div>


   <script>

$('#scn_input_<?php echo $scn_id; ?>').keyup(function(){
  var lang_code = $(this).attr('lang_code');
        var bundle = $(this).attr('bundle');
        var first = $(this).attr('first');
        var scn = $(this).val();
        var scn_id = $(this).attr('scn_id');

        if(first==1){
          $(this).attr('first', 0);
          var bck_scn = 1;
          $.ajax({
          url:'update_scn.php',
          data:{scn_id:scn_id, bck_scn:bck_scn},
          type: 'POST',
          success: function(data){
            /*  if(!data.error){
                  $(scn_div).html(data);
      
              }*/
          }
          
      
        })
      



        }


        //var select = document.getElementById('product_id');
      //var index = $('#example').selectedIndex;
      //var given_text = index.options[index].value;
                  //            console.log(search);
        var update_scn = 1;
    
      
      $.ajax({
          url:'update_scn.php',
          data:{scn:scn, scn_id:scn_id, update_scn:update_scn},
          type: 'POST',
          success: function(data){
            /*  if(!data.error){
                  $(scn_div).html(data);
      
              }*/
          }
          
      
        })
      
        $.ajax({
        url:'modal_update.php',
        data:{bundle:bundle, lang_code:lang_code, scn_id:scn_id, update_scn:update_scn},
        type: 'POST',
        success: function(data){
            if(!data.error){
                $('#modal_scn_panel').html(data);
    
            }
        }
        
    
    
    
    })

    
    
      
      })


      $('#del_scn_<?php echo $scn_id; ?>').on('click', function(){
        var lang_code = $(this).attr('lang_code');
        var bundle = $(this).attr('bundle');
        //var select = document.getElementById('product_id');
      //var index = $('#example').selectedIndex;
      //var given_text = index.options[index].value;
                  //            console.log(search);
        var scn_div = "#scn_div_".concat(bundle);
        var add_scn_id = "#add_scn_"+bundle+"_"+lang_code;
        var items = $(add_scn_id).attr('items');
        var del_scn = 1;
        var restore_scn = 1;
        var scn_id = $(this).attr('scn_id');
        var items_new = (parseInt(items))-1;
        $(add_scn_id).attr('items', items_new);
    
      
      $.ajax({
          url:'edit_scn.php',
          data:{bundle:bundle, lang_code:lang_code, scn_id:scn_id, del_scn:del_scn},
          type: 'POST',
          success: function(data){
              if(!data.error){
                  $(scn_div).html(data);
      
              }
          }
          
      
        })
      
          
      $.ajax({
        url:'modal_update.php',
        data:{bundle:bundle, lang_code:lang_code, scn_id:scn_id, scn_order:items_new, restore_scn:restore_scn},
        type: 'POST',
        success: function(data){
            if(!data.error){
                $('#modal_scn_panel').html(data);
    
            }
        }
        
    
    
    
    })
    
    
    
      
      })
      </script>
                            <?php

                        }//foreach
                    

                      }//if
                      ?>
                       </div>

                      <?php

                                        
                    
                ?>
            </div>


    <script>
    $('#add_scn_<?php echo $sense_bundle_id; ?>').on('click', function(){
          
          var lang_code = $(this).attr('lang_code');
          var bundle = $(this).attr('bundle');
          var items = $(this).attr('items');
        //var select = document.getElementById('product_id');
        //var index = $('#example').selectedIndex;
        //var given_text = index.options[index].value;
         console.log("add scn");
          var scn_div = "#scn_div_".concat(bundle);
          console.log(scn_div);
          var add_scn = 1;
          var items_new = parseInt(items)+1;
          $(this).attr('items', items_new);
      
        
        $.ajax({
            url:'edit_scn.php',
            data:{bundle:bundle, lang_code:lang_code, add_scn:add_scn, items:items},
            type: 'POST',
            success: function(data){
                if(!data.error){
                    $(scn_div).html(data);
        
                }
            }
            
        
        
        
        })
        
        
        })

        
    </script>

    <?php

    } catch(PDOException $e){
     echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try

    
    //END //scns //END
}  
//END //scns function//END

// START //sds function //START
function sds_edit ($sense_bundle_id, $target_lang, $lang_code){
      $dic_name = "";
    include ("connection.php");

  //START //sds //START
  try {

    ?>
    
    <div class="pb-1">
      <div id="sd_<?php echo $sense_bundle_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight sd_bundle">
        <div id="sd_field_tag_<?php echo $sense_bundle_id; ?>" class="pr-1 ml-auto field_tag tl<?php echo $target_lang; ?>">
              <small>campos semânticos <?php echo "[$lang_code]"; ?></small>
              </div>
        
          <div>

            <?php

              $result = $link->query("SELECT * FROM sds WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY sd_id");
              $sd_items = $result->rowCount();
              $item_count=0;
              $selected_ids =[];
              

              foreach ($result as $key => $row){    
                        
                $sd_id=$row["sd_id"];
                $selected_ids[]=$sd_id;
              }//foreach


              ?>

                <button items="<?php echo $sd_items; ?>" id='edit_sd_<?php echo $lang_code; ?>' lang_code="<?php echo $lang_code; ?>" bundle="<?php echo $sense_bundle_id; ?>" type="button"  class='btn btn-default btn-sm p-0' data-toggle="modal" data-target="#sd_bundle_modal_<?php echo $sense_bundle_id; ?>_<?php echo $target_lang; ?>">
                  <span class="material-icons md-18">edit</span>
                </button>
            


                <!-- Modal -->
                <div id="sd_bundle_modal_<?php echo $sense_bundle_id; ?>_<?php echo $target_lang; ?>" bundle="<?php echo $sense_bundle_id; ?>" class="modal fade sd_modal" tabindex="-1" role="dialog" aria-labelledby="edit_sd_modal_<?php echo $sense_bundle_id; ?>_<?php echo $lang_code; ?>_title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_sd_bundle_modal_<?php echo $sense_bundle_id; ?>_<?php echo $target_lang; ?>_title">Campos semânticos do sentido</h5>
                        <button type="button" class="close close_sd" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal_sd_panel">
                      <div class="d-flex flex-column" style="overflow:scroll; height: 400px">
                      
                       
                      <?php





                    try{
                      $result2 = $link->query("SELECT * FROM sd_names WHERE lang_code = '$lang_code' ORDER BY sd_name");

                      if($result2->rowCount()>0){
                        $sd_order = 1;
                        //$dic_name = $_SESSION['dic_name'];

                        $config_search = $_SESSION['config_search_'.$dic_name][0];
                        $number_of_tls =$config_search['number_of_tls'];

                        foreach ($result2 as $row){
                      
                          $sd_id=$row["sd_id"];
                          $sd_name_id=$row["sd_name_id"];
                          $sd_name=$row["sd_name"];
                          $checked = "";


                          if(in_array($sd_id, $selected_ids)){
                            $checked = "checked";
                          }else{
                            $checked = "";
                          }
              
                          ?>

                      <div class="form-check">
                          <input class="form-check-input sd_checkbox" type="checkbox" tl="<?php echo $target_lang; ?>" tls="<?php echo $number_of_tls; ?>" bundle="<?php echo $sense_bundle_id; ?>" sd_id = "<?php echo $sd_id; ?>" id="checkbox_sd_<?php echo $sense_bundle_id; ?>_<?php echo $sd_id; ?>_<?php echo $target_lang; ?>" order = "<?php echo $sd_order; ?>" value='<?php echo $sd_name; ?>' <?php echo $checked; ?>>
                            <label class="form-check-label" for="sd_<?php echo $sd_id; ?>"><?php echo $sd_name; ?></label><br>
                      </div>
                      <script>
                        
          $('#checkbox_sd_<?php echo $sense_bundle_id; ?>_<?php echo $sd_id; ?>_<?php echo $target_lang; ?>').change(function(){
              var bundle = $(this).attr('bundle');
              var sd_name_ref = $(this).val();
              var sd_id = $(this).attr('sd_id');
              var sd_order = $(this).attr('order');
              var tls = $(this).attr('tls');
              var tl = $(this).attr('tl');
              console.log(bundle);
              console.log(sd_name_ref);
              console.log(sd_id);
              console.log(sd_order);
              console.log(tls);
              console.log(tl);
              
            
              


              if($(this).is(':checked')){
                  var add_sd = 1;

                  $.ajax({
                      url:'edit_sd.php',
                      data:{sd_id:sd_id, bundle:bundle, sd_name_ref:sd_name_ref, sd_order:sd_order, add_sd:add_sd},
                      type: 'POST',
                      success: function(data){
                          /*
                              if(!data.error){
                              $(sd_div).html(data);
                  
                              }
                          */
                      }
                  
                      })

                      
                      

              }else{
                  var del_sd = 1;
                  $.ajax({
                      url:'edit_sd.php',
                      data:{sd_id:sd_id, bundle:bundle, del_sd:del_sd},
                      type: 'POST',
                      success: function(data){
                          /*
                              if(!data.error){
                              $(sd_div).html(data);
                  
                              }
                          */
                      }
                  
                      })

                      
                      
                  
                        }

                        var target_lang = 0;
                        var count = 0;
                        
                        //ProcessNext(target_lang, tls, bundle);
          
                        //ProcessNextModal(count, tls, bundle);



          })
                






                      </script>
                          <?php
                $sd_order = $sd_order +1;
                                } // foreach     
                            

                      }else{
                      }//if
                                        
                    } catch(PDOException $e){
                    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                    } // try

                        ?>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close_sd" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>

                </div>
                <script>
          $('#sd_bundle_modal_<?php echo $sense_bundle_id; ?>_<?php echo $target_lang; ?>').on('hide.bs.modal', function () {
            
            var bundle = $(this).attr('bundle');

            console.log(bundle);
            var update_sd_final = 1;
            var div = "";
            
                div = '#sd_div_'.concat(bundle);
            
                $.ajax({
                    url:'edit_sd.php',
                    data:{bundle:bundle, update_sd_final:update_sd_final},
                    type: 'POST',
                    success: function(data){
                            if(!data.error){
                            $(div).html(data);
                
                            }
                    }
                
            });



          })                  
                </script>
              <?php



            ?>

              </div>
              </div>



     <?php
     
     try{
      $result4 = $link->query("SELECT * FROM sds WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY sd_id");
      
     } catch(PDOException $e){
       echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
   } // try
     


       if($sd_items >0){
        ?>
         <div id="sd_bundle_<?php echo $sense_bundle_id ?>_<?php echo $target_lang ?>" class="sd mt-2" style="display: true;">
 
            <div id="sd_panel" class="form-group d-flex flex-row-reverse pr-2 bd-highlight sd tl<?php echo $target_lang ?>" style="display: true;">

        <?php
        foreach ($result4 as $key => $row){    
          
          $sd_id=$row["sd_id"];
          try {
            $result5 = $link->query("SELECT * FROM sd_names WHERE sd_id  = '$sd_id' AND lang_code = '$lang_code'");
              
                  if($result5->rowCount()>0){
        
                    foreach ($result5 as $row){
        
                      $sd_name_id=$row["sd_name_id"];
                      $sd_name=$row["sd_name"];
                      
            ?>
            
            <input type="submit" sd_id="<?php echo $sd_id; ?>" id="sd_display_btn_<?php echo $sd_id; ?>_<?php echo $target_lang; ?>" style="min-width:2.3em; width:auto; min-height:2em; height: auto;" class="btn btn-primary btn-xs sembtn_display" value='<?php echo $sd_name; ?>'>
            
            <script>
                        
                        $('#sd_display_btn_<?php echo $sd_id; ?>_<?php echo $target_lang; ?>').change(function(){

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
              } // foreach

              ?>

            </div>
                    </div>


              <?php

            }else{
              //echo "A busca não retornou nenhum resultado.";
          } // if
        ?>        </div>
                       
       <?php
                    
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    
    //END //sds //END
}
//END // sds function // END

//START //example_bundle_output function  //START
function example_bundle_output_edit ($sense_bundle_id, $count_sense_bundle){
        $dic_name = "";
    include ("connection.php");
    //START //example_bundles //START
    try {
  
      $result = $link->query("SELECT * FROM example_bundles WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY example_bundle_id");
      $example_bundle_count=1;
      $source_langs_info = $_SESSION['config_sls_'.$dic_name];
       if($result->rowCount()>0) {
       
        foreach ($result as $key => $row){
          $example_bundle_id=$row["example_bundle_id"];
          $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

              
  
    
          ?>
          <div id="example_bundle_all_<?php echo $example_bundle_count; ?>" class="sense_bundle_all_<?php echo $example_bundle_count; ?>">
          <div class="d-flex">
          <div id="example_bundle_field_tag_<?php echo $sense_bundle_id; ?>" class="pr-1 ml-auto field_tag">
              <small>exemplo de uso (n. <?php echo $example_bundle_count; ?>)</small>
              </div>
        
          <?php

          $number_of_items = $result->rowCount();
          ?>
          <button items="<?php echo $number_of_items; ?>" id='add_example_bundle_<?php echo $example_bundle_id; ?>' count_sense_bundle="<?php echo $count_sense_bundle; ?>" sense_bundle="<?php echo $sense_bundle_id; ?>" type="button"  class='btn btn-default btn-sm p-0 add_example_bundle'>
            <span class="material-icons md-18">add_box</span>
          </button>
          <button items="<?php echo $number_of_items; ?>" id='del_example_bundle_<?php echo $example_bundle_id; ?>' count_sense_bundle="<?php echo $count_sense_bundle; ?>" sense_bundle="<?php echo $sense_bundle_id;?>" type="button"  example_bundle="<?php echo $example_bundle_id;?>" class='btn btn-default btn-sm p-0 del_example_bundle'>
            <span class="material-icons md-18">delete</span>
          </button>
                  </div>


            <script>

              $('#add_example_bundle_<?php echo $example_bundle_id; ?>').on('click', function(){

                  var lang_code = $(this).attr('lang_code');
                  var sense_bundle = $(this).attr('sense_bundle');
                  //var example_bundle = $(this).attr('example_bundle');
                  var items = $(this).attr('items');
                  var count_sense_bundle = $(this).attr('count_sense_bundle');
                  //var select = document.getElementById('product_id');
                  //var index = $('#example').selectedIndex;
                  //var given_text = index.options[index].value;
                              //            console.log(search);
                  var div = "#example_bundle_div_".concat(sense_bundle);
                  var add_example_bundle = 1;
                  //$(this).attr('items', items_new);
                  console.log("insert_example");

                  
                  $.ajax({
                      url:'edit_example_bundle.php',
                      data:{sense_bundle:sense_bundle, add_example_bundle:add_example_bundle, count_sense_bundle:count_sense_bundle, items:items},
                      type: 'POST',
                      success: function(data){
                          if(!data.error){
                              $(div).html(data);
                  
                          }
                      }
                      
                  
                  
                  
                  })
                  

                })


              $('#del_example_bundle_<?php echo $example_bundle_id; ?>').on('click', function(){
              //    var lang_code = $(this).attr('lang_code');
                  var sense_bundle = $(this).attr('sense_bundle');
                  var example_bundle = $(this).attr('example_bundle');
                  var count_sense_bundle = $(this).attr('count_sense_bundle')
                  //var select = document.getElementById('product_id');
                //var index = $('#example').selectedIndex;
                //var given_text = index.options[index].value;
                            //            console.log(search);
                  var div = "#example_bundle_div_".concat(sense_bundle);
                  //var add_example_id = "#add_example_"+bundle+"_"+lang_code;
              //    var items = $(add_example_id).attr('items');
                  var del_example_bundle = 1;
                  //var restore_sense = 1;
                  //var example_id = $(this).attr('example_id');
                  //var items_new = (parseInt(items))-1;
                  //$(add_example_id).attr('items', items_new);

                
                $.ajax({
                    url:'edit_example_bundle.php',
                    data:{sense_bundle:sense_bundle, example_bundle:example_bundle, count_sense_bundle:count_sense_bundle, del_example_bundle:del_example_bundle},
                    type: 'POST',
                    success: function(data){
                        if(!data.error){
                            $(div).html(data);
                
                        }
                    }
                    
                
                  })
                  
              })


            </script>

              <?php
          
          ?>
           <div id="example_vernacular_bundle_all_<?php echo $example_bundle_id;?>" class="example_vernacular_bundle_all p-0">
  <?php

          foreach($source_langs_info as $source_lang_info){
            $index = $source_lang_info['index'];
            $source_lang = $source_lang_info['source_lang']; 
            $lang_code = $source_lang_info['lang_code']; 
            ?>
            <div id="example_vernacular_bundle_<?php echo $lang_code;?>_<?php echo $example_bundle_id;?>" class="p-0"> 
            <?php
         $new=0;
              example_vernacular_edit($example_bundle_id, $entry_ref, $lang_code, $source_lang,  $new);
    
            ?>
    
            </div>
           <?php
    
          }//foreach
          
          ?>
          <div id="translation_bundle_all_<?php echo $example_bundle_id;?>" class="translation_bundle_all p-0">
          <?php

          $target_langs_info = $_SESSION['config_tls_'.$dic_name];
          foreach($target_langs_info as $target_lang_info){
            $index = $target_lang_info['index'];
            $target_lang = $target_lang_info['target_lang']; 
            $lang_code = $target_lang_info['lang_code'];
            ?>
            <div id="example_translation_bundle_<?php echo $lang_code;?>_<?php echo $example_bundle_id;?>"> 
            <?php
            $new = 0;
            example_translation_edit($example_bundle_id, $lang_code, $target_lang, $new);
          
            ?>
    
            </div>
           <?php
    
          }//foreach
          
          ?>
          </div>
           </div>
          </div>
                    
                    
          <?php

        $example_bundle_count++;



        } // foreach
  
       
      }else{
        
        ?>
           <div id="example_bundle_all_<?php echo $example_bundle_count; ?>" class="sense_bundle_all_<?php echo $example_bundle_count; ?>">
          <div class="d-flex">
          <div id="example_bundle_field_tag_<?php echo $sense_bundle_id; ?>" class="ml-auto field_tag">
              <small>exemplo de uso</small>
              </div>
        
     
        <?php
                  $number_of_items = $result->rowCount();
                  ?>
          <button items="<?php echo $number_of_items; ?>" id='add_example_bundle_0_<?php echo $sense_bundle_id; ?>' count_sense_bundle="<?php echo $count_sense_bundle; ?>" sense_bundle="<?php echo $sense_bundle_id; ?>" type="button"  class='btn btn-default btn-sm p-0 add_example_bundle'>
            <span class="material-icons md-18">add_box</span>
          </button>
     
             </div>
 
             <script>
            
            $('#add_example_bundle_0_<?php echo $sense_bundle_id; ?>').on('click', function(){

              console.log("insert_example");
                var lang_code = $(this).attr('lang_code');
                var sense_bundle = $(this).attr('sense_bundle');
                //var example_bundle = $(this).attr('example_bundle');
                var items = $(this).attr('items');
                var count_sense_bundle = $(this).attr('count_sense_bundle');
                //var select = document.getElementById('product_id');
                //var index = $('#example').selectedIndex;
                //var given_text = index.options[index].value;
                            //            console.log(search);
                var div = "#example_bundle_div_".concat(sense_bundle);
                var add_example_bundle = 1;
                //$(this).attr('items', items_new);

                
                $.ajax({
                    url:'edit_example_bundle.php',
                    data:{sense_bundle:sense_bundle, add_example_bundle:add_example_bundle, count_sense_bundle:count_sense_bundle, items:items},
                    type: 'POST',
                    success: function(data){
                        if(!data.error){
                            $(div).html(data);
                
                        }
                    }
                    
                
                
                
                })
                

              })

        </script>   


          <div id="example_vernacular_bundle_all_0" class="example_vernacular_bundle_all">
        <?php  

  ?>
  </div>
          </div>
      <?php
          //echo "A busca não retornou nenhum resultado.";
      } // if

      ?>
      <?php

    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try      
    //END //example_bundles //END
}
//END //example_bundle_output function//END

//START //example_vernacular function  //START
function example_vernacular_edit ($example_bundle_id, $entry_ref, $lang_code, $source_lang, $new){
        $dic_name = "";
    include ("connection.php");
    //START //examples //START
    ?>
      <div class="col-12 col-xl-12 d-flex m-0 p-0 flex-column example_bundle sl<?php echo $source_lang;?>">

    <?php
    try {
  
      $result = $link->query("SELECT * FROM examples WHERE example_bundle_id  = '$example_bundle_id' AND lang_code='$lang_code' ORDER BY example_order");
      if($result->rowCount()>0){
        foreach ($result as $key => $row){
          $example_id=$row["example_id"];                    
          $ex_vernacular=$row["vernacular"];
          $example_order=$row["example_order"];                    

      ?>
          <div id="ex_vernacular_bundle_<?php echo $example_id; ?>" class="col-12 col-xl-12 d-flex flex-column p-0">
          <div class="p-0 pb-1 d-flex">
          <div id="example_field_tag_<?php echo $example_id; ?>" class="ml-auto field_tag sl<?php echo $source_lang; ?>">
              <small>exemplo <?php echo "[$lang_code]"; ?></small>
              </div>
         
          <button example_order='<?php echo $example_order; ?>' id='del_example_vernacular_<?php echo $lang_code; ?>_<?php echo $example_bundle_id; ?>' source_lang="<?php echo $source_lang; ?>" example_id="<?php echo $example_id; ?>" entry_ref="<?php echo $entry_ref; ?>" example_bundle="<?php echo $example_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button"  class='btn btn-default btn-sm p-0 del_example_vernacular<?php if($new==0){}else{echo '_'.$example_bundle_id.'_'.$lang_code;}?>'>
            <span class="material-icons md-18">delete</span>
          </button>

        
          </div>

          <script>

            

            $('#del_example_vernacular_<?php echo $lang_code; ?>_<?php echo $example_bundle_id; ?>').on('click', function(){
                var lang_code = $(this).attr('lang_code');
                var source_lang = $(this).attr('source_lang');
                var entry_ref = $(this).attr('entry_ref');
                //var source_lang = $(this).attr('source_lang');
                //var sense_bundle = $(this).attr('sense_bundle');
                var example_id = $(this).attr('example_id');
                var example_bundle = $(this).attr('example_bundle');
                //var count_sense_bundle = $(this).attr('count_sense_bundle')
                //var select = document.getElementById('product_id');
              //var index = $('#example').selectedIndex;
              //var given_text = index.options[index].value;
                          //            console.log(search);
                var div = "#example_vernacular_bundle_".concat(lang_code).concat("_").concat(example_bundle);
                //var add_example_id = "#add_example_"+bundle+"_"+lang_code;
            //    var items = $(add_example_id).attr('items');
                var del_example_vernacular = 1;
                //var restore_sense = 1;
                //var example_id = $(this).attr('example_id');
                //var items_new = (parseInt(items))-1;
                //$(add_example_id).attr('items', items_new);
                console.log('.del_example_vernacular');
                console.log(div);

              
              $.ajax({
                  url:'edit_example_bundle.php',
                  data:{example_bundle:example_bundle, example_id:example_id, lang_code:lang_code, entry_ref:entry_ref, source_lang:source_lang, del_example_vernacular:del_example_vernacular},
                  type: 'POST',
                  success: function(data){
                      if(!data.error){
                          $(div).html(data);
              
                      }
                  }
                  
              
                })
              
                  /*
                $.ajax({
                  url:'modal_update.php',
                  data:{bundle:bundle, lang_code:lang_code, example_id:example_id, example_order:items_new, restore_sense:restore_sense},
                  type: 'POST',
                  success: function(data){
                      if(!data.error){
                          $('#modal_def_panel').html(data);
              
                      }
                  }
                
              })
              
            */

                
            })



          </script>

            <div id="ex_vernacular_bundle_<?php echo $example_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight ex_vernacular_bundle sl<?php echo $source_lang; ?>">

            <input first="1" id="example_input_vernacular_<?php echo $lang_code; ?>_<?php echo $example_id; ?>" example_id="<?php echo $example_id; ?>" class="form-control form-control-sm ml-auto example_input<?php if($new==0){}else{echo '_'.$example_bundle_id.'_'.$lang_code;}?>"  type="text" value="<?php echo $ex_vernacular;?>" >
            </div>
          </div>
          <script>

              $('#example_input_vernacular_<?php echo $lang_code; ?>_<?php echo $example_id; ?>').keyup(function(){
                var example_id = $(this).attr('example_id');

                //var lang_code = $(this).attr('lang_code');
                //var bundle = $(this).attr('bundle');
                var first = $(this).attr('first');
                var example = $(this).val();
                //var original = $(this).attr('original');
                //var sense_id = $(this).attr('sense_id');
                var update_example = 1;

                if(first==1){
                  $(this).attr('first', 0);
                  var bck_example = 1;
                  console.log("example input change");
                  console.log(example_id);
                  console.log(example);
                    
                  $.ajax({
                    url:'edit_example_bundle.php',
                    data:{example_id:example_id, bck_example:bck_example, example:example, update_example:update_example},
                    type: 'POST',
                    success: function(data){
                      /*  if(!data.error){
                            $(def_div).html(data);
                
                        }*/
                    }
                    
                
                  })
                



                }else{

                  console.log("example input change");
                  console.log(example_id);
                  console.log(example);
                    
                  $.ajax({
                    url:'edit_example_bundle.php',
                    data:{example_id:example_id, example:example, update_example:update_example},
                    type: 'POST',
                    success: function(data){
                      /*  if(!data.error){
                            $(def_div).html(data);
                
                        }*/
                    }
                    
                
                  })
                
                  
                }

              /*  
                $.ajax({
                url:'modal_update.php',
                data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, update_sense:update_sense},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $('#modal_def_panel').html(data);

                    }
                  }
                    
                })

                */
              })


          </script>
          <div id="example_pron_div_<?php echo $example_id;?>">
          <?php
          

            example_prons_edit($example_id, $entry_ref, $lang_code, $source_lang)

          ?>
          </div>
                    
          <?php
        } // foreach     
      }else{

        ?>
        <div id="ex_vernacular_bundle_<?php //echo $example_id  ?>" class="p-0 col-12 col-xl-12 d-flex flex-column">
        <div class="p-0 pb-1 d-flex">
        <div id="example_field_tag_0" class="ml-auto field_tag sl<?php echo $source_lang; ?>">
              <small>exemplo <?php echo "[$lang_code]"; ?></small>
              </div>
              

        <button example_order='1' id='create_example_vernacular_<?php echo $lang_code; ?>_<?php echo $example_bundle_id; ?>'  entry_ref="<?php echo $entry_ref; ?>" source_lang="<?php echo $source_lang; ?>" lang_code="<?php echo $lang_code; ?>" example_bundle="<?php echo $example_bundle_id; ?>" type="button"  class='btn btn-default btn-sm p-0 create_example_vernacular<?php if($new==0){}else{echo '_'.$example_bundle_id.'_'.$lang_code;}?>'>
            <span class="material-icons md-18">create</span>
          </button>

        </div>

        <script>
          $('#create_example_vernacular_<?php echo $lang_code; ?>_<?php echo $example_bundle_id; ?>').on('click', function(){

              var lang_code = $(this).attr('lang_code');
              var source_lang = $(this).attr('source_lang');
              var entry_ref = $(this).attr('entry_ref');
              var example_bundle = $(this).attr('example_bundle');
              //var items = $(this).attr('items');
              var example_order = $(this).attr('example_order');
              //var select = document.getElementById('product_id');
              //var index = $('#example').selectedIndex;
              //var given_text = index.options[index].value;
                          //            console.log(search);
              var div = "#example_vernacular_bundle_".concat(lang_code).concat("_").concat(example_bundle);
              var create_example_vernacular = 1;
              //$(this).attr('items', items_new);
              console.log("create_example_vernacular");
            console.log(create_example_vernacular);
              console.log(div);
              console.log(source_lang);
              console.log(example_order);
              
              $.ajax({
                  url:'edit_example_bundle.php',
                  data:{example_bundle:example_bundle, create_example_vernacular:create_example_vernacular, example_order:example_order, source_lang:source_lang, lang_code:lang_code, entry_ref:entry_ref},
                  type: 'POST', 
                  success: function(data){
                      if(!data.error){
                          $(div).html(data);
              
                      }
                  }
                  
              
              
              
              })
              

            })

        </script>
        <div id="ex_vernacular_bundle_<?php echo $example_bundle_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight ex_vernacular_bundle sl<?php echo $source_lang; ?>">
        </div>
      </div>

      <?php
          //echo "A busca não retornou nenhum resultado.";
      } // if
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //examples //END
    ?>
      </div>


    <?php
}
//END //example_vernacular function//END


//START //example_prons function  //START
function example_prons_edit($example_id, $entry_ref, $lang_code, $source_lang){
      $dic_name = "";
    include ("connection.php");
  //START //example_prons //START
  try {

    
    $result = $link->query("SELECT * FROM example_prons WHERE example_id  = '$example_id' ORDER BY example_id");
    $items=$result->rowCount();

    ?>

    
  <div class="p-0 pb-1">
    <div id="example_pron_bundle_<?php echo $example_id ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight example_pron_bundle sl<?php echo $source_lang; ?>">
    
    <div id="example_field_tag_0" class="ml-auto field_tag sl<?php echo $source_lang; ?>">
              <small>exemplo pronúncia (áudio) <?php echo "[$lang_code]"; ?></small>
              </div>
      <div>
     
      <button id='add_example_pron_<?php echo $example_id; ?>' example_id='<?php echo $example_id; ?>' entry_ref='<?php echo $entry_ref; ?>' lang_code='<?php echo $lang_code; ?>' source_lang='<?php echo $source_lang; ?>' items='<?php echo $items; ?>' type="button"  class='btn btn-default btn-sm p-0 add_example_pron'>
        <span class="material-icons md-18">add_box</span>
      </button>
      
      </div>
      </div>

    <?php




    if($result->rowCount()>0){
      foreach ($result as $key => $row){
        $example_pron_id=$row["example_pron_id"];                    
        $ex_phonetic=$row["phonetic"];                    
        $wav=$row["wav"];
        $mp3=$row["mp3"];
        $mp4=$row["mp4"];
        $wma=$row["wma"];
      
    ?>



      <?php
      if(empty($wav) && empty($mp3) && empty($mp4) && empty($wma)){


        ?>

        <div hidden>
                  <form enctype="multipart/form-data" id="form_<?php echo $example_pron_id;?>" method="post">
            <input id="input_example_pron_<?php echo $example_pron_id;?>" type="file" accept=".wav, .mp3, .mp4, .wma" name="file" required="required">

            </form> 
                      </div>
                  <div class="col-12 col-xl-12 p-0 bd-highlight d-flex example_pron_bundle sl<?php echo $source_lang; ?>">
                
                  <small><a id="example_pron_file_<?php echo $example_pron_id; ?>"></a></small>
                    <div  id="example_pron_file_del_<?php echo $example_pron_id; ?>" class="ml-auto" ><button id='del_example_pron_<?php echo $example_pron_id; ?>' type="button"   example_pron_id='<?php echo $example_pron_id; ?>' example_id='<?php echo $example_id; ?>' entry_ref='<?php echo $entry_ref; ?>' lang_code='<?php echo $lang_code; ?>' source_lang='<?php echo $source_lang; ?>' items='<?php echo $items; ?>' class='btn btn-default btn-sm p-0 del_example_pron'>
                    <span class="material-icons md-18">delete</span></button>
                    </div>
                    <div  id="example_pron_file_upload_<?php echo $example_pron_id; ?>" class="" ><button id='upload_example_pron_<?php echo $example_pron_id; ?>' example_pron_id='<?php echo $example_pron_id; ?>' example_id='<?php echo $example_id; ?>' entry_ref='<?php echo $entry_ref; ?>' lang_code='<?php echo $lang_code; ?>' source_lang='<?php echo $source_lang; ?>' items='<?php echo $items; ?>' type="button"  class='btn btn-default btn-sm p-0 upload_example_pron'>
                    <span class="material-icons md-18">cloud_upload</span></button>
                    </div>

                  </div>
                    

            
        <?php
      }else{
        
        ?>

        <div id="example_pron_bundle_<?php echo $example_pron_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight pron_bundle sl<?php echo $source_lang; ?>">

        <a id="example_pron_<?php echo $example_pron_id; ?>" class="ml-auto pr-1 pron"  type="text"><small><?php echo $wav?></small></a>
      
        <button id='del_example_pron_<?php echo $example_pron_id; ?>' type="button"   example_pron_id='<?php echo $example_pron_id; ?>' example_id='<?php echo $example_id; ?>' entry_ref='<?php echo $entry_ref; ?>' lang_code='<?php echo $lang_code; ?>' source_lang='<?php echo $source_lang; ?>' items='<?php echo $items; ?>' class='btn btn-default btn-sm p-0 del_example_pron'>
          <span class="material-icons md-18">delete</span>
        </button>
              
      <button id='btn_example_pron_<?php echo $example_pron_id;?>' example_pron_id="<?php echo $example_pron_id;?>" type="button"  audio="assets/audio/<?php echo $wav?>" class='btn btn-default btn-sm btn_example_pron sl<?php echo $source_lang;?> d-inline-flex p-0'>
          <span class="material-icons md-18">volume_up</span>
      </button>
      <audio controls hidden id="audio_<?php echo $example_pron_id;?>">

      <source id="<?php echo $example_id;?>_wav" src="assets/audio/<?php echo $wav?>" type="audio/wav">
      <source id="<?php echo $example_id;?>_mp3" src="assets/audio/<?php echo $mp3?>" type="audio/mpeg">

      <!-- <source id="<?php echo $example_id;?>_ogg" src="#" type="audio/ogg">
      <source id="<?php echo $example_id;?>_mp3" src="assets/audio/<?php echo $mp3?>" type="audio/mpeg">
      -->
      </audio>   
          </div>
      
  

  
  <?php

  }//if (empty($wav) && empty($mp3) && empty($mp4) && empty($wma) // else


  ?>
  <div class="p-0 pb-1">
          <div id="example_phonetic_<?php echo $example_id ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight example_bundle sl<?php echo $source_lang; ?>">
        
          <div id="example_phonetic_field_tag_0" class="ml-auto field_tag sl<?php echo $source_lang; ?>">
              <small>forma fonética (exemplo) <?php echo "[$lang_code]"; ?></small>
              </div>
      <div>

      <?php
      if(!empty($ex_phonetic)){

        ?>
        <button example_order='1' id='delete_example_phonetic_<?php echo $lang_code; ?>_<?php echo $example_pron_id; ?>'  entry_ref="<?php echo $entry_ref; ?>" source_lang="<?php echo $source_lang; ?>" lang_code="<?php echo $lang_code; ?>" example_id="<?php echo $example_id; ?>" example_pron_id="<?php echo $example_pron_id; ?>" type="button"  class="btn btn-default btn-sm p-0 delete_example_phonetic_<?php echo $example_pron_id.'_'.$lang_code;?>">
            <span class="material-icons md-18">delete</span>
          </button>
          <?php
    
      }else{    ?>
        <button example_order='1' id='create_example_phonetic_<?php echo $lang_code; ?>_<?php echo $example_pron_id; ?>'  entry_ref="<?php echo $entry_ref; ?>" source_lang="<?php echo $source_lang; ?>" lang_code="<?php echo $lang_code; ?>" example_id="<?php echo $example_id; ?>" example_pron_id="<?php echo $example_pron_id; ?>" type="button"  class="btn btn-default btn-sm p-0 create_example_phonetic_<?php echo $example_pron_id.'_'.$lang_code;?>">
            <span class="material-icons md-18">create</span>
          </button>
          <?php
    } 
      ?>

    </div>

      </div>
      <div id="example_phonetic_bundle_<?php echo $example_pron_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight example_phonetic_bundle sl<?php echo $source_lang; ?>">
      </div>

      <div class="d-flex flex-wrap">
        <?php 
      if(!empty($ex_phonetic)){
        ?> 
        <input first="1" id="example_phonetic_input_<?php echo $example_pron_id; ?>" example_pron_id="<?php echo $example_pron_id; ?>" entry_ref="<?php echo $entry_ref; ?>" source_lang="<?php echo $source_lang; ?>" lang_code="<?php echo $lang_code; ?>" example_id="<?php echo $example_id; ?>" class="form-control form-control-sm ml-auto pr-1 example_phonetic_input_<?php echo $example_pron_id.'_'.$lang_code;?>"  type="text" value="<?php echo $ex_phonetic; ?>" ><?php
        }else{ }//if !empty $ex_phonetic ?>

    </div>


    </div>

  <script>

        $('#example_phonetic_input_<?php echo $example_pron_id; ?>').keyup(function(){
          var lang_code = $(this).attr('lang_code');
            var source_lang = $(this).attr('source_lang');
            var entry_ref = $(this).attr('entry_ref');
            var first = $(this).attr('first');
            var example_pron_id = $(this).attr('example_pron_id');
            var example_id = $(this).attr('example_id');
            var div = "#example_pron_div_".concat(example_id);
            
            var update_example_phonetic = 1;
            var example_phonetic = $(this).val();
            //$(this).attr('items', items_new);
            console.log("update_example_phonetic");
            console.log(update_example_phonetic);
            console.log(div);
            console.log(example_id);
            console.log(source_lang);
            
            

          if(first==1){
            $(this).attr('first', 0);
            var bck_example_phonetic = 1;
            console.log("example phonetic input change with bck");
            console.log(example_id);
            console.log(example_phonetic);
              
          }else{
            var bck_example_phonetic = 0;
            console.log("example phonetic input change without bck");
            console.log(example_id);
            console.log(example_phonetic);
              
            
          }


          $.ajax({
              url:'edit_example_bundle.php',
              data:{example_id:example_id, example_pron_id:example_pron_id, update_example_phonetic:update_example_phonetic, bck_example_phonetic:bck_example_phonetic, example_phonetic:example_phonetic, source_lang:source_lang, lang_code:lang_code, entry_ref:entry_ref},
              type: 'POST',
              success: function(data){
                //if(!data.error){
                      //  $(div).html(data);
            
                    //}
              }
              
          
            })
          





        /*  
          $.ajax({
          url:'modal_update.php',
          data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, update_sense:update_sense},
          type: 'POST',
          success: function(data){
              if(!data.error){
                  $('#modal_def_panel').html(data);

              }
            }
              
          })

          */
        })


    </script>
    <script>
              
            $('#delete_example_phonetic_<?php echo $lang_code; ?>_<?php echo $example_pron_id; ?>').on('click', function(){
            
            var lang_code = $(this).attr('lang_code');
            var source_lang = $(this).attr('source_lang');
            var entry_ref = $(this).attr('entry_ref');
            var example_pron_id = $(this).attr('example_pron_id');
            //var items = $(this).attr('items');
            var example_id = $(this).attr('example_id');
            //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
                        //            console.log(search);
            var div = "#example_pron_div_".concat(example_id);
            var delete_example_phonetic = 1;
            //$(this).attr('items', items_new);
            console.log("delete_example_phonetic");
            console.log(delete_example_phonetic);
            console.log(div);
            console.log(example_id);
            console.log(source_lang);
            
            $.ajax({
                url:'edit_example_bundle.php',
                data:{example_id:example_id, example_pron_id:example_pron_id, delete_example_phonetic:delete_example_phonetic, source_lang:source_lang, lang_code:lang_code, entry_ref:entry_ref},
                type: 'POST', 
                success: function(data){
                    if(!data.error){
                        $(div).html(data);
            
                    }
                }
                
            
            
            
            })
            
            
            })
            
              </script>

    <script>
                      
          $('#create_example_phonetic_<?php echo $lang_code; ?>_<?php echo $example_pron_id; ?>').on('click', function(){

          var lang_code = $(this).attr('lang_code');
          var source_lang = $(this).attr('source_lang');
          var entry_ref = $(this).attr('entry_ref');
          var example_pron_id = $(this).attr('example_pron_id');
          //var items = $(this).attr('items');
          var example_id = $(this).attr('example_id');
          //var select = document.getElementById('product_id');
          //var index = $('#example').selectedIndex;
          //var given_text = index.options[index].value;
                      //            console.log(search);
          var div = "#example_pron_div_".concat(example_id);
          var create_example_phonetic = 1;
          //$(this).attr('items', items_new);
          console.log("create_example_phonetic");
          console.log(create_example_phonetic);
          console.log(div);
          console.log(example_id);
          console.log(source_lang);

          $.ajax({
              url:'edit_example_bundle.php',
              data:{example_id:example_id, example_pron_id:example_pron_id, create_example_phonetic:create_example_phonetic, source_lang:source_lang, lang_code:lang_code, entry_ref:entry_ref},
              type: 'POST', 
              success: function(data){
                  if(!data.error){
                      $(div).html(data);

                  }
              }
              



          })


          })

    </script>
      <script>
          
          $('#btn_example_pron_<?php echo $example_pron_id;?>').click(function() {
          
          
          var example_pron_id = $(this).attr('example_pron_id');
          
          var audio_id = "#audio_".concat(example_pron_id);
          var audio_play = $(audio_id).get(0);
          audio_play.load();
          audio_play.play();
          
          
          });
          </script>
          
      <script>
            $("#example_pron_file_upload_<?php echo $example_pron_id; ?>").click(function () {
              $("#input_example_pron_<?php echo $example_pron_id;?>").trigger('click');
          });
          </script>

          <script type="application/javascript">
              $('#input_example_pron_<?php echo $example_pron_id;?>').change(function(e){
                  var fileName = e.target.files[0].name;
                  //$('#example_pron_file_<?php echo $example_pron_id; ?>').html(fileName);
                  //$("#save_example_pron_<?php echo $example_pron_id; ?>").prop('disabled', false);

                  var div= "#example_pron_div_<?php echo $example_id; ?>";
                  var formData = new FormData($("#form_<?php echo $example_pron_id;?>")[0]);
                  formData.append('example_pron_id', <?php echo $example_pron_id; ?>); //id is the variable that has the data that I need
                  formData.append('example_id', <?php echo $example_id; ?>); //id is the variable that has the data that I need
                  formData.append('source_lang', <?php echo $source_lang; ?>); //id is the variable that has the data that I need
                  formData.append('lang_code', '<?php echo $lang_code; ?>'); //id is the variable that has the data that I need
                  formData.append('entry_ref', '<?php echo $entry_ref;?>');
                  //formData.append('entry_ref', <?php echo $entry_ref; ?>); //id is the variable that has the data that I need
                  //formData.append('entry_ref', <?php echo $entry_ref; ?>); //id is the variable that has the data that I need
                  console.log("upload example_pron");
                console.log(div);
               
                  $.ajax({
                      url: "edit_example_bundle.php",
                      type: "POST",
                      data: formData,
                      contentType: false,
                      processData: false,
                      success: function (data) {
                            if(!data.error){
                            $(div).html(data);
                
                        }
                      }
                  });
              });
              
          </script>


          <script>
            
            
            $('#del_example_pron_<?php echo $example_pron_id; ?>').on('click', function(){
              //var lang_code = $(this).attr('lang_code');
              //var bundle = $(this).attr('bundle');
              //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
                        //            console.log(search);
              var lang_code = $(this).attr('lang_code');
              var entry_ref=$(this).attr('entry_ref');
              var source_lang=$(this).attr('source_lang');
              var example_id = $(this).attr('example_id');
              var example_pron_id = $(this).attr('example_pron_id');
              var items = $(this).attr('items');
              var add_example_pron_id = "#add_example_pron_".concat(example_id);
              //var count_phonemic_bundle = $(this).attr('count_phonemic_bundle');
              //var select = document.getElementById('product_id');
              //var index = $('#example_pron').selectedIndex;
              //var given_text = index.options[index].value;
                          //            console.log(search);
              var div = "#example_pron_div_".concat(example_id);
              //var items = $(add_example_pron_id).attr('items');
              var del_example_pron = 1;
              var bck_example_pron = 1;
              var items_new = (parseInt(items))-1;
              $(add_example_pron_id).attr('items', items_new);

            
            $.ajax({
                url:'edit_example_bundle.php',
                data:{example_id:example_id, lang_code:lang_code, entry_ref:entry_ref, source_lang:source_lang, example_pron_id:example_pron_id, bck_example_pron:bck_example_pron, del_example_pron:del_example_pron},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(div).html(data);
            
                    }
                }
                
            
              })
            
            /*    
            $.ajax({
              url:'modal_update.php',
              data:{bundle:bundle, lang_code:lang_code, example_pron_id:example_pron_id, example_pron_order:items_new, restore_example_pron:restore_example_pron},
              type: 'POST',
              success: function(data){
                  if(!data.error){
                      $('#modal_example_pron_panel').html(data);

                  }
              }
              



          })

          */

            
            })

          </script>

    <?php


      }// foreach

    }else{

      ?>
    

    
      <?php
        
      }//if

      ?>

    <script>
          
        $('#add_example_pron_<?php echo $example_id; ?>').on('click', function(){

        var lang_code = $(this).attr('lang_code');
        var entry_ref=$(this).attr('entry_ref');
        var source_lang=$(this).attr('source_lang');
          var example_id = $(this).attr('example_id');
        //var example_pron = $(this).attr('example_pron');
        var items = $(this).attr('items');
        //var count_phonemic_bundle = $(this).attr('count_phonemic_bundle');
        //var select = document.getElementById('product_id');
        //var index = $('#example_pron').selectedIndex;
        //var given_text = index.options[index].value;
                    //            console.log(search);
        var div = "#example_pron_div_".concat(example_id);
        var add_example_pron = 1;
        //$(this).attr('items', items_new);
        console.log("add example_pron");
        console.log(div);
        console.log(example_id);
        console.log(lang_code);
        console.log(entry_ref);
        console.log(source_lang);
        console.log(items);

        $.ajax({
            url:'edit_example_bundle.php',
            data:{example_id:example_id, add_example_pron:add_example_pron, entry_ref:entry_ref, source_lang:source_lang, lang_code:lang_code, items:items},
            type: 'POST',
            success: function(data){
                if(!data.error){
                    $(div).html(data);

                }
            }
            



        })


        })



      </script>

    <?php


    ?>
    </div>
    <?php

    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try


}
//END //example_prons function//END



//START //example_translation function  //START
function example_translation_edit ($example_bundle_id, $lang_code, $target_lang, $new){
      $dic_name = "";
    include ("connection.php");
  //START //translations //START
  try {

    ?>
        <div class="col-12 col-xl-12 d-flex p-0 flex-column translation_bundle sl<?php echo $target_lang;?>">
            
          <div class="p-0 pb-1">

      <div id="translation_<?php echo $example_bundle_id ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight translation_bundle sl<?php echo $target_lang; ?>">

      <div id="example_translation_field_tag_<?php echo $example_bundle_id ?>_<?php echo $target_lang; ?>" class="ml-auto field_tag tl<?php echo $target_lang; ?>">
              <small>tradução do exemplo <?php echo "[$lang_code]"; ?></small>
              </div>              <div>
              <?php

  $result = $link->query("SELECT * FROM translations WHERE example_bundle_id  = '$example_bundle_id' AND lang_code='$lang_code' ORDER BY translation_id");

      if($result->rowCount()>0){


        ?>
        <button translation_order='1' id='del_example_translation_<?php echo $lang_code; ?>_<?php echo $example_bundle_id; ?>' target_lang="<?php echo $target_lang; ?>" lang_code="<?php echo $lang_code; ?>" example_bundle="<?php echo $example_bundle_id; ?>" type="button"  class='btn btn-default btn-sm p-0 del_example_translation<?php if($new==0){}else{echo '_'.$example_bundle_id.'_'.$lang_code;}?>'>
          <span class="material-icons md-18">delete</span>
        </button>
        <script>
                
      $('#del_example_translation_<?php echo $lang_code; ?>_<?php echo $example_bundle_id; ?>').on('click', function(){
            var lang_code = $(this).attr('lang_code');
            //var sense_bundle = $(this).attr('sense_bundle');
            //var target_lang = $(this).attr('target_lang');
            var example_bundle = $(this).attr('example_bundle');
            //var count_sense_bundle = $(this).attr('count_sense_bundle')
            //var select = document.getElementById('product_id');
          //var index = $('#example').selectedIndex;
          //var given_text = index.options[index].value;
                      //            console.log(search);
            var div = "#example_translation_bundle_".concat(lang_code).concat("_").concat(example_bundle);
            //var add_example_id = "#add_example_"+bundle+"_"+lang_code;
        //    var items = $(add_example_id).attr('items');
            var del_example_translation = 1;
            //var restore_sense = 1;
            //var example_id = $(this).attr('example_id');
            //var items_new = (parseInt(items))-1;
            //$(add_example_id).attr('items', items_new);
            console.log('.del_example_translation');
            console.log(div);
        
          
          $.ajax({
              url:'edit_example_bundle.php',
              data:{example_bundle:example_bundle, lang_code:lang_code, del_example_translation:del_example_translation},
              type: 'POST',
              success: function(data){
                  if(!data.error){
                      $(div).html(data);
          
                  }
              }
              
          
            })
          
              /*
            $.ajax({
              url:'modal_update.php',
              data:{bundle:bundle, lang_code:lang_code, example_id:example_id, example_order:items_new, restore_sense:restore_sense},
              type: 'POST',
              success: function(data){
                  if(!data.error){
                      $('#modal_def_panel').html(data);
          
                  }
              }
            
          })
          
        */
        
            
        })
        
        </script>
    
  <?php
        }else{

          ?>
          <button translation_order='1' id='create_example_translation_<?php echo $lang_code; ?>_<?php echo $example_bundle_id; ?>' target_lang="<?php echo $target_lang; ?>" lang_code="<?php echo $lang_code; ?>" example_bundle="<?php echo $example_bundle_id; ?>" type="button"  class='btn btn-default btn-sm p-0 create_example_translation<?php if($new==0){}else{echo '_'.$example_bundle_id.'_'.$lang_code;}?>'>
      <span class="material-icons md-18">create</span>
    </button>

      <script>
        

          $('#create_example_translation_<?php echo $lang_code; ?>_<?php echo $example_bundle_id; ?>').on('click', function(){

            var lang_code = $(this).attr('lang_code');
            var target_lang = $(this).attr('target_lang');
            //var sense_bundle = $(this).attr('sense_bundle');
            var example_bundle = $(this).attr('example_bundle');
            //var items = $(this).attr('items');
            var translation_order = $(this).attr('translation_order');
            //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
                        //            console.log(search);
            var div = "#example_translation_bundle_".concat(lang_code).concat("_").concat(example_bundle);
            var create_example_translation = 1;
            //$(this).attr('items', items_new);
            console.log("create_example_translation");
          console.log(create_example_translation);
            console.log(div);
            console.log(target_lang);
            
            $.ajax({
                url:'edit_example_bundle.php',
                data:{example_bundle:example_bundle, translation_order:translation_order, create_example_translation:create_example_translation, target_lang:target_lang, lang_code:lang_code},
                type: 'POST', 
                success: function(data){
                    if(!data.error){
                        $(div).html(data);
            
                    }
                }
                
            
            
            
            })
            

          })

              

      </script>
  <?php

        }
        ?>
                </div>
      </div>
      <?php

    
      if($result->rowCount()>0){

        foreach ($result as $key => $row){
          $translation_id=$row["translation_id"];                   
          $translation=$row["translation"];
          ?>
          
                  <div id="translation_bundle_<?php echo $example_bundle_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight translation_bundle sl<?php echo $target_lang; ?>">

                  <input id="translation_<?php echo $example_bundle_id; ?>_<?php echo $lang_code; ?>" translation_id="<?php echo $translation_id; ?>" class="form-control form-control-sm ml-auto pr-1 translation_input<?php if($new==0){}else{echo '_'.$example_bundle_id.'_'.$lang_code;}?> tl<?php echo $target_lang ?>"  type="text" value="<?php echo $translation;?>" >
                  </div>

                  <script>
                    
                  $('#translation_<?php echo $example_bundle_id; ?>_<?php echo $lang_code; ?>').keyup(function(){
                    var translation_id = $(this).attr('translation_id');

                    //var lang_code = $(this).attr('lang_code');
                    //var bundle = $(this).attr('bundle');
                    var first = $(this).attr('first');
                    var translation = $(this).val();
                    //var original = $(this).attr('original');
                    //var sense_id = $(this).attr('sense_id');
                    var update_translation = 1;
                    console.log("translation input change")

                    if(first==1){
                      $(this).attr('first', 0);
                      var bck_translation = 1;
                      $.ajax({
                      url:'edit_example_bundle.php',
                      data:{translation_id:translation_id, bck_translation:bck_translation, translation:translation, update_translation:update_translation},
                      type: 'POST',
                      success: function(data){
                        /*  if(!data.error){
                              $(def_div).html(data);

                          }*/
                      }
                      

                    })



                    }else{

                      
                      $.ajax({
                        url:'edit_example_bundle.php',
                        data:{translation_id:translation_id, translation:translation, update_translation:update_translation},
                        type: 'POST',
                        success: function(data){
                          /*  if(!data.error){
                                $(def_div).html(data);
                    
                            }*/
                        }
                        
                    
                      })
                    
                    }

                  /*  
                    $.ajax({
                    url:'modal_update.php',
                    data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, update_sense:update_sense},
                    type: 'POST',
                    success: function(data){
                        if(!data.error){
                            $('#modal_def_panel').html(data);

                        }
                      }
                        
                    })

                    */
                  })



                  </script>
                  <?php


        } // foreach

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
    //END //translations //END
}
//END //example_tranlation function//END

//START //images function //START
function images_edit ($sense_bundle_id, $entry_ref){
        $dic_name = "";
    include ("connection.php");
    //START //images //START
    try {
  
      $result = $link->query("SELECT * FROM images WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY image_id");
      $items = $result->rowCount();

      
      ?>
     
        <div id="image_bundle_<?php echo $sense_bundle_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight image_bundle sl">
       

      <div id="image_field_tag_<?php echo $sense_bundle_id ?>" class="ml-auto field_tag">
        <small>imagens</small>
        </div>       


      <div>

          <div hidden>
              <form enctype="multipart/form-data" id="image_form_<?php echo $sense_bundle_id;?>" method="post">
                <input id="input_image_<?php echo $sense_bundle_id;?>" type="file" accept=".jpg, .png, .tif" name="file" required="required">
              </form> 
          </div>
 
      <button id='add_image_<?php echo $sense_bundle_id; ?>' sense_bundle_id='<?php echo $sense_bundle_id; ?>' entry_ref='<?php echo $entry_ref; ?>' items='<?php echo $items; ?>' type="button"  class='btn btn-default btn-sm p-0 add_image'>
        <span class="material-icons md-18">add_box</span>
      </button>
      
      </div>
      </div>
      <script>
            $("#add_image_<?php echo $sense_bundle_id; ?>").click(function () {
              $("#input_image_<?php echo $sense_bundle_id;?>").trigger('click');
          });
          </script>

          <script type="application/javascript">
              $('#input_image_<?php echo $sense_bundle_id;?>').change(function(e){
                  var fileName = e.target.files[0].name;
                  //$('#image_file_<?php echo $sense_bundle_id; ?>').html(fileName);
                  //$("#save_image_<?php echo $sense_bundle_id; ?>").prop('disabled', false);

                  var div= "#image_panel_all_<?php echo $sense_bundle_id;?>";
                  var formData = new FormData($("#image_form_<?php echo $sense_bundle_id;?>")[0]);
                  formData.append('sense_bundle_id', <?php echo $sense_bundle_id; ?>); //id is the variable that has the data that I need
                  formData.append('entry_ref', '<?php echo $entry_ref;?>');
                  formData.append('items', <?php echo $items; ?>); //id is the variable that has the data that I need
                  console.log("upload image");
                  console.log(div);
                  console.log("<?php echo $items; ?>");
                  console.log("<?php echo $entry_ref; ?>");

                  $.ajax({
                      url: "edit_image.php",
                      type: "POST",
                      data: formData,
                      contentType: false,
                      processData: false,
                      success: function (data) {
                        
                            if(!data.error){
                            $(div).html(data);
                            console.log("sem erro ate aqui")

                        }else{
                          console.log("erro no final")
                        }
                        
                      }
                  });
              });
            </script>

      <?php
      if($result->rowCount()>0){
        ?>  

          <div id="image_panel_<?php echo $sense_bundle_id ?>" class="p-0 bd-highlight col-12 col-xl-12 d-flex flex-column image_panel">
        <?php                  
        foreach ($result as $key => $row){
          $image_id=$row["image_id"];                          
          $jpg= $row["jpg"];
  
             ?>
             <div class="ml-auto">
             <div class="d-flex col-12 col-xl-12 p-0 ml-auto bd-highlight">
              <button image_order='1' id='del_image_<?php echo $image_id; ?>' sense_bundle_id='<?php echo $sense_bundle_id; ?>' entry_ref='<?php echo $entry_ref; ?>' items='<?php echo $items; ?>' image_id="<?php echo $image_id; ?>" type="button"  class='btn btn-default btn-sm p-0'>
              <span class="material-icons md-18">delete</span>
            </button>

            <a class="image-popup-vertical-fit" href="assets/image/<?php echo $jpg;?>" title="">
            <img src="assets/image/<?php echo $jpg;?>" id="image_<?php echo $image_id; ?>" class="img rounded" width="150" height="auto" alt="...">
            </a>
             </div>
          </div>

            <div id="image_caption_field_tag_panel_<?php echo $image_id ?>" class="ml-auto p-0 image_caption_tag_panel">
            <div id="example_image_caption_field_tag_<?php echo $image_id ?>" class="col-12 col-xl-12 p-0 field_tag">
              <small>legenda (imagem)</small>
              </div>
            
          </div>
            <div id="image_caption_panel_<?php echo $image_id ?>" class="d-flex flex-wrap col-12 col-xl-12 p-0 bd-highlight image_caption_panel">
              <?php
              
              image_captions_edit ($image_id, $entry_ref);

              ?>

              </div>
            <script>
            
            $('#del_image_<?php echo $image_id; ?>').on('click', function(){
              var sense_bundle_id = $(this).attr('sense_bundle_id');
              //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
                        //            console.log(search);
              var div= "#image_panel_all_<?php echo $sense_bundle_id;?>";
              var add_image_id = "#add_image_<?php echo $sense_bundle_id; ?>";
              var items = $(add_image_id).attr('items');
              var del_image = 1;
              var entry_ref = "<?php echo $entry_ref; ?>";
              var restore_gloss = 1;
              var image_id = $(this).attr('image_id');
              var items_new = (parseInt(items))-1;
              $(add_image_id).attr('items', items_new);
      
            
            $.ajax({
                url:'edit_image.php',
                data:{sense_bundle_id:sense_bundle_id, entry_ref:entry_ref, image_id:image_id, del_image:del_image},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(div).html(data);
            
                    }
                }
                
            
              })
            
      
            
            })

            </script>
      

              <?php
  
        } // foreach
            ?>
          </div>
          <?php  
      }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if
      ?>
        
      
              
        
        

        <?php
    } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //images //END
}
//END //images function//END



function image_captions_edit ($image_id, $entry_ref){
      $dic_name = "";
    include ("connection.php");
  //START //image_captions //START
  try {

    $result3 = $link->query("SELECT * FROM image_captions WHERE image_id  = '$image_id'");

    $count_captions = $result3->rowCount()>0;


  } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try


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
             <div class="order-1 col-12 col-xl-12 p-0 bd-highlight ml-auto">
              
              <div class="d-flex p-0">
          <div id="lang_code_image_caption_<?php echo $lang_code; ?>" class="ml-auto pr-1 lang_code">
          <?php echo "[$lang_code]"; ?>
          </div>
              
                  <input id="image_caption_input_<?php echo $image_caption_id; ?>" first="1" class="form-control form-control-sm pr-1 image_caption_input" image_id="<?php echo $image_id; ?>" type="text" image_caption_id="<?php echo $image_caption_id; ?>" lang_code="<?php echo $lang_code; ?>" value="<?php echo $image_caption;?>" >
                  <button id='del_image_caption_<?php echo $image_caption_id; ?>' lang_code="<?php echo $lang_code; ?>" image_id="<?php echo $image_id; ?>"  image_caption_id="<?php echo $image_caption_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button" class='btn btn-default btn-sm p-0 del_image_caption'>
                <span class="material-icons md-18">delete</span>
              </button>

                </div>
        </div>
        <script>
          $('#image_caption_input_<?php echo $image_caption_id; ?>').keyup(function(){
            var image_caption_id = $(this).attr('image_caption_id');

            //var lang_code = $(this).attr('lang_code');
            //var bundle = $(this).attr('bundle');
            var first = $(this).attr('first');
            var image_caption = $(this).val();
            var div= "#image_caption_panel_<?php echo $image_id ?>";
              //var original = $(this).attr('original');
            //var sense_id = $(this).attr('sense_id');
            var update_image_caption = 1;

            if(first==1){
              $(this).attr('first', 0);
              var bck_image_caption = 1;
              console.log("image_caption input change");
              console.log(image_caption_id);
              console.log(image_caption);
                
              $.ajax({
                url:'edit_image.php',
                data:{image_caption_id:image_caption_id, bck_image_caption:bck_image_caption, image_caption:image_caption, update_image_caption:update_image_caption},
                type: 'POST',
                success: function(data){
                    /*if(!data.error){
                        $(div).html(data);
            
                    }*/
                }
                
            
              })
            



            }else{

              console.log("image_caption input change");
              console.log(image_caption_id);
              console.log(image_caption);
                
              $.ajax({
                url:'edit_image.php',
                data:{image_caption_id:image_caption_id, image_caption:image_caption, update_image_caption:update_image_caption},
                type: 'POST',
                success: function(data){
                   /*if(!data.error){
                        $(div).html(data);
            
                    }*/
                }
                
            
              })
            
              
            }

          /*  
            $.ajax({
            url:'modal_update.php',
            data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, update_sense:update_sense},
            type: 'POST',
            success: function(data){
                if(!data.error){
                    $('#modal_def_panel').html(data);

                }
              }
                
            })

            */
          })

                  </script>

      <script>
            
            $('#del_image_caption_<?php echo $image_caption_id; ?>').on('click', function(){
              var image_id = $(this).attr('image_id');
              //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
                        //            console.log(search);
              var div= "#image_caption_panel_<?php echo $image_id ?>";
              var del_image_caption = 1;
              var entry_ref = "<?php echo $entry_ref; ?>";
              var image_caption_id = $(this).attr('image_caption_id');
              var lang_code = $(this).attr('lang_code');
              console.log("del_image_caption");
            console.log(del_image_caption);
            console.log(div);
            console.log(lang_code);
            
            $.ajax({
                url:'edit_image.php',
                data:{image_id:image_id, entry_ref:entry_ref, image_caption_id:image_caption_id, del_image_caption:del_image_caption, lang_code:lang_code},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(div).html(data);
            
                    }
                }
                
            
              })
            
      
            
            })
      
                </script>
              <?php
      
        } // foreach
      }else{

        ?>
        <div class="d-flex order-2 ml-auto">
        <div id="lang_code_image_caption_<?php echo $lang_code; ?>" class="ml-auto pr-1 lang_code">
          <?php echo "[$lang_code]"; ?>
          </div>
        <button id='create_image_caption_<?php echo $image_id;?>_<?php echo $lang_code;?>' image_id="<?php echo $image_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button" class='btn btn-default btn-sm mr-auto p-0 create_image_caption'>
          <span class="material-icons md-18">create</span>
        </button>
        <div>

        </div>
        </div>
        <script>

            $('#create_image_caption_<?php echo $image_id;?>_<?php echo $lang_code;?>').on('click', function(){

            var lang_code = $(this).attr('lang_code');
            var entry_ref = "<?php echo $entry_ref;?>";
            //var sense_bundle = $(this).attr('sense_bundle');
            var image_id = $(this).attr('image_id');
            //var items = $(this).attr('items');
            //var translation_order = $(this).attr('translation_order');
            //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
            // console.log(search);
            var div = "#image_caption_panel_".concat(image_id);
            var create_image_caption = 1;
            //$(this).attr('items', items_new);
            console.log("create_image_caption");
            console.log(create_image_caption);
            console.log(div);
            console.log(lang_code);

            $.ajax({
                url:'edit_image.php',
                data:{image_id:image_id, create_image_caption:create_image_caption, entry_ref:entry_ref, lang_code:lang_code},
                type: 'POST', 
                success: function(data){
                    if(!data.error){
                        $(div).html(data);

                    }
                }
                



            })


            })
        </script>
      
        <?php

          //echo "A busca não retornou nenhum resultado.";
      } // if

  } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
      } // try
  
  } // foreach   



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
             <div class="order-1 col-12 col-xl-12 p-0 bd-highlight ml-auto">
              
              <div class="d-flex p-0">
          
              <div id="lang_code_image_caption_<?php echo $lang_code; ?>" class="ml-auto lang_code pr-1">
          <?php echo "[$lang_code]"; ?>
          </div>

              <input id="image_caption_input_<?php echo $image_caption_id; ?>" first="1" class="form-control form-control-sm image_caption_input" image_id="<?php echo $image_id; ?>" type="text" image_caption_id="<?php echo $image_caption_id; ?>" lang_code="<?php echo $lang_code; ?>" value="<?php echo $image_caption;?>" >
              <button id='del_image_caption_<?php echo $image_caption_id; ?>' lang_code="<?php echo $lang_code; ?>" image_id="<?php echo $image_id; ?>"  image_caption_id="<?php echo $image_caption_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button" class='btn btn-default btn-sm p-0 del_image_caption'>
                <span class="material-icons md-18">delete</span>
              </button>  
            </div>
        </div>
        <script>
          $('#image_caption_input_<?php echo $image_caption_id; ?>').keyup(function(){
            var image_caption_id = $(this).attr('image_caption_id');

            //var lang_code = $(this).attr('lang_code');
            //var bundle = $(this).attr('bundle');
            var first = $(this).attr('first');
            var image_caption = $(this).val();
            var div= "#image_caption_panel_<?php echo $image_id ?>";
              //var original = $(this).attr('original');
            //var sense_id = $(this).attr('sense_id');
            var update_image_caption = 1;

            if(first==1){
              $(this).attr('first', 0);
              var bck_image_caption = 1;
              console.log("image_caption input change");
              console.log(image_caption_id);
              console.log(image_caption);
                
              $.ajax({
                url:'edit_image.php',
                data:{image_caption_id:image_caption_id, bck_image_caption:bck_image_caption, image_caption:image_caption, update_image_caption:update_image_caption},
                type: 'POST',
                success: function(data){
                    /*if(!data.error){
                        $(div).html(data);
            
                    }*/
                }
                
            
              })
            



            }else{

              console.log("image_caption input change");
              console.log(image_caption_id);
              console.log(image_caption);
                
              $.ajax({
                url:'edit_image.php',
                data:{image_caption_id:image_caption_id, image_caption:image_caption, update_image_caption:update_image_caption},
                type: 'POST',
                success: function(data){
                    /*if(!data.error){
                        $(div).html(data);
            
                    }*/
                }
                
            
              })
            
              
            }

          /*  
            $.ajax({
            url:'modal_update.php',
            data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, update_sense:update_sense},
            type: 'POST',
            success: function(data){
                if(!data.error){
                    $('#modal_def_panel').html(data);

                }
              }
                
            })

            */
          })

                  </script>
        <script>
            
            $('#del_image_caption_<?php echo $image_caption_id; ?>').on('click', function(){
              var image_id = $(this).attr('image_id');
              //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
                        //            console.log(search);
              var div= "#image_caption_panel_<?php echo $image_id ?>";
              var del_image_caption = 1;
              var entry_ref = "<?php echo $entry_ref; ?>";
              var image_caption_id = $(this).attr('image_caption_id');
              var lang_code = $(this).attr('lang_code');
              console.log("del_image_caption");
            console.log(del_image_caption);
            console.log(div);
            console.log(lang_code);
            
            $.ajax({
                url:'edit_image.php',
                data:{image_id:image_id, entry_ref:entry_ref, image_caption_id:image_caption_id, del_image_caption:del_image_caption, lang_code:lang_code},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(div).html(data);
            
                    }
                }
                
            
              })
            
      
            
            })
      
                </script>
              <?php
      
        } // foreach
      }else{

        ?>
        
        <div class="d-flex order-2 ml-auto p-0">
        <div id="lang_code_image_caption_<?php echo $lang_code; ?>" class="ml-auto p-0 lang_code">
          <?php echo "[$lang_code]"; ?>
          </div>
        <button id='create_image_caption_<?php echo $image_id;?>_<?php echo $lang_code;?>' image_id="<?php echo $image_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button" class='btn btn-default btn-sm p-0 create_image_caption'>
          <span class="material-icons md-18">create</span>
        </button>
        <div>

        </div>
        </div>
        <script>

            $('#create_image_caption_<?php echo $image_id;?>_<?php echo $lang_code;?>').on('click', function(){

            var lang_code = $(this).attr('lang_code');
            var entry_ref = "<?php echo $entry_ref;?>";
            //var sense_bundle = $(this).attr('sense_bundle');
            var image_id = $(this).attr('image_id');
            //var items = $(this).attr('items');
            //var translation_order = $(this).attr('translation_order');
            //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
            // console.log(search);
            var div = "#image_caption_panel_".concat(image_id);
            var create_image_caption = 1;
            //$(this).attr('items', items_new);
            console.log("create_image_caption");
            console.log(create_image_caption);
            console.log(div);
            console.log(lang_code);

            $.ajax({
                url:'edit_image.php',
                data:{image_id:image_id, create_image_caption:create_image_caption, entry_ref:entry_ref, lang_code:lang_code},
                type: 'POST', 
                success: function(data){
                    if(!data.error){
                        $(div).html(data);

                    }
                }
                



            })


            })
        </script>
    
        <?php

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

function videos_edit ($sense_bundle_id, $entry_ref){
      $dic_name = "";
    include ("connection.php");
  //START //videos //START
  try {

    $result = $link->query("SELECT * FROM videos WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY video_id");
    $items = $result->rowCount();

    
    ?>
   
      <div id="video_bundle_<?php echo $sense_bundle_id; ?>" class="col-12 col-xl-12 d-flex p-0 bd-highlight video_bundle sl">
     

    <div id="video_field_tag_<?php echo $sense_bundle_id ?>" class="ml-auto field_tag">
      <small>vídeos</small>
      </div>       


    <div>

        <div hidden>
            <form enctype="multipart/form-data" id="video_form_<?php echo $sense_bundle_id;?>" method="post">
              <input id="input_video_<?php echo $sense_bundle_id;?>" type="file" accept=".mp4, .flv, .ogv" name="file" required="required">
            </form> 
        </div>

    <button id='add_video_<?php echo $sense_bundle_id; ?>' sense_bundle_id='<?php echo $sense_bundle_id; ?>' entry_ref='<?php echo $entry_ref; ?>' items='<?php echo $items; ?>' type="button"  class='btn btn-default btn-sm p-0 add_video'>
      <span class="material-icons md-18">add_box</span>
    </button>
    
    </div>
    </div>
    <script>
          $("#add_video_<?php echo $sense_bundle_id; ?>").click(function () {
            $("#input_video_<?php echo $sense_bundle_id;?>").trigger('click');
        });
        </script>

        <script type="application/javascript">
            $('#input_video_<?php echo $sense_bundle_id;?>').change(function(e){
                var fileName = e.target.files[0].name;
                //$('#video_file_<?php echo $sense_bundle_id; ?>').html(fileName);
                //$("#save_video_<?php echo $sense_bundle_id; ?>").prop('disabled', false);

                var div= "#video_panel_all_<?php echo $sense_bundle_id;?>";
                var formData = new FormData($("#video_form_<?php echo $sense_bundle_id;?>")[0]);
                formData.append('sense_bundle_id', <?php echo $sense_bundle_id; ?>); //id is the variable that has the data that I need
                formData.append('entry_ref', '<?php echo $entry_ref;?>');
                formData.append('items', <?php echo $items; ?>); //id is the variable that has the data that I need
                console.log("upload video");
                console.log(div);
                console.log("<?php echo $items; ?>");
                console.log("<?php echo $entry_ref; ?>");

                $.ajax({
                    url: "edit_video.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                      
                          if(!data.error){
                          $(div).html(data);
                          console.log("sem erro ate aqui")

                      }else{
                        console.log("erro no final")
                      }
                      
                    }
                });
            });
          </script>

    <?php
    if($result->rowCount()>0){
      ?>  

        <div id="video_panel_<?php echo $sense_bundle_id ?>" class="p-0 bd-highlight col-12 col-xl-12 d-flex flex-column video_panel">
      <?php                  
      foreach ($result as $key => $row){
        $video_id=$row["video_id"];
        $ogv= $row["ogv"];        
        $mp4= $row["mp4"];        
  

           ?>
           <div class="ml-auto">
           <div class="d-flex col-12 col-xl-12 p-0 ml-auto bd-highlight">
            <button video_order='1' id='del_video_<?php echo $video_id; ?>' sense_bundle_id='<?php echo $sense_bundle_id; ?>' entry_ref='<?php echo $entry_ref; ?>' items='<?php echo $items; ?>' video_id="<?php echo $video_id; ?>" type="button"  class='btn btn-default btn-sm p-0'>
            <span class="material-icons md-18">delete</span>
          </button>

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
           </div>
        </div>

          <div id="video_caption_field_tag_panel_<?php echo $video_id ?>" class="ml-auto p-0 video_caption_tag_panel">
          <div id="example_video_caption_field_tag_<?php echo $video_id ?>" class="col-12 col-xl-12 p-0 field_tag">
            <small>legenda (vídeo)</small>
            </div>
          
        </div>
          <div id="video_caption_panel_<?php echo $video_id ?>" class="d-flex flex-wrap col-12 col-xl-12 p-0 bd-highlight video_caption_panel">
            <?php
            
            video_captions_edit ($video_id, $entry_ref);

            ?>

            </div>
          <script>
          
          $('#del_video_<?php echo $video_id; ?>').on('click', function(){
            var sense_bundle_id = $(this).attr('sense_bundle_id');
            //var select = document.getElementById('product_id');
          //var index = $('#example').selectedIndex;
          //var given_text = index.options[index].value;
                      //            console.log(search);
            var div= "#video_panel_all_<?php echo $sense_bundle_id;?>";
            var add_video_id = "#add_video_<?php echo $sense_bundle_id; ?>";
            var items = $(add_video_id).attr('items');
            var del_video = 1;
            var entry_ref = "<?php echo $entry_ref; ?>";
            var restore_gloss = 1;
            var video_id = $(this).attr('video_id');
            var items_new = (parseInt(items))-1;
            $(add_video_id).attr('items', items_new);
    
          
          $.ajax({
              url:'edit_video.php',
              data:{sense_bundle_id:sense_bundle_id, entry_ref:entry_ref, video_id:video_id, del_video:del_video},
              type: 'POST',
              success: function(data){
                  if(!data.error){
                      $(div).html(data);
          
                  }
              }
              
          
            })
          
    
          
          })

          </script>
    

            <?php

      } // foreach
          ?>
        </div>
        <?php  
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    ?>
      
    
            
      
      

      <?php
  } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
  } // try
  //END //videos //END
}
//END //videos function//END



function video_captions_edit ($video_id, $entry_ref){
      $dic_name = "";
    include ("connection.php");
  //START //video_captions //START
  try {

    $result3 = $link->query("SELECT * FROM video_captions WHERE video_id  = '$video_id'");

    $count_captions = $result3->rowCount()>0;


  } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try


  $target_langs_info = $_SESSION['config_tls_'.$dic_name];
  
  foreach ($target_langs_info as $target_lang_info){
    ?>

    <?php
    $target_lang = $target_lang_info['target_lang'];
    $lang_code = $target_lang_info['lang_code'];
    try {

      $result = $link->query("SELECT * FROM video_captions WHERE video_id  = '$video_id' AND lang_code = '$lang_code'");
                  
    
      if($result->rowCount()>0){
        foreach ($result as $key => $row){
          $video_caption_id=$row["video_caption_id"];                          
          $video_caption=$row["video_caption"];                       
          
             ?>
             <div class="order-1 col-12 col-xl-12 p-0 bd-highlight ml-auto">
              
              <div class="d-flex p-0">
          <div id="lang_code_video_caption_<?php echo $lang_code; ?>" class="ml-auto pr-1 lang_code">
          <?php echo "[$lang_code]"; ?>
          </div>
              
                  <input id="video_caption_input_<?php echo $video_caption_id; ?>" first="1" class="form-control form-control-sm pr-1 video_caption_input" video_id="<?php echo $video_id; ?>" type="text" video_caption_id="<?php echo $video_caption_id; ?>" lang_code="<?php echo $lang_code; ?>" value="<?php echo $video_caption;?>" >
                  <button id='del_video_caption_<?php echo $video_caption_id; ?>' lang_code="<?php echo $lang_code; ?>" video_id="<?php echo $video_id; ?>"  video_caption_id="<?php echo $video_caption_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button" class='btn btn-default btn-sm p-0 del_video_caption'>
                <span class="material-icons md-18">delete</span>
              </button>

                </div>
        </div>
        <script>
          $('#video_caption_input_<?php echo $video_caption_id; ?>').keyup(function(){
            var video_caption_id = $(this).attr('video_caption_id');

            //var lang_code = $(this).attr('lang_code');
            //var bundle = $(this).attr('bundle');
            var first = $(this).attr('first');
            var video_caption = $(this).val();
            var div= "#video_caption_panel_<?php echo $video_id ?>";
              //var original = $(this).attr('original');
            //var sense_id = $(this).attr('sense_id');
            var update_video_caption = 1;

            if(first==1){
              $(this).attr('first', 0);
              var bck_video_caption = 1;
              console.log("video_caption input change");
              console.log(video_caption_id);
              console.log(video_caption);
                
              $.ajax({
                url:'edit_video.php',
                data:{video_caption_id:video_caption_id, bck_video_caption:bck_video_caption, video_caption:video_caption, update_video_caption:update_video_caption},
                type: 'POST',
                success: function(data){
                    /*if(!data.error){
                        $(div).html(data);
            
                    }*/
                }
                
            
              })
            



            }else{

              console.log("video_caption input change");
              console.log(video_caption_id);
              console.log(video_caption);
                
              $.ajax({
                url:'edit_video.php',
                data:{video_caption_id:video_caption_id, video_caption:video_caption, update_video_caption:update_video_caption},
                type: 'POST',
                success: function(data){
                   /*if(!data.error){
                        $(div).html(data);
            
                    }*/
                }
                
            
              })
            
              
            }

          /*  
            $.ajax({
            url:'modal_update.php',
            data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, update_sense:update_sense},
            type: 'POST',
            success: function(data){
                if(!data.error){
                    $('#modal_def_panel').html(data);

                }
              }
                
            })

            */
          })

                  </script>

      <script>
            
            $('#del_video_caption_<?php echo $video_caption_id; ?>').on('click', function(){
              var video_id = $(this).attr('video_id');
              //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
                        //            console.log(search);
              var div= "#video_caption_panel_<?php echo $video_id ?>";
              var del_video_caption = 1;
              var entry_ref = "<?php echo $entry_ref; ?>";
              var video_caption_id = $(this).attr('video_caption_id');
              var lang_code = $(this).attr('lang_code');
              console.log("del_video_caption");
            console.log(del_video_caption);
            console.log(div);
            console.log(lang_code);
            
            $.ajax({
                url:'edit_video.php',
                data:{video_id:video_id, entry_ref:entry_ref, video_caption_id:video_caption_id, del_video_caption:del_video_caption, lang_code:lang_code},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(div).html(data);
            
                    }
                }
                
            
              })
            
      
            
            })
      
                </script>
              <?php
      
        } // foreach
      }else{

        ?>
        <div class="d-flex order-2 ml-auto">
        <div id="lang_code_video_caption_<?php echo $lang_code; ?>" class="ml-auto pr-1 lang_code">
          <?php echo "[$lang_code]"; ?>
          </div>
        <button id='create_video_caption_<?php echo $video_id;?>_<?php echo $lang_code;?>' video_id="<?php echo $video_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button" class='btn btn-default btn-sm mr-auto p-0 create_video_caption'>
          <span class="material-icons md-18">create</span>
        </button>
        <div>

        </div>
        </div>
        <script>

            $('#create_video_caption_<?php echo $video_id;?>_<?php echo $lang_code;?>').on('click', function(){

            var lang_code = $(this).attr('lang_code');
            var entry_ref = "<?php echo $entry_ref;?>";
            //var sense_bundle = $(this).attr('sense_bundle');
            var video_id = $(this).attr('video_id');
            //var items = $(this).attr('items');
            //var translation_order = $(this).attr('translation_order');
            //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
            // console.log(search);
            var div = "#video_caption_panel_".concat(video_id);
            var create_video_caption = 1;
            //$(this).attr('items', items_new);
            console.log("create_video_caption");
            console.log(create_video_caption);
            console.log(div);
            console.log(lang_code);

            $.ajax({
                url:'edit_video.php',
                data:{video_id:video_id, create_video_caption:create_video_caption, entry_ref:entry_ref, lang_code:lang_code},
                type: 'POST', 
                success: function(data){
                    if(!data.error){
                        $(div).html(data);

                    }
                }
                



            })


            })
        </script>
      
        <?php

          //echo "A busca não retornou nenhum resultado.";
      } // if

  } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
      } // try
  
  } // foreach   



  $source_langs_info = $_SESSION['config_sls_'.$dic_name];
  
  foreach ($source_langs_info as $source_lang_info){
    ?>

    <?php
    $source_lang = $source_lang_info['source_lang'];
    $lang_code = $source_lang_info['lang_code'];
    try {

      $result = $link->query("SELECT * FROM video_captions WHERE video_id  = '$video_id' AND lang_code = '$lang_code'");
                  
    
      if($result->rowCount()>0){
        foreach ($result as $key => $row){
          $video_caption_id=$row["video_caption_id"];                          
          $video_caption=$row["video_caption"];                       
          
             ?>
             <div class="order-1 col-12 col-xl-12 p-0 bd-highlight ml-auto">
              
              <div class="d-flex p-0">
          
              <div id="lang_code_video_caption_<?php echo $lang_code; ?>" class="ml-auto lang_code pr-1">
          <?php echo "[$lang_code]"; ?>
          </div>

              <input id="video_caption_input_<?php echo $video_caption_id; ?>" first="1" class="form-control form-control-sm video_caption_input" video_id="<?php echo $video_id; ?>" type="text" video_caption_id="<?php echo $video_caption_id; ?>" lang_code="<?php echo $lang_code; ?>" value="<?php echo $video_caption;?>" >
              <button id='del_video_caption_<?php echo $video_caption_id; ?>' lang_code="<?php echo $lang_code; ?>" video_id="<?php echo $video_id; ?>"  video_caption_id="<?php echo $video_caption_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button" class='btn btn-default btn-sm p-0 del_video_caption'>
                <span class="material-icons md-18">delete</span>
              </button>  
            </div>
        </div>
        <script>
          $('#video_caption_input_<?php echo $video_caption_id; ?>').keyup(function(){
            var video_caption_id = $(this).attr('video_caption_id');

            //var lang_code = $(this).attr('lang_code');
            //var bundle = $(this).attr('bundle');
            var first = $(this).attr('first');
            var video_caption = $(this).val();
            var div= "#video_caption_panel_<?php echo $video_id ?>";
              //var original = $(this).attr('original');
            //var sense_id = $(this).attr('sense_id');
            var update_video_caption = 1;

            if(first==1){
              $(this).attr('first', 0);
              var bck_video_caption = 1;
              console.log("video_caption input change");
              console.log(video_caption_id);
              console.log(video_caption);
                
              $.ajax({
                url:'edit_video.php',
                data:{video_caption_id:video_caption_id, bck_video_caption:bck_video_caption, video_caption:video_caption, update_video_caption:update_video_caption},
                type: 'POST',
                success: function(data){
                    /*if(!data.error){
                        $(div).html(data);
            
                    }*/
                }
                
            
              })
            



            }else{

              console.log("video_caption input change");
              console.log(video_caption_id);
              console.log(video_caption);
                
              $.ajax({
                url:'edit_video.php',
                data:{video_caption_id:video_caption_id, video_caption:video_caption, update_video_caption:update_video_caption},
                type: 'POST',
                success: function(data){
                    /*if(!data.error){
                        $(div).html(data);
            
                    }*/
                }
                
            
              })
            
              
            }

          /*  
            $.ajax({
            url:'modal_update.php',
            data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, update_sense:update_sense},
            type: 'POST',
            success: function(data){
                if(!data.error){
                    $('#modal_def_panel').html(data);

                }
              }
                
            })

            */
          })

                  </script>
        <script>
            
            $('#del_video_caption_<?php echo $video_caption_id; ?>').on('click', function(){
              var video_id = $(this).attr('video_id');
              //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
                        //            console.log(search);
              var div= "#video_caption_panel_<?php echo $video_id ?>";
              var del_video_caption = 1;
              var entry_ref = "<?php echo $entry_ref; ?>";
              var video_caption_id = $(this).attr('video_caption_id');
              var lang_code = $(this).attr('lang_code');
              console.log("del_video_caption");
            console.log(del_video_caption);
            console.log(div);
            console.log(lang_code);
            
            $.ajax({
                url:'edit_video.php',
                data:{video_id:video_id, entry_ref:entry_ref, video_caption_id:video_caption_id, del_video_caption:del_video_caption, lang_code:lang_code},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(div).html(data);
            
                    }
                }
                
            
              })
            
      
            
            })
      
                </script>
              <?php
      
        } // foreach
      }else{

        ?>
        
        <div class="d-flex order-2 ml-auto p-0">
        <div id="lang_code_video_caption_<?php echo $lang_code; ?>" class="ml-auto p-0 lang_code">
          <?php echo "[$lang_code]"; ?>
          </div>
        <button id='create_video_caption_<?php echo $video_id;?>_<?php echo $lang_code;?>' video_id="<?php echo $video_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button" class='btn btn-default btn-sm p-0 create_video_caption'>
          <span class="material-icons md-18">create</span>
        </button>
        <div>

        </div>
        </div>
        <script>

            $('#create_video_caption_<?php echo $video_id;?>_<?php echo $lang_code;?>').on('click', function(){

            var lang_code = $(this).attr('lang_code');
            var entry_ref = "<?php echo $entry_ref;?>";
            //var sense_bundle = $(this).attr('sense_bundle');
            var video_id = $(this).attr('video_id');
            //var items = $(this).attr('items');
            //var translation_order = $(this).attr('translation_order');
            //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
            // console.log(search);
            var div = "#video_caption_panel_".concat(video_id);
            var create_video_caption = 1;
            //$(this).attr('items', items_new);
            console.log("create_video_caption");
            console.log(create_video_caption);
            console.log(div);
            console.log(lang_code);

            $.ajax({
                url:'edit_video.php',
                data:{video_id:video_id, create_video_caption:create_video_caption, entry_ref:entry_ref, lang_code:lang_code},
                type: 'POST', 
                success: function(data){
                    if(!data.error){
                        $(div).html(data);

                    }
                }
                



            })


            })
        </script>
    
        <?php

          //echo "A busca não retornou nenhum resultado.";
      } // if

  } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
      } // try
  
  } // foreach   




      //END //video_captions //END
}

//START //comments function //START

function comments_edit ($sense_bundle_id, $entry_ref){
      $dic_name = "";
    include ("connection.php");
  //START //comments //START

  ?>  
   <?php     


  ?>  
   <?php     

  $target_langs_info = $_SESSION['config_tls_'.$dic_name];
  
  foreach ($target_langs_info as $target_lang_info){
    ?>

    <?php
    $target_lang = $target_lang_info['target_lang'];
    $lang_code = $target_lang_info['lang_code'];
    try {

      $result = $link->query("SELECT * FROM comments WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY comment_order");
                  
    
      if($result->rowCount()>0){
        foreach ($result as $key => $row){
          $comment_id=$row["comment_id"];                          
          $comment=$row["comment"];                       
          
             ?>
              
              <div class="order-1 col-12 col-xl-12 p-0 bd-highlight ml-auto">
              
              <div class="d-flex p-0">
          <div id="lang_code_comment_<?php echo $lang_code; ?>" class="ml-auto pr-1 lang_code">
          <?php echo "[$lang_code]"; ?>
          </div>
          <input id="comment_input_<?php echo $comment_id; ?>" first="1" class="form-control form-control-sm pr-1 comment_input" sense_bundle_id="<?php echo $sense_bundle_id; ?>" type="text" comment_id="<?php echo $comment_id; ?>" lang_code="<?php echo $lang_code; ?>" value="<?php echo $comment;?>" >
              <button id='del_comment_<?php echo $comment_id; ?>' lang_code="<?php echo $lang_code; ?>" sense_bundle_id="<?php echo $sense_bundle_id; ?>"  comment_id="<?php echo $comment_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button" class='btn btn-default btn-sm p-0 del_comment'>
                <span class="material-icons md-18">delete</span>
              </button>
              </div>
              </div>
        <script>
          $('#comment_input_<?php echo $comment_id; ?>').keyup(function(){
            var comment_id = $(this).attr('comment_id');

            //var lang_code = $(this).attr('lang_code');
            //var bundle = $(this).attr('bundle');
            var first = $(this).attr('first');
            var comment = $(this).val();
            var div= "#comment_panel_<?php echo $sense_bundle_id ?>";
              //var original = $(this).attr('original');
            //var sense_id = $(this).attr('sense_id');
            var update_comment = 1;

            if(first==1){
              $(this).attr('first', 0);
              var bck_comment = 1;
              console.log("comment input change");
              console.log(comment_id);
              console.log(comment);
                
              $.ajax({
                url:'edit_comment.php',
                data:{comment_id:comment_id, bck_comment:bck_comment, comment:comment, update_comment:update_comment},
                type: 'POST',
                success: function(data){
                    /*if(!data.error){
                        $(div).html(data);
            
                    }*/
                }
                
            
              })
            



            }else{

              console.log("comment input change");
              console.log(comment_id);
              console.log(comment);
                
              $.ajax({
                url:'edit_comment.php',
                data:{comment_id:comment_id, comment:comment, update_comment:update_comment},
                type: 'POST',
                success: function(data){
                   /*if(!data.error){
                        $(div).html(data);
            
                    }*/
                }
                
            
              })
            
              
            }

          /*  
            $.ajax({
            url:'modal_update.php',
            data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, update_sense:update_sense},
            type: 'POST',
            success: function(data){
                if(!data.error){
                    $('#modal_def_panel').html(data);

                }
              }
                
            })

            */
          })

                  </script>

      <script>
            
            $('#del_comment_<?php echo $comment_id; ?>').on('click', function(){
              var sense_bundle_id = $(this).attr('sense_bundle_id');
              //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
                        //            console.log(search);
              var div= "#comment_panel_<?php echo $sense_bundle_id ?>";
              var del_comment = 1;
              var entry_ref = "<?php echo $entry_ref; ?>";
              var comment_id = $(this).attr('comment_id');
              var lang_code = $(this).attr('lang_code');
              console.log("del_comment");
            console.log(del_comment);
            console.log(div);
            console.log(lang_code);
            
            $.ajax({
                url:'edit_comment.php',
                data:{sense_bundle_id:sense_bundle_id, entry_ref:entry_ref, comment_id:comment_id, del_comment:del_comment, lang_code:lang_code},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(div).html(data);
            
                    }
                }
                
            
              })
            
      
            
            })
      
                </script>
              <?php
      
        } // foreach
      }else{

        ?>
      <div class="d-flex order-2 ml-auto">
        
        <div id="lang_code_comment_<?php echo $lang_code; ?>" class="ml-auto p-0 lang_code">
          <?php echo "[$lang_code]"; ?>
          </div>
        <button id='create_comment_<?php echo $sense_bundle_id;?>_<?php echo $lang_code;?>' sense_bundle_id="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button" class='btn btn-default btn-sm p-0 create_comment'>
          <span class="material-icons md-18">create</span>
        </button>
        <div>

        </div>
        </div>
      
        <script>

            $('#create_comment_<?php echo $sense_bundle_id;?>_<?php echo $lang_code;?>').on('click', function(){

            var lang_code = $(this).attr('lang_code');
            var entry_ref = "<?php echo $entry_ref;?>";
            //var sense_bundle = $(this).attr('sense_bundle');
            var sense_bundle_id = $(this).attr('sense_bundle_id');
            //var items = $(this).attr('items');
            //var translation_order = $(this).attr('translation_order');
            //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
            // console.log(search);
            var div = "#comment_panel_".concat(sense_bundle_id);
            var create_comment = 1;
            //$(this).attr('items', items_new);
            console.log("create_comment");
            console.log(create_comment);
            console.log(div);
            console.log(lang_code);
            console.log(entry_ref);

            $.ajax({
                url:'edit_comment.php',
                data:{sense_bundle_id:sense_bundle_id, create_comment:create_comment, entry_ref:entry_ref, lang_code:lang_code},
                type: 'POST', 
                success: function(data){
                    if(!data.error){
                        $(div).html(data);

                    }
                }
                



            })


            })
        </script>
      
        <?php

          //echo "A busca não retornou nenhum resultado.";
      } // if

  } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
      } // try
  
  } // foreach   



  $source_langs_info = $_SESSION['config_sls_'.$dic_name];
  
  foreach ($source_langs_info as $source_lang_info){
    ?>

    <?php
    $source_lang = $source_lang_info['source_lang'];
    $lang_code = $source_lang_info['lang_code'];
    try {

      $result = $link->query("SELECT * FROM comments WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code'");
                  
    
      if($result->rowCount()>0){
        foreach ($result as $key => $row){
          $comment_id=$row["comment_id"];                          
          $comment=$row["comment"];                       
          
             ?>
              <div class="order-1 col-12 col-xl-12 p-0 bd-highlight ml-auto">
              
              <div class="d-flex p-0">
                <div id="lang_code_comment_<?php echo $lang_code; ?>" class="ml-auto pr-1 lang_code">
          <?php echo "[$lang_code]"; ?>
          </div>

              <input id="comment_input_<?php echo $comment_id; ?>" first="1" class="form-control form-control-sm pr-1 comment_input" sense_bundle_id="<?php echo $sense_bundle_id; ?>" type="text" comment_id="<?php echo $comment_id; ?>" lang_code="<?php echo $lang_code; ?>" value="<?php echo $comment;?>" >
              <button id='del_comment_<?php echo $comment_id; ?>' lang_code="<?php echo $lang_code; ?>" sense_bundle_id="<?php echo $sense_bundle_id; ?>"  comment_id="<?php echo $comment_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button" class='btn btn-default btn-sm p-0 del_comment'>
                <span class="material-icons md-18">delete</span>
              </button>
        </div>
              </div>
        <script>
          $('#comment_input_<?php echo $comment_id; ?>').keyup(function(){
            var comment_id = $(this).attr('comment_id');

            //var lang_code = $(this).attr('lang_code');
            //var bundle = $(this).attr('bundle');
            var first = $(this).attr('first');
            var comment = $(this).val();
            var div= "#comment_panel_<?php echo $sense_bundle_id ?>";
              //var original = $(this).attr('original');
            //var sense_id = $(this).attr('sense_id');
            var update_comment = 1;

            if(first==1){
              $(this).attr('first', 0);
              var bck_comment = 1;
              console.log("comment input change");
              console.log(comment_id);
              console.log(comment);
                
              $.ajax({
                url:'edit_comment.php',
                data:{comment_id:comment_id, bck_comment:bck_comment, comment:comment, update_comment:update_comment},
                type: 'POST',
                success: function(data){
                    /*if(!data.error){
                        $(div).html(data);
            
                    }*/
                }
                
            
              })
            



            }else{

              console.log("comment input change");
              console.log(comment_id);
              console.log(comment);
                
              $.ajax({
                url:'edit_comment.php',
                data:{comment_id:comment_id, comment:comment, update_comment:update_comment},
                type: 'POST',
                success: function(data){
                   /*if(!data.error){
                        $(div).html(data);
            
                    }*/
                }
                
            
              })
            
              
            }

          /*  
            $.ajax({
            url:'modal_update.php',
            data:{bundle:bundle, lang_code:lang_code, sense_id:sense_id, update_sense:update_sense},
            type: 'POST',
            success: function(data){
                if(!data.error){
                    $('#modal_def_panel').html(data);

                }
              }
                
            })

            */
          })

                  </script>
      <script>
            
            $('#del_comment_<?php echo $comment_id; ?>').on('click', function(){
              var sense_bundle_id = $(this).attr('sense_bundle_id');
              //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
                        //            console.log(search);
              var div= "#comment_panel_<?php echo $sense_bundle_id ?>";
              var del_comment = 1;
              var entry_ref = "<?php echo $entry_ref; ?>";
              var comment_id = $(this).attr('comment_id');
              var lang_code = $(this).attr('lang_code');
              console.log("del_comment");
            console.log(del_comment);
            console.log(div);
            console.log(lang_code);
            
            $.ajax({
                url:'edit_comment.php',
                data:{sense_bundle_id:sense_bundle_id, entry_ref:entry_ref, comment_id:comment_id, del_comment:del_comment, lang_code:lang_code},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(div).html(data);
            
                    }
                }
                
            
              })
            
      
            
            })
      
                </script>
              <?php
      
        } // foreach
      }else{

        ?>
        <div class="d-flex order-2 ml-auto">
        <div id="lang_code_comment_<?php echo $lang_code; ?>" class="ml-auto p-0 lang_code">
          <?php echo "[$lang_code]"; ?>
          </div>
          <button id='create_comment_<?php echo $sense_bundle_id;?>_<?php echo $lang_code;?>' sense_bundle_id="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" type="button" class='btn btn-default btn-sm mr-auto p-0 create_comment'>
          <span class="material-icons md-18">create</span>
        </button>
        <div>

        </div>
        </div>
        <script>

            $('#create_comment_<?php echo $sense_bundle_id;?>_<?php echo $lang_code;?>').on('click', function(){

            var lang_code = $(this).attr('lang_code');
            var entry_ref = "<?php echo $entry_ref;?>";
            //var sense_bundle = $(this).attr('sense_bundle');
            var sense_bundle_id = $(this).attr('sense_bundle_id');
            //var items = $(this).attr('items');
            //var translation_order = $(this).attr('translation_order');
            //var select = document.getElementById('product_id');
            //var index = $('#example').selectedIndex;
            //var given_text = index.options[index].value;
            // console.log(search);
            var div = "#comment_panel_".concat(sense_bundle_id);
            var create_comment = 1;
            //$(this).attr('items', items_new);
            console.log("create_comment");
            console.log(create_comment);
            console.log(div);
            console.log(lang_code);
            console.log(entry_ref);

            $.ajax({
                url:'edit_comment.php',
                data:{sense_bundle_id:sense_bundle_id, create_comment:create_comment, entry_ref:entry_ref, lang_code:lang_code},
                type: 'POST', 
                success: function(data){
                    if(!data.error){
                        $(div).html(data);

                    }
                }
                



            })


            })
        </script>
          
        <?php

          //echo "A busca não retornou nenhum resultado.";
      } // if

  } catch(PDOException $e){
      echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
      } // try
  
  } // foreach   




      //END //comments //END
}
//END //comments_edit function//END



//END //Part 2 - Sense//END






function bck_all_example_vernacular ($example_bundle_id){
      $dic_name = "";
    include ("connection.php");
  try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM examples WHERE example_bundle_id = '$example_bundle_id'");

    if($result->rowCount()>0){
      
      foreach ($result as $row){
          $translation_ref=$row["translation_ref"];
          $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

              
  
          $source_lang=$row["source_lang"];
          $example_id=$row["example_id"];
          $example_order=$row["example_order"];
          $lang_code=$row["lang_code"];
          $vernacular=$row["vernacular"];

          try{
            $sql = "INSERT INTO examples_bck (example_bundle_id, entry_ref, example_id, example_order, source_lang, lang_code, vernacular, translation_ref) 
            VALUES (:example_bundle_id, :entry_ref, :example_id, :example_order, :source_lang, :lang_code, :vernacular, :translation_ref)";
            $stmnt = $link->prepare($sql);
        
            $entry_data = [':example_bundle_id'=>$example_bundle_id, ':entry_ref'=>$entry_ref, ':example_id'=>$example_id, ':example_order'=>$example_order, ':source_lang'=>$source_lang, ':lang_code'=>$lang_code, ':vernacular'=>$vernacular, ':translation_ref'=>$translation_ref];
            $stmnt->execute($entry_data);
        
  
        } catch(PDOException $e){
            echo "Erro: oi1".$e->getMessage();
        }//try



          bck_example_all_prons($example_id);





        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if



  
  } catch(PDOException $e){
    echo "Erro: 5454".$e->getMessage();
  }
}



function bck_single_example_vernacular ($example_id){
      $dic_name = "";
    include ("connection.php");
  try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM examples WHERE example_bundle_id = '$example_id'");

    if($result->rowCount()>0){
      
      foreach ($result as $row){
          $translation_ref=$row["translation_ref"];
          $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

              
  
          $source_lang=$row["source_lang"];
          $example_bundle_id=$row["example_bundle_id"];
          $example_order=$row["example_order"];
          $lang_code=$row["lang_code"];
          $vernacular=$row["vernacular"];

          try{
            $sql = "INSERT INTO examples_bck (example_bundle_id, entry_ref, example_id, example_order, source_lang, lang_code, vernacular, translation_ref) 
            VALUES (:example_bundle_id, :entry_ref, :example_id, :example_order, :source_lang, :lang_code, :vernacular, :translation_ref)";
            $stmnt = $link->prepare($sql);
        
            $entry_data = [':example_bundle_id'=>$example_bundle_id, ':entry_ref'=>$entry_ref, ':example_id'=>$example_id, ':example_order'=>$example_order, ':source_lang'=>$source_lang, ':lang_code'=>$lang_code, ':vernacular'=>$vernacular, ':translation_ref'=>$translation_ref];
            $stmnt->execute($entry_data);
        
  
        } catch(PDOException $e){
            echo "Erro: oi1".$e->getMessage();
        }//try



          bck_example_all_prons($example_id);





        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if



  
  } catch(PDOException $e){
    echo "Erro: 5454".$e->getMessage();
  }
}



function bck_example_pron($example_pron_id){
      $dic_name = "";
    include ("connection.php");

 $result = $link->query("SELECT * FROM example_prons WHERE example_pron_id = '$example_pron_id'");

    if($result->rowCount()>0){
      
      foreach ($result as $row){
          $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

              
  
          $source_lang=$row["source_lang"];
          $example_id=$row["example_id"];
          $example_pron_order=$row["example_pron_order"];
          $lang_code=$row["lang_code"];
          $phonetic=$row["phonetic"];
          $vernacular_ref=$row["vernacular_ref"];
          $wav=$row["wav"];
          $mp3=$row["mp3"];
          $mp4=$row["mp4"];
          $wma=$row["wma"];
          $speaker = $row["speaker"];


          if (strlen($phonetic)==0 && strlen($wav)==0 && strlen($mp3)==0 && strlen($mp4)==0 && strlen($wma)==0){


          }else{
        
    
          try{
            $sql = "INSERT INTO example_prons_bck (example_id, entry_ref, example_pron_id, example_pron_order, source_lang, lang_code, vernacular_ref, phonetic, wav, mp3, mp4, wma, speaker) 
            VALUES (:example_id, :entry_ref, :example_pron_id, :example_pron_order, :source_lang, :lang_code, :vernacular_ref, :phonetic, :wav, :mp3, :mp4, :wma, :speaker)";
            $stmnt = $link->prepare($sql);
        
            $entry_data = [':example_id'=>$example_id, ':entry_ref'=>$entry_ref, ':example_pron_id'=>$example_pron_id, ':example_pron_order'=>$example_pron_order, ':source_lang'=>$source_lang, ':lang_code'=>$lang_code, ':vernacular_ref'=>$vernacular_ref, ':phonetic'=>$phonetic, ':wav'=>$wav, ':mp3'=>$mp3, ':mp4'=>$mp4, ':wma'=>$wma, ':speaker'=>$speaker];
            $stmnt->execute($entry_data);
        
  
        } catch(PDOException $e){
            echo "Erro: oi1".$e->getMessage();
        }//try


        
        
          }//if



        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if

  

}

function bck_example_all_prons($example_id){
      $dic_name = "";
    include ("connection.php");

 $result = $link->query("SELECT * FROM example_prons WHERE example_id = '$example_id'");

    if($result->rowCount()>0){
      
      foreach ($result as $row){
          $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

              
  
          $source_lang=$row["source_lang"];
          $example_pron_id=$row["example_pron_id"];
          $example_pron_order=$row["example_pron_order"];
          $lang_code=$row["lang_code"];
          $phonetic=$row["phonetic"];
          $vernacular_ref=$row["vernacular_ref"];
          $wav=$row["wav"];
          $mp3=$row["mp3"];
          $mp4=$row["mp4"];
          $wma=$row["wma"];
          $speaker = $row["speaker"];


          if (strlen($phonetic)==0 && strlen($wav)==0 && strlen($mp3)==0 && strlen($mp4)==0 && strlen($wma)==0){


          }else{
        
    
          try{
            $sql = "INSERT INTO example_prons_bck (example_id, entry_ref, example_pron_id, example_pron_order, source_lang, lang_code, vernacular_ref, phonetic, wav, mp3, mp4, wma, speaker) 
            VALUES (:example_id, :entry_ref, :example_pron_id, :example_pron_order, :source_lang, :lang_code, :vernacular_ref, :phonetic, :wav, :mp3, :mp4, :wma, :speaker)";
            $stmnt = $link->prepare($sql);
        
            $entry_data = [':example_id'=>$example_id, ':entry_ref'=>$entry_ref, ':example_pron_id'=>$example_pron_id, ':example_pron_order'=>$example_pron_order, ':source_lang'=>$source_lang, ':lang_code'=>$lang_code, ':vernacular_ref'=>$vernacular_ref, ':phonetic'=>$phonetic, ':wav'=>$wav, ':mp3'=>$mp3, ':mp4'=>$mp4, ':wma'=>$wma, ':speaker'=>$speaker];
            $stmnt->execute($entry_data);
        
  
        } catch(PDOException $e){
            echo "Erro: oi1".$e->getMessage();
        }//try


        
        
          }//if



        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if

  

}

function bck_example_bundle ($example_bundle_id){
      $dic_name = "";
    include ("connection.php");
  try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM example_bundles WHERE example_bundle_id = '$example_bundle_id'");

    if($result->rowCount()>0){
      
      foreach ($result as $row){
          $sense_bundle_id=$row["sense_bundle_id"];
          $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

              
  

            //if ($translation_ref==""){

          //}else{

              try{
                  $sql = "INSERT INTO example_bundles_bck (sense_bundle_id, entry_ref, example_bundle_id) 
                  VALUES (:sense_bundle_id, :entry_ref, :example_bundle_id)";
                  $stmnt = $link->prepare($sql);
              
                  $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':example_bundle_id'=>$example_bundle_id];
                  $stmnt->execute($entry_data);
              

              } catch(PDOException $e){
                  echo "Erro: 02 ".$e->getMessage();
              }//try

         // }//if


        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if



  
  } catch(PDOException $e){
    echo "Erro:7656 ".$e->getMessage();
  }
}

function bck_all_example_translation ($example_bundle_id){
      $dic_name = "";
    include ("connection.php");
  try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM translations WHERE example_bundle_id = '$example_bundle_id'");

    if($result->rowCount()>0){
      
      foreach ($result as $row){
        $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

            

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
}



function bck_all_scns ($sense_bundle_id){
      $dic_name = "";
    include ("connection.php");
  try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM scns WHERE sense_bundle_id = '$sense_bundle_id'");

    if($result->rowCount()>0){
      
      foreach ($result as $row){
        $scn_id=$row["scn_id"];
        $scn=$row["scn"];
          $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

              
  
          $scn_order=$row["scn_order"];
          $lang_code=$row["lang_code"];

          if ($scn==""){

          }else{

              try{
                  $sql = "INSERT INTO scns_bck (sense_bundle_id, entry_ref, scn_id, scn_order, lang_code, scn) 
                  VALUES (:sense_bundle_id, :entry_ref, :scn_id, :scn_order, :lang_code, :scn)";
                  $stmnt = $link->prepare($sql);
              
                  $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':scn_id'=>$scn_id, ':scn_order'=>$scn_order, ':lang_code'=>$lang_code, ':scn'=>$scn];
                  $stmnt->execute($entry_data);
              

              } catch(PDOException $e){
                  echo "Erro:wqwq ".$e->getMessage();
              }//try

          }//if


        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if




  
  } catch(PDOException $e){
    echo "Erro:esdsf ".$e->getMessage();
  }

} 

function bck_all_example_bundles ($sense_bundle_id){
      $dic_name = "";
    include ("connection.php");
  try {

    $result = $link->query("SELECT * FROM example_bundles WHERE sense_bundle_id  = '$sense_bundle_id'");
    $example_id="";

    if($result->rowCount()>0){

      foreach ($result as $key => $row){    
        $example_bundle_id=$row["example_bundle_id"];
        $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

            

        $bundle_order=$row["bundle_order"];
        
        try{
          $sql = "INSERT INTO example_bundles_bck (sense_bundle_id, entry_ref, example_bundle_id, bundle_order) 
          VALUES (:sense_bundle_id, :entry_ref, :example_bundle_id, :bundle_order)";
          $stmnt = $link->prepare($sql);
      
          $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':example_bundle_id'=>$example_bundle_id, ':bundle_order'=>$bundle_order];
          $stmnt->execute($entry_data);
          
        bck_all_example_vernacular ($example_bundle_id);
              
        bck_all_example_translation ($example_bundle_id);


      } catch(PDOException $e){
          echo "Erro:0000 ".$e->getMessage();
      }//try


    } // foreach

  }//if

  
  } catch(PDOException $e){
    echo "Erro:1 ".$e->getMessage();
  }


}





function del_example_bundle ($example_bundle_id){
      $dic_name = "";
    include ("connection.php");

  try{
    $sql2 = "DELETE FROM example_bundles WHERE example_bundle_id = :example_bundle_id";
    $stmnt2 = $link->prepare($sql2);

    $entry_data2 = [':example_bundle_id'=>$example_bundle_id];
    $stmnt2->execute($entry_data2);
 


  
  } catch(PDOException $e){
      echo "Erro:2 0i4".$e->getMessage();
  }

}

function del_example_vernacular ($example_bundle_id){
      $dic_name = "";
    include ("connection.php");

  try{
    $sql2 = "DELETE FROM examples WHERE example_bundle_id = :example_bundle_id";
    $stmnt2 = $link->prepare($sql2);

    $entry_data2 = [':example_bundle_id'=>$example_bundle_id];
    $stmnt2->execute($entry_data2);
 


  
  } catch(PDOException $e){
      echo "Erro:3 oi5".$e->getMessage();
  }

}



function del_example_translation ($example_bundle_id){
      $dic_name = "";
    include ("connection.php");

  try{
    $sql2 = "DELETE FROM translations WHERE example_bundle_id = :example_bundle_id";
    $stmnt2 = $link->prepare($sql2);

    $entry_data2 = [':example_bundle_id'=>$example_bundle_id];
    $stmnt2->execute($entry_data2);
 


  
  } catch(PDOException $e){
      echo "Erro:3 oi6".$e->getMessage();
  }

}

function del_all_scns ($sense_bundle_id){
      $dic_name = "";
    include ("connection.php");
  
  try{
    $sql2 = "DELETE FROM scns WHERE sense_bundle_id = :sense_bundle_id";
    $stmnt2 = $link->prepare($sql2);

    $entry_data2 = [':sense_bundle_id'=>$sense_bundle_id];
    $stmnt2->execute($entry_data2);




  } catch(PDOException $e){
      echo "Erro:5 ".$e->getMessage();
  }


}


function del_all_example_bundles ($example_bundle_id){
      $dic_name = "";
    include ("connection.php");


  try {

    $result = $link->query("SELECT * FROM example_bundles WHERE example_bundle_id  = '$example_bundle_id'");
    $example_id="";

    if($result->rowCount()>0){

      foreach ($result as $key => $row){    
        $example_bundle_id=$row["example_bundle_id"];




        $result5 = $link->query("SELECT * FROM examples WHERE example_bundle_id = '$example_bundle_id'");

        
        if($result5->rowCount()>0){
 
          foreach ($result5 as $key => $row){    
            
            $example_id=$row["example_id"];
  
            
            try{
              $sql5 = "DELETE FROM example_prons WHERE example_id = :example_id";
              $stmnt5 = $link->prepare($sql5);

              $entry_data5 = [':example_id'=>$example_id];
              $stmnt5->execute($entry_data5);


            } catch(PDOException $e){
                echo "Erro:6 ".$e->getMessage();
            }


            }//foreach
          
          }else{

          }
      

            try{
              $sql2 = "DELETE FROM examples WHERE example_bundle_id = :example_bundle_id";
              $stmnt2 = $link->prepare($sql2);

              $entry_data2 = [':example_bundle_id'=>$example_bundle_id];
              $stmnt2->execute($entry_data2);




            } catch(PDOException $e){
                echo "Erro:6 ".$e->getMessage();
            }
              
            try{
              $sql2 = "DELETE FROM translations WHERE example_bundle_id = :example_bundle_id";
              $stmnt2 = $link->prepare($sql2);

              $entry_data2 = [':example_bundle_id'=>$example_bundle_id];
              $stmnt2->execute($entry_data2);




            } catch(PDOException $e){
                echo "Erro:7 ".$e->getMessage();
            }


      } // foreach

    }//if

    
  } catch(PDOException $e){
    echo "Erro:99 ".$e->getMessage();
  }


  try{
    $sql2 = "DELETE FROM example_bundles WHERE example_bundle_id = :example_bundle_id";
    $stmnt2 = $link->prepare($sql2);

    $entry_data2 = [':example_bundle_id'=>$example_bundle_id];
    $stmnt2->execute($entry_data2);




  } catch(PDOException $e){
      echo "Erro:8 ".$e->getMessage();
  }



}




function del_sense_bundle ($sense_bundle_id){
      $dic_name = "";
    include ("connection.php");

  try{
    $sql2 = "DELETE FROM sense_bundles WHERE sense_bundle_id = :sense_bundle_id";
    $stmnt2 = $link->prepare($sql2);

    $entry_data2 = [':sense_bundle_id'=>$sense_bundle_id];
    $stmnt2->execute($entry_data2);
 


  
  } catch(PDOException $e){
      echo "Erro:2 ".$e->getMessage();
  }

}

function del_whole_sense ($sense_bundle_id){
      $dic_name = "";
    include ("connection.php");

  try{
    $sql2 = "DELETE FROM senses WHERE sense_bundle_id = :sense_bundle_id";
    $stmnt2 = $link->prepare($sql2);

    $entry_data2 = [':sense_bundle_id'=>$sense_bundle_id];
    $stmnt2->execute($entry_data2);
 


  
  } catch(PDOException $e){
      echo "Erro:3 ".$e->getMessage();
  }

}


function del_all_glosses ($sense_bundle_id){
      $dic_name = "";
    include ("connection.php");
  
  try{
  $sql2 = "DELETE FROM glosses WHERE sense_bundle_id = :sense_bundle_id";
  $stmnt2 = $link->prepare($sql2);

  $entry_data2 = [':sense_bundle_id'=>$sense_bundle_id];
  $stmnt2->execute($entry_data2);




  } catch(PDOException $e){
    echo "Erro:4 ".$e->getMessage();
  }


}

function bck_whole_sense ($sense_bundle_id){
      $dic_name = "";
    include ("connection.php");
  try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM senses WHERE sense_bundle_id = '$sense_bundle_id'");

    if($result->rowCount()>0){
      
      foreach ($result as $row){
          $def=$row["def"];
          $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

              
  
          $target_lang=$row["target_lang"];
          $sense_id=$row["sense_id"];
          $sense_order=$row["sense_order"];
          $lang_code=$row["lang_code"];
          $class=$row["class"];
          $gloss=$row["gloss"];

            //if ($def==""){

          //}else{

              try{
                  $sql = "INSERT INTO senses_bck (sense_bundle_id, entry_ref, sense_id, sense_order, target_lang, lang_code, class, gloss, def) 
                  VALUES (:sense_bundle_id, :entry_ref, :sense_id, :sense_order, :target_lang, :lang_code, :class, :gloss, :def)";
                  $stmnt = $link->prepare($sql);
              
                  $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':sense_id'=>$sense_id, ':sense_order'=>$sense_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':class'=>$class, ':gloss'=>$gloss, ':def'=>$def];
                  $stmnt->execute($entry_data);
              

              } catch(PDOException $e){
                  echo "Erro:222 ".$e->getMessage();
              }//try

          //}//if


        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
      } // if



  
    } catch(PDOException $e){
      echo "Erro:333 ".$e->getMessage();
    }
}


function bck_single_sense ($sense_id){
  $dic_name = "";
include ("connection.php");
try {
//session_start();
//session_start();
$result = $link->query("SELECT * FROM senses WHERE sense_id = '$sense_id'");

if($result->rowCount()>0){
  
  foreach ($result as $row){
      $def=$row["def"];
      $entry_ref_first = $row["entry_ref"];
      $pattern = array();
      $pattern[0] = '/\'/i';
      $pattern[1] = '/\"/i';
      $entry_ref = preg_replace($pattern, '', $entry_ref_first);

          

      $target_lang=$row["target_lang"];
      $sense_bundle_id=$row["sense_bundle_id"];
      $sense_order=$row["sense_order"];
      $lang_code=$row["lang_code"];
      $class=$row["class"];
      $gloss=$row["gloss"];

        //if ($def==""){

      //}else{

          try{
              $sql = "INSERT INTO senses_bck (sense_bundle_id, entry_ref, sense_id, sense_order, target_lang, lang_code, class, gloss, def) 
              VALUES (:sense_bundle_id, :entry_ref, :sense_id, :sense_order, :target_lang, :lang_code, :class, :gloss, :def)";
              $stmnt = $link->prepare($sql);
          
              $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':sense_id'=>$sense_id, ':sense_order'=>$sense_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':class'=>$class, ':gloss'=>$gloss, ':def'=>$def];
              $stmnt->execute($entry_data);
          

          } catch(PDOException $e){
              echo "Erro:222 ".$e->getMessage();
          }//try

      //}//if


    } // foreach      

  }else{
    //echo "A busca não retornou nenhum resultado.";
  } // if




} catch(PDOException $e){
  echo "Erro:333 ".$e->getMessage();
}
}

function bck_all_glosses ($sense_bundle_id){
      $dic_name = "";
    include ("connection.php");
  try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM glosses WHERE sense_bundle_id = '$sense_bundle_id'");

    if($result->rowCount()>0){
      
      foreach ($result as $row){
        $gloss_id=$row["gloss_id"];
        $gloss=$row["gloss"];
        $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

            

        $target_lang=$row["target_lang"];
        $gloss_order=$row["gloss_order"];
        $lang_code=$row["lang_code"];
        $class=$row["class"];

        if ($gloss==""){

        }else{

            try{
                $sql = "INSERT INTO glosses_bck (sense_bundle_id, entry_ref, gloss_id, gloss_order, target_lang, lang_code, class, gloss) 
                VALUES (:sense_bundle_id, :entry_ref, :gloss_id, :gloss_order, :target_lang, :lang_code, :class, :gloss)";
                $stmnt = $link->prepare($sql);
            
                $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':gloss_id'=>$gloss_id, ':gloss_order'=>$gloss_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':class'=>$class, ':gloss'=>$gloss];
                $stmnt->execute($entry_data);
            

            } catch(PDOException $e){
                echo "Erro:444 ".$e->getMessage();
            }//try

        }//if


        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if





    } catch(PDOException $e){
    echo "Erro:5555 ".$e->getMessage();
  }

}

function del_whole_entry_bundle($entry_bundle_id){

  
  $dic_name = "";
  include ("connection.php");



  
  try{
    $result3 = $link->query("SELECT * FROM entries WHERE entry_bundle_id = '$entry_bundle_id'");
    if($result3->rowCount()>0){
        foreach ($result3 as $row){
          $entry_id = $row['entry_id'];
          $entry_ref = $row['entry_ref'];
          $entry_order = $row['entry_order'];
          $entry_homonym = $row['entry_homonym'];


          del_all_form_bundles_complete($entry_id);
          del_all_sense_bundles_complete($entry_id);
          

          $sql3 = "DELETE FROM entries WHERE entry_bundle_id = :entry_bundle_id";
          $stmnt3 = $link->prepare($sql3);
      
          $entry_data3 = [':entry_bundle_id'=>$entry_bundle_id];
          $stmnt3->execute($entry_data3);



          
        }//foreach

      }else{

      }//if

    } catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
  }//try


  try{
    $result = $link->query("SELECT * FROM entry_bundles WHERE entry_bundle_id = '$entry_bundle_id'");
    if($result->rowCount()>0){
        foreach ($result as $row){
          $sql = "DELETE FROM entry_bundles WHERE :entry_bundle_id = '$entry_bundle_id')";
          $stmnt = $link->prepare($sql);
      
          $entry_data = [':entry_bundle_id'=>$entry_bundle_id];
          $stmnt->execute($entry_data);


          
        }//foreach

      }else{

      }//if

    } catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
  }//try


unset($_SESSION["entry_bundle_id"]);

  
}



function bck_whole_entry_bundle($entry_bundle_id){

  
  $dic_name = "";
  include ("connection.php");

  try{
    $result = $link->query("SELECT * FROM entry_bundles WHERE entry_bundle_id = '$entry_bundle_id'");
    if($result->rowCount()>0){
        foreach ($result as $row){
          $entry_ref = $row['entry_ref'];
          $homonym = $row['homonym'];

          $sql = "INSERT INTO entry_bundles_bck (entry_bundle_id, entry_ref, homonym) 
          VALUES (:entry_bundle_id, :entry_ref, :homonym)";
          $stmnt = $link->prepare($sql);
      
          $entry_data = [':entry_bundle_id'=>$entry_bundle_id, ':entry_ref'=>$entry_ref, ':homonym'=>$homonym];
          $stmnt->execute($entry_data);


          
        }//foreach

      }else{

      }//if

    } catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
  }//try


  
  try{
    $result3 = $link->query("SELECT * FROM entries WHERE entry_bundle_id = '$entry_bundle_id'");
    if($result3->rowCount()>0){
        foreach ($result3 as $row){
          $entry_id = $row['entry_id'];
          $entry_ref = $row['entry_ref'];
          $entry_order = $row['entry_order'];
          $entry_homonym = $row['entry_homonym'];

          $sql3 = "INSERT INTO entries_bck (entry_bundle_id, entry_ref, entry_id, entry_order, entry_homonym) 
          VALUES (:entry_bundle_id, :entry_ref, :entry_id, :entry_order, :entry_homonym)";
          $stmnt3 = $link->prepare($sql3);
      
          $entry_data3 = [':entry_bundle_id'=>$entry_bundle_id, ':entry_ref'=>$entry_ref, ':entry_id'=>$entry_id, ':entry_order'=>$entry_order, ':entry_homonym'=>$entry_homonym];
          $stmnt3->execute($entry_data3);




          bck_all_form_bundles_complete($entry_id);
          bck_all_sense_bundles_complete($entry_id);
          

          
        }//foreach

      }else{

      }//if

    } catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
  }//try





  
}




function bck_all_form_bundles_complete($entry_id){

  
  $dic_name = "";
  include ("connection.php");

  try{
    $result4 = $link->query("SELECT * FROM form_bundles WHERE entry_id = '$entry_id'");
    if($result4->rowCount()>0){
        foreach ($result4 as $row){
          $form_bundle_id = $row['form_bundle_id'];
          $entry_ref = $row['entry_ref'];
          $bundle_order = $row['bundle_order'];
    
      
        try{
          $sql4 = "INSERT INTO form_bundles_bck (entry_id, entry_ref, form_bundle_id, bundle_order) 
          VALUES (:entry_id, :entry_ref, :form_bundle_id, :bundle_order)";
          $stmnt4 = $link->prepare($sql4);
      
          $entry_data4 = [':entry_id'=>$entry_id, ':entry_ref'=>$entry_ref, ':form_bundle_id'=>$form_bundle_id, ':bundle_order'=>$bundle_order];
          $stmnt4->execute($entry_data4);
        } catch(PDOException $e){
          echo "Erro: oi1".$e->getMessage();
      }//try


          try{
            $result5 = $link->query("SELECT * FROM forms WHERE form_bundle_id = '$form_bundle_id'");
            if($result5->rowCount()>0){
                foreach ($result5 as $row){
                  $form_id = $row['form_id'];

                  bck_whole_form($form_id);
                              
    
                }//foreach
        
              }else{
        
              }//if
        
            } catch(PDOException $e){
              echo "Erro: oi1".$e->getMessage();
          }//try

          


          

        }//foreach

      }else{

      }//if

    } catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
  }//try


}


function del_all_form_bundles_complete($entry_id){

  
  $dic_name = "";
  include ("connection.php");

  try{
    $result4 = $link->query("SELECT * FROM form_bundles WHERE entry_id = '$entry_id'");
    if($result4->rowCount()>0){
        foreach ($result4 as $row){
          $form_bundle_id = $row['form_bundle_id'];
          $entry_ref = $row['entry_ref'];
          $bundle_order = $row['bundle_order'];



          del_form_complete($form_bundle_id);
          del_form_bundle ($entry_id);
          

        }//foreach

      }else{

      }//if

    } catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
  }//try


}

function del_form_complete($form_bundle_id){
  $dic_name = "";
  include ("connection.php");

  try{
    $result5 = $link->query("SELECT * FROM forms WHERE form_bundle_id = '$form_bundle_id'");
    if($result5->rowCount()>0){
        foreach ($result5 as $row){
          $form_id = $row['form_id'];



          del_form ($form_id);
                      

        }//foreach

      }else{

      }//if

    } catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
  }//try

}

function del_pron ($pron_id){
  $dic_name = "";
  include ("connection.php");


  try{
    $sql = "DELETE FROM prons WHERE pron_id = :pron_id";
    $stmnt = $link->prepare($sql);

    $entry_data = [':pron_id'=>$pron_id];
    $stmnt->execute($entry_data);


    } catch(PDOException $e){
        echo "Erro: oi1".$e->getMessage();
    }//try

}

function del_phonetic ($phonetic_id){
  $dic_name = "";
  include ("connection.php");




  try{
    $result8 = $link->query("SELECT * FROM prons WHERE phonetic_id = '$phonetic_id'");
    if($result8->rowCount()>0){
        foreach ($result8 as $row){
          $pron_id = $row['pron_id'];

          




          del_pron ($pron_id);
                      

        }//foreach

      }else{

      }//if

    } catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
  }//try
 
  try{
    $sql = "DELETE FROM phonetic WHERE phonetic_id = :phonetic_id";
    $stmnt = $link->prepare($sql);

    $entry_data = [':phonetic_id'=>$phonetic_id];
    $stmnt->execute($entry_data);


    } catch(PDOException $e){
        echo "Erro: oi1".$e->getMessage();
    }//try

}


function del_phonemic ($phonemic_id){
  $dic_name = "";
  include ("connection.php");


  

  try{
    $result7 = $link->query("SELECT * FROM phonetic WHERE phonemic_id = '$phonemic_id'");
    if($result7->rowCount()>0){
        foreach ($result7 as $row){
          $phonetic_id = $row['phonetic_id'];

          



          del_phonetic ($phonetic_id);
                      

        }//foreach

      }else{

      }//if

    } catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
  }//try


  try{
    $sql = "DELETE FROM phonemic WHERE phonemic_id = :phonemic_id";
    $stmnt = $link->prepare($sql);

    $entry_data = [':phonemic_id'=>$phonemic_id];
    $stmnt->execute($entry_data);


    } catch(PDOException $e){
        echo "Erro: oi1".$e->getMessage();
    }//try

}
function del_form_bundle ($entry_id){
  $dic_name = "";
  include ("connection.php");


  try{
    $sql4 = "DELETE FROM form_bundles WHERE entry_id = :entry_id";
    $stmnt4 = $link->prepare($sql4);

    $entry_data4 = [':entry_id'=>$entry_id];
    $stmnt4->execute($entry_data4);


  } catch(PDOException $e){
    echo "Erro: oi1".$e->getMessage();

  }//try


}
function del_form ($form_id){
  
  $dic_name = "";
  include ("connection.php");


  try{
    $result6 = $link->query("SELECT * FROM phonemic WHERE form_id = '$form_id'");
    if($result6->rowCount()>0){
        foreach ($result6 as $row){
          $phonemic_id = $row['phonemic_id'];

          


          del_phonemic ($phonemic_id);
                      

        }//foreach

      }else{

      }//if

    } catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
  }//try




  try{
    $sql = "DELETE FROM forms WHERE form_id = :form_id";
    $stmnt = $link->prepare($sql);

    $entry_data = [':form_id'=>$form_id];
    $stmnt->execute($entry_data);


    } catch(PDOException $e){
        echo "Erro: oi1".$e->getMessage();
    }//try


}
function del_all_sense_bundles_complete($entry_id){

  
  $dic_name = "";
  include ("connection.php");
  
  try{
    $result4 = $link->query("SELECT * FROM sense_bundles WHERE entry_id = '$entry_id'");
    if($result4->rowCount()>0){
        foreach ($result4 as $row){
          $sense_bundle_id = $row['sense_bundle_id'];
          $entry_ref = $row['entry_ref'];
          $bundle_order = $row['bundle_order'];
  
          del_whole_sense ($sense_bundle_id);
          del_all_glosses ($sense_bundle_id);
          del_all_scns ($sense_bundle_id);
          del_all_example_bundles ($sense_bundle_id);
          del_sense_bundle ($sense_bundle_id);
        
          
  
        }//foreach
  
      }else{
  
      }//if
  
    } catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
  }//try
  
  
  }


function bck_all_sense_bundles_complete($entry_id){

  
  $dic_name = "";
  include ("connection.php");
  
  try{
    $result4 = $link->query("SELECT * FROM sense_bundles WHERE entry_id = '$entry_id'");
    if($result4->rowCount()>0){
        foreach ($result4 as $row){
          $sense_bundle_id = $row['sense_bundle_id'];
          $entry_ref = $row['entry_ref'];
          $bundle_order = $row['bundle_order'];
  
          $sql4 = "INSERT INTO sense_bundles_bck (entry_id, entry_ref, sense_bundle_id, bundle_order) 
          VALUES (:entry_id, :entry_ref, :sense_bundle_id, :bundle_order)";
          $stmnt4 = $link->prepare($sql4);
      
          $entry_data4 = [':entry_id'=>$entry_id, ':entry_ref'=>$entry_ref, ':sense_bundle_id'=>$sense_bundle_id, ':bundle_order'=>$bundle_order];
          $stmnt4->execute($entry_data4);
  
          bck_whole_sense ($sense_bundle_id);
          bck_all_glosses ($sense_bundle_id);
          bck_all_scns ($sense_bundle_id);
          bck_all_example_bundles ($sense_bundle_id);
        
          
  
  
          
  
        }//foreach
  
      }else{
  
      }//if
  
    } catch(PDOException $e){
      echo "Erro: oi1".$e->getMessage();
  }//try
  
  
  }



function del_entry_bundle($entry_blundle_id){
  
  $dic_name = "";
  include ("connection.php");


  

 

  try{
    $result = $link->query("SELECT * FROM entries WHERE entry_bundle_id = '$entry_bundle_id'");
    if($result->rowCount()>0){
        foreach ($result as $row){
          $entry_id = $row['entry_id']; 



        }//foreach
    }else{}//if




  } catch(PDOException $e){
    echo "Erro: oi1".$e->getMessage();
}//try






    try{
      $sql2 = "DELETE FROM example_bundles WHERE example_bundle_id = :example_bundle_id";
      $stmnt2 = $link->prepare($sql2);
  
      $entry_data2 = [':example_bundle_id'=>$example_bundle_id];
      $stmnt2->execute($entry_data2);
   
  
  
    
    } catch(PDOException $e){
        echo "Erro:2 0i4".$e->getMessage();
    }
  







try{
  $result = $link->query("SELECT * FROM form_bundles WHERE form_bundle_id = '$form_bundle_id'");
  if($result->rowCount()>0){
      foreach ($result as $row){
      $entry_id = $row['entry_id']; 

      }//foreach
  }else{}//if


} catch(PDOException $e){
  echo "Erro: oi1".$e->getMessage();
}//try


  //del_whole_sense ($sense_bundle_id);
  //del_all_glosses ($sense_bundle_id);
  //del_all_scns ($sense_bundle_id);
  //del_all_example_bundles ($sense_bundle_id);
  //del_sense_bundle ($sense_bundle_id);
  
}

function bck_whole_form($form_id){

  bck_vernacular_form_only ($form_id);
  bck_all_phonemic ($form_id);

}



function bck_all_phonemic ($form_id){
      $dic_name = "";
    include ("connection.php");
  $result = $link->query("SELECT * FROM phonemic WHERE form_id = '$form_id'");
  if($result->rowCount()>0){
    
    foreach ($result as $row){
        
      $phonemic_id=$row["phonemic_id"];

        bck_whole_phonemic($phonemic_id);
    }//foreach

  }//if

}


function bck_whole_phonemic($phonemic_id){

  bck_phonemic_form_only ($phonemic_id);
  bck_all_phonetic($phonemic_id);

}

function bck_all_phonetic($phonemic_id){
      $dic_name = "";
    include ("connection.php");
  $result = $link->query("SELECT * FROM phonetic WHERE phonemic_id = '$phonemic_id'");
  if($result->rowCount()>0){
    
    foreach ($result as $row){
        
      $phonetic_id=$row["phonetic_id"];

        bck_phonetic($phonetic_id);
        bck_all_prons($phonetic_id);
    }//foreach

  }//if

}


function bck_vernacular_form_only($form_id){

      $dic_name = "";
    include ("connection.php");
  try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM forms WHERE form_id = '$form_id'");
    if($result->rowCount()>0){
      
      foreach ($result as $row){
          $form_bundle_id=$row["form_bundle_id"];
          
          $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

          //str_replace('"', "", $entry_ref);
          //str_replace("'", "", $entry_ref); 
          //    
  
          $form_id=$row["form_id"];
          $form_order=$row["form_order"];
          $source_lang=$row["source_lang"];            
          $lang_code=$row["lang_code"];
          $vernacular=$row["vernacular"];

          //if(strlen($phonemic)==0 || $phonemic="//" || $phonemic="/ /" || $phonemic="/  /"){

          //}else{

              try{
                  $sql = "INSERT INTO forms_bck (form_bundle_id, entry_ref, form_id, form_order, source_lang, lang_code, vernacular) 
                  VALUES (:form_bundle_id, :entry_ref, :form_id, :form_order, :source_lang, :lang_code, :vernacular)";
                  $stmnt = $link->prepare($sql);
              
                  $entry_data = [':form_bundle_id'=>$form_bundle_id, ':entry_ref'=>$entry_ref, ':form_id'=>$form_id, ':form_order'=>$form_order, ':source_lang'=>$source_lang, ':lang_code'=>$lang_code, ':vernacular'=>$vernacular];
                  $stmnt->execute($entry_data);
              

              } catch(PDOException $e){
                  echo "Erro: oi1 vernacular only".$e->getMessage();
              }//try

          //}//if


        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if



  
  } catch(PDOException $e){
    echo "Erro: 5454 vernacular only".$e->getMessage();
  }


}    


function bck_phonemic_form_only($phonemic_id){
      $dic_name = "";
    include ("connection.php");
  try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM phonemic WHERE phonemic_id = '$phonemic_id'");
    if($result->rowCount()>0){
      
      foreach ($result as $row){
          $form_id=$row["form_id"];
          $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

              
  
          $phonemic_id=$row["phonemic_id"];
          $phonemic_order=$row["phonemic_order"];
          $source_lang=$row["source_lang"];            
          $lang_code=$row["lang_code"];
          $phonemic=$row["phonemic"];

          //if (strlen($phonemic)==0){

          //}else{

            if(strlen($phonemic)==0 || $phonemic="//" || $phonemic="/ /" || $phonemic="/  /"){

            }else{

              try{
                  $sql = "INSERT INTO phonemic_bck (form_id, entry_ref, phonemic_id, phonemic_order, source_lang, lang_code, phonemic) 
                  VALUES (:form_id, :entry_ref, :phonemic_id, :phonemic_order, :source_lang, :lang_code, :phonemic)";
                  $stmnt = $link->prepare($sql);
              
                  $entry_data = [':form_id'=>$form_id, ':entry_ref'=>$entry_ref, ':phonemic_id'=>$phonemic_id, ':phonemic_order'=>$phonemic_order, ':source_lang'=>$source_lang, ':lang_code'=>$lang_code, ':phonemic'=>$phonemic];
                  $stmnt->execute($entry_data);
              

              } catch(PDOException $e){
                  echo "Erro: oi1".$e->getMessage();
              }//try

          }//if


        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if



  
  } catch(PDOException $e){
    echo "Erro: 5454".$e->getMessage();
  }




}

function bck_all_prons($phonetic_id){
      $dic_name = "";
    include ("connection.php");
  try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM prons WHERE phonetic_id = '$phonetic_id'");
    if($result->rowCount()>0){
      
      foreach ($result as $row){
          $pron_id=$row["pron_id"];
          bck_pron($pron_id);



        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if



  
  } catch(PDOException $e){
    echo "Erro: 5454".$e->getMessage();
  }


}


function bck_pron($pron_id){
      $dic_name = "";
    include ("connection.php");
  try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM prons WHERE pron_id = '$pron_id'");
    if($result->rowCount()>0){
      
      foreach ($result as $row){
          $phonetic_id=$row["phonetic_id"];
          $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

              
  
          $pron_id=$row["pron_id"];
          $pron_order=$row["pron_order"];
          $lang_code=$row["lang_code"];
          $source_lang=$row["source_lang"];
          $wav=$row["wav"];
          $mp3=$row["mp3"];
          $mp4=$row["mp4"];
          $wma=$row["wma"];
          $speaker=$row["speaker"];

          if (strlen($wav)==0 && strlen($mp3)==0 && strlen($mp4)==0 && strlen($wma)==0){

          }else{

              try{
                  $sql = "INSERT INTO prons_bck (phonetic_id, entry_ref, pron_id, pron_order, source_lang, lang_code, wav, mp3, mp4, wma, speaker) 
                  VALUES (:phonetic_id, :entry_ref, :pron_id, :pron_order, :source_lang, :lang_code, :wav, :mp3, :mp4, :wma, :speaker)";
                  $stmnt = $link->prepare($sql);
              
                  $entry_data = [':phonetic_id'=>$phonetic_id, ':entry_ref'=>$entry_ref, ':pron_id'=>$pron_id, ':pron_order'=>$pron_order, ':source_lang'=>$source_lang, ':lang_code'=>$lang_code, ':wav'=>$wav, ':mp3'=>$mp3, ':mp4'=>$mp4, ':wma'=>$wma, ':speaker'=>$speaker];
                  $stmnt->execute($entry_data);
              

              } catch(PDOException $e){
                  echo "Erro: oi1".$e->getMessage();
              }//try

          }//if


        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if



  
  } catch(PDOException $e){
    echo "Erro: 5454".$e->getMessage();
  }
}

function bck_phonetic($phonetic_id){
      $dic_name = "";
    include ("connection.php");

  try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM phonetic WHERE phonetic_id = '$phonetic_id'");
    if($result->rowCount()>0){
      
      foreach ($result as $row){
          $phonemic_id=$row["phonemic_id"];
          $entry_ref_first = $row["entry_ref"];
          $pattern = array();
          $pattern[0] = '/\'/i';
          $pattern[1] = '/\"/i';
          $entry_ref = preg_replace($pattern, '', $entry_ref_first);

              
  
          $phonetic_id=$row["phonetic_id"];
          $phonetic_order=$row["phonetic_order"];
          $lang_code=$row["lang_code"];
          $source_lang=$row["source_lang"];
          $phonetic=$row["phonetic"];

          if(strlen($phonetic)==0 || $phonetic="[]" || $phonetic="[ ]" || $phonetic="[  ]"){
          }else{


              try{
                  $sql = "INSERT INTO phonetic_bck (phonemic_id, entry_ref, phonetic_id, phonetic_order, source_lang, lang_code, phonetic) 
                  VALUES (:phonemic_id, :entry_ref, :phonetic_id, :phonetic_order, :source_lang, :lang_code, :phonetic)";
                  $stmnt = $link->prepare($sql);
              
                  $entry_data = [':phonemic_id'=>$phonemic_id, ':entry_ref'=>$entry_ref, ':phonetic_id'=>$phonetic_id, ':phonetic_order'=>$phonetic_order, ':source_lang'=>$source_lang, ':lang_code'=>$lang_code, ':phonetic'=>$phonetic];
                  $stmnt->execute($entry_data);
              

              } catch(PDOException $e){
                echo $phonetic_order;  
                echo "Erro: oi1zzzzz".$e->getMessage();
              }//try
            }//if

        } // foreach      

      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if



  
  } catch(PDOException $e){
    echo "Erro: 5454".$e->getMessage();
  }




}



?>


