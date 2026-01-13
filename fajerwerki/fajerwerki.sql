-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 15, 2024 at 04:22 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fajerwerki`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `kod_koszyka` int(11) NOT NULL,
  `kod_produktu` varchar(15) NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `koszyk`
--

INSERT INTO `koszyk` (`kod_koszyka`, `kod_produktu`, `ilosc`) VALUES
(1468164588, 'JW6021', 2),
(1468164588, 'FP3-10', 1),
(1468164588, '5056', 2),
(2007801300, 'JW6021', 2),
(2007801300, 'TXF543-8', 7),
(2007801300, ' XT1012', 4),
(1190179828, 'JW6021', 2),
(1190179828, 'IC50-16-2', 4),
(1190179828, 'ECO-L20-3', 1),
(1190179828, 'CLE0209', 3),
(1951910228, 'P3405', 1),
(1997388855, 'TXF543-8', 2),
(122786095, 'P3405', 1),
(368100451, 'P3405', 1),
(756112159, ' XT1012', 7),
(1780211416, 'TXF543-8', 1),
(1067159009, 'P3405', 1),
(370937294, 'TXF543-8', 1),
(1122076389, 'TXF543-8', 1),
(1056789270, 'IC50-16-2', 16),
(1506901240, 'ECO-L25-3', 1),
(1506901240, ' XT1012', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `kod_produktu` varchar(15) NOT NULL,
  `nazwa` varchar(63) NOT NULL,
  `producent` varchar(15) NOT NULL,
  `kategoria` varchar(15) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `obnizka` int(2) NOT NULL,
  `stan_magazynowy` int(11) NOT NULL,
  `opis` varchar(255) NOT NULL,
  `ilosc_strzalow` int(11) DEFAULT NULL,
  `kaliber` int(11) DEFAULT NULL,
  `certyfikat` varchar(15) NOT NULL,
  `zdjecie` varchar(63) NOT NULL,
  `link_yt` varchar(63) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `produkty`
--

INSERT INTO `produkty` (`kod_produktu`, `nazwa`, `producent`, `kategoria`, `cena`, `obnizka`, `stan_magazynowy`, `opis`, `ilosc_strzalow`, `kaliber`, `certyfikat`, `zdjecie`, `link_yt`) VALUES
(' XT1012', 'Fontanna estradowa', 'Triplex', 'wulkany', 20.00, 50, 256, 'Pirotechniczny punkt świetlny. Czas 1s. Dolot 7m. Cena za 1szt. Posiada certyfikat CE kl.T1.', NULL, NULL, 'T1', 'XT1012.jpg', NULL),
('5056', 'Crazy Whistler', 'Jorge', 'wulkany', 48.00, 0, 152, 'Importer: Wolff\r\n\r\nNEC: 90g\r\n\r\nDolot: 3m około \r\n\r\nKlasa ADR: 1.4G', NULL, NULL, 'F2', '5056.jpg', 'https://www.youtube.com/embed/NL1ZveyGMNk?si=Eni50yAaOhkTHDNH'),
('CLE0209', 'Mini Pirat CLE0209 F2', 'SRPYRO', 'petardy', 3.00, 10, 454, 'Małe petardy. Cena za opakowanie 20 sztuk. Posiadają certyfikat CE F2.', NULL, NULL, 'F2', 'CLE0209.png', NULL),
('CLE4211', 'Fonntana + 8s', 'SRPYRO', 'wulkany', 26.00, 0, 69, '', NULL, NULL, '', 'CLE4211.jpg', NULL),
('CLE7035B', 'Hooligans Blue CLE7035B T1 20/5', 'SRPYRO', 'dymy', 69.00, 0, 69, 'Race świetlne - niebieski światło z białym dymem. Czas efektu ok. 60 sekund. Cena za opakowanie 5szt. Posiada certyfikat CE kat. T1.', NULL, NULL, 'T1', 'CLE7035B.jpg', NULL),
('CLE7036G', 'Smoke TS-40 Green CLE7036G P1 20/5', 'SRPYRO', 'dymy', 22.00, 0, 425, 'Fonatnna dymna w kolorze zielonym. Czas efektu 40 sec. Cena za 1 sztukę. Posiada certyfikat CE P1.', NULL, NULL, 'P1', 'CLE7036G.jpg', 'https://www.youtube.com/embed/a2EnPOev3mQ?si=a1vGHw1JEdtRKnWx'),
('CLE7036R', 'Smoke TS-40 Red ', 'SRPYRO', 'dymy', 29.00, 0, 598, 'Fonatnna dymna w kolorze czerwonym. Czas efektu 40 sec. Cena za 1 sztukę.', NULL, NULL, 'P1', 'CLE7036R.jpg', 'https://www.youtube.com/embed/a2EnPOev3mQ?si=TKbFBhTwyqzxrCDQ'),
('CLE7037P', 'CLE7037P Świeca dymna Smoke 90 duża fioletowa', 'SRPYRO', 'dymy', 20.00, 0, 35, 'Dym odpalany za pomocą draski załączoną w produkcie, czas trwania efektu 90 sekund.', NULL, NULL, 'F2', 'CLE7037P.png', 'https://www.youtube.com/embed/2JnLDPTaf3U?si=eClPE3t9WiaY2afW'),
('ECO-L20-3', 'Ibiza Eco 20s ECO-L20-3 F2', 'Gaoo', 'wyrzutnie', 120.00, 0, 144, 'Bateria z serii Eco 20 strzałów. Kaliber 30mm. Dolot 60m. NEC 496g. Czas trwania 30 sek. Posiada certyfikat F2.', 20, 30, 'F2', 'ECO-L20-3.png', 'https://www.youtube.com/embed/Kq0zotdcSBU?si=7_Mt5BMS9_4uQHoE'),
('ECO-L25-3', 'Green Town Eco 25s F2 6/1', 'Gaoo', 'wyrzutnie', 139.00, 0, 160, 'Bateria z serii Eco 25 strzałów. Kaliber 30mm. Dolot 60m. NEC 500g. Czas trwania 35 sek. Posiada certyfikat F2.', 25, 30, 'F2', 'ECO-L25-3.png', 'https://www.youtube.com/embed/AHIWGaz-0Cg?si=QSJsyJ-nprEfWpA2'),
('FC1303', 'Wulkan 1kg FC1303 Multicolor F3', 'Jorge', 'wulkany', 50.00, 4, 35, 'Fontanna stożkowa 1kg. Czas 60s. Wysokość efektu 7m. Kaliber 13\" Cena za 1 sztukę Posiada certyfikat CE kat.3', NULL, NULL, 'F3', 'FC1303.png', 'https://www.youtube.com/embed/FGr6R6oU4XQ?si=of-8PrcfsgRI7-rk'),
('FP3-10', 'FP3 Original F3', 'Jorge', 'petardy', 7.00, 0, 3654, 'Głośna petarda. NEC 0,8g. Cena za opakowanie 10 sztuk. Posiada certyfikat CE F3.', NULL, NULL, 'F3', 'FP3-10.png', NULL),
('H1K', 'Krachmen small H1 F3', 'Gaoo', 'petardy', 17.00, 0, 7343, 'Małe i głośne patardy. Cena za opakowanie 30szt. NEC 27g. Posiada cetyyfikat CE kl.3.', NULL, NULL, 'F3', 'H1K.png', NULL),
('IC50-16-2', 'Magik 16s 2\" F3 3/1\n', 'Iskra', 'wyrzutnie', 280.00, 0, 16, 'Średniej wielkości bateria 16 strzałów. Kaliber 50mm. Posiada certyfikat CE F3', 16, 50, 'F3', 'IC50-16-2.png', 'https://www.youtube.com/embed/HiLEBL6uGWA?si=KIGOgxblxBxrHJWI'),
('JW37', 'Go Go Dance Fontanna JW37 F2 ', 'Jorge', 'wulkany', 50.00, 10, 645, 'SREBRNA FONTANNA Z ZIELONYMI GWIAZDKAMI + CRACKLING Z CZERWONYMI GWIAZDKAMI; ZŁOTA FONTANNA, CZERWONE, ZIELONE GWIAZDKI; TRZESZCZĄCE CHRYZANTEMY + ŻÓŁTE GWIAZDKI, CRACKLING. POSIADA CERTYFIKAT CE F2.', NULL, NULL, 'F2', 'JW37.png', 'https://www.youtube.com/embed/bS2KpRjFecY?si=BXi7-VhAeCKdAqbR'),
('JW6021', 'Tajfun 49s JW6021 F3', 'Jorge', 'wyrzutnie', 300.00, 20, 2, 'Duża bateria 49 strzałów. Czas 30s. Kaliber 30mm. Posiada certyfikat CE kat.3', 49, 30, 'F3', 'JW6021.png', 'https://www.youtube.com/embed/g6rhLVOsFoU?si=11ej_YiyjTboEMH-'),
('JW817', 'Space Line I 64s F2 4/1\n', 'Jorge', 'wyrzutnie', 169.00, 0, 12, 'Średniej wielkości wyrzutnia 64 strzały. Kaliber 20mm. Posiada certyfikat CE F2', 64, 20, 'F2', 'JW817.png', 'https://www.youtube.com/embed/GydvR7ymTas?si=cEWoaMQ6HoEyhH0u'),
('P0003A', 'Żuki P0003A F2', 'MAGICTIME', 'petardy', 5.55, 0, 3445, 'Małe, głośne petardy na lont, NEC 55g, cena za opakowanie 10 sztuk. Posiada certyfikat CE kat.2', NULL, NULL, 'F2', 'P0003A.png', NULL),
('P1001', 'P1001 Srebrna Piratka', 'Maxsem', 'petardy', 3.87, 0, 642, 'Bardzo głośny huk! Nec :60g na opakowanie! 20 szt. w opakowaniu.', NULL, NULL, 'F3', 'P1001.png', NULL),
('P3405', 'Orizaba', 'MAGICTIME', 'wulkany', 86.00, 15, 59, 'Czas działania: około 60sekund. ', NULL, NULL, 'F2', 'P3405.jpg', NULL),
('P6A14F3(R)', 'Dum Bum red P6A14F3(R) F3', 'Klasek', 'petardy', 14.00, 0, 532, 'Petardy hukowe lontowe z czerwonym błyskiem, głośność 117dB z 15 m. Cena za opakowanie 30 szt. Produkt posiada certyfikat bezpieczeństwa CE. kat. F3.', NULL, NULL, 'F3', 'P6A14F3(R).jpg', NULL),
('SFC206H01', 'Knockout 62s SFC206H01 F3 ', 'Iskra', 'wyrzutnie', 180.00, 2, 14, 'Średniej wielkości wyrzutnia 62 strzały. Kaliber 20 i 20 mm. Posiada certyfikat CE F3.', 62, 20, 'F3', 'SFC206H01.png', 'https://www.youtube.com/embed/zhojJOwQVt0?si=zq-jBSo0xlnK2w4t'),
('TC15 ', 'Piratka TC15 F3', 'Tropic', 'petardy', 8.00, 0, 37, 'Małe, głośne petardy. Cena za opakowanie 20 sztuk. Posiada certyfikat CE F3.', NULL, NULL, 'F3', 'TC15.png', NULL),
('TF21', 'Dym Pomarańczowy TF21 P1 25/4', 'Tropic', 'dymy', 39.00, 0, 15, 'Dym TF21. Kolor pomarańczowy. Cena za opakowanie 4szt. Posiada certyfiakt CE P1.', NULL, NULL, 'P1', 'TF21.jpg', NULL),
('TXB041', 'Illusion 25s TXB041 F2', 'TRIPLEX', 'wyrzutnie', 40.00, 5, 77, 'Średnia bateria 25 strzałów. Czas 25s. Dolot 25m. Kaliber 20mm. NEC 187,5g. Posiada certyfikat CE kl.2', 25, 20, 'F2', 'TXB041.png', 'https://www.youtube.com/embed/UWow4EEX47s?si=YfHRKzN_9nuQyjnG'),
('TXF543-1', 'Smoke Bombs Red TXF543-1 T1 20/5', 'TRIPLEX', 'dymy', 86.00, 14, 87, 'Świeca dymna czerwona. Czas ekspozycji 60 sekund. NEC 140g. Cena za opakowanie 5szt. Posiada certyfikat CE kat. T1.', NULL, NULL, 'T1', 'TXF543-1.png', 'https://www.youtube.com/embed/M1yPvoBRjXM?si=2VnmsMI6ePZ7UIfH'),
('TXF543-8', 'Smoke Bombs Black TXF543-8 T1 20/5', 'TRIPLEX', 'dymy', 86.00, 14, 124, 'Świeca dymna czarna. Czas ekspozycji 60 sekund. NEC 140g. Cena za opakowanie 5szt. Posiada certyfikat CE kat. T1.', NULL, NULL, 'T1', 'TXF543-8.png', NULL),
('TXF799', 'Smoke Attack mix TXF799 T1 40/5', 'TRIPLEX', 'dymy', 22.00, 5, 45, 'Zestaw wielokolorowych fontann dymnych. Czas 45s. NEC 74g. Cena za opakowanie 5 sztuk. Posiada certyfikat CE T1', NULL, NULL, 'T1', 'TXF799.png', NULL),
('TXF822', 'Santoryn', 'Triplex', 'wulkany', 32.00, 5, 123, 'Ilość szt. w opakowaniu: 1\r\n\r\nNEC: 190g\r\n\r\nCzas efektu: +/- 35sek. \r\n\r\nKlasa ADR: 1.4G ', NULL, NULL, 'F2', 'TXF822.jpg', 'https://www.youtube.com/embed/B8xj90wf2ZQ?si=aWWstkAhOCSEwthU'),
('TXP001A', 'FBI TXP001A F3', 'TRIPLEX', 'petardy', 15.99, 0, 123, 'Bardzo duże i głośne petardy na lont, cena za opakowanie 5 sztuk. Posiada certyfikat CE kat.3', NULL, NULL, 'F3', 'TXP001A.png', NULL),
('ZBS301', 'Scream Bum Szakal 12s ZBS301 F2', 'Scream Bum', 'wyrzutnie', 34.00, 0, 2137, 'Gwiżdżąca wyrzutnia, kaliber 20mm. 12 wystrzałów. Cena za 1 sztukę. Produkt posiada certyfikat CE kat. F2', 12, 20, 'F2', 'ZBS301.png', 'https://www.youtube.com/embed/NySEq9_QfRc?si=ck3HlGpjIWlUQOHR');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`kod_produktu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
