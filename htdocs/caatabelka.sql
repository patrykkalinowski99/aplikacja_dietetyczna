-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Gru 2022, 01:29
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `database`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bought_products`
--

CREATE TABLE `bought_products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `bought_products`
--

INSERT INTO `bought_products` (`id`, `user_id`, `product_id`) VALUES
(1, 125, 44),
(2, 125, 45),
(3, 125, 44),
(4, 125, 45);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` int(11) NOT NULL,
  `photo_title` varchar(400) NOT NULL,
  `product_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `photo_title`, `product_type`) VALUES
(43, 'Forma na Kółkach', 'Program treningowy Forma na kółkach, to kompletny przewodnik treningowy który przeprowadzi kursanta od ćwiczeń podstawowych stanowiących bazę zdrowego treningu, aż do tych zaawansowanych i efektownych ćwiczeń.', 250, 'forma-na-kolkach.png', 'plan'),
(44, 'Forma za Biurkiem', 'Program jest dla osób które mają siedzący tryb życia (pracownicy biurowi/IT studenci, kierowcy, gracze). Jeśli chcesz zadbać o swój układ ruchu dzięki prostym zmianom i krótkim domowym treningom, ten program jest dla Ciebie.\r\n\r\n', 200, 'pudelko-forma2-800x871.png', 'plan'),
(45, 'Mobilne Ciało', 'Program jest dla osób, które chcą poprawić ruchomość oraz elastyczność swojego ciała. Będzie on świetnym uzupełnieniem treningu głównego dla biegaczy, wspinaczy, zawodników sportów walki, czy osób uprawiających gry zespołowe.', 250, 'mobilne-cialo-2-1-800x586.png', 'plan'),
(46, 'Wszechstronne Ciało', 'Pracując z programem możesz spodziewać się wszechstronnego rozwoju formy fizycznej. Chcemy równocześnie wzmocnić wszystkie partie mięśniowe w twoim ciele, poprawić mobilność i elastyczność, podkręcić Twoją wytrzymałość i zmienić wygląd sylwetki. Jest to jak najbardziej możliwe, gdyż osoby początkujące, lub te które wracają do treningu po dłuższej przerwie, mają podatny organizm i są  stanie w pierwsze 3-6 miesięcy zrobić ogromne postępy na wszystkich płaszczyznach.', 600, 'pakiet-filar-1-2-3-800x586.png', 'plan'),
(47, 'Dieta Zbilansowana - 1500kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(48, 'Dieta Zbilansowana - 1600kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(49, 'Dieta Zbilansowana - 1700kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(50, 'Dieta Zbilansowana - 1800kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(51, 'Dieta Zbilansowana - 1900kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(52, 'Dieta Zbilansowana - 2000kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(53, 'Dieta Zbilansowana - 2100kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(54, 'Dieta Zbilansowana - 2200kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(55, 'Dieta Zbilansowana - 2300kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(56, 'Dieta Zbilansowana - 2400kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(57, 'Dieta Zbilansowana - 2500kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(58, 'Dieta Zbilansowana - 2600kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(59, 'Dieta Zbilansowana - 2700kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(60, 'Dieta Zbilansowana - 2800kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(61, 'Dieta Zbilansowana - 2900kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook'),
(62, 'Dieta Zbilansowana - 3000kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, 'dietka.png', 'ebook');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `imie` varchar(20) NOT NULL,
  `nazwisko` varchar(20) NOT NULL,
  `role_id` int(11) NOT NULL,
  `wiek` int(10) NOT NULL,
  `waga` int(11) NOT NULL,
  `wzrost` int(100) NOT NULL,
  `zapotrzebowanie` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `imie`, `nazwisko`, `role_id`, `wiek`, `waga`, `wzrost`, `zapotrzebowanie`) VALUES
(105, 'patryk', 'patrykpatryk@patrykpatryk', '$2y$10$d1IaFcMvpS1j1nm2p7UzQeYRQ0ZGLEMPWOwhVZM/rGD41yMigZ12q', 'patryk', 'patryk', 3, 23, 72, 185, 0),
(115, 'Andronik', 'KamilAndronik@wp.pl', '$2y$10$GwyntC/E.tOetzBNtydWneYMcoD3TJUCN60su2.6dHgi.R5a9Pxvm', 'Kamil', 'Andronik', 1, 0, 0, 0, 0),
(116, 'Aszurkiewicz', 'PatrykAszurkiewicz@wp.pl', '$2y$10$CwXD0/BuKcfsPEhWpiMLHOOb0VH3eTlpKvxfeOoxg5Hm0.zGdzFFG', 'Patryk', 'Aszurkiewicz', 1, 0, 0, 0, 0),
(117, 'ArturBalcer', 'ArturBalcer@wp.pl', '$2y$10$g.9ixRunGeROf6FQfvpCYeyjl6pY0523POtetq1zDNcR2ZI/ems2W', 'Artur', 'Balcer', 1, 0, 0, 0, 0),
(118, 'Piotr', 'PiotrBolonkowski@wp.pl', '$2y$10$h2EZoSCw0Jchz9iW4Q1tYOa7MJ5Geep2tKXfe8un4f21oUBnr4DAC', 'Piotr', 'Bołonkowski', 2, 0, 0, 0, 0),
(119, 'JarosławBondaruk', 'JaroslawBondaruk@wp.pl', '$2y$10$lIRWEGdVtYBHxuAKRXomG.tGRfrhsrRY.u/U4an9izoakw9qRPWyq', 'Jarosław', 'Bondaruk', 1, 0, 0, 0, 0),
(120, 'ArturJarosławBucki', 'ArturJaroslawBucki@wp.pl', '$2y$10$mWurBbbDuy/KQK/SwqoPW.1/RGYUlPmtixLevblV4rjHPWrO3cS9G', 'Artur Jarosław', 'Bucki', 1, 0, 0, 0, 0),
(121, 'JakubDubiejko', 'JakubDubiejko@wp.pl', '$2y$10$nJYVvGeu/QmuqtskB/AiUe9Qy8iKmnu1gRSCYmMJ/1wB4XPTMgq6q', 'Jakub', 'Dubiejko', 1, 0, 0, 0, 0),
(122, 'MichałFilończuk', 'MichalFilonczuk@wp.pl', '$2y$10$UTZLy29oWYfveV6OOTioQOcn9WDRjZpzP5fEKKOfTfKYVE8qTRQI2', 'Michał', 'Filończuk', 1, 0, 0, 0, 0),
(123, 'PatrykGosk', 'PatrykGosk@wp.pl', '$2y$10$XLSchvC6jqoZChk19v1mPeLTAepC8VbwKDy8a/dBkhrFIJ3BNAse6', 'Patryk', 'Gosk', 1, 0, 0, 0, 0),
(124, 'JakubJakimiuk', 'JakubJakimiuk@outlook.com', '$2y$10$2eUwlXtUCwJ64eYklPKyEOxKYrGb3dBUDpT8IfEiZf.iWlfA17ExG', 'Jakub', 'Jakimiuk', 1, 0, 0, 0, 0),
(125, 'PatrykKalinowski', 'PatrykKalinowski@wp.pl', '$2y$10$1dyfhEABNU4k6rvUb.23KOmBYLHoopLrcP2gWvO5GbDCF2vWiNfse', 'Patryk', 'Kalinowski', 3, 0, 0, 0, 0),
(126, 'TomashKarpei', 'TomashKarpei@wp.pl', '$2y$10$8ONCdWQoaAWvIoQs1GpaTe1MguGiUA3gtW24Dh8nxI8yvtrnhQKKC', 'Tomash', 'Karpei', 2, 0, 0, 0, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `bought_products`
--
ALTER TABLE `bought_products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `bought_products`
--
ALTER TABLE `bought_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
