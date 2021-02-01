<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$dsn = "mysql:host=localhost;dbname=linguasy_japiim;port=3306;chartset=utf8";

//$dsn = "mysql:host=localhost;dbname=japiim;port=3306;chartset=utf8";

$opt = [

    PDO::ATTR_ERRMODE               =>  PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE    =>  PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES      =>  false
];

$link_japiim = new PDO($dsn, "linguasy_user", "Hutukara!", $opt);
//$link = new PDO($dsn, 'root', '', $opt);

//include ("functions.php");
?>