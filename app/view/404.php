<?php

    if(!isset($c)) exit;
    
?>
<!DOCTYPE html>
<html>
    <h1>Error 404</h1>
    <p>Controller: <?php echo htmlspecialchars( $c, ENT_QUOTES, 'windows-1251' ); ?> is missing</p>    
</html>
