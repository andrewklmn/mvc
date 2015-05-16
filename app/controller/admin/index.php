<?php

    // Check run constant
    if(!isset($c)) exit;
    
    include 'app/view/header_utf-8.php';
    include 'app/view/html_head.php';
    
    include 'app/model/admin_menu.php';
    include 'app/view/menu.php';
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
    <a class="link" href="?c=logout">Sign out</a>
</div>
</body>
</html>
