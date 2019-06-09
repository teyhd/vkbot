<?php
function bot_sendTorrent($user_id,$body,$rephoto,$title) {
    $username = usrname($user_id,'get',1);   
    if ($body===""){
        $textmsg = "Торрент загружен"; 
        } else {
        $textmsg = $body; 
        }
$msg = "{$username}, {$textmsg}";

$date_today = date("mdyhs");   
$rephoto = str_replace("\\", "", $rephoto);
$path = $_SERVER['DOCUMENT_ROOT'] . "/vkbot/bot/media/torrent/{$title}.torrent";  
file_put_contents($path, file_get_contents($rephoto));
$voice_message_file_name = yandexApi_getVoice($msg);
$doc = _bot_uploadVoiceMessage($user_id, $voice_message_file_name);
       
  $attachments = array(
    'doc'.$doc['owner_id'].'_'.$doc['id'],
  );
  $keyboard = keybrd('',$user_id); 
  vkApi_messagesSend($user_id, $msg, $attachments,$keyboard);
}
function bot_sendPicture($user_id,$body,$rephoto) {
    $username = usrname($user_id,'get',1);      
    if ($body===""){
        $textmsg = "Фотка успешно принята. Хм,прикольная фотка"; 
        } else {
        $textmsg = $body; 
        }
$msg = "{$username}, {$textmsg}";
$voice_message_file_name = yandexApi_getVoice($msg);
$doc = _bot_uploadVoiceMessage($user_id, $voice_message_file_name);

$date_today = date("m_d_y_h_s");   
$rephoto = str_replace("\\", "", $rephoto);
$path = $_SERVER['DOCUMENT_ROOT'] . "/vkbot/bot/media/Graffiti/graffiti_{$date_today}.png";  
file_put_contents($path, file_get_contents($rephoto));
 $photo = _bot_uploadPhoto($user_id, $path);
  $attachments = array(
    'photo'.$photo['owner_id'].'_'.$photo['id'],
    'doc'.$doc['owner_id'].'_'.$doc['id'],
  );
  $keyboard = keybrd('',$user_id); 
  vkApi_messagesSend($user_id, $msg, $attachments,$keyboard);
}
function bot_sendStory($user_id,$body,$rephoto) {
    $username = usrname($user_id,'get',1); 
    $msg = "{$username}, {$body}";
    $voice_message_file_name = yandexApi_getVoice($msg);
    $doc = _bot_uploadVoiceMessage($user_id, $voice_message_file_name);
    $date_today = date("m_d_y_h_s");   
    $rephoto = str_replace("\\", "", $rephoto);
    $rephoto = "{$rephoto}.mp4";
    $path = $_SERVER['DOCUMENT_ROOT'] . "/vkbot/bot/media/story/{$date_today}index.html";  
    file_put_contents($path, file_get_contents($rephoto));
    $attachments = array('doc'.$doc['owner_id'].'_'.$doc['id']);
    $body = "История успешно загружена и доступна туть: https://teyhd.ru/vkbot/bot/media/story/{$date_today}index.html";
    $msg = "{$username}, {$body}";
    $keyboard = keybrd('',$user_id); 
    vkApi_messagesSend($user_id, $msg, $attachments,$keyboard);
}
function bot_sendPhoto($user_id,$body,$rephoto) {
    $username = usrname($user_id,'get',1);  
    if ($body===""){
        $textmsg = "Фотка успешно принята. Хм,прикольная фотка"; 
        } else {
        $textmsg = $body; 
        }
$textmsg = mb_strtolower($textmsg);         
$textmsg = rtrim($textmsg,"!?.,/");
$pieces = explode(" ", $textmsg);

$msg = "{$username}, {$textmsg}";
$voice_message_file_name = yandexApi_getVoice($msg);
$doc = _bot_uploadVoiceMessage($user_id, $voice_message_file_name);

if ($pieces[0]=="расписание"){
$date_today = date("mdyhs");   
$rephoto = str_replace("\\", "", $rephoto);
$path = $_SERVER['DOCUMENT_ROOT'] . "/vkbot/bot/media/tasks/$pieces[1].jpg";  
file_put_contents($path, file_get_contents($rephoto));
 $photo = _bot_uploadPhoto($user_id, $path);
  $attachments = array(
    'photo'.$photo['owner_id'].'_'.$photo['id'],
    'doc'.$doc['owner_id'].'_'.$doc['id'],
  );    
} else{
$date_today = date("mdyhs");   
$rephoto = str_replace("\\", "", $rephoto);
$path = $_SERVER['DOCUMENT_ROOT'] . "/vkbot/bot/media/picture/picture_{$date_today}.jpg";  
file_put_contents($path, file_get_contents($rephoto));
 $photo = _bot_uploadPhoto($user_id, $path);
  $attachments = array(
    'photo'.$photo['owner_id'].'_'.$photo['id'],
    'doc'.$doc['owner_id'].'_'.$doc['id'],
  );
}
  $keyboard = keybrd('',$user_id); 
  vkApi_messagesSend($user_id, $msg, $attachments,$keyboard);
}
function bot_sendAudio($user_id,$body,$rephoto,$title) {
$username = usrname($user_id,'get',1);
$textmsg = $body;
$textmsg = mb_strtolower($textmsg);         
$textmsg = rtrim($textmsg,"!?.,/");
if ($textmsg=="поставь"){
    $msg = "{$username}, я включил песню";
    $title = str_replace(" ", "-", $title);
    $path = $_SERVER['DOCUMENT_ROOT'] . "/vkbot/bot/music/{$title}.mp3";  
    file_put_contents($path, file_get_contents($rephoto));
    sleep(0.2);
    $url = "http://192.168.0.103/msg.php?q=sentmsg?music_{$title}.mp3_2_3_4_5";
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
} else
        {
        $textmsg = "Песня {$title} - принята. Так же доступна туть: https://teyhd.ru/vkbot/bot/music";         
        $msg = "{$username}, {$textmsg}";
        }
$date_today = date("mdyhs");   
$rephoto = str_replace("\\", "", $rephoto);
$path = $_SERVER['DOCUMENT_ROOT'] . "/vkbot/bot/music/{$title}.mp3";  
file_put_contents($path, file_get_contents($rephoto));

  $voice_message_file_name = yandexApi_getVoice($msg);
  $doc = _bot_uploadVoiceMessage($user_id, $voice_message_file_name);
       
  $attachments = array(
    'doc'.$doc['owner_id'].'_'.$doc['id'],
  );
  $keyboard = keybrd('',$user_id); 
  vkApi_messagesSend($user_id, $msg, $attachments,$keyboard);
}
function _bot_uploadPhoto($user_id, $file_name) {
  $upload_server_response = vkApi_photosGetMessagesUploadServer($user_id);
  $upload_response = vkApi_upload($upload_server_response['upload_url'], $file_name);
  $photo = $upload_response['photo'];
  $server = $upload_response['server'];
  $hash = $upload_response['hash'];
  $save_response = vkApi_photosSaveMessagesPhoto($photo, $server, $hash);
  $photo = array_pop($save_response);
  return $photo;
}
function _bot_uploadVoiceMessage($user_id, $file_name) {
  $upload_server_response = vkApi_docsGetMessagesUploadServer($user_id, 'audio_message');
  $upload_response = vkApi_upload($upload_server_response['upload_url'], $file_name);
  $file = $upload_response['file'];
  $save_response = vkApi_docsSave($file, 'Voice message');
  $doc = array_pop($save_response);
  return $doc;
}
function generateRandomSelection($min, $max, $count){
    $result=array();
    if($min>$max) return $result;
    $count=min(max($count,0),$max-$min+1);
    while(count($result)<$count) {
        $value=rand($min,$max-count($result));
        foreach($result as $used) if($used<=$value) $value++; else break;
        $result[]=dechex($value);
        sort($result);
    }
    shuffle($result);
    return $result;
}
function recognize($file, $key) {
    $uuid=generateRandomSelection(0,30,64);
    $uuid=implode($uuid);    $uuid=substr($uuid,1,32);
    $curl = curl_init();
    $url = 'https://asr.yandex.net/asr_xml?'.http_build_query(array(
    'key'=>$key,
    'uuid' => $uuid,
    'topic' => 'queries',
    'lang'=>'ru-RU'
    ));
    curl_setopt($curl, CURLOPT_URL, $url);
    $data=file_get_contents(realpath($file));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: audio/x-mpeg-3' ));
    curl_setopt($curl, CURLOPT_VERBOSE, true);
    $response = curl_exec($curl);
    $err = curl_errno($curl);
    curl_close($curl);
    if ($err)
        throw new exception("curl err $err");
    return $response;
}
function bot_sendSticker($user_id,$rephoto) {
  $users_get_response = vkApi_usersGet($user_id);
  $user = array_pop($users_get_response);
  vkApi_StickerSend($user_id, $rephoto);
}
function download($url){
$date_today = date("mdyhs");   
$url = str_replace("\\", "", $url);
$path = $_SERVER['DOCUMENT_ROOT'] . "/vkbot/bot/media/audio/voice_{$date_today}.mp3";  
file_put_contents($path, file_get_contents($url));
$key = "36ba9849-6c36-4427-9cf9-7dcb6d380a91";
$tempr = recognize($path, $key);
$tempr = simplexml_load_string($tempr);
$tempr=object2array($tempr); 
foreach ($tempr as $key=>$value) {
   if ($key=='variant')  
   return $value;}
}