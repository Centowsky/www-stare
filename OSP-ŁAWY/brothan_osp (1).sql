-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 09 Wrz 2019, 22:46
-- Wersja serwera: 5.7.24
-- Wersja PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `brothan_osp`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aktywnosc`
--

CREATE TABLE `aktywnosc` (
  `id` int(255) NOT NULL,
  `kategoria` varchar(255) NOT NULL,
  `data_dodania` varchar(255) NOT NULL,
  `kto` varchar(255) NOT NULL,
  `ilosc_punktow` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `aktywnosc`
--

INSERT INTO `aktywnosc` (`id`, `kategoria`, `data_dodania`, `kto`, `ilosc_punktow`) VALUES
(1, 'AktywnoĹÄ poza zajÄciowa', '2019-04-05', 'Sebastian ZagĂłrski', '10'),
(2, 'AktywnoĹÄ poza zajÄciowa', '2019-04-05', 'Dominik Domanski', '10'),
(3, 'Sprzatanie wozu', '2019-04-06', 'Jakub Centkiewicz', '5'),
(4, 'Sprzatanie wozu', '2019-04-06', 'Kacper Bartnicki', '5'),
(5, 'Sprzatanie wozu', '2019-04-06', 'Sebastian ZagĂłrski', '5'),
(6, 'Sprzatanie wozu', '2019-04-06', 'Dominik Domanski', '5'),
(7, 'AktywnoĹÄ poza zajÄciowa', '2019-04-22', 'Jakub Centkiewicz', '10'),
(8, 'AktywnoĹÄ poza zajÄciowa', '2019-04-22', 'Kacper Bartnicki', '10'),
(9, 'AktywnoĹÄ poza zajÄciowa', '2019-04-22', 'Wiktor Jakubowski', '10'),
(10, 'AktywnoĹÄ poza zajÄciowa', '2019-04-22', 'Sebastian ZagĂłrski', '10'),
(11, 'AktywnoĹÄ poza zajÄciowa', '2019-04-22', 'Dominik Domanski', '10'),
(12, 'AktywnoĹÄ', '2019-04-27', 'Jakub Centkiewicz', '5'),
(13, 'AktywnoĹÄ', '2019-04-27', 'Kacper Bartnicki', '5'),
(14, 'AktywnoĹÄ', '2019-04-27', 'Gabriela ZagĂłrska', '5'),
(15, 'AktywnoĹÄ', '2019-04-27', 'Dominik Domanski', '5'),
(16, 'AktywnoĹÄ', '2019-04-27', 'Sebastian ZagĂłrski', '10'),
(17, 'Quiz', '2019-05-04', 'Jakub Centkiewicz', '5'),
(18, 'Quiz', '2019-05-04', 'Kacper Bartnicki', '5'),
(19, 'Quiz', '2019-05-04', 'Gabriela ZagĂłrska', '5'),
(20, 'Quiz', '2019-05-04', 'Sebastian ZagĂłrski', '5'),
(21, 'Quiz', '2019-05-04', 'Dominik Domanski', '5');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(255) NOT NULL,
  `kategoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`id`, `kategoria`) VALUES
(1, 'AktywnoĹÄ'),
(2, 'Pierwsza pomoc'),
(3, 'Zwijanie wezy'),
(4, 'Quiz'),
(5, 'Sprzatanie wozu'),
(6, 'AktywnoĹÄ poza zajÄciowa'),
(17, 'Musztra'),
(18, 'Zdobywanie rangi');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ksiazka_wyjazdow`
--

CREATE TABLE `ksiazka_wyjazdow` (
  `id` int(255) NOT NULL,
  `rodzaj` varchar(255) NOT NULL,
  `opis` varchar(255) NOT NULL,
  `zdjecie` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `ksiazka_wyjazdow`
--

INSERT INTO `ksiazka_wyjazdow` (`id`, `rodzaj`, `opis`, `zdjecie`, `data`) VALUES
(1, 'Pożar', 'Nasza jednostka została zadysponowana do pożaru budynku mieszkalnego w miejscowości Głazów.  Siły i środki PSP Myślibórz, OSP Ławy, OSP Sulimierz', 'brak', '2019-03-15'),
(2, 'Pożar', 'Nasza jednostka została zadysponowana do pożaru samochodu w miejscowości Ławy. \r\nSiły i środki PSP Myślibórz, OSP Ławy.', 'brak', '2019-03-21'),
(3, 'Pożar', 'Nasza jednostka została zadysponowana do pożaru magazynu butli z gazem w miejscowości Myślibórz.\r\nSiły i środki: PSP Myślibórz, KW PSP Szczecin, OSP Ławy, OSP Sulimierz, OSP Rów , OSP Otanów.', 'brak', '2019-03-22'),
(4, 'Miejscowe zagrożenie', 'Poszukiwanie osoby zaginionej <br>\r\nMiejscowość - Pszczelnik', 'brak', '2019-01-19'),
(5, 'Pożar', 'Pożar garażu w miejscowości Ławy', 'brak', '2019-01-25'),
(6, 'Pożar', 'Pożar domu w miejscowości Kierzków', 'brak', '2019-02-04'),
(7, 'Pożar', 'Pożar stodoły w miejscowości Otanów.', 'brak', '2019-02-04'),
(8, 'Pożar', 'Pożar traw w Ławach.', 'brak', '2019-02-19'),
(9, 'Pożar', 'Pożar stodoły - Myśliborzyce', 'brak', '2019-02-24'),
(10, 'Miejscowe zagrożenie', 'Drzewo na drodze, trasa Ławy - Trzcinna', 'brak', '2019-03-05'),
(11, 'Pożar', 'Głazów pożar budynku mieszkalnego.', 'brak', '2019-03-15'),
(12, 'Miejscowe zagrożenie', 'Ławy', 'brak', '2019-03-20'),
(13, 'Pożar', 'Pożar samochodu - Myślibórz', 'brak', '2019-04-15'),
(14, 'Pożar', 'Pożar samochodu - Ławy', 'brak', '2019-04-17'),
(15, 'Pożar', 'Pożar trawy, Nowogródek', 'brak', '2019-04-17'),
(16, 'Pożar', 'Pożar trawy - Myśliborzyce', 'brak', '2019-04-19'),
(17, 'Pożar', 'Pożar balotów między Kierzkowem a Golenicami', 'brak', '2019-04-20'),
(18, 'Pożar', 'Pożar - trawa przy młodniku ', 'brak', '2019-05-21'),
(19, 'Miejscowe zagrożenie', 'Poszukiwanie zaginionych dziewczynek', 'brak', '2019-06-07');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `memy`
--

CREATE TABLE `memy` (
  `id` int(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `odnosnik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `memy`
--

INSERT INTO `memy` (`id`, `url`, `odnosnik`) VALUES
(1, 'https://osp.pl/memy/uploads/posts/thumbnail/2019/03/59-88024-snickers.jpg', 'https://osp.pl/memy/mem/226-snickers'),
(2, 'https://osp.pl/memy/uploads/posts/thumbnail/2019/02/81-16760-garazowane-i-nie-bite.jpg', 'https://osp.pl/memy/mem/207-garazowane-i-nie-bite'),
(3, 'https://osp.pl/memy/uploads/posts/thumbnail/2019/02/61-12778-palisz.jpg', 'https://osp.pl/memy/mem/195-palisz'),
(4, 'https://osp.pl/memy/uploads/posts/thumbnail/2019/03/272-45880-kocham-tsciowa.jpg', 'https://osp.pl/memy/mem/274-kocham-tsciowa'),
(5, 'https://osp.pl/memy/uploads/posts/thumbnail/2019/03/206-85973-diesel-musi-dymic.jpg', 'https://osp.pl/memy/mem/267-diesel-musi-dymic'),
(6, 'https://osp.pl/memy/uploads/posts/thumbnail/2019/03/173-25102-co-to-sie-stanelo.jpg', 'https://osp.pl/memy/mem/241-co-to-sie-stanelo'),
(7, 'https://osp.pl/memy/uploads/posts/thumbnail/2019/03/172-94484-mietek-do-czego-to-sluzy.jpg', 'https://osp.pl/memy/mem/240-mietek-do-czego-to-sluzy'),
(8, 'https://osp.pl/memy/uploads/posts/thumbnail/2019/03/61-98805-sprzedaz.jpg', 'https://osp.pl/memy/mem/228-sprzedaz'),
(9, 'https://osp.pl/memy/uploads/posts/thumbnail/2019/02/58-24507-pierwsza-strazacka-milosc.jpg', 'https://osp.pl/memy/mem/171-pierwsza-strazacka-milosc'),
(10, 'https://osp.pl/memy/uploads/posts/thumbnail/2019/03/412-27707-sa-rzeczy-wazne-i-wazniejsze.jpg', 'https://osp.pl/memy/mem/276-sa-rzeczy-wazne-i-wazniejsze'),
(11, 'https://osp.pl/memy/uploads/posts/thumbnail/2019/03/423-90542-gdy-spoznisz-sie-do-remizy.jpg', 'https://osp.pl/memy/mem/278-gdy-spoznisz-sie-do-remizy'),
(12, 'https://osp.pl/memy/uploads/posts/thumbnail/2019/03/170-92863-lodka.jpg', 'https://osp.pl/memy/mem/291-lodka');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `obecnosci`
--

CREATE TABLE `obecnosci` (
  `id` int(255) NOT NULL,
  `data_spotkania` varchar(255) NOT NULL,
  `Jakub_Centkiewicz` varchar(255) NOT NULL,
  `Tomasz_Wierucki` varchar(255) NOT NULL,
  `Kacper_Bartnicki` varchar(255) NOT NULL,
  `Kamil_Szurko` varchar(255) DEFAULT NULL,
  `Olivier_Dubicki` varchar(255) DEFAULT NULL,
  `Wiktor_Jakubowski` varchar(255) DEFAULT NULL,
  `Jakub_Czekala` varchar(255) DEFAULT NULL,
  `Bartlomiej_Urbanowski` varchar(255) DEFAULT NULL,
  `Gabriela_ZagĂłrska` varchar(255) DEFAULT NULL,
  `Sebastian_ZagĂłrski` varchar(255) DEFAULT NULL,
  `Dominik_Domanski` varchar(255) DEFAULT NULL,
  `Wojciech_Jakubowski` varchar(255) DEFAULT NULL,
  `Ryszard_Wierucki` varchar(255) DEFAULT NULL,
  `Oliwia_Jakubowska` varchar(255) NOT NULL,
  `Dawid_Bartnicki` varchar(255) NOT NULL,
  `Dawid_Baran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `obecnosci`
--

INSERT INTO `obecnosci` (`id`, `data_spotkania`, `Jakub_Centkiewicz`, `Tomasz_Wierucki`, `Kacper_Bartnicki`, `Kamil_Szurko`, `Olivier_Dubicki`, `Wiktor_Jakubowski`, `Jakub_Czekala`, `Bartlomiej_Urbanowski`, `Gabriela_ZagĂłrska`, `Sebastian_ZagĂłrski`, `Dominik_Domanski`, `Wojciech_Jakubowski`, `Ryszard_Wierucki`, `Oliwia_Jakubowska`, `Dawid_Bartnicki`, `Dawid_Baran`) VALUES
(1, '2018-11-30', '', '', 'Tak', NULL, NULL, NULL, NULL, NULL, 'Tak', NULL, NULL, NULL, NULL, 'Tak', '', NULL),
(2, '2018-12-07', '', '', 'Tak', NULL, 'Tak', NULL, NULL, 'Tak', 'Tak', 'Tak', NULL, NULL, NULL, '', '', NULL),
(3, '2018-12-28', '', '', 'Tak', NULL, NULL, 'Tak', NULL, NULL, NULL, 'Tak', NULL, NULL, NULL, '', '', NULL),
(4, '2019-01-04', 'Tak', '', 'Tak', NULL, NULL, NULL, NULL, NULL, 'Tak', 'Tak', NULL, NULL, NULL, 'Tak', '', NULL),
(5, '2019-01-11', '', '', 'Tak', NULL, 'Tak', NULL, NULL, NULL, 'Tak', 'Tak', NULL, NULL, NULL, '', '', NULL),
(6, '2019-01-12', 'Tak', '', 'Tak', NULL, NULL, NULL, NULL, 'Tak', 'Tak', 'Tak', NULL, NULL, NULL, '', '', NULL),
(7, '2019-01-18', '', '', 'Tak', NULL, NULL, NULL, NULL, 'Tak', 'Tak', 'Tak', NULL, NULL, NULL, '', '', NULL),
(8, '2019-01-25', 'Tak', '', 'Tak', NULL, 'Tak', NULL, NULL, 'Tak', 'Tak', 'Tak', NULL, NULL, NULL, '', '', NULL),
(9, '2019-02-01', '', '', '', NULL, 'Tak', NULL, NULL, 'Tak', 'Tak', 'Tak', NULL, NULL, NULL, '', '', NULL),
(10, '2019-02-08', '', '', 'Tak', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tak', NULL, NULL, '', '', NULL),
(11, '2019-02-23', 'Tak', 'Tak', 'Nie', 'Nie', 'Nie', 'Nie', 'Tak', 'Nie', 'Nie', 'Nie', 'Nie', NULL, NULL, '', '', NULL),
(12, '2019-02-16', '', '', 'Tak', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Tak', NULL, NULL, '', '', NULL),
(13, '2019-03-02', 'Tak', 'Tak', 'Nie', 'Nie', 'Nie', 'Tak', 'Nie', 'Tak', 'Tak', 'Tak', 'Nie', 'Tak', NULL, '', '', NULL),
(14, '2019-03-08', 'Tak', 'Tak', 'Tak', 'Tak', 'Tak', 'Nie', 'Nie', 'Tak', 'Nie', 'Tak', 'Nie', 'Nie', 'Nie', 'Nie', 'Tak', NULL),
(15, '2019-03-09', 'Tak', 'Nie', 'Tak', 'Nie', 'Tak', 'Nie', 'Tak', 'Tak', 'Tak', 'Tak', 'Tak', 'Nie', NULL, '', 'Tak', NULL),
(16, '2019-03-16', 'Tak', 'Tak', 'Nie', 'Nie', 'Nie', 'Nie', 'Nie', 'Nie', 'Nie', 'Nie', 'Tak', 'Nie', 'Nie', 'Nie', 'Tak', NULL),
(17, '2019-03-23', 'Tak', 'Nie', 'Tak', 'Nie', NULL, NULL, NULL, NULL, NULL, 'Tak', 'Tak', 'Nie', NULL, '', '', NULL),
(18, '2019-03-30', 'Tak', '', 'Tak', NULL, NULL, NULL, NULL, NULL, NULL, 'Tak', 'Tak', NULL, NULL, '', '', NULL),
(19, '2019-04-06', 'Tak', '', 'Tak', NULL, NULL, NULL, NULL, NULL, NULL, 'Tak', 'Tak', NULL, NULL, '', '', NULL),
(20, '2019-04-13', 'Tak', '', 'Tak', NULL, 'Nie', 'Nie', NULL, 'Nie', 'Nie', 'Nie', 'Tak', 'Nie', NULL, 'Nie', '', 'Nie'),
(21, '2019-04-22', 'Tak', '', 'Tak', NULL, 'Nie', 'Tak', NULL, 'Nie', 'Nie', 'Tak', 'Tak', 'Nie', NULL, 'Nie', '', 'Nie'),
(22, '2019-04-27', 'Tak', '', 'Tak', NULL, 'Nie', 'Nie', NULL, 'Nie', 'Tak', 'Tak', 'Tak', 'Nie', NULL, 'Nie', '', 'Nie'),
(26, '2019-05-04', 'Tak', '', 'Tak', NULL, 'Nie', 'Nie', NULL, 'Nie', 'Tak', 'Tak', 'Tak', 'Nie', NULL, 'Nie', '', 'Nie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osoby`
--

CREATE TABLE `osoby` (
  `id` int(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `haslo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `ranga` varchar(255) NOT NULL,
  `punkty` int(255) NOT NULL,
  `liczba_obecnosci` int(255) NOT NULL,
  `sort` varchar(255) NOT NULL,
  `opis` varchar(1000) NOT NULL,
  `mdp` int(255) NOT NULL,
  `uprawnienia` int(255) NOT NULL,
  `admin` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `osoby`
--

INSERT INTO `osoby` (`id`, `login`, `haslo`, `email`, `imie`, `nazwisko`, `ranga`, `punkty`, `liczba_obecnosci`, `sort`, `opis`, `mdp`, `uprawnienia`, `admin`) VALUES
(1, 'centkiewiczj', 'e0b46e3a5632cfa4220859d7aaa0ec1f', 'cent7331@gmail.com', 'Jakub', 'Centkiewicz', 'Administrator', 25, 15, 'Koszarowka, Dres, Buty', 'Administrator strony', 1, 1, 1),
(2, 'wieruckit', '3d4fc8a9577cfb8cf7752611956aac0e', 'tomasz.wierucki@gmail.com', 'Tomasz', 'Wierucki', 'Opiekun', 0, 4, 'Koszarowka, Czapka, Koszulka, Dres, Buty', 'Opiekun strony', 0, 0, 1),
(3, 'bartnickik', 'f543a18b3d463905da3cbf7254e4b0e9', 'kacp3rb@wp.pl', 'Kacper', 'Bartnicki', 'Ognik: Strazak Opiekun', 25, 19, '', 'Ognik: Strazak Opiekun', 1, 1, 0),
(4, 'szurkok', '10dc8cfcd83f9b898a5d6d76c2898a28', 'Do ustawienia', 'Kamil', 'Szurko', 'Strazak', 0, 1, '', 'Brak', 0, 1, 0),
(5, 'dubickio', '4b3fb2c7c67a7093e6b7a6c60ee18e5b', 'Do ustawienia', 'Olivier', 'Dubicki', 'Kandydat: Florek', 0, 6, 'Czapka, Koszulka, Dres', 'Brak', 1, 0, 0),
(6, 'jakubowskiw', '9552d14c9205a47d2ef863cb0997eb90', 'Do ustawienia', 'Wiktor', 'Jakubowski', 'Kandydat: Florek', 10, 3, 'Koszulka, Dres', 'Brak', 1, 0, 0),
(7, 'czekalaj', 'f4feb93aad8d59044387daaadf17ae6a', 'Do ustawienia', 'Jakub', 'Czekala', 'Strazak', 0, 2, '', 'Brak', 0, 1, 0),
(8, 'urbanowskib', 'da4131cb22662016df3e95f396d7b042', 'Do ustawienia', 'Bartlomiej', 'Urbanowski', 'Kandydat: Florek', 0, 8, 'Koszulka, Dres', 'Brak', 1, 0, 0),
(9, 'zagorskag', 'e10adc3949ba59abbe56e057f20f883e', 'Do ustawienia', 'Gabriela', 'ZagĂłrska', 'Kandydat: Florek', 10, 12, 'Koszulka, Dres', 'Brak', 1, 0, 0),
(10, 'zagorskis', '2ff65e2f5f6b9c81e452e8584b4426ed', 'Do ustawienia', 'Sebastian', 'ZagĂłrski', 'Kandydat: Florek', 40, 17, 'Koszulka, Dres', 'Brak', 1, 0, 0),
(11, 'domanskid', '759163a8097d95e146d397f47b917f4e', 'Do ustawienia', 'Dominik', 'Domanski', 'Kandydat: Florek', 35, 11, '', 'Brak', 1, 0, 0),
(12, 'jakubowskiwo', 'ca4af945fef15480a83c87a7084a1f41', 'Do ustawienia', 'Wojciech', 'Jakubowski', 'Kandydat: Florek', 0, 1, 'Koszulka, Dres', 'Brak', 1, 0, 0),
(13, 'wieruckir', '15813269324387ff88e081c821fe6814', 'Do ustawienia', 'Ryszard', 'Wierucki', 'Dowodca', 0, 0, '', 'Brak', 0, 0, 0),
(14, 'jakubowskao', '8ba3c26e1cccaac14192c4d58d0f1ac0', 'Do ustawienia', 'Oliwia', 'Jakubowska', 'Kandydat: Florek', 0, 2, '', 'Brak', 1, 0, 0),
(15, 'bartnickid', 'ad75b14c1dfb7ce20dfd83c87f27dc3c', 'Do ustawienia', 'Dawid', 'Bartnicki', 'Strazak', 0, 3, '', 'Brak', 0, 1, 0),
(16, 'barand', 'ad75b14c1dfb7ce20dfd83c87f27dc3c', 'Do ustawienia', 'Dawid', 'Baran', 'Kandydat: Florek', 0, 0, '', 'Brak', 1, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posty`
--

CREATE TABLE `posty` (
  `id` int(255) NOT NULL,
  `tytul` varchar(255) NOT NULL,
  `tresc` varchar(1000) NOT NULL,
  `zdjecie` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `aktualne` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `posty`
--

INSERT INTO `posty` (`id`, `tytul`, `tresc`, `zdjecie`, `data`, `aktualne`) VALUES
(1, 'Zebranie', 'Zarząd Ochotniczej Straży Pożarnej w Ławach informuje, że w dniu 09.03.2019 r. (sobota) o godzinie 17. 00 w Świetlicy wiejskiej w Ławach odbędzie się Zebranie Sprawozdawcze za 2018 rok. ', '../img/posty/5c855dc69bba63.57159615.png', '2019-03-03', 1),
(2, 'Zebranie sprawozdawcze za rok 2018', 'Dnia 09.03.2019 r. w Świetlicy wiejskiej odbyło się Walne Zebranie Sprawozdawcze za 2018 r. Ochotniczej Straży Pożrnej w Ławach .\r\n\r\nSerdeczne podziękowania dla Stowarzyszenia Przyjaciół Ław za przygotowany poczęstunek.', '../img/posty/5c855e028b0121.23604880.jpg', '2019-03-10', 1),
(3, 'OstrzeĹźenie Pogodowe', 'Ostrzenie pogodowe dotyczÄce silnych wiatrĂłw.', '../img/posty/5c8b99e69e7180.05708828.png', '2019-03-15', 0),
(4, 'Plebiscyt na JednostkÄ Roku', 'Witamy serdecznie w zwiÄzku z nominacjÄ naszej jednostki w plebiscycie Jednostka Roku 2018, prosimy o wsparcie nas w tym konkursie za pomocÄ Waszych gĹosĂłw. Pozdrawiamy OSP Ĺawy.\r\nLink do plebiscytu <a href=\"https://gs24.pl/p/kandydat/osp-lawy%2C509871/#sms-plebiscyty\" target=\"_blank\">LINK</a>', '../img/posty/5c9682ad51cc07.46904051.png', '2019-03-23', 0),
(5, 'Szkolenie BHP', 'Dnia 30.03.2019 o godz. 9 w budynku 1 Maja odbedzie sie szkolenie BHP dla strazakow OSP Lawy', 'brak', '2019-03-27', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rangi`
--

CREATE TABLE `rangi` (
  `id` int(255) NOT NULL,
  `ranga` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `rangi`
--

INSERT INTO `rangi` (`id`, `ranga`) VALUES
(1, 'Kandydat: Florek'),
(2, 'Kandydat: Wojtek'),
(3, 'Kandydat: Strazak Sam'),
(4, 'Kandydat: Zarek'),
(5, 'Iskierka: Lacznik zwiadowca'),
(6, 'Iskierka: Znawca zasad przeciwpozarowych'),
(7, 'Iskierka: Pomocnik strazaka'),
(8, 'Iskierka: Specjalista podrecznego sprzetu gasniczego'),
(9, 'Plomyk: Ratownik'),
(10, 'Plomyk: Organizator pracy sportowej'),
(11, 'Plomyk: Przodownik wyszkolenia pozarniczego'),
(12, 'Plomyk: Organizator pracy prewencyjnej'),
(13, 'Ognik: Strazak technik'),
(14, 'Ognik: Strazak mechanik'),
(15, 'Ognik: Strazak animator'),
(16, 'Ognik: Strazak Opiekun');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `aktywnosc`
--
ALTER TABLE `aktywnosc`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `ksiazka_wyjazdow`
--
ALTER TABLE `ksiazka_wyjazdow`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `memy`
--
ALTER TABLE `memy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `obecnosci`
--
ALTER TABLE `obecnosci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `osoby`
--
ALTER TABLE `osoby`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `posty`
--
ALTER TABLE `posty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `rangi`
--
ALTER TABLE `rangi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `aktywnosc`
--
ALTER TABLE `aktywnosc`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `ksiazka_wyjazdow`
--
ALTER TABLE `ksiazka_wyjazdow`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `memy`
--
ALTER TABLE `memy`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `obecnosci`
--
ALTER TABLE `obecnosci`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT dla tabeli `osoby`
--
ALTER TABLE `osoby`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT dla tabeli `posty`
--
ALTER TABLE `posty`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `rangi`
--
ALTER TABLE `rangi`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
