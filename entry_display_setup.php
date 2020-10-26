<?php

       
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

 //$dic_name = $_SESSION['dic_name'];
 $dic_name = "";
 include ("connection.php");
 


    //include ("lang_check.php");
        ?>
        <div class="dropdown-header text-center">Mostrar Campos do Dicionário</div>                           
        <div class="dropdown-header"><small>Línguas</small></div>                           
        <?php
    foreach ($_SESSION['config_sls_'.$dic_name] as $key => $row){
        $index = $key+1;
        $lang_code_sl = $row['lang_code'];
        ?>
        <div class="checkbox dropdown-item">
            <input id="all_sl<?php echo $index; ?>_display" type="checkbox" ><label for="all_sl<?php echo $index; ?>_display" style="padding-left:.3em;">Todos em <?php echo $lang_code_sl; ?></label>
        </div>
        <?php
        }

    foreach ($_SESSION['config_tls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code_tl = $row['lang_code'];
        ?>
        <div class="checkbox dropdown-item">
            <input id="all_tl<?php echo $index; ?>_display" type="checkbox" ><label for="all_tl<?php echo $index; ?>_display" style="padding-left:.3em;">Todos em <?php echo $lang_code_tl; ?></label>
        </div>
        <?php
        }
        ?>
        <div class="dropdown-divider"></div>                           
        <div class="dropdown-header"><small>Forma</small></div>
        <?php

    foreach ($_SESSION['config_sls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $vernacular = $row['vernacular'];
        if($vernacular == 1){
            $is_checked = "checked";
        }
        ?>
        <div class="checkbox dropdown-item">
            <input id="vernacular_sl<?php echo $index; ?>_display" type="checkbox" <?php echo $is_checked; ?>><label for="vernacular_sl<?php echo $index; ?>_display" style="padding-left:.3em;">Vernácula [<?php echo $lang_code; ?>]</label>
        </div>
        <?php
    }

    foreach ($_SESSION['config_sls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $phonemic = $row['phonemic'];
        if($phonemic == 1){
            $is_checked = "checked";
        }
        ?>
        <div class="checkbox dropdown-item">
            <input id="phonemic_sl<?php echo $index; ?>_display" type="checkbox" <?php echo $is_checked; ?>><label for="phonemic_sl<?php echo $index; ?>_display" style="padding-left:.3em;">Fonêmica [<?php echo $lang_code; ?>]</label>
        </div>
        <?php
    }

    foreach ($_SESSION['config_sls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $phonetic = $row['phonetic'];
        if($phonetic == 1){
            $is_checked = "checked";
        }
        ?>
        <div class="checkbox dropdown-item">
            <input id="phonetic_sl<?php echo $index; ?>_display" type="checkbox" <?php echo $is_checked; ?>><label for="phonetic_sl<?php echo $index; ?>_display" style="padding-left:.3em;">Fonética [<?php echo $lang_code; ?>]</label>
        </div>
        <?php
    }

    foreach ($_SESSION['config_sls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $pronunciation = $row['pronunciation'];
        if($pronunciation == 1){
            $is_checked = "checked";
        }
        
    ?>
        <div class="checkbox dropdown-item">
            <input id="pronunciation_sl<?php echo $index; ?>_display" type="checkbox" <?php echo $is_checked; ?>><label for="pronunciation_sl<?php echo $index; ?>_display" style="padding-left:.3em;">Áudio da Pronúncia [<?php echo $lang_code; ?>]</label>
        </div>
        <?php
    }

    ?>

        <div class="dropdown-divider"></div>
        <div class="dropdown-header"><small>Sentido</small></div>                           
        <?php

    foreach ($_SESSION['config_tls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $gloss = $row['gloss'];
        if($gloss == 1){
            $is_checked = "checked";
        }
            ?>
            <div class="checkbox dropdown-item">
                <input id="gloss_tl<?php echo $index; ?>_display" type="checkbox" <?php echo $is_checked; ?>><label for="gloss_tl<?php echo $index; ?>_display" style="padding-left:.3em;">Glosa [<?php echo $lang_code; ?>]</label>
            </div>
            <?php
    }

    foreach ($_SESSION['config_tls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $def = $row['def'];
        if($def == 1){
            $is_checked = "checked";
        }
            ?>
            <div class="checkbox dropdown-item">
                <input id="def_tl<?php echo $index; ?>_display" type="checkbox" <?php echo $is_checked; ?>><label for="def_tl<?php echo $index; ?>_display" style="padding-left:.3em;">Definição [<?php echo $lang_code; ?>]</label>
            </div>
            <?php
    }

    foreach ($_SESSION['config_tls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $class = $row['class'];
        if($class == 1){
            $is_checked = "checked";
        }
            ?>
            <div class="checkbox dropdown-item">
                <input id="part_of_speech_tl<?php echo $index; ?>_display" type="checkbox" <?php echo $is_checked; ?>><label for="part_of_speech_tl<?php echo $index; ?>_display" style="padding-left:.3em;">Classe [<?php echo $lang_code; ?>]</label>
            </div>
            <?php
    }
    

    foreach ($_SESSION['config_tls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $semantic = $row['semantic'];
        if($semantic == 1){
            $is_checked = "checked";
        }
            ?>
            <div class="checkbox dropdown-item">
                <input id="sd_tl<?php echo $index; ?>_display" type="checkbox" <?php echo $is_checked; ?>><label for="sd_tl<?php echo $index; ?>_display" style="padding-left:.3em;">Campos Semânticos [<?php echo $lang_code; ?>]</label>
            </div>
            <?php
    }

    foreach ($_SESSION['config_tls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $comments = $row['comments'];
        if($comments == 1){
            $is_checked = "checked";
        }
            ?>
            <div class="checkbox dropdown-item">
                <input id="comments_tl<?php echo $index; ?>_display" type="checkbox" <?php echo $is_checked; ?>><label for="comments_tl<?php echo $index; ?>_display" style="padding-left:.3em;">Comentários [<?php echo $lang_code; ?>]</label>
            </div>
            <?php
    }
    
    

    foreach ($_SESSION['config_search_'.$dic_name]  as $key => $row){
        $is_checked = "";
        $scn = $row['scn'];
        if($scn == 1){
            $is_checked = "checked";
        }
            ?>
            <div class="checkbox dropdown-item">
                <input id="scn_display" type="checkbox" <?php echo $is_checked; ?>><label for="scn_display" style="padding-left:.3em;">Nome Científico</label>
            </div>
            <?php
    }

    ?>
        <div class="dropdown-divider"></div>                           
        <div class="dropdown-header"><small>Exemplo</small></div>                           

        <?php

    foreach ($_SESSION['config_sls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $example = $row['example'];
        if($example == 1){
            $is_checked = "checked";
        }
        
    ?>
        <div class="checkbox dropdown-item">
            <input id="example_sl<?php echo $index; ?>_display" type="checkbox" <?php echo $is_checked; ?>><label for="example_sl<?php echo $index; ?>_display" style="padding-left:.3em;">Vernácula [<?php echo $lang_code; ?>]</label>
        </div>
        <?php
    }

    
    
    foreach ($_SESSION['config_sls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $example_phonetic = $row['example_phonetic'];
        if($example_phonetic == 1){
            $is_checked = "checked";
        }
        
    ?>
        <div class="checkbox dropdown-item">
            <input id="example_phonetic_sl<?php echo $index; ?>_display" type="checkbox" <?php echo $is_checked; ?>><label for="example_phonetic_sl<?php echo $index; ?>_display" style="padding-left:.3em;">Fonética [<?php echo $lang_code; ?>]</label>
        </div>
        <?php
    }


    foreach ($_SESSION['config_sls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $example_audio = $row['example_audio'];
        if($example_audio == 1){
            $is_checked = "checked";
        }
        
    ?>
        <div class="checkbox dropdown-item">
            <input id="example_audio_sl<?php echo $index; ?>_display" type="checkbox" <?php echo $is_checked; ?>><label for="example_audio_sl<?php echo $index; ?>_display" style="padding-left:.3em;">Áudio do Exemplo [<?php echo $lang_code; ?>]</label>
        </div>
        <?php
    }

    foreach ($_SESSION['config_tls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $translation = $row['example_translation'];
        if($translation == 1){
            $is_checked = "checked";
        }
            ?>
            <div class="checkbox dropdown-item">
                <input id="translation_tl<?php echo $index; ?>_display" type="checkbox" <?php echo $is_checked; ?>><label for="translation_tl<?php echo $index; ?>_display" style="padding-left:.3em;">Tradução [<?php echo $lang_code; ?>]</label>
            </div>
            <?php
    }

    ?>
        <div class="dropdown-divider"></div>                           
        <div class="dropdown-header"><small>Mídia</small></div>                           
        <?php
        
    
    foreach ($_SESSION['config_search_'.$dic_name]  as $key => $row){
        $is_checked = "";
        $image = $row['image'];
        if($image == 1){
            $is_checked = "checked";
        }
            ?>
            <div class="checkbox dropdown-item">
                <input id="image_display" type="checkbox" <?php echo $is_checked; ?>><label for="image_display" style="padding-left:.3em;">Imagem</label>
            </div>
            <?php
    }
    foreach ($_SESSION['config_search_'.$dic_name]  as $key => $row){
        $is_checked = "";
        $video = $row['video'];
        if($video == 1){
            $is_checked = "checked";
        }
            ?>
            <div class="checkbox dropdown-item">
                <input id="video_display" type="checkbox" <?php echo $is_checked; ?>><label for="video_display" style="padding-left:.3em;">Vídeo</label>
            </div>
            <?php
    }
    ?>
        <div class="dropdown-divider"></div>                           
        <div class="dropdown-header"><small>Código da língua</small></div>                           
        <div class="checkbox dropdown-item">
        <input id="lang_code_all_display" type="checkbox" ><label for="lang_code_all_display" style="padding-left:.3em;">Todos</label>
        </div>

        <?php

    foreach ($_SESSION['config_sls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $lang_code_display = $row['lang_code_display'];
        if($lang_code_display == 1){
            $is_checked = "checked";
        }
        
        ?>
        <div class="checkbox dropdown-item">
            <input id="sl<?php echo $index; ?>_code_display" type="checkbox" class="sl_code_display" <?php echo $is_checked; ?>><label for="sl<?php echo $index; ?>_code_display" style="padding-left:.3em;">[<?php echo $lang_code; ?>]</label>
        </div>
        <?php
    }

    foreach ($_SESSION['config_tls_'.$dic_name] as $row){
        $index = $row['index'];
        $lang_code = $row['lang_code'];
        $is_checked = "";
        $lang_code_display = $row['lang_code_display'];
        if($lang_code_display == 1){
            $is_checked = "checked";
        }
            ?>
            <div class="checkbox dropdown-item">
                <input id="tl<?php echo $index; ?>_code_display" type="checkbox" class="tl_code_display" <?php echo $is_checked; ?>><label for="tl<?php echo $index; ?>_code_display" style="padding-left:.3em;"> [<?php echo $lang_code; ?>]</label>
            </div>
            <?php


}

        ?>


