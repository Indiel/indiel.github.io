<?
    $to = 'market@viral.com.ua'; //Почта получателя, через запятую можно указать сколько угодно адресов
    $subject = 'Заказ'; //Загаловок сообщения
    $message = '
            <html>
                <head>
                    <title>'.$subject.'</title>
                </head>
                <body>
                    <p>Имя: '.$_POST['name'].'</p>
                    <p>Телефон: '.$_POST['phone'].'</p> 
                    <p>Почта: '.$_POST['email'].'</p> 
                    <p>Сообщение:<br>'.$_POST['message'].'</p>                          
                </body>
            </html>'; //Текст нащего сообщения можно использовать HTML теги
    $headers  = "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
    $headers .= "From: Новый клиент (тест)<nikkot08@gmail.com>\r\n"; //Наименование и почта отправителя
    mail($to, $subject, $message, $headers); //Отправка письма с помощью функции mail
?>