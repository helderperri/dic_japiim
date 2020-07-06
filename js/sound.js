

            $('.btnpron').click(function() {


                var pron_id = $(this).attr('id');

                audio_id = "#audio_"+pron_id;
                var audio_play = $(audio_id).get(0);
                audio_play.load();
                audio_play.play();
                

               });


            $('.btnex').click(function() {
                //alert("oi");

            var example_id = $(this).attr('id');


            audio_id2 = "#control_"+example_id;
            var audio_play2 = $(audio_id2).get(0);
            audio_play2.load();
            audio_play2.play();
            

            });

