
$.when(
    $.getScript( "js/panel_search.js" ),
    $.Deferred(function( deferred ){
        $( deferred.resolve );
    })
).done(function(){


   
$("#langtype_search").on('change', function (e) {
  //  var optionSelected = $("option:selected", this);
   // var valueSelected = this.value;


    var searchtype = $("option:selected", this).attr('searchtype');
    var langtype = $("option:selected", this).attr('langtype');
    $('#semantic').attr("langtype", langtype);
    $('#alphabetic').attr("langtype", langtype);
    $('#class').attr("langtype", langtype);



    if(langtype==1){
        var btn1 = $("#source_lang_btn1_control").attr("btndisplay");
        var btn2 = $("#source_lang_btn2_control").attr("btndisplay");
        $("#primary").toggleClass("active");
         $("#reverse").removeClass("active");


    }else if(langtype==2){
        var btn1 = $("#target_lang_btn1_control").attr("btndisplay");
        var btn2 = $("#target_lang_btn2_control").attr("btndisplay");
        $("#primary").removeClass("active");
         $("#reverse").toggleClass("active");


    }




    panel_lang_check(btn1, btn2);
    
    call_lang_type_choice(langtype, btn1, btn2);



if(searchtype==1){


var first_letter = "A";
var first_letter_id = 1;
var btn_active = "#"+first_letter_id;


call_alpha_panel(first_letter, 1, langtype);
call_alpha_panel(first_letter, 2, langtype);



}else if(searchtype==2){


var sd_id = 2;
var btn_active = "#"+sd_id;


call_sd_panel(sd_id, 1, langtype);                                
call_sd_panel(sd_id, 2, langtype);                

}else if(searchtype==3){


    var class_id = 2;
    var btn_active = "#"+class_id;
    
    
    call_class_panel(class_id, 1, langtype);                                
    call_class_panel(class_id, 2, langtype);                
    
    }
    butons_keys(searchtype, langtype, btn_active);



});

    
    
$('#search_text').keyup(function(){
       
    var search = $('#search_text').val();
    var langtype = $(this).attr('langtype');
    var length = search.length;
    
if(length >= 2){
    if(langtype == 1){
        $(".alphabtn.active").removeClass("active");
        $(".sembtn.active").removeClass("active");
        $(".classbtn.active").removeClass("active");
        
    }else if(langtype == 2){
        $(".alphabtn_rev.active").removeClass("active");
        $(".sembtn_rev.active").removeClass("active");
        $(".classbtn_rev.active").removeClass("active");
    
            }
    

                call_search_text_panel(search, 1, langtype);
                call_search_text_panel(search, 2, langtype);    
        
    
            }
    
    });





$(".alphabtn").click(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));


    var first_letter = $(this).val();
    $(".alphabtn.active").removeClass("active");
    $(this).toggleClass("active");
    $('#search_text').val('');
    var langtype = 1;
    var btn1 = $("#source_lang_btn1_control").attr("btndisplay");
    var btn2 = $("#source_lang_btn2_control").attr("btndisplay");


                call_alpha_panel(first_letter, 1, langtype);
                call_alpha_panel(first_letter, 2, langtype);


                panel_lang_check(btn1, btn2);
            
                       

 
                
        });


$(".alphabtn_rev").click(function() {


        var first_letter = $(this).val();
        $(".alphabtn_rev.active").removeClass("active");
        $(this).toggleClass("active");
        $('#search_text').val('');
        var langtype=2;

        
        call_alpha_panel(first_letter, 1, langtype);
        call_alpha_panel(first_letter, 2, langtype);


            });


            





$(".sembtn").click(function() {


    var sd_id = $(this).attr('id');
    $(".sembtn.active").removeClass("active");
    $(this).toggleClass("active");
    $('#search_text').val('');

    var langtype = 1;


                //var select = document.getElementById('product_id');
                //var index = $('#example').selectedIndex;
                //var given_text = index.options[index].value;
                // console.log(search);
                
                call_sd_panel(sd_id, 1, langtype);                                
                call_sd_panel(sd_id, 2, langtype);       

    
        });





$(".sembtn_rev").click(function() {


    var sd_id = $(this).attr('id');
    $(".sembtn_rev.active").removeClass("active");
    $(this).toggleClass("active");
    $('#search_text').val('');

    var langtype = 2;


                //var select = document.getElementById('product_id');
                //var index = $('#example').selectedIndex;
                //var given_text = index.options[index].value;
                // console.log(search);
                
                call_sd_panel(sd_id, 1, langtype);                                
                call_sd_panel(sd_id, 2, langtype);                


                
    
        });




             
            

$(".classbtn").click(function() {


    var class_id = $(this).attr('id');
    $(".classbtn.active").removeClass("active");
    $(this).toggleClass("active");
    $('#search_text').val('');

    var langtype = 1;


                //var select = document.getElementById('product_id');
                //var index = $('#example').selectedIndex;
                //var given_text = index.options[index].value;
                // console.log(search);
                
                call_class_panel(class_id, 1, langtype);                                
                call_class_panel(class_id, 2, langtype);       

    
        });





$(".classbtn_rev").click(function() {


    var class_id = $(this).attr('id');
    $(".classbtn_rev.active").removeClass("active");
    $(this).toggleClass("active");
    $('#search_text').val('');

    var langtype = 2;


                //var select = document.getElementById('product_id');
                //var index = $('#example').selectedIndex;
                //var given_text = index.options[index].value;
                // console.log(search);
                
                call_class_panel(class_id, 1, langtype);                                
                call_class_panel(class_id, 2, langtype);                


                
    
        });




      
      
    })



    $(".sembtn_display").click(function() {


        var sd_id = $(this).attr('id');
        $(".sembtn.active").removeClass("active");
        $(".sembtn_rev.active").removeClass("active");
        $(".alphabtn.active").removeClass("active");
        $(".alphabtn_rev.active").removeClass("active");
        //$(this).toggleClass("active");
        $('#search_text').val('');
        var langtype = $('#alphabetic').attr("langtype");


            call_sd_panel(sd_id, 1, langtype);                                
            call_sd_panel(sd_id, 2, langtype);       




    
                    
            
        
            });
    
    
$(".classbtn_display").click(function() {


    var class_id = $(this).attr('id');
    $(".sembtn.active").removeClass("active");
    $(".sembtn_rev.active").removeClass("active");
    $(".alphabtn.active").removeClass("active");
    $(".alphabtn_rev.active").removeClass("active");
    //$(this).toggleClass("active");
    $('#search_text').val('');
    var langtype = $('#alphabetic').attr("langtype");


    call_class_panel(class_id, 1, langtype);                                
    call_class_panel(class_id, 2, langtype);       





                
        
    
        });


