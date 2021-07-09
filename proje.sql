-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 24 May 2021, 23:57:09
-- Sunucu sürümü: 10.4.14-MariaDB
-- PHP Sürümü: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `proje`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `alt_kategori`
--

CREATE TABLE `alt_kategori` (
  `kategori_alt_id` int(11) NOT NULL,
  `kategori_alt_adi` varchar(2000) NOT NULL,
  `kategori_ust_id` int(11) NOT NULL,
  `kategori_alt_ekleyen` varchar(300) NOT NULL,
  `tarih_alt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `alt_kategori`
--

INSERT INTO `alt_kategori` (`kategori_alt_id`, `kategori_alt_adi`, `kategori_ust_id`, `kategori_alt_ekleyen`, `tarih_alt`) VALUES
(1, 'Cilt Maskeleri', 5, 'shnbusra', '2021-05-05 01:20:10'),
(2, 'Vitaminler', 5, 'shnbusra', '2021-05-05 01:20:10'),
(3, 'Vücut Losyonları', 5, 'shnbusra', '2021-05-05 01:20:10'),
(4, 'Bakım Kremleri', 5, 'shnbusra', '2021-05-05 01:20:10'),
(5, 'Manikür Ürünleri', 5, 'shnbusra', '2021-05-05 01:20:10'),
(6, 'Pedikür Ürünleri', 5, 'shnbusra', '2021-05-05 01:20:10'),
(7, 'Makyaj Mazemleri', 5, 'shnbusra', '2021-05-05 01:20:10'),
(17, 'Tıraş Losyonları ', 6, 'shnbusra', '2021-05-14 00:44:35'),
(18, 'Set', 6, 'shnbusra', '2021-05-14 01:10:50'),
(19, 'Vücut Losyonları', 6, 'shnbusra', '2021-05-18 15:42:43'),
(20, 'Bakım Kremleri', 6, 'shnbusra', '2021-05-18 15:42:59'),
(21, 'Deneme1', 6, 'shnbusra', '2021-05-18 15:43:35'),
(22, 'Etek', 6, 'shnbusra', '2021-05-18 15:43:43');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(1) NOT NULL,
  `site_url` varchar(1500) NOT NULL,
  `admin_logo` varchar(2000) NOT NULL,
  `site_logo` varchar(2000) NOT NULL,
  `site_ikon` varchar(2000) NOT NULL,
  `site_baslik` varchar(75) NOT NULL,
  `site_aciklama` text NOT NULL,
  `site_anahtarkelimeler` varchar(1500) NOT NULL,
  `site_durum` varchar(1) NOT NULL,
  `site_tema` varchar(20) NOT NULL,
  `site_login` varchar(2000) NOT NULL,
  `site_iletisimno` varchar(15) NOT NULL,
  `site_eposta` varchar(100) NOT NULL,
  `site_instagram` text NOT NULL,
  `site_twitter` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_url`, `admin_logo`, `site_logo`, `site_ikon`, `site_baslik`, `site_aciklama`, `site_anahtarkelimeler`, `site_durum`, `site_tema`, `site_login`, `site_iletisimno`, `site_eposta`, `site_instagram`, `site_twitter`) VALUES
(1, 'http://localhost/proje', 'admin_16089b455972ba.png', '', '', 'Pharmacy Shopping', 'Sağlık', 'E-Ticaret, Sağlık', '1', 'default', '', '0212 688 20 28', 'shnbusra270@gmail.com', 'https://www.instagram.com/shn_busraa/', 'https://twitter.com/busrashn52');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sistemkayitlari`
--

CREATE TABLE `sistemkayitlari` (
  `kayit_id` int(11) NOT NULL,
  `aciklama` varchar(3000) NOT NULL,
  `yapilanislem` varchar(1000) NOT NULL,
  `uye_id` varchar(1000) NOT NULL,
  `tarih` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sistemkayitlari`
--

INSERT INTO `sistemkayitlari` (`kayit_id`, `aciklama`, `yapilanislem`, `uye_id`, `tarih`) VALUES
(1, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:33:03'),
(2, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:33:16'),
(3, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:54:51'),
(4, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:54:54'),
(5, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:54:57'),
(6, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:00'),
(7, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:02'),
(8, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:05'),
(9, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:07'),
(10, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:10'),
(11, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:13'),
(12, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:15'),
(13, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:17'),
(14, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:19'),
(15, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:22'),
(16, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:24'),
(17, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:27'),
(18, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:29'),
(19, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:31'),
(20, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-04 23:55:33'),
(21, 'irem adında yeni bir kayıt oluşturuldu.', 'Kayıt Eklendi', '1', '2021-04-10 23:16:39'),
(22, 'meryem adında yeni bir kayıt oluşturuldu.', 'Kayıt Eklendi', '1', '2021-04-10 23:20:32'),
(23, 'cem adında yeni bir kayıt oluşturuldu.', 'Kayıt Eklendi', '1', '2021-04-10 23:22:51'),
(24, 'safak adında yeni bir kayıt oluşturuldu.', 'Kayıt Eklendi', '1', '2021-04-10 23:33:59'),
(25, 'shnbusra adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-11 00:44:50'),
(26, 'shnbusra adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-11 00:46:46'),
(27, 'shnbusra adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-11 00:50:51'),
(28, 'shnbusra adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-11 00:57:00'),
(29, 'safak adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-11 01:30:24'),
(30, 'safak adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-11 01:36:23'),
(31, 'safak adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-11 01:36:34'),
(32, 'meryem adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-11 01:37:11'),
(33, 'irem adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-11 01:40:02'),
(34, 'meryem adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-11 01:40:16'),
(35, 'safak adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-11 01:40:38'),
(36, 'barış adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-11 01:43:52'),
(37, 'lilyakaren adında yeni bir kayıt oluşturuldu.', 'Kayıt Eklendi', '1', '2021-04-11 01:55:36'),
(38, 'lilyakaren kullanıcının kaydı silindi. ', 'Kayıt Silindi', '12', '2021-04-11 01:57:04'),
(39, 'lilyakaren kullanıcının kaydı silindi. ', 'Kayıt Silindi', '12', '2021-04-11 01:57:04'),
(40, 'lilyak adında yeni bir kayıt oluşturuldu.', 'Kayıt Eklendi', '1', '2021-04-11 01:57:48'),
(41, 'lilyak kullanıcının kaydı silindi. ', 'Kayıt Silindi', '13', '2021-04-11 01:59:32'),
(42, 'lilyak kullanıcının kaydı silindi. ', 'Kayıt Silindi', '13', '2021-04-11 01:59:32'),
(43, 'lilyak adında yeni bir kayıt oluşturuldu.', 'Kayıt Eklendi', '1', '2021-04-11 02:00:07'),
(44, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-13 01:14:38'),
(45, 'Bakım Ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-14 01:22:32'),
(46, 'Bakım Ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-14 01:23:27'),
(47, 'Bakım Ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-14 01:23:41'),
(48, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-14 01:24:48'),
(49, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-27 23:11:05'),
(50, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-27 23:38:56'),
(51, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-27 23:47:01'),
(52, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-27 23:51:35'),
(53, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-27 23:52:31'),
(54, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-28 12:22:38'),
(55, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-28 21:43:25'),
(56, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-28 21:55:01'),
(57, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-28 21:55:38'),
(58, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-28 22:04:19'),
(59, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-28 22:06:24'),
(60, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-28 22:07:54'),
(61, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-28 22:08:01'),
(62, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-28 22:15:33'),
(63, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-29 17:05:20'),
(64, 'Bakım Ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-29 17:05:50'),
(65, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-29 17:07:52'),
(66, 'lilyak kullanıcının kaydı silindi. ', 'Kayıt Silindi', '14', '2021-04-29 17:38:01'),
(67, 'merty adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-30 00:52:18'),
(68, 'merty adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-04-30 00:57:50'),
(69, 'shnbusra adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-05-05 01:20:10'),
(70, 'Üst Kategoti güncellendi.', 'Kayıt Güncellendi', '1', '2021-05-13 22:32:14'),
(71, 'shnbusra adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-05-13 22:59:49'),
(72, 'shnbusra adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-05-14 00:44:35'),
(73, 'shnbusra adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-05-14 01:10:50'),
(74, 'Ürünler güncellendi.', 'Kayıt Güncellendi', '1', '2021-05-15 21:18:41'),
(75, 'Ürünler güncellendi.', 'Kayıt Güncellendi', '1', '2021-05-15 21:19:06'),
(76, 'Ürünler güncellendi.', 'Kayıt Güncellendi', '1', '2021-05-15 21:19:23'),
(77, 'Ürünler güncellendi.', 'Kayıt Güncellendi', '1', '2021-05-15 21:19:32'),
(78, 'Ürünler güncellendi.', 'Kayıt Güncellendi', '1', '2021-05-15 21:37:24'),
(79, 'Site ayarları güncellendi. ', 'Kayıt Güncellendi', '1', '2021-05-17 03:44:47'),
(80, 'shnbusra adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-05-18 15:42:43'),
(81, 'shnbusra adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-05-18 15:42:59'),
(82, 'shnbusra adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-05-18 15:43:35'),
(83, 'shnbusra adlı kullanıcının kaydı güncellendi. ', 'Kayıt Güncellendi', '1', '2021-05-18 15:43:43'),
(84, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-18 23:08:52'),
(85, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-18 23:17:25'),
(86, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-18 23:19:32'),
(87, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-18 23:20:10'),
(88, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-18 23:20:46'),
(89, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-19 00:11:10'),
(90, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-24 23:44:21'),
(91, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-24 23:48:31'),
(92, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-24 23:56:34'),
(93, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-25 00:03:41'),
(94, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-25 00:05:21'),
(95, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-25 00:09:23'),
(96, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-25 00:24:44'),
(97, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-25 00:29:26'),
(98, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-25 00:33:20'),
(99, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-25 00:34:14'),
(100, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-25 00:34:32'),
(101, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-25 00:34:51'),
(102, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-25 00:35:26'),
(103, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-25 00:35:59'),
(104, 'Ürünler güncellendi.', 'Ürün Güncellendi', '1', '2021-05-25 00:36:56');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sitekapali`
--

CREATE TABLE `sitekapali` (
  `sitek_id` int(11) NOT NULL,
  `sitek_baslik` varchar(1000) NOT NULL,
  `sitek_aciklama` varchar(1000) NOT NULL,
  `sitek_tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sitekapali`
--

INSERT INTO `sitekapali` (`sitek_id`, `sitek_baslik`, `sitek_aciklama`, `sitek_tarih`) VALUES
(1, 'Yakında Burdayız!', 'Sitemiz kısa süreli bir bakım onarım yapılmaktadır anlayışınız için teşekkür ederiz.', '2021-05-02');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL,
  `slider_ust_baslik` varchar(200) NOT NULL,
  `slider_alt_baslik` varchar(200) NOT NULL,
  `slider_satinal_link` text NOT NULL,
  `slider_gorsel` text NOT NULL,
  `slider_arkaplan` varchar(2000) NOT NULL,
  `uye_id` int(11) NOT NULL,
  `slider_tarih` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_ust_baslik`, `slider_alt_baslik`, `slider_satinal_link`, `slider_gorsel`, `slider_arkaplan`, `uye_id`, `slider_tarih`) VALUES
(1, 'Bundan daha doğal ne olabilir ki?', 'Bitkisel Kremler', '1', 'Bundan_daha_doğal_ne_olabilir_ki_ön_0_1608a0d25c4e58.png', 'Bundan_daha_doğal_ne_olabilir_ki_arka_1608a0d25cb353.jpg', 1, '2021-04-29 04:31:12'),
(2, 'C Vitaminleri ', 'En Doğal Vitaminler', '1', 'deneme_ön_0_16089169de42a3.png,deneme_ön_1_16089169de7b9c.png', 'deneme_arka_16088a65312022.jpg', 1, '2021-04-27 16:44:59'),
(3, '%50 Varan İndirimlerle', 'Belirli Ürünlerde', 'a', 'Bugün_50_varan_indirimlerle_ön_0_16088fed252d06.jpg,Bugün_50_varan_indirimlerle_ön_1_16088fed253393.jpg', 'Bugün_50_varan_indirimlerle_arka_16088a66e4e558.jpg', 1, '2021-04-27 02:02:19');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `urun_id` int(11) NOT NULL,
  `kategori_alt_id` varchar(100) NOT NULL,
  `urun_adi` varchar(3000) NOT NULL,
  `urun_gorsel` text NOT NULL,
  `urundetay_gorsel` text NOT NULL,
  `urun_stokbilgisi` varchar(1) NOT NULL,
  `urun_fiyat` float NOT NULL,
  `indirimli_urun` int(11) DEFAULT NULL,
  `indirim_bitis` datetime DEFAULT NULL,
  `indirim_oran` int(11) NOT NULL,
  `urun_tarih` datetime NOT NULL DEFAULT current_timestamp(),
  `urun_detaybilgisi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`urun_id`, `kategori_alt_id`, `urun_adi`, `urun_gorsel`, `urundetay_gorsel`, `urun_stokbilgisi`, `urun_fiyat`, `indirimli_urun`, `indirim_bitis`, `indirim_oran`, `urun_tarih`, `urun_detaybilgisi`) VALUES
(4, '1', 'Dr. C. Tuna Seti', 'urun_160a014a6e08c9.jpg', '', '1', 159.99, 0, '0000-00-00 00:00:00', 0, '2021-05-15 21:36:22', 'SET HALİNDE BAKIM SETİ'),
(5, '1', 'BROWN SUGAR', 'urun_160a0151cd4b92.jpg', 'urun_detay_160ac14ad060e1.jpg', '1', 199.99, 1, '2021-05-29 22:56:00', 5, '2021-05-15 21:38:20', 'SET HALİNDE BAKIM SETİ'),
(6, '1', 'Dr. C. Tuna Seti', 'urun_160a0157d781ae.jpg', 'urun_detay_160ac111fd60f6.jpg', '1', 175.99, 0, '2021-05-24 22:48:00', 0, '2021-05-15 21:39:57', 'CALENEDULA OIL CREAM'),
(7, '1', 'Dr. C. Tuna Seti', 'urun_160a015c77fd34.jpg', 'urun_detay_160ac1603d2afa.jpg', '1', 150, 0, '2021-05-24 23:09:00', 0, '2021-05-15 21:41:11', 'Activated&CHARCOAL'),
(8, '1', 'Dr. C. Tuna Seti', 'urun_160a01617a9d69.jpg', '', '1', 299.99, 0, '2021-05-24 23:24:00', 0, '2021-05-15 21:42:31', 'SET HALİNDE BAKIM SETİ&ÇANTA HEDİYE'),
(9, '1', 'Dr. C. Tuna Seti', 'urun_160a0165935f2f.jpg', '', '1', 150, 0, '0000-00-00 00:00:00', 0, '2021-05-15 21:43:37', 'Pferde Balsam'),
(10, '1', 'Dr. C. Tuna Seti', 'urun_160a016a4537b5.jpg', 'urun_detay_160ac151147cd6.jpg', '1', 159.99, 0, '2021-05-24 23:05:00', 0, '2021-05-15 21:44:52', 'WHİTE+CORRECT'),
(11, '4', 'Dr. C. Tuna Seti', 'urun_160a0170067fd0.jpg', '', '1', 150, 0, NULL, 0, '2021-05-15 21:46:24', 'Brightening Cream'),
(12, '4', 'Dr. C. Tuna Seti', 'urun_160a0173be58fa.jpg', '', '1', 199.99, 0, NULL, 0, '2021-05-15 21:47:23', 'X2 DOUBLE EFFECT &İKİ KAT ETKİLİ'),
(13, '1', 'Dr. C. Tuna Seti', 'urun_160a0177661805.jpg', '', '1', 199.99, 0, '2021-05-24 23:29:00', 0, '2021-05-15 21:48:22', 'CALENEDULA OIL BODY LOTION'),
(14, '1', 'GLAMOROUS', 'urun_160a017ab57f4e.jpg', 'urun_detay_160ac1ba02faf8.jpg', '1', 175.99, 0, '0000-00-00 00:00:00', 0, '2021-05-15 21:49:15', 'BODY LOTION'),
(15, '7', 'FAR PALETİ', 'urun_160a018722c32b.jpg', '', '1', 39.99, 0, NULL, 0, '2021-05-15 21:52:34', '3 Renkli Çanta Boy'),
(16, '1', 'Makyaj Süngeri', 'urun_160a018988d8ba.jpg', 'urun_detay_160ac1bd60df3d.jpg', '1', 25, 0, '0000-00-00 00:00:00', 0, '2021-05-15 21:53:12', 'Yıkana Bilir Sünger'),
(17, '1', 'Kapatıcı', 'urun_160a018bf0beeb.jpg', 'urun_detay_160ac1be82816b.jpg', '1', 65, 0, '0000-00-00 00:00:00', 0, '2021-05-15 21:53:51', 'Hafif Kapatıcı Özeliği Bulunur'),
(18, '1', 'Fırça Seti', 'urun_160a018e5895f1.jpg', 'urun_detay_160ac1bfb32e62.jpg', '1', 75.99, 0, '0000-00-00 00:00:00', 0, '2021-05-15 21:54:29', 'Çantası Hediye'),
(19, '1', 'Göz Kalemi', 'urun_160a019068d22a.jpg', 'urun_detay_160ac1c1e39ee9.jpg', '1', 15.99, 0, '2021-05-24 23:35:00', 0, '2021-05-15 21:55:02', 'EYE LINER'),
(20, '17', 'NIVEA MEN', 'urun_160a019efcca18.jpg', '', '1', 120, 0, '0000-00-00 00:00:00', 0, '2021-05-15 21:58:55', 'DEEP DIMENSION'),
(21, '1', 'MEN', 'urun_160a01a0b62a89.jpg', 'urun_detay_160ac1c3fbd3d1.jpg', '1', 45, 0, '2021-05-24 23:35:00', 0, '2021-05-15 21:59:23', 'ARKO'),
(22, '17', 'NIVEA MEN', 'urun_160a01a3054b0a.jpg', '', '1', 150, 0, NULL, 0, '2021-05-15 22:00:00', 'BALSAM'),
(23, '20', 'NIVEA MEN', 'urun_160a01a6eceead.jpg', '', '1', 199.99, 1, '2021-05-29 13:00:00', 50, '2021-05-07 22:01:02', 'Set'),
(24, '1', 'NIVEA MEN', 'urun_160a01a8f4e436.jpg', 'urun_detay_160ac1c78794bd.jpg', '1', 299.99, 0, '2021-05-24 23:36:00', 0, '2021-05-07 22:01:35', 'SET MEN '),
(25, '5', 'deneme', 'urun_160a2b6ec77380.jpg', '', '1', 175.99, 0, '0000-00-00 00:00:00', 0, '2021-05-15 23:14:38', '3 Renkli Çanta Boy'),
(26, '6', 'Avon', 'urun_160a437c5d1fc7.jpg', '', '1', 56, 0, '0000-00-00 00:00:00', 0, '2021-05-19 00:55:17', 'Brightening Cream'),
(27, '2', 'NIVEA MEN', 'urun_160a01a8f4e436.jpg', '', '1', 299.99, 0, NULL, 0, '2021-05-07 22:01:35', 'SET MEN '),
(28, '2', 'deneme', 'urun_160a2b6ec77380.jpg', '', '1', 175.99, 0, '0000-00-00 00:00:00', 0, '2021-05-15 23:14:38', '3 Renkli Çanta Boy'),
(29, '2', 'Avon', 'urun_160a437c5d1fc7.jpg', '', '1', 56, 0, '0000-00-00 00:00:00', 0, '2021-05-19 00:55:17', 'Brightening Cream'),
(30, '1', 'deneme', 'urun_160abffa785b8f.jpg', 'urun_detay_160ac102555fdc.jpg', '1', 299.99, 1, '2021-05-30 10:00:00', 30, '2021-05-24 22:33:59', 'Brightening Cream');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ust_kategori`
--

CREATE TABLE `ust_kategori` (
  `kategori_ust_id` int(11) NOT NULL,
  `kategori_ust_adi` varchar(3000) NOT NULL,
  `kategori_ust_acilir_foto` varchar(2000) NOT NULL,
  `kategori_ust_foto` varchar(2000) NOT NULL,
  `kategori_ust_ekleyen` varchar(2000) NOT NULL,
  `tarih_ust` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ust_kategori`
--

INSERT INTO `ust_kategori` (`kategori_ust_id`, `kategori_ust_adi`, `kategori_ust_acilir_foto`, `kategori_ust_foto`, `kategori_ust_ekleyen`, `tarih_ust`) VALUES
(5, 'KADIN', 'KADIN_ust_1609d7d9bed286.jpg', 'KADIN_ust_1609d7dbdeb8c5.jpg', 'shnbusra', '2021-05-05 00:17:27'),
(6, 'ERKEK', 'ERKEK_ust_1609d853540f9e.jpg', 'ERKEK_ust_1609d853544bdf.jpg', 'shnbusra', '2021-05-13 22:59:49');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `uye_id` int(7) NOT NULL,
  `cinsiyet` varchar(1) NOT NULL,
  `adi_soyadi` varchar(3000) NOT NULL,
  `kullanici_adi` varchar(300) NOT NULL,
  `kullanici_sifre` varchar(50) NOT NULL,
  `dogum_tarihi` varchar(2000) NOT NULL,
  `uye_eposta` varchar(300) NOT NULL,
  `uye_profilfoto` varchar(3000) NOT NULL,
  `uye_durum` int(1) NOT NULL,
  `uye_yetki` int(1) NOT NULL,
  `kayit_tarih` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`uye_id`, `cinsiyet`, `adi_soyadi`, `kullanici_adi`, `kullanici_sifre`, `dogum_tarihi`, `uye_eposta`, `uye_profilfoto`, `uye_durum`, `uye_yetki`, `kayit_tarih`) VALUES
(1, '0', 'Büşra ŞAHİN', 'shnbusra', 'caf1a3dfb505ffed0d024130f58c5cfa', '2000-03-15', 'shn_busra@hotmail.com', 'shnbusra_1606a30aedf1d7.jpg', 1, 0, '2021-04-03 19:15:41'),
(6, '1', 'Barış KURT', 'barış', '202cb962ac59075b964b07152d234b70', '2000-01-30', 'barkurt@gmail.com', 'shnbusra_1606bb65705428.png', 1, 2, '2021-04-06 01:16:07'),
(7, '1', '', 'berke', '202cb962ac59075b964b07152d234b70', '', 'bay@gmail.com', 'erkek.png', 0, 2, '2021-04-10 20:14:09'),
(8, '0', 'Irem KAHRAMAN', 'irem', '202cb962ac59075b964b07152d234b70', '2000-08-14', 'asd@asd.com', 'kadin.png', 1, 3, '2021-04-10 20:16:39'),
(9, '0', 'Meryem KAHRAMAN', 'meryem', '202cb962ac59075b964b07152d234b70', '1999-07-02', 'meykahraman@gmail.com', 'kadin.png', 1, 2, '2021-04-10 20:20:32'),
(10, '1', '', 'cem', '202cb962ac59075b964b07152d234b70', '', 'bs@hotmail.com', 'cem_16072091b6cf04.jpg', 0, 3, '2021-04-10 20:22:51'),
(11, '1', 'Şafak SEZER', 'safak', '202cb962ac59075b964b07152d234b70', '1999-10-16', 'safak@gmil.com', 'erkek.png', 1, 4, '2021-04-10 20:33:59'),
(17, '1', 'Mert YAŞAR', 'merty', 'caf1a3dfb505ffed0d024130f58c5cfa', '2021-04-01', 'merty@gmail.com', 'erkek.png', 1, 1, '2021-04-27 16:14:11');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `alt_kategori`
--
ALTER TABLE `alt_kategori`
  ADD PRIMARY KEY (`kategori_alt_id`);

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sistemkayitlari`
--
ALTER TABLE `sistemkayitlari`
  ADD PRIMARY KEY (`kayit_id`);

--
-- Tablo için indeksler `sitekapali`
--
ALTER TABLE `sitekapali`
  ADD PRIMARY KEY (`sitek_id`);

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`slider_id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`urun_id`);

--
-- Tablo için indeksler `ust_kategori`
--
ALTER TABLE `ust_kategori`
  ADD PRIMARY KEY (`kategori_ust_id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`uye_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `alt_kategori`
--
ALTER TABLE `alt_kategori`
  MODIFY `kategori_alt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `sistemkayitlari`
--
ALTER TABLE `sistemkayitlari`
  MODIFY `kayit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Tablo için AUTO_INCREMENT değeri `sitekapali`
--
ALTER TABLE `sitekapali`
  MODIFY `sitek_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `urun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `ust_kategori`
--
ALTER TABLE `ust_kategori`
  MODIFY `kategori_ust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `uye_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
