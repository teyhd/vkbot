<?php
//echo();
$ask_word = "грамота";
$text = "tyjn";
$ask_arr = mbStringToArray($ask_word);
$ans_arr = mbStringToArray($text);
$ans_num = count($ans_arr);
$inter = array_intersect($ask_arr, $ans_arr);
$inter_num = count($inter);
echo "$inter_num $ans_num";
function mbStringToArray ($string) { 
    $strlen = mb_strlen($string); 
    while ($strlen) { 
        $array[] = mb_substr($string,0,1,"UTF-8"); 
        $string = mb_substr($string,1,$strlen,"UTF-8"); 
        $strlen = mb_strlen($string); 
    } 
    return $array; 
} 
function isword($word) {
    $trantext = urlencode($trantext);
    $url = "https://dictionary.yandex.net/api/v1/dicservice.json/lookup?key=dict.1.1.20190605T151907Z.a66517fb203342ba.6dc4c2543d88d2494471b5e15fe605cc4058ee41&lang=ru-ru&text={$word}";
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
        $arr = object2array($json);
        $arr = $arr['def'];
        $arr = $arr[0];
        $arr = $arr['text'];
        return $arr;
}
function object2array($object) { return @json_decode(@json_encode($object),1); }
/*
weather(15);
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
            echo $msg;
}
function object2array($object) { return @json_decode(@json_encode($object),1); }
*/

     /*  $tempr=object2array($tempr); 
       $value = $tempr['def'];
       $value = $value[0];
       $value = $value['text'];*/