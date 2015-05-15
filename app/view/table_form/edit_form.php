<?php

    if(!isset($c)) exit;

    include 'fields_prop.php';
    
    if (isset($_POST['save']) AND $_POST['save']=='save') {
        
        $records = explode('||', $_POST['data']);
        
        foreach ($records as $key=>$value) {
            $t = explode('|', $value);
            $fields = array();
            $id = trim($t[0],'"');
            
            include 'check_unique_on_update.php';
                        
            $sql ='
                UPDATE '.$table['table'].'
                SET
                    '.implode(',', $fields).'
                WHERE
                    id="'.addslashes($id).'"
            ;';
            do_sql($sql);
        };
        
        
    } else {
        
        ?>
        <script>
            function save_records(elem) {
                var records = $('form.record');
                var data = [];
                $(records).each(function(){
                    var fields = $(this).find('.field');
                    var record = [];
                    $(fields).each(function(){
                        var t = $(this).val();
                        record[record.length] = '"' + t.replace(/\|/g,'') + '"';
                    });
                    data[data.length] = record.join('|');
                });
                $('form#form > input#data').val(data.join('||'));
                $('form#form').submit();
            };
        </script>
        <?php 
            if (isset($table['title'])) {
                ?>
                    <h3><?php echo $table['title']; ?> - edit records:</h3>
                <?php
            };
        
            foreach ($ids as $key=>$value) {
                $row = fetch_row_from_sql('
                    SELECT
                        '.implode(',', $table['field']).'
                    FROM
                        '.$table['table'].'
                    WHERE
                        id = "'.$value.'"
                ;');
                ?>
                    <div class="alert alert-info">
                        <form class="form-horizontal record" method="POST" role="form">
                            <?php 
                                foreach ($table['field'] as $k=>$v) {
                                    if ($table['hide_first']==1 AND $k==0) {
                                        $display = 'display:none;';
                                    } else {
                                        $display = '';
                                    };
                                    ?>
                                        <div class="form-group" style="<?php echo $display; ?>">
                                            <label class="control-label col-sm-2" for="<?php echo $table['field'][$k]; ?>">
                                                <?php echo $table['label'][$k]; ?>:
                                            </label>
                                            <div class="col-sm-10">
                                            <?php 

                                                switch ($table['format'][$k]) {
                                                    default:
                                                        ?>
                                                            <input type="text" 
                                                                   class="form-control field"
                                                                   maxlength="<?php echo $field_prop[$k]['length']; ?>"
                                                                   <?php if($k==0) echo 'disabled'; ?>
                                                                   id="<?php echo $table['field'][$k]; ?>" 
                                                                   name="<?php echo $table['field'][$k]; ?>" 
                                                                   value="<?php echo htmlfix($row[$k]); ?>"/>
                                                        <?php
                                                        break;
                                                }

                                            ?>
                                            </div>
                                        </div>
                                    <?php
                                };
                            ?>
                        </form>
                    </div>
                <?php
            };
        ?>
        <a href="?<?php echo $_SERVER['QUERY_STRING']; ?>" class="btn btn-md btn-primary">Cancel</a>
        <button onclick="save_records(this);" class="btn btn-md btn-warning">Save changes</button>
        <form method="POST" id="form" style="display: none;">
            <input type="hidden" id="table" name="table" value="<?php echo $table['id']; ?>"/>
            <input type="hidden" id="action" name="action" value="edit"/>
            <input type="hidden" id="save" name="save" value="save"/>
            <input type="hidden" id="data" name="data" value="data"/>    
        </form>
        <?php
        exit;
    };
?>
