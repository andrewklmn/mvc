<?php

    if(!isset($c)) exit;
    include_once 'app/model/db/db.php';
    include_once 'app/view/draw_simple_table.php';
    
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'mail_bill':
                include 'app/view/mail_bill.php';
                break;
            case 'delete':
                if ($_POST['ids']!='-') {
                    do_sql('
                        DELETE FROM bill
                        WHERE
                             id IN ('.addslashes($_POST['ids']).');
                    ;');
                };
                break;
            case 'update':
                if ($_POST['ids']!='-') {
                    include 'app/view/admin/bill_positions_edit_records.php';
                    exit;
                };
                break;
            case 'update_records':
                //pre($_POST);
                $records = explode('||', $_POST['records']);
                foreach ($records as $value) {
                    $fields = explode('|', $value);
                    foreach ($fields as $key => $value) {
                        $fields[$key] = substr(substr($value, 1),0,-1);
                    };
                    $sql ='
                        UPDATE bill
                        SET
                            payment="'.addslashes($fields[1]).'",
                            prev="'.addslashes($fields[2]).'",
                            current="'.addslashes($fields[3]).'",
                            sum="'.addslashes($fields[4]).'"
                        WHERE
                            id="'.addslashes($fields[0]).'"
                    ;';
                    do_sql($sql);
                };
                break;
            default:
        };
    };

    echo   '<h3>Счёт по ',$row[3],' от ',$_GET['day'],'</h3>';

    $table['data'] = get_array_from_sql('
        SELECT
            id,
            payment,
            prev,
            current,
            sum
        FROM
            bill
        WHERE
            day="'.addslashes($_GET['day']).'"
            AND renter="'.addslashes($_GET['renter']).'"
        ORDER BY
            id ASC
    ;');
    $table['header'] = array('Код','Тип платежа','Предыдущие','Текущие','Сумма');
    $table['align'] = array('center','left','center','center','right');
    $table['fontsize'] = '14px';
    $table['id'] = 'positions';
    
    draw_simple_table($table);
    
    $summa = fetch_row_from_sql('
        SELECT
            IFNULL(SUM(sum),0)
        FROM
            bill
        WHERE
            day="'.addslashes($_GET['day']).'"
            AND renter="'.addslashes($_GET['renter']).'"
    ;');
    
    echo '<h4>Итого на сумму: ',$summa[0],' грн</h4>';