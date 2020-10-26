<?php
    $dic_name = "";
    include ("connection.php");


if(isset($_POST['lang_code'])){

    $lang_code = $_POST['lang_code'];
    
      }else{
  
  } 
  
  if(isset($_POST['bundle'])){

    $sense_bundle_id = $_POST['bundle'];
    
      }else{
  
  }

  if(isset($_POST['gloss_id'])){

    $gloss_id = $_POST['gloss_id'];
    
      }else{
  
  }

  if(isset($_POST['gloss_order'])){

    $gloss_order = $_POST['gloss_order'];
    
      }else{
  
  }

  if(isset($_POST['gloss'])){

    $gloss = $_POST['gloss'];
    
      }else{
  
  }

  if(isset($_POST['items'])){

    $items = $_POST['items'];
    
      }else{
  
  }

if(isset($_POST['add_gloss'])){

  try {
    //session_start();
    $sql = "INSERT INTO glosses (sense_bundle_id, entry_ref, gloss_order, target_lang, lang_code, class, gloss) 
    VALUES (:sense_bundle_id, 'entry_ref', :gloss_order, 1, :lang_code, 'class', :gloss)";
    $stmnt = $link->prepare($sql);

    $entry_data = [':sense_bundle_id'=>$sense_bundle_id,':gloss_order'=>$items+1, ':lang_code'=>$lang_code, ':gloss'=>''];
    $stmnt->execute($entry_data);
 




} catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
}

}



if(isset($_POST['save_gloss'])){

    try {
      //session_start();
      $sql = "UPDATE glosses SET gloss = :gloss WHERE gloss_id=:gloss_id";
      $stmnt = $link->prepare($sql);
  
      $entry_data = [':gloss'=>$gloss,':gloss_id'=>$gloss_id];
      $stmnt->execute($entry_data);
   
  
  
  
  } catch(PDOException $e){
      echo "Erro: ".$e->getMessage();
  }
  
  }



if(isset($_POST['del_gloss'])){

    try {
      //session_start();
      //session_start();
      $result = $link->query("SELECT * FROM glosses WHERE gloss_id = '$gloss_id'");

      if($result->rowCount()>0){
        
        foreach ($result as $row){
            $gloss=$row["gloss"];
            $entry_ref=$row["entry_ref"];
            $target_lang=$row["target_lang"];
            $gloss_order=$row["gloss_order"];
            $class=$row["class"];

            if ($gloss==""){

            }else{
  
                try{
                    $sql = "INSERT INTO glosses_bck (sense_bundle_id, entry_ref, gloss_id, gloss_order, target_lang, lang_code, class, gloss) 
                    VALUES (:sense_bundle_id, :entry_ref, :gloss_id, :gloss_order, :target_lang, :lang_code, :class, :gloss)";
                    $stmnt = $link->prepare($sql);
                
                    $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':gloss_id'=>$gloss_id, ':gloss_order'=>$gloss_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':class'=>$class, ':gloss'=>$gloss];
                    $stmnt->execute($entry_data);
                

                } catch(PDOException $e){
                    echo "Erro: ".$e->getMessage();
                }//try
  
            }//if


          } // foreach      
  
        }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if


  try{
      $sql2 = "DELETE FROM glosses WHERE gloss_id = :gloss_id";
      $stmnt2 = $link->prepare($sql2);
  
      $entry_data2 = [':gloss_id'=>$gloss_id];
      $stmnt2->execute($entry_data2);
   

  
    
    } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
    }

    
    
    } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
    }
    




    try {
  
      $result = $link->query("SELECT * FROM glosses WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY gloss_order");
      $gloss_id="";
      
  
      if($result->rowCount()>0){
        $gloss_order = 1;
        foreach ($result as $key => $row){    
      
          $gloss_id=$row["gloss_id"];

          try {
            //session_start();
            $sql = "UPDATE glosses SET gloss_order = :gloss_order WHERE gloss_id=:gloss_id";
            $stmnt = $link->prepare($sql);
        
            $entry_data = [':gloss_order'=>$gloss_order,':gloss_id'=>$gloss_id];
            $stmnt->execute($entry_data);
         
        
        
        
        } catch(PDOException $e){
            echo "Erro: ".$e->getMessage();
        }

          $gloss_order++;

        } // foreach


      }//if
    
      } catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
    }






}//if(isset($_POST['del_gloss']))

if(isset($_POST['restore_gloss'])){
  $target_lang="";
    try {
    //session_start();
    //session_start();
    $result = $link->query("SELECT * FROM glosses_bck WHERE gloss_id_bck = '$gloss_id'");

    if($result->rowCount()>0){
        
        foreach ($result as $row){
            $gloss=$row["gloss"];
            $entry_ref=$row["entry_ref"];
            $target_lang=$row["target_lang"];
            
            $class=$row["class"];

        
                try{
                    $sql = "INSERT INTO glosses (sense_bundle_id, entry_ref, gloss_order, target_lang, lang_code, class, gloss) 
                    VALUES (:sense_bundle_id, :entry_ref, :gloss_order, :target_lang, :lang_code, :class, :gloss)";
                    $stmnt = $link->prepare($sql);
                
                    $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':gloss_order'=>$gloss_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':class'=>$class, ':gloss'=>$gloss];
                    $stmnt->execute($entry_data);
                

                } catch(PDOException $e){
                    echo "Erro: ".$e->getMessage();
                }//try



        } // foreach      

        }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if



    $sql2 = "DELETE FROM glosses_bck WHERE gloss_id_bck = :gloss_id";
    $stmnt2 = $link->prepare($sql2);

    $entry_data2 = [':gloss_id'=>$gloss_id];
    $stmnt2->execute($entry_data2);


  
  } catch(PDOException $e){
      echo "Erro: ".$e->getMessage();
  }
  
}//if(isset($_POST['del_gloss']))


//glosses_edit($sense_bundle_id, $target_lang, $lang_code);

try {
  
    $result = $link->query("SELECT * FROM glosses WHERE sense_bundle_id  = '$sense_bundle_id' AND lang_code = '$lang_code' ORDER BY gloss_order");
    $gloss_id="";
    $gloss_array = [];

    if($result->rowCount()>0){
      $count = 1;
      foreach ($result as $key => $row){    
        
        $new_gloss_array =  array (
          'gloss_id' => $row["gloss_id"],
          //'gloss_order' => $row["gloss_order"],
          'gloss_order' => $count,
          'gloss' => $row["gloss"],
          'target_lang' => $row["target_lang"],
        ); 
        $gloss_array[]= $new_gloss_array;
        $count++;

      } // foreach

        
                $gloss_items = count($gloss_array);
                $item_count=0;
                if($gloss_items<2){
                foreach ($gloss_array as $gloss_item){
                    $item_count= $item_count+1;

                    $gloss_id = $gloss_item['gloss_id'];
                    $gloss_order = $gloss_item['gloss_order'];
                    $gloss = $gloss_item['gloss'];
                    $target_lang = $gloss_item['target_lang'];

                  ?>
                  <div class="d-flex">

                <input gloss_order="<?php echo $gloss_order; ?>" id="gloss_input_<?php echo $gloss_id; ?>" first="1" class="form-control form-control-sm ml-auto pr-1 gloss_input" gloss_id="<?php echo $gloss_id; ?>" type="text" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" value="<?php echo $gloss;?>" >  
                <button id='del_gloss_<?php echo $gloss_id; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" gloss_id="<?php echo $gloss_id; ?>" class='btn btn-default btn-sm p-0 del_gloss'>
                  <span class="material-icons md-18">delete</span>
                </button>
                          </div>

                          <script type='text/javascript'> 
          $('#del_gloss_<?php echo $gloss_id; ?>').on('click', function(){
            
            var lang_code = $(this).attr('lang_code');
            var bundle = $(this).attr('bundle');
            var gloss_div = "#gloss_bundle_"+bundle+"_"+lang_code;
            var add_gloss_id = "#add_gloss_"+bundle+"_"+lang_code;
            var items = $(add_gloss_id).attr('items');
            var del_gloss = 1;
            var restore_gloss = 1;
            var gloss_id = $(this).attr('gloss_id');
            var items_new = (parseInt(items))-1;
            console.log(lang_code);
            console.log(gloss_id);
            console.log(bundle);
            console.log(add_gloss_id);
            console.log(gloss_div);

            $(add_gloss_id).attr('items', items_new);
            
            $.ajax({
                url:'edit_gloss.php',
                data:{bundle:bundle, lang_code:lang_code, gloss_id:gloss_id, del_gloss:del_gloss},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(gloss_div).html(data);

                    }
                }
                

              })

                
            $.ajax({
              url:'modal_update.php',
              data:{bundle:bundle, lang_code:lang_code, gloss_id:gloss_id, gloss_order:items_new, restore_gloss:restore_gloss},
              type: 'POST',
              success: function(data){
                  if(!data.error){
                      $('#modal_gloss_panel').html(data);

                  }
              }
              



            })




          })
      </script>
    <script type='text/javascript'>
      $('#gloss_input_<?php echo $gloss_id; ?>').keyup(function(){
        var lang_code = $(this).attr('lang_code');
        var bundle = $(this).attr('bundle');
        var first = $(this).attr('first');
        var gloss = $(this).val();
        var gloss_id = $(this).attr('gloss_id');

        if(first==1){
          $(this).attr('first', 0);
          var bck_gloss = 1;
          console.log(gloss);
          $.ajax({
          url:'update_gloss.php',
          data:{gloss_id:gloss_id, bck_gloss:bck_gloss},
          type: 'POST',
          /*success: function(data){
              if(!data.error){
                  $(gloss_div).html(data);

              }
          }*/
          

        })
          var update_gloss = 1;
          var div_modal="#modal_gloss_panel_".concat(bundle).concat("_").concat(lang_code);
          console.log(div_modal);
        $.ajax({
          url:'modal_update.php',
          data:{bundle:bundle, lang_code:lang_code, gloss_id:gloss_id, update_gloss:update_gloss},
          type: 'POST',
          success: function(data){
              if(!data.error){
                  $(div_modal).html(data);

              }
          }
          
        

        })


        }

        var update_gloss = 1;

        $.ajax({
            url:'update_gloss.php',
            data:{gloss:gloss, gloss_id:gloss_id, update_gloss:update_gloss},
            type: 'POST',
            success: function(data){
                
            }
            

          })

    })
      </script>

                  <?php
                  



                }//foreach
            }//if($gloss_items==1 || $gloss_items==0)
            elseif($gloss_items>=2){
                foreach ($gloss_array as $gloss_item){
                    $gloss_id = $gloss_item['gloss_id'];
                    $gloss_order = $gloss_item['gloss_order'];
                    $gloss = $gloss_item['gloss'];
                    $target_lang = $gloss_item['target_lang'];
                    


                    
                  ?>
                  <div class="d-flex">

                
                <?php
                
                    $item_count= $item_count+1;
                    if($item_count==1){
                        ?>
                        <!--
                <button id='down_gloss_<?php echo $gloss_id; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" gloss_id="<?php echo $gloss_id; ?>" class='btn btn-default btn-sm p-0 down_gloss'>
                  <span class="material-icons md-18">arrow_downward</span>
                </button>
                    -->
                <?php

                    }else{
                        if($item_count==$gloss_items){

                            ?>
                            <!--
                            <button id='up_gloss_<?php echo $gloss_id; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" gloss_id="<?php echo $gloss_id; ?>" class='btn btn-default btn-sm p-0 up_gloss'>
                              <span class="material-icons md-18">arrow_upward</span>
                            </button>
                        -->
                            <?php
            
                            
                        }else{

                            ?>
                            <!--
                <button id='down_gloss_<?php echo $gloss_id; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" gloss_id="<?php echo $gloss_id; ?>" class='btn btn-default btn-sm p-0 down_gloss'>
                  <span class="material-icons md-18">arrow_downward</span>
                </button>
                            <button id='up_gloss_<?php echo $gloss_id; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" gloss_id="<?php echo $gloss_id; ?>" class='btn btn-default btn-sm p-0 up_gloss'>
                              <span class="material-icons md-18">arrow_upward</span>
                            </button>
                        -->
                            <?php
            
                        }


                    }

                ?>

                <input gloss_order="<?php echo $gloss_order; ?>" id="gloss_input_<?php echo $gloss_id; ?>" first="1" class="form-control form-control-sm ml-auto pr-1 gloss_input" gloss_id="<?php echo $gloss_id; ?>" type="text" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" value="<?php echo $gloss;?>" >

                <button id='del_gloss_<?php echo $gloss_id; ?>' type="button" bundle="<?php echo $sense_bundle_id; ?>" lang_code="<?php echo $lang_code; ?>" gloss_id="<?php echo $gloss_id; ?>" class='btn btn-default btn-sm p-0 del_gloss'>
                  <span class="material-icons md-18">delete</span>
                </button>
              </div>

      <script type='text/javascript'> 
          $('#del_gloss_<?php echo $gloss_id; ?>').on('click', function(){
            
            var lang_code = $(this).attr('lang_code');
            var bundle = $(this).attr('bundle');
            var gloss_div = "#gloss_bundle_"+bundle+"_"+lang_code;
            var add_gloss_id = "#add_gloss_"+bundle+"_"+lang_code;
            var items = $(add_gloss_id).attr('items');
            var del_gloss = 1;
            var restore_gloss = 1;
            var gloss_id = $(this).attr('gloss_id');
            var items_new = (parseInt(items))-1;
            console.log(lang_code);
            console.log(gloss_id);
            console.log(bundle);
            console.log(add_gloss_id);
            console.log(gloss_div);

            $(add_gloss_id).attr('items', items_new);
            
            $.ajax({
                url:'edit_gloss.php',
                data:{bundle:bundle, lang_code:lang_code, gloss_id:gloss_id, del_gloss:del_gloss},
                type: 'POST',
                success: function(data){
                    if(!data.error){
                        $(gloss_div).html(data);

                    }
                }
                

              })

                
            $.ajax({
              url:'modal_update.php',
              data:{bundle:bundle, lang_code:lang_code, gloss_id:gloss_id, gloss_order:items_new, restore_gloss:restore_gloss},
              type: 'POST',
              success: function(data){
                  if(!data.error){
                      $('#modal_gloss_panel').html(data);

                  }
              }
              



            })




          })
      </script>
    <script type='text/javascript'>
      $('#gloss_input_<?php echo $gloss_id; ?>').keyup(function(){
        var lang_code = $(this).attr('lang_code');
        var bundle = $(this).attr('bundle');
        var first = $(this).attr('first');
        var gloss = $(this).val();
        var gloss_id = $(this).attr('gloss_id');

        if(first==1){
          $(this).attr('first', 0);
          var bck_gloss = 1;
          console.log(gloss);
          $.ajax({
          url:'update_gloss.php',
          data:{gloss_id:gloss_id, bck_gloss:bck_gloss},
          type: 'POST',
          /*success: function(data){
              if(!data.error){
                  $(gloss_div).html(data);

              }
          }*/
          

        })
          var update_gloss = 1;
          var div_modal="#modal_gloss_panel_".concat(bundle).concat("_").concat(lang_code);
          console.log(div_modal);
        $.ajax({
          url:'modal_update.php',
          data:{bundle:bundle, lang_code:lang_code, gloss_id:gloss_id, update_gloss:update_gloss},
          type: 'POST',
          success: function(data){
              if(!data.error){
                  $(div_modal).html(data);

              }
          }
          
        

        })


        }

        var update_gloss = 1;

        $.ajax({
            url:'update_gloss.php',
            data:{gloss:gloss, gloss_id:gloss_id, update_gloss:update_gloss},
            type: 'POST',
            success: function(data){
                
            }
            

          })

    })
      </script>
                  <?php
                }//foreach
            }//else

    }else{
        //echo "A busca não retornou nenhum resultado.";
    } // if
  } catch(PDOException $e){
    echo "Opps, houve um erro na sua busca<br><br>".$e->getMessage();
  } // try




  
if(isset($_POST['bck_gloss'])){

  try {
      //session_start();
      //session_start();
      $result = $link->query("SELECT * FROM glosses WHERE gloss_id = '$gloss_id'");

      if($result->rowCount()>0){
        
        foreach ($result as $row){
          $sense_bundle_id=$row["sense_bundle_id"];
          $gloss=$row["gloss"];
            $entry_ref=$row["entry_ref"];
            $target_lang=$row["target_lang"];
            $lang_code=$row["lang_code"];
            $gloss_order=$row["gloss_order"];
            $class=$row["class"];

            if ($gloss==""){

            }else{
  
                try{
                    $sql = "INSERT INTO glosses_bck (sense_bundle_id, entry_ref, gloss_id, gloss_order, target_lang, lang_code, class, gloss) 
                    VALUES (:sense_bundle_id, :entry_ref, :gloss_id, :gloss_order, :target_lang, :lang_code, :class, :gloss)";
                    $stmnt = $link->prepare($sql);
                
                    $entry_data = [':sense_bundle_id'=>$sense_bundle_id, ':entry_ref'=>$entry_ref, ':gloss_id'=>$gloss_id, ':gloss_order'=>$gloss_order, ':target_lang'=>$target_lang, ':lang_code'=>$lang_code, ':class'=>$class, ':gloss'=>$gloss];
                    $stmnt->execute($entry_data);
                

                } catch(PDOException $e){
                    echo "Erro: ".$e->getMessage();
                }//try
  
            }//if


          } // foreach      
  
        }else{
          //echo "A busca não retornou nenhum resultado.";
      } // if





} catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
}

}

if(isset($_POST['update_gloss'])){

  try {
      //session_start();
      $sql = "UPDATE glosses SET gloss = :gloss WHERE gloss_id=:gloss_id";
      $stmnt = $link->prepare($sql);
  
      $entry_data = [':gloss'=>$gloss,':gloss_id'=>$gloss_id];
      $stmnt->execute($entry_data);
   
  
  
  
  } catch(PDOException $e){
      echo "Erro: ".$e->getMessage();
  }

}






    ?>
    


<?php