<?php

/*
 * LOGIN form
 */

    // Check run constant
    if(!isset($c)) exit;
    
?>
<!DOCTYPE html>
<html>
    <!---<h1>Enter login and password:</h1>-->
    <?php 
        if (isset($message)) {
            echo $message;
        };
    ?>
    <form method="POST">
        <table>
            <tr>
                <th>
                    login:
                </th>
                <td>
                    <input type="text" name="username" value="<?php 
                        if (isset($_POST['username'])) echo $_POST['username'];
                    ?>"/>
                </td>
            </tr>
            <tr>
                <th>
                    password:
                </th>
                <td>
                    <input type="password" autocomplete="off" name="password" value="<?php 
                        if (isset($_POST['password'])) echo $_POST['password'];
                    ?>"/>
                </td>
            </tr>
            <?php
                if (isset($_SESSION[$program]['tries'])) {
                    ?>
                        <tr>
                            <th>
                                <img src="app/controller/code.php"/>
                            </th>
                            <td>
                                <input type="text" autocomplete="off" name="code" value=""/>
                            </td>
                        </tr>            
                    <?php
                };
            ?>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Log in"/>
                </td>
            </tr>
        </table>
    </form>
</html>

