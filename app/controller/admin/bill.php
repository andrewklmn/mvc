<?php


    if(!isset($c)) exit;
    include_once 'app/model/db/db.php';
    include_once 'app/view/draw_table_from_sql.php';
    
    
    $row = fetch_row_from_sql('
        SELECT
            id,
            day,
            renter,
            object,
            payment,
            prev,
            current,
            sum
        FROM
            bill
        WHERE
            day="'.addslashes($_GET['day']).'"
            AND renter="'.addslashes($_GET['renter']).'"
    ;');
    
    $data['title'] = 'Счёт по '.$row[3];
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
        include 'app/view/admin/bill_positions.php';
    ?>
</div>
    <?php
        include 'app/view/admin/bill_positions_buttons.php'
    ?>
</body>
</html>                                		