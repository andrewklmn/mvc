<?php

    /**
     * Runs SQL query
     * 
     * @param string $sql
     * @return number // returns number of affected rows
     */    

    function do_sql($sql) {
        
        global $db;
        
        mysqli_query($db, $sql);
        if (mysqli_errno($db)) {
            printf("<br>SQL error: %s\n", mysqli_error($db));
            exit;
        }
        return mysqli_affected_rows($db);
    }

