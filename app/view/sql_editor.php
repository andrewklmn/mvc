<?php


    if(!isset($c)) exit;
    
    include_once 'app/view/draw_table_from_sql.php';
    
?>
<script>
    function sql_action(elem){
        $.ajax({
            type: 'POST',
            async: true,
            url: '?c=sql',
            data: { 
                action: $(elem).html(),
                table: $('select#sql_action').val()
            },
            error: function () {
                $('div#result').html('Connection error!');
            },
            success: function (data) {
                $('textarea#sql').val(data);
            }
        });        
    };
</script>
<div class="row">
    <div class="col-lg-9">
        <small style="color:gray;">ALTER TABLE tablename AUTO_INCREMENT = 1;</small>
        <br/>
        <textarea id="sql" style="height:180px;font-size: 11px;" class="field form-control" ></textarea>
    </div>
    <div class="col-lg-3">
            <?php 
                $sql = 'SHOW TABLES;';
                $tables = get_array_from_sql($sql);
            ?>
            Table:
            <br/>
            <select id="sql_action">
                <?php 
                    foreach ($tables as $value) {
                        echo '<option>',  htmlspecialchars($value[0],ENT_QUOTES),'</option>';
                    };
                ?>
            </select>
            <br/>
            <div class="btn-group btn-group-vertical">
                <button type="button" class="btn btn-md btn-primary" onclick="sql_action(this);">Describe table</button>
                <button type="button" class="btn btn-md btn-success" onclick="sql_action(this);">Select all</button>
                <button type="button" class="btn btn-md btn-warning" onclick="sql_action(this);">Update</button>
                <button type="button" class="btn btn-md btn-info" onclick="sql_action(this);">Insert</button>
                <button type="button" class="btn btn-md btn-danger"  onclick="sql_action(this);">Delete</button>
            </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <button 
             class="btn btn-sm btn-info" 
            id='run'
            onclick="
                $.ajax({
                    type: 'POST',
                    async: true,
                    url: '?c=sql',
                    data: { 
                        sql: $('textarea#sql').val(),
                        where: $('input#where').val(),
                        order_by: $('input#order_by').val(),
                        order_type: $('select#order_type').val(),
                        limit: $('input#limit').val(),
                        action: 'sql'
                    },
                    error: function () {
                        $('div#result').html('Connection error!');
                    },
                    success: function (data) {
                        $('div#result').html(data + '<br/>' + $('div#result').html());
                    }
                });
            ">Run SQL</button>
        <button class="btn btn-sm btn-warning" onclick="$('div#result').html('')">Clean history</button>
        <button 
             class="btn btn-sm btn-success" 
            id='run'
            onclick="
                $.ajax({
                    type: 'POST',
                    async: true,
                    url: '?c=sql',
                    data: { 
                        sql: $('textarea#sql').val(),
                        where: $('input#where').val(),
                        order_by: $('input#order_by').val(),
                        order_type: $('select#order_type').val(),
                        limit: $('input#limit').val(),
                        action: 'form'
                    },
                    error: function () {
                        $('div#result').html('Connection error!');
                    },
                    success: function (data) {
                        $('div#result').html(data + '<br/>' + $('div#result').html());
                    }
                });
            ">Make table_form</button>
        WHERE <input style="width:100px;" type='text' id='where' value='' class="field"/>
        ORDER BY <input style="width:100px;" type='text' id='order_by' value='' class="field"/>
        <select style="width:70px;"  id='order_type' class="field">
            <option>ASC</option>
            <option selected="selected">DESC</option>
        </select>
        LIMIT <input style="width:40px;" type='text' id='limit' value='' class="field"/>
    </div>
</div>
<br/>
<br/>
<div id="result"></div>