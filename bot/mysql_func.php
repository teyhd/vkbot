<?php
function text_to_all($mod,$text){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
}  
if($mod=="set"){
    $stmt = $mysqli->prepare("UPDATE text_to_all SET text='{$text}' WHERE id=0"); 
    $stmt->bind_param('s', $text); 
    
    $stmt->execute(); 
    $stmt->close();
}
if($mod=="get"){
    
if ($stmt = $mysqli->prepare("SELECT text FROM text_to_all WHERE id=0")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1); 
    while ($stmt->fetch()) { 
        $text = $col1;
    } 
    $stmt->close(); 
}
//
}
$mysqli->close(); 
return $text;
}
function send_to_all($text){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

if ($stmt = $mysqli->prepare("SELECT user_id FROM dialog WHERE user_id LIKE '%' ")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1); 
    while ($stmt->fetch()) { 
       $user_id = $col1;
       if ($user_id!==null){
           send_msg($user_id,$text);
           sleep(3);
        }
    } 
    $stmt->close(); 
}
$mysqli->close(); 
return ("Отправлен тескт: {$text} вот этому перцу {$isadmin}\n");
}//Рассылка текста
function rand_adv(){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 
if ($stmt = $mysqli->prepare("SELECT max(id) FROM advice WHERE id")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1); 
    while ($stmt->fetch()) { 
        $id = $col1;
    } 
    $stmt->close(); 
}
$num = rand(0,$id);
    if ($stmt = $mysqli->prepare("SELECT adv_text FROM advice WHERE id={$num}")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
            $advice = $col1;
        } 
        $stmt->close(); 
    }
 $mysqli->close(); 
return $advice;         
}
function mysql_horoscop($mod,$sign,$text){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
}  
    if($mod=="set"){
        $stmt = $mysqli->prepare("UPDATE horoscop SET `{$sign}`='{$text}' WHERE `{$sign}`=`{$sign}`"); 
        $stmt->bind_param('ss', $sign,$text); 
        $stmt->execute(); 
        $stmt->close();
    }
    if($mod=="get"){
        if ($stmt = $mysqli->prepare("SELECT {$sign} FROM horoscop WHERE {$sign}={$sign}")) { 
            $stmt->execute(); 
            $stmt->bind_result($col1); 
            while ($stmt->fetch()) { 
                $sign = $col1;
            } 
            $stmt->close(); 
        }
    }
$mysqli->close(); 
return $sign;
}
function remember($user_id,$mod,$text){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
}  
if($mod=="set"){
    if ($stmt = $mysqli->prepare("SELECT max(id) FROM remember WHERE id")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
            $max_id = $col1+1;
        } 
        $stmt->close(); 
    }
    $id = $max_id+1;
    $stmt = $mysqli->prepare("INSERT INTO remember VALUES (?, ?, ?)"); 
    $stmt->bind_param('dds', $id,$user_id,$text); 
    $stmt->execute(); 
    $stmt->close();
}
if($mod=="get"){
    
if ($stmt = $mysqli->prepare("SELECT id,text FROM remember WHERE text LIKE '%{$text}%'")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1,$col2); 
    while ($stmt->fetch()) { 
        $id = $col1;
        $ans= "$ans [id {$id}:$col2]";
    } 
    $stmt->close(); 
}
//
}
$mysqli->close(); 
return $ans;
}
function usrname($user_id,$mod,$value){
    $value = trim($value);
    $users_get_response = vkApi_usersGet($user_id);
    $user = array_pop($users_get_response);
    $VK_username = $user['first_name'];
    $mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
    /* Проверка соединения */ 
    if (mysqli_connect_errno()) { 
        printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
        exit(); 
    } 
    if ($mod=="get"){
      if ($stmt = $mysqli->prepare("SELECT nickname FROM dialog WHERE user_id={$user_id}")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
           $nickname = $col1;
        } 
        $stmt->close(); 
      }
    }
    if ($mod=="set"){
    $stmt = $mysqli->prepare("UPDATE dialog SET nickname='{$value}' WHERE user_id=$user_id"); 
    $stmt->bind_param('ds', $user_id,$value); 
    
    $stmt->execute(); 
    $stmt->close(); 
    }
        
    if ($nickname==null){
        user_add($user_id);
        return $VK_username;
        }
    $nickname = mb_ucfirst($nickname);   
    if($nickname!=='None') return $nickname; else return $VK_username;
     $mysqli->close();
}
function set_admin($user_id,$Dial_type){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

    $stmt = $mysqli->prepare("UPDATE dialog SET isadmin='{$Dial_type}' WHERE user_id=$user_id"); 
    $stmt->bind_param('ds', $user_id,$Dial_type); 
    
    $stmt->execute(); 
    $stmt->close();
$mysqli->close(); 
return 1;
}
function isadmin($user_id){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

if ($stmt = $mysqli->prepare("SELECT isadmin FROM dialog WHERE user_id={$user_id}")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1); 
    while ($stmt->fetch()) { 
       $isadmin = $col1;
    } 
    $stmt->close(); 
}

if ($isadmin==null){
    user_add($user_id);
    }
$mysqli->close(); 
return $isadmin;
}
function getdialog($user_id){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

if ($stmt = $mysqli->prepare("SELECT dial_type FROM dialog WHERE user_id={$user_id}")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1); 
    while ($stmt->fetch()) { 
       $Dial_type = $col1;
    } 
    $stmt->close(); 
}

if ($Dial_type==null){
     user_add($user_id);
    }
$mysqli->close(); 
return $Dial_type;
}
function user_add($user_id){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
}     
    $Dial_type = "non";
    $nick = 'none';
    $stmt = $mysqli->prepare("INSERT INTO dialog VALUES (?, ?, 0, 0, 0, 0, ?)"); 
    $stmt->bind_param('dss', $user_id,$Dial_type,$nick); 
    $stmt->execute(); 
    $stmt->close(); 
$mysqli->close();     
}
function setdialog($user_id,$Dial_type){
$addexp = 0;
$iscmd = 0;
$output = 0;  
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 

    $stmt = $mysqli->prepare("UPDATE dialog SET dial_type='{$Dial_type}' WHERE user_id=$user_id"); 
    $stmt->bind_param('ds', $user_id,$Dial_type); 
    
    $stmt->execute(); 
    $stmt->close();
$mysqli->close(); 
return 1;
}
function learner($user_id,$addexp,$iscmd,$output){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 
if ($stmt = $mysqli->prepare("SELECT dial_type FROM dialog WHERE user_id={$user_id}")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1); 
    while ($stmt->fetch()) { 
       $Dial_type = $col1;
    } 
    $stmt->close(); 
}

if ($Dial_type==null){
    user_add($user_id);
    }
if ($addexp!==""){
    $stmt = $mysqli->prepare("UPDATE dialog SET addexp='{$addexp}' WHERE user_id=$user_id"); 
    $stmt->bind_param('ds', $user_id,$addexp); 
    $stmt->execute(); 
    $stmt->close();
}
if ($iscmd!==""){
    $stmt = $mysqli->prepare("UPDATE dialog SET iscmd='{$iscmd}' WHERE user_id=$user_id"); 
    $stmt->bind_param('ds', $user_id,$iscmd); 
    $stmt->execute(); 
    $stmt->close();    
} 
if ($output!==""){
    $output = mb_ucfirst($output);
    $stmt = $mysqli->prepare("UPDATE dialog SET output='{$output}' WHERE user_id=$user_id"); 
    $stmt->bind_param('dsss', $user_id,$output); 
    $stmt->execute(); 
    $stmt->close();    
} 
$mysqli->close(); 
return 1;
}
function teather($user_id){
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
        $id = $col1+1;
    } 
    $stmt->close(); 
}

if ($stmt = $mysqli->prepare("SELECT addexp,iscmd,output FROM dialog WHERE user_id={$user_id}")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1,$col2,$col3); 
    while ($stmt->fetch()) { 
       $input = $col1;
       $command =$col2;
       $output = $col3;
    } 
    $stmt->close(); 
}

$public = 1;
$stmt = $mysqli->prepare("INSERT INTO commands VALUES (?, ?, ?, ?, ?)"); 
$stmt->bind_param('dsssd', $id,$input,$output,$command,$public); 
$stmt->execute(); 
$stmt->close(); 
    $empvar1=''; $empvar2=''; $empvar3='';
    $stmt = $mysqli->prepare("UPDATE dialog SET addexp='',iscmd='',output='' WHERE user_id=$user_id"); 
    $stmt->execute(); 
    $stmt->close();
    
$mysqli->close(); 
return 1;
}
function addsay($text){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 
if ($stmt = $mysqli->prepare("SELECT max(id) FROM say WHERE id")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1); 
    while ($stmt->fetch()) { 
        $id = $col1+1;
    } 
    $stmt->close(); 
}
$stmt = $mysqli->prepare("INSERT INTO say VALUES (?, ?)"); 
$stmt->bind_param('ds', $id,$text); 
$stmt->execute(); 
$stmt->close(); 
$mysqli->close(); 
return $id;
}
function sayme(){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
} 
if ($stmt = $mysqli->prepare("SELECT max(id) FROM say WHERE id")) { 
    $stmt->execute(); 
    $stmt->bind_result($col1); 
    while ($stmt->fetch()) { 
        $id = $col1;
    } 
    $stmt->close(); 
}
$id = rand(0, $id);
if ($stmt = $mysqli->prepare("SELECT id,string FROM say WHERE id={$id}")) { 
    $stmt->execute(); 
    $stmt->bind_result($id, $text); 
        while ($stmt->fetch()) { 
            $msg = $text;
    } 
    
    $stmt->close(); 
}
$mysqli->close(); 
return $msg;
}
?>