$("#langtype_search").on('change', function (e) {
    //  var optionSelected = $("option:selected", this);
    // var valueSelected = this.value;

    var optionSelected = $(this).find("option:selected");
        
     
       var searchtype = $(optionSelected).attr('searchtype');
       var langtype = $(optionSelected).attr('langtype');
   
       if(langtype==1){
            $("#primary").toggleClass("active");
            $("#reverse").removeClass("active");


        }else if(langtype==2){
            $("#primary").removeClass("active");
            $("#reverse").toggleClass("active");


        }//if
        console.log(searchtype);
        console.log(langtype);
        
       //$(".langtype").attr('langtype', langtype);
       
       //$(".langtype_search.selected").removeClass("selected");
       //$(this).toggleClass("selected");
       $('#semantic').attr("langtype", langtype);
       $('#alphabetic').attr("langtype", langtype);
       $('#class').attr("langtype", langtype);    
   
       
           
       //call_langtype_choice(langtype, btn1, btn2);
   
       var btn_id = 1;
       var btn_active = "#panel_btn"+btn_id;
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
        //panel_lang_check(btn1, btn2);
        //call_langtype_choice(langtype, btn1, btn2);

        //butons_keys(searchtype, langtype, btn_active);
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
