<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    session_start();
    if (! isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    
    
    
    $cartCntItems = 0;
    
// Include file sustem
    define('ROOT', dirname(__FILE__));
    require_once (ROOT . '/components/Autoload.php');
    
    
    
    $router = new Router();
    $router->run();
   