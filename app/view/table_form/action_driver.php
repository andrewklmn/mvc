<?php

    if(!isset($c)) exit;
    
    //pre($_POST);
    
    if (isset($_POST['table']) AND $_POST['table']==$table['id']) {
        if(isset($_POST['record_action'])){
            switch ($_POST['record_action']) {
                case 'add':
                    if ($table['addable']==1) {
                        include 'add_form.php';
                    };
                    break;
                case 'search':
                    if (isset($table['sql'])) {
                        include 'search_action.php';
                    };
                    break;
                case 'delete':
                    if ($table['deletable']==1) {
                        $ids = explode('|',$_POST['ids']);
                        foreach ($ids as $key=>$value){
                            $ids[$key]='"'.$value.'"';
                        };
                        $sql = '
                            DELETE FROM 
                                '.$table['table'].'
                            WHERE
                                 id IN ('.implode(',',$ids).')
                         ;';
                        do_sql($sql);
                    };
                    break;
                case 'edit': 
                    if ($table['editable']==1) {
                        $ids = explode('|',$_POST['ids']);
                        include 'edit_form.php';
                    };
                    break;
                case 'group_update':
                    if ($table['editable']==1 AND $table['groupeditable']==1 ) {
                        $ids = explode('|',$_POST['ids']);
                        foreach ($ids as $key=>$value){
                            $ids[$key]='"'.$value.'"';
                        };
                        $sql = '
                            UPDATE '.$table['table'].'
                            SET
                                '.addslashes($_POST['name']).'="'.addslashes($_POST['value']).'"
                            WHERE
                                 id IN ('.implode(',',$ids).')
                         ;';
                        do_sql($sql);
                    };
                    break;
                case 'clone':
                    if ($table['editable']==1) {
                        $ids = explode('|',$_POST['ids']);
                        include 'clone_form.php';
                    };
                    break;
                case 'construct':
                    include 'construct.php';
                    break;
                case 'print': case 'csv': 
                    //pre($table['path']);
                    //pre($_POST);
                    break;
            };
        };
    };
