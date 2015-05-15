<?php

/* 
 * Records editor
 */

    $option = get_array_from_sql('
        SELECT
            name
        FROM
            renter
        ORDER BY name ASC
    ;');

?>
<script>
    function submit_form(elem){
        var trs=get_selected_tr_objects();
        var renter = $('select#renter').val();
        if (trs.length==0) return true;
        $(elem.parentNode.parentNode).hide();
        var ids = [];
        $(trs).each(function(){
            var tds = $(this).find('td.field')
            ids[ids.length] = $(tds[0]).html();
        });
        $('input#renter').val(renter);
        $('input#ids').val(ids.join(','));
        $('form#form').submit();
    };
    function open_object() {
        var trs=get_selected_tr_objects();
        if (trs.length==0) return true;
        var tds = $(trs[0]).find('td.field');
        window.location.href = '?c=object&id=' + $(tds[0]).html();
    };
    function open_object_bills() {
        var trs=get_selected_tr_objects();
        if (trs.length==0) return true;
        var tds = $(trs[0]).find('td.field');
        window.location.href = '?c=object_bills&id=' + $(tds[0]).html();
    };
</script>
<footer class="footer hidden-print">
      <div class="container">
            <form id="form" method="POST">
                <div class="bs-example">
                    <?php 
                        //if (isset($_POST['renter'])) print_r($_POST); 
                    ?>
                    <div class="container">
                        <small>Для выбранных: </small>
                        <select id="renter" name="renter" 
                                style="text-align: left;"
                                class="form-control-static btn btn-default">
                            <?php 
                                foreach ($option as $key => $value) {
                                    ?>
                                        <option value="<?php echo htmlfix($value[0]); ?>">
                                            <?php echo htmlfix($value[0]); ?>
                                        </option>
                                    <?php
                                };
                            ?>
                        </select>
                        <input type="button" onclick="submit_form(this);" class="btn btn-primary" value="Установить"/>
                        <input type="button" onclick="open_object();" 
                               class="btn btn-info" 
                               value="Начисления"/>
                        <input type="button" onclick="open_object_bills();" 
                               class="btn btn-success" 
                               value="Счета и оплаты"/>
                    </div>
                </div>
                <input type="hidden" name="action" value="update">
                <input type="hidden" id="ids" name="ids" value=""/>
            </form>
      </div>
</footer>