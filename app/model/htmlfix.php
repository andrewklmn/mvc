<?php

/*
 *  htmlspecialchars()
 */
        function htmlfix($text){
            return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'utf-8');
        }
?>
