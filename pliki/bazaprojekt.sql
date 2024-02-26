-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Lut 2024, 22:56
-- Wersja serwera: 10.4.22-MariaDB
-- Wersja PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bazaprojekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aplikacjeuzytkownika`
--

CREATE TABLE `aplikacjeuzytkownika` (
  `Aplikacja_id` int(11) NOT NULL,
  `Uzytkownik_id` int(11) DEFAULT NULL,
  `ogloszenie_id` int(11) DEFAULT NULL,
  `DataAplikacji` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `doswiadczenie`
--

CREATE TABLE `doswiadczenie` (
  `Doswiadczenie_id` int(11) NOT NULL,
  `Uzytkownik_id` int(11) DEFAULT NULL,
  `Stanowisko` varchar(100) DEFAULT NULL,
  `NazwaFirmy` varchar(100) DEFAULT NULL,
  `Lokalizacja` varchar(100) DEFAULT NULL,
  `OkresZatrudnienia` varchar(100) DEFAULT NULL,
  `Obowiazki` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `doswiadczenie`
--

INSERT INTO `doswiadczenie` (`Doswiadczenie_id`, `Uzytkownik_id`, `Stanowisko`, `NazwaFirmy`, `Lokalizacja`, `OkresZatrudnienia`, `Obowiazki`) VALUES
(1, 17, 'd', 'd', 'd', 'd', 'd'),
(2, 16, 'brak', 'brak', 'brak', 'brak', 'brak');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `firmy`
--

CREATE TABLE `firmy` (
  `Firma_id` int(11) NOT NULL,
  `NazwaFirmy` varchar(100) DEFAULT NULL,
  `AdresFirmy` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `firmy`
--

INSERT INTO `firmy` (`Firma_id`, `NazwaFirmy`, `AdresFirmy`) VALUES
(14, 'Firrrr', 'Firmowy'),
(15, 'Firma', 'Zbludza 154');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `jezyki`
--

CREATE TABLE `jezyki` (
  `Jezyk_id` int(11) NOT NULL,
  `Uzytkownik_id` int(11) DEFAULT NULL,
  `NazwaJezyka` varchar(50) DEFAULT NULL,
  `PoziomZnajomosci` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `jezyki`
--

INSERT INTO `jezyki` (`Jezyk_id`, `Uzytkownik_id`, `NazwaJezyka`, `PoziomZnajomosci`) VALUES
(1, 17, 'dad', 'dsad'),
(2, 16, 'brak', 'brak');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontafirm`
--

CREATE TABLE `kontafirm` (
  `KontoFirmy_id` int(11) NOT NULL,
  `Firma_id` int(11) DEFAULT NULL,
  `NazwaUzytkownika` varchar(50) DEFAULT NULL,
  `Haslo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kontafirm`
--

INSERT INTO `kontafirm` (`KontoFirmy_id`, `Firma_id`, `NazwaUzytkownika`, `Haslo`) VALUES
(14, 14, 'Firma', 'Firma100'),
(15, 15, 'Firma2', 'Firma100');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kursy`
--

CREATE TABLE `kursy` (
  `Kurs_id` int(11) NOT NULL,
  `Uzytkownik_id` int(11) DEFAULT NULL,
  `NazwaKursu` varchar(100) DEFAULT NULL,
  `Organizator` varchar(100) DEFAULT NULL,
  `DataKursu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ogloszeniapracy`
--

CREATE TABLE `ogloszeniapracy` (
  `ogloszenie_id` int(11) NOT NULL,
  `Firma_id` int(11) DEFAULT NULL,
  `NazwaStanowiska` varchar(100) DEFAULT NULL,
  `PoziomZatrudnienia` varchar(50) DEFAULT NULL,
  `RodzajUmowy` text DEFAULT NULL,
  `RodzajPracy` varchar(50) DEFAULT NULL,
  `PracaZdalna` text DEFAULT NULL,
  `WidelkiWynagrodzenia` varchar(50) DEFAULT NULL,
  `DniPracy` varchar(50) DEFAULT NULL,
  `GodzinyPracy` varchar(50) DEFAULT NULL,
  `DataWygasniecia` date DEFAULT NULL,
  `Kategoria` varchar(50) DEFAULT NULL,
  `OpisStanowiska` text DEFAULT NULL,
  `Wymagania` text DEFAULT NULL,
  `Oferty` text DEFAULT NULL,
  `Zdjecie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `ogloszeniapracy`
--

INSERT INTO `ogloszeniapracy` (`ogloszenie_id`, `Firma_id`, `NazwaStanowiska`, `PoziomZatrudnienia`, `RodzajUmowy`, `RodzajPracy`, `PracaZdalna`, `WidelkiWynagrodzenia`, `DniPracy`, `GodzinyPracy`, `DataWygasniecia`, `Kategoria`, `OpisStanowiska`, `Wymagania`, `Oferty`, `Zdjecie`) VALUES
(1, 14, 'Programista', 'Wysoki', '', 'programowanie stron internetowych', '0', '4000 - 6000', '4000 - 6000', '8/24h', '2024-02-29', 'informatyka', 'programowanie stron internetowych w zakresie średnim', 'Ukonczenie szkoły średniej (technicznej)', 'brak', 'https://www.gowork.pl/blog/wp-content/uploads/2017/12/27356856_m-3.jpg'),
(2, 14, 'Programista', 'Wysoki', 'NaCzasNieokreslony', 'programowanie stron internetowych', 'NIE', '5000 - 6000', '5000 - 6000', '8/24h', '2024-02-25', 'informatyka', 'programowanie stron internetowych w zakresie średnim', 'Ukonczenie szkoły średniej (technicznej)', 'brak', 'https://www.gowork.pl/blog/wp-content/uploads/2017/12/27356856_m-3.jpg'),
(3, 14, 'Chirurg', 'Niski', 'OkresProbny', 'Chirurgowanie', 'NIE', '8000-10000', '8000-10000', '7/24h', '2024-02-25', 'medycyna', 'Potrafienie chirurgowac ludzi', 'Umiec Chirurgować', 'brak', 'https://www.straganzdrowia.pl/blog/wp-content/uploads/2023/07/chirurg.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ulubioneogloszeniauzytkownika`
--

CREATE TABLE `ulubioneogloszeniauzytkownika` (
  `UlubioneOgloszenie_id` int(11) NOT NULL,
  `Uzytkownik_id` int(11) DEFAULT NULL,
  `ogloszenie_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `umiejetnosci`
--

CREATE TABLE `umiejetnosci` (
  `Umiejetnosc_id` int(11) NOT NULL,
  `Uzytkownik_id` int(11) DEFAULT NULL,
  `NazwaUmiejetnosci` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `umiejetnosci`
--

INSERT INTO `umiejetnosci` (`Umiejetnosc_id`, `Uzytkownik_id`, `NazwaUmiejetnosci`) VALUES
(1, 17, 'Array'),
(2, 16, 'Array');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `Uzytkownik_id` int(11) NOT NULL,
  `Imie` varchar(50) DEFAULT NULL,
  `Nazwisko` varchar(50) DEFAULT NULL,
  `DataUrodzenia` date DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `NumerTelefonu` varchar(15) DEFAULT NULL,
  `ZdjecieProfilowe` blob DEFAULT NULL,
  `Adres` varchar(200) DEFAULT NULL,
  `AktualneStanowiskoPracy` varchar(100) DEFAULT NULL,
  `OpisStanowiskaPracy` text DEFAULT NULL,
  `PodsumowanieZawodowe` text DEFAULT NULL,
  `LinkedInProfil` varchar(100) DEFAULT NULL,
  `GitHubProfil` varchar(100) DEFAULT NULL,
  `Haslo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`Uzytkownik_id`, `Imie`, `Nazwisko`, `DataUrodzenia`, `Email`, `NumerTelefonu`, `ZdjecieProfilowe`, `Adres`, `AktualneStanowiskoPracy`, `OpisStanowiskaPracy`, `PodsumowanieZawodowe`, `LinkedInProfil`, `GitHubProfil`, `Haslo`) VALUES
(16, 'Piotr', 'Florek', NULL, 'piotrektoja12@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Piotrek100'),
(17, 'piotr', 'florek', '2024-02-09', 'email@gmail.com', '123456322', 0x61646164, '3123', 'adad', 'opis', 'adad', 'dadad', 'dad', 'Piotrek100');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyksztalcenie`
--

CREATE TABLE `wyksztalcenie` (
  `Wyksztalcenie_id` int(11) NOT NULL,
  `Uzytkownik_id` int(11) DEFAULT NULL,
  `NazwaSzkolyUczelni` varchar(100) DEFAULT NULL,
  `Lokalizacja` varchar(100) DEFAULT NULL,
  `PoziomWyksztalcenia` varchar(50) DEFAULT NULL,
  `Kierunek` varchar(100) DEFAULT NULL,
  `Okres` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `wyksztalcenie`
--

INSERT INTO `wyksztalcenie` (`Wyksztalcenie_id`, `Uzytkownik_id`, `NazwaSzkolyUczelni`, `Lokalizacja`, `PoziomWyksztalcenia`, `Kierunek`, `Okres`) VALUES
(1, 17, 'zstio limanowa', 'Limanowa', 'chujowy', 'Programista', '2020 - 2025'),
(2, 16, 'nie uzupełnione', 'brak', 'brak', 'brak', 'brak');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `aplikacjeuzytkownika`
--
ALTER TABLE `aplikacjeuzytkownika`
  ADD PRIMARY KEY (`Aplikacja_id`),
  ADD KEY `Użytkownik_id` (`Uzytkownik_id`),
  ADD KEY `ogłoszenie_id` (`ogloszenie_id`);

--
-- Indeksy dla tabeli `doswiadczenie`
--
ALTER TABLE `doswiadczenie`
  ADD PRIMARY KEY (`Doswiadczenie_id`),
  ADD KEY `IDUżytkownika` (`Uzytkownik_id`);

--
-- Indeksy dla tabeli `firmy`
--
ALTER TABLE `firmy`
  ADD PRIMARY KEY (`Firma_id`);

--
-- Indeksy dla tabeli `jezyki`
--
ALTER TABLE `jezyki`
  ADD PRIMARY KEY (`Jezyk_id`),
  ADD KEY `IDUżytkownika` (`Uzytkownik_id`);

--
-- Indeksy dla tabeli `kontafirm`
--
ALTER TABLE `kontafirm`
  ADD PRIMARY KEY (`KontoFirmy_id`);

--
-- Indeksy dla tabeli `kursy`
--
ALTER TABLE `kursy`
  ADD PRIMARY KEY (`Kurs_id`),
  ADD KEY `IDUżytkownika` (`Uzytkownik_id`);

--
-- Indeksy dla tabeli `ogloszeniapracy`
--
ALTER TABLE `ogloszeniapracy`
  ADD PRIMARY KEY (`ogloszenie_id`),
  ADD KEY `Firma_id` (`Firma_id`);

--
-- Indeksy dla tabeli `ulubioneogloszeniauzytkownika`
--
ALTER TABLE `ulubioneogloszeniauzytkownika`
  ADD PRIMARY KEY (`UlubioneOgloszenie_id`),
  ADD KEY `Użytkownik_id` (`Uzytkownik_id`),
  ADD KEY `ogłoszenie_id` (`ogloszenie_id`);

--
-- Indeksy dla tabeli `umiejetnosci`
--
ALTER TABLE `umiejetnosci`
  ADD PRIMARY KEY (`Umiejetnosc_id`),
  ADD KEY `IDUżytkownika` (`Uzytkownik_id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`Uzytkownik_id`);

--
-- Indeksy dla tabeli `wyksztalcenie`
--
ALTER TABLE `wyksztalcenie`
  ADD PRIMARY KEY (`Wyksztalcenie_id`),
  ADD KEY `IDUżytkownika` (`Uzytkownik_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `aplikacjeuzytkownika`
--
ALTER TABLE `aplikacjeuzytkownika`
  MODIFY `Aplikacja_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `doswiadczenie`
--
ALTER TABLE `doswiadczenie`
  MODIFY `Doswiadczenie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `firmy`
--
ALTER TABLE `firmy`
  MODIFY `Firma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `jezyki`
--
ALTER TABLE `jezyki`
  MODIFY `Jezyk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `kontafirm`
--
ALTER TABLE `kontafirm`
  MODIFY `KontoFirmy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `kursy`
--
ALTER TABLE `kursy`
  MODIFY `Kurs_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `ogloszeniapracy`
--
ALTER TABLE `ogloszeniapracy`
  MODIFY `ogloszenie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `ulubioneogloszeniauzytkownika`
--
ALTER TABLE `ulubioneogloszeniauzytkownika`
  MODIFY `UlubioneOgloszenie_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `umiejetnosci`
--
ALTER TABLE `umiejetnosci`
  MODIFY `Umiejetnosc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `Uzytkownik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT dla tabeli `wyksztalcenie`
--
ALTER TABLE `wyksztalcenie`
  MODIFY `Wyksztalcenie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `aplikacjeuzytkownika`
--
ALTER TABLE `aplikacjeuzytkownika`
  ADD CONSTRAINT `aplikacjeuzytkownika_ibfk_1` FOREIGN KEY (`Uzytkownik_id`) REFERENCES `uzytkownicy` (`Uzytkownik_id`),
  ADD CONSTRAINT `aplikacjeuzytkownika_ibfk_2` FOREIGN KEY (`ogloszenie_id`) REFERENCES `ogloszeniapracy` (`ogloszenie_id`);

--
-- Ograniczenia dla tabeli `doswiadczenie`
--
ALTER TABLE `doswiadczenie`
  ADD CONSTRAINT `doswiadczenie_ibfk_1` FOREIGN KEY (`Uzytkownik_id`) REFERENCES `uzytkownicy` (`Uzytkownik_id`);

--
-- Ograniczenia dla tabeli `jezyki`
--
ALTER TABLE `jezyki`
  ADD CONSTRAINT `jezyki_ibfk_1` FOREIGN KEY (`Uzytkownik_id`) REFERENCES `uzytkownicy` (`Uzytkownik_id`);

--
-- Ograniczenia dla tabeli `kursy`
--
ALTER TABLE `kursy`
  ADD CONSTRAINT `kursy_ibfk_1` FOREIGN KEY (`Uzytkownik_id`) REFERENCES `uzytkownicy` (`Uzytkownik_id`);

--
-- Ograniczenia dla tabeli `ogloszeniapracy`
--
ALTER TABLE `ogloszeniapracy`
  ADD CONSTRAINT `ogloszeniapracy_ibfk_1` FOREIGN KEY (`Firma_id`) REFERENCES `firmy` (`Firma_id`);

--
-- Ograniczenia dla tabeli `ulubioneogloszeniauzytkownika`
--
ALTER TABLE `ulubioneogloszeniauzytkownika`
  ADD CONSTRAINT `ulubioneogloszeniauzytkownika_ibfk_1` FOREIGN KEY (`Uzytkownik_id`) REFERENCES `uzytkownicy` (`Uzytkownik_id`),
  ADD CONSTRAINT `ulubioneogloszeniauzytkownika_ibfk_2` FOREIGN KEY (`ogloszenie_id`) REFERENCES `ogloszeniapracy` (`ogloszenie_id`);

--
-- Ograniczenia dla tabeli `umiejetnosci`
--
ALTER TABLE `umiejetnosci`
  ADD CONSTRAINT `umiejetnosci_ibfk_1` FOREIGN KEY (`Uzytkownik_id`) REFERENCES `uzytkownicy` (`Uzytkownik_id`);

--
-- Ograniczenia dla tabeli `wyksztalcenie`
--
ALTER TABLE `wyksztalcenie`
  ADD CONSTRAINT `wyksztalcenie_ibfk_1` FOREIGN KEY (`Uzytkownik_id`) REFERENCES `uzytkownicy` (`Uzytkownik_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
