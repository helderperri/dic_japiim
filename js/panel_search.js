
function butons_keys(searchtype, langtype, btn_display){

    

    $.ajax({
        url:'buttons_keys.php',
        data:{searchtype:searchtype, langtype:langtype},
        type: 'POST',
        success: function(data){
            if(!data.error){
                $('#buttons_keys').html(data);
                $(btn_display).toggleClass("active");

                    }
                }
                
            
            
            
            })


}

    $("#langtype_search").on('change', function (e) {
    //  var optionSelected = $("option:selected", this);
    // var valueSelected = this.value;

        if(langtype==1){
            $("#primary").toggleClass("active");
            $("#reverse").removeClass("active");


        }else if(langtype==2){
            $("#primary").removeClass("active");
            $("#reverse").toggleClass("active");


        }//if
        
       
       var searchtype = $(this).attr('searchtype');
       var langtype = $(this).attr('langtype');
   
       //$(".langtype").attr('langtype', langtype);
       
       $(".langtype_search").removeClass("selected");
       $(this).toggleClass("selected");
       $('#semantic').attr("langtype", langtype);
       $('#alphabetic').attr("langtype", langtype);
       $('#class').attr("langtype", langtype);    
   
       
           
       //call_langtype_choice(langtype, btn1, btn2);
   
       var btn_id = 1;
       //btn_active = ".panel_btn#"+btn_id;
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
        //panel_lang_check(btn1, btn2);
        //call_langtype_choice(langtype, btn1, btn2);

        //butons_keys(searchtype, langtype, btn_active);

    });
    
    $('#search_text').keyup(function(e){
        
        var searchtext = $('#search_text').val();
        var langtype = $(this).attr('langtype');
        var length = searchtext.length;
        
        if(length >= 2){
            var searchtype = 0;
            var reload=1;
            $.ajax({
            url:'panel_search.php',
                data:{searchtext:searchtext, langtype:langtype, searchtype:searchtype, reload:reload},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $('#panel_all_div').html(data);
                    }
                }
                
            })
        
        }
        







    });

    
    $(".panel_btn").click(function() {

        var btn_id = $(this).attr('id');
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
    });
    


    

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
        var btn_active = "panel_btn#"+btn_id;
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


        butons_keys(searchtype, langtype, btn_active);
    
    
    });
    
    

    

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







          
