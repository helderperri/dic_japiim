
function butons_keys(searchtype, langtype, btn_active){

    

    $.ajax({
        url:'buttons_keys.php',
        data:{searchtype:searchtype, langtype:langtype},
        type: 'POST',
        success: function(data){
            if(!data.error){
                $('#buttons_keys').html(data);
                $(btn_active).toggleClass("active");

                    }
                }
                
            
            
            
            })


}

function call_alpha_panel(first_letter, lang, langtype){

                
    $.ajax({
        url:'panel_alpha.php',
        data:{first_letter:first_letter, lang:lang, langtype:langtype},
        type: 'POST',
        success: function(data){
            if(!data.error){


                if(lang==1){
                    $('#panel_s1_div').html(data);
                }else if(lang==2){
                    $('#panel_s2_div').html(data);                             
        
                }                
            }
        }
        
    
    
    
    })
    
}



function call_sd_panel(sd_id, lang, langtype){

                
    $.ajax({
        url:'panel_sd.php',
        data:{sd_id:sd_id, lang:lang, langtype:langtype},
        type: 'POST',
        success: function(data){
            if(!data.error){


                if(lang==1){
                    $('#panel_s1_div').html(data);
                }else if(lang==2){
                    $('#panel_s2_div').html(data);                             
        
                }                
            }
        }
        
    
    
    
    })
    

}

function call_class_panel(class_id, lang, langtype){

                
    $.ajax({
        url:'panel_class.php',
        data:{class_id:class_id, lang:lang, langtype:langtype},
        type: 'POST',
        success: function(data){
            if(!data.error){


                if(lang==1){
                    $('#panel_s1_div').html(data);
                }else if(lang==2){
                    $('#panel_s2_div').html(data);                             
        
                }                
            }
        }
        
    
    
    
    })
    

}


function call_search_text_panel(search, lang, langtype){

    $.ajax({
   
        url:'search_text.php',
        data:{search:search, lang:lang, langtype:langtype},
        type: 'POST',
        success: function(data){
            if(!data.error){


                if(lang==1){
                    $('#panel_s1_div').html(data);
                }else if(lang==2){
                    $('#panel_s2_div').html(data);                             
        
                }                
            }
        }

        
        });
             
             
     

}



function panel_lang_check(btn1, btn2){

    if(btn1 == 1){

        $("#panel_s1_div").show();
    }else{
        $("#panel_s1_div").hide();
        
        }

    if(btn2 == 1){

        $("#panel_s2_div").show();
    }else{
        $("#panel_s2_div").hide();
        
        }

    
}




function call_lang_type_choice(langtype, btn1, btn2){

    $.ajax({
        url:'buttons_lang_type_choice.php',
        data:{langtype: langtype, btn1: btn1, btn2: btn2},
        type: 'POST',
        success: function(data){
            if(!data.error){
                $("#lang_choice").html(data);

    
            }
        }
        
    
    
    
    })




}


