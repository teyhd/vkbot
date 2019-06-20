<?php

function trueorlie($user_id,$text){
$lvl = riddle_lvl($user_id,"get",1);
$right = riddle_right($user_id,"get",1);
$quest = array("Горгонарии растут в наших лиственных лесах",
"Терновый венец – это награда за страдания",
"Ламантин обитает на тропических деревьях Амазонки",
"Еноты моют любую пищу перед едой",
"Чистяк – это растение , который зимой и летом , одним цветом",
"В раковинах живут моллюски",
"Самые мелкие живые существа - это клопы",
"У крокодилов есть уши",
"В человеческом теле 20% жидкости.",
"Самая крупная рыба – китовая акула ",
"Из 200 000 осьминогов выживают 1-2 особи",
"Осьминог относится к высшим животным ",
"Актиния – цветок , растущий на клумбе",
"Самый быстрый пловец рыба- парусник", 
"Пресноводные губки хорошо очищаю посуду",
"Рыба- луна – рекордсмен по метанию икры",
"Илистый прыгун – это прыгучее насекомое",
"Существуют ракушки весом 250 кг., длиной 1,5 метра",
"Анемоны – это красивые цветы , которые растут на деревьях в Новой
Зеландии",
"Коралловые рифы – это кишечнополостные животные и результат
деятельности коралловых полипов",
"Тело медузы на 98 % состоит из воды",
"Полипы относятся к стрекающим животным",
"Кальмары - головоногие моллюски",
"Медузы размножаются спорами",
"Грибы , размножаются черенками",
"Медузы выделяют наркотические вещества",
"Слизни живут в раковинах",
"Морской конек всегда плавает вниз головой",
"Барракуды нерестятся в Саргассовом море",
"Летучая мышь спит вверх головой ",
"Зеленый щитник- это ядовитый и вонючий клоп ",
"Паук – то насекомое",
"Тело акулы состоит из костей",
"Пауки- хамелеоны меняют цвет в зависимости от окраски цветка , на котором сидят",
"Синий кит живет до 300 лет ",
"Паук «черная вдова» - самая печальная и грустная",
"Скорпион относится к членистоногим",
"Киты переговариваются при помощи щелчков и свиста ",
"Пауки- кругопряды плетут самую прочную сеть",
"Тарантул – самый ядовитый паук , который водится в Чувашии",
"Муравьи кормятся медвяной росой",
"Осы, после того как ужалят умирают",
"Самка богомола откусывает при спаривании голову самцу",
"Тутовый шелкопряд встречается в лиственных лесах",
"Гусеница – это личинка бабочки",
"Мотылек – это название моли",
"Жук- бронзовка золотистая пахнет навозом",
"У божьей коровки ядовитая кровь",
"Шершень – самый большой шмель",
"Ручейник живет в домике в воде",
"Змеи покрыты чешуей ? ",
"Слоны спят по 22 часа в сутки? ",
"У стрекозы в каждом глазу 22000 глазков ",
"Тля пасет муравьев",
"Слоны хорошо плавают ",
"Сверчки во время сражений берегут носики",
"Горючим для саранчи служит жир ",
"Муравьи – социальные насекомые",
"Слоны жуют по 17-19 часов",
"Крокодилы - вредители водоемов",
"Бабочка дышит жабрами",
"У бабочки 6 ног ",
"Тело бабочки покрыто пластиками ",
"У бабочки есть в крыльях вены",
"Львы спят до 22 часов в сутки",
"Существует лягушка под названием пипа",
"Лягушки откладывают яйца",
"Черепаха может весить до 1000 кг. ",
"Крокодилы – санитары водоемов",
"Крокодилы дружат с птицами ",
"Слоны живут до 100 лет ",
"Змеи сбрасывают кожу от голода ",
"Крокодилы умеют квакать и шипеть",
"У черепахи при опасности выделяются капли крови из глаз",
"Лягушки могут лаять , как собаки", 
"Головастик похож на рыбку",
"Панда ест листья эвкалипта ",
"Ягуар - самая быстрая кошка из крупных кошачьих ",
"Рысь может жить при Т -57 градусов ",
"Бабочка чувствует вкус нектара через ноги");
$quest_num = count($quest);
if ($lvl<=$quest_num){//Остались еще вопросы
$true = array('да','правда','истина');
$false = array('нет','неправда','не правда','ложь');
$ask = $quest[$lvl];
if (in_array($text, $true)==1) $answ = true;
if (in_array($text, $false)==1) $answ = false;

if ($text!==''){
if ($answ!==null){
    switch ($lvl) {
        case 0:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Это морские хищные растения, усеянные сотнями полипов с щупальцами.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Это морские хищные растения, усеянные сотнями полипов с щупальцами.";
            }
        break;
        case 1:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Это морская звезда, которая пожирает живые кораллы";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Это морская звезда, которая пожирает живые кораллы";
            }        
        break;
        case 2:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Морское животное - вегетарианец";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Морское животное - вегетарианец";
            }       
        break;

        case 3:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            }       
        break;

        case 4:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            }       
        break;

        case 5:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            }       
        break;

        case 6:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            }       
        break;

        case 7:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            }       
        break;

        case 8:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. около 60 %";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. около 60 %";
            }       
        break;

        case 9:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            }       
        break;

        case 10:// Вопросов
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            }       
        break;

        case 11:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            }          
        break;

        case 12:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Это хищное морское животное.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Это хищное морское животное.";
            } 
        break;

        case 13:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. 100 км./час";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. 100 км./час";
            } 
        break;

        case 14:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Это активные биофильтраторы";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Это активные биофильтраторы";
            } 
        break;

        case 15:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. 300.000.000 икринок.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. 300.000.000 икринок.";
            } 
        break;

        case 16:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Это рыба";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Это рыба";
            } 
        break;

        case 17:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Гигантская тридакна,100-300 лет";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Гигантская тридакна,100-300 лет";
            } 
        break;

        case 18:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Это ядовитые морские животные , имеют щупальца и питаются планктоном";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Это ядовитые морские животные , имеют щупальца и питаются планктоном";
            } 
        break;

        case 19:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 20:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 21:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 22:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 23:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Медузы размножаются яйцами.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Медузы размножаются яйцами.";
            } 
        break;

        case 24:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Грибы размножаются спорами.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Грибы размножаются спорами.";
            } 
        break;

        case 25:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Яд выделяют стрекательные клетки";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Яд выделяют стрекательные клетки";
            } 
        break;

        case 26:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 27:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Вверх головой.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Вверх головой.";
            } 
        break;

        case 28:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 29:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 30:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 31:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Паук – членистоногое.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Паук – членистоногое.";
            } 
        break;

        case 32:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Тело акулы состоит из хрящей.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Тело акулы состоит из хрящей.";
            } 
        break;

        case 33:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 34:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 35:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 36:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 37:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 38:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 39:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 40:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 41:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Пчелы";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Пчелы";
            } 
        break;

        case 42:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 43:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 44:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 45:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Мотылек – это сборное название ночных бабочек";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Мотылек – это сборное название ночных бабочек";
            } 
        break;

        case 46:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Жук- бронзовка золотистая пахнет розами:)";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Жук- бронзовка золотистая пахнет розами:)";
            } 
        break;

        case 47:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 48:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Оса";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Оса";
            } 
        break;

        case 49:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 50:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 51:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 52:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 53:
             if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            }       
        break;

        case 54:
            if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;

        case 55:
            if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Сверчки во время сражений берегут усики.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Сверчки во время сражений берегут усики.";
            } 
        break;

        case 56:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 57:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 58:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 59:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 60:
           if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 61:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 62:
           if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Тело бабочки покрыто чешуйками";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Тело бабочки покрыто чешуйками";
            } 
        break;
        case 63:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 64:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 65:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Существует лягушка под названием пипа древесная лягушка , которая попискивает.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Существует лягушка под названием пипа древесная лягушка , которая попискивает.";
            } 
        break;
        case 66:
           if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 67:
           if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 68:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 69:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 70:
           if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 71:
           if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 72:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 73:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 74:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. в Техасе";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. в Техасе";
            } 
        break;
        case 75:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 76:
           if($answ==false){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО. Панда ест листья бамбука";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО. Панда ест листья бамбука";
            } 
        break;
        case 77:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 78:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
        case 79:
           if($answ==true){
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $right++; riddle_right($user_id,"set",$right);
                $msg = "Вы ответили ВЕРНО.";
            } else {
                $lvl++; riddle_lvl($user_id,"set",$lvl);
                $msg = "Вы ответили НЕВЕРНО.";
            } 
        break;
    }
    trueorlie($user_id,"");
} else $msg = "Непонятный овтет. Для ответа используйте:('да','правда','истина','нет','неправда','ложь'). Вопрос: {$ask}?";
}
else {$msg="Вопрос: {$ask}?";}
} else{
 $msg = "Поздравляю!! Вы ответили на все вопросы. Ваш результат {$right}/{$quest_num}";    
}
  $attachments = '';
  $keyboard = keybrd('',$user_id); 
  vkApi_messagesSend($user_id, $msg, $attachments,$keyboard);
}

function riddle_right($user_id,$mod,$value){
    $mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
    /* Проверка соединения */ 
    if (mysqli_connect_errno()) { 
        printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
        exit(); 
    } 
    if ($mod=="get"){
      if ($stmt = $mysqli->prepare("SELECT riddle_right FROM tests WHERE user_id={$user_id}")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
           $lvl = $col1;
        } 
        $stmt->close(); 
      }
    }
    if ($mod=="set"){
    $stmt = $mysqli->prepare("UPDATE tests SET riddle_right='{$value}' WHERE user_id=$user_id"); 
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
function riddle_lvl($user_id,$mod,$value){
    $mysqli = new mysqli('localhost', 'teyhd', '258000', 'remind');
    /* Проверка соединения */ 
    if (mysqli_connect_errno()) { 
        printf("Подключение невозможно: %s\n", mysqli_connect_error()); 
        exit(); 
    } 
    if ($mod=="get"){
      if ($stmt = $mysqli->prepare("SELECT riddle_lvl FROM tests WHERE user_id={$user_id}")) { 
        $stmt->execute(); 
        $stmt->bind_result($col1); 
        while ($stmt->fetch()) { 
           $lvl = $col1;
        } 
        $stmt->close(); 
      }
    }
    if ($mod=="set"){
    $stmt = $mysqli->prepare("UPDATE tests SET riddle_lvl='{$value}' WHERE user_id=$user_id"); 
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
