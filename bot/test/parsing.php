<?php
header('Content-type: text/html; charset=utf-8');
require('phpQuery/phpQuery/phpQuery.php');
advice();
function advice(){
//$sign = getZodiacalSign($month, $day);
$url = 'https://www.fanfenshui.ru/kalendari/sovet-dnya.html';
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true); 
$file = curl_exec($ch); 
curl_close($ch); 
$doc = phpQuery::newDocument($file);
$res = $doc->find('h2:eq(0)');
echo ($res);
}
function add_advice($text){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 
if ($stmt = $mysqli->prepare("SELECT max(id) FROM advice WHERE id")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1); 
    while ($stmt->fetch()) { 
        $id = $col1+1;
    } 
    $stmt->close(); 
}
$stmt = $mysqli->prepare("INSERT INTO advice VALUES (?, ?)"); 
$stmt->bind_param('ds', $id,$text); 
$stmt->execute(); 
$stmt->close(); 
$mysqli->close(); 
echo ("$text\n");
}
/*while(true){
    add_advice(advice());
    sleep(2);
}*/
