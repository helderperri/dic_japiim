<?php

//require_once ("functions_search_panel.php");
//require_once ("functions_lang_info.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//$dic_name = $_SESSION['dic_name'];
$dic_name = "";
    include ("connection.php");


if(isset($_POST['langtype'])){

  $langtype = $_POST['langtype'];

  $_SESSION['config_search_'.$dic_name][0]['langtype'] = $langtype; 
    }else{
  $config_search= $_SESSION['config_search_'.$dic_name][0];
  $langtype = $config_search['langtype'];  

} 

if(isset($_POST['searchtype'])){

    $searchtype = $_POST['searchtype'];

    if($_POST['searchtype'] == 0){
        
    }else{
      $_SESSION['config_search_'.$dic_name][0]['searchtype'] = $searchtype;
    }

    }else{
    $config_search= $_SESSION['config_search_'.$dic_name][0];

    $searchtype = $config_search['searchtype'];  

}


if(isset($_POST['mode'])){

  $mode = $_POST['mode'];
  
  $_SESSION['config_search_'.$dic_name][0]['mode'] = $mode; 
    }else{
  $config_search= $_SESSION['config_search_'.$dic_name][0];
  $mode = $config_search['mode'];   

} 

if(isset($_POST['btn_id'])){

    $btn_id = $_POST['btn_id'];
    
    $_SESSION['config_search_'.$dic_name][0]['btn_id'] = $btn_id; 
      }else{
    $config_search= $_SESSION['config_search_'.$dic_name][0];
    $btn_id = 1;  
  
  } 
  

  if(isset($_POST['searchtext'])){

    $searchtext = $_POST['searchtext'];
    
      }else{
    $searchtext = "";  
  
  } 
  

if($langtype==1){

    $config = "config_sls_".$dic_name;    
    $type_of_lang = "source_lang";

}elseif($langtype==2){
    $config = "config_tls_".$dic_name;
    $type_of_lang = "target_lang";    

}



function entry_id ($bundle_id, $langtype){
  if($langtype == 1){
    $table_to_search = "form_bundles";
    $column_to_search = "form_bundle_id";
  }elseif($langtype ==2){

    $table_to_search = "sense_bundles";
    $column_to_search = "sense_bundle_id";

  }

      $dic_name = "";
    include ("connection.php");
  try {
    $result = $link->query("SELECT * FROM $table_to_search WHERE $column_to_search = '$bundle_id'");
      
          if($result->rowCount()>0){


            foreach ($result as $row){
              $entry_id=$row["entry_id"];
              return $entry_id;
            } // foreach     
      
          }else{
            //echo "A busca não retornou nenhum resultado.";
        } // if
      
      } catch(PDOException $e){
        echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try

}

function find_entries($btn_id, $langtype, $searchtype, $lang_code){
      $dic_name = "";
    include ("connection.php");
  $mdarray = array();
  $count=0;

  if($searchtype==2){
    $table_to_search1 = "sds";
    $column_to_search1 = "sd_id";

    }elseif($searchtype==3){
    $table_to_search1 = "classes";
    $column_to_search1 = "class_id";
  }

  if($langtype==1){
    $table_to_search2 = "form_bundles";
    $table_to_search3 = "forms";
    $panel = "panel_s";
    $id_tag = "form_id";
    $bundle_id_tag = "form_bundle_id";
    $entry_source_tag = "vernacular";
    }elseif($langtype==2){
    $table_to_search2 = "sense_bundles";
    $table_to_search3 = "glosses";
    $panel = "panel_t";
    $id_tag = "gloss_id";
    $bundle_id_tag = "sense_bundle_id";
    $entry_source_tag = "gloss";
  }

  $entry_bundle_id="";
  try {
      $result = $link->query("SELECT * FROM $table_to_search1 WHERE $column_to_search1 = '$btn_id'");
        
            if($result->rowCount()>0){

              foreach ($result as $row){
                $sense_bundle_id=$row["sense_bundle_id"];

                try{
                  $result2 = $link->query("SELECT * FROM sense_bundles WHERE sense_bundle_id = '$sense_bundle_id'");
          
                      if($result2->rowCount()>0){
            
                          foreach ($result2 as $row){
                            $entry_id=$row["entry_id"];

                            try{
                              $result9 = $link->query("SELECT * FROM  entries WHERE entry_id = '$entry_id'");
                              if($result9->rowCount()>0){
                        
                                foreach ($result9 as $row){
                                  $entry_bundle_id=$row['entry_bundle_id'];
                                }//foreach
                              }//iff

                            } catch(PDOException $e){
                              echo "Opps, houve um erro na busca1<br><br>".$e->getMessage();
                          } // try
    
                                $result3 = $link->query("SELECT * FROM  $table_to_search2 WHERE entry_id = '$entry_id'");
                                  
                                  if($result3->rowCount()>0){
                        
                                      foreach ($result3 as $row){
                                        $bundle_id=$row[$bundle_id_tag];

                                        try{
                                          $result4 = $link->query("SELECT * FROM  $table_to_search3 WHERE lang_code = '$lang_code' AND $bundle_id_tag = '$bundle_id' ORDER BY $entry_source_tag COLLATE utf8mb4_unicode_ci");
                                  
                                              if($result4->rowCount()>0){
                                    
                                                  foreach ($result4 as $row){
                                                    $id=$row[$id_tag];
                                                    $entry_source =$row[$entry_source_tag];
                                                    $zero_col=$count;
                                                    $mdarray[$zero_col] = array($entry_source_tag => $entry_source, "entry_bundle_id" => $entry_bundle_id, "entry_id" => $entry_id, "id" => $id);
                                                    $count++;                                    
                                            
                                                  } // foreach     
                                            
                                              }else{
                                                //echo "A busca não retornou nenhum resultado.";
                                            } // if
                              
                                          } catch(PDOException $e){
                                            echo "Opps, houve um erro na busca2<br><br>".$e->getMessage();
                                        } // try
                                           
                                      } // foreach     
                                
                                  }else{
                                    //echo "A busca não retornou nenhum resultado.";
                                } // if
                              }//foreach
                            }//if
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
          

    return $mdarray;
}




function build_sorter($key) {
  
  return function ($a, $b) use ($key) {

    
      return strcasecmp($a[$key], $b[$key]);

  };
}



function panel_search($btn_id, $searchtext, $langtype, $searchtype, $mode, $lang, $lang_code, $native_name){
      $dic_name = "";
    include ("connection.php");
  //include ('lang_check.php');

  
  $glyphs = array();
  $entries_list = array();
  if($langtype==1){
    $table_to_search1 = "letters_source";
    $panel = "panel_s";
    $id_tag = "form_id";
    $table_to_search2 = "forms";
    $bundle_id_tag = "form_bundle_id";
    $entry_source_tag = "vernacular";
    $config_ls = "config_sls_".$dic_name;
    }elseif($langtype==2){
    $table_to_search1 = "letters_target";
    $table_to_search2 = "glosses";
    $panel = "panel_t";
    $id_tag = "gloss_id";
    $bundle_id_tag = "sense_bundle_id";
    $entry_source_tag = "gloss";
    $config_ls = "config_tls_".$dic_name;
  }
  

  if($searchtype == 0){ 
    $entries_list_unordered = array();
    $count=0;
  
    try {
      $result = $link->query("SELECT * FROM $table_to_search2 WHERE ((lang_code = '$lang_code' AND $entry_source_tag LIKE '$searchtext%') OR (lang_code = '$lang_code' AND $entry_source_tag LIKE '%$searchtext'))");
        
            if($result->rowCount()>0){  
                
              foreach ($result as $row){
                $id=$row[$id_tag];
                $bundle_id=$row[$bundle_id_tag];
                $entry_source= $row[$entry_source_tag];
                $entry_id = entry_id($bundle_id, $langtype);

                try{
                  $result9 = $link->query("SELECT * FROM  entries WHERE entry_id = '$entry_id'");
                  if($result9->rowCount()>0){
            
                    foreach ($result9 as $row){
                      $entry_bundle_id=$row['entry_bundle_id'];
                    }//foreach
                  }//iff

                } catch(PDOException $e){
                  echo "Opps, houve um erro na busca3<br><br>".$e->getMessage();
              } // try



                $entry = ['id'=> $id, 'entry_bundle_id'=>$entry_bundle_id, 'entry_id'=>$entry_id, $entry_source_tag=>$entry_source]; 
                $entries_list_unordered[] = $entry;
                
                }//foreach  
              }else{
                //echo "A busca não retornou nenhum resultado.";
            } // if
  
          } catch(PDOException $e){
            echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
        } // try
  
      
        usort($entries_list_unordered, build_sorter($entry_source_tag));
        $entries_list = array_values($entries_list_unordered);
  
  }elseif($searchtype == 1){
    
    try{
      $result = $link->query("SELECT * FROM $table_to_search1 WHERE glyph_id = '$btn_id'");

      if($result->rowCount()>0){
        //$key=0;
        foreach ($result as $key => $row){
            $glyph_other=$row["glyph_other"];
            $glyphs[] = $glyph_other;
          } //foreach    
      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if

  } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
  } // try

  try{
    $glyphs_in = "'" . implode( "','", $glyphs ) . "'";
      $result = $link->query("SELECT * FROM $table_to_search2 WHERE lang_code = '$lang_code' AND LEFT ($entry_source_tag, 1) IN ($glyphs_in) ORDER BY $entry_source_tag COLLATE utf8mb4_general_ci");
      if($result->rowCount()>0){
        
        foreach ($result as $row){
          $id=$row[$id_tag];
          $bundle_id=$row[$bundle_id_tag];
          $entry_source= $row[$entry_source_tag];
          $entry_id = entry_id($bundle_id, $langtype);
          $entry_bundle_id = "";
          try{
            $result9 = $link->query("SELECT * FROM  entries WHERE entry_id = '$entry_id'");
            if($result9->rowCount()>0){
      
              foreach ($result9 as $row){
                $entry_bundle_id=$row['entry_bundle_id'];
              }//foreach
            }//iff

          } catch(PDOException $e){
            echo "Opps,2222 houve um erro na busca<br><br>".$e->getMessage();
        } // try



          $entry = ['id'=> $id, 'entry_bundle_id'=>$entry_bundle_id, 'entry_id'=>$entry_id, $entry_source_tag=>$entry_source]; 

          $entries_list[] = $entry;
          
          }//foreach  
      }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
    
  } catch(PDOException $e){
  echo "Opps,dddd houve um erro na sua busca<br><br>".$e->getMessage();
  } // try

  }elseif($searchtype == 2 || $searchtype == 3){

    
    $entries_list_unordered = find_entries($btn_id, $langtype, $searchtype, $lang_code);

    usort($entries_list_unordered, build_sorter($entry_source_tag));
    $entries_list = array_values($entries_list_unordered);

  
  }
  $is_hidden = "";

  if($_SESSION[$config_ls][$lang-1]['search_display'] ==0){
    $is_hidden = "none";

  }else{
    $is_hidden = "block";


  }
  ?>
  <div id="<?php echo $panel;?><?php echo $lang;?>_div" class="form-group mb-0 <?php echo $panel;?><?php echo $lang;?>"  style="display:<?php echo $is_hidden;?>">
  <label id="label_<?php echo $panel;?><?php echo $lang;?>" for="<?php echo $panel;?><?php echo $lang;?>"><b><?php echo $native_name;?></b></label>
  <div class="list-group list-group-flush pre-scrollable p-0" size="4" id="<?php echo $panel;?><?php echo $lang;?>" style="height: 6em; overflow-y: scroll;">
    <?php
      try{
        $key=0;
            foreach ($entries_list as $key => $row){
                $id=$row["id"];
                //$form_bundle_id=$row["form_bundle_id"];
                $entry_source= $row["$entry_source_tag"];
                $entry_id = $row["entry_id"];
                $entry_bundle_id = $row["entry_bundle_id"];

                ?>
                  <li id="<?php echo $id; ?>" mode="<?php echo $mode; ?>" class="list-group-item list-group-item-action list-group-item-light border-0 entry_select entry_<?php echo $panel;?><?php echo $lang;?>" entry_bundle_id="<?php echo $entry_bundle_id; ?>" value="<?php echo $entry_id; ?>"><?php echo $entry_source; ?></li>
                <?php
              } //foreach          

      } catch(PDOException $e){
        echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
    } // try
    

          ?>
    </div>
  </div>
  
      <?php

if(!empty($_POST['reload'])){

  ?>
  <script type='text/javascript' src="js/entry_select.js"></script>
   <?php

  }else{
  }

}


$langs_info = $_SESSION[$config];
    
foreach ($langs_info as $lang_info){

    $lang = $lang_info[$type_of_lang];
    $lang_code = $lang_info['lang_code'];
    $native_name = $lang_info['native_name'];
    panel_search ($btn_id, $searchtext, $langtype, $searchtype, $mode, $lang, $lang_code, $native_name);
} 
   



  ?>