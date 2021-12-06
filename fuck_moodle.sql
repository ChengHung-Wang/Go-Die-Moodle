-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021 年 12 月 06 日 12:44
-- 伺服器版本： 10.3.16-MariaDB
-- PHP 版本： 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `fuck_moodle`
--

-- --------------------------------------------------------

--
-- 資料表結構 `judges`
--

CREATE TABLE `judges` (
  `id` int(11) NOT NULL,
  `outside_judge_id` int(11) DEFAULT NULL COMMENT '測驗id',
  `course_name` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '課程名稱',
  `judge_name` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '測試名稱',
  `score` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '分數',
  `try_limit` int(11) DEFAULT NULL COMMENT '嘗試次數',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '建立日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `judge_id` int(11) DEFAULT NULL COMMENT '測驗id',
  `quiz_id` int(11) DEFAULT NULL COMMENT '題目id',
  `main` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '內容',
  `data_type` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '內容類型',
  `control_type` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '控制類型',
  `is_right` int(1) NOT NULL DEFAULT 0 COMMENT '是否正確',
  `tried` int(1) NOT NULL DEFAULT 0 COMMENT '嘗試過',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT '建立日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `judge_id` int(11) DEFAULT NULL,
  `question_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_type` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `success` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `try_logs`
--

CREATE TABLE `try_logs` (
  `id` int(11) NOT NULL,
  `path` int(11) DEFAULT NULL,
  `judge_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `event` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `judges`
--
ALTER TABLE `judges`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `judge_id` (`judge_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- 資料表索引 `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `judge_id` (`judge_id`);

--
-- 資料表索引 `try_logs`
--
ALTER TABLE `try_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `judge_id` (`judge_id`,`quiz_id`,`option_id`),
  ADD KEY `option_id` (`option_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `judges`
--
ALTER TABLE `judges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `try_logs`
--
ALTER TABLE `try_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`judge_id`) REFERENCES `judges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `options_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`judge_id`) REFERENCES `judges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `try_logs`
--
ALTER TABLE `try_logs`
  ADD CONSTRAINT `try_logs_ibfk_1` FOREIGN KEY (`judge_id`) REFERENCES `judges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `try_logs_ibfk_2` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
