<?php

    if(!isset($c)) exit;
    
    $fields = array();
    foreach ($t as $k=>$v) {
        if ($field_prop[$k]['key']=='PRI') {
            $fields[count($fields)] = '""';
        } else {
            $v = substr(substr($v,0,-1),1); 
            if ($field_prop[$k]['key']=='UNI') {
                $i=1;
                $base = $v;
                do {
                    $sql ='
                        SELECT
                            count(*)
                        FROM
                            '.$table['table'].'
                        WHERE
                            '.$table['field'][$k].'="'.addslashes($v).'"
                    ;';
                    $row = fetch_row_from_sql($sql);
                    if($row[0]>0) {
                        $v = $base.$i;
                        $i ++;
                    };
                } while ($row[0]>0);
            };
            $fields[count($fields)] = '"'.addslashes($v).'"';
        };
    };