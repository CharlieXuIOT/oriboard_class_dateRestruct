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
  `permission` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`id`, `account`, `password`, `permission`) VALUES
(1, 'a', 'a', 1),
(2, '111', '111', 1),
(3, '123', '123', 1),
(4, '456', '456', 1),
(5, '', '$2y$10$yBn0kkEhsgdoo..SuNQ7vO6fNdQH4ZhLn2ndLqEiQzWo76pV0lA.a', 1),
(6, '789', '$2y$10$Xtf4q4.6IzKuaiJwzoBefulIz0i/r9gY9hjegHclKMp3klm.skdtC', 1),
(7, '147', '$2y$10$2ujZDnJxdmiXeRE2USBL0e6UPOhVXg3GplAZNBcIi96eBSGpvJI2S', 1),
(8, '555', '$2y$10$quLDlje/C8VwZ57rmUSJmedoson1r/vcZIM7B2q6ib/CM.SGt/SMa', 1),
(9, '987', '$2y$10$Vh4OvqBgZ/ndNU0LF2e0y.qO7xp/hfNk1kWubevvxMpl46xcNS1Jq', 1),
(10, '5566', '$2y$10$oEDq/FJD7jTC6MYHKQejkOMEfa.q2V6g1n/MzoPc..iKWEXWC0k4S', 1),
(11, '1234', '$2y$10$NNH3np6xhOS6V2lXwZXnb.dYI2obKafoOi00P.KPyG1CDogAh.LxW', 1),
(13, 'qwer', '$2y$10$gS0gg/T.6GszoxNrLvfy1ujs3gEnZYwwoIRSowOmncQkS25CCRwrW', 1),
(16, 'qwert', '$2y$10$tdpFreMN0z7f5rMdXq93TelV1nZ/zpm1kqpTXPuDbO5aLGFOpHHiq', 1),
(27, 'eee', '$2y$10$0Jw18x0J3Ueyqn91Yvah.uir4KpUY.SOOwJjXxnVEAP1CMuO.b4aW', 1),
(28, 'qaq', '$2y$10$Y5/jJ0JpNm6vQCVq1zow.egr5i0dbU.jtBWU7rqa7bBqtvgxYlLTi', 1);

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
(12, 6, 'OOOOOOO', '', '2019-11-13 07:50:39'),
(13, 6, 'AYAYA', '', '2019-11-13 08:01:10');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
