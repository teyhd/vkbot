<?php //Вариант № 12702635
function testing($user_id,$ansver){
$lvl = test_lvl($user_id,"get",1); 
$right = test_right($user_id,"get",1);
$testask = array(
"№1 В одном из приведённых ниже слов допущена ошибка в постановке ударения: НЕВЕРНО выделена буква, обозначающая ударный гласный звук. Выпишите это слово.\nнамЕрение\nдавнИшний\nбАнты\nбалУясь\nхристиАнин",

"№2 В одном из приведённых ниже слов допущена ошибка в постановке ударения: НЕВЕРНО выделена буква, обозначающая ударный гласный звук. Выпишите это слово.\nзвонИшь\nпринЯвший\nначАв (петь)\nпОняв\nпрожИв",


"№3 Отредактируйте предложение: исправьте лексическую ошибку, исключив лишнее слово. Выпишите это слово.\nС бодрыми восклицаниями вперемешку с неуместной робостью мы вошли в двери театра и стали подниматься вверх по лестнице с медными прутьями и красовавшейся на ней красной ковровой дорожкой.",


"№4 В одном из выделенных ниже слов допущена ошибка в образовании формы слова. Исправьте ошибку и запишите слово правильно.\nвдоль ПОБЕРЕЖЬЕВ\nШЕСТЬЮСТАМИ письмами\nподписанные ДОГОВОРЫ\nКЛАДИТЕ аккуратнее\nБОЛЕЕ КРУПНАЯ рыба",


"№5 Укажите варианты ответов, в которых во всех словах одного ряда пропущена одна и та же буква. Запишите номера ответов.\n1) располож..нная, замета..мая\n2) верт..тся, сожале..т\n3) плыв..т (баржи), вид..т (глаза)\n4) терп..щие, кол..щие\n5) вынес..нный, страда..т (он)",

"№6 Укажите варианты ответов, в которых во всех словах одного ряда пропущена безударная проверяемая гласная корня. Запишите номера ответов.\n1) закл..нать, р..акция, пол..гать\n2) проф..риентация, д..брота, в..теран\n3) загл..денье, прим..рять (галстук), п..левая (кухня)\n4) вн..мательный, д..пломат, през..дент\n5) г..рода, насм..хаться, скр..пучая",


"№7 Укажите варианты ответов, в которых во всех словах одного ряда пропущена одна и та же буква. Запишите номера ответов.\n1) бе..голосый, чере..чур, во..пламенеть;\n2) д..ячок, кар..ера, п..едестал;\n3) не..писуемый, поз..прошлый, п..рядок;\n4) непр..миримый, пр..близить, пр..звание;\n5) от..мстить, перер..спределение, р..сстрел.",


"№8 Укажите варианты ответов, в которых в обоих словах одного ряда пропущена одна и та же буква. Запишите номера ответов.\n1) отта..в, ореш..к\n2) вкрадч..вый, меньш..нство\n3) запрыг..вать, движ..мый\n4) алюмини..вый, пород..стый\n5) задумч..вый, гир..вой (спорт)",


"№9 Укажите варианты ответов, в которых во всех одного ряда пропущена одна и та же буква. Запишите номера ответов.\n1) постро..шь, (можно) наде..ться\n
2) задерж..вшийся, раду..щийся\n3) раскле..шь, намет..ть (план)\n4) пропол..шь, упроща..шь\n5) (он) расстел..т, заправ..шь",


"№10 Определите предложение, в котором НЕ со словом пишется СЛИТНО. Раскройте скобки и выпишите это слово.\nЛуна (не)бледна, а прозрачна, как хрусталь.\nОн ниоткуда (не)получал писем.\n(Не)исследованные места влекут меня, а глухие дебри.\nДорога (не)ровная, зато самая короткая.\nЧасовой пропустил их, (не)проверив пароля.",


"№11 В одном из выделенных ниже слов допущена ошибка в образовании формы слова. Исправьте ошибку и запишите слово правильно.\nМЛЕКОПИТАЮЩИЕСЯ животные\nЛЕГЧАЙШЕЕ пёрышко\nВЫЗДОРОВЕЮ\nмного БРЫЗГ\nЕДКИЙ аэрозоль",


"№12 Укажите все цифры, на месте которых пишется одна буква Н?\nСтарший лесник, дли(1)ый и неуклюжий, в галифе из домотка(2)ого сукна, в стира(3)ой сорочке, сидел в стороне от всех и насмешливо улыбался.",


"№13 Укажите варианты ответов, в которых в обоих словах одного ряда пропущена одна и та же буква. Запишите номера ответов.\n1) усидч..вый, зелён..нький\n2) отстёг..вавший, сем..ни\n3) находч..вый, страдал..ц\n4) щегол..ватый, тёт..нька\n5) прислуш..ваться, талантл..вый",


"№14 Расставьте все знаки препинания: укажите цифру(-ы), на месте которой(-ых) в предложении должна(-ы) стоять запятая(-ые).\n
На колокольне Михайловского монастыря пробило четыре (1) когда я, перейдя пустырь, вступил в боковую аллею Александровского парка (2) в глубине (3) которого (4) между чёрных стволов обнажённых деревьев просматривалась Александровская колонна.",


"№15 Расставьте все знаки препинания: укажите цифру(-ы), на месте которой(-ых) в предложении должна(-ы) стоять запятая(-ые).\nЧерез несколько часов (1) Иван обессилел (2) и (3) когда понял (4) что с бумагами ему не совладать (5) тихо и горько заплакал."
);
$task_num = count($testask);
if($lvl<$task_num){
    if ($ansver==''){
    $msg =$testask[$lvl]; 
    } 
     else{
         switch ($lvl) {
             case 0:
                 if($ansver=="христианин"){$right++;test_right($user_id,"set",$right);};
             break;
             case 1:
                 if($ansver=="поняв"){$right++;test_right($user_id,"set",$right);};
             break;
             case 2:
                 if($ansver=="вверх"){$right++;test_right($user_id,"set",$right);};
             break;
             case 3:
                 if($ansver=="побережий"){$right++;test_right($user_id,"set",$right);};
             break;
             case 4:
                 if(($ansver==15)||($ansver==51)){$right++;test_right($user_id,"set",$right);};
             break;
             case 5:
                 if(($ansver==35)||($ansver==53))  {$right++;test_right($user_id,"set",$right);};
             break;
             case 6:
                 if(($ansver==24)||($ansver==42)){$right++;test_right($user_id,"set",$right);};
             break;
             case 7:
                 if(($ansver==23)||($ansver==32)){$right++;test_right($user_id,"set",$right);};
             break;
             case 8:
                 if(($ansver==34)||($ansver==43)){$right++;test_right($user_id,"set",$right);};
             break;
             case 9:
                 if($ansver=="неровная"){$right++;test_right($user_id,"set",$right);};
             break;
             case 10:
                 if($ansver=="млекопитающие"){$right++;test_right($user_id,"set",$right);};
             break;
             case 11:
                 if(($ansver==23)||($ansver==32)){$right++;test_right($user_id,"set",$right);};
             break;
             case 12:
                 if(($ansver==45)||($ansver==54)){$right++;test_right($user_id,"set",$right);};
             break;
             case 13:
                 if(($ansver==12)||($ansver==21)){$right++;test_right($user_id,"set",$right);};
             break;
             case 14:
                 if($ansver==345){$right++;test_right($user_id,"set",$right);};
             break;
         }
         $lvl++;
         test_lvl($user_id,"set",$lvl); 
         if($lvl<$task_num){
             $msg =$testask[$lvl];
         }else { $msg = "Поздравляю Вы прошли тест. Ваш результат: {$right}/{$task_num}. Введите Хочу обучать чтобы появилась возможность обучать бота ";setdialog($user_id,"non");
             
         }
         
     }
} else {
    setdialog($user_id,"non");
    $msg = "Вы уже проходили тест. Ваш результат: {$right}/{$task_num}. Чтобы пройти его снова обратитесь к администрации";
}
  $attachments = '';
  $keyboard = keybrd('',$user_id); 
  vkApi_messagesSend($user_id, $msg, $attachments,$keyboard);
}
function test_right($user_id,$mod,$value){
    $mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
    /* Проверка соединения */ 
    if (mysqli_connect_errno()) { 
        printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
        exit(); 
    } 
    if ($mod=="get"){
      if ($stmt = $mysqli->prepare("SELECT test_right FROM tests WHERE user_id={$user_id}")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
           $lvl = $col1;
        } 
        $stmt->close(); 
      }
    }
    if ($mod=="set"){
    $stmt = $mysqli->prepare("UPDATE tests SET test_right='{$value}' WHERE user_id=$user_id"); 
    $stmt->bind_param('ds', $user_id,$value); 
    $stmt->execute(); 
    $stmt->close(); 
    }
        
    if ($lvl==null){
        test_user_add($user_id);
        $lvl=0;
    }
 
    return $lvl;
     $mysqli->close();    
}
function test_lvl($user_id,$mod,$value){
    $mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
    /* Проверка соединения */ 
    if (mysqli_connect_errno()) { 
        printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
        exit(); 
    } 
    if ($mod=="get"){
      if ($stmt = $mysqli->prepare("SELECT test_lvl FROM tests WHERE user_id={$user_id}")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
           $lvl = $col1;
        } 
        $stmt->close(); 
      }
    }
    if ($mod=="set"){
    $stmt = $mysqli->prepare("UPDATE tests SET test_lvl='{$value}' WHERE user_id=$user_id"); 
    $stmt->bind_param('ds', $user_id,$value); 
    
    $stmt->execute(); 
    $stmt->close(); 
    }
        
    if ($lvl==null){
        test_user_add($user_id);
        $lvl=0;
    }
 
    return $lvl;
     $mysqli->close();
}
function test_user_add($user_id){
$mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
/* Проверка соединения */ 
if (mysqli_connect_errno()) { 
    printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
    exit(); 
}     
    $stmt = $mysqli->prepare("INSERT INTO tests VALUES (?, 0, 0, 0)"); 
    $stmt->bind_param('d', $user_id); 
    $stmt->execute(); 
    $stmt->close(); 
$mysqli->close();     
}