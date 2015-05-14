<?php

/*
 * CONTROLLER Check autorization
 */
    

    if (isset($_SESSION[$program]['tries']) AND $_SESSION[$program]['tries'] >= 5) {
        // you are blocked
        include 'app/view/you_are_blocked.php';
        exit;        
    };

    if (isset($_POST['username']) AND isset($_POST['password'])) {
        
        if(isset($_SESSION['code'])){
            if(!isset($_POST['code']) OR $_SESSION['code']!=$_POST['code']) {
                $_SESSION[$program]['tries'] = 
                    (isset($_SESSION[$program]['tries'])) 
                        ? $_SESSION[$program]['tries']++ : 1 ;
                $message = 'Wrong code. Try again:';
                include 'app/view/login.php';
                exit;                
            }
        };
        //check username and password
        if ( check_auth($_POST['username'],$_POST['password']) ) {
            $_SESSION[$program]['tries'] = 1;
            $_SESSION[$program]['auth'] = 1;
        } else {
            if (isset($_SESSION[$program]['tries'])) {
                if ($_SESSION[$program]['tries'] < 5) {
                    $message = 'Wrong login/pass. Try again:';
                    include 'app/view/login.php';
                    $_SESSION[$program]['tries'] += 1;
                    exit;                
                } else {
                    // you are blocked
                    include 'app/view/you_are_blocked.php';
                    exit;
                }                
            } else {
                $_SESSION[$program]['tries'] = 1;
                $message = 'Wrong login/pass. Try again:';
                include 'app/view/login.php';
                exit;
            }
        }
    } else {
        // show login form
        $message = 'Please sign in:';
        include 'app/view/login.php';
        exit;
    };

    function check_auth( $user, $pass ){
        include 'app/model/auth/users.php';
        include 'app/model/auth/ips.php';
        foreach ($users as $key=>$value) {
            if ($user == $value[0] AND $pass == $value[1]) {
                foreach ($ips as $val) {
                    if ($value[0]==$val[0] 
                        AND substr($_SERVER['HTTP_HOST'], 0, strlen($val[1]))==$val[1]) 
                            return true;
                }
            };
        };
        return false;
    };
    
?>
