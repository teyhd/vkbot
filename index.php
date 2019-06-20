<?php
define('CALLBACK_API_EVENT_CONFIRMATION', 'confirmation');
define('CALLBACK_API_EVENT_MESSAGE_NEW', 'message_new');
define('CALLBACK_API_EVENT_MESSAGE_REPLY', 'message_reply');
define('CALLBACK_API_EVENT_MESSAGE_TYPING', 'message_typing_state');

require_once 'config.php';
require_once 'global.php';

require_once 'api/vk_api.php';
require_once 'api/yandex_api.php';

require_once 'bot/bot.php';
require_once 'bot/smart_house.php'; 
require_once 'bot/function.php'; 
require_once 'bot/keyboard.php'; 
require_once 'bot/mysql_func.php'; 
require_once 'bot/non_msg.php'; 
require_once 'bot/games/hangman.php'; 
require_once 'bot/games/test.php'; 
require_once 'bot/games/anagaramm.php'; 
require_once 'bot/games/true.php'; 

if (!isset($_REQUEST)) {
  
  exit;
}

callback_handleEvent();

function callback_handleEvent() {
  $event = _callback_getEvent();

  try {
    switch ($event['type']) {
      //Подтверждение сервера
      case CALLBACK_API_EVENT_CONFIRMATION:
        _callback_handleConfirmation();
        break;
      //Получение нового сообщения
      case CALLBACK_API_EVENT_MESSAGE_NEW:
        _callback_okResponse(); //Отправили сообщение ОК на сервер
        _callback_handleMessageNew($event['object']); //Обработали
        exit(); //вышли
        break;
      case CALLBACK_API_EVENT_MESSAGE_REPLY:
        _callback_okResponse();
        break;        
      case CALLBACK_API_EVENT_MESSAGE_TYPING:
       // _callback_handleMessageNew($event['object']);
        break;
      default:
        _callback_response($event['type']);
        break;
    }
  } catch (Exception $e) {
    log_error($e);
  }

 // _callback_okResponse();
}

function _callback_getEvent() {
  return json_decode(file_get_contents('php://input'), true);
}

function _callback_handleConfirmation() {
  _callback_response(CALLBACK_API_CONFIRMATION_TOKEN);
}

function _callback_handleMessageNew($data) {
  $user_id = $data['user_id'];
  vkApi_Activity($user_id);
  $body = $data['body'];
  $geo = $data['geo'];
  if (!empty($geo)){
    $geo = $geo['place']; 
    $title = $geo['title']; 
    $country = $geo['country']; 
    $city = $geo['city']; 
    $keyboard = keybrd('',$user_id); 
    setdialog($user_id,"non");
    $msg = "{$country} {$city} {$title}";
    vkApi_messagesSend($user_id, $title,'',$keyboard);
  }
  $fwd = $data['fwd_messages'];
  if(!empty($fwd))
      {
      $fwd = $fwd['0'];
      $Attachs = $fwd['attachments'];
      } 
      else {$Attachs = $data['attachments'];}
  $temptex = $Attachs['0'];
  if ($temptex =="")
  {  
     $voiceurl="";
     $body = $data['body'];
     bot_sendMessage($user_id,$body,$voiceurl); 
  }
  for ($sk=0; $sk<2; $sk++) {
  $AttachType = $Attachs[$sk];
 // $AttachType = $Attachs['0'];
 if ($AttachType==""){break;}
  switch ($AttachType['type']) {
    case "photo":
        $rephoto = $AttachType['photo'];
        $flagg=0;
        for ($x=1500; $x>0; $x--) {
        $qualet = $rephoto["photo_{$x}"];
        if (!empty($qualet)) {bot_sendPhoto($user_id,$body,$qualet); $flagg=1; break;}
        } 
        if ($flagg==0) {bot_sendSticker($user_id,"2795"); }
        break;
    case "video":
        $rephoto = $AttachType['video'];
        $title = $rephoto['title'];
        $body= "Видео {$title} - принято";
        $flagg=0;
        for ($x=1500; $x>0; $x--) {
        $qualet = $rephoto["photo_{$x}"];
        if (!empty($qualet)) {bot_sendPhoto($user_id,$body,$qualet); $flagg=1; break;}
        } 
        if ($flagg==0) {bot_sendSticker($user_id,"2795"); }
        break;
   case "link": //История
        $rephoto = $AttachType['link'];
        $body= "История успешно загружена";
        $rephoto = $rephoto['button'];
        $rephoto = $rephoto['action'];
        $rephoto = $rephoto['url'];
        bot_sendStory($user_id,$body,$rephoto);
        break;    
    case "audio":
        $rephoto = $AttachType['audio'];
        $title = $rephoto['title'];
        $rephoto = $rephoto['url'];
        bot_sendSticker($user_id,"4324");
        bot_sendAudio($user_id,$body,$rephoto,$title);
        break;  
    case "sticker":
        $rephoto = $AttachType['sticker'];
        $rephoto = $rephoto['id'];
        $body = "*ID Стикера:{$rephoto}";
        bot_sendSticker($user_id,$rephoto);
        $voiceurl = "";
        bot_sendMessage($user_id,$body,$voiceurl);
        break;        
    case "wall":
        $rephoto = $AttachType['wall'];
        $title = $rephoto['text'];
        $body= "Пост {$title} - принят";
        $rephoto = $rephoto['attachments'];
        $rephoto = $rephoto['0'];
        $rephoto = $rephoto['photo'];
        $flagg=0;
        bot_sendSticker($user_id,"2798");
        for ($x=1500; $x>0; $x--) {
        $qualet = $rephoto["photo_{$x}"];
        if (!empty($qualet)) {bot_sendPhoto($user_id,$body,$qualet); $flagg=1; break;}
        } 
        if ($flagg==0) {bot_sendSticker($user_id,"2795"); }
        break;
    case "doc":
          $voiceurl = $AttachType['doc'];
          if ($voiceurl['ext']=="ogg"){
              $voiceurl = $voiceurl['preview'];  
              $voiceurl = $voiceurl['audio_msg'];  
              $voiceurl = $voiceurl['link_mp3'];  
              bot_sendSticker($user_id,"9046");
              bot_sendMessage($user_id,$body,$voiceurl);
          }
          if ($voiceurl['ext']=="torrent"){
              $title = $voiceurl['title'];
              $body= "Торрент {$title} - успешно принят"; 
              $rephoto = $voiceurl['url'];
              bot_sendTorrent($user_id,$body,$rephoto,$title);
          }
          if ($voiceurl['ext']=="png"){
              $body= "Рисунок - успешно принят!"; 
              $rephoto = $voiceurl['url'];
              bot_sendPicture($user_id,$body,$rephoto);
          }          
        break;        
    default:
     $voiceurl="";
     $body = $data['body'];
     bot_sendMessage($user_id,$body,$voiceurl); 
}
}
}

function _callback_okResponse() {
  _callback_response('ok');
}

function _callback_response($data) {
  echo $data;
  //exit();
}
