<?php

/*
 * Default Controller
 */

    // Check run constant
    if(!isset($c)) exit;
    
    include_once 'app/model/db/config.php';
    include_once 'app/model/db/db.php';
    include_once 'app/view/draw_table_from_sql.php';
        
    $data['title'] = 'Objects';
    include 'app/view/html_head.php';
    
    include 'app/model/admin/menu.php';
    include 'app/view/menu.php';
    
   
  
?>
<script>

</script>
<div class="container">
    <h3>Объекты под сдачу</h3>
    <?php
        include 'app/view/admin/objects.php';
    ?>
</div>
    <?php
        include 'app/view/admin/objects_buttons.php';
    ?>
</body>
</html>                
