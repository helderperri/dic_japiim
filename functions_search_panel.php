  <?php






function entry_id ($form_bundle_id){
    include ('connection.php');

    $sql="SELECT * FROM form_bundles WHERE form_bundle_id = '$form_bundle_id'";

    if($result = mysqli_query($link, $sql)){
      if(mysqli_num_rows($result)>0){
        $form_bundle_id="";
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          if($form_bundle_id!=$row["form_bundle_id"]){
            $form_bundle_id=$row["form_bundle_id"];
            $entry_id=$row["entry_id"];
            return $entry_id;
          }
        }
      }
    }

}




function entry_id_reverse ($sense_bundle_id){
    include ('connection.php');

    $sql="SELECT * FROM sense_bundles WHERE sense_bundle_id = '$sense_bundle_id'";

    if($result = mysqli_query($link, $sql)){
      if(mysqli_num_rows($result)>0){
        $sense_bundle_id="";
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          if($sense_bundle_id!=$row["sense_bundle_id"]){
            $sense_bundle_id=$row["sense_bundle_id"];
            $entry_id=$row["entry_id"];
            return $entry_id;
          }
        }
      }
    }

}



function find_entries_by_sd_reverse($sd_id, $target_lang){

    include ('connection.php');

    $mdarray = array();
    $count=0;




    $sql="SELECT * FROM sds WHERE sd_id = '$sd_id'";
    $gloss = ""; 
    $entry_id = "";
    if($result = mysqli_query($link, $sql)){
      if(mysqli_num_rows($result)>0){
        $sense_bundle_id="";
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          if($sense_bundle_id!=$row["sense_bundle_id"]){
            $sense_bundle_id=$row["sense_bundle_id"];
            $sd_id=$row["sd_id"];
            $sd_name_ref=$row["sd_name_ref"];
           


            $sql2="SELECT * FROM sense_bundles WHERE sense_bundle_id = '$sense_bundle_id'";

            if($result2 = mysqli_query($link, $sql2)){
              if(mysqli_num_rows($result2)>0){
                $entry_id="";
                while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                  if($entry_id!=$row["entry_id"]){
                    $entry_id=$row["entry_id"];

                    $sql3="SELECT * FROM senses WHERE sense_bundle_id = '$sense_bundle_id' AND target_lang = '$target_lang'";

            if($result3 = mysqli_query($link, $sql3)){
              if(mysqli_num_rows($result3)>0){
                $sense_id="";
                while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                  if($sense_id!=$row["sense_id"]){
                    $sense_id=$row["sense_id"];
                    $gloss=$row["gloss"];
                    $zero_col=$count;
                    $mdarray[$zero_col] = array("gloss" => $gloss, "entry_id" => $entry_id, "sense_id" => $sense_id);
                    $count++;
            



                
          
                      }else{
          
                      }
                }
                //close the result set
                mysqli_free_result($result3);
              }else{
                echo "<p>Não foram encontrados resultados para a busca.</p>";
              }
            }else{
              echo "<p>Não foi possível executar: $sql3. " . mysqli_error($link) ."</p>";
            }




          
                      }else{
          
                      }
                }
                //close the result set
                mysqli_free_result($result2);
              }else{
                echo "<p>Não foram encontrados resultados para a busca.</p>";
              }
            }else{
              echo "<p>Não foi possível executar: $sql2. " . mysqli_error($link) ."</p>";
            }




              }else{

              }


        }
        //close the result set
        mysqli_free_result($result);
      }else{
        echo "<p>Não foram encontrados resultados para a busca.</p>";
      }
    }else{
      echo "<p>Não foi possível executar: $sql. " . mysqli_error($link) ."</p>";
    }
    return $mdarray;



}




function sd_panel_reverse($sd_id, $target_lang){
    include ('connection.php');
    include ('lang_check.php');


    ?>
  
    <label id="label_panel<?php echo $target_lang;?>" for="panel_s<?php echo $target_lang;?>"><b><?php if($target_lang==1){ echo $native_name_tl1;}elseif($target_lang==2){echo $native_name_tl2;}?></b></label>
    <div class="list-group list-group-flush pre-scrollable p-0" size="6" id="panel_s<?php echo $target_lang;?>" style="height: 6em; overflow-y: scroll;">
    <?php
  
  

        $link->set_charset("utf8");
        $mdarray_end = find_entries_by_sd_reverse($sd_id, $target_lang);



        if (!empty($mdarray_end)){
    
          asort($mdarray_end);
          $mdarray_orded = array_values($mdarray_end);
    
          
    
          for ($i = 0; $i < count($mdarray_end); $i++){
            $gloss = $mdarray_orded[$i]["gloss"];
            $entry_id = $mdarray_orded[$i]["entry_id"];
            $sense_id = $mdarray_orded[$i]["sense_id"];
            
            
          ?>
          <li id="<?php echo $sense_id; ?>" class="list-group-item list-group-item-action list-group-item-light border-0 entry_select  panel_s<?php echo "$target_lang"; ?>" value="<?php echo "$entry_id"; ?>"><?php echo "$gloss"; ?></li>
          <?php
      
            }
    
          
    
    
        }else{
    
        }
    
    
  ?>
    </div>
  <?php
    ?>


    <script type='text/javascript' src="js/panel.js"></script>
      <?php


}


function find_entries_by_sd($sd_id, $source_lang){

    include ('connection.php');

    $mdarray = array();
    $count=0;




    $sql="SELECT * FROM sds WHERE sd_id = '$sd_id'";
    $vernacular = ""; 
    $entry_id = "";
    if($result = mysqli_query($link, $sql)){
      if(mysqli_num_rows($result)>0){
        $sense_bundle_id="";
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          if($sense_bundle_id!=$row["sense_bundle_id"]){
            $sense_bundle_id=$row["sense_bundle_id"];
            $sd_id=$row["sd_id"];
            $sd_name_ref=$row["sd_name_ref"];
           


            $sql2="SELECT * FROM sense_bundles WHERE sense_bundle_id = '$sense_bundle_id'";

            if($result2 = mysqli_query($link, $sql2)){
              if(mysqli_num_rows($result2)>0){
                $entry_id="";
                while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                  if($entry_id!=$row["entry_id"]){
                    $entry_id=$row["entry_id"];

                    $sql3="SELECT * FROM form_bundles WHERE entry_id = '$entry_id'";

            if($result3 = mysqli_query($link, $sql3)){
              if(mysqli_num_rows($result3)>0){
                $form_bundle_id="";
                while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                  if($form_bundle_id!=$row["form_bundle_id"]){
                    $form_bundle_id=$row["form_bundle_id"];

          

                    $sql4="SELECT * FROM forms WHERE source_lang = '$source_lang' AND form_bundle_id = '$form_bundle_id' ORDER BY vernacular";

                    if($result4 = mysqli_query($link, $sql4)){
                      if(mysqli_num_rows($result4)>0){
                        $form_id="";
                        while($row = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                          if($form_id!=$row["form_id"]){
                            $form_id=$row["form_id"];
                            $vernacular=$row["vernacular"];
                            $zero_col=$count;
                            $mdarray[$zero_col] = array("vernacular" => $vernacular, "entry_id" => $entry_id, "form_id" => $form_id);
                            $count++;
                
                  
                  
                              }else{
                  
                              }
                        }


                        //close the result set
                        mysqli_free_result($result4);
                      }else{
                        //echo "<p>Não foram encontrados resultados para a busca3.</p>";
                      }


                    }else{
                      echo "<p>Não foi possível executar: $sql4. " . mysqli_error($link) ."</p>";
                    }
                  


                
          
                      }else{
          
                      }
                }
                //close the result set
                mysqli_free_result($result3);
              }else{
                echo "<p>Não foram encontrados resultados para a busca.</p>";
              }
            }else{
              echo "<p>Não foi possível executar: $sql3. " . mysqli_error($link) ."</p>";
            }




          
                      }else{
          
                      }
                }
                //close the result set
                mysqli_free_result($result2);
              }else{
                echo "<p>Não foram encontrados resultados para a busca.</p>";
              }
            }else{
              echo "<p>Não foi possível executar: $sql2. " . mysqli_error($link) ."</p>";
            }




              }else{

              }


        }
        //close the result set
        mysqli_free_result($result);
      }else{
        echo "<p>Não foram encontrados resultados para a busca.</p>";
      }
    }else{
      echo "<p>Não foi possível executar: $sql. " . mysqli_error($link) ."</p>";
    }
    return $mdarray;



}
  

function sd_panel($sd_id, $source_lang){
    include ('connection.php');
    include ('lang_check.php');


    ?>
  
    <label id="label_panel<?php echo $source_lang;?>" class="p-0" for="panel_s<?php echo $source_lang;?>"><b><?php if($source_lang==1){ echo $native_name_sl1;}elseif($source_lang==2){echo $native_name_sl2;}?></b></label>
    <div class="list-group list-group-flush pre-scrollable p-0" size="6" id="panel_s<?php echo $source_lang;?>" style="height: 6em; overflow-y: scroll;">
      <?php
  
        $link->set_charset("utf8");
        $mdarray_end = find_entries_by_sd($sd_id, $source_lang);




        if (!empty($mdarray_end)){
    
          asort($mdarray_end);
          $mdarray_orded = array_values($mdarray_end);
    
          
    
          for ($i = 0; $i < count($mdarray_end); $i++){
            $vernacular = $mdarray_orded[$i]["vernacular"];
            $entry_id = $mdarray_orded[$i]["entry_id"];
            $form_id = $mdarray_orded[$i]["form_id"];
            
            
          ?>
          <li id="<?php echo $form_id; ?>" class="list-group-item list-group-item-action list-group-item-light border-0 entry_select panel_s<?php echo "$source_lang"; ?>" value="<?php echo "$entry_id"; ?>"><?php echo "$vernacular"; ?></li>
      
        <?php
      
            }
    
          
    
    
        }else{
    
        }
    
      ?>
    </div>
      <?php
    ?>


    <script type='text/javascript' src="js/panel.js"></script>
      <?php


}


function alpha_panel_reverse($first_letter, $target_lang){
  include ('connection.php');
  include ('lang_check.php');


  ?>

  <label id="label_panel<?php echo $target_lang;?>" for="panel_s<?php echo $target_lang;?>"><b><?php if($target_lang==1){ echo $native_name_tl1;}elseif($target_lang==2){echo $native_name_tl2;}?></b></label>
  <div class="list-group list-group-flush pre-scrollable p-0" id="panel_s<?php echo $target_lang;?>" style="height: 6em; overflow-y: scroll;">
  <?php


        $link->set_charset("utf8");

        if($first_letter == 'A'){
            $sql="SELECT * FROM senses WHERE target_lang = '$target_lang' AND LEFT (gloss, 1) = 'ã' COLLATE utf8_bin OR target_lang = '$target_lang' AND  LEFT (gloss, 1) = 'a' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'Ã' COLLATE utf8_bin OR target_lang = '$target_lang' AND  LEFT (gloss, 1) = 'A' COLLATE utf8_bin OR target_lang = '$target_lang' AND  LEFT (gloss, 1) = 'á' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'Á' COLLATE utf8_bin OR target_lang = '$target_lang' AND  LEFT (gloss, 1) = 'à' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'À' COLLATE utf8_bin ORDER BY gloss";
          }elseif($first_letter == 'O'){
          $sql="SELECT * FROM senses WHERE target_lang = '$target_lang' AND LEFT (gloss, 1) = 'o' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'õ' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'O' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'Õ' COLLATE utf8_bin OR target_lang = '$target_lang' AND  LEFT (gloss, 1) = 'ó' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'Ó' COLLATE utf8_bin OR target_lang = '$target_lang' AND  LEFT (gloss, 1) = 'Ô' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'ô' COLLATE utf8_bin ORDER BY gloss";
          }elseif($first_letter == 'E'){
          $sql="SELECT * FROM senses WHERE target_lang = '$target_lang' AND LEFT (gloss, 1) = 'e' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'E' COLLATE utf8_bin OR target_lang = '$target_lang' AND  LEFT (gloss, 1) = 'é' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'É' COLLATE utf8_bin OR target_lang = '$target_lang' AND  LEFT (gloss, 1) = 'ê' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'Ê' COLLATE utf8_bin ORDER BY gloss";
          }elseif($first_letter == 'U'){
          $sql="SELECT * FROM senses WHERE target_lang = '$target_lang' AND LEFT (gloss, 1) = 'u' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'U' COLLATE utf8_bin OR target_lang = '$target_lang' AND  LEFT (gloss, 1) = 'ú' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'Ú' COLLATE utf8_bin ORDER BY gloss";
          }elseif($first_letter == 'I'){
          $sql="SELECT * FROM senses WHERE target_lang = '$target_lang' AND LEFT (gloss, 1) = 'i' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'I' COLLATE utf8_bin OR target_lang = '$target_lang' AND  LEFT (gloss, 1) = 'í' COLLATE utf8_bin OR target_lang = '$target_lang' AND LEFT (gloss, 1) = 'Í' COLLATE utf8_bin ORDER BY gloss";
          }elseif($first_letter == 'N'){
          $sql="SELECT * FROM senses WHERE target_lang = '$target_lang' AND LEFT (gloss, 1) = 'n' COLLATE utf8_bin ORDER BY gloss";
          }elseif($first_letter == 'Ñ'){
          $sql="SELECT * FROM senses WHERE target_lang = '$target_lang' AND LEFT (gloss, 1) = 'ñ' COLLATE utf8_bin ORDER BY gloss";
          }else{
        
          $sql="SELECT * FROM senses WHERE target_lang = '$target_lang' AND LEFT (gloss, 1)  = '$first_letter' ORDER BY gloss";
          }
        
          if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result)>0){
              $sense_id="";
              while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                if($sense_id!=$row["sense_id"]){
                  $sense_id=$row["sense_id"];
                  $sense_bundle_id=$row["sense_bundle_id"];
                  $gloss= $row["gloss"];
                  $entry_id = entry_id_reverse($sense_bundle_id);
      
      
                  ?>
                  <li id="<?php echo $sense_id; ?>" class="list-group-item list-group-item-action list-group-item-light border-0 entry_select  panel_s<?php echo "$target_lang"; ?>" value="<?php echo "$entry_id"; ?>"><?php echo "$gloss"; ?></li>
                  <?php
      
      
                    }else{
        
                    }
              }
              
      
              //close the result set
              mysqli_free_result($result);
            }else{
            }
          }else{
            echo "<p>Não foi possível executar: $sql. " . mysqli_error($link) ."</p>";
          }
      
      ?>
      </div>
  <?php

  ?>


  <script type='text/javascript' src="js/panel.js"></script>
    <?php


}




function alpha_panel($first_letter, $source_lang){
  include ('connection.php');
  include ('lang_check.php');


  ?>

  <label id="label_panel<?php echo $source_lang;?>" class="p-0" for="panel_s<?php echo $source_lang;?>"><b><?php if($source_lang==1){ echo $native_name_sl1;}elseif($source_lang==2){echo $native_name_sl2;}?></b></label>
  <div class="list-group list-group-flush pre-scrollable p-0" id="panel_s<?php echo $source_lang;?>" style="height: 6em; overflow-y: scroll;">
    <?php

            $link->set_charset("utf8");
          
            if($first_letter == 'A'){
              $sql="SELECT * FROM forms WHERE source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'ã' COLLATE utf8_bin OR source_lang = '$source_lang' AND  LEFT (vernacular, 1) = 'a' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'Ã' COLLATE utf8_bin OR source_lang = '$source_lang' AND  LEFT (vernacular, 1) = 'A' COLLATE utf8_bin OR source_lang = '$source_lang' AND  LEFT (vernacular, 1) = 'á' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'Á' COLLATE utf8_bin OR source_lang = '$source_lang' AND  LEFT (vernacular, 1) = 'à' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'À' COLLATE utf8_bin ORDER BY vernacular";
            }elseif($first_letter == 'O'){
            $sql="SELECT * FROM forms WHERE source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'o' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'õ' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'O' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'Õ' COLLATE utf8_bin OR source_lang = '$source_lang' AND  LEFT (vernacular, 1) = 'ó' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'Ó' COLLATE utf8_bin OR source_lang = '$source_lang' AND  LEFT (vernacular, 1) = 'Ô' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'ô' COLLATE utf8_bin ORDER BY vernacular";
            }elseif($first_letter == 'E'){
            $sql="SELECT * FROM forms WHERE source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'e' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'E' COLLATE utf8_bin OR source_lang = '$source_lang' AND  LEFT (vernacular, 1) = 'é' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'É' COLLATE utf8_bin OR source_lang = '$source_lang' AND  LEFT (vernacular, 1) = 'ê' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'Ê' COLLATE utf8_bin ORDER BY vernacular";
            }elseif($first_letter == 'U'){
            $sql="SELECT * FROM forms WHERE source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'u' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'U' COLLATE utf8_bin OR source_lang = '$source_lang' AND  LEFT (vernacular, 1) = 'ú' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'Ú' COLLATE utf8_bin ORDER BY vernacular";
            }elseif($first_letter == 'I'){
            $sql="SELECT * FROM forms WHERE source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'i' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'I' COLLATE utf8_bin OR source_lang = '$source_lang' AND  LEFT (vernacular, 1) = 'í' COLLATE utf8_bin OR source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'Í' COLLATE utf8_bin ORDER BY vernacular";
            }elseif($first_letter == 'N'){
            $sql="SELECT * FROM forms WHERE source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'n' COLLATE utf8_bin ORDER BY vernacular";
            }elseif($first_letter == 'Ñ'){
            $sql="SELECT * FROM forms WHERE source_lang = '$source_lang' AND LEFT (vernacular, 1) = 'ñ' COLLATE utf8_bin ORDER BY vernacular";
            }else{
          
            $sql="SELECT * FROM forms WHERE source_lang = '$source_lang' AND LEFT (vernacular, 1)  = '$first_letter' ORDER BY vernacular";
            }
          
            if($result = mysqli_query($link, $sql)){
              if(mysqli_num_rows($result)>0){
                $form_id="";
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                  if($form_id!=$row["form_id"]){
                    $form_id=$row["form_id"];
                    $form_bundle_id=$row["form_bundle_id"];
                    $vernacular= $row["vernacular"];
                    $entry_id = entry_id($form_bundle_id);
        
        
                    ?>
                      <li id="<?php echo $form_id; ?>" class="list-group-item list-group-item-action list-group-item-light border-0 entry_select panel_s<?php echo "$source_lang"; ?>" value="<?php echo "$entry_id"; ?>"><?php echo "$vernacular"; ?></li>
                    <?php
        
        
                      }else{
          
                      }
                }
                //close the result set
                mysqli_free_result($result);
              }else{
        
              }
            }else{
              echo "<p>Não foi possível executar: $sql. " . mysqli_error($link) ."</p>";
            }
            
        

          ?>
          </div>

    <script type='text/javascript' src="js/panel.js"></script>
      <?php

}





function search_text_panel_ordered($search, $source_lang){
  include ('connection.php');

  
  $mdarray = array();
  $count=0;


  if(!empty($search)) {

  $sql = "SELECT * FROM forms WHERE ((source_lang = '$source_lang' AND vernacular LIKE '$search%') OR (source_lang = '$source_lang' AND vernacular LIKE '%$search'))";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result)>0){
      $form_id="";
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if($form_id!=$row["form_id"]){
          $form_id=$row["form_id"];
          $form_bundle_id=$row["form_bundle_id"];
          $vernacular= $row["vernacular"];
          $entry_id = entry_id($form_bundle_id);

          $zero_col=$count;
          $mdarray[$zero_col] = array("vernacular" => $vernacular, "entry_id" => $entry_id, "form_id" => $form_id);
          $count++;


    

  }else{
    
  }
  }





  //close the result set
  mysqli_free_result($result);
  }else{
  //echo "<p>Não foram encontrados resultados para a busca.</p>";
  }
  }else{
  echo "<p>Não foi possível executar: $sql. " . mysqli_error($link) ."</p>";
  }


  ?>

  <?php

  }
  return $mdarray;

}



function search_text_panel ($search, $source_lang){
  include ('connection.php');
  include ('lang_check.php');


  $mdarray_end = search_text_panel_ordered ($search, $source_lang);

  ?>

  <label id="label_panel<?php echo $source_lang;?>" class="p-0" for="panel_s<?php echo $source_lang;?>"><b><?php if($source_lang==1){ echo $native_name_sl1;}elseif($source_lang==2){echo $native_name_sl2;}?></b></label>
  <div class="list-group list-group-flush pre-scrollable p-0" size="4" id="panel_s<?php echo $source_lang;?>" style="height: 6em; overflow-y: scroll;">

  <?php




  if (!empty($mdarray_end)){

    asort($mdarray_end);
    $mdarray_orded = array_values($mdarray_end);

    

    for ($i = 0; $i < count($mdarray_end); $i++){
      $vernacular = $mdarray_orded[$i]["vernacular"];
      $entry_id = $mdarray_orded[$i]["entry_id"];
      $form_id = $mdarray_orded[$i]["form_id"];
      
      
    ?>
    <li id="<?php echo $form_id; ?>" class="list-group-item list-group-item-action list-group-item-light border-0 entry_select panel_s<?php echo "$source_lang"; ?>" value="<?php echo "$entry_id"; ?>"><?php echo "$vernacular"; ?></li>

    <?php

      }

    


  }else{

  }
  ?>

  </div>
  <script type='text/javascript' src="js/panel.js"></script>

    <?php


    
}

function search_text_panel_reverse($search, $target_lang){

  
  include ('connection.php');
  include ("lang_check.php");


  $mdarray_end = search_text_panel_reverse_ordered($search, $target_lang);

  ?>
  <label id="label_panel<?php echo $target_lang;?>" for="panel_s<?php echo $target_lang;?>"><b><?php if($target_lang==1){ echo $native_name_tl1;}elseif($target_lang==2){echo $native_name_tl2;}?></b></label>
  <div class="list-group list-group-flush pre-scrollable p-0" size="4" id="panel_s<?php echo $target_lang;?>" style="height: 6em; overflow-y: scroll;">

  <?php


    if (!empty($mdarray_end)){

      asort($mdarray_end);
      $mdarray_orded = array_values($mdarray_end);

      

      for ($i = 0; $i < count($mdarray_end); $i++){
        $gloss = $mdarray_orded[$i]["gloss"];
        $entry_id = $mdarray_orded[$i]["entry_id"];
        $sense_id = $mdarray_orded[$i]["sense_id"];
        
        
      ?>
      <li id="<?php echo $sense_id; ?>" class="list-group-item list-group-item-action list-group-item-light border-0 entry_select  panel_s<?php echo "$target_lang"; ?>" value="<?php echo "$entry_id"; ?>"><?php echo "$gloss"; ?></li>

      <?php

        }

      


    }else{

    }

    
    ?>

    </div>
    <script type='text/javascript' src="js/panel.js"></script>


  <?php


}



function search_text_panel_reverse_ordered($search, $target_lang){
  include ('connection.php');

  
  $mdarray = array();
  $count=0;


  if(!empty($search)) {

  $sql = "SELECT * FROM senses WHERE ((target_lang = '$target_lang' AND gloss LIKE '$search%') OR (target_lang = '$target_lang' AND gloss LIKE '%$search'))";

  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result)>0){
      $sense_id="";
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if($sense_id!=$row["sense_id"]){
          $sense_id=$row["sense_id"];
          $sense_bundle_id=$row["sense_bundle_id"];
          $gloss= $row["gloss"];
          $entry_id = entry_id_reverse($sense_bundle_id);
          $zero_col=$count;
          $mdarray[$zero_col] = array("gloss" => $gloss, "entry_id" => $entry_id, "sense_id" => $sense_id);
          $count++;

    

  }else{
    
  }
  }





  //close the result set
  mysqli_free_result($result);
  }else{
  //echo "<p>Não foram encontrados resultados para a busca.</p>";
  }
  }else{
  echo "<p>Não foi possível executar: $sql. " . mysqli_error($link) ."</p>";
  }


  ?>

  <?php

  }
  return $mdarray;

}








function find_entries_by_class($class_id, $source_lang){

  include ('connection.php');

  $mdarray = array();
  $count=0;




  $sql="SELECT * FROM classes WHERE class_id = '$class_id'";
  $vernacular = ""; 
  $entry_id = "";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result)>0){
      $sense_bundle_id="";
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if($sense_bundle_id!=$row["sense_bundle_id"]){
          $sense_bundle_id=$row["sense_bundle_id"];
          $class_id=$row["class_id"];
          $class_name_ref=$row["class_name_ref"];
         


          $sql2="SELECT * FROM sense_bundles WHERE sense_bundle_id = '$sense_bundle_id'";

          if($result2 = mysqli_query($link, $sql2)){
            if(mysqli_num_rows($result2)>0){
              $entry_id="";
              while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                if($entry_id!=$row["entry_id"]){
                  $entry_id=$row["entry_id"];

                  $sql3="SELECT * FROM form_bundles WHERE entry_id = '$entry_id'";

          if($result3 = mysqli_query($link, $sql3)){
            if(mysqli_num_rows($result3)>0){
              $form_bundle_id="";
              while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                if($form_bundle_id!=$row["form_bundle_id"]){
                  $form_bundle_id=$row["form_bundle_id"];

        

                  $sql4="SELECT * FROM forms WHERE source_lang = '$source_lang' AND form_bundle_id = '$form_bundle_id' ORDER BY vernacular";

                  if($result4 = mysqli_query($link, $sql4)){
                    if(mysqli_num_rows($result4)>0){
                      $form_id="";
                      while($row = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                        if($form_id!=$row["form_id"]){
                          $form_id=$row["form_id"];
                          $vernacular=$row["vernacular"];
                          $zero_col=$count;
                          $mdarray[$zero_col] = array("vernacular" => $vernacular, "entry_id" => $entry_id, "form_id" => $form_id);
                          $count++;
              
                
                
                            }else{
                
                            }
                      }


                      //close the result set
                      mysqli_free_result($result4);
                    }else{
                      //echo "<p>Não foram encontrados resultados para a busca3.</p>";
                    }


                  }else{
                    echo "<p>Não foi possível executar: $sql4. " . mysqli_error($link) ."</p>";
                  }
                


              
        
                    }else{
        
                    }
              }
              //close the result set
              mysqli_free_result($result3);
            }else{
              echo "<p>Não foram encontrados resultados para a busca.</p>";
            }
          }else{
            echo "<p>Não foi possível executar: $sql3. " . mysqli_error($link) ."</p>";
          }




        
                    }else{
        
                    }
              }
              //close the result set
              mysqli_free_result($result2);
            }else{
              echo "<p>Não foram encontrados resultados para a busca.</p>";
            }
          }else{
            echo "<p>Não foi possível executar: $sql2. " . mysqli_error($link) ."</p>";
          }




            }else{

            }


      }
      //close the result set
      mysqli_free_result($result);
    }else{
      echo "<p>Não foram encontrados resultados para a busca.</p>";
    }
  }else{
    echo "<p>Não foi possível executar: $sql. " . mysqli_error($link) ."</p>";
  }
  return $mdarray;



}


function class_panel($class_id, $source_lang){
  include ('connection.php');
  include ('lang_check.php');


  ?>

  <label id="label_panel<?php echo $source_lang;?>" class="p-0" for="panel_s<?php echo $source_lang;?>"><b><?php if($source_lang==1){ echo $native_name_sl1;}elseif($source_lang==2){echo $native_name_sl2;}?></b></label>
  <div class="list-group list-group-flush pre-scrollable p-0"id="panel_s<?php echo $source_lang;?>" style="height: 6em; overflow-y: scroll;">
    <?php

      $link->set_charset("utf8");

      $mdarray_end = find_entries_by_class($class_id, $source_lang);




      if (!empty($mdarray_end)){
    
        asort($mdarray_end);
        $mdarray_orded = array_values($mdarray_end);
    
        
    
        for ($i = 0; $i < count($mdarray_end); $i++){
          $vernacular = $mdarray_orded[$i]["vernacular"];
          $entry_id = $mdarray_orded[$i]["entry_id"];
          $form_id = $mdarray_orded[$i]["form_id"];
          
          
        ?>
        <li id="<?php echo $form_id; ?>" class="list-group-item list-group-item-action list-group-item-light border-0 entry_select panel_s<?php echo "$source_lang"; ?>" value="<?php echo "$entry_id"; ?>"><?php echo "$vernacular"; ?></li>
    
      <?php
    
          }
    
        
    
    
      }else{
    
      }
        ?>
  </div>
    <?php
  ?>


  <script type='text/javascript' src="js/panel.js"></script>
    <?php


}








function find_entries_by_class_reverse($class_id, $target_lang){

  include ('connection.php');

  $mdarray = array();
  $count=0;




  $sql="SELECT * FROM classes WHERE class_id = '$class_id'";
  $gloss = ""; 
  $entry_id = "";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result)>0){
      $sense_bundle_id="";
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if($sense_bundle_id!=$row["sense_bundle_id"]){
          $sense_bundle_id=$row["sense_bundle_id"];

          $sql2="SELECT * FROM sense_bundles WHERE sense_bundle_id = '$sense_bundle_id'";

          if($result2 = mysqli_query($link, $sql2)){
            if(mysqli_num_rows($result2)>0){
              $entry_id="";
              while($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
                if($entry_id!=$row["entry_id"]){
                  $entry_id=$row["entry_id"];
        
                  $sql3="SELECT * FROM senses WHERE sense_bundle_id = '$sense_bundle_id' AND target_lang = '$target_lang'";
        
          if($result3 = mysqli_query($link, $sql3)){
            if(mysqli_num_rows($result3)>0){
              $sense_id="";
              while($row = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                if($sense_id!=$row["sense_id"]){
                  $sense_id=$row["sense_id"];
                  $gloss=$row["gloss"];
                  $zero_col=$count;
                  $mdarray[$zero_col] = array("gloss" => $gloss, "entry_id" => $entry_id, "sense_id" => $sense_id);
                  $count++;
          
        
        
        
              
        
                    }else{
        
                    }
              }
              //close the result set
              mysqli_free_result($result3);
            }else{
              echo "<p>Não foram encontrados resultados para a busca.</p>";
            }
          }else{
            echo "<p>Não foi possível executar: $sql3. " . mysqli_error($link) ."</p>";
          }
        
        
        
        
        
                    }else{
        
                    }
              }
              //close the result set
              mysqli_free_result($result2);
            }else{
              echo "<p>Não foram encontrados resultados para a busca.</p>";
            }
          }else{
            echo "<p>Não foi possível executar: $sql2. " . mysqli_error($link) ."</p>";
          }

            }else{

            }


      }
      //close the result set
      mysqli_free_result($result);
    }else{
      echo "<p>Não foram encontrados resultados para a busca.</p>";
    }
  }else{
    echo "<p>Não foi possível executar: $sql. " . mysqli_error($link) ."</p>";
  }
  return $mdarray;



}




function class_panel_class_reverse ($class_id, $target_lang){
  include ('connection.php');


  $mdarray_end = find_entries_by_class_reverse($class_id, $target_lang);



  if (!empty($mdarray_end)){

    asort($mdarray_end);
    $mdarray_orded = array_values($mdarray_end);

    

    for ($i = 0; $i < count($mdarray_end); $i++){
      $gloss = $mdarray_orded[$i]["gloss"];
      $entry_id = $mdarray_orded[$i]["entry_id"];
      $sense_id = $mdarray_orded[$i]["sense_id"];
      
      
    ?>
    <li id="<?php echo $sense_id; ?>" class="list-group-item list-group-item-action list-group-item-light border-0 entry_select  panel_s<?php echo "$target_lang"; ?>" value="<?php echo "$entry_id"; ?>"><?php echo "$gloss"; ?></li>
    <?php

      }

    


  }else{

  }

  

} 

function class_panel_default_reverse ($target_lang){
  include ('connection.php');


  $mdarray_end = find_entries_by_class_reverse(2, $target_lang);


  if (!empty($mdarray_end)){

    asort($mdarray_end);
    $mdarray_orded = array_values($mdarray_end);

    

    for ($i = 0; $i < count($mdarray_end); $i++){
      $gloss = $mdarray_orded[$i]["gloss"];
      $entry_id = $mdarray_orded[$i]["entry_id"];
      $sense_id = $mdarray_orded[$i]["sense_id"];
      
      
      ?>
          <li id="<?php echo $sense_id; ?>" class="list-group-item list-group-item-action list-group-item-light border-0 entry_select  panel_s<?php echo "$target_lang"; ?>" value="<?php echo "$entry_id"; ?>"><?php echo "$gloss"; ?></li>
      <?php
  


      }

    


  }else{

  }

}


function class_panel_reverse($class_id, $target_lang){
  include ('connection.php');
  include ('lang_check.php');


  ?>

  <label id="label_panel<?php echo $target_lang;?>" for="panel_s<?php echo $target_lang;?>"><b><?php if($target_lang==1){ echo $native_name_tl1;}elseif($target_lang==2){echo $native_name_tl2;}?></b></label>
  <div class="list-group list-group-flush pre-scrollable p-0" size="4" id="panel_s<?php echo $target_lang;?>" style="height: 6em; overflow-y: scroll;">
  <?php



      $link->set_charset("utf8");

      if(!empty($class_id)){


        class_panel_class_reverse($class_id, $target_lang);



      }else{
        
        class_panel_default_reverse($target_lang);

    }
  ?>
    </div>
  <?php
    ?>


  <script type='text/javascript' src="js/panel.js"></script>
    <?php


}







?>


