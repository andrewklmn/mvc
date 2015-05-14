<?php

    /**
     * Counts SQL query rows
     * 
     * @param string $sql
     * @return integer
     */    

    function count_rows_from_sql($sql) {
        
        global $db;
        
        $result = mysqli_query($db, $sql);
        if (mysqli_errno($db)) {
            printf("<br>SQL error: %s\n", mysqli_error($db));
            exit;
        }
        $rows = mysqli_num_rows($result);
        mysqli_free_result($result);
        return $rows;
    }

?>
