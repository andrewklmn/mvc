<?php

    if(!isset($c)) exit;
    //if ($table['printable']==1) echo '<button type="button" onclick="print_'.$table['id'].'(this);" class="btn btn-md btn-default">Print</button> ';
    //if ($table['csvable']==1) echo '<button type="button" onclick="csv_'.$table['id'].'(this);" class="btn btn-md btn-default">CSV</button>';

?>
<script>
    function csv_<?php echo $table['id']; ?>(elem) {
        var trs = $('table#<?php echo $table['id']; ?>').find('span.glyphicon-ok');
        var ids = [];
        $(trs).each(function(){
            var tds = $(this.parentNode.parentNode).find('td.field')
            ids[ids.length] = $(tds[0]).html();
        });
        $('form#table_<?php echo $table['id']; ?> > input#ids').val(ids.join('|'));
        $('form#table_<?php echo $table['id']; ?> > input#action').val('csv');
        $('form#table_<?php echo $table['id']; ?>').submit();        
    };
    function print_<?php echo $table['id']; ?>(elem) {
        var trs = $('table#<?php echo $table['id']; ?>').find('span.glyphicon-ok');
        var ids = [];
        $(trs).each(function(){
            var tds = $(this.parentNode.parentNode).find('td.field')
            ids[ids.length] = $(tds[0]).html();
        });
        $('form#table_<?php echo $table['id']; ?> > input#ids').val(ids.join('|'));
        $('form#table_<?php echo $table['id']; ?> > input#action').val('print');
        $('form#table_<?php echo $table['id']; ?>').submit();        
    };
    function construct_<?php echo $table['id']; ?>(elem) {
        var trs = $('table#<?php echo $table['id']; ?>').find('span.glyphicon-ok');
        var ids = [];
        $(trs).each(function(){
            var tds = $(this.parentNode.parentNode).find('td.field')
            ids[ids.length] = $(tds[0]).html();
        });
        $('form#table_<?php echo $table['id']; ?> > input#ids').val(ids.join('|'));
        $('form#table_<?php echo $table['id']; ?> > input#action').val('construct');
        $('form#table_<?php echo $table['id']; ?>').submit();        
    };
    
</script>
<button class="btn btn-md btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span><span class="caret"></span></button>
<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
  <li role="presentation">
      <a role="menuitem" tabindex="-1" href="#"
         onclick="print_<?php echo $table['id']; ?>();">Print</a>
  </li>
  <li role="presentation">
      <a role="menuitem" tabindex="-1" href="#"
         onclick="csv_<?php echo $table['id']; ?>();">CSV</a>
  </li>
  <li role="presentation">
      <a role="menuitem" tabindex="-1" href="#"
         onclick="construct_<?php echo $table['id']; ?>();">Construct</a>
  </li>
</ul>
