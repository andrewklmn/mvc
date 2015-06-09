<?php

    // Check run constant
    if(!isset($c)) exit;
    
    include 'app/view/header_utf-8.php';
    include 'app/view/html_head.php';
    include_once 'app/view/draw_table_from_sql.php';
    
    include 'app/model/admin_menu.php';
    include 'app/view/menu.php';
    
?>
<br/>
<div class="container">
    <?php

        // Определение свойств модели таблицы
        $table['title'] = 'Арендаторы';
        //$table['id'] = 'table1';
        $table['sql'] = '
            SELECT
                *
            FROM
                renter
        ';
        $table['limit'] = '10';
        $table['count'] = 1;
        $table['hide_first'] = 1;
        $table['pagination'] = 1;
        $table['selectable'] = 1;        
        $table['searchable'] = 1;        
        $table['editable'] = 1;

        // Отображение представления таблицы
        include 'app/view/table_form.php';


    ?>
</div>
</body>
</html>
