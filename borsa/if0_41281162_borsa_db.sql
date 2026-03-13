-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: sql308.infinityfree.com
-- Üretim Zamanı: 06 Mar 2026, 01:42:54
-- Sunucu sürümü: 11.4.10-MariaDB
-- PHP Sürümü: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `if0_41281162_borsa_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `symbol` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `record_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `stocks`
--

INSERT INTO `stocks` (`id`, `symbol`, `price`, `record_date`, `created_at`) VALUES
(3, 'Garanti BBVA', '143.43', '2026-03-05', '2026-03-05 08:40:47'),
(2, 'Akbank', '156.63', '2026-03-05', '2026-03-05 08:39:14'),
(4, 'Yapı Kredi', '37.60', '2026-03-05', '2026-03-05 08:45:35'),
(5, 'Aselsan', '290.75', '2026-03-05', '2026-03-05 08:49:33'),
(7, 'VakıfBank', '36.06', '2026-03-05', '2026-03-05 08:51:23'),
(8, 'QNB', '266.00', '2026-03-05', '2026-03-05 08:52:14'),
(15, 'Ziraat Bankası', '26.16', '2026-03-05', '2026-03-05 09:16:25'),
(12, 'İş Bankası', '18.15', '2026-03-05', '2026-03-05 08:58:05'),
(13, 'Şeker Bank', '10.67', '2026-03-05', '2026-03-05 09:04:39'),
(14, 'Deniz Bank', '20.88', '2026-03-05', '2026-03-05 09:12:10');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
