<p>Првиет Все готoво</p>
<?php
header('Content-type: text/html; charset=utf-8');
require('phpQuery/phpQuery/phpQuery.php');
echo(mysql_horoscop("get","scorpio","sagittarius"));
//roscop();
function horoscop(){
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
    sleep(0.5);
    mysql_horoscop("set",$temp,$tans);
    sleep(2);  
    }
sleep(1);
for($i=6;$i<=12;$i++){
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
    sleep(1.5);
    mysql_horoscop("set",$temp,$tans);
    }
}
function getZodiacalSign($month, $day) {
$signs = array("capricorn", "aquarius", "pisces", "aries", "taurus", "gemini", "cancer", "leo", "virgo", "libra", "scorpio", "sagittarius");
$signsstart = array(1=>21, 2=>20, 3=>20, 4=>20, 5=>20, 6=>20, 7=>21, 8=>22, 9=>23, 10=>23, 11=>23, 12=>23);
return $day < $signsstart[$month + 1] ? $signs[$month - 1] : $signs[$month % 12];
}
function mysql_horoscop($mod,$sign,$text){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
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
return $sign;
}
echo(getZodiacalSign(0,05));
?>
