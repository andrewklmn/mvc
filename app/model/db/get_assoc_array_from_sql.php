<?php

    /**
     * Get assoc array from sql
     * 
     * @param string $sql
     * @return array //returns assoc array from sql
     */    

    function get_assoc_array_from_sql($sql) {
        
        global $db;
        $answer=array();
        $i=0;
        
        $result = mysqli_query($db, $sql);
        if (mysqli_errno($db)) {
            echo $sql.'<br/>';
            printf("<br>SQL error: %s\n", mysqli_error($db));
            exit;
        }        
        while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
            $answer[$i]=$row;
            $i++;
        };
        mysqli_free_result($result);
        return $answer;
    }

