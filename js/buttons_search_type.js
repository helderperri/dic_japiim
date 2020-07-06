$.when(
    $.getScript( "js/panel_search.js" ),
    $.Deferred(function( deferred ){
        $( deferred.resolve );
    })
).done(function(){
    

$(".searchtype").click(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));
            var langtype = $(this).attr("langtype");
            var searchtype = $(this).attr("searchtype");
            $('#reverse').attr("searchtype", searchtype);
            $('#primary').attr("searchtype", searchtype);


            $(".searchtype").removeClass("active");
            $(this).toggleClass("active");
        
    
                        
    
    if(searchtype==1){

        var first_letter = "A";
        var first_letter_id= 1




        call_alpha_panel(first_letter, 1, langtype);
        call_alpha_panel(first_letter, 2, langtype);


        btn_active = "#"+first_letter_id;
        $(btn_active).toggleClass("active");


    }else if(searchtype==2){

        var sd_id = 2;
    
            
        call_sd_panel(sd_id, 1, langtype);                                
        call_sd_panel(sd_id, 2, langtype);                



        btn_active = "#"+sd_id;
        $(btn_active).toggleClass("active");

    }else if(searchtype==3){

        var class_id = 2;
    
            
        call_class_panel(class_id, 1, langtype);                                
        call_class_panel(class_id, 2, langtype);                



        btn_active = "#"+class_id;
        $(btn_active).toggleClass("active");

    }
    butons_keys(searchtype, langtype, btn_active);
        
    
                    
});

})