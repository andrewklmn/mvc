<?php

/* 
 * Работа с объектами
 */
    if(!isset($c)) exit;
    include_once 'common/model/db/db.php';
    
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update':
                do_sql('
                    UPDATE object
                    SET
                        current_renter="'.addslashes($_POST['renter']).'"
                    WHERE
                        id IN ( '.addslashes($_POST['ids']).' )
                ;');
                break;
            default:
        };
    };
    
    
    include_once 'common/view/draw_simple_table.php';

    $table['data'] = get_array_from_sql('
        SELECT
            object.id,
            name,
            current_renter,
            IFNULL(SUM(bill.sum),0) - IFNULL(t1.sum,0)
        FROM
            object
        LEFT JOIN
            bill ON bill.object = object.name AND current_renter = bill.renter
        LEFT JOIN
            (SELECT
                SUM(sum) as sum,
                payment.object as object,
                payment.renter as renter
             FROM
                payment
             GROUP BY
                object,renter) as t1
                ON t1.object= object.name AND t1.renter = current_renter
        WHERE 
            object.id > 1
        GROUP BY 
            name
        ORDER BY name ASC
    ;');

    $table['header'] = array('Номер','Адрес','Арендатор','Долг');
    $table['align'] = array('center','left','left','right');
    $table['fontsize'] = '14px';
    $table['id'] = 'objects';
    $table['count'] = true;
    $table['hide_first'] = true;
    
    draw_simple_table($table);