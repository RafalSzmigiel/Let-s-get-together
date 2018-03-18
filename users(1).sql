-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 01 Gru 2017, 08:58
-- Wersja serwera: 10.1.28-MariaDB
-- Wersja PHP: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `users`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `events`
--

CREATE TABLE `events` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name_event` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `place` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `date` date NOT NULL,
  `Time` time NOT NULL,
  `desc_event` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `events`
--

INSERT INTO `events` (`id_event`, `id_user`, `name_event`, `place`, `date`, `Time`, `desc_event`) VALUES
(1, 7, 'picie w barze', 'przybij piątaka - świdnicka', '2017-11-18', '20:00:00', 'chlejemy do upadlego, swietjemy zdanie egzaminu - zaproscie rowniez swoich znajomych. Musi byc nas jak najwiecej'),
(2, 3, 'fdgdg', 'dfdsfs', '0000-00-00', '21:30:00', 'adasda'),
(3, 4, 'wsdasd', 'dasdasdas', '0000-00-00', '21:30:00', 'ssadsadsa'),
(4, 4, 'sparing', 'orlik dzierzoniow', '0000-00-00', '18:45:00', 'wezcie ktos pilke do nogi'),
(5, 7, 'sparing', 'orlik dzierzoniow', '0000-00-00', '18:45:00', 'wezcie ktos pilke do nogi'),
(6, 7, 'sfadsf', 'dsfdsfds', '2017-11-28', '14:12:00', 'asdsadasdad'),
(7, 7, 'asdasdasd', 'dasdasdas', '0000-00-00', '14:12:00', 'asdasdasd'),
(8, 7, 'sda', 'dasdasdas', '2017-11-28', '21:30:00', 'asdasdasd'),
(9, 7, 'sda', 'dasdasdas', '2017-11-28', '21:30:00', 'asdasdasd'),
(10, 7, 'sda', 'dasdasdas', '2017-11-28', '21:30:00', 'asdasdasd'),
(11, 7, 'sda', 'dasdasdas', '2017-11-28', '21:30:00', 'asdasdasd'),
(12, 7, 'dsfdsfdsf', 'dasdasda', '2017-11-08', '02:23:00', 'dsdsxczxc'),
(13, 7, 'sadasd', 'sadsad', '2017-11-21', '12:02:00', 'xczxc'),
(14, 7, 'asdasdasd', 'zcxzxcz', '2017-11-14', '12:45:00', 'cgvxcv'),
(20, 8, 'Gokarty', 'Stadion WrocÅ‚aw', '2017-12-06', '05:45:00', 'WeÅºcie ze sobÄ… kaski !'),
(21, 8, 'DomÃ³wka', 'Bajana 34', '2017-12-01', '21:12:00', 'Bawimy siÄ™ do rana');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `participants`
--

CREATE TABLE `participants` (
  `id_participant` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `name` date NOT NULL,
  `surname` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `confirm` text CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `personal_data`
--

CREATE TABLE `personal_data` (
  `id_user` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `surname` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `birth_date` date NOT NULL,
  `nickname` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `locality` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `street` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `postcode` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `photo` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`, `email`) VALUES
(1, 'rafix', '$2y$10$FG.0cRw5.nUL1MLSGy7.4ej2hUDvyqRbBhmB1J00OorpTM9MSYzma', 'rafal.szmigiel77@gmail.com'),
(2, 'kingix', 'kasprzak77', 'kinga.kasprzak77@gmail.com'),
(3, 'rafal', '$2y$10$SaPiDRV/Z0vVWiFhU/f7TuZ1I7B5PEjOPtv0uI7ilq9.bojkUCWty', 'rafal.szmigiel777@gmail.com'),
(4, 'rafal77', '$2y$10$y7al4tpF5ALXAqbGZnqsyeWDVLFqrjn6rCO.vlsHlAmWISIGIGdta', 'szmigiel77@gmail.com'),
(5, 'rafalszmigiel', '$2y$10$e9WRy3U6xJcyt7y8G2qvluh5vHB3vpvRtUeZl848wtfiBr.QridDm', 'rafal77@gmail.com'),
(6, 'kinga', '$2y$10$rh.4uAJBycoeYfBFOsSiJOuMDNe479pFCY7zw3SRi7OtnoIlVzOi.', 'kinga77@gmail.com'),
(7, 'szmigiello', '$2y$10$wGVDvNHsU9EmDN78l4Eu1.l5MnLmPWLFquwuzP3TrMR5gb4xN393y', 'rafals@wp.pl'),
(8, 'admin', '$2y$10$znj2mpn6ZKIrkZtaoR19Qu8sYqls/mwKq8EW.S.WLEMcQ.N1rKRPe', 'admin@gmail.com'),
(9, 'admin1', '$2y$10$9EmAKCXknJx/MpAcqyOog.jvUodtHQICqhIZEdwr25riVAeIWBj2G', 'admin1@wp.pl');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id_participant`),
  ADD KEY `id_event` (`id_event`);

--
-- Indexes for table `personal_data`
--
ALTER TABLE `personal_data`
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `events`
--
ALTER TABLE `events`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `participants`
--
ALTER TABLE `participants`
  MODIFY `id_participant` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Ograniczenia dla tabeli `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `events` (`id_event`);

--
-- Ograniczenia dla tabeli `personal_data`
--
ALTER TABLE `personal_data`
  ADD CONSTRAINT `personal_data_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
