<?php


    if(!isset($c)) exit;
    include_once 'common/model/db/db.php';
    include_once 'common/view/draw_table_from_sql.php';
    
    
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
    include 'common/view/bootstrap_html_header.php';
    include_once 'common/view/draw_table_from_sql.php';
    
    
?>
<script>

</script>
<style type="text/css">

</style>
<div class="container">
    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="?c=index">Объекты</a></li>
        <li><a href="?c=renters">Арендаторы</a></li>
        <li><a href="?c=sql">SQL командер</a></li>
    </ul>
    <?php
        include 'admin/view/bill_positions.php';
    ?>
</div>
    <?php
        include 'admin/view/bill_positions_buttons.php'
    ?>
</body>
</html>                                		