<?php


    //$data['root'] = $_SERVER['DOCUMENT_ROOT'].'/mvc';
    //$data['current_dir'] = $root;


    include_once 'app/model/get_directory_list.php';


    $root= (isset($data['root']))? $data['root']:$_SERVER['DOCUMENT_ROOT'];
    $dir = (isset($data['current_dir']))? $data['current_dir']:$root;



    if ($_POST['record_action']=='directory') {
        if ($_POST['choise']=='Cancel') {
            $t = explode('/', $_POST['data']);
            unset($t[count($t)-1]);
            unset($_POST['code']);
            $_POST['data']=  implode('/', $t);
        };
        if (is_dir($_POST['data'])) {
            if (substr($_POST['data'],strlen($_POST['data'])-2) == '..') {
                    $t = explode('/',substr($_POST['data'],0,-3));
                    unset($t[count($t)-1]);
                    $dir = implode('/',$t);
                    if (strlen($dir)< strlen($root)) {
                        $dir = $root;  
                    };
            } else {
                if ($_POST['data']<>'') {
                    $dir =  $_POST['data'];
                };
            };
        } else {

            if ($_POST['choise']!='Cancel') {

                //$t = explode('/', $_POST['data']);
                //unset($t[count($t)-1]);
                //$_POST['data']=  implode('/', $t);

                // Открываем файл для редактирования
                if ($_POST['choise']=='Save') {
                    $result = file_put_contents($_POST['data'], $_POST['code']);
                    if ( $result > 0){
                        echo '<div class="alert alert-success">'.$result.' bytes was saved!</div>';
                    } else {
                        echo '<div class="alert alert-danger">Can not save this file!</div>';
                    };
                };

                    $text = file_get_contents($_POST['data'], true);

                ?>  
                    <form method="POST" role="form">
                        <h4 class="form-signin-heading">Edit: <?php echo str_replace($root,'', $_POST['data']); ?></h4>
                        <input type="hidden" name="record_action" value="directory">
                        <input type="hidden" name="data" value="<?php echo $_POST['data']; ?>">
                        <textarea 
                            name="code" style="height:350px;font-family:monospace;" class='form-control'><?php 
                            echo htmlfix($text);
                        ?></textarea>
                        <input class="btn btn-default" type="submit" name="choise" value="Cancel"/>
                        <input class="btn btn-default" id="save" type="submit" name="choise" value="Save"/>
                    </form>
                <?php

                //pre($_POST);
                exit;
            };
        };
    };

    $list = get_directory_list($dir);

    $table['data'] = array(
        array(
            $root,
            '<span class="glyphicon glyphicon-home"></span> /',
            '',
            ''
        )
    );
    foreach ($list['dirs'] as $key => $value) {
        if ($value=='..' AND $root==$dir) {
            
        } else {
            if ($value<>'.') {
                $table['data'][count($table['data'])] = array(
                    $dir.'/'.$value,
                    '<span class="glyphicon glyphicon-'.(($value=='..')?'folder-open':'folder-close').'"></span> '.htmlfix($value), 
                    '',
                    date('Y-m-d H:s:i',filemtime( $dir.'/'.$value ))
                );
            };
        };
    };
    foreach ($list['files'] as $key => $value) {
        $table['data'][count($table['data'])] = array(
            $dir.'/'.$value,
            '<span style="color:blue;"><span class="glyphicon glyphicon-file"></span> '.htmlfix($value).'</span>', 
            filesize($dir.'/'.$value),
            date('Y-m-d H:s:i',filemtime( $dir.'/'.$value ))
        );
    };

    
    $table['id'] = __FILE__;
    $table['title'] = 'Current folder: '.str_replace($root,'',$dir).'/';
    $table['header'] = explode('|','Путь|Имя|Размер|Дата');
    $table['hide_first'] = 1;
    $table['tr_onclick'] =  '';
    $table['tr_ondblclick'] =  '
            $(form).find("input#action").val("directory");
            $(form).find("input#data").val(record[0]);
            $(form).submit();';
    
    include 'app/view/table_form.php';
    

?>
<!--
<div class="container">
    <button class="btn btn-default">Download</button>
    <button class="btn btn-default">Create directory</button>
    <button class="btn btn-default">Create file</button>
    <button class="btn btn-default">Delete</button>
</div>
-->