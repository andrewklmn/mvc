<?php


    if(!isset($c)) exit;
    include_once 'app/model/db/db.php';
    include_once 'app/view/draw_table_from_sql.php';
    
    $row = fetch_row_from_sql('
        SELECT
            id,
            name,
            current_renter
        FROM
            object
        WHERE
            id="'.  addslashes($_GET['id']).'"
    ;');
    
    $data['title'] = 'Objects';
    include 'app/view/html_head.php';
    
    include 'app/model/admin/menu.php';
    include 'app/view/menu.php';

    
?>
<script>

</script>
<style type="text/css">

</style>
<div class="container">
    <?php
        include 'app/view/admin/current_prices.php';
    ?>
</div>
    <?php
        include 'app/view/admin/current_prices_buttons.php'
    ?>
</body>
</html>                                		