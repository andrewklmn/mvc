<?php

/*
 * Default Controller
 */

    // Check run constant
    if(!isset($c)) exit;
    
    include_once 'app/model/db/config.php';
    include_once 'app/model/db/db.php';
    include_once 'app/view/draw_table_from_sql.php';
        
    $data['title'] = 'Index';
    include 'app/view/html_head.php';
    
    include 'app/model/admin/menu.php';
    include 'app/view/menu.php';
    
   
?>
<br/>
<div class="container">
    <?php
        pre($_SESSION);
        //include 'app/view/sql_editor.php';
    ?>
</div>
</body>
</html>
