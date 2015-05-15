<?php
    
    if(!isset($c)) exit;
    
    if (isset($table['sql'])) { 
        
        $sql = $table['sql'];
        
        // подключаем данные фильтра
        if (isset($_POST['filter']) AND $_POST['filter']<>'') {
            
        } else {
            if ($table['where']!='') $sql = $sql.' WHERE '.$table['where'];
        };
        
        // считаем общее количество
        $total = count_rows_from_sql($sql);
        
        // подключаем данные сортировки
        if (isset($_POST['order_by']) AND (int)$_POST['order_by']<>0) {
            
        } else {
            if ($table['order_by']!='') $sql = $sql.' ORDER BY '.$table['order_by'].' '.$table['order_type'];
        };
        
        
        // подключаем данные страницы
        if (isset($_POST['page']) AND (int)$_POST['page']>1) {
            
            $from = (int)$table['limit']*((int)$_POST['page']-1);
            
            if (($total-$from) < $table['limit'] ) {
                $from = $total - $table['limit'];
                if ( $from<0 ) {
                    $from = 0;
                };        
            };
            
            if ($table['limit']!='') $sql = $sql.' LIMIT '
                    .$from.','.$table['limit'];
        } else {
            if ($table['limit']!='') $sql = $sql.' LIMIT 0,'.$table['limit'];
            $_POST['page'] = 1;
        };
        
        $table['data'] = get_array_from_sql($sql);
            
        //echo '<pre>';
        //echo $sql;
        //echo '</pre>';
    
    } else {
        $total = count($table['data']);
    };

