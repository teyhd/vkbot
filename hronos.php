<?php
header('Content-type: text/html; charset=utf-8');
require('phpQuery/phpQuery/phpQuery.php');
require_once 'config.php';
require_once 'global.php';
require_once 'api/vk_api.php';
require_once 'bot/bot.php';
require_once 'bot/smart_house.php'; 
require_once 'bot/function.php'; 
require_once 'bot/keyboard.php'; 
require_once 'bot/mysql_func.php'; 
require_once 'bot/non_msg.php'; 

define("SUGG_INTERVAL",5);
define("ADMIN_ID",120161867);

echo("Запущен протокол hronos\n");
musicon("/glados/wakeup01");
send_msg(ADMIN_ID,"Сервер включен. Загрузка настроек...");
sleep(2);
musicon("/glados/wakeup02");
send_msg(ADMIN_ID,"Натсройки успешно загружены!");
sleep(1);
send_msg(ADMIN_ID,"Инициализация модуля персональности..."); //hubstage01a01.mp3
musicon("/glados/bootupsequence12");
sleep(2);
send_msg(ADMIN_ID,"Данные успешно загружены!");
musicon("/glados/hubstage01a01");
sleep(6); 
send_msg(ADMIN_ID,"Запуск протокола хронос...");//bootupsequence1801
musicon("/glados/bootupsequence13");
sleep(5); 
send_msg(ADMIN_ID,"Протокол хронос успешно запущен!");
musicon("/glados/bootupsequence1801");
$temp_text = 'none';
$sugg_time_count = 0;
while(true){
$hours=date("H");
$min = date("i");
$sec = date("s");

if (($hours=="22")&&($min=="00")&&($sec=="00")) { //00:05:00 Обновление гороскопа
    s_horoscop();
    send_msg(ADMIN_ID,"Гороскопы успешно обновлены. Сейчас отправим ваш!");
    send_msg(ADMIN_ID,horoscop(ADMIN_ID));
}

if (($hours=="13")&&($min=="00")&&($sec=="00")) { //13:00:00 Рассылка гороскопа
    hroscop_to_users();
    send_msg(ADMIN_ID,"Рассылка гороскопов пользователям прошла успешно");
}

if (($hours=="00")&&($min=="00")&&($sec=="00")) { //Выключение всего hubstage01a05_01
    blackout_sugg(ADMIN_ID);
    musicon("/glados/hubstage01a0501");
}
if (($hours=="00")&&($min=="30")&&($sec=="00")) { //Выключение всего sppaintjumpwall01
    musicon("/glados/sppaintjumpwall01");
    sleep(7);
    blackout_sugg(ADMIN_ID);
    musicon("/glados/sppaintjumpwalljumps02");
}
if (($hours=="01")&&($min=="00")&&($sec=="00")) { //Выключение всего
    musicon("/glados/spa2columnblocker05");
    blackout_sugg(ADMIN_ID);
}
if (($hours=="01")&&($min=="30")&&($sec=="00")) { //Выключение всего
    musicon("/glados/monster01");
    blackout_sugg(ADMIN_ID);
}
if (($hours=="02")&&($min=="00")&&($sec=="00")) { //Выключение всего
    musicon("/glados/sppaintjumpwall01");
    sleep(7);
    blackout_sugg(ADMIN_ID);
    musicon("/glados/sppaintjumpwalljumps02");
}
if (($hours=="02")&&($min=="30")&&($sec=="00")) { //Выключение всего
    blackout_sugg(ADMIN_ID);
    musicon("/glados/splaserpoweredliftcompletion02");
}
if (($hours=="03")&&($min=="00")&&($sec=="00")) { //Выключение всего
    musicon("/glados/monster01");
    blackout_sugg(ADMIN_ID);
}
if (($hours=="03")&&($min=="30")&&($sec=="00")) { //Выключение всего
    musicon("/glados/spa2columnblocker05");
    blackout_sugg(ADMIN_ID);
}
if (($hours=="04")&&($min=="00")&&($sec=="00")) { //Выключение всего
    musicon("/glados/sppaintjumpwall01");
    sleep(7);
    blackout_sugg(ADMIN_ID);
    musicon("/glados/sppaintjumpwalljumps02");
}

if ($sugg_time_count==SUGG_INTERVAL){ //Время предложек
    admin_list();
    $sugg_time_count=0;
}

if (($hours=="12")&&($min=="00")&&($sec=="00")){
 advice_to_users();
}
if (($hours=="16")&&($min=="00")&&($sec=="00")){
 advice_to_users();
}
if (($hours=="20")&&($min=="00")&&($sec=="00")){
 advice_to_users();
}
if (($hours=="22")&&($min=="00")&&($sec=="00")){
 advice_to_users();
}


if (($hours=="13")&&($min=="00")&&($sec=="00")){
 phrase_to_users();
}
if (($hours=="17")&&($min=="00")&&($sec=="00")){
 phrase_to_users();
}
if (($hours=="21")&&($min=="00")&&($sec=="00")){
 phrase_to_users();
}
if (($hours=="23")&&($min=="00")&&($sec=="00")){
 phrase_to_users();
}


if ($sec=="00"){
    $sugg_time_count++;
    echo("Счетчик минут:{$sugg_time_count}\n");
}

$temp_text = text_to_all('get','none');
if ($temp_text!="none"){
    send_to_all($temp_text);
    text_to_all('set','none');
}

$event = date("H:i"); //Время для поиска в базе
active($event);

sleep(1);   
}


//Все предложки
function drink_sugg($user_id){
$rand = rand(0,5);  
$sugg_arr = array("Не хочешь чаю?","Может чайку?","Как насчет чаю?!","Кофе?","Чаю?","Сделай паузу выпей чаю! Сделать?!");
setdialog($user_id,"drink_sug");
$keyboard = keybrd(1,$user_id); //Клавиатура ДА НЕТ
vkApi_messagesSend($user_id,$sugg_arr[$rand],'',$keyboard);    
echo("Напитки предложка для {$user_id}\n");
}//Напитки предложка
function game_sugg($user_id){
$rand = rand(0,5);  
$sugg_arr = array("Не хочешь поиграть в Виселицу?!","Может пряню помучаем!?","Пряня скучает по тебе! Сходим?!","Может передохнешь и сыграешь в Анаграммы","Правда или Ложь - вот что поднимает тебе настроение и зарядит мозг","Правда или Ложь? Играть или не играть? Ох, уж эти вечные вопросы бытия!");
switch ($rand) {
    case 0:
    case 1:
    case 2:
      setdialog($user_id,"hang_sug");
    break;
    case 3:
      setdialog($user_id,"ann_sug");
    break;
    case 4:
    case 5:
     setdialog($user_id,"true_sug");
    break;
}
$keyboard = keybrd(1,$user_id); //Клавиатура ДА НЕТ
vkApi_messagesSend($user_id,$sugg_arr[$rand],'',$keyboard);    
echo("Игры предложка для {$user_id}");
}//Игры предложка
function verbal_sugg($user_id){
$rand = rand(0,5); 
switch ($rand) {
    case 0:
      $username = usrname($user_id,'get',1); 
      $msg = "АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}";
    break;
    case 1:
      $msg = sayme();
    break;
    case 2:
       $msg = weather($user_id);
    break;
    case 3:
       $msg = "Хотел предложить чаю, но передумал";
    break;
    case 4:
       $msg = sayme();
    break;
    case 5:
       $temtime = date("H:i");
       $msg = "Сейчас: {$temtime}";
    break;    
}
send_msg($user_id,$msg);  
echo("Текстовая предложка: {$msg}. для {$user_id}\n");
}//Текстовые предложки
function admin_sugg($user_id){
$rand = rand(0,5);
switch ($rand) {
    case 0:
        drink_sugg($user_id);
    break;
    case 1:
        verbal_sugg($user_id);
    break;
    case 2:
        game_sugg($user_id);
    break; 
    default:
        verbal_sugg($user_id);
    break;
}
}//Админские предложки
function blackout_sugg($user_id){
$rand = rand(0,5);  
$sugg_arr = array("Уже достаточно поздно. Выключить технику в доме?","Самое время устроить BlackOut","Ты видел время? Может это время для BlackOut","Может все выключить?","Как думаешь сейчас можно выключить все?","Ложись спать уже поздно. Я выключаю технику?!");
setdialog($user_id,"blackout_sug");
$keyboard = keybrd(1,$user_id); //Клавиатура ДА НЕТ
vkApi_messagesSend($user_id,$sugg_arr[$rand],'',$keyboard);    
echo("Blackout предложка для {$user_id}\n");    
}
//Функции
function write_scr($text){
        $text = ucfirst($text);
        $pieces = explode(" ", $text);
        $pic_count = count($pieces);
        for($i=0;$i<=$pic_count;$i++){
        $temp_str = "{$temp_str}_{$pieces[$i]}"; 
        }
        $url = "http://192.168.0.103/msg.php?q=sentmsg?{$temp_str}";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
        curl_exec($ch);
        curl_close($ch);
      for($i=1;$i<=$pic_count;$i++){
           $temp_str = "{$temp_str} {$pieces[$i]}"; 
           }
      $temp_str = trim($temp_str); 
      remember($user_id,"set",$temp_str);
      echo("Вывел на экран: {$text}\n");
}//Написать на экран
function s_horoscop(){
$signs = array("capricorn", "aquarius", "pisces", "aries", "taurus", "gemini", "cancer", "leo", "virgo", "libra", "scorpio", "sagittarius");
for($i=0;$i<=6;$i++){
    $temp = $signs[$i];
    $url = "https://horo.mail.ru/prediction/{$temp}/today/";
   $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $file = curl_exec($ch); 
    curl_close($ch); 
    $doc = phpQuery::newDocument($file);
    $res = $doc->find('.article__item p:eq(0)')->text();
    $res = explode(".", $res);
    $tans = "{$res[0]}. {$res[1]}.";
    echo "$tans\n";
    s_mysql_horoscop("set",$temp,$tans);
    sleep(0.6);  
    }
sleep(1);
for($i=6;$i<12;$i++){
    $temp = $signs[$i];
    $url = "https://horo.mail.ru/prediction/{$temp}/today/";
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $file = curl_exec($ch); 
    curl_close($ch); 
    $doc = phpQuery::newDocument($file);
    $res = $doc->find('.article__item p:eq(0)')->text();
    $res = explode(".", $res);
    $tans = "{$res[0]}. {$res[1]}.";
    echo "$tans\n";
    s_mysql_horoscop("set",$temp,$tans);
    sleep(1.5);
    }
echo("Гороскопы успешно обновлены");   
}//Обновление гороскопов
function s_mysql_horoscop($mod,$sign,$text){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind','3306');

if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
}  
    if($mod=="set"){
        $stmt = $mysqli->prepare("UPDATE horoscop SET `{$sign}`='{$text}' WHERE `{$sign}`=`{$sign}`"); 
        $stmt->bind_param('ss', $sign,$text); 
        $stmt->execute(); 
        $stmt->close();
    }
    if($mod=="get"){
        if ($stmt = $mysqli->prepare("SELECT {$sign} FROM horoscop WHERE {$sign}={$sign}")) { 
            $stmt->execute(); 
            $stmt->bind_result($col1); 
            while ($stmt->fetch()) { 
                $sign = $col1;
            } 
            $stmt->close(); 
        }
    }
$mysqli->close(); 
echo("Смена для {$sign} текст:{$text}\n");
return $sign;
}//Заполенине базы гороскопов
function send_msg($user_id,$text){
$keyboard = keybrd('',$user_id); //Клавиатура
$username = usrname($user_id,'get',1);   //Имя поьзователя 
$msg = "{$username}, {$text}";
vkApi_messagesSend($user_id, $msg,'',$keyboard);   
echo("Отправлено сообщение для {$user_id} с текстом: {$text}\n");
}//Отправить сообщение
function musicon($title){
    $url = "http://192.168.0.103/msg.php?q=sentmsg?music_{$title}.mp3_2_3_4_5";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
    curl_exec($ch);
    curl_close($ch);
    sleep(1);
   $url = "http://192.168.0.103/msg.php?q=sentmsg?*_2_3_4_5";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
    curl_exec($ch);
    curl_close($ch);    
}//Включить музыку

function active($date){ 
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind'); //
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

 if ($result = $mysqli->query("SELECT id,user_id,time,text,event,active,music,active FROM events WHERE active=1")) { 
    while( $row = $result->fetch_assoc() ){ 
        if ($date==$row['time']){
            if ($row['active']==1){
                //event
              if ($row['event']=="morning"){
                $sql = "UPDATE events SET active=0 WHERE id={$row['id']}";
                if ($mysqli->query($sql) === TRUE) {
                $msg = "В [{$row['time']}]: {$row['text']}";
                $user_id = $row['user_id'];    
                send_msg($user_id,$msg);
                sleep(0.5);
                musicon("/glados/morning");
                write_scr($msg);
                echo("Разбудил! Сообщение: {$msg}\n");
                                                    }
                }   
              if ($row['event']=="event"){
                $sql = "UPDATE events SET active=0 WHERE id={$row['id']}";
                if ($mysqli->query($sql) === TRUE) {
                $msg = "В [{$row['time']}]: {$row['text']}";
                $user_id = $row['user_id'];    
                send_msg($user_id,$msg);
                sleep(0.5);
                musicon($row['music']);
                write_scr($msg);
                echo("Выполнил активное событие! Сообщение: {$msg}\n");
                                                    }
                } 
              if ($row['event']=="coffee"){
                  $sql = "UPDATE events SET active=0 WHERE id={$row['id']}";
                  if ($mysqli->query($sql) === TRUE) {
                  $msg = "[{$row['time']}]:напиток готов";
                  $user_id = $row['user_id'];    
                  coffee(2);
                  sleep(0.5);
                  send_msg($user_id,$msg);
                  sleep(0.5);
                  write_scr($msg);
                  echo("Выполнил активное событие! Сообщение: {$msg}\n");
                                                      }
                         }
                                           }
                          }
                                         }
 } else { echo "Error updating record: " . $mysqli->error;}
 

    $result->close(); 
$mysqli->close(); 
} ////$date = date("H:i"); проверка активных событий

function admin_list(){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

if ($stmt = $mysqli->prepare("SELECT isadmin,user_id FROM dialog WHERE isadmin=2")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1,$col2); 
    while ($stmt->fetch()) { 
       $isadmin = $col1;
       if ($isadmin!==null){
           admin_sugg($col2);
           echo("Отправлена предложка вот этому перцу {$col2}\n");
           sleep(2.5);
        }
    } 
    $stmt->close(); 
}
$mysqli->close(); 

}//Рассылка предложек админам

function hroscop_to_users(){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

if ($stmt = $mysqli->prepare("SELECT user_id FROM dialog WHERE user_id LIKE '%' ")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1); 
    while ($stmt->fetch()) { 
       $user_id = $col1;
       if ($user_id!==null){
           send_msg($user_id,horoscop($user_id));
           sleep(3);
        }
    } 
    $stmt->close(); 
}
$mysqli->close(); 
echo("Отправлена предложка вот этому перцу {$isadmin}\n");
}//Рассылка гороскопа
function advice_to_users(){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

if ($stmt = $mysqli->prepare("SELECT user_id FROM dialog WHERE user_id LIKE '%' ")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1); 
    while ($stmt->fetch()) { 
       $user_id = $col1;
       if ($user_id!==null){
           $temp = rand_adv();
           send_msg($user_id,"Совет дня: {$temp}");
           sleep(3);
        }
    } 
    $stmt->close(); 
}
$mysqli->close(); 
echo("Отправлена предложка вот этому перцу {$isadmin}\n");
}//Рассылка советов
function phrase_to_users(){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

if ($stmt = $mysqli->prepare("SELECT user_id FROM dialog WHERE user_id LIKE '%' ")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1); 
    while ($stmt->fetch()) { 
       $user_id = $col1;
       if ($user_id!==null){
           $temp = sayme();
           send_msg($user_id,$temp);
           sleep(3);
        }
    } 
    $stmt->close(); 
}
$mysqli->close(); 
echo("Отправлена предложка вот этому перцу {$isadmin}\n");
} //Расслка пословиц


?>
