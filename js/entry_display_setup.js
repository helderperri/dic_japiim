$('.dropdown-menu').on("click.bs.dropdown", function (e) {
    e.stopPropagation();
//                                            e.preventDefault();
          });


function check_all_sl1(){

    if($("#vernacular_sl1_display").is(":checked") && $("#phonemic_sl1_display").is(":checked") && $("#phonetic_sl1_display").is(":checked") && $("#example_sl1_display").is(":checked") && $("#sl1_code_display").is(":checked")){
        $("#all_sl1_display").prop('checked', true);
    
    }else{
    
    }
    
}

function check_all_sl2(){

    if($("#vernacular_sl2_display").is(":checked") && $("#phonemic_sl2_display").is(":checked") && $("#phonetic_sl2_display").is(":checked") && $("#example_sl2_display").is(":checked") && $("#sl2_code_display").is(":checked")){
        $("#all_sl2_display").prop('checked', true);
    
    }else{
    
    }
    
}



function check_all_tl1(){
    if($("#gloss_tl1_display").is(":checked") && $("#def_tl1_display").is(":checked") && $("#part_of_speech_tl1_display").is(":checked") && $("#translation_tl1_display").is(":checked") && $("#tl1_code_display").is(":checked")){
        $("#all_tl1_display").prop('checked', true);
    
    }else{
    
    }
    
}



function check_all_tl2(){
    if($("#gloss_tl2_display").is(":checked") && $("#def_tl2_display").is(":checked") && $("#part_of_speech_tl2_display").is(":checked") && $("#translation_tl2_display").is(":checked") && $("#tl2_code_display").is(":checked")){
        $("#all_tl2_display").prop('checked', true);
    
    }else{
    
    }
    
}

function hide_form_bundle_sl1(){
    if(!$("#vernacular_sl1_display").is(":checked") && !$("#phonemic_sl1_display").is(":checked") && !$("#phonetic_sl1_display").is(":checked")){
        $(".form_bundle.sl1").hide();
    
    }else{
    
    }
    
}

function hide_form_bundle_sl2(){
    if(!$("#vernacular_sl2_display").is(":checked") && !$("#phonemic_sl2_display").is(":checked") && !$("#phonetic_sl2_display").is(":checked")){
        $(".form_bundle.sl2").hide();
    
    }else{
    
    }
    
}




function hide_sense_bundle_tl1(){
    if(!$("#gloss_tl1_display").is(":checked") && !$("#def_tl1_display").is(":checked") && !$("#part_of_speech_tl1_display").is(":checked") && !$("#part_of_speech_tl1_display").is(":checked")){

        $(".sense_bundle.tl1").hide();
    }else{

    }


}        


    
function hide_sense_bundle_tl2(){
    if(!$("#gloss_tl2_display").is(":checked") && !$("#def_tl2_display").is(":checked") && !$("#part_of_speech_tl2_display").is(":checked")){

        $(".sense_bundle.tl2").hide();
    }else{

    }


}        


$("#all_tl1_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".tl1").show();
        $("#part_of_speech_tl1_display").prop('checked', true);
        $("#gloss_tl1_display").prop('checked', true);
        $("#def_tl1_display").prop('checked', true);
        $("#translation_tl1_display").prop('checked', true);
        $("#tl1_code_display").prop('checked', true);

    }else{
        $(".tl1").hide();
        $("#part_of_speech_tl1_display").prop('checked', false);
        $("#gloss_tl1_display").prop('checked', false);
        $("#def_tl1_display").prop('checked', false);
        $("#translation_tl1_display").prop('checked', false);
        $("#tl1_code_display").prop('checked', false);

    }


        });

$("#all_tl2_display").change(function() {

    if ($(this).is(":checked")){
        $(".tl2").show();
        $("#part_of_speech_tl2_display").prop('checked', true);
        $("#gloss_tl2_display").prop('checked', true);
        $("#def_tl2_display").prop('checked', true);
        $("#translation_tl2_display").prop('checked', true);
        $("#tl2_code_display").prop('checked', true);


    }else{
        $(".tl2").hide();
        $("#part_of_speech_tl2_display").prop('checked', false);
        $("#gloss_tl2_display").prop('checked', false);
        $("#def_tl2_display").prop('checked', false);
        $("#translation_tl2_display").prop('checked', false);
        $("#tl2_code_display").prop('checked', false);

    }


        });


$("#all_sl1_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".sl1").show();
        $("#vernacular_sl1_display").prop('checked', true);
        $("#phonemic_sl1_display").prop('checked', true);
        $("#phonetic_sl1_display").prop('checked', true);
        $("#example_sl1_display").prop('checked', true);
        $("#sl1_code_display").prop('checked', true);


    }else{
        $(".sl1").hide();
        $("#vernacular_sl1_display").prop('checked', false);
        $("#phonemic_sl1_display").prop('checked', false);
        $("#phonetic_sl1_display").prop('checked', false);
        $("#example_sl1_display").prop('checked', false);
        $("#sl1_code_display").prop('checked', false);

    }


        });

        

$("#all_sl2_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".sl2").show();
        $("#vernacular_sl2_display").prop('checked', true);
        $("#phonemic_sl2_display").prop('checked', true);
        $("#phonetic_sl2_display").prop('checked', true);
        $("#example_sl2_display").prop('checked', true);
        $("#sl2_code_display").prop('checked', true);


    }else{
        $(".sl2").hide();
        $("#vernacular_sl2_display").prop('checked', false);
        $("#phonemic_sl2_display").prop('checked', false);
        $("#phonetic_sl2_display").prop('checked', false);
        $("#example_sl2_display").prop('checked', false);
        $("#sl2_code_display").prop('checked', false);

    }


        });



$("#vernacular_sl1_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".vernacular.sl1").show();
        $(".form_bundle.sl1").show();
        check_all_sl1();


    }else{
        $(".vernacular.sl1").hide();
        $("#all_sl1_display").prop('checked', false);
        hide_form_bundle_sl1();
    }


        });


$("#vernacular_sl2_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".vernacular.sl2").show();
        check_all_sl2();
        $(".form_bundle.sl2").show();


    }else{
        $(".vernacular.sl2").hide();
        $("#all_sl2_display").prop('checked', false);
        hide_form_bundle_sl2();
    }


        });


$("#phonemic_sl1_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".phonemic.sl1").show();
        check_all_sl1();
        $(".form_bundle.sl1").show();

    }else{
        $(".phonemic.sl1").hide();
        $("#all_sl1_display").prop('checked', false);
        hide_form_bundle_sl1();
    }


        });


$("#phonemic_sl2_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".phonemic.sl2").show();
        check_all_sl2();
        $(".form_bundle.sl2").show();


    }else{
        $(".phonemic.sl2").hide();
        $("#all_sl2_display").prop('checked', false);
        hide_form_bundle_sl2();
    }


        });

$("#phonetic_sl1_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".phonetic.sl1").show();
        check_all_sl1();
        $(".form_bundle.sl1").show();

    }else{
        $(".phonetic.sl1").hide();
        $("#all_sl1_display").prop('checked', false);
        hide_form_bundle_sl1();
    }


        });


$("#phonetic_sl2_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".phonetic.sl2").show();
        check_all_sl2();
        $(".form_bundle.sl2").show();



    }else{
        $(".phonetic.sl2").hide();
        $("#all_sl2_display").prop('checked', false);
        hide_form_bundle_sl2();
    }


        });




$("#part_of_speech_tl1_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".part_of_speech.tl1").show();
        check_all_tl1();
        $(".sense_bundle.tl1").show();
        

    }else{
        $(".part_of_speech.tl1").hide();
        $("#all_tl1_display").prop('checked', false);
        hide_sense_bundle_tl1();
    }


        });





$("#part_of_speech_tl2_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".part_of_speech.tl2").show();
        check_all_tl2();
        $(".sense_bundle.tl2").show();
        

    }else{
        $(".part_of_speech.tl2").hide();
        $("#all_tl2_display").prop('checked', false);
        hide_sense_bundle_tl2()

    }


        });








$("#gloss_tl1_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".gloss.tl1").show();
        check_all_tl1();
        $(".sense_bundle.tl1").show();



    }else{
        $(".gloss.tl1").hide();
        $("#all_tl1_display").prop('checked', false);
        hide_sense_bundle_tl1();
    }


        });





$("#gloss_tl2_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".gloss.tl2").show();
        check_all_tl2();
        $(".sense_bundle.tl2").show();


    }else{
        $(".gloss.tl2").hide();
        $("#all_tl2_display").prop('checked', false);
        hide_sense_bundle_tl2()

    }


        });

$("#def_tl1_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".def.tl1").show();
        check_all_tl1();
        $(".sense_bundle.tl1").show();


    }else{
        $(".def.tl1").hide();
        $("#all_tl1_display").prop('checked', false);
        hide_sense_bundle_tl1()
    }


        });



$("#def_tl2_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".def.tl2").show();
        check_all_tl2();
        $(".sense_bundle.tl2").show();


    }else{
        $(".def.tl2").hide();
        $("#all_tl2_display").prop('checked', false);
        hide_sense_bundle_tl2()

    }


        });




$("#sd_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".sd").show();


    }else{
        $(".sd").hide();

    }


        });


$("#scn_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".scn").show();


    }else{
        $(".scn").hide();

    }


        });









$("#example_sl1_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".example_bundle.sl1").show();
        check_all_sl1();

    }else{
        $(".example_bundle.sl1").hide();
        $("#all_sl1_display").prop('checked', false);

    }


        });

$("#example_sl2_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".example_bundle.sl2").show();
        check_all_sl2();


    }else{
        $(".example_bundle.sl2").hide();
        $("#all_sl2_display").prop('checked', false);

    }


        });



$("#translation_tl1_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".translation.tl1").show();
        check_all_tl1();

    }else{
        $(".translation.tl1").hide();
        $("#all_tl1_display").prop('checked', false);

    }


        });


$("#translation_tl2_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".translation.tl2").show();
        check_all_tl2();

    }else{
        $(".translation.tl2").hide();
        $("#all_tl2_display").prop('checked', false);

    }


        });

$("#image_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".image").show();

    }else{
        $(".image").hide();

    }


        });


$("#lang_code_all_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".lang_code").show();


    }else{
        $(".lang_code").hide();
    }


        });




$("#sl1_code_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".lang_code.sl1").show();


    }else{
        $(".lang_code.sl1").hide();
    }


        });

$("#sl2_code_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".lang_code.sl2").show();


    }else{
        $(".lang_code.sl2").hide();
    }


        });


$("#tl1_code_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".lang_code.tl1").show();


    }else{
        $(".lang_code.tl1").hide();
    }


        });

$("#tl2_code_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".lang_code.tl2").show();


    }else{
        $(".lang_code.tl2").hide();
    }


        });

