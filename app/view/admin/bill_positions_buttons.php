<?php

/* 
 * current prices editor
 */


?>
<script>
    function edit_selected(elem) {
        var trs=get_selected_tr_positions();
        if (trs.length==0) return true;
        var ids = [];
        $(trs).each(function(){
            var tds = $(this).find('td');
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
    function mail_bill(elem) {
        $('input#action').val('mail_bill');
        $('form#form').submit();        
    }
    function delete_record(elem) {
        var trs=get_selected_tr_positions();
        if (trs.length==0) return true;
        var ids = [];
        $(trs).each(function(){
            var tds = $(this).find('td');
            ids[ids.length] = $(tds[0]).html();
        });
        if (confirm('Удалить выбранные записи?')) {
            $('input#action').val('delete');
            $('input#ids').val(ids.join(','));
            $('form#form').submit();
        };
    }
</script>
<footer class="footer hidden-print">
      <div class="container">
            <form id="form" method="POST">
                <a class="btn btn-default" href="?c=object_bills&id=<?php echo $_GET['id']; ?>">Назад к счетам</a>
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
                <!--
                <a href='?c=make_bill&id=<?php echo $_GET['id']; ?>' 
                   class='btn btn-warning'>Создать счёт</a>
                -->
                <input type="button" onclick="mail_bill(this);" 
                       class="btn btn-success" 
                       value="Отправить счёт по емейл"/>
            </form>
      </div>
</footer>