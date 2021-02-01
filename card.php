<?php
//require_once ('functions_search_panel.php'); 
//require_once ('functions_lang_info.php');
//require_once ('functions_others.php'); 


//if  (isset($_POST['dic_name'])){
  //$dic_name = $_POST['dic_name'];
  //$_SESSION['dic_name'] = $dic_name;

//}else{
  //$_SESSION['dic_name'] = $dic_name;
//}

$dic_name = "";


//$_SESSION['config_search_guato'] = array();
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

include ("connection.php");


if(!isset($_SESSION['config_search_'.$dic_name])){
  include ("config_session.php");
//$_SESSION['config_search_'.$dic_name] = array();
}


//$_SESSION['login_source'] = $dic_name;  
//$_SESSION['login_google'] = "";    



    $config_search= $_SESSION['config_search_'.$dic_name][0];
    $mode = $config_search['mode'];   



$source_langs_info = $_SESSION['config_sls_'.$dic_name];
$target_langs_info = $_SESSION['config_tls_'.$dic_name];

/*
$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
$_SESSION['loginTime'] = date("Y-m-d h:i:s");
$ip = $_SESSION['ip'];
$loginTime = $_SESSION['loginTime'];
*/


/*
if(!isset($_POST['mode'])){

  $config_search= $_SESSION['config_search_'.$dic_name][0];
  $mode = $config_search['mode'];   

    }else{
      $mode = $_POST['mode'];
      $_SESSION['config_search_'.$dic_name][0]['mode'] = $mode; 
} 
*/
$entry_bundle_id = "";

if(isset($_SESSION["new_entry_update"])){


    $entry_bundle_id = $_SESSION["entry_bundle_id"];
    
    unset($_SESSION["new_entry_update"]);
    unset($_SESSION["entry_bundle_id"]);
  
}








?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <meta name='viewport' content='width=device-width, initial-scale= 1'>
      <title>
        <?php 
      echo implode('-', array_column($source_langs_info, 'native_name'));
      ?>
      </title>
      
      <!-- You can use Open Graph tags to customize link previews.
Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
<meta property="og:url"           content="https://japiim.linguasyanomami.com/dic/<?php echo $dic_name;?>/card.php" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content= "Dicionário <?php echo implode('-', array_column($source_langs_info, 'native_name'));?> | ProDoclin | Museu do Índio" />
<meta property="og:description"   content="Conheça o Léxico das Línguas Indígenas do Brasil" />
<meta property="og:image"         content="https://www.linguasyanomami.com/japiim/dic/<?php echo $dic_name;?>/assets/cards/card_0003.png" />

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
<!--
   <div id="fb-root"></div>
                <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.0";
                fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
            -->
      <!-- Your share button code -->
      <!--
      <div id="card" class="fb-share-button" 
      data-href="https://japiim.linguasyanomami.com/dic/<?php echo $dic_name;?>/card.php" 
      data-layout="button">
      </div>

            -->
            <button id="card" class="my_own" type="button" onclick="share();">Lets share</button>

    <script>
        function share() {
    FB.ui({
        method: 'share',
        href: 'https://japiim.linguasyanomami.com/dic/<?php echo $dic_name;?>/card.php',
    }, function(response){});
    }
            console.log("oi");
        $("#card").trigger("click");
        //$('.fb-share-button').trigger('click');
    </script>

</body>


</html>