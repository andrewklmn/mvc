<?php

/* 
 * current prices editor
 */


?>
<script>
    function edit_selected(elem) {
        var trs=get_selected_tr_prices();
        if (trs.length==0) return true;
        var ids = [];
        $(trs).each(function(){
            var tds = $(this).find('td.field');
            ids[ids.length] = $(tds[0]).html();
        });        
        $('input#action').val('update');
        $('input#ids').val(ids.join(','));
        $('form#form').submit();
    }
    function add_new(elem) {
        $('input#action').val('add');
        $('form#form').submit();        
    }
    function delete_record(elem) {
        var trs=get_selected_tr_prices();
        if (trs.length==0) return true;
        var ids = [];
        $(trs).each(function(){
            var tds = $(this).find('td.field');
            ids[ids.length] = $(tds[0]).html();
        });
        if (confirm('Удалить выбранные записи?')) {
            $('input#action').val('delete');
            $('input#ids').val(ids.join(','));
            $('form#form').submit();
        };
    }
</script>
<footer class="footer">
      <div class="container">
            <form id="form" method="POST">
                <a class="btn btn-default" href="?c=index">Назад к объектам</a>
                <input type="button" onclick="edit_selected(this);" 
                       class="btn btn-primary" 
                       value="Редактировать"/>
                <input type="button" onclick="add_new(this);" 
                       class="btn btn-info" 
                       value="Добавить"/>
                <input type="button" onclick="delete_record(this);" 
                       class="btn btn-danger" 
                       value="Удалить"/>
                <input type="hidden" id="action" name="action" value="">
                <input type="hidden" id="ids" name="ids" value=""/>
                <a href='?c=make_bill&id=<?php echo $_GET['id']; ?>' 
                   class='btn btn-warning'>Создать счёт</a>
            </form>
      </div>
</footer>