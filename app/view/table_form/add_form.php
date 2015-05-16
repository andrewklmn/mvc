<?php

    if(!isset($c)) exit;
    
    include 'fields_prop.php';
    
    if (isset($_POST['add']) AND $_POST['add']=='add') {
        
        $records = explode('||', $_POST['data']);
        
        foreach ($records as $key=>$value) {
            
            $t = explode('|', $value);
            include 'check_unique_on_add.php';
            
            $sql ='
                INSERT INTO '.$table['table'].'
                    ('.implode(',', $table['field']).')
                VALUES
                    ('.implode(',', $fields).')
            ;';
            do_sql($sql);
        };
        
        
    } else {
        
        ?>
        <script>
            function add_record(elem) {
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
                    <h3><?php echo $table['title']; ?> - add new:</h3>
                <?php
            }
        ?>
        <div class="alert alert-warning">
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
                                <label class="control-label col-lg-1" for="<?php echo $table['field'][$k]; ?>">
                                    <?php echo $table['label'][$k]; ?>:
                                </label>
                                <div class="col-lg-11">
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
                                                       value="<?php echo htmlfix($field_prop[$k]['default']); ?>"/>
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
        <a href="?<?php echo $_SERVER['QUERY_STRING']; ?>" class="btn btn-md btn-default">
            <span class="glyphicon glyphicon-remove"></span>
            Cancel
        </a>
        <button onclick="add_record(this);" class="btn btn-md btn-warning">
            <span class="glyphicon glyphicon-plus"></span>
            Add new record
        </button>
        <form method="POST" id="form" style="display: none;">
            <input type="hidden" id="table" name="table" value="<?php echo $table['id']; ?>"/>
            <input type="hidden" id="action" name="action" value="add"/>
            <input type="hidden" id="save" name="add" value="add"/>
            <input type="hidden" id="data" name="data" value="data"/>    
        </form>
        <?php
        exit;
    };
?>
