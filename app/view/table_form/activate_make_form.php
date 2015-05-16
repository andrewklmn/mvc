<?php

    if (isset($_GET['action']) AND $_GET['action']='make_form') {
        ?>
            <input type="hidden" name="code" value="<?php echo $code; ?>"/>
            <input type="hidden" name="make_form_action" value="Preview"/>
        <?php
    };      
?>