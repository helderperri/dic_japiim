
$(".searchtype").click(function() {
    var langtype = $(this).attr("langtype");
    var searchtype = $(this).attr("searchtype");
    $('#reverse').attr("searchtype", searchtype);
    $('#primary').attr("searchtype", searchtype);
    $('.langchoice').attr("searchtype", searchtype); 
    $(".searchtype.active").removeClass("active");
    $(this).toggleClass("active");            
    var btn_id = 1;
    var btn_active = "#panel_btn_"+btn_id;
    var reload = 1;
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

    $.ajax({
        url:'buttons_keys.php',
        data:{searchtype:searchtype, langtype:langtype, reload:reload},
        type: 'POST',
        success: function(data){
            if(!data.error){
                $('#buttons_keys').html(data);
                $(btn_active).toggleClass("active");

                    }
                }
                
            
            
            
            })

                
});