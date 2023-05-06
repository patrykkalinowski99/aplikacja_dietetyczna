-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 17 Sty 2023, 17:46
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

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
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `bought_products`
--

INSERT INTO `bought_products` (`id`, `user_id`, `product_id`, `product_quantity`) VALUES
(24, 125, 44, 2),
(25, 125, 43, 3),
(26, 125, 43, 4),
(27, 125, 44, 1),
(28, 125, 43, 1),
(29, 125, 45, 1),
(30, 125, 43, 1),
(31, 127, 46, 1),
(32, 127, 45, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_number`) VALUES
(1, 'bezglutenowa', 1),
(2, 'wegetariańskia', 2),
(3, 'ketogeniczna', 3),
(4, 'wysokobiałkowa', 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `user_id`, `text`, `created_at`) VALUES
(1, 0, 145, 'costamtestowego', '2023-01-16 20:36:54'),
(2, 0, 145, 'efwegfweg', '2023-01-16 20:37:00'),
(4, 44, 125, 'dsvsdw', '2023-01-16 20:47:54'),
(5, 44, 125, 'wqdqgf', '2023-01-16 20:47:56'),
(6, 44, 125, 'asfqwfgqgwegwegh', '2023-01-16 20:47:58'),
(26, 43, 125, 'cfel', '2023-01-16 21:10:48'),
(27, 43, 125, 'qwf', '2023-01-16 21:39:16'),
(28, 43, 125, 'weg2', '2023-01-16 21:39:17'),
(29, 43, 125, 'erfhrh', '2023-01-16 21:39:19'),
(30, 43, 125, 'erhejh', '2023-01-16 21:39:20'),
(31, 43, 125, 'ejhtrjhr', '2023-01-16 21:39:21'),
(32, 43, 125, 'etjtrej', '2023-01-16 21:39:23'),
(33, 43, 125, 'jrtejejtj', '2023-01-16 21:39:25'),
(34, 44, 127, 'test', '2023-01-17 16:24:26');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `origin`
--

CREATE TABLE `origin` (
  `id` int(11) NOT NULL,
  `origin_name` varchar(30) NOT NULL,
  `origin_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `origin`
--

INSERT INTO `origin` (`id`, `origin_name`, `origin_number`) VALUES
(1, 'Azja', 1),
(2, 'Europa', 2),
(3, 'Ameryka Północna', 3),
(4, 'Ameryka Południowa', 4);

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
  `product_type` varchar(50) NOT NULL,
  `origin_number` int(11) NOT NULL,
  `category_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `photo_title`, `product_type`, `origin_number`, `category_number`) VALUES
(43, 'Forma na Kółkach', 'Program treningowy Forma na kółkach, to kompletny przewodnik treningowy który przeprowadzi kursanta od ćwiczeń podstawowych stanowiących bazę zdrowego treningu, aż do tych zaawansowanych i efektownych ćwiczeń.', 250, '43.png', 'plan', 0, 0),
(44, 'Forma za Biurkiem', 'Program jest dla osób które mają siedzący tryb życia (pracownicy biurowi/IT studenci, kierowcy, gracze). Jeśli chcesz zadbać o swój układ ruchu dzięki prostym zmianom i krótkim domowym treningom, ten program jest dla Ciebie.\r\n\r\n', 200, '44.png', 'plan', 0, 0),
(45, 'Mobilne Ciało', 'Program jest dla osób, które chcą poprawić ruchomość oraz elastyczność swojego ciała. Będzie on świetnym uzupełnieniem treningu głównego dla biegaczy, wspinaczy, zawodników sportów walki, czy osób uprawiających gry zespołowe.', 250, '45.png', 'plan', 0, 0),
(46, 'Wszechstronne Ciało', 'Pracując z programem możesz spodziewać się wszechstronnego rozwoju formy fizycznej. Chcemy równocześnie wzmocnić wszystkie partie mięśniowe w twoim ciele, poprawić mobilność i elastyczność, podkręcić Twoją wytrzymałość i zmienić wygląd sylwetki. Jest to jak najbardziej możliwe, gdyż osoby początkujące, lub te które wracają do treningu po dłuższej przerwie, mają podatny organizm i są  stanie w pierwsze 3-6 miesięcy zrobić ogromne postępy na wszystkich płaszczyznach.', 600, '46.png', 'plan', 0, 0),
(52, 'Dieta Zbilansowana - 2000kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, '52.png', 'ebook', 0, 0),
(62, 'Dieta Zbilansowana - 3000kcal', 'Dla kogo jest ta dieta?\r\nDla każdej osoby która chce jeść zdrowo, smacznie, wygodnie i przy okazji osiągać swoje cele sylwetkowe.\r\nOtrzymasz: 15 wersji śniadań, 15 wersji obiadów, 15 wersji kolacji i 15 wersji deserów które możesz dowolnie mieszać przez co dieta nie będzie monotonna. Dieta będzie w formie ebooka i możesz ją otworzyć na telefonie, tablecie czy komputerze.', 129, '62.png', 'ebook', 0, 0),
(73, 'Dieta Zbilansowana - 3500kca', 'Dieta wysokobiałkowa z odpowiednio podzielonym zapotrzebowaniem na białko, tłuszcze i węglowodany.', 149, '73.png', 'ebook', 2, 4),
(74, 'Dieta ketogeniczna - podstawy', 'Podstawy diety ketogenicznej, czym jest, w jaki sposób z niej korzystać oraz w jaki sposób przygotować ciało do rezygnacji z węglowodanów', 200, '74.jpg', 'ebook', 3, 3),
(75, 'Japońskie przekąski wysokobiałkowe', 'Zawiera 20 przykładowych posiłków składających się z azjatyckich produktów.', 29, '75.png', 'ebook', 1, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'user'),
(2, 'mod_ebook'),
(3, 'admin'),
(4, 'training_mod'),
(5, 'full_mod');

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
  `role_id` int(11) NOT NULL DEFAULT 1,
  `wiek` int(10) NOT NULL,
  `waga` int(11) NOT NULL,
  `wzrost` int(100) NOT NULL,
  `zapotrzebowanie` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `imie`, `nazwisko`, `role_id`, `wiek`, `waga`, `wzrost`, `zapotrzebowanie`) VALUES
(105, 'patryk', 'patrykpatryk@patrykpatryk', '$2y$10$d1IaFcMvpS1j1nm2p7UzQeYRQ0ZGLEMPWOwhVZM/rGD41yMigZ12q', 'patryk', 'patryk', 3, 23, 72, 185, 0),
(115, 'Andronik', 'KamilAndronik@wp.pl', '$2y$10$GwyntC/E.tOetzBNtydWneYMcoD3TJUCN60su2.6dHgi.R5a9Pxvm', 'Kamil', 'Andronik', 1, 0, 0, 0, 0),
(116, 'Aszurkiewicz', 'PatrykAszurkiewicz@wp.pl', '$2y$10$CwXD0/BuKcfsPEhWpiMLHOOb0VH3eTlpKvxfeOoxg5Hm0.zGdzFFG', 'Patryk', 'Aszurkiewicz', 1, 0, 0, 0, 0),
(117, 'ArturBalcer', 'ArturBalcer@wp.pl', '$2y$10$g.9ixRunGeROf6FQfvpCYeyjl6pY0523POtetq1zDNcR2ZI/ems2W', 'Artur', 'Balcer', 5, 0, 0, 0, 0),
(118, 'Piotr', 'PiotrBolonkowski@wp.pl', '$2y$10$h2EZoSCw0Jchz9iW4Q1tYOa7MJ5Geep2tKXfe8un4f21oUBnr4DAC', 'Piotr', 'Bołonkowski', 2, 0, 0, 0, 0),
(119, 'JarosławBondaruk', 'JaroslawBondaruk@wp.pl', '$2y$10$lIRWEGdVtYBHxuAKRXomG.tGRfrhsrRY.u/U4an9izoakw9qRPWyq', 'Jarosław', 'Bondaruk', 5, 0, 0, 0, 0),
(120, 'ArturJarosławBucki', 'ArturJaroslawBucki@wp.pl', '$2y$10$mWurBbbDuy/KQK/SwqoPW.1/RGYUlPmtixLevblV4rjHPWrO3cS9G', 'Artur Jarosław', 'Bucki', 2, 0, 0, 0, 0),
(121, 'JakubDubiejko', 'JakubDubiejko@wp.pl', '$2y$10$nJYVvGeu/QmuqtskB/AiUe9Qy8iKmnu1gRSCYmMJ/1wB4XPTMgq6q', 'Jakub', 'Dubiejko', 4, 0, 0, 0, 0),
(122, 'MichałFilończuk', 'MichalFilonczuk@wp.pl', '$2y$10$UTZLy29oWYfveV6OOTioQOcn9WDRjZpzP5fEKKOfTfKYVE8qTRQI2', 'Michał', 'Filończuk', 1, 0, 0, 0, 0),
(123, 'PatrykGosk', 'PatrykGosk@wp.pl', '$2y$10$XLSchvC6jqoZChk19v1mPeLTAepC8VbwKDy8a/dBkhrFIJ3BNAse6', 'Patryk', 'Gosk', 1, 0, 0, 0, 0),
(124, 'JakubJakimiuk', 'JakubJakimiuk@outlook.com', '$2y$10$2eUwlXtUCwJ64eYklPKyEOxKYrGb3dBUDpT8IfEiZf.iWlfA17ExG', 'Jakub', 'Jakimiuk', 2, 0, 0, 0, 0),
(125, 'PatrykKalinowski', 'patrykkalinowski99@wp.pl', '$2y$10$44snp4IjBL73O9PR4ueOEuVuSfPPuY/bOgUOPUpNIWylzTMjG6UMi', 'Patryk', 'Kalinowski', 3, 24, 70, 185, 0),
(126, 'TomashKarpei', 'TomashKarpei@wp.pl', '$2y$10$8ONCdWQoaAWvIoQs1GpaTe1MguGiUA3gtW24Dh8nxI8yvtrnhQKKC', 'Tomash', 'Karpei', 2, 0, 0, 0, 0),
(127, 'testtesttest', 'testtesttest@wp.pl', '$2y$10$cHrJjVN0K.jF1TYeuKshk.geoMmmEeDv69Of/UZAg.Y1lCx85fE9C', 'testtesttest', 'testtesttest', 1, 23, 777, 140, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `bought_products`
--
ALTER TABLE `bought_products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `origin`
--
ALTER TABLE `origin`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT dla tabeli `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT dla tabeli `origin`
--
ALTER TABLE `origin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT dla tabeli `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
