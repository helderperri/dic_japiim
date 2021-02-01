$('#edit_mode').on('click', function(){
    
    $("#mode_2_submit").trigger('click');
    


    var update_config_session = 1;
    var mode = 2;

    $.ajax({
        url:'config_session.php',
        data:{mode:mode, update_config_session:update_config_session},
        type: 'POST',
        success: function(data){
            //if(!data.error){
                //$('#entry_display').html(data);

            //}
        }
        



    })





  })




$('#view_mode').on('click', function(){

    $("#mode_1_submit").trigger('click');

    var update_config_session = 1;
    var mode = 1;

    $.ajax({
        url:'config_session.php',
        data:{mode:mode, update_config_session:update_config_session},
        type: 'POST',
        success: function(data){
            //if(!data.error){
                //$('#entry_display').html(data);

            //}
        }
        



    })




})
