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
        function update_records(){
            var forms = $('form.form-inline');
            var data = [];
            $(forms).each(function(){
                var id = $('input#id').val();
                var payment_type = $('select#payment_type').val();
                var average_amount = $('input#average_amount').val();
                var sum = $('input#sum').val();
                data[data.length] = id + '|'
                    + payment_type + '|'
                    + average_amount + '|'
                    + sum;
            });
            $('input#records').val(data.join("||"));
            $('form#post').submit();
        };
    </script>
    <h3><?php echo $row[1]; ?> - редактирование начислений </h3>
<?php
    
    foreach ($ids as $id) {
        $row = fetch_row_from_sql('
            SELECT
                id,
                payment_type,
                average_amount,
                sum
            FROM
                current_price
            WHERE
                id="'.addslashes($id).'"
        ;');
        ?>
            <div class="container">
                <form class="form-inline" role="form">
                    <div class="form-group">
                      <label for="id">Код:</label>
                      <input type="text" class="form-control" id="id" 
                             name="id" readonly value="<?php echo $row[0]; ?>">
                    </div>
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
                             name="average_amount" value="<?php echo $row[2]; ?>">
                    </div>
                    <div class="form-group">
                      <label for="sum">Цена:</label>
                      <input type="text" class="form-control" id="sum" name="sum" value="<?php echo $row[3]; ?>">
                    </div>
                </form>
            </div>
        <?php
    }
?>
    <a href="?c=object&id=<?php echo $_GET['id']; ?>" class="btn btn-primary">Отменить</a>
    <button class="btn btn-warning" onclick="update_records();">Сохранить</button>
    <form id="post" method="POST" style="display: none;">
        <input type="hidden" id="records" name="records" value="">
        <input type="hidden" name="action" value="update_records">
    </form>