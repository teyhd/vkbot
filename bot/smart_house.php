<?php
function swit_reboot($param){
switch ($param) {
    case 'сервер':
        reboot(1);
        $msg = "Сервер перезагружен";
        break;
    case 'календарь':
        reboot(2);
        $msg = "Календарь перезагружен";
        break;
    case 'компьютер':
    case 'комп':
    case 'пк':
    case 'мой компьютер':
        reboot(3);
        $msg = "Компьютер скоро будет перезагружен";
        break;
      case 'ноутбук':
    reboot(4);
    $msg = "Ноутбук скоро будет перезагружен";
    break;          
    default:
        $msg = "Такого девайса нет";
        break;
}    
   return $msg;  
}
function off($param){
switch ($param) {
    case 'свет':
        led(0);
        $msg = "Свет выключен";
        break;
    case 'сервер':
        sershut(1);
        $msg = "Сервер выключен";
        break;
    case 'календарь':
        sershut(2);
        $msg = "Календарь выключен";
        break;
    case 'компьютер':
    case 'комп':
    case 'пк':
    case 'мой компьютер':
        sershut(3);
        $msg = "Компьютер скоро выключится";
        break;
   case 'ноутбук':
    sershut(4);
    $msg = "Ноутбук скоро будет выключен";
    break;     
    case 'кофеварка':
    case 'кофеварку':
        coffee(0);
        $msg = "Кофееварка выключена";
        break;
    default:
        $msg = "Такого девайса нет";
        break;
}    
   return $msg;  
}
function swit_sleep($param){
switch ($param) {
    case 'компьютер':
    case 'комп':
    case 'пк':
    case 'мой компьютер':
        d_sleep(1);
        $msg = "Компьютер скоро уснет";
        break;
   case 'ноутбук':
    case 'ноут':       
    d_sleep(2);
    $msg = "Ноутбук скоро уснет";
    break;     
    default:
        $msg = "Такого девайса нет";
        break;
}    
   return $msg;  
}
function reboot($par){
    if ($par==1){
        $connection = ssh2_connect('ser.teyhd.ru', 22);
        ssh2_auth_password($connection, 'root', '258000');
        $stream = ssh2_exec($connection, "init 6");
    }
    if ($par==2){
        $connection = ssh2_connect('192.168.0.103', 22);
        ssh2_auth_password($connection, 'root', '258000');
        $stream = ssh2_exec($connection, "init 6");  
    }
    if ($par==3)  {
        $connection = ssh2_connect('192.168.0.105', 22);
        ssh2_auth_password($connection, 'spiderman201010@mail.ru', 'Vlad281000');
        $stream = ssh2_exec($connection, "shutdown -r");    
    }
    if ($par==4)  {
    $connection = ssh2_connect('192.168.0.108', 22);
    ssh2_auth_password($connection, 'spiderman201010@mail.ru', 'Vlad281000');
    $stream = ssh2_exec($connection, "shutdown -r");    
    }
$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
stream_set_blocking($errorStream, true);
stream_set_blocking($stream, true);
fclose($errorStream);
fclose($stream);
}
function sershut($par){
    if ($par==1){
        $connection = ssh2_connect('ser.teyhd.ru', 22);
        ssh2_auth_password($connection, 'root', '258000');
        $stream = ssh2_exec($connection, "init 0");
    }
    if ($par==2){
        $connection = ssh2_connect('192.168.0.103', 22);
        ssh2_auth_password($connection, 'root', '258000');
        $stream = ssh2_exec($connection, "init 0");  
    }
    if ($par==3)  {
        $connection = ssh2_connect('192.168.0.105', 22);
        ssh2_auth_password($connection, 'spiderman201010@mail.ru', 'Vlad281000');
        $stream = ssh2_exec($connection, "shutdown -s -t 10");    
    }
    if ($par==4) {
        $connection = ssh2_connect('192.168.0.108', 22);
        ssh2_auth_password($connection, 'spiderman201010@mail.ru', 'Vlad281000');
        $stream = ssh2_exec($connection, "shutdown -s -t 10"); 
        return 1;
    }
$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
stream_set_blocking($errorStream, true);
stream_set_blocking($stream, true);
fclose($errorStream);
fclose($stream);
return 1;
}
function d_sleep($par){
    if ($par==1)  {
        $connection = ssh2_connect('192.168.0.105', 22);
        ssh2_auth_password($connection, 'spiderman201010@mail.ru', 'Vlad281000');
        $stream = ssh2_exec($connection, "shutdown -H");    
    }
    if ($par==2) {
        $connection = ssh2_connect('192.168.0.108', 22);
        ssh2_auth_password($connection, 'spiderman201010@mail.ru', 'Vlad281000');
        $stream = ssh2_exec($connection, "shutdown -H"); 
        return 1;
    }
$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
stream_set_blocking($errorStream, true);
stream_set_blocking($stream, true);
fclose($errorStream);
fclose($stream);
return 1;
}
function led($par){
$command = "p 18 {$par}";    
$command = "echo {$command} > /dev/pigpio";
$connection = ssh2_connect('192.168.0.103', 22);
ssh2_auth_password($connection, 'root', '258000');
$stream = ssh2_exec($connection, $command);  
$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
stream_set_blocking($errorStream, true);
stream_set_blocking($stream, true);
fclose($errorStream);
fclose($stream);
}
function coffee($par){
if ($par==1){
   $command = "p 17 255"; 
            } else {$command = "p 17 0"; }
$command = "echo {$command} > /dev/pigpio";
$connection = ssh2_connect('192.168.0.103', 22);
ssh2_auth_password($connection, 'root', '258000');
$stream = ssh2_exec($connection, $command);  
$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
stream_set_blocking($errorStream, true);
stream_set_blocking($stream, true);
fclose($errorStream);
fclose($stream);
}
function normaltime($pieces){
           $tempdatemin = date(i);
           $tempdateh = date(H);

           $hour = 0;
           if ($pieces>=60){
               $hour = intdiv($pieces,60);
               $min = $pieces % 60;
           } else {$min = $pieces;}
           $tempdatemin+=$min;
           $tempdateh+=$hour;
           if ($tempdatemin>=60){
               $tempdatemin = $tempdatemin-60;
               $tempdateh++;
           }
           if ($tempdateh==24){
               $tempdateh ="0";
           }           
           if ($tempdateh>24){
              $tempdateh = $tempdateh-25;
           }
         if ($tempdateh<10) {$tempdateh = "0{$tempdateh}";}
           if ($tempdatemin<10) {$tempdatemin = "0{$tempdatemin}";}
           $time = "{$tempdateh}:{$tempdatemin}";
           return $time;
}
function strobe(){
$command = '/usr/bin/python /home/pi/strobe.py';
$connection = ssh2_connect('192.168.0.103', 22);
ssh2_auth_password($connection, 'pi', '281000');
$stream = ssh2_exec($connection, $command);  
$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
stream_set_blocking($errorStream, true);
stream_set_blocking($stream, true);
fclose($errorStream);
fclose($stream);
return "Стробоскоп включен";
}
function clearbd(){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind'); 
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 
$mysqli->query("DELETE FROM events WHERE active=0"); 
$msg = $mysqli->affected_rows;
return $msg;
$mysqli->close(); 
}
function addevent(){
$numargs = func_num_args();
$arg_list = func_get_args();

$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 
if ($stmt = $mysqli->prepare("SELECT max(id) FROM events WHERE id")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1); 
    while ($stmt->fetch()) { 
        $id = $col1+1;
    } 
    $stmt->close(); 
}

$stmt = $mysqli->prepare("INSERT INTO events VALUES (?, ?, ?, ?, ?, ?, ?)"); 
$stmt->bind_param('ddsssds', $id, $user_id, $time, $text, $event, $active, $music); 

$active = 1; 
$event =   $arg_list[0];
$user_id = $arg_list[1]; //передается первым
$text =    $arg_list[2]; //передается вторым 
$time =    $arg_list[3];
$music = "alarm";
if (!empty($arg_list[4])) {$music = ltrim($arg_list[4]);}
$stmt->execute(); 
$stmt->close(); 
$mysqli->close(); 
return $id;
}
function delevent($id){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 
$mysqli->query("DELETE FROM events WHERE id={$id}"); 
$mysqli->close(); 
}
function eventinfo($id){
$mysqli = new mysqli('192.168.0.103', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 
if ($stmt = $mysqli->prepare("SELECT id,user_id,time,text,event,active,music FROM events WHERE id={$id}")) { 
    $stmt->execute(); 
    $stmt->bind_result($id, $user_id, $time, $text, $event, $active, $music); 
        while ($stmt->fetch()) { 
            $msg ="[id:{$id}]Напоминание для {$user_id} в {$time}. Текст напоминания: {$text}, музыка:{$music}. Активность:{$active}";
    } 
    
    $stmt->close(); 
}
$mysqli->close(); 
return $msg;
}
?>