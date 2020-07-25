-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 12 Cze 2020, 20:36
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `osadnicy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kamieniolom`
--

CREATE TABLE `kamieniolom` (
  `id_kamieniolomu` int(11) NOT NULL,
  `poziom` int(11) NOT NULL,
  `drewno` int(11) NOT NULL,
  `kamien` int(11) NOT NULL,
  `produkcja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kamieniolom`
--

INSERT INTO `kamieniolom` (`id_kamieniolomu`, `poziom`, `drewno`, `kamien`, `produkcja`) VALUES
(1, 1, 100, 150, 10),
(2, 2, 150, 225, 15),
(3, 3, 220, 200, 20),
(4, 4, 300, 220, 30),
(5, 5, 450, 300, 50);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszary`
--

CREATE TABLE `koszary` (
  `id_koszar` int(11) NOT NULL,
  `poziom` int(11) NOT NULL,
  `drewno` int(11) NOT NULL,
  `kamien` int(11) NOT NULL,
  `wojownicy` int(11) NOT NULL,
  `lucznicy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `koszary`
--

INSERT INTO `koszary` (`id_koszar`, `poziom`, `drewno`, `kamien`, `wojownicy`, `lucznicy`) VALUES
(1, 1, 300, 150, 5, 0),
(2, 2, 500, 250, 8, 0),
(3, 3, 750, 300, 10, 1),
(4, 4, 1000, 500, 20, 2),
(5, 5, 2000, 1100, 30, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pole`
--

CREATE TABLE `pole` (
  `id_pola` int(11) NOT NULL,
  `poziom` int(11) NOT NULL,
  `drewno` int(11) NOT NULL,
  `kamien` int(11) NOT NULL,
  `produkcja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `pole`
--

INSERT INTO `pole` (`id_pola`, `poziom`, `drewno`, `kamien`, `produkcja`) VALUES
(1, 1, 20, 0, 5),
(2, 2, 50, 10, 7),
(3, 3, 150, 20, 10),
(4, 4, 200, 50, 15),
(5, 5, 300, 100, 20);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tartak`
--

CREATE TABLE `tartak` (
  `id_tartaku` int(11) NOT NULL,
  `poziom` int(11) DEFAULT NULL,
  `drewno` int(11) NOT NULL,
  `kamien` int(11) NOT NULL,
  `produkcja` int(11) DEFAULT NULL,
  `czas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tartak`
--

INSERT INTO `tartak` (`id_tartaku`, `poziom`, `drewno`, `kamien`, `produkcja`, `czas`) VALUES
(1, 1, 10, 20, 10, 60),
(2, 2, 100, 200, 15, 0),
(3, 3, 200, 300, 20, 60),
(4, 4, 350, 370, 30, 60),
(5, 5, 700, 500, 50, 60);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `pass` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `drewno` int(11) NOT NULL,
  `kamien` int(11) NOT NULL,
  `zboze` int(11) NOT NULL,
  `id_wojska` int(11) NOT NULL,
  `chwala` int(11) NOT NULL,
  `administrator` tinyint(1) DEFAULT 0,
  `zablokowany` tinyint(1) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `user`, `pass`, `email`, `drewno`, `kamien`, `zboze`, `id_wojska`, `chwala`, `administrator`, `zablokowany`) VALUES
(1, 'adam', '$2y$10$Yk9zCXlrESJvVfsPAC2hC.tb2Ph9svmq3Sr2PgJ2V.7opj.FKKdYW', 'adam@gmail.com', 313, 5675, 342, 2, 0, 0, 0),
(11, 'ukeis', '$2y$10$x1R3xpLrBGUuyBgyDXfmreSz4jKvN2JpnuFYeBz7lhAU57kEHRdqC', 'sieku358@gmail.com', 19485, 45075, 48060, 1, 7, 0, 0),
(22, 'admin', '$2y$10$B48ErqgIZtjj9AT.32Xd1uBkpT9YquY8piPAhvuTnVnCXbSgKgu1q', 'admin@admin.pl', 100, 100, 100, 13, 0, 1, 0),
(14, 'nup1', '$2y$10$eK3pC2jx9/PiCyHHsYgVx.SNl5s5.En9aadZWqMUMd.6tdFSl7kXy', 'nup1@nup.pl', 13460, 15135, 5802, 4, 1, 0, 0),
(15, 'nup2', '$2y$10$QEmqvIsP8SnEUUqGpZiXdeSxwLwwMV79F0Wj12776DzuP1w4U59fq', 'nup2@nup.pl', 7120, 3895, 1965, 5, 0, 0, 0),
(16, 'nup3', '$2y$10$Vm4nnIuIR6CNNimMicBfa.67bE4yvWi/5y6kCatg.LnKhsOiNOKDe', 'nup3@nup.pl', 3800, 3830, 1965, 6, 0, 0, 0),
(17, 'nup4', '$2y$10$SvycZwaxSNWSVcENPmim..HC3pqQokvLqbTBApSPpONfzEmm0rHe.', 'nup1@nup.pl4', 3800, 3830, 1965, 7, 0, 0, 0),
(18, 'nup5', '$2y$10$tabVdkMn3qWmJvoFg7Ul9OdnHacLyT0xDFhXQyT/tMFu1UKh.q3Kq', 'nup1@nup.pl5', 3800, 3830, 1965, 8, 0, 0, 0),
(19, 'nup6', '$2y$10$zeUpTySoXCbD7yfM0rbgMekpxQ0JngjNDXfBdu/AuO2rY0BMyTvR2', 'nup6@nup.pl', 3800, 3830, 1965, 9, 0, 0, 0),
(20, 'nup7', '$2y$10$GGlIHsD9yDdO.BQjXkWDpudxlsbTaRG/8SYoHL.WhuhkPyxIwQoJO', 'nup7@nup.pl', 3800, 3830, 565, 10, 0, 0, 0),
(21, 'nup8', '$2y$10$xZjXaJP6OAiXOXVRWeoAOugi5zUIioadjBEPKj.ZNGm284ZMP/DaG', 'nup8@nup.pl', 3650, 3670, 1890, 11, 0, 0, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wioski`
--

CREATE TABLE `wioski` (
  `id_wioski` int(11) NOT NULL,
  `id_uzytkownika` int(11) NOT NULL,
  `id_zamku` int(11) NOT NULL,
  `id_tartaku` int(11) NOT NULL,
  `id_kamieniolomu` int(11) NOT NULL,
  `id_pola` int(11) NOT NULL,
  `id_koszar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `wioski`
--

INSERT INTO `wioski` (`id_wioski`, `id_uzytkownika`, `id_zamku`, `id_tartaku`, `id_kamieniolomu`, `id_pola`, `id_koszar`) VALUES
(1, 11, 5, 5, 5, 5, 5),
(2, 14, 2, 5, 5, 5, 1),
(3, 15, 5, 4, 2, 1, 1),
(4, 16, 1, 1, 1, 1, 1),
(5, 17, 1, 1, 1, 1, 1),
(6, 18, 1, 1, 1, 1, 1),
(7, 19, 1, 1, 1, 1, 1),
(8, 20, 1, 1, 1, 1, 1),
(9, 21, 1, 1, 1, 1, 1),
(10, 12, 1, 1, 1, 1, 1),
(11, 22, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wojska`
--

CREATE TABLE `wojska` (
  `id_wojska` int(11) NOT NULL,
  `wojownicy` int(11) NOT NULL,
  `lucznicy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `wojska`
--

INSERT INTO `wojska` (`id_wojska`, `wojownicy`, `lucznicy`) VALUES
(1, 26, 3),
(2, 5, 0),
(3, 0, 0),
(4, 0, 0),
(5, 0, 0),
(6, 0, 0),
(7, 0, 0),
(8, 0, 0),
(9, 0, 0),
(10, 2, 0),
(11, 0, 0),
(12, 0, 0),
(13, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamek`
--

CREATE TABLE `zamek` (
  `id_zamku` int(11) NOT NULL,
  `poziom` int(11) NOT NULL,
  `drewno` int(11) NOT NULL,
  `kamien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zamek`
--

INSERT INTO `zamek` (`id_zamku`, `poziom`, `drewno`, `kamien`) VALUES
(1, 1, 50, 30),
(2, 2, 90, 50),
(3, 3, 320, 150),
(4, 4, 500, 220),
(5, 5, 0, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kamieniolom`
--
ALTER TABLE `kamieniolom`
  ADD PRIMARY KEY (`id_kamieniolomu`);

--
-- Indeksy dla tabeli `koszary`
--
ALTER TABLE `koszary`
  ADD PRIMARY KEY (`id_koszar`);

--
-- Indeksy dla tabeli `pole`
--
ALTER TABLE `pole`
  ADD PRIMARY KEY (`id_pola`);

--
-- Indeksy dla tabeli `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indeksy dla tabeli `tartak`
--
ALTER TABLE `tartak`
  ADD PRIMARY KEY (`id_tartaku`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `wioski`
--
ALTER TABLE `wioski`
  ADD PRIMARY KEY (`id_wioski`);

--
-- Indeksy dla tabeli `wojska`
--
ALTER TABLE `wojska`
  ADD PRIMARY KEY (`id_wojska`);

--
-- Indeksy dla tabeli `zamek`
--
ALTER TABLE `zamek`
  ADD PRIMARY KEY (`id_zamku`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `kamieniolom`
--
ALTER TABLE `kamieniolom`
  MODIFY `id_kamieniolomu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `koszary`
--
ALTER TABLE `koszary`
  MODIFY `id_koszar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `pole`
--
ALTER TABLE `pole`
  MODIFY `id_pola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT dla tabeli `tartak`
--
ALTER TABLE `tartak`
  MODIFY `id_tartaku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT dla tabeli `wioski`
--
ALTER TABLE `wioski`
  MODIFY `id_wioski` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `wojska`
--
ALTER TABLE `wojska`
  MODIFY `id_wojska` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `zamek`
--
ALTER TABLE `zamek`
  MODIFY `id_zamku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

DELIMITER $$
--
-- Zdarzenia
--
CREATE DEFINER=`root`@`localhost` EVENT `drewno_update` ON SCHEDULE EVERY 60 SECOND STARTS '2020-05-13 19:10:09' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE uzytkownicy
INNER JOIN wioski
    on uzytkownicy.id = wioski.id_uzytkownika
INNER JOIN tartak
    on wioski.id_tartaku = tartak.id_tartaku
SET uzytkownicy.drewno = uzytkownicy.drewno  + tartak.produkcja$$

CREATE DEFINER=`root`@`localhost` EVENT `kamien_update` ON SCHEDULE EVERY 60 SECOND STARTS '2020-06-05 15:25:29' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE uzytkownicy
INNER JOIN wioski
    on uzytkownicy.id = wioski.id_uzytkownika
INNER JOIN kamieniolom
    on wioski.id_kamieniolomu = kamieniolom.id_kamieniolomu
SET uzytkownicy.kamien = uzytkownicy.kamien  + kamieniolom.produkcja$$

CREATE DEFINER=`root`@`localhost` EVENT `zboze_update` ON SCHEDULE EVERY 60 SECOND STARTS '2020-06-05 15:59:35' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE uzytkownicy
INNER JOIN wioski
    on uzytkownicy.id = wioski.id_uzytkownika
INNER JOIN pole
    on wioski.id_pola = pole.id_pola
SET uzytkownicy.zboze = uzytkownicy.zboze  + pole.produkcja$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
