<?php
try {
   $dsn = "mysql:dbname=projeto_registroporconvite;host=localhost;port=3306;charset=utf8";
   $user = "php";
   $password = "";

   $options = array ( 
        PDO::ATTR_CASE => PDO::CASE_LOWER,
        PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true
    );
   $pdo = new PDO($dsn, $user, $password, $options);
    
} catch (PDOException $e) {
    echo $e->getMessage();
}