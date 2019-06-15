<?php
header('Content-type: text/html; charset=utf-8');
require('phpQuery/phpQuery/phpQuery.php');
horoscop(0);
function horoscop($user_id){
//$sign = getZodiacalSign($month, $day);
$url = 'https://horo.mail.ru/prediction/scorpio/today/';
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true); 
$file = curl_exec($ch); 
curl_close($ch); 
$doc = phpQuery::newDocument($file);
$res = $doc->find('.article__item')->text();
echo ($res);
}
function getZodiacalSign($month, $day) {
$signs = array("capricorn", "aquarius", "pisces", "aries", "taurus", "gemini", "cancer", "leo", "virgo", "libra", "scorpio", "sagittarius");
$signsstart = array(1=>21, 2=>20, 3=>20, 4=>20, 5=>20, 6=>20, 7=>21, 8=>22, 9=>23, 10=>23, 11=>23, 12=>23);
return $day < $signsstart[$month + 1] ? $signs[$month - 1] : $signs[$month % 12];
}