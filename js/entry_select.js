$('.entry_select').on('click', function(){
    $('.entry_select').removeClass( "active");
    $(this).addClass("active");          
    var search = $(this).attr('value');
    var mode = $('#mode_div').attr('display_mode');
    
    var entry_bundle_id = $(this).attr('entry_bundle_id');
    $("#modeEditEntryBundleId").attr("value", entry_bundle_id);
    $("#modeViewEntryBundleId").attr("value", entry_bundle_id);
    //$("#mode_view_entry_bundle_id").val(entry_bundle_id);
    //$("#mode_edit_entry_bundle_id").val(entry_bundle_id);
  //var select = document.getElementById('product_id');
  //var index = $('#example').selectedIndex;
  //var given_text = index.options[index].value;
              //            console.log(search);
              update_entry =1;

              $.ajax({
                url:'config_session.php',
                data:{entry_bundle_id:entry_bundle_id, update_entry:update_entry},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                    //    $('#entry_display').html(data);
                    console.log("testando 1");
            
                    }
                }
            })

          
          
if(mode==1){

  $.ajax({
      url:'panel_entry_display.php',
      data:{entry_bundle_id:entry_bundle_id, search:search},
      type: 'POST',
      success: function(data){
          if(!data.error){
              $('#entry_display').html(data);
  
          }
      }
      
  
  
  
  })
}else if(mode==2){

    $.ajax({
        url:'panel_entry_display_edit.php',
        data:{entry_bundle_id:entry_bundle_id, search:search},
        type: 'POST',
        success: function(data){
            if(!data.error){
                $('#entry_display').html(data);
    
            }
        }
        
    
    
    
    })
}
  


})