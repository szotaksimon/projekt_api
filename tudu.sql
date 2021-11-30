-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Nov 30. 16:56
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `tudu`
--
CREATE DATABASE IF NOT EXISTS `tudu` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tudu`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_data`
--

CREATE TABLE `user_data` (
  `user_id` int(11) NOT NULL,
  `user_first` varchar(50) NOT NULL,
  `user_last` varchar(50) NOT NULL,
  `user_register` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `pass_reminder` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `user_data`
--

INSERT INTO `user_data` (`user_id`, `user_first`, `user_last`, `user_register`, `username`, `user_pass`, `pass_reminder`) VALUES
(1, 'Testfirstname', 'Testlastname', '2021-11-30', 'testusername', 'test1234', 'testreminder'),
(3, 'Post', 'Post', '2021-11-30', 'Postusername', 'Post1234', 'Postreminder'),
(4, 'Post', 'Post', '2021-11-30', 'Postusername', 'Post1234', 'Postreminder');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_todo`
--

CREATE TABLE `user_todo` (
  `user_id` int(11) NOT NULL,
  `user_todo` varchar(200) NOT NULL,
  `todo_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `user_todo`
--

INSERT INTO `user_todo` (`user_id`, `user_todo`, `todo_date`) VALUES
(1, 'Letesztelni a programot.', '2021-11-30 12:21:42'),
(2, 'Elso post', '2021-11-30 00:00:00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_xp`
--

CREATE TABLE `user_xp` (
  `user_id` int(11) NOT NULL,
  `user_exp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `user_xp`
--

INSERT INTO `user_xp` (`user_id`, `user_exp`) VALUES
(1, 223),
(2, 345),
(3, 111111);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`user_id`);

--
-- A tábla indexei `user_todo`
--
ALTER TABLE `user_todo`
  ADD PRIMARY KEY (`user_id`);

--
-- A tábla indexei `user_xp`
--
ALTER TABLE `user_xp`
  ADD PRIMARY KEY (`user_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `user_data`
--
ALTER TABLE `user_data`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `user_todo`
--
ALTER TABLE `user_todo`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `user_xp`
--
ALTER TABLE `user_xp`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
