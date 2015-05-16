<?php

    if(!isset($c)) exit;

    $row = fetch_row_from_sql('
        SELECT
            id,
            day,
            renter,
            object,
            payment,
            prev,
            current,
            sum
        FROM
            bill
        WHERE
            day="'.addslashes($_GET['day']).'"
            AND renter="'.addslashes($_GET['renter']).'"
    ;');
    
    $subject = 'Счёт по '.$row[3].' от '.$_GET['day'];
    
    
    $positions = get_array_from_sql('
        SELECT
            id,
            payment,
            prev,
            current,
            sum
        FROM
            bill
        WHERE
            day="'.addslashes($_GET['day']).'"
            AND renter="'.addslashes($_GET['renter']).'"
        ORDER BY
            id ASC
    ;');

    $summa = fetch_row_from_sql('
        SELECT
            IFNULL(SUM(sum),0)
        FROM
            bill
        WHERE
            day="'.addslashes($_GET['day']).'"
            AND renter="'.addslashes($_GET['renter']).'"
    ;');
    
    
    
    $before_summa = fetch_row_from_sql('
        SELECT
            IFNULL(SUM(sum),0)
        FROM
            bill
        WHERE
            renter="'.addslashes($_GET['renter']).'"
            AND day<"'.addslashes($_GET['day']).'"
        GROUP BY 
            object
    ;');
    
    $oplaty = fetch_row_from_sql('
        SELECT
            IFNULL(SUM(sum),0)
        FROM
            payment
        WHERE
            renter="'.addslashes($_GET['renter']).'"
        GROUP BY 
            object
        ORDER BY
            id DESC
    ;');
    
    
    $dolg = $before_summa[0] - $oplaty[0];

    $message = '<h4>'.$subject.'</h4><table border="1">';
    $message .= '<tr><th style="padding:5px;">Тип платежа</th>'
            . '<th style="padding:5px;">Предыдущие</th>'
            . '<th style="padding:5px;">Текущие</th>'
            . '<th style="padding:5px;">Сумма</th></tr>';
    foreach ($positions as $key => $value) {
        if (((int)$value[3]-(int)$value[2])==1) {
            $value[2]='-';
            $value[3]='-';
        };
        $message .= '<tr><td style="padding:5px;">'.htmlfix($value[1])
            .'</td><td style="padding:5px;" align="center">'.htmlfix($value[2])
            .'</td><td style="padding:5px;" align="center">'.htmlfix($value[3])
            .'</td><td style="padding:5px;" align="right">'.htmlfix($value[4]).'</td></tr>';
    };
    $message .= '<tr><th colspan="3" style="text-align:right;padding:5px;">Итого на сумму, грн:</th>'
            . '<th style="text-align:right;padding:5px;">'.$summa[0].'</th></tr>';
    if ($dolg<>0) {
        if ($dolg>0) {
            $message .= '<tr><th colspan="3" style="text-align:right;padding:5px;">Долг с прошлых оплат, грн:</th>'
                . '<th style="text-align:right;padding:5px;">'.$dolg.'</th></tr>';
        } else {
            $message .= '<tr><th colspan="3" style="text-align:right;padding:5px;">Переплата с прошлых оплат, грн:</th>'
                . '<th style="text-align:right;padding:5px;">'.(-$dolg).'</th></tr>';
        };
            $message .= '<tr><th colspan="3" style="text-align:right;padding:5px;">К оплате, грн:</th>'
                . '<th style="text-align:right;padding:5px;">'.($summa[0]+$dolg).'</th></tr>';        
    };
    $message .= '</table>';
    
   
    
    $renter = fetch_row_from_sql(
        'SELECT
            id,
            name,
            phone,
            mail,
            passport,
            login,
            pass
        FROM
            renter
        WHERE
           name="'.addslashes($_GET['renter']).'"
    ;');
    
    
    $client_mail = $renter[3];
    
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "Content-type: text/html; charset=utf-8 \r\n"; 
    $headers .= "From: Andrew Klimenyuk <andrew@litos.kiev.ua>\r\n";
    $headers .= "Reply-To: andrew.klmn@gmail.com\r\n";
    $headers .= "Cc: andrew.klmn@gmail.com\r\n";

    if (mail($client_mail, '=?utf-8?B?'.base64_encode('Счёт за аренду').'?=', $message, $headers)) {
        echo '<div class="alert alert-success">Mail was sent!</div>';
    } else {
        echo '<div class="alert alert-danger">Can not send mail!</div>';
    };
