<?php

try {
    // Variables definition
    $dsn = "mysql:dbname=projeto_mmn;host=localhost;port=3306;charset=utf8;";
    $dbuser = "cursophp";
    $dbpass = "cursophp";
    // PDO MySQL options
    $options = array (
        PDO::ATTR_CASE => PDO::CASE_LOWER,
        PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $pdo = new PDO($dsn, $dbuser, $dbpass, $options);
 
} catch (PDOException $e){
    echo "(". $e->getCode() . ") " .$e->getMessage() . " at line: " . $e->getLine();
}