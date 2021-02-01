<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  include ("config_session.php");

$dic_name = "";

include ("connection.php");









//START // function form_bundle_output //START
function form_bundle_output_xml ($entry_id, $entry_node, $dom){
    $dic_name = "";
    include ("connection.php");    
    //START //form bundles //START
    try {

    $result = $link->query("SELECT * FROM form_bundles WHERE entry_id  = '$entry_id'");

    if($result->rowCount()>0){
        
        foreach ($result as $key => $row){    

        $form_bundle_id=$row["form_bundle_id"];
        $source_langs_info = $_SESSION['config_sls_'.$dic_name];


        foreach ($source_langs_info as $source_lang_info){
            ?>


            <?php
            $source_lang = $source_lang_info['source_lang'];
            $lang_code = $source_lang_info['lang_code'];
            




            $form_bundle_node = $dom->createElement('form_bundle');

            $attr_form_bundle_id = new DOMAttr('id', $form_bundle_id);
            $form_bundle_node->setAttributeNode($attr_form_bundle_id);
            
            $entry_node->appendChild($form_bundle_node);

            vernacular_xml($form_bundle_id, $source_lang, $lang_code, $form_bundle_node, $dom);



        } // foreach
        
        

        } // foreach   
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
//END //form bundles //END
}
//END // function form_bundle_output //END

//START // function vernacular //START
function vernacular_xml($form_bundle_id, $source_lang, $lang_code, $form_bundle_node, $dom){
    $dic_name = "";
    include ("connection.php");  
    //START //forms //START
    try {

    $result = $link->query("SELECT * FROM forms WHERE form_bundle_id  = '$form_bundle_id' AND lang_code = '$lang_code' ORDER BY form_id");



    if($result->rowCount()>0){
        
        foreach ($result as $key => $row){    
            $form_id=$row["form_id"];
            $vernacular= $row["vernacular"];
        
        



            $form_node = $dom->createElement('form');

            $attr_id = new DOMAttr('id', $form_id);
            $form_node->setAttributeNode($attr_id);
            $attr_lang = new DOMAttr('lang', $lang_code);
            $form_node->setAttributeNode($attr_lang);
            $attr_sl = new DOMAttr('sl', $source_lang);
            $form_node->setAttributeNode($attr_sl);

            $form_bundle_node->appendChild($form_node);      


            $vernacular_node = $dom->createElement('vernacular', $vernacular);

            $attr_vernacular_lang = new DOMAttr('lang', $lang_code);
            $vernacular_node->setAttributeNode($attr_vernacular_lang);
            
            $form_node->appendChild($vernacular_node);      



            
            phonemic_xml($form_id, $lang_code, $source_lang, $form_node, $dom);
        
            ?>  
        <?php

        } // foreach   
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try    
    //END //forms //END      
}
//END // function vernacular // END //


//START // function phonemic_output //START
function phonemic_xml($form_id, $lang_code, $source_lang, $form_node, $dom){
    $dic_name = "";
    include ("connection.php");
    //START //phonemic //START
    try {

    $result = $link->query("SELECT * FROM phonemic WHERE form_id = '$form_id' ORDER BY phonemic_id");

    if($result->rowCount()>0){
    
        foreach ($result as $key => $row){    
            $phonemic_id=$row["phonemic_id"];
            $phonemic=$row["phonemic"];





            $phonemics_node = $dom->createElement('phonemics');

            $attr_id = new DOMAttr('id', $phonemic_id);
            $phonemics_node->setAttributeNode($attr_id);
            $attr_lang = new DOMAttr('lang', $lang_code);
            $phonemics_node->setAttributeNode($attr_lang);
            $attr_sl = new DOMAttr('sl', $source_lang);
            $phonemics_node->setAttributeNode($attr_sl);


            $form_node->appendChild($phonemics_node);      





            $phonemic_node = $dom->createElement('phonemic', $phonemic);

            $attr_id = new DOMAttr('id', $phonemic_id);
            $phonemic_node->setAttributeNode($attr_id);
            $attr_lang = new DOMAttr('lang', $lang_code);
            $phonemic_node->setAttributeNode($attr_lang);
            $attr_sl = new DOMAttr('sl', $source_lang);
            $phonemic_node->setAttributeNode($attr_sl);

            
            $phonemics_node->appendChild($phonemic_node);      






            phonetic_xml($phonemic_id, $lang_code, $source_lang, $phonemics_node, $dom);

        ?>
        <?php
        } // foreach   
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try    
    //END //phonemic //END   
}
//END // function phonemic // END //

function phonetic_xml($phonemic_id, $lang_code, $source_lang, $phonemics_node, $dom){
  $dic_name = "";
    include ("connection.php");
    //START // phonetic //START
    try {

    $result = $link->query("SELECT * FROM phonetic WHERE phonemic_id = '$phonemic_id' ORDER BY phonetic_id");

    if($result->rowCount()>0){

    
    foreach ($result as $key => $row){    
        $phonetic_id=$row["phonetic_id"];
        $phonetic= $row["phonetic"];


        $phonetics_node = $dom->createElement('phonetics');

        $attr_id = new DOMAttr('id', $phonetic_id);
        $phonetics_node->setAttributeNode($attr_id);
        $attr_lang = new DOMAttr('lang', $lang_code);
        $phonetics_node->setAttributeNode($attr_lang);
        $attr_sl = new DOMAttr('sl', $source_lang);
        $phonetics_node->setAttributeNode($attr_sl);
        
        
        $phonemics_node->appendChild($phonetics_node);      
        

        $phonetic_node = $dom->createElement('phonetic', $phonetic);

            $attr_id = new DOMAttr('id', $phonetic_id);
            $phonetic_node->setAttributeNode($attr_id);
            $attr_lang = new DOMAttr('lang', $lang_code);
            $phonetic_node->setAttributeNode($attr_lang);
            $attr_sl = new DOMAttr('sl', $source_lang);
            $phonetic_node->setAttributeNode($attr_sl);

            
            $phonetics_node->appendChild($phonetic_node);      



        prons_xml($phonetic_id, $source_lang, $lang_code, $phonetics_node, $dom);

            ?>

        </div>
        <?php
    } // foreach   
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try    
    //END //phonetic //END  
}
//END // function phonetic // END//

//START // function prons //START
function prons_xml($phonetic_id, $source_lang, $lang_code, $phonetics_node, $dom){
    $dic_name = "";
    include ("connection.php");
    //START // prons //START
    try {
    $result = $link->query("SELECT * FROM prons WHERE phonetic_id = '$phonetic_id' ORDER BY pron_id");
    if($result->rowCount()>0){
        
        foreach ($result as $key => $row){
        $entry_ref =$row["entry_ref"];    
        $lang_code=$row["lang_code"];
        $pron_id=$row["pron_id"];
        $wav=$row["wav"];
        $mp3=$row["mp3"];
        $mp4=$row["mp4"];
        $wma=$row["wma"];



        $prons_node = $dom->createElement('prons');

        $attr_id = new DOMAttr('id', $pron_id);
        $prons_node->setAttributeNode($attr_id);
        $attr_lang = new DOMAttr('lang', $lang_code);
        $prons_node->setAttributeNode($attr_lang);
        $attr_sl = new DOMAttr('sl', $source_lang);
        $prons_node->setAttributeNode($attr_sl);
        
        
        $phonetics_node->appendChild($prons_node);      
        
        
        $pron_node = $dom->createElement('pron', $wav);
        
            $attr_id = new DOMAttr('id', $pron_id);
            $pron_node->setAttributeNode($attr_id);
            $attr_lang = new DOMAttr('lang', $lang_code);
            $pron_node->setAttributeNode($attr_lang);
            $attr_sl = new DOMAttr('sl', $source_lang);
            $pron_node->setAttributeNode($attr_sl);
        
            
            $prons_node->appendChild($pron_node);      
        
        



            //prons_meta_xml($pron_id, $lang_code, $source_lang);

        } // foreach   
        }else{

            //echo "A busca não retornou nenhum resultado.";
    } // if



    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br> 438?".$e->getMessage();

} // try    
    //END //prons //END 
}
//END // function prons // END//



function prons_meta_xml($pron_id, $lang_code, $source_lang){
    $dic_name = "";
    include ("connection.php");

    try {
    $result = $link->query("SELECT * FROM prons_meta WHERE pron_id = '$pron_id'");
    if($result->rowCount()>0){
        
    foreach ($result as $key => $row){
        $lang_code=$row["lang_code"];
        $pron_meta_id=$row["pron_meta_id"];
        $file_name=$row["file_name"];
        $collector=$row["collector"];
        $speaker=$row["speaker"];
        $rec_date=$row["rec_date"];
        $rec_place=$row["rec_place"];
        $description=$row["description"];


        } // foreach   
        }else{

            //echo "A busca não retornou nenhum resultado.";
    } // if



    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br> 438?".$e->getMessage();
    } // try    



}
//END // PART 1 - FORM // END//






// START // PART 2 - SENSE //START
// START //sense_bundle_output function //START
function sense_bundle_output_xml ($entry_id, $entry_node, $dom){
    $dic_name = "";
    include ("connection.php");
    //START //sense bundles //START
    try {

    $result = $link->query("SELECT * FROM sense_bundles WHERE entry_id  = '$entry_id'");

    if($result->rowCount()>0){
        
        foreach ($result as $key => $row){    
        $sense_bundle_id=$row["sense_bundle_id"];
        $target_langs_info = $_SESSION['config_tls_'.$dic_name];
        $source_langs_info = $_SESSION['config_sls_'.$dic_name];








        $sense_bundle_node = $dom->createElement('sense_bundle');

        $attr_sense_bundle_id = new DOMAttr('id', $sense_bundle_id);
        $sense_bundle_node->setAttributeNode($attr_sense_bundle_id);
        
        $entry_node->appendChild($sense_bundle_node);





        foreach ($target_langs_info as $target_lang_info){
        
            $target_lang = $target_lang_info['target_lang'];
            $lang_code = $target_lang_info['lang_code'];
            senses_xml ($sense_bundle_id, $target_lang, $lang_code, $sense_bundle_node, $dom);
            glosses_xml($sense_bundle_id, $target_lang, $lang_code, $sense_bundle_node, $dom);
            classes_xml($sense_bundle_id, $target_lang, $lang_code, $sense_bundle_node, $dom);
            sds_xml ($sense_bundle_id, $target_lang, $lang_code, $sense_bundle_node, $dom);
            
        
        }//foreach

        

            scns_xml ($sense_bundle_id, $sense_bundle_node, $dom);
            example_bundle_output_xml($sense_bundle_id, $sense_bundle_node, $dom);
            //images_xml($sense_bundle_id, $sense_bundle_node, $dom);
            //videos_xml($sense_bundle_id, $sense_bundle_node, $dom);


            


        foreach ($target_langs_info as $target_lang_info){
        
            $target_lang = $target_lang_info['target_lang'];
            $lang_code = $target_lang_info['lang_code'];
            //comments_tls_xml ($sense_bundle_id, $target_lang, $lang_code, $sense_bundle_node, $dom);
            
        
        }//foreach

        foreach ($source_langs_info as $source_lang_info){      
            $source_lang = $source_lang_info['source_lang'];
            $lang_code = $source_lang_info['lang_code'];
            //comments_sls_xml ($sense_bundle_id, $source_lang, $lang_code, $sense_bundle_node, $dom);
        }// foreach 






        } // foreach   
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END // sense bundles //END
}  
//END // sense bundles function //END

// START //senses function //START
function senses_xml ($sense_bundle_id, $target_lang, $lang_code, $sense_bundle_node, $dom){
    $dic_name = "";
    include ("connection.php");
    //START //senses //START
    try {

    $result = $link->query("SELECT * FROM senses WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY sense_id");

    if($result->rowCount()>0){

                
                foreach ($result as $key => $row){    
                $sense_id=$row["sense_id"];
                $def= $row["def"];
                

        $sense_node = $dom->createElement('sense', $def);

        $attr_sense_id = new DOMAttr('id', $sense_id);
        $sense_node->setAttributeNode($attr_sense_id);
        $attr_sense_lang = new DOMAttr('lang', $lang_code);
        $sense_node->setAttributeNode($attr_sense_lang);
        $attr_sense_sl = new DOMAttr('tl', $target_lang);
        $sense_node->setAttributeNode($attr_sense_sl);

        
        $sense_bundle_node->appendChild($sense_node);
            } // foreach

            }else{
            //echo "A busca não retornou nenhum resultado.";
            } // if

        
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //senses //END

}
//END // sense function // END

//START // glosses function // START
function glosses_xml($sense_bundle_id, $target_lang, $lang_code, $sense_bundle_node, $dom){
    $dic_name = "";
    include ("connection.php");
    //START //glosses //START
    try {

    $result = $link->query("SELECT * FROM glosses WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY gloss_order");

    if($result->rowCount()>0){
        foreach ($result as $key => $row){    
        $gloss_id=$row["gloss_id"];        
        $gloss= $row["gloss"];

        $gloss_node = $dom->createElement('gloss', $gloss);

        $attr_gloss_id = new DOMAttr('id', $gloss_id);
        $gloss_node->setAttributeNode($attr_gloss_id);
        $attr_gloss_lang = new DOMAttr('lang', $lang_code);
        $gloss_node->setAttributeNode($attr_gloss_lang);
        $attr_gloss_sl = new DOMAttr('tl', $target_lang);
        $gloss_node->setAttributeNode($attr_gloss_sl);

        
        $sense_bundle_node->appendChild($gloss_node);


        } // foreach

    

    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if

    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //glosses //END
    }
    //END // glosses function // END

    //START // classes function //START
    function classes_xml ($sense_bundle_id, $target_lang, $lang_code, $sense_bundle_node, $dom){
        $dic_name = "";
    include ("connection.php");
    //START //classes //START

    try {

    $result = $link->query("SELECT * FROM classes WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY class_id");

    if($result->rowCount()>0){
        $class_id="";


        foreach ($result as $key => $row){    
        $class_id=$row["class_id"];
        $class_name="";
        $class_token_id=$row["class_token_id"];

        try {
            $result = $link->query("SELECT * FROM class_names WHERE class_id  = '$class_id' AND lang_code = '$lang_code'");
            
                if($result->rowCount()>0){
        
                    foreach ($result as $row){
                    $class_name_id=$row["class_name_id"];
                    $class_name=$row["class_name"];
                    
                    


                    $class_node = $dom->createElement('class', $class_name);

                    $attr_class_id = new DOMAttr('class_id', $class_id);
                    $class_node->setAttributeNode($attr_class_id);
                    $attr_class_token_id = new DOMAttr('id', $class_token_id);
                    $class_node->setAttributeNode($attr_class_token_id);
                    $attr_class_name_id = new DOMAttr('name_id', $class_name_id);
                    $class_node->setAttributeNode($attr_class_name_id);
                    $attr_class_lang = new DOMAttr('lang', $lang_code);
                    $class_node->setAttributeNode($attr_class_lang);
                    $attr_class_sl = new DOMAttr('tl', $target_lang);
                    $class_node->setAttributeNode($attr_class_sl);
                    
                    
                    $sense_bundle_node->appendChild($class_node);
                    

                    } // foreach      
            
                    }else{
                    //echo "A busca não retornou nenhum resultado.";
                } // if
        
                    
            } catch(PDOException $e){
                echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
            } // try

            } // foreach

    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //classes //END
}
//END // classes function // END

//START //scns function //START
function scns_xml ($sense_bundle_id, $sense_bundle_node, $dom){
    $dic_name = "";
    include ("connection.php");
    //START //scn //START
    try {

    $result = $link->query("SELECT * FROM scns WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY scn_order");

    if($result->rowCount()>0){
        ?>
        <div id="scn_bundle" class="scn">
        <?php              

        foreach ($result as $key => $row){
        $scn_id=$row["scn_id"];              
        $scn= $row["scn"];
        $lang_code= $row["lang_code"];
        


        $scn_node = $dom->createElement('scn', $scn);

        $attr_scn_id = new DOMAttr('id', $scn_id);
        $scn_node->setAttributeNode($attr_scn_id);
        $attr_scn_lang = new DOMAttr('lang', $lang_code);
        $scn_node->setAttributeNode($attr_scn_lang);
        $attr_scn_sl = new DOMAttr('tl', $target_lang);
        $scn_node->setAttributeNode($attr_scn_sl);
        
        
        $sense_bundle_node->appendChild($scn_node);
        




        } // foreach

    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //scns //END
}  
//END //scns function//END

    // START //sds function //START
function sds_xml ($sense_bundle_id, $target_lang, $lang_code, $sense_bundle_node, $dom){
        $dic_name = "";
    include ("connection.php");

    //START //sds //START
    try {

    $result = $link->query("SELECT * FROM sds WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY sd_id");
    
    if($result->rowCount()>0){

        
        foreach ($result as $key => $row){    
        
        $sd_id=$row["sd_id"];
        $sd_token_id = $row["sd_token_id"];

        try {
            $result = $link->query("SELECT * FROM sd_names WHERE sd_id  = '$sd_id' AND lang_code = '$lang_code'");
            
                if($result->rowCount()>0){
        
                    foreach ($result as $row){
        
                    $sd_name_id=$row["sd_name_id"];
                    $sd_name=$row["sd_name"];
                    



                    $sd_node = $dom->createElement('sd', $sd_name);

                    $attr_sd_id = new DOMAttr('sd_id', $sd_id);
                    $sd_node->setAttributeNode($attr_sd_id);
                    $attr_sd_token_id = new DOMAttr('id', $sd_token_id);
                    $sd_node->setAttributeNode($attr_sd_token_id);
                    $attr_sd_name_id = new DOMAttr('name_id', $sd_name_id);
                    $sd_node->setAttributeNode($attr_sd_name_id);
                    $attr_sd_lang = new DOMAttr('lang', $lang_code);
                    $sd_node->setAttributeNode($attr_sd_lang);
                    $attr_sd_sl = new DOMAttr('tl', $target_lang);
                    $sd_node->setAttributeNode($attr_sd_sl);
                    
                    
                    $sense_bundle_node->appendChild($sd_node);
                    


                } // foreach     
            
                    }else{
                    //echo "A busca não retornou nenhum resultado.";
                } // if
        
                    
            } catch(PDOException $e){
                echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
            } // try
            } // foreach

    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //sds //END
}
//END // sds function // END

//START //example_bundle_output function  //START
function example_bundle_output_xml ($sense_bundle_id, $sense_bundle_node, $dom){
    $dic_name = "";
    include ("connection.php");
    //START //example_bundles //START
    try {

    $result = $link->query("SELECT * FROM example_bundles WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY example_bundle_id");

    if($result->rowCount()>0){
        foreach ($result as $key => $row){
        $example_bundle_id=$row["example_bundle_id"];





        




        $example_bundle_node = $dom->createElement('example_bundle');

        $attr_example_bundle_id = new DOMAttr('id', $example_bundle_id);
        $example_bundle_node->setAttributeNode($attr_example_bundle_id);


        $sense_bundle_node->appendChild($example_bundle_node);




        
        $source_langs_info = $_SESSION['config_sls_'.$dic_name];
        foreach($source_langs_info as $source_lang_info){

            $source_lang = $source_lang_info['source_lang']; 
            $lang_code = $source_lang_info['lang_code']; 
 
        
            example_vernacular_xml($example_bundle_id, $lang_code, $source_lang, $example_bundle_node, $dom);

        }//foreach

        
            $target_langs_info = $_SESSION['config_tls_'.$dic_name];
            foreach($target_langs_info as $target_lang_info){
                $index = $target_lang_info['index'];
                $target_lang = $target_lang_info['target_lang']; 
                $lang_code = $target_lang_info['lang_code'];
                example_translation_xml($example_bundle_id, $lang_code, $target_lang, $example_bundle_node, $dom);
            
            }



        } // foreach

        
        }else{
            //echo "A busca não retornou nenhum resultado.";
        } // if
    } catch(PDOException $e){
        echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try      
    //END //example_bundles //END
}
//END //example_bundle_output function//END

//START //example_vernacular function  //START
function example_vernacular_xml ($example_bundle_id, $lang_code, $source_lang, $example_bundle_node, $dom){
    $dic_name = "";
    include ("connection.php");
    //START //examples //START
    try {

    $result = $link->query("SELECT * FROM examples WHERE example_bundle_id  = '$example_bundle_id' AND lang_code='$lang_code' ORDER BY example_id");

    if($result->rowCount()>0){
        foreach ($result as $key => $row){
        $example_id=$row["example_id"];                    
        $ex_vernacular=$row["vernacular"];





        $example_node = $dom->createElement('example');

        $attr_example_id = new DOMAttr('id', $example_id);
        $example_node->setAttributeNode($attr_example_id);
        $attr_example_lang = new DOMAttr('lang', $lang_code);
        $example_node->setAttributeNode($attr_example_lang);
        $attr_example_sl = new DOMAttr('sl', $source_lang);
        $example_node->setAttributeNode($attr_example_sl);

        $example_bundle_node->appendChild($example_node);

        $example_vernacular_node = $dom->createElement('example_vernacular', $ex_vernacular);

        $attr_example_vernacular_id = new DOMAttr('id', $example_id);
        $example_vernacular_node->setAttributeNode($attr_example_vernacular_id);
        $attr_example_vernacular_lang = new DOMAttr('lang', $lang_code);
        $example_vernacular_node->setAttributeNode($attr_example_vernacular_lang);
        $attr_example_vernacular_sl = new DOMAttr('sl', $source_lang);
        $example_vernacular_node->setAttributeNode($attr_example_vernacular_sl);

        $example_node->appendChild($example_vernacular_node);






        //example_phonetic_xml($example_id, $lang_code, $source_lang, $example_node, $dom);



        example_prons_xml($example_id, $lang_code, $source_lang, $example_node, $dom);

    
        } // foreach     
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //examples //END
}
//END //example_vernacular function//END



//START //example_prons function  //START

function example_prons_xml($example_id, $lang_code, $source_lang, $example_node, $dom){
  $dic_name = "";
    include ("connection.php");
    //START //example_prons //START
    try {

    $result = $link->query("SELECT * FROM example_prons WHERE example_id  = '$example_id' ORDER BY example_id");

    if($result->rowCount()>0){
    foreach ($result as $key => $row){
        $example_pron_id=$row["example_pron_id"];                    
        $ex_phonetic=$row["phonetic"];                    
        $wav=$row["wav"];
        $mp3=$row["mp3"];
        $mp4=$row["mp4"];
        $wma=$row["wma"];

    


        $example_prons_node = $dom->createElement('example_prons');

        $attr_example_prons_id = new DOMAttr('id', $example_pron_id);
        $example_prons_node->setAttributeNode($attr_example_prons_id);
        $attr_example_prons_lang = new DOMAttr('lang', $lang_code);
        $example_prons_node->setAttributeNode($attr_example_prons_lang);
        $attr_example_prons_sl = new DOMAttr('sl', $source_lang);
        $example_prons_node->setAttributeNode($attr_example_prons_sl);
        
        $example_node->appendChild($example_prons_node);
        
        


        $example_phonetic_node = $dom->createElement('example_phonetic', $ex_phonetic);
    
        $attr_example_phonetic_id = new DOMAttr('example_phonetic_id', $example_pron_id);
        $example_phonetic_node->setAttributeNode($attr_example_phonetic_id);
        $attr_example_phonetic_lang = new DOMAttr('lang', $lang_code);
        $example_phonetic_node->setAttributeNode($attr_example_phonetic_lang);
        $attr_example_phonetic_sl = new DOMAttr('sl', $source_lang);
        $example_phonetic_node->setAttributeNode($attr_example_phonetic_sl);
        
        $example_prons_node->appendChild($example_phonetic_node);
        





        
        $example_pron_node = $dom->createElement('example_pron', $wav);

        $attr_example_pron_id = new DOMAttr('id', $example_pron_id);
        $example_pron_node->setAttributeNode($attr_example_pron_id);
        $attr_example_pron_lang = new DOMAttr('lang', $lang_code);
        $example_pron_node->setAttributeNode($attr_example_pron_lang);
        $attr_example_pron_sl = new DOMAttr('sl', $source_lang);
        $example_pron_node->setAttributeNode($attr_example_pron_sl);
        
        $example_prons_node->appendChild($example_pron_node);
        
        

        
    //example_prons_meta_xml($example_pron_id, $lang_code, $source_lang, $mode);





    }// foreach

    }//if

    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try

}


function example_prons_meta_xml($example_pron_id, $lang_code, $source_lang, $mode){
    $dic_name = "";
    include ("connection.php");

    try {
    $result = $link->query("SELECT * FROM example_prons_meta WHERE example_pron_id = '$example_pron_id'");
    if($result->rowCount()>0){
        
    foreach ($result as $key => $row){
        $lang_code=$row["lang_code"];
        $example_pron_meta_id=$row["pron_meta_id"];
        $file_name=$row["file_name"];
        $collector=$row["collector"];
        $speaker=$row["speaker"];
        $rec_date=$row["rec_date"];
        $rec_place=$row["rec_place"];
        $description=$row["description"];

     



        } // foreach   
        }else{

            //echo "A busca não retornou nenhum resultado.";
    } // if



    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br> 438?".$e->getMessage();
    } // try    



}



function example_phonetic_xml($example_id, $lang_code, $source_lang, $example_node, $dom){
    $dic_name = "";
    include ("connection.php");
    //START //example_prons //START
    try {

    $result = $link->query("SELECT * FROM example_prons WHERE example_id  = '$example_id' ORDER BY example_id");

    if($result->rowCount()>0){
    foreach ($result as $key => $row){
    $example_pron_id=$row["example_pron_id"];                    
    $ex_phonetic=$row["phonetic"];                    
    $wav=$row["wav"];
    $mp3=$row["mp3"];
    $mp4=$row["mp4"];
    $wma=$row["wma"];


    $example_phonetic_node = $dom->createElement('example_phonetic', $ex_phonetic);

    $attr_example_phonetic_id = new DOMAttr('id', $example_pron_id);
    $example_phonetic_node->setAttributeNode($attr_example_phonetic_id);
    $attr_example_phonetic_lang = new DOMAttr('lang', $lang_code);
    $example_phonetic_node->setAttributeNode($attr_example_phonetic_lang);
    $attr_example_phonetic_sl = new DOMAttr('sl', $source_lang);
    $example_phonetic_node->setAttributeNode($attr_example_phonetic_sl);
    
    $example_node->appendChild($example_phonetic_node);
    



    }// foreach

    }//if

    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try

}


//START //example_translation function  //START
function example_translation_xml ($example_bundle_id, $lang_code, $target_lang, $example_bundle_node, $dom){
    $dic_name = "";
    include ("connection.php");
    //START //translations //START
    try {

    $result = $link->query("SELECT * FROM translations WHERE example_bundle_id  = '$example_bundle_id' AND lang_code='$lang_code' ORDER BY translation_id");

    if($result->rowCount()>0){
        foreach ($result as $key => $row){
        $translation_id=$row["translation_id"];                   
        $translation=$row["translation"];



        $example_translation_node = $dom->createElement('example_translation', $translation);

        $attr_example_translation_id = new DOMAttr('id', $translation_id);
        $example_translation_node->setAttributeNode($attr_example_translation_id);
        $attr_example_translation_lang = new DOMAttr('lang', $lang_code);
        $example_translation_node->setAttributeNode($attr_example_translation_lang);
        $attr_example_translation_tl = new DOMAttr('tl', $target_lang);
        $example_translation_node->setAttributeNode($attr_example_translation_tl);

        $example_bundle_node->appendChild($example_translation_node);



           } // foreach

    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //translations //END
}
//END //example_tranlation function//END

//START //images function //START
function images_xml ($sense_bundle_id, $sense_bundle_node, $dom){
    $dic_name = "";
    include ("connection.php");
    //START //images //START
    try {

    $result = $link->query("SELECT * FROM images WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY image_id");

    if($result->rowCount()>0){
        ?>  
        <div id="image_panel" class="image pb-1">
        <div id="image_panel_<?php echo $sense_bundle_id ?>" class="d-flex justify-content-around p-0 bd-highlight image_panel">
        <?php                  
        foreach ($result as $key => $row){
        $image_id=$row["image_id"];                          
        $jpg= $row["jpg"];

            ?>
            <a class="image-popup-vertical-fit" href="assets/image/<?php echo $jpg;?>" title="">
            <img src="assets/image/<?php echo $jpg;?>" id="image_<?php echo $image_id; ?>" class="img rounded" width="200" height="auto" alt="...">
            </a>

            <div id="image_caption_panel_<?php echo $image_id ?>" class="d-flex p-0 bd-highlight image_caption_panel">

            <?php
            
            image_captions_xml($image_id);

            ?>
        
            </div>
            <?php  
        

        } // foreach
            ?>
        </div>

        </div>
        <?php  
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //images //END
}
//END //images function//END



function image_captions_xml ($image_id){
  $dic_name = "";
    include ("connection.php");
    //START //image_captions //START

    ?>  
    <?php     

    $source_langs_info = $_SESSION['config_sls_'.$dic_name];

    foreach ($source_langs_info as $source_lang_info){
    ?>

    <?php
    $source_lang = $source_lang_info['source_lang'];
    $lang_code = $source_lang_info['lang_code'];
    try {

    $result = $link->query("SELECT * FROM image_captions WHERE image_id  = '$image_id' AND lang_code = '$lang_code'");
                

    if($result->rowCount()>0){
        foreach ($result as $key => $row){
        $image_caption_id=$row["image_caption_id"];                          
        $image_caption=$row["image_caption"];                          
        
            ?>
            <a class="image_caption" title=""><?php echo $image_caption;?></a>
            <?php
    
        } // foreach
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if

    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try

    } // foreach   



    ?>  
    <?php     

    $target_langs_info = $_SESSION['config_tls_'.$dic_name];

    foreach ($target_langs_info as $target_lang_info){
    ?>

    <?php
    $target_lang = $target_lang_info['target_lang'];
    $lang_code = $target_lang_info['lang_code'];
    try {

    $result = $link->query("SELECT * FROM image_captions WHERE image_id  = '$image_id' AND lang_code = '$lang_code'");
                

    if($result->rowCount()>0){
        foreach ($result as $key => $row){
        $image_caption_id=$row["image_caption_id"];                          
        $image_caption=$row["image_caption"];                          
        
            ?>
            <a class="image_caption" title=""><?php echo $image_caption;?></a>
            <?php
    
        } // foreach
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if

    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try

    } // foreach   

    //END //image_captions //END
}
//END //images function//END


//START //videos function //START
function videos_xml ($sense_bundle_id, $sense_bundle_node, $dom){
    $dic_name = "";
    include ("connection.php");
    //START //videos //START
    try {

    $result = $link->query("SELECT * FROM videos WHERE sense_bundle_id  = '$sense_bundle_id' ORDER BY video_id");
    ?>

    <div  class="d-flex justify-content-around">

    <?php

    if($result->rowCount()>0){
        foreach ($result as $key => $row){
        $video_id=$row["video_id"];
        $ogv= $row["ogv"];        
        $mp4= $row["mp4"];        
            ?>
            <button id="video_btn_<?php echo $video_id;?>" type="button"  video="assets/video/<?php echo $mp4;?>" class='btn btn-default btn-sm d-inline-flex p-0 btn_video'>
        <span class="material-icons md-18">movie</span>
    </button>
            <video
                id="video_player_<?php echo $video_id;?>"
                class="video-js vjs-big-play-centered vjs-hidden"
                controls
                preload="auto"
                width="0"
                height="0"
                poster=""
                data-setup="{}"
                
                
                
            >

                <source src="assets/video/<?php echo $mp4;?>" />
    <!--                <source src="assets/video/<?php echo "$ogv";?>" type="video/ogv" />-->
                <p class="vjs-no-js">
                To view this video please enable JavaScript, and consider upgrading to a
                web browser that
                <a href="https://videojs.com/html5-video-support/" target="_blank"
                    >supports HTML5 video</a>
                </p>
            </video>
    <script type="text/javascript">

        $(document).on('fullscreenchange', function()      {

        var is_full = document.fullscreenElement;
        if(is_full === null ){
            console.log('Element: exited fullscreen mode.');
            $('.video-js').addClass('vjs-hidden');
            $('video').each(function() {
                $(this).get(0).pause();
            });
        }else{
            console.log('Element: entered fullscreen mode.');
        }
            
    });
        
        $('#video_btn_<?php echo $video_id;?>').click(function(e) {
            e.preventDefault();
            //$('#video_player_<?php echo $video_id;?>').removeAttr('hidden');
            var video_player = videojs('video_player_<?php echo $video_id;?>');
            video_player.play(); 
            
            $('#video_player_<?php echo $video_id;?> .vjs-fullscreen-control').click();
            $('#video_player_<?php echo $video_id;?>').removeClass('vjs-hidden');
            

            //video_player.enterFullWindow();
            
        });
    
    </script>
        <!--    <p id="<?php echo $video_id; ?>" class="list-group-item list-group-item-action"><b><?php echo "$mp4";?></b></p>              
        --> <?php
        } // foreach
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if

    ?>
    </div>

    <?php
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    //END //videos //END
}    
//END //videos function//END

//START //comments function //START
function comments_tls_xml ($sense_bundle_id, $target_lang, $lang_code, $sense_bundle_node, $dom){
    $dic_name = "";
    include ("connection.php");
    //START //comments //START
    try {

    $result = $link->query("SELECT * FROM comments WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY comment_order");

    if($result->rowCount()>0){
        foreach ($result as $key => $row){
        $comment_id=$row["comment_id"];    
        $comment= $row["comment"];
        ?>
        <div id="comment_<?php echo $comment_id;?>" class="d-inline-flex p-0 bd-highlight comment <?php echo $lang_code ?>">
        <b><?php echo "$comment";?></b><span><small><?php echo "[$lang_code]"; ?></small></span>
        </div>        
        <?php
        } // foreach
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    }
    //END //comments //END
}   
//END //comments function//END


//START //comments function //START
function comments_sls_xml ($sense_bundle_id, $source_lang, $lang_code, $sense_bundle_node, $dom){
    $dic_name = "";
    include ("connection.php");
    //START //comments //START
    try {

    $result = $link->query("SELECT * FROM comments WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY comment_order");

    if($result->rowCount()>0){
        foreach ($result as $key => $row){
        $comment_id=$row["comment_id"];    
        $comment= $row["comment"];
        ?>
        <div id="comment_<?php echo $comment_id;?>" class="d-inline-flex p-0 bd-highlight comment <?php echo $lang_code ?>">
        <b><?php echo "$comment";?></b><span><small><?php echo "[$lang_code]"; ?></small></span>
        </div>        
        <?php
        } // foreach
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    }
    //END //comments //END
}   
//END //comments function//END

//END //Part 2 - Sense//END








$dom = new DOMDocument();

$dom->encoding = 'utf-8';

$dom->xmlVersion = '1.0';

$dom->formatOutput = true;

$xml_file_name = 'dicionario_'.$dic_name.'.xml';

$root = $dom->createElement('dictionary');





try {

    $result5 = $link->query("SELECT * FROM forms ORDER BY vernacular");

    if($result5->rowCount()>0){
      foreach ($result5 as $key => $row){
        $form_bundle_id=$row["form_bundle_id"];    
        $vernacular=$row["vernacular"];    


        try {

            $result6 = $link->query("SELECT * FROM form_bundles WHERE form_bundle_id = '$form_bundle_id'");
        
            if($result6->rowCount()>0){
              foreach ($result6 as $key => $row){
                $entry_id=$row["entry_id"];    
                
        

                

                try {

                    $result7 = $link->query("SELECT * FROM entries WHERE entry_id = '$entry_id'");
                
                    if($result7->rowCount()>0){
                      foreach ($result7 as $key => $row){
                        $entry_bundle_id=$row["entry_bundle_id"];    
                        
                
                

                                        
                $entry_bundle_node = $dom->createElement('entry_bundle');

                $attr_entry_bundle_id = new DOMAttr('id', $entry_bundle_id);
                $entry_bundle_node->setAttributeNode($attr_entry_bundle_id);

                

                


                        $entry_node = $dom->createElement('entry');

                        $attr_entry_id = new DOMAttr('id', $entry_id);
                        $entry_node->setAttributeNode($attr_entry_id);
                        $entry_bundle_node->appendChild($entry_node);



                        form_bundle_output_xml ($entry_id, $entry_node, $dom);


                        sense_bundle_output_xml ($entry_id, $entry_node, $dom);











                $root->appendChild($entry_bundle_node);
        






                
                            } // foreach
                    }else{
                        //echo "A busca não retornou nenhum resultado.";
                    } // if
                  } catch(PDOException $e){
                    echo "1Opps, houve um erro na sua busca<br><br>".$e->getMessage();
                  }
                
        
        



        
        
                    } // foreach
            }else{
                //echo "A busca não retornou nenhum resultado.";
            } // if
          } catch(PDOException $e){
            echo "3Opps, houve um erro na sua busca<br><br>".$e->getMessage();
          }
        









            } // foreach
    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
  } catch(PDOException $e){
    echo "4Opps, houve um erro na sua busca<br><br>".$e->getMessage();
  }






















        $dom->appendChild($root);
        
        $dom->save($xml_file_name);

	echo "$xml_file_name has been successfully created";
?>