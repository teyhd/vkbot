<?php
if (!function_exists('curl_file_create')) {
    function curl_file_create($filename, $mimetype = '', $postname = '') {
        return "@$filename;filename="
            . ($postname ?: basename($filename))
            . ($mimetype ? ";type=$mimetype" : '');
    }
}

function bot_sendMessage($user_id,$body,$voiceurl) {
    $keyboard = keybrd('',$user_id); 
    $username = usrname($user_id,'get',1);     
    if ($body===""){
        $textmsg = download($voiceurl); 
        } else {
        $textmsg = $body; 
        }
$textmsg = mb_strtolower($textmsg);         
$textmsg = rtrim($textmsg,"!?.,/");
$dialog = getdialog($user_id);
switch ($dialog) {//blackout_sug
    case 'blackout_sug':
    if($textmsg=='да')
    docmd('BlackOut',$user_id);
    else {
        $msg="BlackOut отменен";
        //Тут надо скзаать об этом
    }
    setdialog($user_id,"non");    
    break;      
    
    case 'hang_sug':
    if($textmsg=='да')
    docmd('hang_game',$user_id);
    else {$msg="В любом случае пряня передавал привет!";
    setdialog($user_id,"non");}    
    break;  
    
    case 'ann_sug':
    if($textmsg=='да')
    docmd('anag_game',$user_id);
    else {
        $msg="Видимо игра сейчас не в тему";
        setdialog($user_id,"non");
        }
    break;  

    case 'true_sug':
    if($textmsg=='да')
    docmd('trueorlie',$user_id);
    else {
        $msg="Как вам будет угодно!";
        setdialog($user_id,"non");  
    }
    break;      
    
    case 'drink_sug':
    if($textmsg=='да')
    docmd('drink',$user_id);
    else $msg="Очень жаль ибо возможно именно эта выпитая чашка решала вашу судьбу!";
    setdialog($user_id,"non");    
    break;    
    case 'truelie':
        if ($textmsg=='хватит'){
            $msg = "Возвращайся еще";
            setdialog($user_id,"non");
        } else {
            trueorlie($user_id,$textmsg);
            }
    break;     
    case 'anagram':
        if ($textmsg=='хватит'){
            $msg = "Возвращайся еще";
            setdialog($user_id,"non");
        } else {
            anagramm($user_id,$textmsg);
            }
    break;      
     case 'full_info':
          $users_get_response = vkApi_usersGet($textmsg);
          $user = array_pop($users_get_response);
          $msg = $user['first_name'];   //sex,bdate,city,country,home_town,domain,has_mobile  
          $msg = "{$msg} {$user['last_name']}:";
          $msg = "{$msg} {$user['sex']}:";
          $msg = "{$msg} {$user['bdate']}:";
          $msg = "{$msg} {$user['domain']}:";
          $msg = "{$msg} {$user['has_mobile']}:";
          setdialog($user_id,"non");
      break;
    case 'test_me':
        if ($textmsg=='хватит'){
            $msg = "Вы продолжите тестирование на том же месте";
            setdialog($user_id,"non");
        } else {
            testing($user_id,$textmsg);
            }
    break; 
    case 'hangmn':
        if ($textmsg=='хватит'){
            $msg = "Возвращайся еще";
            setdialog($user_id,"non");
        } else {
            hangman($user_id,$textmsg);
            }
    break;        
    case 'switcher':
    $msg = switcher($textmsg,100);
    setdialog($user_id,"non");
    break;    
    case "reb_some" :
        if ($textmsg!='ничего'){
          $msg = swit_reboot($textmsg);
        } else{
            $msg = "Ни одно устройство не было перезагружено";
        }
    setdialog($user_id,"non");
    break;      
    case "off_some" :
        if ($textmsg!='ничего'){
          $msg = off($textmsg);
        } else{
            $msg = "Ни одно устройство не было выключено";
        }
    setdialog($user_id,"non");
    break;    
    case "i_remember":
      $textmsg = trim($textmsg); 
      $temp_ans = remember($user_id,"get",$textmsg);
      if ($temp_ans!=null)
      $msg = "Я помню: $temp_ans"; 
      else $msg = "Я не помню такого"; 
      setdialog($user_id,"non");
    break;    
    case 'remember':
      $textmsg = trim($textmsg); 
      remember($user_id,"set",$textmsg);
      $msg = "Я запоминл: $textmsg";
      setdialog($user_id,"non");
    break;    
    case 'magicansver':
    $msg = magicball(); 
    setdialog($user_id,"non"); 
    break;    
    case "decode":
         $msg = decode($textmsg);
         $msg = mb_ucfirst($msg);
         setdialog($user_id,"non");       
         $attachments = "";    
         vkApi_messagesSend($user_id, $msg, $attachments,$keyboard);
         return 1;         
        break;        
    case "encode":
         $msg = encode($textmsg);
         setdialog($user_id,"non");       
         $attachments = "";    
         vkApi_messagesSend($user_id, $msg, $attachments,$keyboard);
         return 1;         
        break;    
    case "sayforme":
         $msg = $textmsg;
         $voice_message_file_name = yandexApi_getVoice($msg);
         $doc = _bot_uploadVoiceMessage($user_id, $voice_message_file_name);
         $attachments = array('doc'.$doc['owner_id'].'_'.$doc['id']);    
         vkApi_messagesSend($user_id, $msg, $attachments,$keyboard);
         setdialog($user_id,"non");         
         return 1;         
        break;
    case "addexp":
        $msg = "Ответь 'Да' чтобы добавить выражение или 'Нет' чтобы самопойтинахуй, но не пиши на рандоме хуйню!";
        if ($textmsg=="нет") {
            setdialog($user_id,"non");
            $msg = "На нет и суда нет!";
        }        
        if ($textmsg=="да") {
            setdialog($user_id,"iscmd");
            $keyboard = keybrd(1);
            $msg = "Это команда?";
        }
        break;
    case "iscmd":
        $msg = "Ответь 'Да' чтобы добавить команду или 'Нет' чтобы самопойтинахуй, но не пиши на рандоме хуйню!";
        if ($textmsg=="нет") {
            setdialog($user_id,"output");
            $msg = "Отлично. Введи ответ на выражение";
        }        
        if ($textmsg=="да") {
            setdialog($user_id,"cmd");
            $msg = "Введи команду";
        }        
        break;
    case "cmd":
        learner($user_id,"",$textmsg,"");
        $msg = "Отлично. Введи ответ на выражение";
        setdialog($user_id,"output");
        break;        
    case "output":
        learner($user_id,"","",$textmsg);
        teather($user_id);
        $msg = "Освоено новое выражение";
        setdialog($user_id,"non");
        break;        
    case "non":
    default:    
            $msg = sinonim($textmsg,$user_id);
            $msg = str_ireplace('{$username}', "{$username}", "$msg");
             if ($msg=="Ответ из функции") return 1;
      if ($msg!=="Ответ из функции") {
            if ($msg=='None'){
                $msg = msg_with_param($user_id,$textmsg);
                if ($msg=='non'){
                   if (isadmin($user_id)>0){ 
                       $msg = "Я не знаю что ответить. Добавить выражение: {$textmsg}?";
                       $keyboard = keybrd(1);
                       learner($user_id,$textmsg,"","");
                       setdialog($user_id,"addexp");
                   }
                    else $msg = "{$username}, Напиши или скажи что-нибудь из команд, а не знаешь синтаксиса, уйди в закат! Ты сказал: {$textmsg}. Появилась возможность обучать бота для этого введи Хочу обучать";
                }    
            }
      }
      break;
}
   
      $voice_message_file_name = yandexApi_getVoice($msg);
      $doc = _bot_uploadVoiceMessage($user_id, $voice_message_file_name);
    
      $attachments = array(
        'photo'.$photo['owner_id'].'_'.$photo['id'],
        'doc'.$doc['owner_id'].'_'.$doc['id'],
      );
      vkApi_messagesSend($user_id, $msg, $attachments,$keyboard);
            
}
function docmd($cmd,$user_id){
    $adm = isadmin($user_id);  
    $keyboard = keybrd('',$user_id); 
    $username = usrname($user_id,'get',1);  
    $msg='';
   if ($adm==2) {  
  switch ($cmd) {
      case 'test':
      $keyboard = keybrd(5,$user_id);        
      setdialog($user_id,"non");
      $msg= "ggg";
      break;      
           case 'BlackOut':
             setdialog($user_id,"non");
             sershut(2);
             sleep(2);
             sershut(3);
             sleep(2);
             sershut(1);
             $msg = "Если BlackOut прошел удачно, ты не увидишь это сооющение";
            break; 
            
      case "some_reb":
       setdialog($user_id,"reb_some");
       $keyboard = keybrd(4);
       $msg = "{$username}, что ты хочешь перезагрузить???";   
      break;           
      case "some_off":
       setdialog($user_id,"off_some");
       $keyboard = keybrd(3);
       $msg = "{$username}, что ты хочешь выключить???";   
      break;      
      case "clearscr":
            $url = "http://192.168.0.103/msg.php?q=sentmsg?*";
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
            curl_exec($ch);
            curl_close($ch);
       break;  
    case "read":    
        led(0);
        $url = "http://192.168.0.103/msg.php?q=sentmsg?*";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
        curl_exec($ch);
        curl_close($ch);
        break; 
  
    case "offlight":    
        led(0);
        break;     
    case "onlight":    
        led(255);
        break;                
       
    case "rebootser": 
     reboot(1);
      break;   
     case "offserv": 
      sershut(1);
      break;    
    case "sleepkomp": 
    bot_sendSticker($user_id,"2799");    
    sershut(4);
      break;       
    case "rebootcalen":     
      reboot(2);
      break;     
    case "offcalen":     
      sershut(2);
      break; 
    case "rebootkomp":     
      reboot(3);
      break;     
    case "offpc": 
      sershut(3);
      break;  
 
    case "deltimetableе":
      $msg = "{$username}, расписание успешно удалено!!";
      for ($x=0; $x<4; $x++) {
        $path = $_SERVER['DOCUMENT_ROOT'] . "/vkbot/bot/tasks/{$x}.jpg"; 
        unlink($path);
        sleep(0.35);
      }
      break;          
     case "quiet":    
    $url = "http://192.168.0.103/msg.php?q=sentmsg?music_0_2_3_4_5";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
    curl_exec($ch);
    curl_close($ch);
    sleep(1);
   $url = "http://192.168.0.103/msg.php?q=sentmsg?*_2_3_4_5";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
    curl_exec($ch);
    curl_close($ch);
      break;          
    case "pageupd":           
        $url = "http://192.168.0.103/msg.php?q=sentmsg?обнови_4_2_3_4_5";
        $msg = "Страница обновлена";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
        curl_exec($ch);
        curl_close($ch);
        sleep(1);
       $url = "http://192.168.0.103/msg.php?q=sentmsg?обновил_4_2_3_4_5";
        $msg = "Страница обновлена";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
        curl_exec($ch);
        curl_close($ch);
      break;  
    case "strobe":     
        $msg = strobe();
    break;  

    case "drink":
               bot_sendSticker($user_id,"16"); 
               $url = "http://192.168.0.103/msg.php?q=sentmsg?music_coffee.mp3_2_3_4_5";
               $ch = curl_init();
               curl_setopt($ch,CURLOPT_URL,$url);
               curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
               curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
               curl_exec($ch);
               curl_close($ch);
               sleep(1);
               $url = "http://192.168.0.103/msg.php?q=sentmsg?*_2_3_4_5";
               $ch = curl_init();
               curl_setopt($ch,CURLOPT_URL,$url);
               curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
               curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
               curl_exec($ch);
               curl_close($ch);
               $text = "Напиток готов";    
               $time = normaltime("15");
               $music = "coffee";
               $id = addevent("coffee",$user_id,$text,$time,$music);
               coffee(1);
               $msg ="[{$id}]Ваш напиток скоро будет готов в {$time}";
        break;
    case "moredrink":
               bot_sendSticker($user_id,"16"); 
               $text = "Напиток готов";    
               $time = normaltime("5");
               $music = "coffee";
               $id = addevent("coffee",$user_id,$text,$time,$music);
               coffee(1);
               $msg ="[{$id}]Ваш двойной напиток скоро будет готов в {$time}";
        break;        
        case "offkoff":
           coffee(2);
        break;  
        case "clearbd":
           $bdstr = clearbd();
           $msg ="База данных успешно отчищена. Удалено {$bdstr} строк";
        break;  
       } 
  } else $msg = "Лишь истинный админ может юзать эту функцию";   
   switch ($cmd) { 
           case 'horoscop':
             setdialog($user_id,"non");
             $msg = horoscop($user_id);
            break;         
        case 'trueorlie':
         trueorlie($user_id,'');
         setdialog($user_id,"truelie");
         $msg = "Игра: Правда или ложь. Вам будет задан вопрос, используйте:('правда','ложь') для ответа. Чтобы выйти из игры напишите хватит.";
        break;   
       case 'anag_game':
         anagramm($user_id,'');
         setdialog($user_id,"anagram");
         $msg = 'Чтобы выйти из игры напишите хватит.';
        break;    
       case 'want_learn':
           if (isadmin($user_id)>0){
              $msg = 'Вы уже можете обучать бота. Для этого введите фразу, которую он не знает, следуйте меню';
           } else
           {
              if (test_right($user_id,"get",1)>12){
                set_admin($user_id,1);  
                $msg = "Поздравляю!!! Отныне вы стали учителем бота. Для того чтобы добавить выражение, введите фразу, которую он не знает, следуйте меню";
              } else{
                $msg = 'Для этого вы должны набрать в тесте по русскому языку достаточное количество баллов. Чтобы пройти тест введите тест.';
              }
           }
        setdialog($user_id,"non");    
        break;   
       case 'testme':
         testing($user_id,"");
         setdialog($user_id,"test_me");
         $msg = 'Вы находитесь в режиме тестирования. чтобы завершить тест раньше напишите "хватит". Правила: При выполнении заданий с кратким ответом впишите в поле для ответа цифру, которая соответствует номеру правильного ответа, или число, слово, последовательность букв (слов) или цифр. Ответ следует записывать без пробелов и каких-либо дополнительных символов.';
        break;   
       case 'hang_game':
         hang_life($user_id,"set",9);
         hangman($user_id,'');
         setdialog($user_id,"hangmn");
         $msg = '';
        break;   
       case 'swtcer':
         setdialog($user_id,"switcher");
         $msg = 'Введи выражение у которого необходимо сменить раскладку';   
        break;   
            case 'think':
            setdialog($user_id,"magicansver");
            $msg = '';
            break;    
            case 'decode':    
            setdialog($user_id,"decode");
            $msg = '';
            break;      
            case 'encode':    
            setdialog($user_id,"encode");
            $msg = "Что зашифровать?";
            break;      
            case 'sayforme':    
            setdialog($user_id,"sayforme");
            $msg = "Что сказать?";
            break; 
        case 'time':    
            $temtime = date("H:i");
            $msg = "Сейчас: {$temtime}";
            break;   
        case "weather":    
          $msg = weather($user_id);
          break;
        case "timetable":
          $msg = "{$username}, вот лови!";
          bot_sendSticker($user_id,"2796");
          echo "ok";
          for ($x=0; $x<4; $x++) {
            $path = $_SERVER['DOCUMENT_ROOT'] . "/vkbot/bot/tasks/{$x}.jpg"; 
            if (file_exists($path)){
                $photo = _bot_uploadPhoto($user_id, $path);
                $voice_message_file_name = yandexApi_getVoice($msg);
                $doc = _bot_uploadVoiceMessage($user_id, $voice_message_file_name);
                $attachments = array(
                'photo'.$photo['owner_id'].'_'.$photo['id'],
                'doc'.$doc['owner_id'].'_'.$doc['id'],);
                vkApi_messagesSend($user_id, $msg, $attachments,$keyboard);
                }
            sleep(0.35);
          }
          exit();
          break;      
        case "film":           
           $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.themoviedb.org/3/movie/popular?api_key=4c1e2c42f459ff656086ba06e84c75df&language=ru");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);
            $response = object2array($response);
            $response = $response['results'];
            $x = rand(0, 20);
            $tempresponse = $response[$x];
            $tempname = $tempresponse['title'];
            $filmid = $tempresponse['id'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.themoviedb.org/3/movie/{$filmid}/images?api_key=4c1e2c42f459ff656086ba06e84c75df&language=ru-US&include_image_language=ru,null");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);
            $response = object2array($response);
            $response = $response['posters'];
            for ($y=0; $y<5; $y++) {
            $qualet = $response[$y];
            if (!empty($qualet)) {break;}
            } 
            $tempimg = $qualet['file_path'];
            
            $downphoto = "https://image.tmdb.org/t/p/w500{$tempimg}";
            
            $pathf = $_SERVER['DOCUMENT_ROOT'] . "/vkbot/bot/media/films/poster_{$tempname}.jpg";  
            file_put_contents($pathf, file_get_contents($downphoto));
            $msg = "{$username}, посмотри фильм {$tempname}";
            $photo = _bot_uploadPhoto($user_id, $pathf);
          break; 
            case "saying":
            $msg = sayme();
            break;       
        }
  
  if ($msg!==''){
  $voice_message_file_name = yandexApi_getVoice($msg);
  $doc = _bot_uploadVoiceMessage($user_id, $voice_message_file_name);
  $attachments = array(
    'photo'.$photo['owner_id'].'_'.$photo['id'],
    'doc'.$doc['owner_id'].'_'.$doc['id']
  );
 vkApi_messagesSend($user_id, $msg, $attachments,$keyboard);
 } 
}
function sinonim($textmsg,$user_id){

$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

if ($stmt = $mysqli->prepare("SELECT max(id) FROM commands WHERE id")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1); 
    while ($stmt->fetch()) { 
        $maxid = $col1;
    } 
    $stmt->close(); 
}

for($id=0;$id<=$maxid;$id++){
if ($stmt = $mysqli->prepare("SELECT id,input FROM commands WHERE id={$id}")) { 
    $stmt->execute(); 
    $stmt->bind_result($idexpress, $input); 
            while ($stmt->fetch()) { 
            $idex=$idexpress;
            $msg = $input;
    } 
    $stmt->close(); 
    }
    $sim = similar_text($textmsg, $msg, $perc);
    $perc = round($perc);
    if ($perc>76) {
     if ($stmt = $mysqli->prepare("SELECT output,command FROM commands WHERE id={$idex}")) { 
    $stmt->execute(); 
    $stmt->bind_result($output, $command); 
            while ($stmt->fetch()) { 
            $msg = $output;
            $cmd=$command;
            if ($cmd!=='') docmd($cmd,$user_id);
    } 
    $stmt->close(); 
    }
    return $msg;
    }
}
$mysqli->close(); 
return "None";
}
function msg_with_param($user_id,$textmsg){
           $adm = isadmin($user_id);  
           $username = usrname($user_id,'get',1); 
           $msg="non";
           $pieces = explode(" ", $textmsg);
           $pic_count = count($pieces);
           if ($pieces[0]=="всем"){
               if ($adm==2) {
                  if ($pic_count>1){
                  for($i=1;$i<=$pic_count;$i++){
                   $temp_str = "{$temp_str} {$pieces[$i]}"; 
                   }
               $temp_str = trim($temp_str);
               $temp_str = mb_ucfirst($temp_str);
               text_to_all('set',$temp_str);
               $msg = "Текст будет отправлен всем";
                  } else $msg ="Текст не был отправлен";
               
               } else $msg = "Лишь истинный админ может юзать эту функцию";     
               setdialog($user_id,"non");
           }
           if ($pieces[0]=="засни"){
               if ($adm==2) {              
               $msg ="Компьютер был усыплен";
               sershut(4);
               setdialog($user_id,"non");
               } else $msg = "Лишь истинный админ может юзать эту функцию";               
           }
           if ($pieces[0]=="удали"){
               if ($adm==2) {              
               $id = "{$pieces[1]}";
               $msg ="[id:{$id}]Напоминание для {$username} удалено";
               delevent($id);
               setdialog($user_id,"non");
               } else $msg = "Лишь истинный админ может юзать эту функцию";
           } 
           if ($pieces[0]=="радио"){
             if ($adm==2) {              
                $msg = "{$username}, я включил радио";
                $title = str_replace(" ", "-", $pieces[1]);
                $url = "http://192.168.0.103/msg.php?q=sentmsg?радио_{$title}_2_3_4_5";
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
                curl_exec($ch);
                curl_close($ch);
                sleep(1);
               $url = "http://192.168.0.103/msg.php?q=sentmsg?*_2_3_4_5";
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
                curl_exec($ch);
                curl_close($ch);
                setdialog($user_id,"non");  
             } else $msg = "Лишь истинный админ может юзать эту функцию";    
           }
           if ($pieces[0]=="перезагрузи"){
               if ($adm==2) {              
                    if ($pic_count>1){
                   $msg = swit_reboot($pieces[1]);  
                  }
                  else{
                   docmd("some_reb",$user_id);  
                   setdialog($user_id,"reb_some");
                   $msg="";
                  }
               } else $msg = "Лишь истинный админ может юзать эту функцию";
           }           
           if ($pieces[0]=="выключи"){
               if ($adm==2) {              
                   if ($pic_count>1){
                       $msg = off($pieces[1]);  
                      }
                      else{
                       docmd("some_off",$user_id);  
                       setdialog($user_id,"off_some");
                       $msg="";
                      }
               } else $msg = "Лишь истинный админ может юзать эту функцию"; 
           }
           if ($pieces[0]=="about"){
              if ($pic_count>1){
                  $users_get_response = vkApi_usersGet($pieces[1]);
                  $user = array_pop($users_get_response);
                  $msg = $user['first_name'];   //sex,bdate,city,country,home_town,domain,has_mobile  
                  $msg = "{$msg} {$user['last_name']}:";
                  $msg = "{$msg} {$user['sex']}:";
                  $msg = "{$msg} {$user['bdate']}:";
                  $msg = "{$msg} {$user['domain']}:";
                  $msg = "{$msg} {$user['has_mobile']}:";
              }
              else{
               setdialog($user_id,"full_info");
               $msg="Введи id пользователя о котором ты хочешь узнать инфу";
              }
           }             
           if ($pieces[0]=="вспомни"){
               if ($pic_count>1){
                       for($i=1;$i<=$pic_count;$i++){
                       $temp_str = "{$temp_str} {$pieces[$i]}"; 
                       }
                  $temp_str = trim($temp_str); 
                  $temp_ans = remember($user_id,"get",$temp_str);
                  $msg = "Я помню: $temp_ans";
               } 
               else
                {
                  $msg = "Что вспомнить?";  
                  setdialog($user_id,"i_remember");
                }
           }           
           if ($pieces[0]=="запомни"){
               if ($pic_count>1){
                       for($i=1;$i<=$pic_count;$i++){
                       $temp_str = "{$temp_str} {$pieces[$i]}"; 
                       }
                  $temp_str = trim($temp_str); 
                  remember($user_id,"set",$temp_str);
                  $msg = "Я запоминл: $temp_str";
               } 
               else
                {
                  $msg = "Что запомнить?";  
                  setdialog($user_id,"remember");
                }               
           }
           if (($pieces[0]=="зови")&&($pieces[1]=="меня")){
               for($i=2;$i<=$pic_count;$i++){
                   $temp_str = "{$temp_str} {$pieces[$i]}";
               }
               $temp_str = mb_ucfirst($temp_str);
               usrname($user_id,"set",$temp_str);
               $msg = "Я буду звать тебя: {$temp_str}.";
           }
           if ($pieces[0]=="покажи"){
               $id = "{$pieces[1]}";
               $msg = eventinfo($id);
               setdialog($user_id,"non");  
           }           
           if ($pieces[0]=="таймер"){
               $time = normaltime($pieces[1]);
               $textmsg = strstr($textmsg," "); 
               $patterns = array();
               $patterns[0] = '/1/';
               $patterns[1] = '/2/';
               $patterns[3] = '/3/';
               $patterns[4] = '/4/';
               $patterns[5] = '/5/';
               $patterns[6] = '/6/';
               $patterns[7] = '/7/';
               $patterns[8] = '/8/';
               $patterns[9] = '/9/';
               $patterns[10] = '/:/';
               $patterns[13] = '/0/';
               $replacements = '';
               $music = "music";
               $textmsg = preg_replace($patterns, "", $textmsg);
               $textmsg = ltrim($textmsg);
               $pieces = explode("*", $textmsg);
               if (!empty($pieces[1])) {$music = $pieces[1];}
               $text = $pieces[0];
               $id = addevent("event",$user_id,$text,$time,$music);
               $msg ="[id:{$id}]Напоминание для {$username} в {$time} установленно. Текст напоминания: {$text}, музыка:{$music}";
               setdialog($user_id,"non");  
           }       
           if ($pieces[0]=="напомни"){
               $time = $pieces[1];
               $textmsg = strstr($textmsg," "); 
               $patterns = array();
               $patterns[0] = '/1/';
               $patterns[1] = '/2/';
               $patterns[3] = '/3/';
               $patterns[4] = '/4/';
               $patterns[5] = '/5/';
               $patterns[6] = '/6/';
               $patterns[7] = '/7/';
               $patterns[8] = '/8/';
               $patterns[9] = '/9/';
               $patterns[10] = '/:/';
               $patterns[13] = '/0/';
               $replacements = '';
               $music = "alarm";
               $textmsg = preg_replace($patterns, "", $textmsg);
               $textmsg = ltrim($textmsg);
               $pieces = explode("*", $textmsg);
               if (!empty($pieces[1])) {$music = $pieces[1];}
               $text = $pieces[0];
               $id = addevent("event",$user_id,$text,$time,$music);
               $msg ="[id:{$id}]Напоминание для {$username} в {$time} установленно. Текст напоминания: {$text}. музыка:{$music}";
               setdialog($user_id,"non");  
           }
           if ($pieces[0]=="разбуди"){
               $time = $pieces[1];
               $textmsg = strstr($textmsg," "); 
               $patterns = array();
               $patterns[0] = '/1/';
               $patterns[1] = '/2/';
               $patterns[3] = '/3/';
               $patterns[4] = '/4/';
               $patterns[5] = '/5/';
               $patterns[6] = '/6/';
               $patterns[7] = '/7/';
               $patterns[8] = '/8/';
               $patterns[9] = '/9/';
               $patterns[10] = '/:/';
               $patterns[13] = '/0/';
               $replacements = '';
               $music = "alarm";
               $textmsg = preg_replace($patterns, "", $textmsg);
               $textmsg = ltrim($textmsg);
               $pieces = explode("*", $textmsg);
               if (!empty($pieces[1])) {$music = $pieces[1];}
               $text = $pieces[0];
               $id = addevent("morning",$user_id,"Самое время просыпаться!!!Вставай",$time,$music);
               $msg ="[id:{$id}]Я разбужу пользователя: {$username} в {$time}!";
               setdialog($user_id,"non");  
           }           
           if ($pieces[0]=="переведи"){
            $lang = $pieces[1];  
            $msg = strstr($body," ");  
            $patterns = array();
            $patterns[0] = '/английский/';
            $patterns[1] = '/немецкий/';
            $patterns[3] = '/испанский/';
            $patterns[4] = '/китайский/';
            $patterns[5] = '/французский/';
            $patterns[6] = '/корейский/';
            $patterns[7] = '/латынь/';
            $patterns[8] = '/японский/';
            $patterns[9] = '/русский/';
            $patterns[10] = '/валлийский/';
            $patterns[11] = '/греческий/';
            $patterns[12] = '/турецкий/';
            $patterns[13] = '/итальянский/';
            if ($pic_count>2){
               for($i=2;$i<=$pic_count;$i++){
               $temp_str = "{$temp_str} {$pieces[$i]}"; 
               }
            $temp_str = preg_replace($patterns, "", $temp_str);
            $msg = translate($temp_str,$lang);
            } else $msg = "Пример: Переведи немецкий слоник";  
            setdialog($user_id,"non");  
           }       
           if ($pieces[0]=="свет"){
            $pieces[1] = ucfirst($pieces[1]);
            led($pieces[1]);
            $msg = "Освещение успешно настроено!";
            setdialog($user_id,"non");  
           }       
           if ($pieces[0]=="запиши"){
                /*$msg = ltrim($textmsg, "запиши ");*/
                $pieces[1] = ucfirst($pieces[1]);
                $url = "http://192.168.0.103/msg.php?q=sentmsg?{$pieces[1]}_{$pieces[2]}_{$pieces[3]}_{$pieces[4]}_{$pieces[5]}";
                $msg = "Сообщение успешно отправлено!";
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 4);
                curl_exec($ch);
                curl_close($ch);
                setdialog($user_id,"non");  
              for($i=1;$i<=$pic_count;$i++){
                   $temp_str = "{$temp_str} {$pieces[$i]}"; 
                   }
              $temp_str = trim($temp_str); 
              remember($user_id,"set",$temp_str);
           }
           
      $voice_message_file_name = yandexApi_getVoice($msg);
      $doc = _bot_uploadVoiceMessage($user_id, $voice_message_file_name);
    
      $attachments = array(
        'photo'.$photo['owner_id'].'_'.$photo['id'],
        'doc'.$doc['owner_id'].'_'.$doc['id'],
      );
    
      if ($textmsg[0]==="*"){
         $msg = ltrim($textmsg, "*"); 
         $voice_message_file_name = yandexApi_getVoice($msg);
         $doc = _bot_uploadVoiceMessage($user_id, $voice_message_file_name);
         $attachments = array('doc'.$doc['owner_id'].'_'.$doc['id']);
         setdialog($user_id,"non");  
      }
    
      $pieces = explode(":", $textmsg);
      if ($pieces[0]=="отправь"){
         $user_id_send = $pieces[1];
         $msg = $pieces[2];
         $attachments = "";
         vkApi_messagesSend($user_id_send, $msg, $attachments,$keyboard);
         $msg = "Сообщение успешно отправленно";
         setdialog($user_id,"non");  
      }
      if ($pieces[0]=="=>"){
         $id = addsay($pieces[1]);
         $msg = "Пословица успешно добавлена";
         $attachments = "";
         setdialog($user_id,"non");  
      }
      if ($textmsg=="мотивация"){
            $voice_message_file_name =$_SERVER['DOCUMENT_ROOT'] . "/vkbot/bot/music/glados/шерлок.ogg";
            $doc = _bot_uploadVoiceMessage($user_id, $voice_message_file_name);
             $attachments = array(
               'doc'.$doc['owner_id'].'_'.$doc['id']);
             vkApi_messagesSend($user_id, "Знай", $attachments,keybrd('',$user_id));  
             $msg = "";
             setdialog($user_id,"non");  
      }  
      return $msg;
}
function mb_ucfirst($str, $encoding='UTF-8'){
	$str = mb_ereg_replace('^[\ ]+', '', $str);
	$str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
		   mb_substr($str, 1, mb_strlen($str), $encoding);
	return $str;
}

?>