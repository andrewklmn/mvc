<?php

/*
 * Default Controller
 */

    // Check run constant
    if(!isset($c)) exit;
    
    include_once 'app/model/db/config.php';
    include_once 'app/model/db/db.php';
    include_once 'app/view/draw_table_from_sql.php';
        
    $data['title'] = 'Editor';
    include 'app/view/html_head.php';
    
    include 'app/model/admin/menu.php';
    include 'app/view/menu.php';
    
    //pre($_POST);
?>
<div class="container">
    <?php
        $data['root'] = $_SERVER['DOCUMENT_ROOT'].'/mvc';
        $data['current_dir'] = $root;
        include 'app/view/file_browser.php';
    ?>
</div>
<?php
    //pre($_POST);
?>
</body>
</html>
