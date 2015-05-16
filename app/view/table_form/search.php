<?php

    if(!isset($c)) exit;
        
?>
<script>
    function search_<?php echo $table['id']; ?>(elem) {
        var search = $('input#search').val();
        $('form#table_<?php echo $table['id']; ?> > input#action').val('search');
        $('form#table_<?php echo $table['id']; ?> > input#search').val(search);
        $('form#table_<?php echo $table['id']; ?>').submit();
    };
</script>
<!--
<input class="form-control" style="width:200px;border: #ccc solid thin;" 
       type="text" id="search" name="search" value="<?php 
    echo htmlfix($search_query);
?>"/>
<button class="btn btn-md btn-default" onclick="search_<?php echo $table['id']; ?>(this);">
    <span class="glyphicon glyphicon-search"></span>
</button>
-->
<div class="navbar-form navbar-left" role="search">
    <div class="form-group">
        <input type="text" 
               autocomplete="off"
               class="form-control"
               onkeyup="
                    if(event.keyCode == 13) {
                        search_<?php echo $table['id']; ?>(this);
                    };
               ;"
               placeholder="Search" id="search" 
               name="search" 
               value="<?php 
            echo htmlfix($search_query);
        ?>"/>
        <button type="submit" 
                onclick="search_<?php echo $table['id']; ?>(this);"
                class="btn btn-default">
            <span class="glyphicon glyphicon-search"></span>
        </button>
    </div>
</div>