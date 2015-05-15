<?php

    // данные отображения
    $table['id'] = __FILE__;
    //$table['title'] = 'Арендаторы';
    $table['header'] = explode('|','Код|Имя|Телефон|Емейл|Паспорт|Логин|Пароль');
    $table['align'] = explode('|','center|left|left|center|center|left|left');
    $table['hide_first'] = 1;
    
    /*
    $table['data'] = array(
        explode('|','1|Анна|||||'),
        explode('|','2|Анна|||||'),
        explode('|','3|Анна|||||'),
        explode('|','4|Анна|||||'),
    );
     * 
     */
    
    $table['sql'] = '
        SELECT
            id,
            name,
            phone,
            mail,
            passport,
            login,
            pass
        FROM
            renter
    ';
    
    // данные сортировки и поиска
    $table['where'] = 'id > 0';
    $table['order_by'] = 'name';
    $table['order_type'] = 'ASC';
    $table['limit'] = '7';
    
    // настройки интерактивности
    $table['editable'] = 1;
    $table['addable'] = 1;
    $table['deletable'] = 1;
    $table['groupeditable'] = 1;
    $table['printable'] = 1;
    $table['csvable'] = 1;
    $table['constructable'] = 1;
    
    // данные редактирования
    $table['table'] = 'renter';
    $table['label'] = explode('|','Код|Имя|Телефон|Емейл|Паспорт|Логин|Пароль');
    $table['field'] = explode('|','id|name|phone|mail|passport|login|pass');
    $table['format'] = explode('|','integer|text|text|text|text|text|text');
    $table['default'] = explode('|','||||||');
    $table['path'] = __FILE__;
    