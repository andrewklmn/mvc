<?php

/* 
 * Update
 */

    if(!isset($c)) exit;

    $sql = 'SELECT * FROM '.$_POST['table'].';';
    $fields = fetch_fields_info_from_sql($sql);
    $names = array();
    $i=0;
    foreach ($fields as $value) {
        $names[$i] = $value->name;
        $i++;
    };
    echo 'DELETE FROM ',$_POST['table'],'
WHERE
     ',implode('=""
     AND ',$names),'=""';
                
?>