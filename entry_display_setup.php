<?php
include ("lang_check.php");


?>


                            
                              <div class="dropdown-header text-center">Mostrar Campos do Dicionário</div>                           
                            
                              <div class="dropdown-header"><small>Línguas</small></div>                           
                            
                                <div class="checkbox dropdown-item">
                                    <input id="all_sl1_display" type="checkbox" ><label for="all_sl1_display" style="padding-left:.3em;">Todos em <?php echo $lang_code_sl1; ?></label>
                                </div>
                            
                            <?php if(!empty($lang_code_sl2)){ ?>

                            
                                <div class="checkbox dropdown-item">
                                    <input id="all_sl2_display" type="checkbox" ><label for="all_sl2_display" style="padding-left:.3em;">Todos em <?php echo $lang_code_sl2; ?></label>
                                </div>
                            
                            <?php }else{} ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="all_tl1_display" type="checkbox"><label for="all_tl1_display" style="padding-left:.3em;">Todos em <?php echo $lang_code_tl1; ?></label>
                                </div>
                            
                            <?php if(!empty($lang_code_tl2)){ ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="all_tl2_display" type="checkbox"><label for="all_tl2_display" style="padding-left:.3em;">Todos em <?php echo $lang_code_tl2; ?></label>
                                </div>
                            
                            <?php }else{} ?>
                            
                              <div class="dropdown-divider"></div>                           
                            
                            
                              <div class="dropdown-header"><small>Forma</small></div>                           
                            
                            
                                <div class="checkbox dropdown-item">
                                    <input id="vernacular_sl1_display" type="checkbox" checked><label for="vernacular_sl1_display" style="padding-left:.3em;">Vernácula [<?php echo $lang_code_sl1; ?>]</label>
                                </div>
                            
                            <?php if(!empty($lang_code_sl2)){ ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="vernacular_sl2_display" type="checkbox" checked><label for="vernacular_sl2_display" style="padding-left:.3em;">Vernácula [<?php echo $lang_code_sl2; ?>]</label>
                                </div>
                            
                            <?php }else{} ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="phonemic_sl1_display" type="checkbox"><label for="phonemic_sl1_display" style="padding-left:.3em;">Fonêmica [<?php echo $lang_code_sl1; ?>]</label>
                                </div>
                            
                            <?php if(!empty($lang_code_sl2)){ ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="phonemic_sl2_display" type="checkbox"><label for="phonemic_sl2_display" style="padding-left:.3em;">Fonêmica [<?php echo $lang_code_sl2; ?>]</label>
                                </div>
                            
                            <?php }else{} ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="phonetic_sl1_display" type="checkbox" checked><label for="phonetic_sl1_display" style="padding-left:.3em;">Fonética [<?php echo $lang_code_sl1; ?>]</label>
                                </div>
                            
                            <?php if(!empty($lang_code_sl2)){ ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="phonetic_sl2_display" type="checkbox" checked><label for="phonetic_sl2_display" style="padding-left:.3em;">Fonética [<?php echo $lang_code_sl2; ?>]</label>
                                </div>
                            
                            <?php }else{} ?>
                            
                              <div class="dropdown-divider"></div>                           
                            
                            
                              <div class="dropdown-header"><small>Sentido</small></div>                           
                            
                            
                                <div class="checkbox dropdown-item">
                                    <input id="part_of_speech_tl1_display" type="checkbox" checked><label for="part_of_speech_tl1_display" style="padding-left:.3em;">Classe de palavra [<?php echo $lang_code_tl1; ?>]</label>
                                </div>
                            
                            <?php if(!empty($lang_code_tl2)){ ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="part_of_speech_tl2_display" type="checkbox"><label for="part_of_speech_tl2_display" style="padding-left:.3em;">Classe de palavra [<?php echo $lang_code_tl2; ?>]</label>
                                </div>
                            
                            <?php }else{} ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="gloss_tl1_display" type="checkbox" checked><label for="gloss_tl1_display" style="padding-left:.3em;">Glosa [<?php echo $lang_code_tl1; ?>]</label>
                                </div>
                            
                            <?php if(!empty($lang_code_tl2)){ ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="gloss_tl2_display" type="checkbox"><label for="gloss_tl2_display" style="padding-left:.3em;">Glosa [<?php echo $lang_code_tl2; ?>]</label>
                                </div>
                            
                            <?php }else{} ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="def_tl1_display" type="checkbox"><label for="def_tl1_display" style="padding-left:.3em;">Definição [<?php echo $lang_code_tl1; ?>]</label>
                                </div>
                            
                            <?php if(!empty($lang_code_tl2)){ ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="def_tl2_display" type="checkbox"><label for="def_tl2_display" style="padding-left:.3em;">Definição [<?php echo $lang_code_tl2; ?>]</label>
                                </div>
                            
                            <?php }else{} ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="sd_display" type="checkbox" checked><label for="sd_display" style="padding-left:.3em;">Campos Semântico</label>
                                </div>
                            
                            
                                <div class="checkbox dropdown-item">
                                    <input id="scn_display" type="checkbox" checked><label for="scn_display" style="padding-left:.3em;">Nome científico</label>
                                </div>
                            
                            
                              <div class="dropdown-divider"></div>                           
                            
                            
                              <div class="dropdown-header"><small>Exemplo</small></div>                           
                            
                            
                                <div class="checkbox dropdown-item">
                                    <input id="example_sl1_display" type="checkbox" checked><label for="example_sl1_display"` style="padding-left:.3em;">Vernáculo [<?php echo $lang_code_sl1; ?>]</label>
                                </div>
                            
                            <?php if(!empty($lang_code_sl2)){ ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="example_sl2_display" type="checkbox" checked><label for="example_sl2_display" style="padding-left:.3em;">Vernáculo [<?php echo $lang_code_sl2; ?>]</label>
                                </div>
                            
                            <?php }else{} ?>
                            
                                <div class="checkbox dropdown-item">
                                    <input id="translation_tl1_display" type="checkbox" checked><label for="translation_tl_display" style="padding-left:.3em;">Tradução [<?php echo $lang_code_tl1; ?>]</label>
                                </div>
                            
                            <?php if(!empty($lang_code_tl2)){ ?>
                            
                                <div class="checkbox dropdown-item">
                                <input id="translation_tl2_display" type="checkbox"><label for="translation_tl2_display" style="padding-left:.3em;">Tradução [<?php echo $lang_code_tl2; ?>]</label>
                                </div>
                            
                            <?php }else{} ?>
                            
                              <div class="dropdown-divider"></div>                           
                            
                            
                              <div class="dropdown-header"><small>Mídia</small></div>                           
                            
                            
                                <div class="checkbox dropdown-item">
                                <input id="image_display" type="checkbox" checked><label for="image_display" style="padding-left:.3em;">Imagem</label>
                                </div>
                            
                            
                                <div class="checkbox dropdown-item">
                                <input id="video_display" type="checkbox" checked><label for="video_display" style="padding-left:.3em;">Vídeo</label>
                                </div>

                                <div class="dropdown-divider"></div>                           

                                <div class="dropdown-header"><small>Código da língua</small></div>                           
     
                                <div class="checkbox dropdown-item">
                                <input id="lang_code_all_display" type="checkbox" ><label for="lang_code_all_display" style="padding-left:.3em;">Em todas as línguas</label>
                                </div>
                                <div class="checkbox dropdown-item">
                                <input id="sl1_code_display" type="checkbox" ><label for="sl1_code_display" style="padding-left:.3em;">Em <?php echo $native_name_sl1; ?>&nbsp;[<?php echo $lang_code_sl1; ?>]</label>
                                </div>
                                <?php if(!empty($lang_code_sl2)){ ?>

                                <div class="checkbox dropdown-item">
                                <input id="sl2_code_display" type="checkbox" checked><label for="sl2_code_display" style="padding-left:.3em;">Em <?php echo $native_name_sl2; ?>&nbsp;[<?php echo $lang_code_sl2; ?>]</label>
                                </div>
                                <?php
                                }else{} 

                                ?>
                                <div class="checkbox dropdown-item">
                                <input id="tl1_code_display" type="checkbox" ><label for="tl1_code_display" style="padding-left:.3em;">Em <?php echo $native_name_tl1; ?>&nbsp;[<?php echo $lang_code_tl1; ?>]</label>
                                </div>
                                <?php if(!empty($lang_code_tl2)){ ?>
                                <div class="checkbox dropdown-item">
                                <input id="tl2_code_display" type="checkbox" ><label for="tl2_code_display" style="padding-left:.3em;">Em <?php echo $native_name_tl2; ?>&nbsp;[<?php echo $lang_code_tl2; ?>]</label>
                                </div>
                                <?php
                                }else{} 

                                ?>

                      <script >
                      
                    </script>