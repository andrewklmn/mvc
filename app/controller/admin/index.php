<?php

/*
 * Default Controller
 */

    // Check run constant
    if(!isset($c)) exit;
    
    include 'app/view/header_utf-8.php';
    include 'app/view/html_head.php';
    
?>
<div class="container">
    <h1>
        Index
    </h1>
    <p>
        <?php
            pre($_SESSION[$program]);
        ?>
    </p>

</div>
</body>
</html>
