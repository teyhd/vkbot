<?php

define("MAXSUBWORD", 5);
function anagramm($user_id,$text){
    $attachments = '';
    $lvl_temp=ann_lvl_temp($user_id,"get",1);
    $lvl=ann_lvl($user_id,"get",1);
    $words = array('отпрыск','нaрост','грамота','лунaтик','прaвило','прохождение','диаграмма','вестибюль','дифракция','росомаха','космодром','захватчик','крыжовник','свидетель','рассрочка','кроссворд','миссионер','химчистка','процедура','половодье','призвание','строгость','программа','олимпиада','гимназист','бутерброд','благодать','честность','антресоль','большевик','гипербола','видеограф','лапшевник','лидерство','множитель','разведчик','тусовка','водораздел','неготовность','почиаттель','каблучок','американец','месячишко','проступок','домовладелец','известность','дивергенция','машинистка','круговорот','бездомность','экземпляр','прагматизм','автолюбитель','чебурашка','хрупкость','множество','воздыхание','весточка','дросель','византиец','прогульшик','подвижность','биомеханика','сарделька','первообраз','гуманитарий','автоматизм','имплантация','любопытство','каламбур','шуточка','одуванчик','гробовщик','деструкция','спецовка','связанность','жительница','богохульство');
    $word_num = count($words);
    if ($lvl<=$word_num){
        if ($lvl_temp<MAXSUBWORD){
            $ask_word = $words[$lvl];
            if ($text==''){$msg = "Составьте слова из слова: {$ask_word}.";}
            else{
                $ask_arr = mbStringToArray($ask_word);
                $ans_arr = mbStringToArray($text);
                $ans_num = count($ans_arr);
                $inter = array_intersect($ask_arr, $ans_arr);
                $inter_num = count($inter);
                if ($inter_num<$ans_num){
                    $msg = "[{$inter_num}:{$ans_num}] Одной из введенных букв нет в заданном слове. Слово: {$ask_word}.";
                } else{
                    if((anag_bit($user_id,'get',1,$text)!=0)||($ask_word==$text)){
                        $msg = "Вы уже вводили это слово. Составьте слова из слова: {$ask_word}.";
                    } else{
                      if (isword($text)!=''){
                          $lvl_temp++;
                          ann_lvl_temp($user_id,"set",$lvl_temp);
                          $ost = MAXSUBWORD - $lvl_temp;
                          anag_bit($user_id,'set',$lvl_temp,$text);
                          $msg = "Слово {$text} успешно принято. Осталось найти: $ost из слова: {$ask_word}.";
                          anagramm($user_id,'');
                      } else{
                          $msg = "В толковом словаре яндекса не нашлось значения введенного вами слова.Составьте слова из слова: {$ask_word}.";
                      }
                    }
                }
            }
        } else{
            $msg = "Вы нашли достаточно слов.";
            ann_lvl_temp($user_id,"set",0);
            $lvl++;
            ann_lvl($user_id,"set",$lvl);
            anag_bit($user_id,"clear",3,3);
            anagramm($user_id,'');
        }
        
    } else {
        $msg = "Поздравляю! Вы нашли все слова. Возвращайтесь позже, мы добавим слов";
        setdialog($user_id,"non");
        //выходим из диалога ИГРЫ
    }
  $keyboard = keybrd('',$user_id); 
  vkApi_messagesSend($user_id, $msg, $attachments,$keyboard); 
}
function anag_bit($user_id,$mod,$bit,$value){
    $mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
    /* Проверка соединения */ 
    if (mysqli_connect_errno()) { 
        printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
        exit(); 
    } 
    if ($mod=="get"){
      for($i=1;$i<=15;$i++){
      if ($stmt = $mysqli->prepare("SELECT `{$i}` FROM anagramms WHERE user_id={$user_id}")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
           $bit_res = $col1;
           if ($bit_res==$value) return 1; 
        } 
        $stmt->close(); 
      }
      }
    }
    if ($mod=="set"){
    $stmt = $mysqli->prepare("UPDATE anagramms SET `{$bit}`='{$value}' WHERE user_id=$user_id"); 
    $stmt->bind_param('dsd', $user_id,$value,$bit); 
    
    $stmt->execute(); 
    $stmt->close(); 
    }
    if ($mod=="clear"){
      for($i=1;$i<=15;$i++){
        $stmt = $mysqli->prepare("UPDATE anagramms SET `{$i}`='0' WHERE user_id=$user_id"); 
        $stmt->bind_param('dsd', $user_id,$i,$bit); 
        $stmt->execute(); 
        $stmt->close();  
      }  
    }     
    if ($bit_res==null){
        $stmt = $mysqli->prepare("INSERT INTO anagramms VALUES (?, 0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)"); 
        $stmt->bind_param('d', $user_id); 
        $stmt->execute(); 
        $stmt->close();
        $bit_res=0;
    }
 
    return $bit_res;
     $mysqli->close();
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
function ann_lvl($user_id,$mod,$value){
    $mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
    /* Проверка соединения */ 
    if (mysqli_connect_errno()) { 
        printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
        exit(); 
    } 
    if ($mod=="get"){
      if ($stmt = $mysqli->prepare("SELECT ann_lvl FROM progress WHERE user_id={$user_id}")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
           $lvl = $col1;
        } 
        $stmt->close(); 
      }
    }
    if ($mod=="set"){
    $stmt = $mysqli->prepare("UPDATE progress SET ann_lvl='{$value}' WHERE user_id=$user_id"); 
    $stmt->bind_param('ds', $user_id,$value); 
    
    $stmt->execute(); 
    $stmt->close(); 
    }
        
    if ($lvl==null){
     $stmt = $mysqli->prepare("INSERT INTO progress VALUES (?, 0, 0, 0, 0)"); 
    $stmt->bind_param('d', $user_id); 
    $stmt->execute(); 
    $stmt->close(); 
        $lvl=0;
    }
 
    return $lvl;
     $mysqli->close();
}
function ann_lvl_temp($user_id,$mod,$value){
    $mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
    /* Проверка соединения */ 
    if (mysqli_connect_errno()) { 
        printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
        exit(); 
    } 
    if ($mod=="get"){
      if ($stmt = $mysqli->prepare("SELECT ann_lvl_temp FROM progress WHERE user_id={$user_id}")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
           $lvl = $col1;
        } 
        $stmt->close(); 
      }
    }
    if ($mod=="set"){
    $stmt = $mysqli->prepare("UPDATE progress SET ann_lvl_temp='{$value}' WHERE user_id=$user_id"); 
    $stmt->bind_param('ds', $user_id,$value); 
    
    $stmt->execute(); 
    $stmt->close(); 
    }
        
    if ($lvl==null){
    $stmt = $mysqli->prepare("INSERT INTO progress VALUES (?, 0, 0, 0, 0)"); 
    $stmt->bind_param('d', $user_id); 
    $stmt->execute(); 
    $stmt->close(); 
        $lvl=0;
    }
 
    return $lvl;
     $mysqli->close();
}

