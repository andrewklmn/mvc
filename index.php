<?php

    /*
     * Simple MVC framework based on "include" and without OOP...
     * Keep It Simple Stupid 0.0.1 20150315
     */

    //@ob_start("ob_gzhandler"); // gz-compressed output
    
    error_reporting(E_ALL);     // for debbuging mode
    //error_reporting(0);     // for production mode    
    date_default_timezone_set('Europe/Kiev');
    session_start();
    
    $program = 'mvc';           // short application name
    
    
    // move to secure connection
    if($_SERVER['SERVER_PORT'] != 443) {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        exit();
    };
    
    // start controller
    $c = (!isset($_GET['c']) OR $_GET['c']=='') 
        ? 'index' 
        : preg_replace("/[^a-z\_\/0-9]/",'',  strtolower($_GET['c']));
    
    // check auth
    if (!isset($_SESSION[$program]['auth']) OR $_SESSION[$program]['auth']<>1 ) {
        // check autorization if not authorized
        include 'app/controller/check_auth.php';
    };
    
    if (file_exists('app/controller/'.$c.'.php')) {
        include 'app/controller/'.$c.'.php';
    } else {
        include 'app/view/404.php';
    };   
    
    //@ob_end_flush();
    
?>
