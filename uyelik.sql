-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 Eki 2023, 22:57:22
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `uyelik`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `parola` varchar(400) NOT NULL,
  `kayit_tarihi` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `kullanici_adi`, `email`, `parola`, `kayit_tarihi`) VALUES
(7, 'Ahmet1234', 'dsadasds@adsadas.com', '$2y$10$6qc3L5BSbGQzmNJkATwU7eFER9ytR9wnT2/9MmMkD49zra3JJB9gu', '2023-09-30 02:32:45'),
(8, 'durdur', 'asdadas@asdsadsa.com', '$2y$10$SmqC0FRaUqzBHPFGGp4x.ur9inLb18I1haWFr2g/QDprNi0Kej3/u', '2023-10-01 17:44:04'),
(9, 'nil', 'nilakcay7@gmail.com', '$2y$10$QH.rqp9XSiFqNfCBvsrTauzhVtRFNHrkCFqz14uWOUTQbBMptFpFa', '2023-10-01 20:50:23'),
(10, 'JJLK', 'GFYYT@VHJHH.COM', '$2y$10$Lx8vPL/pSueBg8sUrMGgNu2Jhz/Y/cNgrd7cEn5dzCYenwcKSDEn2', '2023-10-01 22:03:52'),
(11, 'metehan', 'metegulduren@outlook.com', '$2y$10$XUu5UXfhq4ncwpbvPvAkFeKG3thdUNl0ZDWT8wESJyUv7cmIO4zCO', '2023-10-01 23:29:27');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `todolar`
--

CREATE TABLE `todolar` (
  `id` int(11) NOT NULL,
  `kullanici_adi` varchar(50) NOT NULL,
  `baslik` varchar(400) NOT NULL,
  `icerik` text NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `todolar`
--

INSERT INTO `todolar` (`id`, `kullanici_adi`, `baslik`, `icerik`, `tarih`) VALUES
(178, 'metehan', '', 'dss', '2023-10-01 20:51:12'),
(179, 'metehan', '', 'aa', '2023-10-01 20:52:14');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici_adi` (`kullanici_adi`);

--
-- Tablo için indeksler `todolar`
--
ALTER TABLE `todolar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `todolar`
--
ALTER TABLE `todolar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
