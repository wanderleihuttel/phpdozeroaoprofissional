<?php
session_start();
try {
    // Variables definition
    $dsn = "mysql:dbname=classificados;host=localhost;port=3306;charset=utf8;";
    $dbuser = "cursophp";
    $dbpass = "cursophp";
    // PDO MySQL options
    $options = array (
        PDO::ATTR_CASE => PDO::CASE_LOWER,               // lowercase
        PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,  // pdo show exception
        PDO::ATTR_PERSISTENT => true,                    // persistent connection
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // set fetch mode
    );
    // PDO object
    $pdo = new PDO($dsn, $dbuser, $dbpass, $options);
} catch (PDOException $e){
    echo "(". $e->getCode() . ") " .$e->getMessage() . " at line: " . $e->getLine();
}