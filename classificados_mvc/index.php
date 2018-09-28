<?php
session_start();
require_once('config.php');

spl_autoload_register(function($class){
    if(file_exists('controllers' . DS . $class .'.php')){
        require('controllers' . DS . $class . '.php');
    } else if(file_exists('models' . DS . $class . '.php')){
        require('models' . DS . $class . '.php');
    } else if(file_exists('core' . DS . $class . '.php')){
        require('core' . DS . $class . '.php');
    }
});

$core = new Core();
$core->run();