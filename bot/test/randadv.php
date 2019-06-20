<?php
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
echo ("$advice\n");           
}
