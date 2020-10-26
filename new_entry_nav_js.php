<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }else{
  }


      $dic_name = "";
      include ("connection.php");
  
  
  $source_langs_info = $_SESSION['config_sls_'.$dic_name];
  
?>

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
                    //window.location.replace = "index.php";   
                }

            }
            
        
          })


  }











})


</script>
