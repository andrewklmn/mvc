<?php

    if(!isset($c)) exit;

    $menu = array(
        array('index','Home'),
        array(
            array( '','Dropdown'),
            array('index','Home'),
            //array('-',''),
            array('logout','Sign out')
        ),
        array('logout','Sign out')
    );