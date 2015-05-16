<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    include_once 'app/model/get_directory_list.php';
    
    $dir = $_SERVER['DOCUMENT_ROOT'].'/mvc/app/model';
    $like = 'table_';
    $list = get_directory_list($dir,$like);
    
    if (isset($_POST['code'])){
            switch ($_POST['make_form_action']) {
                case 'Load from app/model';
                    include 'app/model/'.$_POST['read_file'];
                    
                    break;
                case 'Preview':
                    $x = eval($_POST['code']);
                    //unset($table['path']);
                    if (!is_null($x)) {
                        ?>
                            <div class='alert alert-danger'>Wrong code!</div>
                        <?php
                        $no_form=1;
                    };                
                    break;
                case 'Save to app/model':
                    if ($_POST['code']<>'') {
                        $x = eval($_POST['code']);
                        //unset($table['path']);
                        if (!is_null($x)) {
                            ?>
                                <div class='alert alert-danger'>Wrong code!</div>
                            <?php
                            $no_form=1;
                        } else {
                            $code = '<?php

'.$_POST['code'].'
    
?>';
                            $filename = $_SERVER['DOCUMENT_ROOT'].'/mvc/app/model/'.$_POST['filename'];
                            ///pre($filename);
                            $result = file_put_contents($filename, $code);
                            if ( $result > 0){
                                echo '<div class="alert alert-success">'.$result.' bytes was saved!</div>';
                                exec('chmod 777 '.$filename);
                            } else {
                                echo '<div class="alert alert-danger">Can not save this file!</div>';
                            };
                        };
                    };
                    break;
                default:
            };
        };
        
?>
    
<form role='form' method='POST'>
            <label for='code'>Source code</label>
            <textarea id='code' style='height: 300px;' name='code' class="form-control"><?php 
            
                $code = '';
                
                foreach ($table as $key => $value) {
                    if (is_array($value)) {
                        $code .= '$table[\''.$key.'\']=explode(\'|\',\''.addslashes(implode('|',$value)).'\');
';                      
                    } else {
                        if ($key=='path') {
                            $code .= '$table[\''.$key.'\']=__FILE__;
';                          
                        } else {
                            $code .= '$table[\''.$key.'\']=\''.addslashes($value).'\';
';                          
                        };
                    };
                };
                
                echo $code;
                
                
            ?></textarea>
            <?php
                //pre($table);
            ?>
            <a class='btn btn-default' href='?<?php echo $_SERVER['QUERY_STRING']; ?>'>Close</a>
            <input type='submit' class='btn btn-primary' name='make_form_action' value="Preview"/>
            Filename for save: 
            <input type='text' name='filename' value="<?php 
                if (isset($_POST['make_form_action'])) {
                    switch ($_POST['make_form_action']) {
                        case 'Load from app/model':
                            echo $_POST['read_file'];
                            break;
                        case 'Save to app/model':
                            echo $_POST['filename'];
                            break;
                        case 'Preview':
                            echo 'table_'.$_POST['table'].'.php';
                            break;
                        default :
                            $t = explode('/', $table['path']);
                            if ($t>1) {
                                echo $t[count($t)-1];
                            } else {
                                echo 'table_'.$table['table'].'.php';
                            };                            
                    };
                } else {
                    $t = explode('/', $table['path']);
                    if ($t>1) {
                        echo $t[count($t)-1];
                    } else {
                        echo 'table_'.$table['table'].'.php';
                    };
                };
            ?>"/>
            <input type='submit' class='btn btn-warning'  name='make_form_action' value="Save to app/model"/>
            Files to read: 
            <select name='read_file'>
                <?php 
                    foreach ($list['files'] as $value) {
                        ?>
                            <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                        <?php
                    };
                ?>
            </select>
            <input type='submit' class='btn btn-success'  name='make_form_action' value="Load from app/model"/>
            <input type='hidden' name='record_action' value="construct"/>
            <input type='hidden' name='table' value="<?php echo $_POST['table']; ?>"/>
        </form>
                               
