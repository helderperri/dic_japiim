
$.when(
    $.getScript( "js/panel_search.js" ),
    $.Deferred(function( deferred ){
        $( deferred.resolve );
    })
).done(function(){
    


    $(".langtype").click(function() {

        var searchtype = $(this).attr('searchtype');
        var langtype = $(this).attr('langtype');
    
        
        $(".langtype").removeClass("active");
        $(this).toggleClass("active");
        $('#semantic').attr("langtype", langtype);
        $('#alphabetic').attr("langtype", langtype);
        $('#class').attr("langtype", langtype);
    
        if(langtype==1){
            var btn1 = $("#source_lang_btn1_control").attr("btndisplay");
            var btn2 = $("#source_lang_btn2_control").attr("btndisplay");
        
    
        }else if(langtype==2){
            var btn1 = $("#target_lang_btn1_control").attr("btndisplay");
            var btn2 = $("#target_lang_btn2_control").attr("btndisplay");
    
    
        }
    
    
    
    
        panel_lang_check(btn1, btn2);
        
        call_lang_type_choice(langtype, btn1, btn2);
    
    
    
    if(searchtype==1){
    
    
    var first_letter = "A";
    var first_letter_id = 1;
    btn_active = "#"+first_letter_id;
    
    
    call_alpha_panel(first_letter, 1, langtype);
    call_alpha_panel(first_letter, 2, langtype);
    
    
    
    }else if(searchtype==2){
    
    
    var sd_id = 2;
    btn_active = "#"+sd_id;
    
    
    call_sd_panel(sd_id, 1, langtype);                                
    call_sd_panel(sd_id, 2, langtype);                
    
    }else if(searchtype==3){
    
    
        var class_id = 2;
        btn_active = "#"+class_id;
        
        
        call_class_panel(class_id, 1, langtype);                                
        call_class_panel(class_id, 2, langtype);                
        
        }
    
        butons_keys(searchtype, langtype, btn_active);
    
    
    });
    
    


 
    
    


});






