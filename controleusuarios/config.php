<?php 

$dsn = "mysql:dbname=blog;host=localhost;port=3306;charset=utf8";
$dbuser = "blog";
$dbpass = "123456";
$options = array (
    PDO::ATTR_CASE => PDO::CASE_LOWER,               // lowercase
    PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,  // pdo show exception
    PDO::ATTR_PERSISTENT => true                     // persistent connection
);

try {
    
    $pdo = new PDO($dsn, $dbuser, $dbpass, $options);

} catch (PDOException $e){
    
    echo "(". $e->getCode() . ") " .$e->getMessage() . " at line: " . $e->getLine();
    
}


