<?php


    if(!isset($c)) exit;
    
    if (!isset($_POST['page'])) $_POST['page']=1;

    $up = $_POST['page']*$table['limit'];
    
    if (!isset($table['limit'])) {
        $table['limit'] = $total;
        $up = $total;
    };
    
    if ($up >= $total) {
        $up = $total;
        echo 'Showing ',$total,' entries';
    } else {
        echo 'Showing ',( $from + 1 ),' to ',$up,' of ',$total,' entries';
    };
    
?>