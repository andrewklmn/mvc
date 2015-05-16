<?php

    include 'fields_prop.php';

?>
<script>
    function set_value_<?php echo $table['id']; ?>(){
        var trs = $('table#<?php echo $table['id']; ?>').find('span.glyphicon-ok');
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
            name="field_name" class="btn btn-default" 
            style="width:100px;text-align: left;">
        <?php 
            foreach ($table['field'] as $key => $value) {
                if ($field_prop[$key]['key']!='UNI' 
                        AND $field_prop[$key]['key']!='PRI') {
                    echo '<option value="'.htmlfix($value).'">',$table['label'][$key],'</option>';
                };
            };
        ?>
    </select>
    <input role="button" class="btn" type="text" id="val_<?php echo $table['id']; ?>" 
           value="" style="border: #ccc solid thin;width:100px;text-align: center;"/>
    <button class="btn btn-md btn-default" 
            data-toggle="tooltip" title="Set value"
            onclick="set_value_<?php echo $table['id']; ?>();">
        <span class="glyphicon glyphicon-save"></span>
    </button>
</div>
<?php

?>