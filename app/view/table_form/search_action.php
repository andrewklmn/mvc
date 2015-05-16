<?php

    if(!isset($c)) exit;
    
    $search_query = '';
    
    if ($_POST['search']<>''){
        
        $t = array();
        $fields = fetch_fields_info_from_sql($table['sql']);
        //pre($fields);
        foreach ($fields as $value) {
            $t[count($t)] = $value->name.' like "%'.addslashes($_POST['search']).'%"';
        };
        
        if ($table['where']=='') {
            $table['where'] = implode(' OR ', $t);
        } else {
            $table['where'] .= ' AND ('.implode(' OR ', $t).')';
        };
        //pre($table['where']);
        $search_query = $_POST['search'];
    };
    
?>