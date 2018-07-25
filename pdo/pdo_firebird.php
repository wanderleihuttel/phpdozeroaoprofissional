<?php

/**
 * 
 *  Example PHP PDO Firebird connection 
 *  Require php extension: php-firebird
 * 
 */

try {

    // Variables definition
    $dsn = "firebird:dbname=10.0.0.1/3050:c:/database/db.fdb";
    $dbuser = "sysdba";
    $dbpass = "masterkey";

    // PDO Firebird options
    $options = array (
        PDO::ATTR_CASE => PDO::CASE_LOWER,    //columns lower case
        PDO::FB_ATTR_TIMESTAMP_FORMAT => '%s' //datetime as timestamp 
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