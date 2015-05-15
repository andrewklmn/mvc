<?php


    if(!isset($c)) exit;
    
    if (!isset($_POST['page'])) $_POST['page']=1;

    $up = $_POST['page']*$table['limit'];
    if ($up > $total) $up = $total;
    
    echo 'Showing ',( $from + 1 ),' to ',
            $up,' of ',$total,' entries';

?>