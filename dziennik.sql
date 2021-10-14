-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Paź 2020, 17:04
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `dziennik`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `da_pacjenci`
--

CREATE TABLE `da_pacjenci` (
  `id` int(11) NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `sex` text NOT NULL,
  `wiek` int(11) NOT NULL,
  `waga` int(11) NOT NULL,
  `wzrost` int(11) NOT NULL,
  `choroba` text NOT NULL,
  `objawy` text NOT NULL,
  `przyczyny` text NOT NULL,
  `ID_User` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `da_pacjenci`
--

INSERT INTO `da_pacjenci` (`id`, `imie`, `nazwisko`, `sex`, `wiek`, `waga`, `wzrost`, `choroba`, `objawy`, `przyczyny`, `ID_User`) VALUES
(1, 'Jakub', 'Mazurek', 'M', 17, 64, 171, 'Nadciśnienie tętnicze', 'Szybkie zmęczenie', 'Brak ruchu', 1),
(2, 'Arkadiusz', 'Baran', 'M', 18, 66, 176, 'Depresja', 'Samotność', 'Brak kontaktu z innymi', 1),
(3, 'Milan', 'Dąbrowski', 'M', 22, 70, 180, 'Alergia', 'Kaszel', 'Alergia sezonowa', 1),
(4, 'Ksawery', 'Ostrowski', 'M', 33, 72, 176, 'Nadciśnienie tętnicze', 'Szybkie zmęczenie', 'Brak ruchu', 1),
(5, 'Kacper', 'Baranowski', 'M', 35, 74, 176, 'Alergia', 'Katar', 'Alergia na kurz', 1),
(6, 'Kacper', 'Kowalczyk', 'M', 36, 72, 177, 'Alergia', 'Katar', 'Alergia sezonowa', 1),
(7, 'Błażej', 'Krawczyk', 'M', 39, 75, 178, 'Alergia', 'Kaszel', 'Alergia sezonowa', 1),
(8, 'Florian', 'Zawadzki', 'M', 41, 72, 178, 'Choroby płuc', 'Bóle w klatce piersiowej', 'Palenie papierosów', 1),
(9, 'Krzysztof', 'Jasiński', 'M', 42, 98, 176, 'Cukrzyca', 'Przemęczenie', 'Nadwaga', 1),
(10, 'Alex', 'Kowalczyk', 'M', 48, 80, 169, 'Alergia', 'Kaszel', 'Alergia sezonowa', 1),
(11, 'Aleksy', 'Zalewski', 'M', 52, 67, 181, 'Nadciśnienie tętnicze', 'Szybkie zmęczenie', 'Genetyczna', 1),
(12, 'Artur', 'Górski', 'M', 53, 78, 180, 'Choroby serca', 'Szybkie zmęczenie', 'Złe odżywianie', 1),
(13, 'Aureliusz', 'Krawczyk', 'M', 55, 92, 174, 'Nadciśnienie tętnicze', 'Bóle głowy', 'Nadwaga', 1),
(14, 'Igor', 'Maciejewski', 'M', 58, 79, 178, 'Choroby płuc', 'Kaszel', 'Palenie papierosów', 1),
(15, 'Artur', 'Wysocki', 'M', 63, 76, 177, 'Nadciśnienie tętnicze', 'Bóle głowy', 'Złe odżywianie', 1),
(16, 'Maksymilian', 'Jasiński', 'M', 66, 78, 180, 'Cukrzyca', 'Senność', 'Genetyczna', 1),
(17, 'Krystian', 'Rutkowski', 'M', 68, 86, 176, 'Choroby serca', 'Szybkie zmęczenie', 'Brak ruchu', 1),
(18, 'Marcin', 'Tomaszewski', 'M', 70, 85, 167, 'Choroby serca', 'Bóle w klatce piersiowej', 'Nadwaga', 1),
(19, 'Konstanty', 'Chmielewski', 'M', 72, 77, 164, 'Nadciśnienie tętnicze', 'Bóle głowy', 'Brak ruchu', 1),
(20, 'Alek', 'Kowalski', 'M', 73, 102, 177, 'Nadciśnienie tętnicze', 'Szybkie zmęczenie', 'Nadwaga', 1),
(21, 'Klaudia', 'Zawadzka', 'K', 17, 65, 165, 'Depresja', 'Senność', 'Niepowodzenia w życiu', 1),
(22, 'Paulina', 'Przybylska', 'K', 20, 66, 165, 'Alergia', 'Kaszel', 'Alergia na kurz', 1),
(23, 'Cecylia', 'Ziółkowska', 'K', 24, 68, 168, 'Nadciśnienie tętnicze', 'Szybkie zmęczenie', 'Brak ruchu', 1),
(24, 'Kamila', 'Piotrowska', 'K', 27, 66, 167, 'Cukrzyca', 'Przemęczenie', 'Genetyczna', 1),
(25, 'Angelika', 'Stępień', 'K', 35, 70, 169, 'Alergia', 'Katar', 'Alergia sezonowa', 1),
(26, 'Ewelina', 'Chmielewska', 'K', 36, 62, 166, 'Alergia', 'Katar', 'Alergia sezonowa', 1),
(27, 'Lila', 'Krawczyk', 'K', 39, 66, 172, 'Choroby serca', 'Osłabienie', 'Genetyczna', 1),
(28, 'Alisa', 'Przybylska', 'K', 41, 68, 171, 'Nadciśnienie tętnicze', 'Bóle w klatce piersiowej', 'Brak ruchu', 1),
(29, 'Róża', 'Włodarczyk', 'K', 44, 72, 171, 'Depresja', 'Senność', 'Brak motywacji', 1),
(30, 'Żaneta', 'Lis', 'K', 47, 75, 168, 'Cukrzyca', 'Senność', 'Złe odżywianie', 1),
(31, 'Maja', 'Zawadzka', 'K', 48, 74, 164, 'Choroby płuc', 'Przemęczenie', 'Palenie papierosów', 1),
(32, 'Teresa', 'Borkowska', 'K', 52, 76, 166, 'Nadciśnienie tętnicze', 'Szybkie zmęczenie', 'Złe odżywianie', 1),
(33, 'Iza', 'Urbańska', 'K', 54, 77, 165, 'Nadciśnienie tętnicze', 'Bóle głowy', 'Brak ruchu', 1),
(34, 'Daria', 'Lewandowska', 'K', 57, 66, 166, 'Choroby serca', 'Bóle w klatce piersiowej', 'Złe odżywianie', 1),
(35, 'Józefa', 'Tomaszewska', 'K', 58, 76, 170, 'Cukrzyca', 'Przemęczenie', 'Złe odżywianie', 1),
(36, 'Zofia', 'Sawicka', 'K', 62, 66, 168, 'Nadciśnienie tętnicze', 'Bóle głowy', 'Brak ruchu', 1),
(37, 'Lila', 'Wróblewska', 'K', 64, 87, 171, 'Choroby serca', 'Szybkie zmęczenie', 'Nadwaga', 1),
(38, 'Lila', 'Cieślak', 'K', 66, 81, 159, 'Cukrzyca', 'Przemęczenie', 'Genetyczna', 1),
(39, 'Pamela', 'Przybylska', 'K', 68, 80, 165, 'Nadciśnienie tętnicze', 'Bóle głowy', 'Nadwaga', 1),
(40, 'Angelika', 'Górecka', 'K', 69, 59, 166, 'Nadciśnienie tętnicze', 'Szybkie zmęczenie', 'Złe odżywianie', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `da_users`
--

CREATE TABLE `da_users` (
  `id` int(11) NOT NULL,
  `imie` text NOT NULL,
  `login` text NOT NULL,
  `nazwisko` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `da_users`
--

INSERT INTO `da_users` (`id`, `imie`, `login`, `nazwisko`, `password`, `email`) VALUES
(1, 'Daniel', 'daniel', 'Śledź', '827ccb0eea8a706c4c34a16891f84e7b', 'daniel@gmail.com');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `da_pacjenci`
--
ALTER TABLE `da_pacjenci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `da_users`
--
ALTER TABLE `da_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `da_pacjenci`
--
ALTER TABLE `da_pacjenci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT dla tabeli `da_users`
--
ALTER TABLE `da_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
