-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 13 2019 г., 03:33
-- Версия сервера: 10.1.38-MariaDB-0+deb9u1
-- Версия PHP: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `remind`
--

-- --------------------------------------------------------

--
-- Структура таблицы `anagramms`
--

CREATE TABLE `anagramms` (
  `user_id` int(11) NOT NULL,
  `1` text NOT NULL,
  `2` text NOT NULL,
  `3` text NOT NULL,
  `4` text NOT NULL,
  `5` text NOT NULL,
  `6` text NOT NULL,
  `7` text NOT NULL,
  `8` text NOT NULL,
  `9` text NOT NULL,
  `10` text NOT NULL,
  `11` text NOT NULL,
  `12` text NOT NULL,
  `13` text NOT NULL,
  `14` text NOT NULL,
  `15` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `anagramms`
--

INSERT INTO `anagramms` (`user_id`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`) VALUES
(120161867, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `commands`
--

CREATE TABLE `commands` (
  `id` int(11) NOT NULL,
  `input` text NOT NULL,
  `output` text NOT NULL,
  `command` text NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `commands`
--

INSERT INTO `commands` (`id`, `input`, `output`, `command`, `public`) VALUES
(0, 'прочел', '{$username}, отлично', 'read', 1),
(1, 'время', 'Ответ из функции', 'time', 0),
(3, 'включи свет', 'Свет включен', 'onlight', 1),
(4, 'погода', 'Ответ из функции', 'weather', 0),
(5, 'погода в Ульяновске', 'Ответ из функции', 'weather', 0),
(6, 'какая сегодня погода', 'Ответ из функции', 'weather', 0),
(16, 'тишина', 'Выключаю музыку', 'quiet', 1),
(19, 'мое расписание', 'Ответ из функции', 'timetable', 0),
(20, 'расписание', 'Ответ из функции', 'timetable', 0),
(21, 'сотри расписание', 'Расписание удалено', 'deltimetable', 1),
(22, 'удали расписание', 'Расписание удалено', 'deltimetable', 1),
(23, 'стробоскоп', 'Стробоскоп включен', 'strobe', 1),
(24, 'посоветуй фильм', 'Ответ из функции', 'film', 1),
(25, 'обнови', 'Страница успешно обновлена', 'pageupd', 1),
(26, 'фильм', 'Ответ из функции', 'film', 0),
(27, 'что посмотреть', 'Ответ из функции', 'film', 0),
(28, 'кофе', 'Ответ из функции', 'drink', 1),
(29, 'чай', 'Ответ из функции', 'drink', 1),
(30, 'хочу чай', 'Ответ из функции', 'drink', 1),
(31, 'хочу кофе', 'Ответ из функции', 'drink', 1),
(32, 'больше чая', 'Ответ из функции', 'moredrink', 1),
(33, 'больше кофе', 'Ответ из функции', 'moredrink', 1),
(34, 'еще чая', 'Ответ из функции', 'moredrink', 1),
(35, 'еще кофе', 'Ответ из функции', 'moredrink', 1),
(37, 'пословица', 'Ответ из функции', 'saying', 0),
(38, 'поговорку', 'Ответ из функции', 'saying', 0),
(39, 'светофильтр', 'Свет включен', 'lightfilter', 1),
(40, 'да будет свет', 'Свет включен', 'lightfilter', 1),
(41, 'темнота', 'Свет выключен', 'lightfilter', 1),
(42, 'тьма сгущается', 'Свет выключен', 'lightfilter', 1),
(43, 'привет', 'Привет, {$username}!', '', 1),
(44, 'бонджорно', 'Привет, {$username}!', '', 1),
(45, 'хай', 'Привет, {$username}!', '', 1),
(46, 'дарова', 'Привет, {$username}!', '', 1),
(47, 'здравия желаю', 'Привет, {$username}!', '', 1),
(48, 'хэллоу', 'Привет, {$username}!', '', 1),
(49, 'как дела', '{$username}, Если ты слышишь это, то все хорошо!', '', 1),
(50, 'владислав', 'Владислав - золотые руки из жопы!', '', 1),
(51, 'поговори со мной', '{$username}, Могу только рассказать погоду, для этого напиши или скажи мне: Погода. Полный список команд смотри в группе!', '', 1),
(52, 'кто ты', '{$username}, Я не знаю', '', 1),
(53, 'аве мне', 'АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}, АВЕ {$username}', '', 1),
(54, 'как меня зовут', 'Тебя зовут - {$username}!', '', 1),
(55, 'спишь', '{$username}, нет, я уже не сплю', '', 1),
(56, 'спасибо', '{$username}, всегда пожалуйста! &#10084;', '', 1),
(57, 'освободи', 'Ответ из функции', 'clearbd', 1),
(58, 'сотри', 'Все сообщения успешно стерты', 'clearscr', 1),
(59, 'очисти', 'Я стер сообщение', 'clearscr', 1),
(60, 'чпок', 'Воистину чпок', '', 1),
(61, 'серьезно', 'Да', '', 1),
(62, 'паремия', 'Ответ из функции', 'saying', 1),
(63, 'нет', 'Ну и что ты неткаешь', '', 1),
(65, 'спс', 'Влад, всегда пожалуйста! ❤', '', 1),
(66, '👅', '👅👅👅', '', 1),
(67, '❤❤❤', 'Я тоже тебя люблю. ❤❤❤', '', 1),
(68, '❤', '❤', '', 1),
(69, 'пошел нахуй', 'Сам иди', '', 1),
(71, 'скажи', 'Ответ из функции', 'sayforme', 1),
(72, 'скажи мне', 'Ответ из функции', 'sayforme', 1),
(73, 'зашифруй', 'Ответ из функции', 'encode', 1),
(74, 'декодируй', 'Введите выражение, которое нужно расшифровать', 'decode', 1),
(76, 'да', 'Манда', '', 1),
(78, 'сука', 'Сам ты сука', '', 1),
(79, 'как ты думаешь', 'Задай вопрос ответ на который будет \'да\' или \'нет\'', 'think', 1),
(80, 'спасибо большое', 'Благодаря вам я чувствую себя нужным и актуальным.\nза это спасибо вам', '0', 1),
(81, 'зачем', 'Так было лучше для вас, {$username}', '', 1),
(82, 'ку ку', 'Что такое?', '', 1),
(83, 'придумай фразу', 'Ответ из функции', 'own', 1),
(84, 'скажи хуйню', 'Ответ из функции', 'own', 1),
(85, 'поменяй раскладку', 'Ответ из функции', 'swtcer', 1),
(86, 'измени раскладку', 'Ответ из функции', 'swtcer', 1),
(87, 'виселица', 'Играем в висилицу. для выхода напишите: хватит', 'hang_game', 1),
(88, 'анаграмма', 'Ответ из функции', 'anag_game', 1),
(89, 'как', 'Как обычно', '', 1),
(90, 'начать', 'Бот с радостью подскажет вам: время,погоду,подскажет фильм \n\nДоступно на данный момент: привет, как? как дела? игра виселица ,спасибо ,как меня зовут? ,пословица ,поговорка ,поговори со мной ,кто ты ,аве мне ,паремия ,❤❤❤ ,скажи ,переведи язык текст ,зашифруй ,декодируй ,как ты думаешь ,зачем,придумай фразу ,поменяй раскладку \nПодробнее: https://vk.com/teyhdbot', '0', 1),
(91, 'тест', 'Ответ из функции', 'testme', 1),
(92, 'хочу тест', 'Ответ из функции', 'testme', 1),
(93, 'хочу обучать', 'Ответ из функции', 'want_learn', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `dialog`
--

CREATE TABLE `dialog` (
  `user_id` int(11) NOT NULL,
  `dial_type` text NOT NULL,
  `isadmin` int(11) DEFAULT '0',
  `addexp` text NOT NULL,
  `iscmd` text NOT NULL,
  `output` text NOT NULL,
  `nickname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dialog`
--

INSERT INTO `dialog` (`user_id`, `dial_type`, `isadmin`, `addexp`, `iscmd`, `output`, `nickname`) VALUES
(120161867, 'non', 2, 'обнови станицу', '', '', 'none'),
(237467639, 'non', 1, '🖕', '0', '0', 'Малая'),
(254088396, 'non', 0, '', '0', '0', 'none'),
(328108004, 'non', 0, '0', '0', '0', 'none');

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` text NOT NULL,
  `text` text NOT NULL,
  `event` tinytext NOT NULL,
  `active` int(11) NOT NULL,
  `music` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `user_id`, `time`, `text`, `event`, `active`, `music`) VALUES
(0, 120161867, '11:56', 'Сработало', 'event', 0, 'none'),
(1, 120161867, '11:45', 'уведомление ', 'event', 0, 'alarm'),
(2, 120161867, '14:49', 'привет ', 'event', 0, 'music'),
(3, 120161867, '19:30', 'првоерка трех ', 'event', 0, 'havana'),
(4, 120161867, '08:30', 'встань и иди ', 'event', 0, 'havana');

-- --------------------------------------------------------

--
-- Структура таблицы `hangman_bit`
--

CREATE TABLE `hangman_bit` (
  `user_id` int(11) NOT NULL,
  `1` int(11) NOT NULL DEFAULT '0',
  `2` int(11) NOT NULL DEFAULT '0',
  `3` int(11) NOT NULL DEFAULT '0',
  `4` int(11) NOT NULL DEFAULT '0',
  `5` int(11) NOT NULL DEFAULT '0',
  `6` int(11) NOT NULL DEFAULT '0',
  `7` int(11) NOT NULL DEFAULT '0',
  `8` int(11) NOT NULL DEFAULT '0',
  `9` int(11) NOT NULL DEFAULT '0',
  `10` int(11) NOT NULL DEFAULT '0',
  `11` int(11) NOT NULL DEFAULT '0',
  `12` int(11) NOT NULL DEFAULT '0',
  `13` int(11) NOT NULL DEFAULT '0',
  `14` int(11) NOT NULL DEFAULT '0',
  `15` int(11) NOT NULL DEFAULT '0',
  `16` int(11) NOT NULL DEFAULT '0',
  `17` int(11) NOT NULL DEFAULT '0',
  `18` int(11) NOT NULL DEFAULT '0',
  `19` int(11) NOT NULL DEFAULT '0',
  `20` int(11) NOT NULL DEFAULT '0',
  `life` int(11) NOT NULL DEFAULT '9'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `hangman_bit`
--

INSERT INTO `hangman_bit` (`user_id`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `13`, `14`, `15`, `16`, `17`, `18`, `19`, `20`, `life`) VALUES
(120161867, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4),
(237467639, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `progress`
--

CREATE TABLE `progress` (
  `user_id` int(11) NOT NULL,
  `hang_falls` int(11) NOT NULL DEFAULT '0',
  `ann_lvl_temp` int(11) NOT NULL DEFAULT '0',
  `ann_lvl` int(11) NOT NULL DEFAULT '0',
  `hangman_lvl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `progress`
--

INSERT INTO `progress` (`user_id`, `hang_falls`, `ann_lvl_temp`, `ann_lvl`, `hangman_lvl`) VALUES
(120161867, 1, 0, 3, 4),
(237467639, 1, 0, 0, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `remember`
--

CREATE TABLE `remember` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `remember`
--

INSERT INTO `remember` (`id`, `user_id`, `text`) VALUES
(0, 120161867, ' текст '),
(2, 120161867, 'п\nизменить создание аккаунта \nдобавить уровень загадок'),
(4, 120161867, 'изменить создание аккаунта \nдобавить уровень загадок'),
(6, 120161867, 'д _ о _ к о _ ы _ _ к _ ы й \nд _ о _ к о _ ы _ _ к _ ы й'),
(8, 120161867, 'христианин \n поняв \n вверх \n побережий \n 15|51 \n 35|53 \n 24|42 \n 23|32 \n 34|43 \n неровная \n млекопитающие \n 23|32 \n 45|54 \n 12|21 \n 345'),
(10, 120161867, 'аааааааааааааааааа'),
(12, 120161867, 'гороскоп'),
(14, 120161867, 'найди что изменилось'),
(16, 120161867, 'раньше не было значка, записывает голосовое сообщение'),
(18, 120161867, 'протокол №: 2833441 \n \nраздел аттестации: начальники, воспитатели, вожатые детских оздоровительных лагерей \n \nтестируемый: дьяконов владислав сергеевич \n \nместо работы: ооо \"дол \"волжанка\" (должность: вожатый) \n \nрезультат: 95% - (всего вопросов: 20 / правильных ответов: 19) \n \nсведения об оплате: бесплатно');

-- --------------------------------------------------------

--
-- Структура таблицы `say`
--

CREATE TABLE `say` (
  `id` int(11) NOT NULL,
  `string` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `say`
--

INSERT INTO `say` (`id`, `string`) VALUES
(0, 'Дела как в Ебланской области'),
(1, 'Не бери хуй стеклянный, жопу рассечёшь'),
(2, 'Чтоб в сухари не срать – можно подождать'),
(3, 'Нам татарам поебать: то рубашка длинная, то хуй с мотоциклом.'),
(4, 'Работа — хуй с гусиной шеей'),
(5, 'Родина ждёт героев, а нам поебать.'),
(8, 'Дела как у латыша — только хуй стоит, а голова не ссыт в борщ'),
(9, 'За неимением барыни ебут и пряники'),
(10, 'Хуй стоит и в борщ насрали'),
(11, 'Хороша палка – только хуй больше'),
(12, 'На бесптичье и в жопу насрёшь'),
(13, 'Ноги из говна не хуй, сто лет простят'),
(14, 'Душа как у латыша – на ней волки срать уехали'),
(15, 'В моменты когда истощенная от любви душа засыпает, просыпается мафия. Хоть их всего трое они очень мощны.Их способности настолько безграничны и импульсивны, что они без усилий способны полностью изменить личность.');

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE `tests` (
  `user_id` int(11) NOT NULL,
  `test_lvl` int(11) NOT NULL,
  `riddle_lvl` int(11) NOT NULL,
  `test_right` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tests`
--

INSERT INTO `tests` (`user_id`, `test_lvl`, `riddle_lvl`, `test_right`) VALUES
(120161867, 0, 0, 0),
(237467639, 15, 0, 14);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `anagramms`
--
ALTER TABLE `anagramms`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Индексы таблицы `commands`
--
ALTER TABLE `commands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `dialog`
--
ALTER TABLE `dialog`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Индексы таблицы `hangman_bit`
--
ALTER TABLE `hangman_bit`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Индексы таблицы `progress`
--
ALTER TABLE `progress`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Индексы таблицы `remember`
--
ALTER TABLE `remember`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `say`
--
ALTER TABLE `say`
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `tests`
--
ALTER TABLE `tests`
  ADD UNIQUE KEY `user_id` (`user_id`);

DELIMITER $$
--
-- События
--
CREATE DEFINER=`teyhd`@`%` EVENT `dialog_off` ON SCHEDULE EVERY 1 HOUR STARTS '2019-06-09 00:00:00' ENDS '2019-07-09 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE dialog SET dial_type='non' WHERE user_id like '%'$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
