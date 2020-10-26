<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }else{
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

