$(".panel_btn").click(function() {
    var btn_id = $(this).attr('btn_id');
    $(".panel_btn.active").removeClass("active");
    $(this).toggleClass("active");
    var langtype = $(this).attr('langtype');
    var searchtype = $(this).attr('searchtype');
    var reload=1;

    $.ajax({
        url:'panel_search.php',
        data:{btn_id:btn_id, langtype:langtype, searchtype:searchtype, reload:reload},
        type: 'POST',
        success: function(data){
            if(!data.error){
                $('#panel_all_div').html(data);
            }
        }
        
    })


    var update_config_session = 1;

    $.ajax({
        url:'config_session.php',
        data:{btn_id:btn_id, update_config_session:update_config_session},
        type: 'POST',
        success: function(data){
            //if(!data.error){
                //$('#entry_display').html(data);

            //}
        }
        



    })




    });

