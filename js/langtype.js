$(".langtype").click(function() {

    var searchtype = $(this).attr('searchtype');
    var langtype = $(this).attr('langtype');

    //$(".langtype").attr('langtype', langtype);

    $(".langtype").removeClass("active");
    $(this).toggleClass("active");
    $('#semantic').attr("langtype", langtype);
    $('#alphabetic').attr("langtype", langtype);
    $('#class').attr("langtype", langtype);    


    if(langtype==1){
        $("#langtype_search_reverse").removeClass("active");
        $("#langtype_search_primary").toggleClass("active");


    }else if(langtype==2){
        $("#langtype_search_reverse").toggleClass("active");
        $("#langtype_search_primary").removeClass("active");


    }//if

        
    //call_langtype_choice(langtype, btn1, btn2);

    var btn_id = 1;
    var btn_active = "#panel_btn_".concat(btn_id);
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