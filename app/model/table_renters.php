<?php

$table['id']='table_renters';
$table['title']='Арендаторы';
$table['header']=explode('|','Код|Имя|Телефон|Емейл|Паспорт|Логин|Пароль');
$table['align']=explode('|','center|left|left|center|center|left|left');
$table['hide_first']='1';
$table['sql']='
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
$table['where']='id > 0';
$table['order_by']='name';
$table['order_type']='ASC';
$table['limit']='7';
$table['editable']='1';
$table['addable']='1';
$table['deletable']='1';
$table['groupeditable']='1';
$table['printable']='1';
$table['csvable']='1';
$table['constructable']='1';
$table['table']='renter';
$table['label']=explode('|','Код|Имя|Телефон|Емейл|Паспорт|Логин|Пароль');
$table['field']=explode('|','id|name|phone|mail|passport|login|pass');
$table['format']=explode('|','integer|text|text|text|text|text|text');
$table['default']=explode('|','||||||');
$table['path']=__FILE__;

    
?>