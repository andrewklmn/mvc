<?php

/* 
 * Interactive Table Form
 */

    if(!isset($c)) exit;

    $t = explode('/', $table['id']);
    if (count($t)>1) {
        $t = explode('.',$t[count($t)-1]);
        $table['id'] = $t[0];
    };
    // обтработка редактирования
    include 'table_form/action_driver.php';
    
    // получение данных из источника если отдельно не заданы
    include 'table_form/get_data_from_sql.php';
    
    
?>
<style>
    .table-hover tbody tr:hover > td {
      cursor: pointer
    }
    .table-hover tbody tr:hover > th {
      cursor: pointer
    }
    tr.selected {
        background-color: #d9edf7;
    }
</style>
<script>
    function click_selector_driver_<?php echo $table['id']; ?>(elem) {
        if( $(elem).hasClass('glyphicon-unchecked')){
            $($('table#<?php echo $table['id']; ?>').find('span.checker')).addClass('glyphicon-ok');
            $(elem).removeClass('glyphicon-unchecked');
            $(elem).addClass('glyphicon-check');
        } else {
            $($('table#<?php echo $table['id']; ?>').find('span.checker')).removeClass('glyphicon-ok');
            $(elem).removeClass('glyphicon-check');
            $(elem).addClass('glyphicon-unchecked');
        };
    };
    
    function dbl_click_tr_<?php echo $table['id']; ?>(elem) {
        var t = $(elem).find('td.field');
        var form = $("form#table_<?php echo $table['id']; ?>");
        var record = [];
        $(t).each(function(){
            record[record.length] = $(this).html().trim();
        });
        <?php echo $table['tr_ondblclick']; ?>    
    };
    
    function click_tr_<?php echo $table['id']; ?>(elem) {
        var checker = $(elem).find('span.glyphicon');
        if( $(checker).hasClass('glyphicon-ok')){
            $(checker).removeClass('glyphicon-ok');
            $(elem).removeClass('selected');
        } else {
            $(checker).addClass('glyphicon-ok');
            $(elem).addClass('selected');
        };
        var t = $(elem).find('td.field');
        var form = $("form#table_<?php echo $table['id']; ?>");
        var record = [];
        $(t).each(function(){
            record[record.length] = $(this).html().trim();
        });
        <?php echo $table['tr_onclick']; ?>        
    };
    function edit_<?php echo $table['id']; ?>(elem) {
        var trs = $('table#<?php echo $table['id']; ?>').find('span.glyphicon-ok');
        if (trs.length == 0) return true;
        var ids = [];
        $(trs).each(function(){
            var tds = $(this.parentNode.parentNode).find('td.field')
            ids[ids.length] = $(tds[0]).html();
        });
        $('form#table_<?php echo $table['id']; ?> > input#action').val('edit');
        $('form#table_<?php echo $table['id']; ?> > input#ids').val(ids.join('|'));
        $('form#table_<?php echo $table['id']; ?>').submit();
    };
    function delete_<?php echo $table['id']; ?>(elem) {
        var trs = $('table#<?php echo $table['id']; ?>').find('span.glyphicon-ok');
        if (trs.length == 0) return true;
        if(confirm('Delete selected records?')) {
            var ids = [];
            $(trs).each(function(){
                var tds = $(this.parentNode.parentNode).find('td.field')
                ids[ids.length] = $(tds[0]).html();
            });
            $('form#table_<?php echo $table['id']; ?> > input#action').val('delete');
            $('form#table_<?php echo $table['id']; ?> > input#ids').val(ids.join('|'));
            $('form#table_<?php echo $table['id']; ?>').submit();
        };
    };
    function add_<?php echo $table['id']; ?>(elem) {
        var trs = $('table#<?php echo $table['id']; ?>').find('span.glyphicon-ok');
        if (trs.length == 0) {
            $('form#table_<?php echo $table['id']; ?> > input#action').val('add');
            $('form#table_<?php echo $table['id']; ?>').submit();        
        } else {
            var ids = [];
            $(trs).each(function(){
                var tds = $(this.parentNode.parentNode).find('td.field')
                ids[ids.length] = $(tds[0]).html();
            });
            $('form#table_<?php echo $table['id']; ?> > input#action').val('clone');
            $('form#table_<?php echo $table['id']; ?> > input#ids').val(ids.join('|'));
            $('form#table_<?php echo $table['id']; ?>').submit();            
        };
    };

</script>
<div class="row">
    <div class='col-lg-12'>
        <?php 
            if (isset($table['title'])) {
                ?>
                    <h3><?php echo $table['title']; ?></h3>
                <?php
            };
        ?>
        <table class="table table-hover" 
               id="<?php echo $table['id']; ?>"
               style='margin-bottom: 0px;'>
            <thead>
                <tr>
                    <th>
                        <span class="hidden-print glyphicon glyphicon-unchecked"
                              onclick="click_selector_driver_<?php echo $table['id']; ?>(this);"></span>
                    </th>
                    <?php 
                        foreach ($table['header'] as $key=>$value) {
                            if ($table['hide_first']==1 AND $key==0) {
                                echo '<th style="display:none;text-align:',$table['align'][$key],';">',$value,'</th>';
                            } else {
                                echo '<th style="text-align:',$table['align'][$key],';">',$value,'</th>';                            
                            };
                        };
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($table['data'] as $record) {
                        echo '<tr class="record" ondblclick="dbl_click_tr_'.$table['id'].'(this);" onclick="click_tr_'.$table['id'].'(this);">
                                <th>
                                    <span class="glyphicon checker"></span>
                                </th>';
                        foreach ($record as $key=>$value) {
                            if ($table['hide_first']==1 AND $key==0) {
                                echo '<td style="display:none;" class="field" align="',$table['align'][$key],'">',htmlfix($value),'</td>';
                            } else {
                                if (!isset($table['sql']) OR $table['sql']=='') {
                                    echo '<td class="field" align="',$table['align'][$key],'">',$value,'</td>';
                                } else {
                                    echo '<td class="field" align="',$table['align'][$key],'">',htmlfix($value),'</td>';
                                };
                            };
                        };
                        echo '</tr>';
                    };
                ?>        
            </tbody>
        </table>
    </div>
</div>
<div class="row hidden-print">
    <div class='col-lg-12'>
        <div class='' style='padding: 3px;'>
            <div class="text-left" style='padding: 0px;'>
                <small>
                    <?php
                        include 'table_form/entries_string.php';
                    ?>
                </small>
            </div>
        </div>
    </div>
</div>
<?php 
    if (isset($table['sql']) AND $table['sql']<>'') {
?>
    <div class='row hidden-print'>
        <div class="col-lg-8" style='padding-top: 5px;'>
             <div class="btn-group">
        <?php


                if ($table['editable']==1) echo '<button type="button" onclick="edit_'.
                        $table['id'].'(this);" class="btn btn btn-default"
                            data-toggle="tooltip" title="Edit">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button> ';
                /*
                if ($table['addable']==1) echo '<button type="button" onclick="clone_'.
                        $table['id'].'(this);" class="btn btn-md btn-default"
                            data-toggle="tooltip" title="Clone">
                            <span class="glyphicon glyphicon-tags"></span>
                        </button> ';
                 */

                if ($table['addable']==1) echo '<button type="button" onclick="add_'.
                        $table['id'].'(this);" class="btn btn-md btn-default"
                            data-toggle="tooltip" title="Add">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button> ';

                if ($table['deletable']==1) echo '<button type="button" onclick="delete_'.
                        $table['id'].'(this);" class="btn btn-md btn-default"
                            data-toggle="tooltip" title="Delete">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>';
            ?>
              <div class="btn-group">
                <?php
                    include 'table_form/tools.php';
                ?>
              </div>
            </div>
            <?php
                if ($table['groupeditable']==1 AND $table['editable']==1) {
                    include 'table_form/group_update_menu.php';
                };  
            ?>
        </div>
        <div class="col-lg-4 text-center" style='padding-top: 5px;'>  
            <?php
                include 'table_form/paginator.php';
        ?>
    </div>
    <?php 
        };
    ?>
    <form id="table_<?php echo $table['id']; ?>" style="display: none;" method="POST">
        <input type="hidden" id="action" name="action" value=""/>
        <input type="hidden" id="table" name="table" value="<?php echo $table['id']; ?>"/>
        <input type="hidden" id="name" name="name" value=""/>
        <input type="hidden" id="value" name="value" value=""/>
        <input type="hidden" id="ids" name="ids" value=""/>
        <input type='hidden' id='data' name='data' value=''>
        <!-- раздел для фильтра, сортировки, страницы -->
        <input type="hidden" id="page" name="page" value="<?php echo $_POST['page']; ?>"/>
    </form> 
</div>
<?php unset($table); ?>