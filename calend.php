<?php
function send_msg($text){
        $text = urlencode($text);
        $url = "http://192.168.0.103:808/msg?text={$text}";
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
                $gth=curl_exec($ch);
                curl_close($ch);
                return $gth;
}
function send_mus($link){
       // $link = urlencode($link);
        $url = "http://192.168.0.103:808/play?link={$link}.mp3";
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
                $gth=curl_exec($ch);
                curl_close($ch);
                return $gth;
}
function send_shad($val){
        $url = "http://192.168.0.103:808/shad?shad={$val}";
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
                $gth=curl_exec($ch);
                curl_close($ch);
                return $gth;
}
function send_cmd($cmd){
            $cmd = urlencode($cmd);
        $url = "http://192.168.0.103:808/cmd?cmd={$cmd}";
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
                $gth=curl_exec($ch);
                curl_close($ch);
                return $gth;
}
