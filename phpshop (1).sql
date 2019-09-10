-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 10 2019 г., 10:05
-- Версия сервера: 5.5.58
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `phpshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`, `sort_order`, `status`) VALUES
(13, 'Суши', 1, 1),
(14, 'Роллы', 2, 1),
(15, 'Сеты', 3, 1),
(16, 'Горячие блюда', 4, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `price` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `availability` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT '0',
  `is_recommended` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `title`, `categoryId`, `code`, `count`, `price`, `image`, `availability`, `brand`, `description`, `is_new`, `is_recommended`, `status`) VALUES
(1, 'Филадельфия', 14, 0, 0, 150, 'http://sushi-store/uploads/623255-filadelfiya.jpg', 0, '', 'Лосось, авокадо, мазик, еще шото', 0, 0, 1),
(2, 'Калифорния', 14, 0, 0, 120, 'http://sushi-store/uploads/433194-5b53a8a291ba8.jpg', 0, '', 'Рис, кунжут, авокадо, еще шото', 0, 0, 1),
(3, 'Унаги ролл', 14, 0, 0, 95, 'http://sushi-store/uploads/434415-6Унаги-маки.jpg', 0, '', 'Нори, авокадо, икра тобико, и всё как бы', 0, 0, 1),
(4, 'Филадельфия с угрём', 14, 0, 0, 170, 'http://sushi-store/uploads/48816-179a1e_61128fb87f2b401099076b63701fa4b7-mv2.jpg', 0, '', 'Угорь, лосось, рис, авокадо, японский майонез', 0, 0, 1),
(5, 'Аляска', 14, 0, 0, 125, 'http://sushi-store/uploads/553643-813720574.jpg', 0, '', 'Тобико, рис, авокадо, кунжут, нори, японский майонез', 0, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_comment` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `products` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_order`
--

INSERT INTO `product_order` (`id`, `user_name`, `user_phone`, `user_comment`, `user_id`, `date`, `products`, `status`) VALUES
(45, 'fsdfsd', '1', '123123123', 4, '2015-05-14 09:54:45', '{\"1\":1,\"2\":1,\"3\":2}', 3),
(46, 'САША1', 'g3424242342', '', 4, '2015-05-18 15:34:42', '{\"44\":3,\"43\":3}', 1),
(47, '1', '2', '3', 4, '2018-07-03 06:16:06', '5', 1),
(48, 'Полина', '3196461', 'Закказ!', 1, '2018-07-03 06:18:01', '{\"45\":2}', 1),
(49, 'Полина', '3196461', 'Закказ!', 1, '2018-07-03 06:20:10', '{\"45\":2}', 1),
(50, 'Полина', '+380730262720', '1245', 1, '2018-07-03 06:20:25', '{\"34\":4}', 1),
(51, 'Полина', '+380730262720', '124', 1, '2018-07-03 06:21:06', '{\"45\":2,\"44\":2}', 1),
(52, 'Полина', '+380730262720', '513', 1, '2018-07-03 06:22:05', '{\"45\":2,\"44\":1,\"43\":2}', 1),
(53, 'Полина', '1', '123', 1, '2018-07-03 06:23:09', '{\"45\":2,\"44\":3}', 1),
(54, 'Полина', '+380730262720', '12521', 1, '2018-07-03 06:24:02', '{\"45\":2,\"44\":2,\"40\":1,\"41\":1,\"42\":1}', 1),
(55, 'Виктор', '+380730262720', '41251', 0, '2018-07-03 06:24:22', '{\"45\":1,\"44\":1,\"43\":1}', 1),
(56, 'Виктор', '+380730262720', 'Вивіфафп', 0, '2018-07-03 06:25:49', '{\"45\":1,\"44\":2,\"43\":3,\"41\":2}', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Виктор Билецкий', 'vb@mail.ru', '123456', ''),
(2, 'Алина', 'alina@mail.ru', '123456', ''),
(3, 'Артем', 'artem@mail.ru', '4f411ddffa26aea932f5e7a1bffbe1836541298d392b9fbff6d0815554c14d89', ''),
(4, 'Виктор Билецкий', 'vb228@mail.ru', '590ce2be06709ef25841bb26167d9c23a2e1b04c85cc76a9d4768f1a11f00922', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
