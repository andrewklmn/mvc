<?php


    if(!isset($c)) exit;
    include_once 'common/model/db/db.php';
    include_once 'common/view/draw_table_from_sql.php';
    
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
    
    $data['title'] = $row[1];
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
        <li><a href="?c=sql">SQL</a></li>
    </ul>
    <?php
        include 'admin/view/object_bills.php';
    ?>
</div>
    <?php
        //include 'admin/view/current_prices_buttons.php'
    ?>
</body>
</html>                                		