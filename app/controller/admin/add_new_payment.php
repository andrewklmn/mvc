<?php


    if(!isset($c)) exit;
    include_once 'common/model/db/db.php';
    include_once 'common/view/draw_table_from_sql.php';
    
    
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add_new_payment':
                if ($_POST['sum']>0) {
                    do_sql('
                        INSERT INTO payment
                            (
                            day,
                            renter,
                            object,
                            sum)
                        VALUES
                            (
                             "'.date('Y-m-d').'",
                             "'.addslashes($_GET['renter']).'",
                             "'.addslashes($_GET['object']).'",
                             "'.addslashes($_POST['sum']).'")
                            
                    ');
                    header('location: ?c=object_bills&id='.$_GET['id']);
                    exit; 
                };
                break;
            default:
        };
    };
    
    $data['title'] = 'Оплата от: '.$_GET['renter'];
    include 'common/view/bootstrap_html_header.php';
    include_once 'common/view/draw_table_from_sql.php';
        
?>
<script>

</script>
<style type="text/css">

</style>
<div class="container">
    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="?c=index">Объекты</a></li>
        <li><a href="?c=renters">Арендаторы</a></li>
        <li><a href="?c=sql">SQL командер</a></li>
    </ul>
    <h3>Введите сумму оплаты от клиента - <?php echo htmlfix($_GET['renter']); ?></h3>
    <form method='POST'>
        <input type="text" style="text-align: center;"  
               class="form-control-static" name="sum" value="0"/> грн
        <br/>
        <br/>
        <input type='hidden' name='action' value='add_new_payment'>
        <a class='btn btn-primary' href='?c=object_bills&id=<?php echo $_GET['id']; ?>'>Отменить</a>
        <input type='submit' class='btn btn-danger' value='Сохранить оплату'/>
    </form>
</div>
    <?php
        
    ?>
</body>
</html>                                		