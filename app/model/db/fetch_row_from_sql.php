<?php

    /**
     * Fetch row from sql
     * 
     * @param string $sql
     * @return array //returns one row from sql server result
     */    

    function fetch_row_from_sql($sql) {
        
        global $db;
        
        $result = mysqli_query($db, $sql);
        if (mysqli_errno($db)) {
            echo $sql.'<br/>';
            printf("<br>SQL error: %s\n", mysqli_error($db));
            exit;
        }        
        $row=mysqli_fetch_row($result);
        mysqli_free_result($result);
        return $row;
    }

