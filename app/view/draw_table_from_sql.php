<?php

/* 
 * Рисует таблицу результата запроса
 */

    include_once 'draw_simple_table.php';
    include_once 'app/model/db/db.php';
    
    function draw_table_from_sql($sql) {
    
        // Подключаем настройки базы данных глобальные
        global $db;
        
        
        // Получаем информацию о полях запроса
        $fields = fetch_fields_info_from_sql($sql);
        $table['header'] = array();
        foreach ($fields as $value) {
            $table['header'][]=$value->name;
        };
        $table['data'] = get_array_from_sql($sql);

        draw_simple_table($table);
        
    };
