<?php
define(KEY,172);

$text = "Привет. Как дела? ";
echo(encode($text));
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
'0','1','2','3','4','5','6','7','8','9');
$letters_numb = count($letters);
for ($k=0;$k<=$lenth_text;$k++){
    for ($i=0;$i<=$letters_numb;$i++){
        if ($text_arr[$k]==$letters[$i]){
        $code = "{$code} {$i}";
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
'0','1','2','3','4','5','6','7','8','9','');
$letters_numb = count($letters);
for ($k=0;$k<=$lenth_text;$k++){
       if($letters[$pieces[$k]]!==null){
        $code = "{$code}{$letters[$pieces[$k]]}";}
        else $code = "{$code}{$pieces[$k]}"; 
}
$code = ltrim($code);
return $code;
}

$text = "32 35 19 5 11 39 . 66 22 1 23 66 9 11 25 1 ?";
decode($text);



function mbStringToArray($string) { 
    $strlen = mb_strlen($string); 
    while ($strlen) { 
        $array[] = mb_substr($string,0,1,"UTF-8"); 
        $string = mb_substr($string,1,$strlen,"UTF-8"); 
        $strlen = mb_strlen($string); 
    } 
    return $array; 
} 

