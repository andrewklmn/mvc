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
<table>
    <tr>
        <td style="vertical-align: top;">
            <textarea id="sql" style="height:200px;font-size: 11px;" class="field" ></textarea>
            <br/>
            
            WHERE <input type='text' id='where' value='' class="field"/>
            ORDER BY <input type='text' id='order_by' value='' class="field"/>
            <select id='order_type' class="field">
                <option>ASC</option>
                <option selected="selected">DESC</option>
            </select>
            <br/>
            LIMIT <input type='text' id='limit' value='' class="field"/>
            <br/>
            
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
        </td>
        <td style='vertical-align: top;'>
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
            Action:
            <br/>
            <button class="btn btn-xs btn-primary" onclick="sql_action(this);">Describe table</button>
            <br/>
            <button class="btn btn-xs btn-success" onclick="sql_action(this);">Select all</button>
            <br/>
            <button class="btn btn-xs btn-warning" onclick="sql_action(this);">Update</button>
            <br/>
            <button class="btn btn-xs btn-info" onclick="sql_action(this);">Insert</button>
            <br/>
            <button class="btn btn-xs btn-danger"  onclick="sql_action(this);">Delete</button>
            <br/>
            <small>ALTER TABLE tablename AUTO_INCREMENT = 1;</small>
        </td>
    </tr>
</table>
<br/>
<br/>
<div id="result"></div>