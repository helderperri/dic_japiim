<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$dic_name = "guato";

$dsn = "mysql:host=localhost;dbname=linguasy_$dic_name;port=3306;chartset=utf8";
//$dsn = "mysql:host=localhost;dbname=$dic_name;port=3306;chartset=utf8";

$opt = [

    PDO::ATTR_ERRMODE               =>  PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE    =>  PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES      =>  false
];

$link = new PDO($dsn, "linguasy_user", "Hutukara!", $opt);
//$link = new PDO($dsn, 'root', '', $opt);


    ?>