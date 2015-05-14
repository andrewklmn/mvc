<?php

/*
 * Controller Logout
 */
    $_SESSION[$program]['auth']=0;
    
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://".$_SERVER['HTTP_HOST'].str_replace('?c=logout', '?c=index', $_SERVER['REQUEST_URI']));
    exit;

?>
