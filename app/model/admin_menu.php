<?php

    if(!isset($c)) exit;

    $menu = array(
        array('index','Objects'),
        array('renters','Renters'),
        array(
            array( '','Tools'),
            array('file_browser','File browser'),
            array('sql','SQL')
            //array('-',''),
        ),
        array('logout','Sign out')
    );
