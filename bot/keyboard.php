<?php
function keybrd($param,$user_id){
    switch ($param) {
        case 1:
            $keybrd = '{"one_time":false,"buttons":[[{"action":{"type":"text","payload":"{\"button\": \"1\"}","label":"Да"},"color":"positive"},{"action":{"type":"text","payload":"{\"button\": \"2\"}","label":"Нет"},"color":"negative"}]]}';
        break;
        case 3:
     $keybrd = '{"one_time":false,"buttons":[[{"action":{"type":"text","payload":"{\"button\": \"1\"}","label":"Кофеварка"},"color":"negative"},{"action":{"type":"text","payload":"{\"button\": \"2\"}","label":"Свет"},"color":"negative"}],[{"action":{"type":"text","payload":"{\"button\": \"3\"}","label":"Календарь"},"color":"negative"},{"action":{"type":"text","payload":"{\"button\": \"4\"}","label":"Компьютер"},"color":"negative"}],[{"action":{"type":"text","payload":"{\"button\": \"5\"}","label":"Сервер"},"color":"negative"},{"action":{"type":"text","payload":"{\"button\": \"6\"}","label":"Ничего"},"color":"primary"}]]}';
    break;  
        case 4:
     $keybrd = '{"one_time":true,"buttons":[[{"action":{"type":"text","payload":"{\"button\": \"1\"}","label":"Сервер"},"color":"negative"},{"action":{"type":"text","payload":"{\"button\": \"2\"}","label":"Календарь"},"color":"negative"}],[{"action":{"type":"text","payload":"{\"button\": \"3\"}","label":"Компьютер"},"color":"negative"},{"action":{"type":"text","payload":"{\"button\": \"4\"}","label":"Ничего"},"color":"primary"}]]}';
    break; 
    
       case 5:
        $keybrd ='{"one_time":false,"buttons":[[{"action":{"type":"location","payload":"{\"button\": \"1\"}"}}],[{"action":{"type":"open_app","app_id":6979558,"owner_id":-181108510,"hash":"sendKeyboard","label":"Отправить клавиатуру"}}],[{"action":{"type":"vkpay","hash":"action=transfer-to-group&group_id=181108510&aid=10"}}],[{"action":{"type":"text","payload":"{\"button\": \"1\"}","label":"Negative"},"color":"negative"},{"action":{"type":"text","payload":"{\"button\": \"2\"}","label":"Positive"},"color":"positive"},{"action":{"type":"text","payload":"{\"button\": \"2\"}","label":"Primary"},"color":"primary"},{"action":{"type":"text","payload":"{\"button\": \"2\"}","label":"Secondary"},"color":"secondary"}]]}';   
       break;       
        default:
        if (isadmin($user_id)<2)   
    $keybrd = '{"one_time":false,"buttons":[[{"action":{"type":"text","payload":"{\"button\": \"1\"}","label":"Посоветуй фильм"},"color":"primary"},{"action":{"type":"text","payload":"{\"button\": \"2\"}","label":"Время"},"color":"primary"},{"action":{"type":"text","payload":"{\"button\": \"7\"}","label":"Гороскоп"},"color":"primary"}],[{"action":{"type":"text","payload":"{\"button\": \"3\"}","label":"Погода"},"color":"default"},{"action":{"type":"text","payload":"{\"button\": \"4\"}","label":"Раскодируй"},"color":"default"},{"action":{"type":"text","payload":"{\"button\": \"5\"}","label":"Зашифруй"},"color":"default"}],[{"action":{"type":"vkpay","hash":"action=transfer-to-group&group_id=178013145&aid=10"}}]]}';
    else
     $keybrd = '{"one_time":false,"buttons":[[{"action":{"type":"text","payload":"{\"button\": \"1\"}","label":"Чай"},"color":"primary"},{"action":{"type":"text","payload":"{\"button\": \"2\"}","label":"Еще чаю"},"color":"primary"},{"action":{"type":"text","payload":"{\"button\": \"3\"}","label":"Тишина"},"color":"negative"},{"action":{"type":"text","payload":"{\"button\": \"4\"}","label":"Прочел"},"color":"positive"}],[{"action":{"type":"text","payload":"{\"button\": \"5\"}","label":"Посоветуй фильм"},"color":"primary"},{"action":{"type":"text","payload":"{\"button\": \"6\"}","label":"Время"},"color":"primary"}],[{"action":{"type":"text","payload":"{\"button\": \"7\"}","label":"Погода"},"color":"default"},{"action":{"type":"text","payload":"{\"button\": \"8\"}","label":"Раскодируй"},"color":"default"},{"action":{"type":"text","payload":"{\"button\": \"9\"}","label":"Зашифруй"},"color":"default"}]]}';
    break;
    }
     return $keybrd;
}
?>