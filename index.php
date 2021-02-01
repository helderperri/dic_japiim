<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$dic_name = "";

include ("connection.php");
//include ("config_functions.php");

$user_sub = "";

if(isset($_SESSION["user_sub"])){

  $user_sub = $_SESSION["user_sub"];


  }else{

    if(isset($_COOKIE["user_sub"])){

    $user_sub = $_COOKIE["user_sub"];
    $username = $_COOKIE['name'];
    $user_picture = $_COOKIE['picture'];
    $_SESSION['user_sub'] = $user_sub;
    $_SESSION['name'] = $username;
    $_SESSION['picture'] = $user_picture;




    }
}

function logged_in(){
  if(isset($_SESSION["user_sub"])){
      return true;
    //$user_sub = $_SESSION["user_sub"];
  
  }elseif(isset($_COOKIE["user_sub"])){
    return true;
  }else{

    

  
      return false;
   

}
  
  }

if(logged_in()){

  

    include ("config_session_users.php");


  

}else{

  $user_sub ="";
  
  if(!isset($_SESSION['config_search_'.$dic_name])){
  
    include ("config_session.php");

  //$_SESSION['config_search_'.$dic_name] = array();
  }

  $_SESSION['config_search_'.$dic_name][0]['mode'] = 1; 


}


/*
if(isset($_COOKIE["user_sub"])){

  $user_sub = $_COOKIE["user_sub"];
  $username = $_COOKIE['name'];
  $user_picture = $_COOKIE['picture'];
  $_SESSION['user_sub'] = $user_sub;
  $_SESSION['name'] = $username;
  $_SESSION['picture'] = $user_picture;


  }



if(!isset($_SESSION['config_search_'.$dic_name])){
  
  include ("config_session.php");
//$_SESSION['config_search_'.$dic_name] = array();
}
*/


//$_SESSION['login_source'] = $dic_name;  
//$_SESSION['login_google'] = "";    




/*
$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
$_SESSION['loginTime'] = date("Y-m-d h:i:s");
$ip = $_SESSION['ip'];
$loginTime = $_SESSION['loginTime'];
*/

$config_search= $_SESSION['config_search_'.$dic_name][0];
$mode = $config_search['mode'];   
$entry_bundle_id = $config_search['entry_bundle_id'];
$btn_id = $config_search['btn_id'];


$source_langs_info = $_SESSION['config_sls_'.$dic_name];
$target_langs_info = $_SESSION['config_tls_'.$dic_name];





if(isset($_POST['entry_bundle_id'])){


  $entry_bundle_id = $_POST['entry_bundle_id'];
  $_SESSION['config_search_'.$dic_name][0]['entry_bundle_id'] =  $entry_bundle_id;

}





if(isset($_POST['mode'])){

  $mode = $_POST['mode'];
  $_SESSION['config_search_'.$dic_name][0]['mode'] = $mode; 
} 



if(isset($_SESSION['new_entry_update'])){


  $entry_bundle_id = $_SESSION['config_search_'.$dic_name][0]['entry_bundle_id'];
  
  unset($_SESSION['new_entry_update']);
  //unset($_SESSION['entry_bundle_id']);

}

if(isset($_GET["entry"])){

  $entry_bundle_id = $_GET["entry"];
  $_SESSION['config_search_'.$dic_name][0]['entry_bundle_id'] = $entry_bundle_id;

}

  
if(isset($_GET["lang"])){

  $lang = $_GET["lang"];





    foreach($target_langs_info as $target_lang_info){


      $lang_code = $target_lang_info["lang_code"];
      $lang_number = $target_lang_info["target_lang"];
      $display = 0;

      if($lang_code == $lang){

        $display = 1;



      }else{
        $display = 0;

      }

      $_SESSION['config_tls_'.$dic_name][$lang_number-1]["class"] = $display;
      $_SESSION['config_tls_'.$dic_name][$lang_number-1]["gloss"] = $display;
      $_SESSION['config_tls_'.$dic_name][$lang_number-1]["def"] = $display;
      $_SESSION['config_tls_'.$dic_name][$lang_number-1]["example_translation"] = $display;
      $_SESSION['config_tls_'.$dic_name][$lang_number-1]["semantic"] = $display;
      $_SESSION['config_tls_'.$dic_name][$lang_number-1]["comments"] = $display;
      $_SESSION['config_tls_'.$dic_name][$lang_number-1]["lang_code_display"] = 0;
      $_SESSION['config_tls_'.$dic_name][$lang_number-1]["image_caption"] = $display;
      $_SESSION['config_tls_'.$dic_name][$lang_number-1]["video_caption"] = $display;


    }

  
  


}


/*
if(!isset($_SESSION['entry_bundle_id'])){


  $_SESSION['entry_bundle_id'] = 0;
  

}
*/

//$entry_bundle_id = $_SESSION['config_search_'.$dic_name][0]['entry_bundle_id'];



?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <meta name='viewport' content='width=device-width, initial-scale= 1'>
      <title>
         <?php echo implode('-', array_column($source_langs_info, 'native_name'));?>
      </title>


   
      
      <meta property="og:url"           content="https://japiim.linguasyanomami.com/dic/<?php echo $dic_name; ?>/index.php?entry=<?php echo $entry_bundle_id; ?>&rand=<?php echo(rand(100000,999999)); ?>" />
      <meta property="og:type"          content="website" />
      <meta property="og:title"         content="Dicionário <?php echo implode('-', array_column($source_langs_info, 'native_name'));?> | Portal Japiim | ProDoclin" />
      <meta property="og:description"   content="Conheça o Léxico das Línguas Indígenas do Brasil" />
      <meta property="og:image"         content="card_maker.php?entry=<?php echo $entry_bundle_id; ?>&rand=<?php echo(rand(100000,999999)); ?>"/>

      <meta property="fb:app_id" content="243857410489950">
      <!--

        <meta property="og:video" content="https://japiim.linguasyanomami.com/dic/<?php echo $dic_name; ?>/assets/audio/palavra0001.mp3">
        <meta property="og:video:secure_url" content="https://japiim.linguasyanomami.com/dic/<?php echo $dic_name; ?>/assets/audio/palavra0001.mp3">
        <meta property="og:video:type" content="video/mp4">
        <meta property="og:video:width" content="480">
        <meta property="og:video:height" content="50">


      <meta property="og:type" content="video.movie">

      <meta property="fb:app_id" content="1234567890987654321">
        <meta property="fb:admins" content="9876543210,1234567">



      <meta property="og:audio" content="https://japiim.linguasyanomami.com/dic/<?php echo $dic_name; ?>/assets/audio/palavra0001.mp3" />
      <meta property="og:audio:secure_url" content="https://japiim.linguasyanomami.com/dic/<?php echo $dic_name; ?>/assets/audio/palavra0001.mp3" />
      <meta property="og:audio:type" content="music.song" />
      -->



      <meta name="twitter:card" content="summary_large_image">
      <!--<meta name="twitter:site" content="@site_username">-->
      <meta name="twitter:title" content="Dicionário <?php echo implode('-', array_column($source_langs_info, 'native_name'));?> | Portal Japiim | ProDoclin">
      <meta name="twitter:description" content="Conheça o Léxico das Línguas Indígenas do Brasil">
      <!--<meta name="twitter:creator" content="@creator_username">-->
      <meta name="twitter:image" content="https://japiim.linguasyanomami.com/dic/<?php echo $dic_name; ?>/card_maker.php?entry=<?php echo $entry_bundle_id; ?>">
      <meta name="twitter:domain" content="https://japiim.linguasyanomami.com/dic/<?php echo $dic_name; ?>/index.php?entry=<?php echo $entry_bundle_id; ?>&rand=<?php echo(rand(100000,999999)); ?>">



      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link href='css/styling.css' rel='stylesheet'>
      <link href="https://fonts.googleapis.com/css?family=Arvo&display=swap" rel="stylesheet">

      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Add icon library -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--
      <link rel="manifest" href="/site.webmanifest">
-->
      <link rel="apple-touch-icon" sizes="180x180" href="icons/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="icons/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="16x16" href="icons/favicon-16x16.png">
      <link rel="mask-icon" href="icons/safari-pinned-tab.svg" color="#da532c">
      <meta name="msapplication-TileColor" content="#d82b5f">
      <meta name="theme-color" content="#ffffff">
      <link rel="stylesheet" href="css/magnific-popup.css">

      <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
        crossorigin="anonymous"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
            
      <!-- Magnific Popup core JS file -->
<script src="js/jquery.magnific-popup.js"></script>

<!--Video.js-->

<link href="https://vjs.zencdn.net/7.8.4/video-js.css" rel="stylesheet" />

</head>

<body>
<div id="fb-root"></div>
    
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_PT/sdk.js#xfbml=1&version=v9.0" nonce="okx26vXZ"></script>
<!--
<script>
   (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "https://connect.facebook.net/pt_PT/sdk.js#xfbml=1&version=v9.0";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

     window.fbAsyncInit = function(){  // this gets triggered when FB object gets initialized
            console.log("FB Object initiated");
            FB.XFBML.parse(); // now we can safely call parse method
       };

</script>
      -->
        <nav role='navigation' class='navbar navbar-expand-md navbar-toggleable-sm navbar-dark navbar-custom fixed-top'>

                  
          <a class='navbar-brand' style="font-size:0.9em;" href="#">Dicion&#225;rio <?php echo implode('-', array_column($_SESSION['config_sls_'.$dic_name], 'native_name'));?>
      </a>

          <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          
              <span class="navbar-toggler-icon"></span>
          
            </button>
          
          
          
            <div class="collapse navbar-collapse" id="navbarCollapse">
          

              <?php
                  $is_hidden = "";
                  if($mode==2){
                    $edit_is_hidden = "none";
                    $view_is_hidden = "block";
                  }elseif($mode==1){
                    $edit_is_hidden = "block";
                    $view_is_hidden = "none";
                  };


                  if(isset($_SESSION["name"])){
       
              ?>

                         <ul class='navbar-nav mt-0 mt-lg-0'>
          
                          <li class="nav-item" id="edit_mode_div" style="display:<?php echo $edit_is_hidden;?>;">
                          <form action="index.php" method="post" hidden>
                          <input type="text" id="modeEditEntryBundleId" value="<?php echo $entry_bundle_id; ?>" name="entry_bundle_id" >
                          <input type="text" name="mode" value="2" >
                          <input type="submit" class="nav-link" id="mode_2_submit" >
                          </form>
                          <a id="edit_mode" display_mode="2" class="nav-link" href="#">Editar</a>
                            <!--
                          -->
                          </li>
                         </ul>
                          <ul class='navbar-nav mt-0 mt-lg-0'>
              <?php

                  }
              ?>
                          <li class="nav-item" id="view_mode_div" style="display:<?php echo $view_is_hidden;?>;">
                          <form action="index.php" method="post" hidden>
                          <input type="text" id="modeViewEntryBundleId" value="<?php echo $entry_bundle_id; ?>" name="entry_bundle_id">
                          <input type="text" name="mode" value="1" >
                          <input type="submit" class="nav-link" id="mode_1_submit" >
                          </form>
                            <a id="view_mode" display_mode="1" class="nav-link" href='#'>Publicar</a>
                          </li>

                          <?php
                          if(isset($_SESSION["name"])){

                          ?>
                       

                       <li class="nav-item" id="new_entry_mode_div" style="display:<?php echo $view_is_hidden;?>;">
                            <a id="new_entry_nav" class="nav-link" href='#' data-toggle="modal" data-target="#create_new_entry_modal">Nova entrada</a>
                          </li>

                          <?php

                          
                           }
                          ?>
                         </ul>
  
                          <ul class="nav navbar-nav ml-auto mt-0 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <small>Configuração da Pesquisa</small>
                                </a>
                                <ul class="dropdown-menu pre-scrollable" aria-labelledby="navbarDropdownMenuLink">
                                        <?php
                        
                                                  include ("buttons_lang_type.php");
                                      
                                                  ?>
                                        <li>   
                                          <?php
                                
                                                  include ("buttons_search_type.php");
                              
                                        ?>
                                        </li>

                                    </ul>
                                  </li>



                                  
                                </ul>

                                
                            </li>
                          </ul>
          <?php
                  $is_hidden = "";
                  if($mode==2){
                    $is_hidden = "none";
                   }elseif($mode==1){
                    $is_hidden = "block";
                   
                  };
          ?>
                          <ul class="nav navbar-nav mt-0 mt-lg-0" id="display_config_nav" style="display:<?php echo $is_hidden; ?>">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <small>Configuração dos Resultados</small> 
                                </a>

                                <ul class="dropdown-menu pre-scrollable" aria-labelledby="navbarDropdownMenuLink2">
                                      

                                        <?php
                                        include ("entry_display_setup.php");
                                        ?>




                                    </ul>
                                  </li>
                                </ul>
             <?php
             
                                
        //if(isset($_SESSION["accessToken"]) or isset($_POST["otherToken"])){
                        if(isset($_SESSION["name"])){
                          //$username = "nome";
                          //$user_picture = "picture";
                          $username = $_SESSION['name'];
                          $user_picture = $_SESSION['picture'];
                        ?>
                        



                        <ul class="nav navbar-nav mt-0 mt-lg-0">
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="user_nav" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <img src="<?php echo $user_picture;?>" width="25" height="25" class="rounded-circle">
                                  <?php echo $username;?></a>

                                <ul class="dropdown-menu" aria-labelledby="user_nav">                           

                                    <li class="nav-item dropdown-item login-link"><a class="login-link" ref='secure.php' href="javascript:void(0)">Conta</a></li>
                                    <li class="nav-item dropdown-item login-link"><a class="login-link" ref='secure.php' href="javascript:void(0)">Notificações</a></li>
                                    <li class="nav-item dropdown-item login-link"><a class="login-link" ref='secure.php' href="javascript:void(0)">Palavras</a></li>
                                    
                                    <div class="dropdown-divider"></div>
                                    
                                    <li class="nav-item dropdown-item login-link"><a class="login-link" id="logout_link" dic_name="<?php echo $dic_name; ?>" href='#'>Sair</a></li>
    
    
    
                                </ul>

                                  </li>
                                </ul>





                        <?php


                    }else{
                        ?>
                        <ul class="nav navbar-nav mt-0 mt-lg-0">
                        <li class="nav-item order-1 order-lg-4" ><a id="login_link" class="nav-link js-scroll-trigger" href="#" data-toggle="modal" data-target="#login_modal">Entrar</a></li>
                        <!--
                        <li class="nav-item order-1 order-lg-4"><a id="register_link" class="nav-link js-scroll-trigger" href="#">Cadastro</a></li>
                        -->
                        </ul>
                        <?php
                        
                    }
          ?>
          
          </li>
        </ul>
      </div>
          
        </nav>

        <script>
$(document).ready(function(){
  $('.dropdown-submenu a.item-link').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>

        <div class="d-flex flex-wrap flex-md-nowrap flex-lg-nowrap flex-xl-nowrap align-items-start align-items-sm-baseline flex-row flex-md-row flex-lg-row flex-sm-column col-12 col-sm-12 col-md-12 col-xl-14 bd-highlight ml-1 mb-3"  style="width: auto; padding:0em; margin:auto; margin-top: 4em; max-width: 600px;">


            <div class="d-flex p-0 flex-column col-12 col-sm-12 col-md-4 col-lg-5 col-lg-5 m-0">

                    <!-- BEGINING SEARCH BUTTONS -->
                    <div class="form-group mb-0"  id="buttons_keys">

                                       
                        <?php
                        
                        include("buttons_keys.php");
            
                        ?>
                    </div>            
                    <!-- END SEARCH BUTTONS -->

                    <div id="mode_div" display_mode="<?php echo $mode;?>" hidden></div>

                    <!-- BEGINING SEARCH ALPHABETIC PANEL - SOURCE LANG = 1 -->
                    <div id="panel_all_div" class="form-group mb-0 panel_all m-0">
                    <?php
                      include ("panel_search.php");
                    ?>

                    </div>
                  </div>
                    <!-- END SEARCH ALPHABETIC PANEL - SOURCE LANG = 2 -->



                
            <div class="d-flex p-0 flex-column col-12 col-sm-12 col-md-9 col-lg-10 col-xl-10 m-0 w-100"  id="entry_display">
              <?php
              if(!empty($entry_bundle_id)){

              if($mode==1){
                include ("panel_entry_display.php");


              }elseif($mode==2){
                include ("panel_entry_display_edit.php");

              }
            }
              ?>
            
                   


            </div>



        
        </div>
            
          

<!--
    <script type='text/javascript' src="js/entry_display_setup.js"></script>
-->
    <script type='text/javascript' src="js/panel_btn.js"></script>
    <script type='text/javascript' src="js/search_text.js"></script>
    <script type='text/javascript' src="js/searchtype.js"></script>
    <script type='text/javascript' src="js/langtype.js"></script>
    <script type='text/javascript' src="js/langtype_search.js"></script>
    <script type='text/javascript' src="js/langchoice.js"></script>
    <script type='text/javascript' src="js/display_mode.js"></script>
    <script type='text/javascript' src="js/entry_select.js"></script>

    <script>
      
      $("#logout_link").click(function(){
      var logout_session=1
      var logout_source = $(this).attr("dic_name");
      var redirect_link = "../../logout.php";
      var process_link = "../../logout_config.php";
      var dic_name = $(this).attr("dic_name");
      $.ajax({
        url:process_link,
        data:{logout_source:logout_source, dic_name:dic_name},
        type: 'POST',
        success: function(data){
            if(!data.error){
              window.location.href = redirect_link;
            }
        }

      })

      })
        
    </script>

    <?php

include ("entry_display_setup_js.php");

?>


<div id="new_entry_nav_modal">
      <?php

        //if(isset($_SESSION["accessToken"])){

          include ("nav_new_entry.php");


          
          include ("login.php");
          ?>
        


              <!--<script type='text/javascript' src="js/create_new_entry.js"></script>
                -->
      <?php
       // }
      ?>
</div>

<div id="reload_entry_display_setup_js">

<?php include ("new_entry_nav_js.php"); ?>


</div>
</body>
</html>