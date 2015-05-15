<?php

    if(!isset($c)) exit;

    $field_prop = array();
    foreach ($table['field'] as $key => $value) {
        $t = fetch_row_from_sql('
            SHOW COLUMNS FROM 
                '.$table['table'].'
            LIKE 
                "'.$value.'"
        ;');
        $x = explode('(', $t[1]);
        $y = explode(')', $x[1]);

        $field_prop[$key] = array(
            'format' => $x[0],      //type
            'length' => (int)$y[0], //length
            'key' => $t[3],      //unique
            'default' => $t[4]      //length
        );
    };
    /*
    echo '<pre>';
    print_r($field_prop);
    echo '</pre>';
    */
