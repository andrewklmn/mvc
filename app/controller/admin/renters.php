<?php

/*
 * Default Controller
 */

    // Check run constant
    if(!isset($c)) exit;
    
    include_once 'app/model/db/config.php';
    include_once 'app/model/db/db.php';
    include_once 'app/view/draw_table_from_sql.php';
        
    $data['title'] = 'Renters';
    include 'app/view/html_head.php';
    
    include 'app/model/admin/menu.php';
    include 'app/view/menu.php';
    
   
?>
<div class="container">
    <?php
        include 'app/model/admin/table_renters.php';
        include 'app/view/table_form.php';
    ?>
</div>
</body>
</html>
