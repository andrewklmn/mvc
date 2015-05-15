<?php

/*
 * MODEL accepted ip list
 */

    // user-ip restriction list
    $ips = array (
        array('admin',''),
        array('user',''),// empty for any host for user
        array('','')        // empty for any user and any host
                            // '10.0.' for restricted network
                            // '10.0.0.1' for restricted host
    );

?>
