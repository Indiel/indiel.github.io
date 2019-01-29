<?php
    $status = 'согласен на погашение';
    $name = $_POST['repay-fullname'];
    $inn = $_POST['repay-inn'];
    $phone = $_POST['repay-phone'] ? $_POST['repay-phone'] : '(не указал), в профиле: ' . $_POST['profile-phone'];
    $expireTerm = $_POST['expire-term'];
    $expireData = $_POST['expire-data'];
    $creditBody = $_POST['credit-body'];
    $creditPerc = $_POST['credit-perc'];
    $repayTotal = $_POST['repay-total'];
    $repayTotalDiscount = $_POST['repay-total-discount'];
    $repayDiscount = $_POST['repay-discount'];

    $token = "748976446:AAGExm8bH_-F708Lzu2WagKJHLYk-nYMzxM";
    $chat_id = "-255006860";
    //-255006860
    //-271826711 - test

    $arr = array(
        'статус: ' => $status,
        'клиент: ' => $name,
        'инн: ' => $inn,
        'телефон: ' => $phone,
        'просрочен на: ' => $expireTerm .' (дней)',
        'брал кредит до: ' => $expireData,
        'тело кредита: ' => $creditBody .' грн',
        'процент по кредиту: ' => $creditPerc .' грн',
        'общая сумма к погашению: ' => $repayTotal .' грн',
        'сумма к погашению по программе: ' => $repayTotalDiscount .' грн',
        'экономия клиента: ' => $repayDiscount .' грн',
    );

    $txt = '';

    foreach($arr as $key => $value) {
        $txt .= "<b>".$key."</b> ".$value."%0A";
    };


    $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");
?>