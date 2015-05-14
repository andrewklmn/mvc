<?php

/*
 * Model of MySQL database wrapper
 * Based on php mysqli
 * 
 * After setting of your SQL server and database parameters you can 
 * include_once this model in your application 
 * for usage database wrapper functions
 */

    if (!isset($c)) exit;
    
    // Set parameters of your MySQL server
    define('DB_HOST', 'localhost');
    define('DB_PORT', 3306);
    define('DB_USER', 'u938808713_user');
    define('DB_PASS', 'u938808713_');
    define('DB_NAME', 'u938808713_base');
    define('DB_CHARSET', 'cp1251');
    
    
    // Remove before created instance
    if (isset($db)) {
        if ($db instanceof mysqli) { 
            mysqli_close($db);
        } else {
            unset ($db);
        }
    };
    
    $db = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    if (mysqli_connect_errno()) {
        printf("<br>Connection error: %s\n", mysqli_connect_error());
        exit();
    }

    // Include SQL function
    include_once 'do_sql.php';
    include_once 'count_rows_from_sql.php';
    include_once 'get_array_from_sql.php';
    include_once 'get_assoc_array_from_sql.php';
    include_once 'fetch_row_from_sql.php';
    include_once 'fetch_assoc_row_from_sql.php';
    include_once 'fetch_fields_info_from_sql.php';
    
    mysqli_query($db,'SET CHARACTER SET '.DB_CHARSET.';');
    mysqli_query($db,'SET NAMES '.DB_CHARSET.';');

?>