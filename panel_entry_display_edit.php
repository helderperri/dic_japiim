<?php
    $dic_name = "";
    include ("connection.php");
include ("functions.php");

//$dic_name = $_SESSION['dic_name'];



if (version_compare(phpversion(), '5.4.0', '<')) {
  if(session_id() == '') {
   session_start();
  }
}
else {
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
}

if(isset($_POST['mode'])){

    $mode = $_POST['mode'];
    
    $_SESSION['config_search_'.$dic_name][0]['mode'] = $mode; 
      }else{
    $config_search= $_SESSION['config_search_'.$dic_name][0];
    $mode = $config_search['mode'];   
  
  } 

// CALL FUNCTIONS TO PANEL SEARCH //

if(isset($_POST['entry_bundle_id'])){

  
  $entry_bundle_id = $_POST['entry_bundle_id'];
  $_SESSION['config_search_'.$dic_name][0]['entry_bundle_id'] = $entry_bundle_id;
}  
    ?>
   <div id="entry_bundle_id" display_mode="<?php echo $mode;?>" entry_bundle_id="<?php echo $entry_bundle_id;?>" hidden></div>

<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
      <div class="panel panel-register">
          <div class="panel-body">
              <div class="row">
                  <div class="col-lg-12">
                          
                          <div id="entry_bundle_field_tag_div_<?php echo $entry_bundle_id; ?>" class="col-12 col-xl-12 d-flex flex-reverse p-0 bd-highlight entry_bundle">
                          <div id="entry_bundle_field_tag_<?php echo $entry_bundle_id; ?>" class="ml-auto field_tag">
                                  <small>entrada [<?php echo $entry_bundle_id; ?>]</small>
                              </div>
  
                              <div>
<!--                                  <button id='add_entry_bundle' items="̀1" entry_bundle_id="<?php echo $entry_bundle_id; ?>" type="button"  data-toggle="modal" data-target="#create_new_entry_modal" class='btn btn-default btn-sm p-0 add_entry_bundle add_box'>
                                  <span class="material-icons md-18">add_box</span>
                                  </button>
-->                            </div>
                              <div>
                              <button id='del_entry_bundle' items="̀1" entry_bundle_id="<?php echo $entry_bundle_id; ?>" type="button" class='btn btn-default btn-sm p-0 del_entry_bundle delete' href='#' data-toggle="modal" data-target="#del_entry_bundle_modal">
                                  <span class="material-icons md-18">delete</span>
                                  </button>
                                  </div>
  
                          </div>

    <?php

  
  entry_output_edit($entry_bundle_id);
  
    ?>

      

<?php


    ?>
                </div>
            </div>
        </div>
    </div>
  </div>
<!--<script type='text/javascript' src="js/entry_display_check.js"></script>
<script type='text/javascript' src="js/panel_search.js"></script>-->
<!--<script type='text/javascript' src="js/panel.js"></script>-->
<!--<script type='text/javascript' src="js/sound.js"></script>


<!-- Modal -->
<div class="modal fade" id="del_entry_bundle_modal" tabindex="-1" role="dialog" aria-labelledby="del_entry_bundle_modal_title" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="del_entry_bundle_modal_title">Apagar entrada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body" id="modal_del_entry_panel">


        <?php


                ?>
      <div class="d-flex">
        
        <div class="row">
        <div id="del_entry_alert" class="alert alert-warning mr-2 ml-2 flex-grow-1">
          Você tem certeza que quer apagar toda a entrada?
        </div>
          <div class="col-lg-12" id="del_entry_panel_modal">
            
          
          </div>
        
        </div>

      </div>
         
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-warning" id="del_entry_btn" entry_bundle="<?php echo $entry_bundle_id; ?>">Apagar</button>
    <button type="button" class="btn btn-secondary" id="close_btn_del_entry" data-dismiss="modal">Fechar</button>
    </div>
    </div>
</div>
</div>

<script src="https://vjs.zencdn.net/7.8.4/video.js"></script>
<script type='text/javascript' src="js/image.js"></script>
<script>


$("#del_entry_btn").on('click', function(){

var div_new_entry = "#new_entry_panel_modal";
var entry_bundle_id= $(this).attr("entry_bundle");
console.log("del_entry".concat(entry_bundle_id));
var del_entry = 1;


  $.ajax({
      url:'edit_entry.php',
      data:{entry_bundle_id:entry_bundle_id, del_entry:del_entry},
      type: 'POST',
      success: function(data){
          if(!data.error){
            window.location.href = "index.php";
  
          }

      }
      
  
  })


})


</script>




<!--
<script type='text/javascript' src="js/add_sense.js"></script>
<script type='text/javascript' src="js/edit_sense.js"></script>

<script type='text/javascript' src="js/edit_example_bundle.js"></script>
<script type='text/javascript' src="js/add_example_bundle.js"></script>
<script type='text/javascript' src="js/add_gloss.js"></script>
<script type='text/javascript' src="js/edit_sd.js"></script>
-->



<script type='text/javascript' src="js/edit_form.js"></script>
<script type='text/javascript' src="js/edit_phonemic.js"></script>
<script type='text/javascript' src="js/edit_phonetic.js"></script>
<script type='text/javascript' src="js/edit_pron.js"></script>

