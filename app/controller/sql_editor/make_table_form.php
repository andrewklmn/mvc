<?php

    if(!isset($c)) exit;
    /*
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
     * 
     */
  
    $fields = fetch_fields_info_from_sql($_POST['sql']);
    $t = array();
    $a = array();
    foreach ($fields as $value) {
        $t[count($t)]=$value->name;
        $a[count($a)]='left';
    };
    $header = implode('|', $t);
    $align = implode('|', $a);
    
    // данные отображения
    $table['id'] = 'table1';
    $table['title'] = 'Table1 title';
    $table['header'] = explode('|', $header );
    $table['align'] = explode('|', $align );
    $table['hide_first'] = 0;
    
    /*
    $table['data'] = array(
        explode('|','1|Анна|||||'),
        explode('|','2|Анна|||||'),
        explode('|','3|Анна|||||'),
        explode('|','4|Анна|||||'),
    );
     * 
     */
    
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
    $table['table'] = 'renter';
    $table['label'] = explode('|',$header);
    $table['field'] = explode('|',$header);
    $table['format'] = explode('|','integer|text|text|text|text|text|text');
    $table['default'] = explode('|','||||||');
    $table['path'] = __FILE__;
    
    include 'common/view/table_form.php';
    
?>

