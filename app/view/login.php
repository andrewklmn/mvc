<?php

/*
 * LOGIN form
 */

    if(!isset($c)) exit;
    
    include 'app/view/header_utf-8.php';
    include 'app/view/html_head.php';
    
?>
    <style>
        body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: white;
        }
        .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
        margin-bottom: 10px;
        }
        .form-signin .checkbox {
        font-weight: normal;
        }
        .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
        }
        .form-signin .form-control:focus {
        z-index: 2;
        }
        .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        }
    </style>
    <div class="container" style="width: 300px;">
      <form class="form-signin" method="POST">
          <h4 class="form-signin-heading">
            <?php 
                if (isset($message)) {
                    echo $message;
                };
            ?>
          </h4>
        <label class="sr-only" for="username">Login</label>
        <input type="text" autofocus="" required="" placeholder="Login" 
               class="form-control" id="username" name="username"
               value="<?php 
                        if (isset($_POST['username'])) echo $_POST['username'];
                    ?>">
        <label class="sr-only" for="password">Password</label>
        <input type="password" autocomplete="off"  required="" placeholder="Password" 
               class="form-control" 
               id="password" name="password" value="<?php 
                        if (isset($_POST['password'])) echo $_POST['password'];
                    ?>">
        <?php
            if (isset($_SESSION[$program]['tries'])) {
                ?>
                <img src="app/controller/code.php"/>
                <input type="text" class="form-control" 
                       placeholder="Code"
                       autocomplete="off" name="code" value=""/>
                <?php
            };
        ?>
        <br/>
        <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
      </form>

    </div>
    </body>
</html>
<?php
    exit;
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
                    <input type="text" name="username" value=""/>
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

