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
    echo 'INSERT INTO ',$_POST['table'],'
    (',implode(',
    ',$names),')
VALUES
    ("',implode('",
     "',$names),'")';
                
?>