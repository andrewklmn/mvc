<?php

    if(!isset($c)) exit;

    if (isset($_POST['sql'])) {
        
        switch ($_POST[action]) {
            case 'form':
                include 'make_table_form.php';
                exit;
                break;
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
        include 'common/view/header_utf-8.php';
        switch ($_POST['action']) {
            case 'Describe table':
                echo 'DESCRIBE ',$_POST['table'];
                break;
            case 'Select all':
                include 'admin/controller/sql_editor/select_all.php';
                break;
            case 'Update':
                include 'admin/controller/sql_editor/update.php';
                break;
            case 'Insert':
                include 'admin/controller/sql_editor/insert.php';
                break;
            case 'Delete':
                include 'admin/controller/sql_editor/delete.php';
                break;
            default:
                break;
        }
        exit;
    };
