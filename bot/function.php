<?php
define(KEY,178);
function getZodiacalSign($month, $day) {
$signs = array("capricorn", "aquarius", "pisces", "aries", "taurus", "gemini", "cancer", "leo", "virgo", "libra", "scorpio", "sagittarius");
$signsstart = array(1=>21, 2=>20, 3=>20, 4=>20, 5=>20, 6=>20, 7=>21, 8=>22, 9=>23, 10=>23, 11=>23, 12=>23);
return $day < $signsstart[$month + 1] ? $signs[$month - 1] : $signs[$month % 12];
}
function horoscop($user_id){
      $users_get_response = vkApi_usersGet($user_id);
      $user = array_pop($users_get_response);
      $bd = $user['bdate']; //D.M.YYYY 
      if ($bd!==null){
      $bd = explode(".", $bd);
      $sign = getZodiacalSign($bd[1], $bd[0]);
      $msg = mysql_horoscop("get",$sign,$sign);
      } else{
        $sign = getZodiacalSign(10, 28);
        $msg = mysql_horoscop("get",$sign,$sign);  
        $msg = "В связи с тем, что дата вашего рождения закрыта в настройках приватности, вам будет показан общий гороскоп: {$msg}";
      } 
      return $msg;
}
function mbStringToArray ($string) { 
    $strlen = mb_strlen($string); 
    while ($strlen) { 
        $array[] = mb_substr($string,0,1,"UTF-8"); 
        $string = mb_substr($string,1,$strlen,"UTF-8"); 
        $strlen = mb_strlen($string); 
    } 
    return $array; 
} 
function switcher($text,$arrow=100){
  $str[0] = array('й' => 'q', 'ц' => 'w', 'у' => 'e', 'к' => 'r', 'е' => 't', 'н' => 'y', 'г' => 'u', 'ш' => 'i', 'щ' => 'o', 'з' => 'p', 'х' => '[', 'ъ' => ']', 'ф' => 'a', 'ы' => 's', 'в' => 'd', 'а' => 'f', 'п' => 'g', 'р' => 'h', 'о' => 'j', 'л' => 'k', 'д' => 'l', 'ж' => ';', 'э' => '\'', 'я' => 'z', 'ч' => 'x', 'с' => 'c', 'м' => 'v', 'и' => 'b', 'т' => 'n', 'ь' => 'm', 'б' => ',', 'ю' => '.','Й' => 'Q', 'Ц' => 'W', 'У' => 'E', 'К' => 'R', 'Е' => 'T', 'Н' => 'Y', 'Г' => 'U', 'Ш' => 'I', 'Щ' => 'O', 'З' => 'P', 'Х' => '[', 'Ъ' => ']', 'Ф' => 'A', 'Ы' => 'S', 'В' => 'D', 'А' => 'F', 'П' => 'G', 'Р' => 'H', 'О' => 'J', 'Л' => 'K', 'Д' => 'L', 'Ж' => ';', 'Э' => '\'', '?' => 'Z', 'ч' => 'X', 'С' => 'C', 'М' => 'V', 'И' => 'B', 'Т' => 'N', 'Ь' => 'M', 'Б' => ',', 'Ю' => '.',);
  $str[1] = array (  'q' => 'й', 'w' => 'ц', 'e' => 'у', 'r' => 'к', 't' => 'е', 'y' => 'н', 'u' => 'г', 'i' => 'ш', 'o' => 'щ', 'p' => 'з', '[' => 'х', ']' => 'ъ', 'a' => 'ф', 's' => 'ы', 'd' => 'в', 'f' => 'а', 'g' => 'п', 'h' => 'р', 'j' => 'о', 'k' => 'л', 'l' => 'д', ';' => 'ж', '\'' => 'э', 'z' => 'я', 'x' => 'ч', 'c' => 'с', 'v' => 'м', 'b' => 'и', 'n' => 'т', 'm' => 'ь', ',' => 'б', '.' => 'ю','Q' => 'Й', 'W' => 'Ц', 'E' => 'У', 'R' => 'К', 'T' => 'Е', 'Y' => 'Н', 'U' => 'Г', 'I' => 'Ш', 'O' => 'Щ', 'P' => 'З', '[' => 'Х', ']' => 'Ъ', 'A' => 'Ф', 'S' => 'Ы', 'D' => 'В', 'F' => 'А', 'G' => 'П', 'H' => 'Р', 'J' => 'О', 'K' => 'Л', 'L' => 'Д', ';' => 'Ж', '\'' => 'Э', 'Z' => '?', 'X' => 'ч', 'C' => 'С', 'V' => 'М', 'B' => 'И', 'N' => 'Т', 'M' => 'Ь', ',' => 'Б', '.' => 'Ю', );
  return strtr($text,isset( $str[$arrow] )? $str[$arrow] :array_merge($str[0],$str[1]));
}
function weather($user_id){
           $time = time() + (7 * 24 * 60 * 60);
           $username = usrname($user_id,'get',1);   
           $url = "https://api.darksky.net/forecast/a251147ccfb4e5c7ecc5f91e54598f8b/54.3711173,48.5828901,{$time}?lang=ru&units=si";
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
            $json = curl_exec($ch);
            if(!$json) {
                echo curl_error($ch);
            }
            curl_close($ch);
            $json = json_decode($json);
            $arr = $json->currently;
            
            $outwindow = $arr->summary;
            
            $temp = $arr->temperature;
            $temp = round($temp);
            
            $wind = $arr->windSpeed;
            $wind = round($wind);
            
            $press = $arr->pressure;
            $press = round($press/1.333);
            
            $now =  $json->hourly;
            $now = $now->summary;
            
            $daily = $json->daily;
            $daily=object2array($daily);
            $daily=$daily['data'];
            $daily=$daily[0];
            
            $vosxod=$daily['sunriseTime'];
            $vosxod=date("H:i:s",$vosxod);
            
            $zakat=$daily['sunsetTime'];
            $zakat=date("H:i:s",$zakat);
            
            $moon=$daily['moonPhase'];
            if($moon==0) $moon="Новолуние";
            if(($moon>0)&&($moon<0.25)) $moon="Растущий полумесяц";
            if($moon==0.25) $moon="Первая четверть луны";
            if(($moon>0.25)&&($moon<0.5)) $moon="Растущая луна";
            if($moon==0.5) $moon="Полнолуние";
            if(($moon>0.5)&&($moon<0.75)) $moon="Убывающая луна";
            if($moon==0.75) $moon="Последняя четверть луны";
            if($moon>0.75) $moon="Убывающий полумесяц";
            
            $msg = "{$username}, сейчас за окном: {$outwindow}. Температура воздуха: {$temp} градусов Цельсия. Ветер {$wind} метров в секунду. Давление {$press} миллиметров ртутного столба. {$now} {$moon}. Восход: {$vosxod}. Закат: {$zakat}.";   
            return $msg;
}
function translate($trantext,$lang) {
    $trantext = urlencode($trantext);
    switch($lang)
    {
       case "английский": $lang="en"; break;
       case "немецкий": $lang="de"; break;
       case "испанский": $lang="es"; break;
       case "китайский": $lang="zh"; break;
       case "французский": $lang="fr"; break;
       case "корейский": $lang="ko"; break;
       case "латынь": $lang="la"; break;
       case "японский": $lang="ja"; break;
       case "русский": $lang="ru"; break;
       case "валлийский": $lang="cy"; break;
       case "греческий": $lang="el"; break;
       case "турецкий": $lang="tr"; break;
       case "итальянский": $lang="it"; break;
       default: $lang="en";     
    }
    $url = "https://translate.yandex.net/api/v1.5/tr/translate?key=trnsl.1.1.20190301T175720Z.6bf7e2c285aeb32a.a9a80cc3b2ec9404bcffe79a8eafcde2cbb21d47&text={$trantext}&lang={$lang}";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
        $json = curl_exec($ch);
        if(!$json) {
            echo curl_error($ch);
        }
        curl_close($ch);
        $tempr = simplexml_load_string($json);
       $tempr=object2array($tempr); 
        foreach ($tempr as $key=>$value) {
           if ($key=='text')  
           return $value;}
}
function magicball(){
   $magicans = array('Бесспорно','Предрешено','Никаких сомнений','Определённо да','Можешь быть уверен в этом','Мне кажется — «да»','Вероятнее всего','Хорошие перспективы','Знаки говорят — «да»','Да','Пока не ясно, попробуй снова','Спроси позже','Лучше не рассказывать','Сейчас нельзя предсказать','Сконцентрируйся и спроси опять','Даже не думай','Мой ответ — «нет»','По моим данным — «нет»','Перспективы не очень хорошие','Весьма сомнительно');
   $magicans=$magicans[rand(0,20)];
   return $magicans;
}
function object2array($object) { return @json_decode(@json_encode($object),1); }
function encode($text){
$flag=false;
$text_arr = mbStringToArray($text);
$lenth_text = count($text_arr);
$letters = array(
"А", "а", 
"Б", "б", 
"В", "в", 
"Г", "г", 
"Д", "д", 
"Е", "е", 
"Ё", "ё", 
"Ж", "ж", 
"З", "з", 
"И", "и", 
"Й", "й", 
"К", "к", 
"Л", "л", 
"М", "м", 
"Н", "н", 
"О", "о", 
"П", "п", 
"Р", "р", 
"С", "с", 
"Т", "т", 
"У", "у", 
"Ф", "ф", 
"Х", "х", 
"Ц", "ц", 
"Ч", "ч", 
"Ш", "ш", 
"Щ", "щ", 
"Ъ", "ъ", 
"Ы", "ы", 
"Ь", "ь", 
"Э", "э", 
"Ю", "ю", 
"Я", "я"," ","!","?","%","&","/",".",",","$","*",
'0','1','2','3','4','5','6','7','8','9','+','-','');//Массив букв 
$letters_numb = count($letters);
for ($k=0;$k<=$lenth_text;$k++){
    for ($i=0;$i<=$letters_numb;$i++){
        if ($text_arr[$k]==$letters[$i]){
        $tKey=$i+KEY;
        $code = "{$code} {$tKey}";
        $flag=true;   
        break;
        } else $flag=false;
    }
if($flag==false) $code = "{$code} {$text_arr[$k]}";    
}
$code = ltrim($code);
return $code;
}
function decode($text){
$pieces = explode(" ", $text);
$lenth_text = count($pieces);
$letters = array(
"А", "а", 
"Б", "б", 
"В", "в", 
"Г", "г", 
"Д", "д", 
"Е", "е", 
"Ё", "ё", 
"Ж", "ж", 
"З", "з", 
"И", "и", 
"Й", "й", 
"К", "к", 
"Л", "л", 
"М", "м", 
"Н", "н", 
"О", "о", 
"П", "п", 
"Р", "р", 
"С", "с", 
"Т", "т", 
"У", "у", 
"Ф", "ф", 
"Х", "х", 
"Ц", " ц", 
"Ч", "ч", 
"Ш", "ш", 
"Щ", "щ", 
"Ъ", "ъ", 
"Ы", "ы", 
"Ь", "ь", 
"Э", "э", 
"Ю", "ю", 
"Я", "я"," ","!","?","%","&","/",".",",","$","*",
'0','1','2','3','4','5','6','7','8','9','+','-','');
$letters_numb = count($letters);
for ($k=0;$k<=$lenth_text;$k++){
       $tKey=$letters[$pieces[$k]-KEY];
       if($tKey!==null){
        $code = "{$code}{$tKey}";}
        else $code = "{$code}{$pieces[$k]}"; 
}
$code = ltrim($code);
return $code;
}

/*function encode($unencoded,$key){//Шифруем
$string=base64_encode($unencoded);//Переводим в base64

$arr=array();//Это массив
$x=0;
while ($x++< strlen($string)) {//Цикл
$arr[$x-1] = md5(md5($key.$string[$x-1]).$key);//Почти чистый md5
$newstr = $newstr.$arr[$x-1][3].$arr[$x-1][6].$arr[$x-1][1].$arr[$x-1][2];//Склеиваем символы
}
$newstr = mb_convert_variables("ASCII", "ASCII,UTF-8,SJIS-win", $unencoded);
return $unencoded;//Вертаем строку
}
function decode($encoded, $key){//расшифровываем
$strofsym="qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM=";//Символы, с которых состоит base64-ключ
$x=0;
while ($x++<= strlen($strofsym)) {//Цикл
$tmp = md5(md5($key.$strofsym[$x-1]).$key);//Хеш, который соответствует символу, на который его заменят.
$encoded = str_replace($tmp[3].$tmp[6].$tmp[1].$tmp[2], $strofsym[$x-1], $encoded);//Заменяем №3,6,1,2 из хеша на символ
}
return base64_decode($encoded);//Вертаем расшифрованную строку
}*/
?>