<?php

/* 
 * Редактор записей
 */
    if(!isset($c)) exit;
    
    $ids = explode(',', $_POST['ids']);
    $payment_type = get_array_from_sql('
        SELECT
            name
        FROM
            payment_type
        ORDER BY name ASC
    ;');
    
?>
    <script>
        function add_record(){
            var payment_type = $('select#payment_type').val();
            var average_amount = $('input#average_amount').val();
            var sum = $('input#sum').val();
            var data = payment_type + '|'
                + average_amount + '|'
                + sum;
            
            $('input#record').val(data);
            $('form#post').submit();
        };
    </script>
        <h3><?php echo $row[1]; ?> - добавление начисления </h3>
            <div class="container">
                <form class="form-inline" role="form">
                    <div class="form-group">
                      <label for="payment_type">Тип:</label>
                        <select class="form-control" id="payment_type" name="payment_type">
                            <?php 
                                foreach ($payment_type as $value) {
                                    if ($value[0]==$row[1]) {
                                        echo '<option selected value="',htmlfix($value[0]),'">',htmlfix($value[0]),'</option>';
                                    } else {
                                        echo '<option value="',htmlfix($value[0]),'">',htmlfix($value[0]),'</option>';
                                    };
                                };
                            ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <label for="average_amount">Количество:</label>
                      <input type="text" class="form-control" id="average_amount" 
                             name="average_amount" value="1">
                    </div>
                    <div class="form-group">
                      <label for="sum">Цена:</label>
                      <input type="text" class="form-control" id="sum" name="sum" value="0">
                    </div>
                </form>
            </div>
        <?php
?>
    <a href="?c=object&id=<?php echo $_GET['id']; ?>" class="btn btn-primary">Отменить</a>
    <button class="btn btn-warning" onclick="add_record();">Добавить</button>
    <form id="post" method="POST" style="display: none;">
        <input type="hidden" id="record" name="record" value="">
        <input type="hidden" name="action" value="add_record">
    </form>