<?php

/* 
 * Работа с объектами
 */
    if(!isset($c)) exit;
    include_once 'common/model/db/db.php';
    include_once 'common/view/draw_simple_table.php';
    
    
    
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'delete':
                if ($_POST['ids']!='-') {
                    do_sql('
                        DELETE FROM current_price
                        WHERE
                             id IN ('.addslashes($_POST['ids']).');
                    ;');
                };
                break;
            case 'update':
                if ($_POST['ids']!='-') {
                    include 'admin/view/current_prices_edit_records.php';
                    exit;
                };
                break;
            case 'update_records':
                // Обновление нескольких записей одновременно
                $records = explode('||', $_POST['records']);
                foreach ($records as $record) {
                    $t = explode('|', $record);
                    do_sql('
                        UPDATE current_price
                        SET
                            payment_type="'.addslashes($t[1]).'",
                            average_amount="'.addslashes($t[2]).'",
                            sum="'.addslashes($t[3]).'"
                        WHERE
                            id="'.addslashes($t[0]).'"
                    ;');
                };
                break;
            case 'add':
                include 'admin/view/current_prices_add_record.php';
                exit;
                break;
            case 'add_record':
                $t = explode('|',  $_POST['record']);
                $sql = '
                    INSERT INTO current_price
                        (
                        object,
                        payment_type,
                        average_amount,
                        sum)
                    VALUES
                        (
                         "'.addslashes($row[1]).'",
                         "'.addslashes($t[0]).'",
                         "'.addslashes($t[1]).'",
                         "'.addslashes($t[2]).'")
                ;';
                /*
                echo '<pre>';
                print_r($_POST);
                echo $sql;
                echo '</pre>';
                 */
                do_sql($sql);
                break;
            default:
        };
    };
    

    echo   '<h3>Список начислений по ',$row[1],'</h3>';

    $table['data'] = get_array_from_sql('
        SELECT
            id,
            payment_type,
            average_amount,
            sum
        FROM
            current_price
        WHERE
            object="'.addslashes($row[1]).'"
    ;');
    $table['header'] = array('Код','Тип платежа','Кол-во','Цена');
    $table['align'] = array('center','left','center','right');
    $table['fontsize'] = '14px';
    $table['id'] = 'prices';
    
    draw_simple_table($table);
    
    $summa = fetch_row_from_sql('
        SELECT
            SUM(sum)
        FROM
            current_price
        WHERE
            object="'.addslashes($row[1]).'"
    ;');
    
    echo '<h4>Итого на сумму: ',$summa[0],' грн</h4>';