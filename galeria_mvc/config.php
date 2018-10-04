<?php
require_once 'environment.php';

define('BASE_DIR', __DIR__);
define('DS', DIRECTORY_SEPARATOR);


$config = [];

if ( ENVIRONMENT == 'development'){
    define('BASE_URL', 'http://192.168.1.87/phpdozeroaoprofissional/galeria_mvc');
    $config = [
        'driver'   => 'mysql',
        'host'     => 'localhost',
        'port'     => 3306,
        'dbname'   => 'galeria_mvc',
        'dbuser'   => 'cursophp',
        'dbpass'   => 'cursophp',
        'charset'  => 'utf8'
    ];
} else {
    define('BASE_URL', 'http://localhost/galeria_mvc/');
    $config = [
        'driver'   => 'mysql',
        'host'     => 'localhost',
        'port'     => 3306,
        'dbname'   => 'galeria_mvc',
        'dbuser'   => 'cursophp',
        'dbpass'   => 'cursophp',
        'charset'  => 'utf8'
    ];
}

global $db;
try {

    $dsn = "{$config['driver']}:dbname={$config['dbname']};host={$config['host']};port={$config['port']};charset={$config['charset']};";
    $dbuser = $config['dbuser'];
    $dbpass = $config['dbpass'];
    // PDO MySQL options
    $options = array (
        PDO::ATTR_CASE => PDO::CASE_LOWER,               // lowercase
        PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,  // pdo show exception
        PDO::ATTR_PERSISTENT => true,                    // persistent connection
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // set fetch mode
    );
    // PDO object
    $db = new PDO($dsn, $dbuser, $dbpass, $options);

} catch (PDOException $e){
    echo "(". $e->getCode() . ") " .$e->getMessage() . " at line: " . $e->getLine();
}