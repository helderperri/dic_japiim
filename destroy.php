<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}




$dic_name = "";

include ("connection.php");
//include ("config_functions.php");


setcookie('user_sub', '', time() - 60*100000, '/'); // empty value and old timestamp
setcookie('name', '', time() - 60*100000, '/'); // empty value and old timestamp
setcookie('picture', '', time() - 60*100000, '/'); // empty value and old timestamp
//unset($_COOKIE['name']);
//unset($_COOKIE['user_sub']);
//unset($_COOKIE['picture']);



unset($_SESSION['logout_source']);

unset($_SESSION['config_search_'.$dic_name]);
unset($_SESSION['config_sls_'.$dic_name]);
unset($_SESSION['config_tls_'.$dic_name]);



unset($_SESSION['accessToken']);
unset($_SESSION['email']);
unset($_SESSION['name']);
unset($_SESSION['family_name']);
unset($_SESSION['given_name']);
//        $_SESSION['locale'] = $user_data['locale'];
unset($_SESSION['user_sub']);
//      $_SESSION['client_id'] = $user_data['client_id'];
//      $_SESSION['issuer'] = $user_data['iss'];
//      $_SESSION['expires_at'] = $user_data['exp'];
//     $_SESSION['issued_at'] = $user_data['iat'];
//    $_SESSION['email_verified'] = $user_data['email_verified'];
unset($_SESSION['picture']);
unset($_SESSION['user_data']);
//$_SESSION['gmail'] = 0;
unset($_SESSION['signup_message']);
unset($_SESSION['gmail']);

session_destroy();
header("Location: index.php");
die();
