-- phpMyAdmin SQL Dump
-- version 4.6.4deb1+deb.cihar.com~xenial.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 12 Lis 2016, 01:06
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
(143, 'jkhkj', '2016-11-11 18:00:08', 27, 43),
(144, 'mbj,njm', '2016-11-11 18:00:15', 27, 43),
(145, 'vvgnb', '2016-11-11 18:13:20', 27, 43),
(146, 'vxvcxvx', '2016-11-11 18:13:27', 27, 43),
(147, 'fesd', '2016-11-11 18:14:34', 26, 43),
(148, 'tylko zimniki niedogotowane jak zawsze..', '2016-11-11 20:32:16', 28, 45),
(149, 'z zupy  z z czego niby', '2016-11-11 20:43:56', 29, 45),
(150, 'zib zib', '2016-11-11 20:45:25', 29, 46),
(151, 'a nic noc ', '2016-11-11 23:31:32', 32, 47),
(152, 'halo jest tam kto', '2016-11-11 23:31:58', 32, 48);

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
  `send_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `messages`
--

INSERT INTO `messages` (`id`, `message`, `sender_id`, `reciver_id`, `is_readed`, `send_time`) VALUES
(13, 0x200d0a202020202020202020202057793f6c696a0d0a202020202020202020202069696a6a6a6b6a6b, 43, 44, 1, '2016-11-11 19:41:25'),
(14, 0x200d0a66736166646173612020202020202020202020, 43, 44, 1, '2016-11-11 21:10:55'),
(15, 0x6a7574726f207a6e6f777520646f206a6f62207a6120636f6f20207072727272727272727272720d0a0d0a2020202020202020202020, 45, 46, 0, '2016-11-11 21:41:21');

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
(25, '?wierknij co?\r\n      root', '2016-11-11 15:54:40', 43),
(26, '?wierknij co?\r\n      rootttt', '2016-11-11 15:54:45', 43),
(27, 'root2      ', '2016-11-11 17:28:15', 44),
(28, 'Zrobi?am dzi? zupe zjadaln? ^^\r\n      ', '2016-11-11 20:30:41', 45),
(29, 'a z czego ??\r\n      ', '2016-11-11 20:37:56', 46),
(30, 'ale mi sie nudzi   niechce mi sie \r\n\r\n\r\n      ', '2016-11-11 20:39:08', 46),
(31, 'cip cip lala lala\r\n      ', '2016-11-11 23:28:49', 47),
(32, 'co tam ', '2016-11-11 23:30:44', 48);

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
(43, '$2y$10$mmXAdsab4KEZ5sI0KgKgxePnHi20HyXCW0GGJALKSL4E1jczQvpxy', 'aaa', 'root@root.pl'),
(44, '$2y$10$8fmDZd2IEy5OlSbA.gNZAOxxVo8y9f0LUUGlz6XLvnxZtoeI235u2', '2', 'root2@root.pl'),
(45, '$2y$10$ZIBx5aBUoufOG/ferge/N.sfD9fxVhtyAQGuvlTDVdjRWQ0ZPBROC', 'zielono mi', 'cip@wp.pl'),
(46, '$2y$10$ANr.BIzncULW1368/IhvXO7huj5KNUSRy6vrfCDMa2wR/uq/TW6ei', 'klik', 'kuku@wp.pl'),
(47, '$2y$10$UbPUviK6qRm2Sq4hOLBqnuVRmx95fP.gK/PJFt5Bo7mOkS6mA.H.m', 'ciap', 'aga@wp.pl'),
(48, '$2y$10$.uSuAbeN.L1i8xHwY0x8aukkDCwoBzOBAoXngRCbmhFBCMZKz03g.', 'sasdssa', 'kip@wp.pl');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT dla tabeli `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT dla tabeli `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
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
