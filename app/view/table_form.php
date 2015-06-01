<?php

    /*
     * Table form
     */

    if (isset($table['sql'])) {

        $sql = $table['sql'];
        
        // получаем формулу полей
        $t = fetch_fields_info_from_sql($table['sql']);
        $table['formula'] = array();
        foreach ($t as $key=>$value) {
            $table['formula'][$key]=$value->name;
        };
        
        //=========================================================== WHERE ====
        // Составляем строку поиска в полях
        $search= '';
        if (isset($_POST['search']) AND $_POST['search']<>''){
            $t = array();
            foreach ($table['formula'] as $key=>$value) {
                $t[count($t)] = '('.$value.') like "%'.addslashes($_POST['search']).'%"';
            };
            // строка поиска в полях
            $search = implode(' OR ', $t);
        };
        
        if (isset($table['where']) AND $table['where']<>'') {
            // where задано 
            if ($search<>'') {
                $sql .= ' WHERE '.$table['where'].' AND ('.$search.') ';
            } else {
                $sql .= ' WHERE '.$table['where'];
            };
        } else {
            // where не задано
            if ($search<>'') {
                $sql .= ' WHERE '.$search;
            };
        };

        $count = count_rows_from_sql($sql);
                
        // ========================================================== ORDER ====
        if (isset($_POST['order_by']) AND (int)$_POST['order_by']>=0) {
            if (isset($_POST['order_type']) AND $_POST['order_type']<>'') {
                $sql .= ' ORDER BY '.$table['formula'][$_POST['order_by']].' '.$_POST['order_type'];
            };
        };
        
        
        
    if (isset($table['pagination']) AND $table['pagination']==1 ) {
        //======================================================= LIMIT ========
        if (isset($_POST['limit']) AND (int)$_POST['limit']>0 ) {
            $limit = (int)$_POST['limit'];
        } else {
            if (!isset($table['limit']) OR $table['limit']=='') {
                $limit =10;
            } else {
                $limit = $table['limit'];
            };
        };

        //количество страниц
        $pages = ceil($count/$limit);

        if (isset($_POST['page']) AND (int)$_POST['page']>0 ) {
            $page = $_POST['page'];
            $from = ($_POST['page']-1)*$limit;
            if ($page >= $pages) {
                $page = $pages;
                $from = $count - $limit;
                if ( $from < 0 ) {
                    $from = 0;
                    $page = 1;
                };
            };
        } else {
            $page = 1;
            $from = 0;
        };


        $sql.=' LIMIT '.$from.','.$limit;
    };
        
        
        
        
        //pre($sql);
        $table['data'] = get_array_from_sql($sql);

        
        // Инициализация обязательных параметров
        if (!isset($table['header'])) $table['header'] = $table['formula'];
        if (!isset($table['id'])) $table['id'] = 'table1';
        
        
        // Отображение результата
        ?>
            <style>
                
                
                table<?php echo '#',$table['id']; ?> th,
                table<?php echo '#',$table['id']; ?> tr {
                    cursor: pointer;
                }
                table<?php echo '#'.$table['id']; ?> {
                    margin-bottom: 5px;
                }
                table<?php echo '#'.$table['id']; ?> tr.selected {
                    background-color: #d9edf7;
                }
                table<?php echo '#'.$table['id']; ?> tr.selected:hover,
                table<?php echo '#'.$table['id']; ?> tr.selectedhover {
                    background-color: #a6e1ec;
                }               
                table<?php echo '#'.$table['id']; ?> tr.record {
                    background-color: white;
                }
                table<?php echo '#'.$table['id']; ?> tr.record:hover,
                table<?php echo '#'.$table['id']; ?> tr.recordhover {
                    background-color: #f5f5f5;
                }
            </style>
            <script>
                function <?php echo $table['id']; ?>_table_driver(elem) {
                    //alert(elem.id);
                };
                function <?php echo $table['id']; ?>_th_click(elem) {
                    var span = $(elem).find('span');
                    var order_type = $('form#<?php echo $table['id']; ?>').find('input#order_type');
                    if ($(span[0]).hasClass('glyphicon-arrow-up')) {
                        $('form#<?php echo $table['id']; ?>').find('input#order_type').val('DESC');                        
                    } else {
                        $('form#<?php echo $table['id']; ?>').find('input#order_type').val('ASC');
                    };
                    $('form#<?php echo $table['id']; ?>').find('input#order_by').val(elem.id);
                    $('form#<?php echo $table['id']; ?>').submit();
                };
                function <?php echo $table['id']; ?>_tr_click(elem) {
                    <?php 
                        if (isset($table['selectable']) AND $table['selectable']==1) {
                            ?>
                                var checker = $(elem).find('span.glyphicon');
                                if ($(elem).hasClass('selected')) {
                                    $(elem).removeClass('selected');
                                    $(elem).addClass('record');
                                    $(checker).removeClass('glyphicon-ok');
                                } else {
                                    $(elem).removeClass('record');
                                    $(elem).addClass('selected');
                                    $(checker).addClass('glyphicon-ok');
                                };
                            <?php
                        };
                    ?>
                };
                function <?php echo $table['id']; ?>_page_first(elem) {
                    $('form#<?php echo $table['id']; ?>').find('input#page').val('1');
                    $('form#<?php echo $table['id']; ?>').submit();
                };
                function <?php echo $table['id']; ?>_page_last(elem) {
                    $('form#<?php echo $table['id']; ?>').find('input#page').val('<?php echo $pages; ?>');
                    $('form#<?php echo $table['id']; ?>').submit();
                };
                function <?php echo $table['id']; ?>_page_left(elem) {
                    $('form#<?php echo $table['id']; ?>').find('input#page').val('<?php echo $page - 1; ?>');
                    $('form#<?php echo $table['id']; ?>').submit();
                };
                function <?php echo $table['id']; ?>_page_right(elem) {
                    $('form#<?php echo $table['id']; ?>').find('input#page').val('<?php echo $page + 1; ?>');
                    $('form#<?php echo $table['id']; ?>').submit();
                };
                function <?php echo $table['id']; ?>_page(elem){
                    $('form#<?php echo $table['id']; ?>').find('input#page').val($(elem).html());
                    $('form#<?php echo $table['id']; ?>').submit();                    
                };
                function <?php echo $table['id']; ?>_click_selector_driver(elem) {
                    if( $(elem).hasClass('glyphicon-unchecked')){
                        $($('table#<?php echo $table['id']; ?>').find('span.checker')).addClass('glyphicon-ok');
                        $(elem).removeClass('glyphicon-unchecked');
                        $(elem).addClass('glyphicon-check');
                        var trs = $('table#<?php echo $table['id']; ?>').find('tr.record');
                        $(trs).each(function(){
                            $(this).removeClass('record');
                            $(this).addClass('selected');
                        });
                    } else {
                        $($('table#<?php echo $table['id']; ?>').find('span.checker')).removeClass('glyphicon-ok');
                        $(elem).removeClass('glyphicon-check');
                        $(elem).addClass('glyphicon-unchecked');
                        $($('table#<?php echo $table['id']; ?>').find('tr.selected')).toggleClass('record');
                        var trs = $('table#<?php echo $table['id']; ?>').find('tr.selected');
                        $(trs).each(function(){
                            $(this).removeClass('selected');
                            $(this).addClass('record');
                        });
                    };
                };
            </script>
            <div class="row">
                <div class="col-sm-6 text-left">
                    <h4>
                        <?php echo $table['title']; ?>                    
                    </h4>
                </div>
                <div class="col-sm-6 hidden-print">
                    <div class="navbar-form navbar-right" role="search">
                        <form role="form" method="POST" id="<?php echo $table['id']; ?>">
                            <div class="input-group">
                                <input type="hidden" id="page" name="page" 
                                       value="<?php echo $page; ?>"/>
                                <input type="hidden" id="order_by" name="order_by" 
                                       value="<?php echo $_POST['order_by']; ?>"/>
                                <input type="hidden" id="order_type" name="order_type" 
                                       value="<?php echo $_POST['order_type']; ?>"/>
                                <?php 
                                    if (!isset($table['searchable']) OR $table['searchable']==0) {
                                        ?>
                                            <input id="search" name="search" type="hidden" 
                                                   value="<?php echo $_POST['search']; ?>"/>
                                        <?php
                                    } else {
                                        ?>
                                            <input id="search" name="search" onchange="<?php echo $table['id']; ?>_table_driver(this);" 
                                                   class="form-control input-sm <?php if (isset($_POST['search']) AND $_POST['search']<>'') echo 'alert-success'; ?>" 
                                                   placeholder="Find..." autocomplete="off"
                                                   style="width:140px;text-align: center;" value="<?php echo $_POST['search']; ?>"/>
                                            <button id="search" onclick="table_driver(this);" class="btn btn-sm btn-default">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        <?php
                                    };
                                
                                    if (isset($table['pagination']) AND $table['pagination']==1 ) {
                                        $t = array( 3, 5, 10, 20, 50, 100, 200);
                                        $t[count($t)] = $limit;
                                        sort($t);
                                        $t = array_unique($t);
                                        ?>
                                            <select onchange="$(this.parentNode.parentNode).submit();" name="limit" class="btn btn-sm btn-default">
                                                <?php 
                                                    foreach ($t as $option) {
                                                        if ($option==$limit) {
                                                            ?>
                                                                <option selected><?php echo $option; ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                                <option><?php echo $option; ?></option>
                                                            <?php
                                                        };
                                                    };
                                                ?>
                                            </select>
                                        <?php
                                    };
                                
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table id="<?php echo $table['id']; ?>" 
                           class="table table-condensed table-responsive">
                        <?php
                            if (isset($table['header'])) {
                                ?>
                                    <tr>
                                        <?php 
                                            if (isset($table['selectable']) AND $table['selectable']==1) {
                                                ?>
                                                    <th>
                                                        <span class="hidden-print glyphicon glyphicon-unchecked"
                                                              onclick="<?php echo $table['id']; ?>_click_selector_driver(this);"></span>
                                                    </th>
                                                <?php
                                            };
                                        ?>
                                        <?php
                                            if ($table['count']==1) {
                                                ?>
                                                    <th>#</th>
                                                <?php
                                            };
                                            foreach ($table['header'] as $key=>$value) {
                                                if (isset($table['hide_first']) AND $table['hide_first']==1 AND $key==0) {
                                                    ?>
                                                        <th id="<?php echo $key; ?>" 
                                                            class="hide">
                                                                <?php echo htmlfix($value); ?>
                                                        </th>
                                                    <?php
                                                } else {
                                                    ?>
                                                        <th id="<?php echo $key; ?>" 
                                                            onclick="<?php echo $table['id']; ?>_th_click(this);">
                                                                <?php echo htmlfix($value); ?>
                                                            <span class="glyphicon <?php 
                                                                if ($_POST['order_by']==$key) {
                                                                    if ($_POST['order_type']=='DESC') {
                                                                        echo 'glyphicon-arrow-down';
                                                                    } else {
                                                                        echo 'glyphicon-arrow-up';
                                                                    };
                                                                };
                                                            ?>"></span>
                                                        </th>
                                                    <?php
                                                };
                                            };
                                        ?>
                                    </tr>
                                <?php
                            };
                            
                            $i = $from + 1;
                            
                            foreach ($table['data'] as $key=>$value) {
                                ?>
                                    <tr onclick="<?php echo $table['id']; ?>_tr_click(this);" class="record">
                                        <?php
                                            if (isset($table['selectable']) AND $table['selectable']==1) {
                                                ?>
                                                    <th>
                                                        <span class="glyphicon checker"></span>
                                                    </th>
                                                <?php
                                            };
                                            if ($table['count']==1) {
                                                ?>
                                                    <td><?php echo $i; ?></td>
                                                <?php
                                            };
                                            foreach ($value as $k=>$v) {
                                                if (isset($table['hide_first']) AND $table['hide_first']==1 AND $k==0) {
                                                    echo '<td class="field hide">',htmlfix($v),'</td>';
                                                } else {
                                                    echo '<td class="field">',htmlfix($v),'</td>';
                                                };
                                            };
                                            $i++;
                                        ?>
                                    </tr>
                                <?php
                            };
                        ?>
                    </table>
                </div>
            </div>
            <?php 
                if (isset($table['pagination']) AND $table['pagination']==1 ) {
                    
                    if ( ($from + $limit) >= $count AND ($from + 1)==1) {
                        ?>
                            <div class="row">
                                <div class="col-lg-12 text-left">
                                    <small>
                                        <?php
                                            echo 'Showing ',$count,' from ',$count,' entries'; 
                                        ?>
                                    </small>
                                </div>
                            </div>
                        <?php
                    } else {
                        ?>
                            <div class="row">
                                <div class="col-lg-3 text-left">
                                    <small>
                                        <?php
                                            if (($from + $limit) > $count) {
                                                echo 'Showing ',($from + 1)
                                                    ,' to ',$count,' of ',$count,' entries'; 
                                            } else {
                                                echo 'Showing ',($from + 1)
                                                    ,' to ',($from + $limit),' of ',$count,' entries'; 
                                            };
                                        ?>
                                    </small>
                                </div>
                                <div class="col-lg-9 text-left">
                                    <span class="hidden-print">

                                        <?php 

                                            if ( $page == 1 ) {
                                                ?>
                                                    <<
                                                <?php
                                            } else {
                                                ?>
                                                    <a href="#" onclick="<?php echo $table['id']; ?>_page_left(this);"> << </a>
                                                <?php
                                            };

                                            $max_showing_page = 5;

                                            $start_page = $max_showing_page*(ceil($page/$max_showing_page)-1) + 1;
                                            $max_page = $max_showing_page + $start_page - 1;

                                            if ($max_page > $pages) {
                                                $max_page = $pages;
                                                $start_page = $max_page - $max_showing_page + 1;
                                                if ( $start_page <1 ){
                                                    $start_page = 1;
                                                };
                                            };

                                            if (ceil($page/$max_showing_page) > 1) {
                                                echo '...';
                                            };

                                            for ($i = $start_page; $i <= $max_page; $i++) {
                                                if ($page == $i ) {
                                                    ?>
                                                        <a onclick="<?php echo $table['id']; ?>_page(this);" class="text-warning" href="#"><?php echo $i; ?></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                        <a onclick="<?php echo $table['id']; ?>_page(this);" href="#"><?php echo $i; ?></a>
                                                    <?php
                                                };
                                            };

                                            if ($pages > $max_showing_page
                                                    AND ceil($page/$max_showing_page) < ceil($pages/$max_showing_page)) {
                                                echo '...';
                                            };

                                            if ($page < $pages ) {
                                                ?>
                                                    <a href="#" onclick="<?php echo $table['id']; ?>_page_right(this);"> >> </a>
                                                <?php
                                            } else {
                                                ?>
                                                    >>
                                                <?php

                                            };
                                        ?>
                                    </span>
                                </div>
                            </div>
                        <?php
                    };
                } else {
                    ?>
                        <div class="row">
                            <div class="col-lg-12 text-left">
                                <small>
                                    <?php
                                        if (($from + $limit) > $count) {
                                            echo 'Showing ',($from + 1)
                                                ,' to ',$count,' of ',$count,' entries'; 
                                        } else {
                                            echo 'Showing ',$count,' entries'; 
                                        };
                                    ?>
                                </small>
                            </div>
                        </div>
                    <?php
                };
            ?>
        <?php
    };
    
    if (isset($table['sql']) AND isset($table['editable'])
            AND $table['editable']==1) { 
        ?>
            <div class="input-group">
                <div class="btn-group">
                    <button class="btn btn-default"><span class="glyphicon glyphicon-edit"></span></button>
                    <button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span></button>
                    <button class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button>
                    <!--
                    <button class="btn btn-default"><span class="glyphicon glyphicon-print"></span></button>
                    <button class="btn btn-default"><span class="glyphicon glyphicon-wrench"></span></button>
                    -->
                </div>

                <select class="btn btn-default" style="width: 130px;">
                    <option>Name</option>
                </select>
                <input type="text" id="group_value" value="" style="width: 200px;"/>
                <button class="btn btn-default"><span class="glyphicon glyphicon-save"></span></button>  
            </div>
        <?php
    };

    if (isset($_POST['search']) AND $_POST['search']<>'') {
        ?>
            <script>
                $($('form#<?php echo $table['id']; ?>').find('input#search')).focus();
                $($('form#<?php echo $table['id']; ?>').find('input#search')).select();
            </script>
        <?php
    };
