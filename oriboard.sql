-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.8-MariaDB
-- PHP 版本： 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `oriboard`
--

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `account` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` int(2) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`id`, `account`, `password`, `permission`, `image`) VALUES
(1, 'a', 'a', 1, 'uploads/e4f330db58dbb823f8ce940e19f3ca0f.jpg'),
(2, '111', '111', 1, ''),
(3, '123', '123', 1, '123'),
(4, '456', '456', 1, ''),
(5, '', '$2y$10$yBn0kkEhsgdoo..SuNQ7vO6fNdQH4ZhLn2ndLqEiQzWo76pV0lA.a', 1, ''),
(6, '789', '$2y$10$Xtf4q4.6IzKuaiJwzoBefulIz0i/r9gY9hjegHclKMp3klm.skdtC', 1, ''),
(7, '147', '$2y$10$2ujZDnJxdmiXeRE2USBL0e6UPOhVXg3GplAZNBcIi96eBSGpvJI2S', 2, '../uploads/37883547b304e0101eed37600692097c.png'),
(8, '555', '$2y$10$quLDlje/C8VwZ57rmUSJmedoson1r/vcZIM7B2q6ib/CM.SGt/SMa', 1, ''),
(9, '987', '$2y$10$Vh4OvqBgZ/ndNU0LF2e0y.qO7xp/hfNk1kWubevvxMpl46xcNS1Jq', 1, ''),
(10, '5566', '$2y$10$oEDq/FJD7jTC6MYHKQejkOMEfa.q2V6g1n/MzoPc..iKWEXWC0k4S', 1, ''),
(11, '1234', '$2y$10$NNH3np6xhOS6V2lXwZXnb.dYI2obKafoOi00P.KPyG1CDogAh.LxW', 1, ''),
(13, 'qwer', '$2y$10$gS0gg/T.6GszoxNrLvfy1ujs3gEnZYwwoIRSowOmncQkS25CCRwrW', 1, ''),
(16, 'qwert', '$2y$10$tdpFreMN0z7f5rMdXq93TelV1nZ/zpm1kqpTXPuDbO5aLGFOpHHiq', 1, ''),
(27, 'eee', '$2y$10$0Jw18x0J3Ueyqn91Yvah.uir4KpUY.SOOwJjXxnVEAP1CMuO.b4aW', 1, ''),
(28, 'qaq', '$2y$10$Y5/jJ0JpNm6vQCVq1zow.egr5i0dbU.jtBWU7rqa7bBqtvgxYlLTi', 1, ''),
(30, '566', '$2y$10$I8U.1XApOsHa62z9slx.UOy4SwTMIuS78lHfbBDKRdLQF4TLhRYAu', 1, ''),
(32, 'no1', '$2y$10$efwDAvyXlSQeIvVdFI73kODEH0aJiHc.b3updKxlUDA3fWkv2IqkW', 1, ''),
(33, 'qqq', '$2y$10$ayxJythli/gfdIl2uSWKEeJQSDZA2sOVNBToq0R7vLL0f/DIvkTT.', 2, ''),
(34, 'aaa', '$2y$10$hxYvx5MIKSlGajnG3dY7Rub.v3FAfg2k3uMH7xE7m7pHCF0cYisjq', 1, '');

-- --------------------------------------------------------

--
-- 資料表結構 `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `post`
--

INSERT INTO `post` (`id`, `member_id`, `title`, `content`, `post_time`) VALUES
(1, 6, '789sayhello', '', '2019-11-12 05:55:13'),
(2, 7, 'modifytest', '', '2019-11-12 05:55:13'),
(3, 8, 'hiii', '', '2019-11-12 05:55:13'),
(5, 6, '1', '1', '2019-11-13 07:14:23'),
(9, 6, '耶耶耶', '', '2019-11-13 07:31:16'),
(11, 6, 'YAYAYA', '', '2019-11-13 07:45:36'),
(13, 6, 'AYAYA', '', '2019-11-13 08:01:10'),
(21, 7, '1\n1', '', '2019-11-13 09:48:48'),
(22, 7, '1                                       1', '', '2019-11-13 09:56:35'),
(23, 7, '1\n1', '', '2019-11-13 09:59:46'),
(26, 32, 'no1no1no1no1no1no1111234', '', '2019-11-14 07:07:11'),
(33, 33, 'qqww', '', '2019-11-15 06:02:25'),
(34, 34, '123\n1235\n12354\n', '', '2019-11-15 06:46:16'),
(35, 7, '<h2 style=\"color:red\">123</h2>', '', '2019-11-15 09:23:21');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account` (`account`);

--
-- 資料表索引 `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
