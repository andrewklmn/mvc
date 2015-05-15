<?php

    if(!isset($c)) exit;
    
    
    $day = date("Y-m-d");
    
?>
<script>
    function open_bill(){
        var trs = get_selected_tr_bills();
        if (trs.length == 0) return;
        var tds = $(trs[0]).find('td');
        location.href = '?c=bill&day=' 
                + encodeURIComponent($(tds[0]).html())
                + '&renter=' + encodeURIComponent("<?php echo $renter; ?>");
    };
    function add_payment(){
        location.href = '?c=add_new_payment&id=' 
                + encodeURIComponent("<?php echo $_GET['id']; ?>")
                + '&renter=' + encodeURIComponent("<?php echo $renter; ?>")
                + '&object=' + encodeURIComponent("<?php echo $row[1]; ?>");
    };
</script>
    <button class="btn btn-primary" onclick="open_bill();">Открыть счёт</button>
    <button class="btn btn-danger" onclick="add_payment();">Добавить оплату</button>
