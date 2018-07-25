<?php

/**
 * 
 *  Example PHP PDO PostgreSQL connection 
 *  Require php extension: php-pgsql
 * 
 */

try {

    // Variables definition
    $dsn = "pgsql:dbname=somedbname;host=localhost;port=5432";
    $dbuser = "user";
    $dbpass = "password";

    // PDO MySQL options
    $options = array (
        PDO::ATTR_CASE => PDO::CASE_LOWER,               // lowercase
        PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,  // pdo show exception
        PDO::ATTR_PERSISTENT => true                     // persistent connection
    );

    // PDO object
    $pdo = new PDO($dsn, $dbuser, $dbpass, $options);

    // Get driver name
    $db_driver  = $pdo->getAttribute(PDO::ATTR_CASE);

    // Get server version
    $server_version = $pdo->getAttribute(PDO::ATTR_SERVER_VERSION);

    // Print information
    echo "DBDriver: " . $db_driver . "\n";
    echo "Server Version: " . $server_version . "\n\n";
 
    // Prepare
    $stmt = $pdo->prepare("select column1, column2  from table");
    $stmt->execute();

    
    // Read every single row and print on screen
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo $row['column1'] . " - " . $row['column2'] . "\n";
    }


} catch (PDOException $e){
    echo "(". $e->getCode() . ") " .$e->getMessage() . " at line: " . $e->getLine();
}