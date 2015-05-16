<?php

        if(!isset($c)) exit;

        $_POST['sql'] = 'SELECT * FROM `'.addslashes($_GET['table']).'`';
    
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
        $table['title'] = 'Table - '.$title[0];
        $table['header'] = explode('|', $header );
        $table['align'] = explode('|', $align );
        $table['hide_first'] = 0;

        $table['sql'] = $_POST['sql'];

        // данные сортировки и поиска
        $table['where'] = '';
        $table['order_by'] = $t[0];
        $table['order_type'] = 'DESC';
        $table['limit'] =10 ;

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
    
        include 'app/view/table_form.php';