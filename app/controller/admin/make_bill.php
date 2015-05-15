<?php


    if(!isset($c)) exit;
    include_once 'common/model/db/db.php';
    include_once 'common/view/draw_table_from_sql.php';
    
    if (isset($_POST['create_new_bill']) AND $_POST['create_new_bill']=='create_new_bill') {
        // создаем новый счёт
        $object = fetch_row_from_sql('
            SELECT
                name,
                current_renter
            FROM
                object
            WHERE
                id = "'.addslashes($_GET['id']).'"
        ;');
        
        $position = get_array_from_sql('
            SELECT
                id,
                object,
                payment_type,
                average_amount,
                sum
            FROM
                current_price
            WHERE
                object = "'.addslashes($object[0]).'"
        ;');
        
        $day = date("Y-m-d");
        
        foreach ($position as $position) {
            
            $prev = 0;
            $sql = '
                SELECT
                    current
                FROM
                    bill
                WHERE
                    payment="'.$position[2].'"
                    AND object="'.$object[0].'"
                ORDER BY id DESC
                LIMIT 0,1
            ;';
            $t = fetch_row_from_sql($sql);            
            $prev += $t[0];
            
            $sql = '
                INSERT INTO bill
                    (
                    day,
                    renter,
                    object,
                    payment,
                    prev,
                    current,
                    sum)
                VALUES
                    (
                     "'.$day.'",
                     "'.$object[1].'",
                     "'.$object[0].'",
                     "'.$position[2].'",
                     "'.$prev.'",
                     "'.($prev + $position[3]).'",
                     "'.$position[4].'")
             ;';
            do_sql($sql);
        };
        
        $t = fetch_row_from_sql('
            SELECT
                MAX(day)
            FROM
                bill
            WHERE
                object = "'.addslashes($object[0]).'"
        ;');
        
        // переходим на редактирование счета
        header('location: ?c=bill&day='.$t[0]);
        exit;
    };
    
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
    
    $data['title'] = 'Счёт - '.$row[1];
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
    <h3>Создать новый счёт - <?php echo $row[1]; ?>?</h3>
    <form method='POST'>
        <input type='hidden' name='create_new_bill' value='create_new_bill'>
        <a class='btn btn-primary' href='?c=object&id=<?php echo $row[0]; ?>'>Отменить</a>
        <input type='submit' class='btn btn-danger' value='Создать счёт'/>
    </form>
</div>
    <?php
        
    ?>
</body>
</html>                                		