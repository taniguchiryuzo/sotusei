-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-05-27 14:00:19
-- サーバのバージョン： 10.4.24-MariaDB
-- PHP のバージョン: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `sotusei`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `recipi_test`
--

CREATE TABLE `recipi_test` (
  `id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `Introduction` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `material` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `how` varchar(128) COLLATE utf8mb4_bin NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `recipi_test`
--

INSERT INTO `recipi_test` (`id`, `title`, `Introduction`, `material`, `how`, `created_at`, `updated_at`) VALUES
(1, 'ミキサー食', '胃ろうからも口からも食べることが出来る', 'お肉やお野菜', '最後にブレンダーでミキサーをかける', '2022-05-24 21:18:58', '2022-05-24 21:18:58'),
(2, 'プリン', 'プリンの作り方', '卵', '混ぜて焼く', '2022-05-24 21:50:35', '2022-05-24 21:50:35'),
(3, '野菜スープ', 'コンソメキューブを使った料理', 'コンソメ　玉ねぎ　ベーコン　きのこ', '炒めて煮る', '2022-05-24 22:07:55', '2022-05-24 22:07:55'),
(4, '肉じゃが', '肉じゃがをミキサーにかける', 'ジャガイモ　肉', '煮てミキサー', '2022-05-24 22:29:18', '2022-05-24 22:29:18');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `recipi_test`
--
ALTER TABLE `recipi_test`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `recipi_test`
--
ALTER TABLE `recipi_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
