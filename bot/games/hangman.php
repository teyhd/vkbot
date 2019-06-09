<?php

function hangman($user_id,$text){
    $attachments = '';
    $life=hang_life($user_id,"get",1);
    $lvl=hang_lvl($user_id,"get",1);
    $fall=hang_fall($user_id,"get",1);
    $flag=false;
    $life_flag = false;
    $words = array('блокнот','избушка','двояковыпуклый','круг','печенье','беруши','блокнот','отвертка','ригидность','электрокардиограмма','номенклатура','митоз','экономия','Гордыня','Алчность','Блуд','Зависть','Чревоугодие','Гнев','Уныние','леность','эгоистка','напряжение','микрокалькулятор','микропроцессор','компрессор','экзистенциализм','эмансипация','галлюциноген','толерантность','эксгумация','либерализм','экспонат','пышность','скабрёзность','шаловливость','экспозиция','индульгенция','контрацептив','шкворень','эпиграф','эпитафия','барбекю','жульен','энцефалопатия','парашютист','импозантность','индифферент','демультипликатор','педикулёз','выхухоль','россомаха','сущность','поэтапность','напыщенность','гидроаэроионизация','возвышенность','метилпропенилендигилроксициннаменилакриловая','мухатряндия','синхрафазатронович','электродиограмма','четырёхугольник','достопримечательность','радиоаудитория','гидроаэроионизация','гипербола','трактор','лагерь','механика','формулы','индуктивность','отпрыск','отвертка','кофеварка','конденсатор','транзистор','триггер','магнитофон','батарейка','администрирование','логарифмирование','интегрирование','коллектор','индуктор','выносливость','моделирование','полиморфизм','абстракция','скованность','карандаш','зловредность','беспамятность','курьезность','мородер','пентаграмма','паремия','лингвист','профессия','переводчик','переводчик');
    $word_count = count($words);
    if($lvl<$word_count){
        if($life>1){
         $ask_word = $words[$lvl];
         $arr_ask_word = mbStringToArray($ask_word);
         $arr_count = count($arr_ask_word);

         for($i=1;$i<$arr_count-1;$i++){
          $bit_value=hang_bit($user_id,"get",$i,1);
          if(($arr_ask_word[$i]==$text)&&($bit_value==0)){
             hang_bit($user_id,"set",$i,1);
             $life_flag = true;
            }
          }
         
         $msg = $arr_ask_word[0];
         for($i=1;$i<$arr_count-1;$i++){
             $bit_value=hang_bit($user_id,"get",$i,1);
             if($bit_value==0){
                 $msg = "{$msg} _";
             } else {
                 $msg = "{$msg} $arr_ask_word[$i]";  
             }
         }
         $msg = "{$msg} {$arr_ask_word[$arr_count-1]}";
         
         if ($life_flag==false) {
          $life--;
          hang_life($user_id,"set",$life);
          if ($text!=''){
          $msg = "Такой буквы нет. Слово: {$msg}";}
         } 
         
         for($i=1;$i<$arr_count-1;$i++){
             $bit_value=hang_bit($user_id,"get",$i,1);
             if($bit_value!==0){
                 $flag=true;
             } else {
                 $flag=false;
                 break;
             }
         }
         
           if ($flag==true){
           $lvl++;
           hang_lvl($user_id,"set",$lvl);
           hang_life($user_id,"set",9);
           for($i=1;$i<=20;$i++){hang_bit($user_id,"set",$i,0);}
           hangman($user_id,"");
           $msg = "Ты победил. Загаданное слово: {$ask_word}";
           $attachments = '';
       }
         
        }
        else {
            $msg = "Ты проиграл. Из-за тебя повесили бедного пряню";
            $life = 0;
            $fall++;
            hang_fall($user_id,"set",$fall);
            for($i=1;$i<=20;$i++){hang_bit($user_id,"set",$i,0);}
            hang_life($user_id,"set",9);
            setdialog($user_id,"non");
        }
    }
     else {
         for($i=1;$i<=20;$i++){hang_bit($user_id,"set",$i,0);}
         $life = 9;
         hang_life($user_id,"set",$life);
         setdialog($user_id,"non");
         $msg = "Слова кончились приходите похже, скоро мы добавим еще!";
     }
      
      if($life<8){
         $path = $_SERVER['DOCUMENT_ROOT'] . "/vkbot/bot/games/hang_pic/hang00{$life}.jpg";  
         $photo = _bot_uploadPhoto($user_id, $path);
          $attachments = array(
            'photo'.$photo['owner_id'].'_'.$photo['id'],
          );
     } else $attachments = '';
      $keyboard = keybrd('',$user_id); 
      vkApi_messagesSend($user_id, $msg, $attachments,$keyboard);
}
function hang_bit($user_id,$mod,$bit,$value){
    $mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
    /* Проверка соединения */ 
    if (mysqli_connect_errno()) { 
        printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
        exit(); 
    } 
    if ($mod=="get"){
      if ($stmt = $mysqli->prepare("SELECT `{$bit}` FROM hangman_bit WHERE user_id={$user_id}")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
           $bit_res = $col1;
        } 
        $stmt->close(); 
      }
    }
    if ($mod=="set"){
    $stmt = $mysqli->prepare("UPDATE hangman_bit SET `{$bit}`='{$value}' WHERE user_id=$user_id"); 
    $stmt->bind_param('dsd', $user_id,$value,$bit); 
    
    $stmt->execute(); 
    $stmt->close(); 
    }
        
    if ($bit_res==null){
        hang_user_add_tablebit($user_id);
        $bit_res=0;
    }
 
    return $bit_res;
     $mysqli->close();
}
function hang_life($user_id,$mod,$value){
    $mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
    /* Проверка соединения */ 
    if (mysqli_connect_errno()) { 
        printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
        exit(); 
    } 
    if ($mod=="get"){
      if ($stmt = $mysqli->prepare("SELECT life FROM hangman_bit WHERE user_id={$user_id}")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
           $life = $col1;
        } 
        $stmt->close(); 
      }
    }
    if ($mod=="set"){
    $stmt = $mysqli->prepare("UPDATE hangman_bit SET life='{$value}' WHERE user_id=$user_id"); 
    $stmt->bind_param('ds', $user_id,$value); 
    
    $stmt->execute(); 
    $stmt->close(); 
    }
        
    if ($life==null){
        hang_user_add_tablebit($user_id);
        $life=0;
    }
 
    return $life;
     $mysqli->close();
}
function hang_fall($user_id,$mod,$value){
    $mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
    /* Проверка соединения */ 
    if (mysqli_connect_errno()) { 
        printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
        exit(); 
    } 
    if ($mod=="get"){
      if ($stmt = $mysqli->prepare("SELECT hang_falls FROM progress WHERE user_id={$user_id}")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
           $lvl = $col1;
        } 
        $stmt->close(); 
      }
    }
    if ($mod=="set"){
    $stmt = $mysqli->prepare("UPDATE progress SET hang_falls='{$value}' WHERE user_id=$user_id"); 
    $stmt->bind_param('ds', $user_id,$value); 
    
    $stmt->execute(); 
    $stmt->close(); 
    }
        
    if ($lvl==null){
        hang_user_add($user_id);
        $lvl=0;
    }
 
    return $lvl;
     $mysqli->close();
}
function hang_lvl($user_id,$mod,$value){
    $mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
    /* Проверка соединения */ 
    if (mysqli_connect_errno()) { 
        printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
        exit(); 
    } 
    if ($mod=="get"){
      if ($stmt = $mysqli->prepare("SELECT hangman_lvl FROM progress WHERE user_id={$user_id}")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
           $lvl = $col1;
        } 
        $stmt->close(); 
      }
    }
    if ($mod=="set"){
    $stmt = $mysqli->prepare("UPDATE progress SET hangman_lvl='{$value}' WHERE user_id=$user_id"); 
    $stmt->bind_param('ds', $user_id,$value); 
    
    $stmt->execute(); 
    $stmt->close(); 
    }
        
    if ($lvl==null){
        hang_user_add($user_id);
        $lvl=0;
    }
 
    return $lvl;
     $mysqli->close();
}
function hang_user_add($user_id){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
}     
    $stmt = $mysqli->prepare("INSERT INTO progress VALUES (?, 0, 0, 0, 0)"); 
    $stmt->bind_param('d', $user_id); 
    $stmt->execute(); 
    $stmt->close(); 
$mysqli->close();     
}
function hang_user_add_tablebit($user_id){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
}     
    $stmt = $mysqli->prepare("INSERT INTO hangman_bit VALUES (?, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 9)"); 
    $stmt->bind_param('d', $user_id); 
    $stmt->execute(); 
    $stmt->close(); 
$mysqli->close();     
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