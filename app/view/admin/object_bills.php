<?php

/* 
 * Работа с объектами
 */
    if(!isset($c)) exit;
    include_once 'common/model/db/db.php';
    include_once 'common/view/draw_simple_table.php';
    
    // находим текущего съемщика
    $t = fetch_row_from_sql('
        SELECT
            current_renter
        FROM
            object
        WHERE
            name = "'.addslashes($row[1]).'"
    ;');
    $renter = $t[0];
    
    
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
    

    echo   '<h3>Список cчетов по ',$row[1],'</h3>';

    $table['data'] = get_array_from_sql('
        SELECT
            day,
            renter,
            object,
            IFNULL(SUM(sum),0)
        FROM
            bill
        WHERE
            object="'.addslashes($row[1]).'"
            AND renter="'.addslashes($renter).'"
        GROUP BY 
            day,
            renter,
            object
        ORDER BY
            id DESC
    ;');
    $table['header'] = array('Дата','Арендатор','Объект','Сумма');
    $table['align'] = array('center','left','center','right');
    $table['fontsize'] = '14px';
    $table['id'] = 'bills';
    
    draw_simple_table($table);
    
    $summa = fetch_row_from_sql('
        SELECT
            IFNULL(SUM(sum),0)
        FROM
            bill
        WHERE
            object="'.addslashes($row[1]).'"
            AND renter="'.addslashes($renter).'"
        GROUP BY 
            object
        ORDER BY
            id DESC
    ;');
    
    //echo '<h4>Итого на сумму: ',$summa[0],' грн</h4>';
    
    
//==============================================================================
//==============================================================================
//==============================================================================
//==============================================================================
    
    
    echo   '<h3>Список отплат от: ',$renter,'</h3>';

    $table['data'] = get_array_from_sql('
        SELECT
            day,
            renter,
            object,
            sum
        FROM
            payment
        WHERE
            object="'.addslashes($row[1]).'"
            AND renter="'.addslashes($renter).'"
        ORDER BY
            id DESC
    ;');
    $table['header'] = array('Дата','Арендатор','Объект','Сумма');
    $table['align'] = array('center','left','center','right');
    $table['fontsize'] = '14px';
    $table['id'] = 'payments';
    
    draw_simple_table($table);
    
    $oplaty = fetch_row_from_sql('
        SELECT
            IFNULL(SUM(sum),0)
        FROM
            payment
        WHERE
            object="'.addslashes($row[1]).'"
            AND renter="'.addslashes($renter).'"
        GROUP BY 
            object
        ORDER BY
            id DESC
    ;');
    
    echo '<h4>Долг: ',($summa[0] - $oplaty[0]),' грн</h4>';
    
    include 'app/view/admin/payments_buttons.php';