



$(".langchoice").click(function(){

        var btn1 = $("#lang_btn1").attr("btndisplay");
        var btn2 = $("#lang_btn2").attr("btndisplay");
        var langtype =$(this).attr("langtype");
        var btn_id =$(this).attr("btn_number");
        var panel = "#panel_s"+btn_id+"_div";


        if(langtype==1){

            btn_change = "#source_lang_btn"+btn_id+"_control";

        }else if(langtype==2){
            btn_change = "#target_lang_btn"+btn_id+"_control";

        }




        if($(this).attr("btndisplay") == 1){
            $(this).attr("btndisplay", 0)
            $(this).removeClass("active");
            $(btn_change).attr("btndisplay", 0)

            $(panel).hide();


        }else if($(this).attr("btndisplay") == 0){
            $(this).attr("btndisplay", 1)
            $(this).toggleClass("active");
            $(btn_change).attr("btndisplay", 1)


            $(panel).show();

        }else{

        }

        
 


})

