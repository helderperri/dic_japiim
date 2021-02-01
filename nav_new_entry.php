<?php

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
 


      $dic_name = "";
      include ("connection.php");
  
  
  $source_langs_info = $_SESSION['config_sls_'.$dic_name];
  
?>
<!-- Modal -->
<div class="modal fade" id="create_new_entry_modal" tabindex="-1" role="dialog" aria-labelledby="create_new_entry_modal_title" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="create_new_entry_modal_title">Nova entrada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body" id="modal_new_entry_panel">


        <?php


                ?>
      <div class="d-flex">
        
        <div class="row">
        <div id="new_entry_alert" class="alert alert-primary mr-2 ml-2 flex-grow-1" style="display:none"></div>
          <div class="col-lg-12" id="new_entry_panel_modal">
            
            <form id="new_entry_form" role="form" >

            <?php                          
            
            foreach($source_langs_info as $source_lang_info){
              $lang_code = $source_lang_info['lang_code'];

            
            ?>

              <div class="form-group d-flex">
                  <input type="text" name="new_entry" id="new_entry_<?php echo $lang_code; ?>" tabindex="1" class="form-control" placeholder="Forma vernácula" value=""><div class="pl-1 mr-auto">[<?php echo $lang_code; ?>]</div>
              </div>
            
            <?php
            }

            ?>


            </form>
          
          </div>
        
        </div>

      </div>
         
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" id="insert_new_entry">Inserir</button>
    <button type="button" class="btn btn-secondary" id="close_btn_new_entry" data-dismiss="modal">Fechar</button>
    </div>
    </div>
</div>
</div>

<script>

$("#insert_new_entry").on('click', function(){

var div_new_entry = "#new_entry_panel_modal";
var new_entry=1;
console.log("new_entry");
var sl_count = 1;
var total_len = 0;
<?php 
        foreach($source_langs_info as $source_lang_info){
          $lang_code = $source_lang_info['lang_code'];
          $source_lang = $source_lang_info['source_lang'];
          ?>
           var form_sl<?php echo $source_lang; ?> = $("#new_entry_<?php echo $lang_code; ?>").val();
           console.log(form_sl<?php echo $source_lang; ?>);
           var len = form_sl<?php echo $source_lang; ?>.length;
           total_len = total_len + len;
           sl_count = sl_count+1;
          <?php

        }
        
        ?>

  if(total_len === 0){

          $('#new_entry_alert').show();
          $('#new_entry_alert').text("Insira uma nova entrada.");

  }else{
    console.log("there are new entries");
    
    $.ajax({
      url:'edit_entry.php',
      data:{<?php 
            foreach($source_langs_info as $source_lang_info){
              $lang_code = $source_lang_info['lang_code'];
              $source_lang = $source_lang_info['source_lang'];
              ?>form_sl<?php echo $source_lang; ?>:form_sl<?php echo $source_lang; ?>,<?php } ?> sl_count:sl_count, new_entry:new_entry},
              type: 'POST',
              success: function(data){
                  if(!data.error){
                      $(div_new_entry).html(data);
          
                  }

              }
      
  
    })

    var div_panel_entry = "#entry_display";
    var update_entry = 1;


          $.ajax({
            url:'edit_entry.php',
            data:{update_entry:update_entry},
            type: 'POST',
            success: function(data){
                  if(!data.error){
                    //location.reload()
                    window.location.href = "index.php"; 
                    //window.location.replace("index.php");
                    //window.location.replace = "index.php";   
                }

            }
            
        
          })


  }











})


</script>
