<?php
header('Content-type: text/html; charset=utf-8');
require('phpQuery/phpQuery/phpQuery.php');
function new_ip(){
     $url = "https://2ip.ru/";
   $ch = curl_init();  
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $file = curl_exec($ch); 
    curl_close($ch);

    $doc = phpQuery::newDocument($file);
    $res = $doc->find('#d_clip_button')->text();
    $res = explode(".", $res);
    $tans = "{$res[0]}.{$res[1]}.{$res[2]}.{$res[3]}";
    return $tans;
}
echo(bd_ip("set",'1'));
function bd_ip($mode,$temp){
    $mysqli = new mysqli('localhost', 'teyhd', '258000', 'snake');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
}  
if($mode=="set"){
    $stmt = $mysqli->prepare("UPDATE ip SET ip='{$temp}' WHERE ip"); 
    $stmt->bind_param('s', $temp); 
    $stmt->execute(); 
    $stmt->close();
    if ($stmt = $mysqli->prepare("SELECT ip FROM ip WHERE ip")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
            $ans = $col1;
        } 
        $stmt->close(); 
    }    
    
}
if($mode=="get"){
    
    if ($stmt = $mysqli->prepare("SELECT ip FROM ip WHERE ip")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
            $ans = $col1;
        } 
        $stmt->close(); 
    }
//
}
$mysqli->close(); 
return $ans;
}

/*function bd_ip($mode,$temp){
    $mysqli = new mysqli('localhost', 'teyhd', '258000', 'snake');

if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
}  
if($mode=="set"){
    $stmt = $mysqli->prepare("UPDATE ip SET ip='{$temp}' WHERE ip"); 
    $stmt->bind_param('s', $temp); 
    $stmt->execute(); 
    $stmt->close();
    if ($stmt = $mysqli->prepare("SELECT ip FROM ip WHERE ip")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
            $ans = $col1;
        } 
        $stmt->close(); 
    }    
    
}
if($mode=="get"){
    
    if ($stmt = $mysqli->prepare("SELECT ip FROM ip WHERE ip")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
            $ans = $col1;
        } 
        $stmt->close(); 
    }
//
}
$mysqli->close(); 
return $ans;
}*/
