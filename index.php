<?php

    /* 
     * Simple MVC framework based on "include" without OOP...
     * Keep It Simple Stupid 0.0.2
     */

    //@ob_start("ob_gzhandler"); // gz-compressed output
    
    error_reporting(E_ERROR);     // for debbuging mode
    //error_reporting(0);     // for production mode    
    date_default_timezone_set('Europe/Kiev');
    session_start();
    
    $program = 'mvc';           // short application name
    $root_dir = __DIR__;
    
    include_once 'app/model/htmlfix.php';
    function pre($x) {
        echo '<pre>';
        print_r($x);
        echo '</pre>';
    };
    
    // move to secure connection
    if($_SERVER['SERVER_PORT'] != 443) {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        exit();
    };
    
    
    include 'app/view/header_utf-8.php';
    
    // start controller
    $c = (!isset($_GET['c']) OR $_GET['c']=='') 
        ? 'index' 
        : preg_replace("/[^a-z\_\/0-9]/",'',  strtolower($_GET['c']));
    
    // start login-pass operation before authorization
    if ($c=='registration' OR $c=='remember') {
        include 'app/controller/'.$c.'.php';
        exit;
    };
    
    // check auth
    if (!isset($_SESSION[$program]['auth']) OR $_SESSION[$program]['auth']<>1 ) {
        // check autorization if not authorized
        include 'app/controller/check_auth.php';
    };
    
    switch ($c) {
        case 'logout':
        case 'code':
            include 'app/controller/'.$c.'.php';
        break;
        default:
            if (file_exists('app/controller/'.$_SESSION[$program]['role'].'/'.$c.'.php')) {
                include 'app/controller/'.$_SESSION[$program]['role'].'/'.$c.'.php';
            } else {
                include 'app/view/404.php';
            };            
    };
    //@ob_end_flush();
    