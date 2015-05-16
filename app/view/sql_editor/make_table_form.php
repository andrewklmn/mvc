<?php

    if(!isset($c)) exit;
    
    include_once 'app/model/get_directory_list.php';
    
    //echo '<pre>';
    //print_r($_POST);
    //echo '</pre>';
    $no_form = 0;
    
    if (isset($_POST['sql'])) {
    
        $fields = fetch_fields_info_from_sql($_POST['sql']);
        $t = array();
        $a = array();
        $title = array();
        foreach ($fields as $value) {
            $t[count($t)]=$value->name;
            $a[count($a)]='left';
            $title[count($title)]=$value->table;
        };
        $header = implode('|', $t);
        $align = implode('|', $a);

        // данные отображения
        $table['id'] = $title[0];
        $table['title'] = $title[0];
        $table['header'] = explode('|', $header );
        $table['align'] = explode('|', $align );
        $table['hide_first'] = 0;

        $table['sql'] = $_POST['sql'];

        // данные сортировки и поиска
        $table['where'] = $_POST['where'];
        $table['order_by'] = $_POST['order_by'];
        $table['order_type'] = $_POST['order_type'];
        $table['limit'] = ($_POST['limit']>0) ? $_POST['limit']:100 ;

        // настройки интерактивности
        $table['editable'] = 1;
        $table['addable'] = 1;
        $table['deletable'] = 1;
        $table['groupeditable'] = 1;
        $table['printable'] = 1;
        $table['csvable'] = 1;
        $table['constructable'] = 1;

        // данные редактирования
        $table['table'] = $title[0];
        $table['label'] = explode('|',$header);
        $table['field'] = explode('|',$header);
        $table['format'] = explode('|','integer|text|text|text|text|text|text');
        $table['default'] = explode('|','||||||');
        $table['path'] = '/table_'.$title[0].'.php';
        
    } else {
        //pre($_POST);
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
$table[\'path\'] = __FILE__;

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
    };
    
    $dir = $_SERVER['DOCUMENT_ROOT'].'/mvc/app/model';
    $like = 'table_';
    $list = get_directory_list($dir,$like);
  
?>
<div class="row">
    <div class="col-lg-12">
        <form role='form' method='POST'>
            <label for='code'>Source code</label>
            <textarea id='code' name='code' class="form-control"><?php 
            
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
                            echo 'table_'.$table['table'].'.php';
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
                    echo 'table_'.$table['table'].'.php';
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
        </form>
    </div>
</div>
<?php

    
    $_POST['code'] = $code;
    unset($_POST['sql']);
    unset($_POST['where']);
    unset($_POST['order_by']);
    unset($_POST['order_type']);
    unset($_POST['limit']);

    if ($no_form==0) {
    include 'app/view/table_form.php';
    };
  
   
    //pre($_POST);
    
?>