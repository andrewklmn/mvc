<?php

$table['id']='payment_type';
$table['title']='payment_type';
$table['header']=explode('|','id|name');
$table['align']=explode('|','left|left');
$table['hide_first']='0';
$table['sql']='SELECT
    id,
    name
FROM
    payment_type';
$table['where']='';
$table['order_by']='';
$table['order_type']='DESC';
$table['limit']='100';
$table['editable']='1';
$table['addable']='1';
$table['deletable']='1';
$table['groupeditable']='1';
$table['printable']='1';
$table['csvable']='1';
$table['constructable']='1';
$table['table']='payment_type';
$table['label']=explode('|','id|name');
$table['field']=explode('|','id|name');
$table['format']=explode('|','integer|text|text|text|text|text|text');
$table['default']=explode('|','||||||');
$table['path']=__FILE__;

$table['path'] = __FILE__;

?>