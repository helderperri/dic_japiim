$(".langchoice").click(function(){

    var btn1 = $("#lang_btn1").attr("btndisplay");
    var btn2 = $("#lang_btn2").attr("btndisplay");
    var langtype =$(this).attr("langtype");
    var searchtype =$(this).attr("searchtype");
    var btn_id =$(this).attr("btn_number");
    var lang_number =$(this).attr("btn_number");
    var btn_active = "#panel_btn_".concat(1);
    var btn_display = $(this).attr("btndisplay");
    //var panel = "#panel_s"+btn_id+"_div";


    if(langtype==1){

        var btn_change = "#sl_choice_btn_"+btn_id+"_control";

        var panel = "#panel_s"+btn_id+"_div";


    }else if(langtype==2){
       var btn_change = "#target_lang_btn"+btn_id+"_control";

        var panel = "#panel_t"+btn_id+"_div";


    }




    if(btn_display == 1){
        $(this).attr("btndisplay", 0)
        $(this).removeClass("active");
        //$(btn_change).attr("btndisplay", 0)

        $(panel).hide();


    }else if(btn_display == 0){
        $(this).attr("btndisplay", 1)
        $(this).toggleClass("active");
        //$(btn_change).attr("btndisplay", 1)


        $(panel).show();

    }else{

    }

    var reload = 1;
    $.ajax({
        url:'buttons_keys.php',
        data:{searchtype:searchtype, langtype:langtype, lang_number:lang_number, btn_display:btn_display, reload:reload},
        type: 'POST',
        success: function(data){
            if(!data.error){
                $('#buttons_keys').html(data);
                $(btn_active).toggleClass("active");

                    }
                }
                
            
            
            
            })





    })


