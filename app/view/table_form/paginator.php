<?php

    if(!isset($c)) exit;
    
    $see = 5;
    
    $pages = ceil($total/$table['limit']);
    
    $up = $see*(ceil($_POST['page']/$see)-1) + $see;
    
    if ($up > $pages) $up = $pages;
    
    $diap = array(1 + $see*(ceil($_POST['page']/$see)-1), $up );

    if ($total > $table['limit']) {
    
        ?>
        <script>
            function pages_<?php echo $table['id']; ?>(elem){
                $('form#table_<?php echo $table['id']; ?> > input#page').val($(elem).html());
                $('form#table_<?php echo $table['id']; ?>').submit();
            };
            function prev_<?php echo $table['id']; ?>(elem){
                var curr = $('form#<?php echo $table['id']; ?>_action > input#page').val();
                curr = parseInt(curr) - 1;
                if ( parseInt(curr)<1) curr=1;
                $('form#table_<?php echo $table['id']; ?> > input#page').val(curr);
                $('form#table_<?php echo $table['id']; ?>').submit();        
            };
            function next_<?php echo $table['id']; ?>(elem){
                var curr = $('form#table_<?php echo $table['id']; ?> > input#page').val();
                curr = parseInt(curr) + 1;
                if ( parseInt(curr) > <?php echo $pages; ?>) curr = <?php echo $pages; ?>;
                $('form#table_<?php echo $table['id']; ?> > input#page').val(curr);
                $('form#table_<?php echo $table['id']; ?>').submit();        
            };
        </script>
        <ul class="pagination pagination-sm" style='margin: 0px;'>
            <li><a href="#" onclick="prev_<?php echo $table['id']; ?>(this);">Prev</a></li>
            <?php 
                for ($i=$diap[0]; $i<= $diap[1]; $i++) {
                    if (($_POST['page'])==$i) {
                        echo '<li class="active"><a href="#" onclick="pages_',$table['id'],'(this);">',$i,'</a></li>';
                    } else {
                        echo '<li><a href="#" onclick="pages_',$table['id'],'(this);">',$i,'</a></li>';
                    };
                };
            ?>
            <li><a href="#" onclick="next_<?php echo $table['id']; ?>(this);">Next</a></li>
        </ul>
        <?php
    };
?>