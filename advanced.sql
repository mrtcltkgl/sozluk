-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 May 2016, 09:42:05
-- Sunucu sürümü: 10.1.10-MariaDB
-- PHP Sürümü: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `advanced`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1463444070),
('author', '3', 1463444070),
('moderator', '2', 1463444070);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1463444069, 1463444069),
('author', 1, NULL, NULL, NULL, 1463444069, 1463444069),
('createMessage', 2, 'Mesaj Oluşturmak İçin', NULL, NULL, 1463444069, 1463444069),
('createTag', 2, 'Etiket Oluşturmak İçin', NULL, NULL, 1463444069, 1463444069),
('createTitle', 2, 'Başlık Oluşturmak İçin', NULL, NULL, 1463444069, 1463444069),
('deleteMessage', 2, 'Mesaj Silmek İçin', NULL, NULL, 1463444069, 1463444069),
('deleteOwnMessage', 2, 'Kendi Mesajını Sil!!', 'isAuthor', NULL, 1463444071, 1463444071),
('deleteTag', 2, 'Etiket Silmek İçin', NULL, NULL, 1463444069, 1463444069),
('deleteTitle', 2, 'Başlık Silmek İçin', NULL, NULL, 1463444069, 1463444069),
('moderator', 1, NULL, NULL, NULL, 1463444069, 1463444069),
('updateMessage', 2, 'Mesaj güncellemek İçin', NULL, NULL, 1463444069, 1463444069),
('updateOwnMessage', 2, 'Kendi Mesajını Güncelle', 'isAuthor', NULL, 1463444071, 1463444071),
('updateTag', 2, 'Etiket güncellemek İçin', NULL, NULL, 1463444069, 1463444069),
('updateTitle', 2, 'Başlık güncellemek İçin', NULL, NULL, 1463444069, 1463444069);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'createTag'),
('admin', 'deleteTag'),
('admin', 'moderator'),
('admin', 'updateTag'),
('author', 'createMessage'),
('author', 'createTitle'),
('author', 'deleteOwnMessage'),
('author', 'updateOwnMessage'),
('deleteOwnMessage', 'deleteMessage'),
('moderator', 'author'),
('moderator', 'deleteMessage'),
('moderator', 'deleteTitle'),
('moderator', 'updateMessage'),
('moderator', 'updateTitle'),
('updateOwnMessage', 'updateMessage');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isAuthor', 'O:22:"common\\rbac\\AuthorRule":3:{s:4:"name";s:8:"isAuthor";s:9:"createdAt";i:1463444071;s:9:"updatedAt";i:1463444071;}', 1463444071, 1463444071);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL COMMENT 'Mesaj Numarası',
  `user_id` int(11) NOT NULL COMMENT 'Mesajı Oluşturan',
  `title_id` int(11) NOT NULL COMMENT 'Mesaj Başlığı',
  `message` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mesaj İçeriği'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `title_id`, `message`) VALUES
(3, 2, 1, 'Deneme 1-2-3 moderator'),
(4, 3, 1, 'author oluşturdu'),
(7, 1, 1, 'denememem');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1463413133),
('m130524_201442_init', 1463413135),
('m140506_102106_rbac_init', 1463431215);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL COMMENT 'Etiket Numarası',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Etiket Adı'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'Spor'),
(2, 'Ekonomi'),
(3, 'Magazin'),
(4, 'Teknoloji'),
(5, 'Sağlık'),
(6, 'Komedi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `titles`
--

CREATE TABLE `titles` (
  `id` int(11) NOT NULL COMMENT 'Başlık Numarası',
  `tag_id` int(11) NOT NULL COMMENT 'Başlık Etiket Numarası',
  `user_id` int(11) NOT NULL COMMENT 'Başlığı Oluşturan',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Başlık Adı'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `titles`
--

INSERT INTO `titles` (`id`, `tag_id`, `user_id`, `name`) VALUES
(1, 1, 1, 'Deneme'),
(6, 4, 1, 'iPhone 7 tanıtıldı'),
(7, 1, 1, 'Kupa maçı yaklaşıyor');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'tlOt55mTv6OqrmVaXSwoAC_lILQhfSmL', '$2y$13$lHb9QGFWyY2qQNf73KYxpe7vU2ho0M6a2WgdlPNIH8gMh4PgvHOFi', NULL, 'admin@admin.com', 10, 1463413170, 1463413170),
(2, 'moderator', 'd5A6OyZoNNSPg5f-xfbwztQO2ppNV3tG', '$2y$13$ppsYgINwvLJbisakYXnuO.M3VfRZnjfwUAJioQmk.orJDQqPRuhlO', NULL, 'moderator@moderator.com', 10, 1463434390, 1463434390),
(3, 'author', '56To79FpG-v9mE65b82aAnf3Cj9DkAW1', '$2y$13$IqhMXzVmnHxxrpCh6i4/TOnsclqAtnvKZx0aNRL9tPDCmfEp0/Y96', NULL, 'author@author.com', 10, 1463434503, 1463434503);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Tablo için indeksler `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Tablo için indeksler `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Tablo için indeksler `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Tablo için indeksler `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `title_id` (`title_id`);

--
-- Tablo için indeksler `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Tablo için indeksler `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `titles`
--
ALTER TABLE `titles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Mesaj Numarası', AUTO_INCREMENT=10;
--
-- Tablo için AUTO_INCREMENT değeri `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Etiket Numarası', AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `titles`
--
ALTER TABLE `titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Başlık Numarası', AUTO_INCREMENT=8;
--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `Etkileyen Başlık` FOREIGN KEY (`title_id`) REFERENCES `titles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Etkileyen Kullanıcı` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `titles`
--
ALTER TABLE `titles`
  ADD CONSTRAINT `Etiket İlişkileri` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Kullanıcı İlişkileri` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
