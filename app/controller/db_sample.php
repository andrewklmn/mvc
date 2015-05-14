<?php

/*
 * Sample of MySQL DATABASE usage
 */
    // Check run constant
    if(!isset($c)) exit;
    
    include_once 'app/model/db/db.php';
    $sql = 'SHOW TABLES;';
    $row = fetch_row_from_sql($sql);
    
    
?>
<!DOCTYPE html>
<html>
    <body>
        <h1>Sample of MySQL usage</h1>
        <p>
            $sql='<?php echo $sql; ?>';
        </p>
        <p>
            Result row: <?php print_r($row); ?>
        </p>        
    </body>
</html>
