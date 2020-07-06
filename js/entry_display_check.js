



if($("#all_tl1_display").is(":checked")){

    $(".tl1").show();
}else{
    
}


if($("#all_tl2_display").is(":checked")){

    $(".tl2").show();
}else{
    
}

if($("#all_sl1_display").is(":checked")){

    $(".sl1").show();
}else{

}



if($("#all_sl2_display").is(":checked")){

    $(".sl2").show();
}else{
    
}


if($("#vernacular_sl1_display").is(":checked")){

    $(".vernacular.sl1").show();
}else{
    $(".vernacular.sl1").hide();
    
}


if($("#vernacular_sl2_display").is(":checked")){

    $(".vernacular.sl2").show();
}else{
    $(".vernacular.sl2").hide();
    
}

if($("#phonemic_sl1_display").is(":checked")){

    $(".phonemic.sl1").show();
}else{
    $(".phonemic.sl1").hide();
    
}


if($("#phonemic_sl2_display").is(":checked")){

    $(".phonemic.sl2").show();
}else{
    $(".phonemic.sl2").hide();
    
}

if($("#phonetic_sl1_display").is(":checked")){

    $(".phonetic.sl1").show();
}else{
    $(".phonetic.sl1").hide();
    
}


if($("#phonetic_sl2_display").is(":checked")){

    $(".phonetic.sl2").show();
}else{
    $(".phonetic.sl2").hide();
    
}
if($("#part_of_speech_tl1_display").is(":checked")){

    $(".part_of_speech.tl1").show();
}else{
    $(".part_of_speech.tl1").hide();
    
}


if($("#part_of_speech_tl2_display").is(":checked")){

    $(".part_of_speech.tl2").show();
}else{
    $(".part_of_speech.tl2").hide();
    
}



if($("#gloss_tl1_display").is(":checked")){

    $(".gloss.tl1").show();
}else{
    $(".gloss.tl1").hide();
    
}


if($("#gloss_tl2_display").is(":checked")){

    $(".gloss.tl2").show();
}else{
    $(".gloss.tl2").hide();
    
}


if($("#def_tl1_display").is(":checked")){

    $(".def.tl1").show();
}else{
    $(".def.tl1").hide();
    
}


if($("#def_tl2_display").is(":checked")){

    $(".def.tl2").show();
}else{
    $(".def.tl2").hide();
    
}












if($("#example_sl1_display").is(":checked")){

    $(".example.sl1").show();
}else{
    $(".example.sl1").hide();
    
}

if($("#example_sl2_display").is(":checked")){

    $(".example.sl2").show();
}else{
    $(".example.sl2").hide();
    
}






if($("#translation_tl1_display").is(":checked")){

    $(".translation.tl1").show();
}else{
    $(".translation.tl1").hide();
    
}

if($("#translation_tl2_display").is(":checked")){

    $(".translation.tl2").show();
}else{
    $(".translation.tl2").hide();
    
}



if($("#sd_display").is(":checked")){

    $(".sd").show();
}else{
    $(".sd").hide();
    
}


if($("#scn_display").is(":checked")){

    $(".scn").show();
}else{
    $(".scn").hide();
    
}



if($("#image_display").is(":checked")){

    $(".image").show();
}else{
    $(".image").hide();
    
}


if($("#lang_code_all_display").is(":checked")){

    $(".lang_code").show();
}else{
    //$(".lang_code").hide();
    
}



if($("#sl1_code_display").is(":checked")){

    $(".lang_code.sl1").show();
}else{
    $(".lang_code.sl1").hide();
    
}

if($("#sl2_code_display").is(":checked")){

    $(".lang_code.sl2").show();
}else{
    $(".lang_code.sl2").hide();
    
}

if($("#tl1_code_display").is(":checked")){

    $(".lang_code.tl1").show();
}else{
    $(".lang_code.tl1").hide();
    
}

if($("#tl2_code_display").is(":checked")){

    $(".lang_code.tl2").show();
}else{
    $(".lang_code.tl2").hide();
    
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
    if(!$("#gloss_tl1_display").is(":checked") && !$("#def_tl1_display").is(":checked") && !$("#part_of_speech_tl1_display").is(":checked")){

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




hide_sense_bundle_tl1();
hide_sense_bundle_tl2();

hide_form_bundle_sl1();
hide_form_bundle_sl2();

