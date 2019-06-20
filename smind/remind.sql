-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Мар 09 2019 г., 22:48
-- Версия сервера: 10.1.37-MariaDB-0+deb9u1
-- Версия PHP: 7.0.33-0+deb9u2

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

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
