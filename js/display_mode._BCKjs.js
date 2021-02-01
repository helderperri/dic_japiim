$('#edit_mode').on('click', function(){
    
    var entry_bundle_id = $('#entry_bundle_id').attr('entry_bundle_id');
    var mode = 2;
    $('#mode_div').attr('display_mode', 2);
    $("#edit_mode_div").hide();
    $("#view_mode_div").show();
    $("#new_entry_mode_div").show();
    $("#display_config_nav").hide();    
    console.log(mode);
    console.log("oi"); 

    if(typeof entry_bundle_id === 'undefined'){
        console.log("no entries to display"); 

    }else{

    console.log(entry_bundle_id);
    console.log("there are entries to display"); 

        $.ajax({
            url:'panel_entry_display_edit.php',
            data:{entry_bundle_id:entry_bundle_id, mode:mode},
            type: 'POST',
            success: function(data){
                if(!data.error){
                    $('#entry_display').html(data);
        
                }
            }
            
        })
    }
    
  })
$('#view_mode').on('click', function(){

    var entry_bundle_id = $('#entry_bundle_id').attr('entry_bundle_id');
    var mode = 1;
    $('#mode_div').attr('display_mode', 1);
    $("#edit_mode_div").show();
    $("#view_mode_div").hide();
    $("#new_entry_mode_div").hide();
    $("#display_config_nav").show();
    console.log(mode);
    console.log("oi"); 
    if(typeof entry_bundle_id === 'undefined'){
        console.log("no entries to display"); 

    }else{

    console.log(entry_bundle_id);
    console.log("there are entries to display"); 

  
    //var mode = $(this).attr('mode');
    //$(".entry_select").attr('mode', 1);
        $.ajax({
            url:'panel_entry_display.php',
            data:{entry_bundle_id:entry_bundle_id, mode:mode},
            type: 'POST',
            success: function(data){
                if(!data.error){
                    $('#entry_display').html(data);
        
                }
            }
            
        })
    }
})
