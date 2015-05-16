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
            var forms = $('form.record');
            var data = [];
            $(forms).each(function(){
                var fields = $(this).find('.field');
                var record = [];
                $(fields).each(function(){
                    record[record.length] = '"' + $(this).val() + '"';
                });
                data[data.length] = record.join('|');
            });
            $('input#records').val(data.join("||"));
            $('form#post').submit();
        };
        function blur_curr_prev(elem){
            var prev = $(elem.parentNode.parentNode).find('input#prev');
            var curr = $(elem.parentNode.parentNode).find('input#curr');
            var sum = $(elem.parentNode.parentNode).find('input#sum');
            var tarif = $(sum).attr('oldvalue')/($(curr).attr('oldvalue')-$(prev).attr('oldvalue'));
            var new_summ = tarif*($(curr).val()-$(prev).val());
            $(sum).val(Math.round(new_summ));
        };
        
    </script>
    <h3><?php echo $row[1]; ?> - редактирование позиций счета </h3>
<?php
    
    foreach ($ids as $id) {
        $row = fetch_row_from_sql('
            SELECT
                id,
                payment,
                prev,
                current,
                sum
            FROM
                bill
            WHERE
                id="'.$id.'"
        ;');
        ?>
            <div class="container">
                <form class="form-inline record" role="form">
                    <div class="form-group">
                      <label for="id">Код:</label>
                      <input type="text" class="form-control field" id="id" 
                             name="id" style="text-align: center;width: 60px;"
                             readonly value="<?php echo $row[0]; ?>">                            
                    </div>
                    <div class="form-group">
                        <label for="payment">Тип:</label>
                        <select class="form-control field" id="payment" name="payment">
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
                      <label for="prev">Было:</label>
                      <input type="text" class="form-control field" id="prev" 
                             name="prev" style="text-align: center;width: 70px;"
                             onblur="blur_curr_prev(this);"
                             oldvalue="<?php echo $row[2]; ?>"
                             value="<?php echo $row[2]; ?>">
                    </div>
                    <div class="form-group">
                      <label for="curr">Стало:</label>
                      <input type="text" class="form-control field" id="curr" 
                             name="curr" style="text-align: center;width: 70px;"
                             onblur="blur_curr_prev(this);"
                             oldvalue="<?php echo $row[3]; ?>"
                             value="<?php echo $row[3]; ?>">
                    </div>
                    <div class="form-group">
                      <label for="sum">Цена:</label>
                      <input type="text" class="form-control field" 
                             id="sum" name="sum" 
                             oldvalue="<?php echo $row[4]; ?>"
                             value="<?php echo $row[4]; ?>">
                    </div>
                </form>
            </div>
        <?php
    }
?>
    <br/>
    <a href="?c=bill&day=<?php echo urlencode($_GET['day']); ?>&renter=<?php echo urlencode($_GET['renter']); ?>&id=4=<?php echo urlencode($_GET['id']); ?>" class="btn btn-primary">Отменить</a>
    <button class="btn btn-warning" onclick="update_records();">Сохранить</button>
    <form id="post" method="POST" style="display: none;">
        <input type="hidden" id="records" name="records" value="">
        <input type="hidden" name="action" value="update_records">
    </form>