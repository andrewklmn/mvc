<?php

    if(!isset($c)) exit;
    
    if(isset($_GET['table'])) {
        
    } else {    
        if (isset($_POST['sql'])) {

            switch ($_POST[action]) {
                case 'sql':
                    ?>
                        <table>
                            <tr>
                                <td style="vertical-align: top;">
                                    <?php 
                                        echo '<pre style="font-size:8px;" onclick="$(\'textarea#sql\').val($(this).html());">';
                                        echo $_POST['sql'];
                                        echo '</pre>';
                                    ?>
                                </td>
                                <td style="vertical-align: top;"> -> </td>
                                <td>
                                    <?php
                                    switch (substr(strtoupper($_POST['sql']),0,4)) {
                                        case 'DELE': case 'INSE': case 'UPDA':
                                            do_sql($_POST['sql']);
                                            break;
                                        default:
                                            draw_table_from_sql($_POST['sql']);                        
                                    };
                                    ?>
                                </td>
                            </tr>
                        </table>
                    <?php
                    exit;      
                    break;
                default:
            };
        };

        if (isset($_POST['action']) AND isset($_POST['table'])) {
            switch ($_POST['action']) {
                case 'Describe table':
                    echo 'DESCRIBE ',$_POST['table'];
                    break;
                case 'Select all':
                    include 'select_all.php';
                    break;
                case 'Update':
                    include 'update.php';
                    break;
                case 'Insert':
                    include 'insert.php';
                    break;
                case 'Delete':
                    include 'delete.php';
                    break;
                default:
                    break;
            }
            exit;
        };
    };