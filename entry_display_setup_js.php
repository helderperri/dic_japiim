<?php
       
       if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    //$dic_name = $_SESSION['dic_name'];
    $dic_name = "";
    include ("connection.php");
    
        
?>
<script>

    $('.dropdown-menu').on("click.bs.dropdown", function (e) {
        e.stopPropagation();
    });


    function update_session (direction, lang_number, field, display){


        var update_session = 1;

        $.ajax({
            url:'config_session.php',
            data:{direction:direction, lang_number:lang_number, field:field, display:display, update_session:update_session},
            type: 'POST',
            success: function(data){
                //if(!data.error){
                    //$('#entry_display').html(data);

                //}
            }
            



        })
    }


    </script>

    <script>

$("#scn_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".scn").show();
        update_session ('no_lang', 0, 'scn', 1);


    }else{
        $(".scn").hide();
        update_session ('no_lang', 0, 'scn', 0);

    }


});

          
$("#image_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".image").show();
        update_session ('no_lang', 0, 'image', 1);

    }else{
        $(".image").hide();
        update_session ('no_lang', 0, 'image', 0);

    }


});

    
$("#video_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".video").show();
        update_session ('no_lang', 0, 'video', 1);

    }else{
        $(".video").hide();
        update_session ('no_lang', 0, 'video', 0);

    }


});


$("#lang_code_all_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

    if ($(this).is(":checked")){
        $(".lang_code").show();
        $(".sl_code_display").prop('checked', true);
        $(".tl_code_display").prop('checked', true);
        
       <?php
       
       foreach ($_SESSION['config_sls_'.$dic_name] as $row){
        $source_lang = $row["source_lang"];
       ?>
        update_session ('source', <?php echo $source_lang; ?>, 'lang_code_display', 0);
        console.log("source_lang");
        <?php
       }
       ?>

        <?php
       
       foreach ($_SESSION['config_tls_'.$dic_name] as $row){
        $target_lang = $row["target_lang"];
       ?>
        update_session ('target', <?php echo $target_lang; ?>, 'lang_code_display', 0);
        console.log("target_lang");
        <?php
       }
       ?>


    }else{
        $(".lang_code").hide();
        $(".sl_code_display").prop('checked', false);
        $(".tl_code_display").prop('checked', false);


        <?php
       
       foreach ($_SESSION['config_sls_'.$dic_name] as $row){
        $source_lang = $row["source_lang"];
       ?>
        update_session ('source', <?php echo $source_lang; ?>, 'lang_code_display', 1);
        console.log("source_lang");
        <?php
       }
       ?>

        <?php
       
       foreach ($_SESSION['config_tls_'.$dic_name] as $row){
        $target_lang = $row["target_lang"];
       ?>
        update_session ('target', <?php echo $target_lang; ?>, 'lang_code_display', 1);
        console.log("target_lang");
        <?php
       }
       ?>



   }


});





    </script>









    <?php
foreach ($_SESSION['config_sls_'.$dic_name] as $row){

    $source_lang = $row['source_lang'];
    //$index = $row['index'];
    $lang_code_sl = $row['lang_code'];

        ?>

<script>


function check_all_sl<?php echo $source_lang;?>(){

if($("#vernacular_sl<?php echo $source_lang;?>_display").is(":checked") && $("#phonemic_sl<?php echo $source_lang;?>_display").is(":checked") && $("#pron_sl<?php echo $source_lang;?>_display").is(":checked") && $("#example_sl<?php echo $source_lang;?>_display").is(":checked") && $("#sl<?php echo $source_lang;?>_code_display").is(":checked")){
    $("#all_sl<?php echo $source_lang;?>_display").prop('checked', true);

}else{

}

}


function hide_form_bundle_sl<?php echo $source_lang;?>(){
if(!$("#vernacular_sl<?php echo $source_lang;?>_display").is(":checked") && !$("#phonemic_sl<?php echo $source_lang;?>_display").is(":checked") && !$("#pron_sl<?php echo $source_lang;?>_display").is(":checked")){
    $(".form_bundle.sl<?php echo $source_lang;?>").hide();


}else{

}

}


$("#all_sl<?php echo $source_lang;?>_display").change(function() {
//alert(this.id); // or 
//alert($(this).attr('id'));

if ($(this).is(":checked")){
    $(".sl<?php echo $source_lang;?>").show();
    $("#vernacular_sl<?php echo $source_lang;?>_display").prop('checked', true);
    $("#phonemic_sl<?php echo $source_lang;?>_display").prop('checked', true);
    $("#pron_sl<?php echo $source_lang;?>_display").prop('checked', true);
    $("#example_sl<?php echo $source_lang;?>_display").prop('checked', true);
    $("#sl<?php echo $source_lang;?>_code_display").prop('checked', true);
    update_session ('source', '<?php echo $source_lang;?>', 'all', 1);



}else{
    $(".sl<?php echo $source_lang;?>").hide();
    $("#vernacular_sl<?php echo $source_lang;?>_display").prop('checked', false);
    $("#phonemic_sl<?php echo $source_lang;?>_display").prop('checked', false);
    $("#pron_sl<?php echo $source_lang;?>_display").prop('checked', false);
    $("#example_sl<?php echo $source_lang;?>_display").prop('checked', false);
    $("#sl<?php echo $source_lang;?>_code_display").prop('checked', false);
    update_session ('source', '<?php echo $source_lang;?>', 'all', 0);

}


    });

    


$("#vernacular_sl<?php echo $source_lang;?>_display").change(function() {
//alert(this.id); // or 
//alert($(this).attr('id'));

if ($(this).is(":checked")){
    $(".vernacular.sl<?php echo $source_lang;?>").show();
    $(".form_bundle.sl<?php echo $source_lang;?>").show();
    check_all_sl<?php echo $source_lang;?>();
    update_session ('source', '<?php echo $source_lang;?>', 'vernacular', 1)


}else{
    $(".vernacular.sl<?php echo $source_lang;?>").hide();
    $("#all_sl<?php echo $source_lang;?>_display").prop('checked', false);
    hide_form_bundle_sl<?php echo $source_lang;?>();
    update_session ('source', '<?php echo $source_lang;?>', 'vernacular', 0)
}


    });



$("#phonemic_sl<?php echo $source_lang;?>_display").change(function() {
//alert(this.id); // or 
//alert($(this).attr('id'));

if ($(this).is(":checked")){
    $(".phonemic.sl<?php echo $source_lang;?>").show();
    check_all_sl<?php echo $source_lang;?>();
    $(".form_bundle.sl<?php echo $source_lang;?>").show();
    update_session ('source', '<?php echo $source_lang;?>', 'phonemic', 1)

}else{
    $(".phonemic.sl<?php echo $source_lang;?>").hide();
    $("#all_sl<?php echo $source_lang;?>_display").prop('checked', false);
    hide_form_bundle_sl<?php echo $source_lang;?>();
    update_session ('source', '<?php echo $source_lang;?>', 'phonemic', 0)
}


    });

$("#phonetic_sl<?php echo $source_lang;?>_display").change(function() {
//alert(this.id); // or 
//alert($(this).attr('id'));

if ($(this).is(":checked")){
    $(".phonetic.sl<?php echo $source_lang;?>").show();
    check_all_sl<?php echo $source_lang;?>();
    $(".form_bundle.sl<?php echo $source_lang;?>").show();
    update_session ('source', '<?php echo $source_lang;?>', 'phonetic', 1)

}else{
    $(".phonetic.sl<?php echo $source_lang;?>").hide();
    $("#all_sl<?php echo $source_lang;?>_display").prop('checked', false);
    hide_form_bundle_sl<?php echo $source_lang;?>();
    update_session ('source', '<?php echo $source_lang;?>', 'phonetic', 0)

}


    });



    $("#pronunciation_sl<?php echo $source_lang;?>_display").change(function() {
//alert(this.id); // or 
//alert($(this).attr('id'));

if ($(this).is(":checked")){
    $(".pron.sl<?php echo $source_lang;?>").show();
    check_all_sl<?php echo $source_lang;?>();
    $(".form_bundle.sl<?php echo $source_lang;?>").show();
    update_session ('source', '<?php echo $source_lang;?>', 'pronunciation', 1)

}else{
    $(".pron.sl<?php echo $source_lang;?>").hide();
    $("#all_sl<?php echo $source_lang;?>_display").prop('checked', false);
    hide_form_bundle_sl<?php echo $source_lang;?>();
    update_session ('source', '<?php echo $source_lang;?>', 'pronunciation', 0)

}


    });



$("#example_sl<?php echo $source_lang;?>_display").change(function() {
//alert(this.id); // or 
//alert($(this).attr('id'));

if ($(this).is(":checked")){
    $(".example_bundle.sl<?php echo $source_lang;?>").show();
    check_all_sl<?php echo $source_lang;?>();
    update_session ('source', '<?php echo $source_lang;?>', 'example', 1)

}else{
    $(".example_bundle.sl<?php echo $source_lang;?>").hide();
    $("#all_sl<?php echo $source_lang;?>_display").prop('checked', false);
    update_session ('source', '<?php echo $source_lang;?>', 'example', 0)

}


    });




    $("#example_audio_sl<?php echo $source_lang;?>_display").change(function() {
//alert(this.id); // or 
//alert($(this).attr('id'));

if ($(this).is(":checked")){
    $(".example_bundle.sl<?php echo $source_lang;?>").show();
    $(".example_audio.sl<?php echo $source_lang;?>").show();
    check_all_sl<?php echo $source_lang;?>();
    update_session ('source', '<?php echo $source_lang;?>', 'example_audio', 1)

}else{
    $(".example_audio.sl<?php echo $source_lang;?>").hide();
    $("#all_sl<?php echo $source_lang;?>_display").prop('checked', false);
    update_session ('source', '<?php echo $source_lang;?>', 'example_audio', 0)

}


    });




    $("#example_phonetic_sl<?php echo $source_lang;?>_display").change(function() {
//alert(this.id); // or 
//alert($(this).attr('id'));

if ($(this).is(":checked")){
    $(".example_bundle.sl<?php echo $source_lang;?>").show();
    $(".example_phonetic.sl<?php echo $source_lang;?>").show();
    check_all_sl<?php echo $source_lang;?>();
    update_session ('source', '<?php echo $source_lang;?>', 'example_phonetic', 1)

}else{
    $(".example_phonetic.sl<?php echo $source_lang;?>").hide();
    $("#all_sl<?php echo $source_lang;?>_display").prop('checked', false);
    update_session ('source', '<?php echo $source_lang;?>', 'example_phonetic', 0)

}


    });

$("#sl<?php echo $source_lang;?>_code_display").change(function() {
//alert(this.id); // or 
//alert($(this).attr('id'));

if ($(this).is(":checked")){
    $(".lang_code.sl<?php echo $source_lang;?>").show();
    update_session ('source', '<?php echo $source_lang;?>', 'lang_code_display', 1)


}else{
    $(".lang_code.sl<?php echo $source_lang;?>").hide();
    update_session ('source', '<?php echo $source_lang;?>', 'lang_code_display', 0)
}


    });



    </script>

        <?php

        }//foreach
        
        ?>




<?php


foreach ($_SESSION['config_tls_'.$dic_name] as $row){
    //$index = $row['index'];
    $lang_code_tl = $row['lang_code'];
    $target_lang = $row['target_lang'];
    
    ?>
    <script>

    function check_all_tl<?php echo $target_lang;?>(){
        if($("#gloss_tl<?php echo $target_lang;?>_display").is(":checked") && $("#def_tl<?php echo $target_lang;?>_display").is(":checked") && $("#part_of_speech_tl<?php echo $target_lang;?>_display").is(":checked") && $("#translation_tl<?php echo $target_lang;?>_display").is(":checked") && $("#tl<?php echo $target_lang;?>_code_display").is(":checked")){
            $("#all_tl<?php echo $target_lang;?>_display").prop('checked', true);

        }else{

        }

    }





    function hide_sense_bundle_tl<?php echo $target_lang;?>(){

        if(!$("#gloss_tl<?php echo $target_lang;?>_display").is(":checked") && !$("#def_tl<?php echo $target_lang;?>_display").is(":checked") && !$("#part_of_speech_tl<?php echo $target_lang;?>_display").is(":checked") && !$("#part_of_speech_tl<?php echo $target_lang;?>_display").is(":checked")){

            $(".sense_bundle.tl<?php echo $target_lang;?>").hide();
        }else{

        }


    }        


    $("#all_tl<?php echo $target_lang;?>_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

        if ($(this).is(":checked")){
            $(".tl<?php echo $target_lang;?>").show();
            $("#part_of_speech_tl<?php echo $target_lang;?>_display").prop('checked', true);
            $("#gloss_tl<?php echo $target_lang;?>_display").prop('checked', true);
            $("#def_tl<?php echo $target_lang;?>_display").prop('checked', true);
            $("#translation_tl<?php echo $target_lang;?>_display").prop('checked', true);
            $("#tl<?php echo $target_lang;?>_code_display").prop('checked', true);
            update_session ('target', '<?php echo $target_lang;?>', 'all', 1)

        }else{
            $(".tl<?php echo $target_lang;?>").hide();
            $("#part_of_speech_tl<?php echo $target_lang;?>_display").prop('checked', false);
            $("#gloss_tl<?php echo $target_lang;?>_display").prop('checked', false);
            $("#def_tl<?php echo $target_lang;?>_display").prop('checked', false);
            $("#translation_tl<?php echo $target_lang;?>_display").prop('checked', false);
            $("#tl<?php echo $target_lang;?>_code_display").prop('checked', false);
            update_session ('target', '<?php echo $target_lang;?>', 'all', 0)

        }


    });


    $("#part_of_speech_tl<?php echo $target_lang;?>_display").change(function() {
        //alert(this.id); // or 
        //alert($(this).attr('id'));

        if ($(this).is(":checked")){
            $(".part_of_speech.tl<?php echo $target_lang;?>").show();
            check_all_tl<?php echo $target_lang;?>();
            $(".sense_bundle.tl<?php echo $target_lang;?>").show();
            update_session ('target', '<?php echo $target_lang;?>', 'class', 1)
            

        }else{
            $(".part_of_speech.tl<?php echo $target_lang;?>").hide();
            $("#all_tl<?php echo $target_lang;?>_display").prop('checked', false);
            hide_sense_bundle_tl<?php echo $target_lang;?>();
            update_session ('target', '<?php echo $target_lang;?>', 'class', 0)
        }




    });


    $("#sd_tl<?php echo $target_lang;?>_display").change(function() {
        //alert(this.id); // or 
        //alert($(this).attr('id'));
        if ($(this).is(":checked")){
            $(".sd_div.tl<?php echo $target_lang;?>").show();
            update_session ('target', '<?php echo $target_lang;?>', 'semantic', 1)


        }else{
            $(".sd_div.tl<?php echo $target_lang;?>").hide();
            update_session ('target', '<?php echo $target_lang;?>', 'semantic', 0)

        }


    });





    $("#gloss_tl<?php echo $target_lang;?>_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

        if ($(this).is(":checked")){
            $(".gloss.tl<?php echo $target_lang;?>").show();
            check_all_tl<?php echo $target_lang;?>();
            $(".sense_bundle.tl<?php echo $target_lang;?>").show();
            update_session ('target', '<?php echo $target_lang;?>', 'gloss', 1)



        }else{
            $(".gloss.tl<?php echo $target_lang;?>").hide();
            $("#all_tl<?php echo $target_lang;?>_display").prop('checked', false);
            hide_sense_bundle_tl<?php echo $target_lang;?>();
            update_session ('target', '<?php echo $target_lang;?>', 'gloss', 0)
        }


    });



    $("#def_tl<?php echo $target_lang;?>_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

        if ($(this).is(":checked")){
            $(".def.tl<?php echo $target_lang;?>").show();
            check_all_tl<?php echo $target_lang;?>();
            $(".sense_bundle.tl<?php echo $target_lang;?>").show();
            update_session ('target', '<?php echo $target_lang;?>', 'def', 1)


        }else{
            $(".def.tl<?php echo $target_lang;?>").hide();
            $("#all_tl<?php echo $target_lang;?>_display").prop('checked', false);
            hide_sense_bundle_tl<?php echo $target_lang;?>()
            update_session ('target', '<?php echo $target_lang;?>', 'def', 0)

        }


    });




    $("#translation_tl<?php echo $target_lang;?>_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

        if ($(this).is(":checked")){
            $(".translation.tl<?php echo $target_lang;?>").show();
            check_all_tl<?php echo $target_lang;?>();
            update_session ('target', '<?php echo $target_lang;?>', 'example_translation', 1)

        }else{
            $(".translation.tl<?php echo $target_lang;?>").hide();
            $("#all_tl<?php echo $target_lang;?>_display").prop('checked', false);
            update_session ('target', '<?php echo $target_lang;?>', 'example_translation', 0)

        }


    });


    $("#tl<?php echo $target_lang;?>_code_display").change(function() {
    //alert(this.id); // or 
    //alert($(this).attr('id'));

        if ($(this).is(":checked")){
            $(".lang_code.tl<?php echo $target_lang;?>").show();
            update_session ('target', '<?php echo $target_lang;?>', 'lang_code_display', 1)


        }else{
            $(".lang_code.tl<?php echo $target_lang;?>").hide();
            update_session ('target', '<?php echo $target_lang;?>', 'lang_code_display', 0)
        }


    });



        </script>


        <?php
}//foreach




foreach ($_SESSION['config_search_'.$dic_name]  as $key => $row){
    $is_checked = "";
    $video = $row['video'];
    if($video == 1){
        $is_checked = "checked";
    }
}
        
