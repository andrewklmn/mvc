<?php

    include 'fields_prop.php';

?>
<script>
    function set_value_<?php echo $table['id']; ?>(){
        var trs = $('table#<?php echo $table['id']; ?>').find('span.checker');
        var val = $('input#val_<?php echo $table['id']; ?>');
        var name = $('select#name_<?php echo $table['id']; ?>');
        if (trs.length == 0) return true;
        var ids = [];
        $(trs).each(function(){
            var tds = $(this.parentNode.parentNode).find('td.field')
            ids[ids.length] = $(tds[0]).html();
        });
        $('form#table_<?php echo $table['id']; ?> > input#action').val('group_update');
        $('form#table_<?php echo $table['id']; ?> > input#ids').val(ids.join('|'));
        $('form#table_<?php echo $table['id']; ?> > input#name').val($(name).val());
        $('form#table_<?php echo $table['id']; ?> > input#value').val($(val).val());
        $('form#table_<?php echo $table['id']; ?>').submit();
    };
</script>
<div class="btn-group">
    <select id="name_<?php echo $table['id']; ?>" 
            name="field_name" class="btn btn-sm btn-default" 
            style="width:110px;text-align: left;">
        <?php 
            foreach ($table['field'] as $key => $value) {
                if ($field_prop[$key]['key']!='UNI' 
                        AND $field_prop[$key]['key']!='PRI') {
                    echo '<option value="'.htmlfix($value).'">',$table['label'][$key],'</option>';
                };
            };
        ?>
    </select>
    <input role="button" class="input-sm form-control btn btn-md" type="text" id="val_<?php echo $table['id']; ?>" 
           placeholder="Enter value..."
           value="" style="width:100px;text-align: center;"/>
    <button class="btn btn-md btn-default" 
            data-toggle="tooltip" title="Set value"
            onclick="set_value_<?php echo $table['id']; ?>();">
        <span class="glyphicon glyphicon-save"></span>
    </button>
</div>
<?php

?>