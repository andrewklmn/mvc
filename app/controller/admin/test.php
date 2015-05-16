<?php

/*
 * Default Controller
 */

    // Check run constant
    if(!isset($c)) exit;
    
    include_once 'app/model/db/config.php';
    include_once 'app/model/db/db.php';
    include_once 'app/view/draw_table_from_sql.php';
        
    $data['title'] = 'Test';
    include 'app/view/html_head.php';
    
    include 'app/model/admin/menu.php';
    include 'app/view/menu.php';
    
    
?>
<br/>
<div class="container">
    <?php
        /*
        include 'app/model/table_bill.php';
        
        // get_data
        $table['data'] = get_array_from_sql($table['sql']);
        //draw_simple_table($table);
        
        $table['id'] = 'bb';
        draw_table_from_sql($table['sql']);
        
        $table['id'] = 'bbb';
        include 'app/view/table_form.php';
         * 
         */
    ?>
</div>
</body>
</html>                
