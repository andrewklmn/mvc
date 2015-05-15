<?php

    /**
     * Fetch fields info from sql
     * 
     * @param string $sql
     * @return array returns 2D array with fields info
     */    

    function fetch_fields_info_from_sql($sql) {
        
        global $db;
        
        $result = mysqli_query($db, $sql);
        if (mysqli_errno($db)) {
            echo $sql.'<br/>';
            printf("<br>SQL error: %s\n", mysqli_error($db));
            exit;
        }
        $row=mysqli_fetch_fields($result);
        mysqli_free_result($result);
        return $row;
    }

?>
