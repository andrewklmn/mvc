<?php

/*
 * Default Controller
 */

    // Check run constant
    if(!isset($c)) exit;
    
    include 'app/view/header_utf-8.php';
    $data['title'] = 'SQL editor';
    include 'app/view/html_head.php';
    
    include 'app/model/admin/menu.php';
    include 'app/view/menu.php';
    
    include_once 'app/model/db/config.php';
    include_once 'app/model/db/db.php';
   
?>
<div class="container">
    <h1>
        Index
    </h1>
    <p>
        <?php
            //pre($_SESSION[$program]);
            include 'app/view/sql_editor.php';
        ?>
    </p>
    <a class="link" href="?c=logout">Sign out</a>
</div>
</body>
</html>
