-- phpMyAdmin SQL Dump
-- version 4.6.4deb1+deb.cihar.com~xenial.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 21 Lis 2016, 13:33
-- Wersja serwera: 5.7.16-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `twitter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comm` varchar(40) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `comm_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tweet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `comm`, `comm_date`, `tweet_id`, `user_id`) VALUES
(149, 'z zupy  z z czego niby', '2016-11-11 20:43:56', 29, 45),
(150, 'zib zib', '2016-11-11 20:45:25', 29, 46),
(151, 'a nic noc ', '2016-11-11 23:31:32', 32, 47),
(152, 'halo jest tam kto', '2016-11-11 23:31:58', 32, 48),
(153, 'sfsdxf', '2016-11-15 07:48:39', 37, 50),
(154, 'sxgzcxdfcv', '2016-11-15 07:48:49', 38, 50),
(155, 'cxc', '2016-11-15 07:50:12', 39, 50),
(156, 'gcvn', '2016-11-15 07:50:49', 42, 50),
(157, 'ffsdfsdfds', '2016-11-15 07:53:44', 42, 50),
(158, 'ffsdfsdfds', '2016-11-15 07:53:48', 42, 50),
(159, 'hrtfdsyhgrfd', '2016-11-15 07:53:55', 43, 50),
(160, 'asdasfas', '2016-11-15 07:54:51', 42, 50),
(161, 'asdasfas', '2016-11-15 07:54:57', 42, 50),
(162, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2016-11-15 07:55:21', 45, 50),
(163, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2016-11-15 07:55:30', 45, 50),
(164, 'asd', '2016-11-15 07:58:23', 42, 50),
(165, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2016-11-15 07:58:32', 48, 50),
(166, 'asddsaafsasa', '2016-11-15 08:00:30', 52, 50),
(180, 'kljkl', '2016-11-15 19:21:43', 65, 50),
(181, 'kljkl', '2016-11-15 19:22:48', 65, 50),
(182, 'kljkl', '2016-11-15 19:23:41', 65, 50),
(183, ',mnjk', '2016-11-15 19:24:13', 75, 50),
(184, ',mnjk', '2016-11-15 19:24:19', 75, 50),
(185, 'ioiuiujkjlikjk', '2016-11-15 19:31:24', 77, 50),
(186, 'l,nlkjlk,', '2016-11-15 19:34:18', 78, 50),
(187, 'fsdf', '2016-11-15 19:36:09', 79, 50),
(188, 'resr', '2016-11-15 19:40:41', 81, 50),
(189, 'resr', '2016-11-15 19:42:45', 81, 50),
(190, 'asdew', '2016-11-15 19:42:54', 82, 50),
(191, 'asdew', '2016-11-15 19:44:14', 82, 50),
(192, 'xdfxgdf', '2016-11-15 19:44:21', 83, 50),
(193, 'trdsrtesfd', '2016-11-15 19:44:27', 83, 50);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` blob NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciver_id` int(11) NOT NULL,
  `is_readed` int(11) NOT NULL DEFAULT '0',
  `send_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `message`, `sender_id`, `reciver_id`, `is_readed`, `send_time`) VALUES
(15, 0x6a7574726f207a6e6f777520646f206a6f62207a6120636f6f20207072727272727272727272720d0a0d0a2020202020202020202020, 45, 46, 0, '2016-11-11 20:41:21'),
(16, 0x200d0a6b6664736c6b7a782e6d202020202020202020202057793f6c696a0d0a2020202020202020202020, 50, 46, 0, '2016-11-15 18:32:10');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `tweet` varchar(160) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `tweet_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `tweets`
--

INSERT INTO `tweets` (`id`, `tweet`, `tweet_date`, `user_id`) VALUES
(27, 'root2      ', '2016-11-11 17:28:15', 44),
(29, 'a z czego ??\r\n      ', '2016-11-11 20:37:56', 46),
(31, 'cip cip lala lala\r\n      ', '2016-11-11 23:28:49', 47),
(32, 'co tam ', '2016-11-11 23:30:44', 48),
(35, '?wierknij co?\r\n      ', '2016-11-15 07:43:53', 50),
(36, '?wierknij co?\r\n      ', '2016-11-15 07:43:57', 50),
(37, '?wierknij co?\r\n      ', '2016-11-15 07:44:00', 50),
(38, '?wierknij co?\r\n      ', '2016-11-15 07:48:34', 50),
(39, '?wierknij co?\r\n      ', '2016-11-15 07:48:45', 50),
(40, '?wierknij co?\r\n      ', '2016-11-15 07:48:59', 50),
(41, '?wierknij co?\r\n      ', '2016-11-15 07:49:53', 50),
(42, '?wierknij co?\r\n      ', '2016-11-15 07:50:06', 50),
(43, '?wierknij co?\r\n      ', '2016-11-15 07:50:30', 50),
(44, '?wierknij co?\r\n      ', '2016-11-15 07:53:50', 50),
(45, '?wierknij co?\r\n      ', '2016-11-15 07:55:01', 50),
(46, '?wierknij co?\r\n      ', '2016-11-15 07:55:04', 50),
(47, '?wierknij co?\r\n      ', '2016-11-15 07:55:23', 50),
(48, '?wierknij co?\r\n      ', '2016-11-15 07:55:26', 50),
(49, '?wierknij co?\r\n      ', '2016-11-15 07:58:26', 50),
(50, '?wierknij co?\r\n      ', '2016-11-15 07:58:58', 50),
(51, '?wierknij co?\r\n      ', '2016-11-15 07:59:17', 50),
(52, '?wierknij co?\r\n      ', '2016-11-15 07:59:25', 50),
(53, '?wierknij co?\r\n      ', '2016-11-15 07:59:31', 50),
(54, '?wierknij co?\r\n      ', '2016-11-15 18:28:12', 50),
(55, '?wierknij co?\r\n      ', '2016-11-15 18:32:02', 50),
(56, '?wierknij co?\r\n      ', '2016-11-15 18:32:10', 50),
(60, '?wierknij co?\r\n      ', '2016-11-15 18:48:20', 50),
(61, '?wierknij co?\r\n      ', '2016-11-15 18:49:17', 50),
(62, '?wierknij co?\r\n      ', '2016-11-15 18:51:00', 50),
(63, '?wierknij co?\r\n      ', '2016-11-15 18:51:17', 50),
(64, '?wierknij co?\r\n      ', '2016-11-15 18:51:39', 50),
(65, '?wierknij co?\r\n      ', '2016-11-15 18:53:26', 50),
(75, '?wierknij co?\r\n      ', '2016-11-15 19:21:37', 50),
(76, '?wierknij co?\r\n      ', '2016-11-15 19:24:06', 50),
(77, 'klkj,kµ co?\r\n      ', '2016-11-15 19:30:44', 50),
(78, '?wierknij co?\r\n      ', '2016-11-15 19:30:57', 50),
(79, '?wierknij co?\r\n      ', '2016-11-15 19:34:14', 50),
(80, '?wierknij co?\r\n      ', '2016-11-15 19:35:58', 50),
(81, '532453433534', '2016-11-15 19:40:32', 50),
(82, '?wierknij co?\r\n      ', '2016-11-15 19:40:37', 50),
(83, '      ', '2016-11-15 19:42:50', 50);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `hashedPassword` varchar(60) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `hashedPassword`, `username`, `email`) VALUES
(7, '$2y$10$M/BFcbpobHR9piouaXEcmOhJRsw23H6xFIU3.7zxVYK4WUyDOt0oO', 'kowalski', 'mailtset'),
(10, '$2y$10$lZUoHQWrW.3JUt29HTl7D.F8qN.F/Z9xyPrkGXcQXJRV1pRTMmcI6', 'kowalski', 'mailtset2'),
(11, '$2y$10$jOKMhuWcAHUKtT3uha3ksurWdjQf48qHCgoaZAgd7IZzTX10JZHOS', 'name', 'mail'),
(13, '$2y$10$VaoLtCrt4AE3/Ae7./gQPOnHL.qjG5/ew2INM.si9H5Na3zQnjcwq', 'name', 'maillsk'),
(14, '$2y$10$8nsfOA5BNcJip7390JBs7e8zX2eUKZuzOPRF8DPqRi92qgdpjKDl2', 'test', 'testowy amil'),
(16, '$2y$10$b7WkNS..YZgZmqDSMxAtbeVprhmmoUsjO8tezgrb9XxO/8cFM6scK', 'testowy', 'mailowy'),
(17, '$2y$10$d6ERoipAyqAdp2JNB.bmC.X9/qrW7OZVPai11MhdGCxnaZyJiior6', 'teste', 'mail1'),
(18, '$2y$10$oxcAcTXoE4.jNk4OPdS1OOBInOkpHC8xPXdme.6yyeyxmAHt.xB8i', 'sdfdsz', 'dfszfdsz'),
(23, '$2y$10$KSc2aGHquTnPuKD4BMfWC.88UcUQt.lUIc6wJdsOIUDY1cYGs.2ZS', 'lkjkl,jlk', 'lkjlkjjlmk'),
(24, '$2y$10$SmIuVEGHuovbY3OBxg1gHOOqcpPVOIHDSGryNSpBaoT8UTWHip39K', 'iqejsdiorlf', 'oresodiirfl'),
(25, '$2y$10$W9azVYyMkFwTUhC9LMkKOuKNMwZWxFNk95loIgjb9zdUpcg./K9OS', 'kjwesjkfd', 'lrjsdkfl'),
(31, '', 'erstf', 'rookllk'),
(32, '$2y$10$iLspWeTdW1/6kSlD6VBCkepo1UFSmIhfmJs.iHwX3oZqKF1CeYyje', 'mario', 'auc@cipcip.pl'),
(35, '$2y$10$EISHg6GInaxxFRoRzRG7nuYzCA.ox2K7YTTyTCeb3kfdy4Zw3gz4.', '', ''),
(42, '$2y$10$j3/ZWVT/LsrnSTh6AToMceEs9rUm51fWIpj.xLclbTiNv9BWNXERO', 'aaa', 'root'),
(44, '$2y$10$8fmDZd2IEy5OlSbA.gNZAOxxVo8y9f0LUUGlz6XLvnxZtoeI235u2', '2', 'root2@root.pl'),
(45, '$2y$10$ZIBx5aBUoufOG/ferge/N.sfD9fxVhtyAQGuvlTDVdjRWQ0ZPBROC', 'zielono mi', 'cip@wp.pl'),
(46, '$2y$10$ANr.BIzncULW1368/IhvXO7huj5KNUSRy6vrfCDMa2wR/uq/TW6ei', 'klik', 'kuku@wp.pl'),
(47, '$2y$10$UbPUviK6qRm2Sq4hOLBqnuVRmx95fP.gK/PJFt5Bo7mOkS6mA.H.m', 'ciap', 'aga@wp.pl'),
(48, '$2y$10$.uSuAbeN.L1i8xHwY0x8aukkDCwoBzOBAoXngRCbmhFBCMZKz03g.', 'sasdssa', 'kip@wp.pl'),
(49, '$2y$10$gnAbXp6I63DVIEXq4FY8o.yOTg3DQ4LnGkwDsbLZDVBywnA3QVyeO', 'sdx', 'root@roo.root'),
(50, '$2y$10$Mua70lagZVPcc9gwufCh8eHJ3Uj42vUFxrz86mRwh9rQ6XwnfxXga', 'AAA', 'root@root.pl');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_ibfk_1` (`tweet_id`),
  ADD KEY `comments_ibfk_2` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_ibfk_1` (`sender_id`),
  ADD KEY `messages_ibfk_2` (`reciver_id`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tweets_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;
--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT dla tabeli `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`reciver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `tweets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
