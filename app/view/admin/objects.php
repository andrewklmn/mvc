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
            id,
            name,
            current_renter
        FROM
            object
        WHERE 
            id > 1
        ORDER BY name ASC
    ;');

    $table['header'] = array('Номер','Адрес','Арендатор');
    $table['align'] = array('center','left','left');
    $table['fontsize'] = '14px';
    $table['id'] = 'objects';
    $table['count'] = true;
    $table['hide_first'] = true;
    
    draw_simple_table($table);