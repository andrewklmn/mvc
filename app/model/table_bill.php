<?php

$table['id']='bill';
$table['title']='bill';
$table['header']=explode('|','id|day|renter|object|payment|prev|current|sum');
$table['align']=explode('|','left|left|left|left|left|left|left|left');
$table['hide_first']='0';
$table['sql']='SELECT
    id,
    day,
    renter,
    object,
    payment,
    prev,
    current,
    sum
FROM
    bill';
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
$table['table']='bill';
$table['label']=explode('|','id|day|renter|object|payment|prev|current|sum');
$table['field']=explode('|','id|day|renter|object|payment|prev|current|sum');
$table['format']=explode('|','integer|text|text|text|text|text|text');
$table['default']=explode('|','||||||');
$table['path']=__FILE__;


?>