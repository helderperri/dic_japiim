
<?php

    $dic_name = "";
    include ("connection.php");
//include ("functions.php");


if(isset($_POST['lang_code'])){

    $lang_code = $_POST['lang_code'];
    
      }else{
  
  } 

  if(isset($_POST['target_lang'])){

    $target_lang = $_POST['target_lang'];
    
      }else{
  
  } 

  if(isset($_POST['bundle'])){

    $sense_bundle_id = $_POST['bundle'];
    
      }else{
  
  }

  if(isset($_POST['gloss_id'])){

    $gloss_id = $_POST['gloss_id'];
    
      }else{
  
  }

  if(isset($_POST['gloss_order'])){

    $gloss_order = $_POST['gloss_order'];
    
      }else{
  
  }

  if(isset($_POST['gloss'])){

    $gloss = $_POST['gloss'];
    
      }else{
  
  }

  if(isset($_POST['items'])){

    $items = $_POST['items'];
    
      }else{
  
  }

if(isset($_POST['restore_gloss']) || isset($_POST['update_gloss'])){

  try {
  
    $result = $link->query("SELECT * FROM glosses WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code'");


  } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
  } // try
  //END //glosses //END
  $number_of_items = $result->rowCount();





    $result2 = $link->query("SELECT * FROM glosses_bck WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY gloss_id");
  
    if($result2->rowCount()>0){
        foreach ($result2 as $key => $row){    
          $gloss_id_bck=$row["gloss_id_bck"];
          $gloss= $row["gloss"];
          $target_lang= $row["target_lang"];
          $class = $row["class"];

          ?>
          <div class="d-flex">
          <button items="<?php echo $number_of_items; ?>" class='btn btn-default btn-sm p-0 restore_gloss' id='restore_gloss_<?php echo $gloss_id_bck; ?>' gloss_id='<?php echo $gloss_id_bck; ?>' lang_code="<?php echo $lang_code; ?>" bundle="<?php echo $sense_bundle_id; ?>" type="button">
              <span class="material-icons md-18">restore</span>
          </button>
          <div id="gloss_<?php echo $sense_bundle_id ?>" class="mr-auto mr-4 gloss tl<?php echo $target_lang;?>">
          <?php echo $gloss; ?>
          </div>
          </div>
          <?php

        }//foreach

        ?>
                  <script type='text/javascript'>
                  $('.restore_gloss').on('click', function(){
                    var lang_code = $(this).attr('lang_code');
                    var bundle = $(this).attr('bundle');
                    //var select = document.getElementById('product_id');
                  //var index = $('#example').selectedIndex;
                  //var given_text = index.options[index].value;
                              //            console.log(search);
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
}//if




}


if(isset($_POST['restore_scn']) || isset($_POST['update_scn'])){


    $result2 = $link->query("SELECT * FROM scns_bck WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY scn_id");
    
    if($result2->rowCount()>0){
        foreach ($result2 as $key => $row){    
          $scn_id=$row["scn_id"];
          $scn= $row["scn"];
          $target_lang= 1;
    
          ?>
          <div class="d-flex">
          <button class='btn btn-default btn-sm p-0 restore_scn' id='btn_restore_scn_<?php echo $scn_id; ?>' scn_id='<?php echo $scn_id; ?>' lang_code="<?php echo $lang_code; ?>" bundle="<?php echo $sense_bundle_id; ?>" type="button">
              <span class="material-icons md-18">restore</span>
          </button>
          <div id="scn_<?php echo $sense_bundle_id ?>" class="mr-auto mr-4 scn tl<?php echo $target_lang;?>">
          <?php echo $scn; ?>
          </div>
          </div>
          <?php
    
        }//foreach
    
        ?>
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
    }//if
    
    
    
    
    }
    
    

if(isset($_POST['update_sd_modal'])){

      //$lang_code = "";
      $result = $link->query("SELECT * FROM sds WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY sd_id");
      $sd_items = $result->rowCount();
      $item_count=0;
      $selected_ids =[];
      

      foreach ($result as $key => $row){    
                
        $sd_id=$row["sd_id"];
        $selected_ids[]=$sd_id;
      }//foreach


      $target_langs_info = $_SESSION['config_tls_'.$dic_name];
      foreach($target_langs_info as $target_lang_info){
        $tl_number = $target_lang_info['target_lang'];
          $lang_code = $target_lang_info['lang_code'];
        if($tl_number == $target_lang){

      ?>
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
            <input class="form-check-input sd_checkbox" type="checkbox" tl="<?php echo $target_lang; ?>" tls="<?php echo $number_of_tls; ?>" bundle="<?php echo $sense_bundle_id; ?>" id="<?php echo $sd_id; ?>" order = "<?php echo $sd_order; ?>" value='<?php echo $sd_name; ?>' <?php echo $checked; ?>>
              <label class="form-check-label" for="sd_<?php echo $sd_id; ?>"><?php echo $sd_name; ?></label><br>
        </div>
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
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
  </div>
  

  <?php      
      if($number_of_tls==$target_lang){

    ?>

<!--<script type='text/javascript' src="js/edit_sd.js"></script>
<script>-->

    alert("oi34");
</script>

    <?php


      }



}//if

      }//foreach
      
      }
      
      
