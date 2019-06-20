<?php
$q = $_REQUEST["q"];
$pieces = explode("?", $q);
if ($pieces[0] === "event") 
{
   active();
} 
active();
function active(){

$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind'); 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

$date = date("H:i");
if  (date("s")==59) {
    $flag = 0;
}

if ($result = $mysqli->query("SELECT id,user_id,time,text,event,active,music,active FROM events WHERE active=1")) { 

    while( $row = $result->fetch_assoc() ){ 
        if ($date==$row['time']){
            if ($row['active']==1){
            $sql = "UPDATE events SET active=0 WHERE id={$row['id']}";
            if ($mysqli->query($sql) === TRUE) {
            $msg = "В [{$row['time']}]: {$row['text']}";
            if ($flag == 0){
            $user_id = $row['user_id'];    
            mes($msg,$user_id);
            sleep(0.5);
            led("100");
            sleep(0.5);
            musicon($row['music']);
            addtext($msg);
            echo $msg;
            $flag = 1;
            }  
            } else {
                echo "Error updating record: " . $mysqli->error;
            }

            }
        } 
    } 
    if ($flag==0){echo "*";}
    $result->close(); 
} 

$mysqli->close(); 
}
function musicon($title){
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
}
function led($par){
$command = "/usr/bin/python /home/pi/strobe.py";
$connection = ssh2_connect('192.168.0.103', 22);
ssh2_auth_password($connection, 'root', '258000');
$stream = ssh2_exec($connection, $command);  
$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);
stream_set_blocking($errorStream, true);
stream_set_blocking($stream, true);
fclose($errorStream);
fclose($stream);
}
function mes($msg,$user_id){
$token = "22370387787625350d0dd61b51199ec54727b577ddb20a2a1082713659b3de10278d2a98467d497e0154d";
$request_params = array( 
'message' => $msg, 
'user_id' => $user_id, 
'access_token' => $token, 
'v' => '5.0', 
); 
$get_params = http_build_query($request_params); 
file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);
}
function addtext($text){
      $name1 = fopen("text.txt", "w");   
      fwrite ($name1, $text);   
      fclose ($name1);
}
?>
