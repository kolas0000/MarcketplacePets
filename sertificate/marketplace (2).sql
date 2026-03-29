-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.4:3306
-- Время создания: Мар 18 2026 г., 01:17
-- Версия сервера: 8.4.6
-- Версия PHP: 8.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `marketplace`
--

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE `requests` (
  `id_request` int NOT NULL,
  `user_specialist` int DEFAULT NULL,
  `user_client` int DEFAULT NULL,
  `description` text,
  `status_Request` int DEFAULT NULL,
  `date_request` datetime DEFAULT NULL,
  `type_service` int DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `Id_review` int NOT NULL,
  `description` text,
  `grade` int DEFAULT NULL,
  `id_request` int DEFAULT NULL,
  `data` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `Id_role` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`Id_role`, `name`, `description`) VALUES
(1, 'Клиент', NULL),
(2, 'Специалист', NULL),
(3, 'admin\r\n', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE `service` (
  `id_service` int NOT NULL,
  `name_service` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `service`
--

INSERT INTO `service` (`id_service`, `name_service`) VALUES
(1, 'груминг'),
(2, 'вакцинации'),
(3, 'чипирования');

-- --------------------------------------------------------

--
-- Структура таблицы `specialization`
--

CREATE TABLE `specialization` (
  `Id_specialization` int NOT NULL,
  `Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `specialization`
--

INSERT INTO `specialization` (`Id_specialization`, `Name`) VALUES
(1, 'Грумер'),
(2, 'ветеринар');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id_status` int NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id_status`, `name`) VALUES
(1, 'в работе'),
(2, 'отменена'),
(3, 'в подтверждение'),
(4, 'выполнена'),
(5, 'Новая');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_user` varchar(255) DEFAULT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Surname` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `specialization` int DEFAULT NULL,
  `experience` int DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_role` int DEFAULT NULL,
  `status_specialist` varchar(255) DEFAULT NULL,
  `Photo_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `email`, `password_user`, `Name`, `Surname`, `MiddleName`, `phone`, `address`, `specialization`, `experience`, `img`, `id_role`, `status_specialist`, `Photo_user`) VALUES
(9, 'admin@gmail.com', '$2y$10$LnuHZ.0WfgPlrJCzgmPIXey06PkWeXvh34g/DO2Q3sSBoiWii9g4i', 'kolas', NULL, NULL, '89874505212', NULL, NULL, NULL, NULL, 3, NULL, 'photo/anime-moon-landscape (1).jpg'),
(14, 'maksimovavika372@gmail.com', '$2y$12$ACKO/rVpN8jyI2Ya4PGxd.bPottT2a83UZUD0itl4jJFrbBE.lnrS', 'Вика', 'Максимова', 'Станиславовна', '89874770554', 'xcxzczxc', NULL, NULL, NULL, 1, NULL, 'photo/anime-moon-landscape (1).jpg'),
(15, 'maksimovavika372@gmail.com', '$2y$12$NbqlPYCHIvnhYvcEMKnu8emAWyJqGEfhjnR7LRWmQskMd8jagSXfe', 'Наташа', 'Кирилкина', 'кириллова', '89874770555', NULL, 2, 4, '../sertificate/db_books (1).sql', 2, 'Подтверждено', 'photo/photo_2025-12-11_22-06-41.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `fk_requests_status` (`status_Request`),
  ADD KEY `fk_requests_service` (`type_service`),
  ADD KEY `user_specialist` (`user_specialist`),
  ADD KEY `user_client` (`user_client`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`Id_review`),
  ADD KEY `id_request` (`id_request`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Id_role`);

--
-- Индексы таблицы `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- Индексы таблицы `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`Id_specialization`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`),
  ADD KEY `specialization` (`specialization`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id_request` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `Id_review` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `Id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `specialization`
--
ALTER TABLE `specialization`
  MODIFY `Id_specialization` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `fk_requests_service` FOREIGN KEY (`type_service`) REFERENCES `service` (`id_service`),
  ADD CONSTRAINT `fk_requests_status` FOREIGN KEY (`status_Request`) REFERENCES `status` (`id_status`),
  ADD CONSTRAINT `requests_ibfk_3` FOREIGN KEY (`status_Request`) REFERENCES `STATUS` (`id_status`),
  ADD CONSTRAINT `requests_ibfk_4` FOREIGN KEY (`user_specialist`) REFERENCES `users` (`id_user`),
  ADD CONSTRAINT `requests_ibfk_5` FOREIGN KEY (`user_client`) REFERENCES `users` (`id_user`);

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_request`) REFERENCES `requests` (`id_request`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `role` (`Id_role`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`specialization`) REFERENCES `specialization` (`Id_specialization`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
