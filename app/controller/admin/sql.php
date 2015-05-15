<?php


    if(!isset($c)) exit;
    
    include_once 'app/model/db/config.php';
    include_once 'app/model/db/db.php';
    include_once 'app/view/draw_table_from_sql.php';
    
    include 'app/controller/admin/sql_editor/actions.php';
    
    $data['title'] = 'SQL editor';
    include 'app/view/html_head.php';
    
    include 'app/model/admin/menu.php';
    include 'app/view/menu.php';
    
    
?>
<div class="container">
    <br/>
    <?php 
        include 'app/view/sql_editor.php';
    ?>
</div>
</body>
</html>                                		