-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Cze 2022, 20:03
-- Wersja serwera: 10.4.18-MariaDB
-- Wersja PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `teashop`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dostawy`
--

CREATE TABLE `dostawy` (
  `iddostawa` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL,
  `cena` decimal(6,2) NOT NULL,
  `szacowany_czas` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `dostawy`
--

INSERT INTO `dostawy` (`iddostawa`, `nazwa`, `cena`, `szacowany_czas`) VALUES
(1, 'kurier InPost', '17.00', 2),
(2, 'kurier DPD', '15.00', 4),
(3, 'kurier Pocztex Poczta Polska', '13.00', 6),
(4, 'kurier DHL', '25.00', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `idkategoria` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`idkategoria`, `nazwa`) VALUES
(1, 'herbata'),
(2, 'zioła'),
(3, 'herbata zielona'),
(4, 'herbata czarna'),
(5, 'na dobry sen'),
(6, 'herbata czerwona'),
(7, 'herbata turkusowa'),
(8, 'herbata japońska'),
(9, 'herbata chińska'),
(10, 'yerba mate'),
(14, 'konopie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie_produkty`
--

CREATE TABLE `kategorie_produkty` (
  `idprodukt` int(11) NOT NULL,
  `idkategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kategorie_produkty`
--

INSERT INTO `kategorie_produkty` (`idprodukt`, `idkategoria`) VALUES
(6, 1),
(6, 7),
(6, 9),
(19, 2),
(19, 5),
(27, 2),
(27, 10),
(12, 1),
(12, 4),
(4, 1),
(4, 3),
(4, 9),
(9, 1),
(9, 3),
(22, 2),
(33, 1),
(33, 7),
(33, 9),
(18, 1),
(18, 4),
(18, 9),
(17, 2),
(17, 5),
(17, 10),
(28, 4),
(28, 8),
(29, 1),
(29, 3),
(29, 9),
(23, 1),
(23, 5),
(23, 9),
(20, 1),
(20, 7),
(35, 1),
(35, 6),
(32, 2),
(10, 1),
(10, 3),
(10, 8),
(2, 1),
(2, 3),
(2, 8),
(26, 2),
(34, 10),
(30, 2),
(30, 10),
(31, 1),
(31, 4),
(31, 9),
(37, 1),
(37, 7),
(25, 1),
(25, 6),
(25, 9),
(36, 2),
(36, 5),
(16, 2),
(16, 10),
(7, 2),
(7, 10),
(24, 1),
(24, 4),
(3, 2),
(3, 5),
(14, 2),
(11, 2),
(15, 2),
(8, 2),
(8, 10),
(5, 1),
(5, 6),
(5, 9),
(1, 1),
(1, 4),
(21, 1),
(21, 5),
(21, 6),
(40, 4),
(40, 14),
(39, 1),
(41, 14);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `platnosci`
--

CREATE TABLE `platnosci` (
  `idplatnosc` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL,
  `czy_dostepny` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `platnosci`
--

INSERT INTO `platnosci` (`idplatnosc`, `nazwa`, `czy_dostepny`) VALUES
(1, 'blik', 1),
(2, 'przelew tradycyjny', 1),
(3, 'przelew bankowy', 0),
(5, 'płatność przy odbiorze', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `idprodukt` int(11) NOT NULL,
  `nazwa` varchar(40) NOT NULL,
  `opis` varchar(1000) DEFAULT NULL,
  `cena` decimal(6,2) NOT NULL,
  `na_stanie` int(11) NOT NULL,
  `czy_dostepny` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`idprodukt`, `nazwa`, `opis`, `cena`, `na_stanie`, `czy_dostepny`) VALUES
(1, 'Basilur Earl Grey', 'Bardzo smaczna, z bergamotką, polecam.', '9.99', 3, 1),
(2, 'Moya Matcha Luksusowa', 'Moya Matcha Luksusowa to najwyższej jakości sproszkowana zielona herbata matcha. Posiada pełny smak umami intensywną zieloną barwą i kremową konsystencję. Idealnie nadaje się do ceremonii herbacianej i przygotowywania w tradycyjnej formie. Pozyskuje się ją wyłącznie z pierwszego zbioru świeżych liści krzewów, które dojrzewają pod specjalnymi matami, które chronią je od słońca. Dzięki temu liście uzyskują wyższą zawartość chlorofilu i l-teaniny i nabierają niezwykle intensywnego zielonego koloru. Jedynie najdrobniejsze liście krzewów zielonej herbaty są selekcjonowane do przygotowania herbaty Moya Matcha Luksusowa a sam proces produkcji matchy jest niezwykle skomplikowany i czasochłonny.', '80.00', 255, 1),
(3, 'XYZ Melisa', 'Dobre na spanko.', '5.50', 8, 0),
(4, 'ECOBLIK Gunpowder', 'Starannie uformowane małe kuleczki zielonej herbaty, po zalaniu ciepłą wodą, pięknie się rozwiną i wydzielą słodko-gorzki smak i naturalny, czasem lekko dymny zapach. ', '21.50', 12, 1),
(5, 'Basilur Pu-Erh', 'Podstawowej jakości dojrzała herbata z prowincji Yunnan, ceniona za swoje właściwości pro-zdrowotne i charakterystyczny, ziemisty smak.\r\nDaje ciemnobrunatny i „gęsty” napar oraz intensywny ziemisty smak. Jako młoda herbata typu shu ma jeszcze charakterystyczne nuty zapachowe, niektórym kojarzące się z sadzawką lub rybą, nazywane w żargonie herbacianym dui wei.', '18.99', 26, 1),
(6, 'Basilur Milk Oolong', 'Herbata Basilur Bouquet White Magic to klasyczna herbata Milk Oolong w pięknym wydaniu. Herbata znana jest nie tylko z ciekawego, niepowtarzalnego smaku, który odznacza się mlecznym, kremowym aromatem i smakiem, ale wspaniale wpływa też na naszą skórę i zatrzymuje procesy starzenia.', '25.00', 0, 0),
(7, 'Verde Mate Green Mas IQ', 'Pobudzenie, moc prozdrowotnych składników, wspaniały smak i aromat. Verde Mate Más IQ jest kompozycją perfekcyjną w każdym calu. Nic innego nie działa tak jak ona! Poza zieloną brazylijską mate z dzikiej leśnej uprawy zawiera wyciąg z gingko biloba i żeń-szeń. Znajdziemy tu także skórkę pomarańczy oraz słodkie fragmenty ananasa. Kompozycję zamyka guarana. Verde Mate Mas IQ jest chętnie wybierana przez studentów, uczniów i inne osoby pracujące umysłowo.', '29.99', 26, 1),
(8, 'Yaguar Elaborada con Palo', 'Yaguar to najwyższej jakości yerba mate produkowana zgodnie z wielowiekową południowoamerykańską tradycją. Powstaje z ostrokrzewu uprawianego w zróżnicowanym ekosystemie bez użycia pestycydów, sztucznych nawozów i innych chemicznych środków ochrony roślin. Po zbiorach, listki i patyczki poddawane są tradycyjnemu procesowi suszenia z wykorzystaniem dymu. Yaguarowi daleko jednak do produktów znanych z silnie goryczkowych akcentów. Wszystko za sprawą długiego okresu sezonowania (leżakowania), który wynosi aż 18 miesięcy. Susz nabiera wtedy szlachetności, a różnorodne elementy roślinne idealnie się harmonizują. Mimo łagodnego smaku, yerba cechuje się wysoką zawartością naturalnej kofeiny.', '24.90', 6, 1),
(9, 'ECOBLIK Sencha', 'Sencha jest najbardziej charakterystyczną dla Japonii herbatą. Po zbiorze liście w celu zatrzymania utleniania podgrzewane są parą wodną, w przeciwieństwie do chińskich herbat zielonych, które podgrzewane są w piecach i na wokach. Skutkuje to świeżym smakiem z nutami morskimi, owoców tropikalnych i umami (w przypadku herbat wysokiej jakości). Następnie liście są suszone gorącym powietrzem, sortowane, ostatecznie suszone na podgrzewanych stołach i formowane w kształt igiełek.', '21.99', 20, 1),
(10, 'Moya Genmaicha', 'Genmaicha (玄米茶) to słodka, lekko orzechowa i aromatyczna herbata o intrygującym rdzawym odcieniu. Jej smak, znany z sushi barów i japońskich restauracji, zapada w pamięć na długo. Legenda głosi, że sługa shoguna z Hakone, podał swojemu panu herbatę, do której wpadły mu, trzymane w kieszeni, skradzione ziarenka ryżu. Swój błąd sługa przypłacił życiem, ale shogunowi smak naparu tak przypadł do gustu, że postanowił wprowadzić nową herbatę do swojego menu  na stałe . Tak powstała Genmaicha, zwana dziś także “popcorn tea”. Dawniej uważana za napój klas niższych, którzy by zwiększyć objętość czystej senchy, dodawali do liści dużo tańsze ziarenka ryżu. Moya Genmaicha pochodzi z organicznych upraw na wyspie Kiusiu.', '45.00', 3, 1),
(11, 'XYZ Rooibos', 'Rooibos Złoto Tybetu to bezteinowy napój stworzony na bazie liści czerwonokrzewu afrykańskiego z dodatkiem ciekawych składników: owoców goji, bławatka i szafranu.Napar Rooibos Złoto Tybetu ma słodki, kwiatowy smak i ciekawy aromat. Dzięki brakowi teiny Rooibosa można pić przez cały dzień.', '11.25', 3, 1),
(12, 'ECOBLIK Darjeeling', 'Krzewy tej herbaty rosną na plantacjach położonych powyżej 2000 m.n.p.m. u podnóży indyjskich Himalajów.\r\n\r\nKlimat charakteryzujący ten wysoko położony dystrykt sprawia, że rosnące tam herbaty zyskują unikalny bukiet smakowy - wyrazisty i zarazem delikatny o kwiatowym aromacie. To jedna z najbardziej popularnych i pożądanych herbat na całym świecie - nazywana przez koneserów szampanem wśród herbat.', '29.90', 2, 1),
(14, 'XYZ Mięta', 'Miętowa mięta, nic szczególnego. Dobra na brzuszek.', '7.99', 5, 1),
(15, 'XYZ Skrzyp', 'Dobry na wypadanie włosów.', '10.50', 2, 1),
(16, 'Verde Mate Detox', 'Yerba, tak.', '20.99', 1, 0),
(17, 'Exercit ad lebero.', 'Est similique quo facilis enim quis ea esse. Enim aut quidem praesentium. Dolorem ratione consectetur et aut. Expedita optio saepe sapiente cumque voluptate et velit.', '17.00', 15, 1),
(18, 'Exercitationem ad libero.', 'Est similique quo facilis enim quis ea esse. Enim aut quidem praesentium. Dolorem ratione consectetur et aut. Expedita optio saepe sapiente cumque voluptate et velit.', '17.00', 15, 1),
(19, 'Dignissimos ea corrupti non.', 'Minus quia sunt voluptatem voluptas. Maxime a sit occaecati consectetur ipsam. Enim iure amet nobis eius.', '14.09', 8, 0),
(20, 'Laboriosam dolorum modi incidunt.', 'Velit sed et eius amet vitae ad dolor. Vitae dignissimos tempore assumenda quisquam beatae nihil. Consequuntur animi aut neque omnis. Nostrum illum excepturi consequuntur dolores nesciunt qui tempora.', '86.21', 5, 0),
(21, 'Aliquid consequuntur.', 'Non beatae nulla nesciunt labore quod. Nesciunt est consectetur odio sed laboriosam et optio. Unde quia sint corrupti molestias dolores omnis. Deleniti impedit eaque voluptates cumque recusandae.', '42.20', 13, 0),
(22, 'Eum ut voluptatibus.', 'Voluptatibus molestiae ut recusandae dignissimos. Aut velit rem dolor consequatur et est labore. Blanditiis cum odio facilis aut corrupti autem dolor. Alias autem ad non aut soluta.', '78.00', 0, 0),
(23, 'Hic ab voluptatem at.', 'Odio tenetur quos libero qui. Quisquam sint dolores ullam esse qui adipisci perferendis. Dolores sed quisquam dolores. Ex rerum totam velit qui et doloremque aut.', '19.28', 10, 1),
(24, 'Voluptatum odit quia hic.', 'Occaecati ipsam architecto eveniet. Libero repudiandae error consequatur vel sit commodi. Et autem et qui ratione.', '29.61', 10, 0),
(25, 'Sit consequatur autem.', 'In labore reprehenderit similique delectus exercitationem. Eum nobis aut ratione ut sapiente. Repudiandae velit tempora rerum ea molestias. Natus sint sed quibusdam harum incidunt.', '48.54', 4, 1),
(26, 'Nesciunt praesentium voluptate.', 'Quis et dolorem est. Eius cupiditate similique odio minima. Autem deserunt qui deleniti. Autem magnam debitis ut expedita veniam atque.', '83.48', 17, 1),
(27, 'Dolore quia deserunt.', 'Ut suscipit nihil numquam. Ea similique labore laboriosam explicabo natus est. Dolor accusantium ea non maxime inventore enim officia aut.', '21.56', 5, 1),
(28, 'Explicabo voluptatum rem.', 'Tempora velit voluptates nihil. Laudantium tenetur deleniti animi omnis esse est. Consequuntur voluptas ad ratione vel.', '12.72', 13, 1),
(29, 'Fuga ab nobis dolor.', 'Sint a repudiandae possimus explicabo soluta fugit. Non dolores laborum ipsum facilis. Quos velit nulla libero dolorem incidunt voluptatem enim. Nihil totam sed nam ut.', '43.22', 15, 1),
(30, 'Quibusdam occaecati.', 'Perspiciatis minus minima odit. Accusamus blanditiis non quae sit cupiditate consequatur aliquid. Ea sint velit iusto repudiandae voluptas.', '29.00', 11, 1),
(31, 'Quidem ipsum culpa consequatur.', 'Ipsam accusamus ex sequi mollitia eaque. Et qui a earum autem quia sed explicabo. Voluptas fugit libero ipsam necessitatibus possimus expedita ut. Quia nihil magnam error facere.', '80.73', 11, 0),
(32, 'Mollitia consequatur facere.', 'Qui dolor ut aut quos suscipit. Nesciunt maxime odio ut error alias. Aut et ratione ex ea quia qui repellendus a.', '75.80', 12, 1),
(33, 'Eveniet voluptatem quisquam.', 'Aut adipisci tenetur eum enim ipsum doloribus facilis. Et et neque incidunt molestiae occaecati. Ut labore consequatur asperiores voluptatibus.', '37.71', 12, 1),
(34, 'Numquam quasi doloribus.', 'Quos quibusdam magnam praesentium qui blanditiis quasi culpa non. Laboriosam in ut ut eius omnis. Nemo quod aut nemo sed dolore.', '69.58', 18, 0),
(35, 'Laborum nulla nisi nihil.', 'Vitae consequuntur voluptas et veritatis delectus sapiente nobis. Doloribus vel necessitatibus et quisquam. Nobis excepturi a assumenda alias perferendis sunt. Corporis quis aut ipsam ad.', '72.15', 9, 1),
(36, 'Temporibus dolores cum sed.', 'Iste error ut est aut id earum. Quos beatae nostrum dolor eveniet. Tempore sint quas repellat sit.', '40.90', 20, 0),
(37, 'Saepe sint molestiae rem.', 'Culpa nam error qui tempora vel nobis id vel. Est quisquam libero amet sequi aut quia sunt. Quia ut et excepturi minima. Voluptatem odit est voluptas voluptatibus rerum saepe iusto.', '64.65', 7, 0),
(39, 'test', 'fajny opis', '5.55', 10, 0),
(40, 'Sir Adalberts Tea Cannabis Tea', 'Więcej tu konopi niż czarnej herbaty...', '9.55', 3, 1),
(41, 'Pyrki', 'guyfykfyh', '15.24', 255, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `role`
--

CREATE TABLE `role` (
  `idrola` int(11) NOT NULL,
  `nazwa` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `role`
--

INSERT INTO `role` (`idrola`, `nazwa`) VALUES
(1, 'klient'),
(2, 'administrator'),
(3, 'sprzedaż'),
(4, 'magazyn');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `statusy`
--

CREATE TABLE `statusy` (
  `idstatus` int(11) NOT NULL,
  `nazwa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `statusy`
--

INSERT INTO `statusy` (`idstatus`, `nazwa`) VALUES
(1, 'nieopłacone'),
(2, 'kompletowanie'),
(3, 'wysłane'),
(4, 'doręczono');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `iduzytkownik` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `haslo` varchar(20) NOT NULL,
  `idrola` int(11) NOT NULL,
  `nr_telefonu` varchar(12) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `imie` varchar(20) NOT NULL,
  `nazwisko` varchar(30) NOT NULL,
  `data_rejestracji` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`iduzytkownik`, `login`, `haslo`, `idrola`, `nr_telefonu`, `email`, `imie`, `nazwisko`, `data_rejestracji`) VALUES
(1, 'admin', 'admin', 2, NULL, 'admin@herbacianyzakatek.pl', '', '', NULL),
(2, 'pzajaczkowska', 'haslo', 3, '000000000', 'kontakt@herbacianyzakatek.pl', 'Patrycja', 'Zajączkowska', '2022-03-17'),
(3, 'ikucyk', 'haslo', 4, '777777777', 'magazyn@herbacianyzakatek.pl', 'Igor', 'Kucyk', '2021-12-07'),
(4, 'kamil', 'haslo', 1, '', 'email@email.com', 'Kamil', 'Kołak', '2022-03-29'),
(5, 'testowy', 'haslo', 1, '', 'e@e.com', 'Testowy', 'Tester', '2021-05-17'),
(7, 'jp2', 'haslo', 1, '2137', 'papiezpolak@kremowka.pl', 'Karol', 'Wojtyła', '2005-04-02'),
(8, 'azajaczkowski', 'haslo', 1, '5009666422', 'zajonc@gmail.com', 'Adrian', 'Zajączkowski', '2022-05-19'),
(9, 'gpohvx', '341dee', 1, '1-231-913-38', 'jacobs.mitchel@example.com', 'Pablo', 'Reilly', '2020-12-02'),
(10, 'sqamuw', '330tjn', 1, '(907)203-836', 'antonette36@example.com', 'Jayne', 'Corwin', '2022-05-01'),
(11, 'cslofj', '657ssx', 1, '523-015-8955', 'kihn.paxton@example.com', 'Carey', 'DuBuque', '2022-02-14'),
(12, 'pwtihn', '960mec', 1, '382-205-6179', 'bert32@example.org', 'Eloy', 'Bernier', '2020-05-20'),
(13, 'skkbkp', '502slo', 1, '(102)066-204', 'arlene93@example.com', 'Lisandro', 'Rippin', '2020-06-14'),
(14, 'kxprgc', '516gkz', 1, '668.083.8116', 'parker.bernhard@example.org', 'Kristofer', 'Kilback', '2022-05-16'),
(15, 'yahdpa', '886ltz', 1, '06106353093', 'zlemke@example.org', 'Bennett', 'Ruecker', '2022-05-09'),
(16, 'xofgpd', '386uop', 1, '540-317-9869', 'dubuque.blanche@example.com', 'Pansy', 'Turcotte', '2022-02-14'),
(17, 'ckdeoo', '414xsi', 1, '1-541-685-56', 'nikolas.dach@example.net', 'Aubree', 'Metz', '2021-04-12'),
(18, 'zpvdoe', '858nap', 1, '121.804.8662', 'penelope61@example.net', 'Keon', 'Emmerich', '2020-05-07'),
(19, 'fcsyho', '768csn', 1, '(016)373-445', 'uwyman@example.com', 'Rebeka', 'Monahan', '2020-01-01'),
(20, 'zeaqyq', '511kgo', 1, '(697)195-457', 'pietro.corwin@example.com', 'Rossie', 'Treutel', '2021-02-28'),
(21, 'ybevwe', '709egz', 1, '042-745-2296', 'beatty.eloisa@example.net', 'Jeanette', 'Altenwerth', '2020-03-17'),
(22, 'gtvabs', '153fex', 1, '1-222-406-63', 'trenner@example.org', 'Eden', 'Gaylord', '2022-03-19'),
(23, 'bkprxh', '390lbv', 1, '024.923.7852', 'bins.rebeka@example.com', 'Molly', 'Larson', '2020-08-31'),
(24, 'zgteli', '539shf', 1, '463.281.7246', 'may.mueller@example.net', 'Cristopher', 'Brakus', '2021-10-11'),
(25, 'gystmt', '665zqc', 1, '08955741795', 'katrine.sauer@example.net', 'Aleen', 'Cummerata', '2022-02-17'),
(26, 'fmmblh', '200fvk', 1, '242.700.5048', 'xmueller@example.net', 'Darien', 'Zulauf', '2021-12-08'),
(27, 'zkbyke', '737raq', 1, '1-519-000-32', 'ethyl.rice@example.net', 'Cordelia', 'O\'Reilly', '2020-09-15'),
(28, 'xpebig', '591jhh', 1, '812.528.7675', 'lora.wuckert@example.net', 'Toby', 'Schowalter', '2021-12-16'),
(29, 'jzzgud', '112bhr', 1, '493-056-4008', 'mgraham@example.org', 'Amira', 'Kris', '2022-05-18'),
(30, 'eklwct', '143ruw', 1, '773.496.4705', 'frankie.fadel@example.org', 'Florencio', 'Hansen', '2020-11-11'),
(31, 'fntqve', '546ryy', 1, '1-977-360-12', 'batz.johan@example.com', 'Malvina', 'Kertzmann', '2022-02-01'),
(32, 'kgycpb', '652mfg', 1, '1-410-253-16', 'tremblay.reagan@example.net', 'Earlene', 'Armstrong', '2020-12-25'),
(33, 'kyngan', '979kmj', 1, '849.253.5533', 'abner58@example.org', 'Thora', 'Adams', '2021-09-30'),
(34, 'gcnnfl', '474dkg', 1, '+20(2)700623', 'ublanda@example.org', 'Mozelle', 'Runolfsson', '2020-12-12'),
(35, 'botbho', '549hzn', 1, '509.999.0988', 'ashlynn.kemmer@example.com', 'Lea', 'Friesen', '2022-04-01'),
(36, 'test2', 'haslo', 1, '', 'test@testowy.com', 'test2', 'test2', '2022-05-22'),
(37, 'ala1', 'haslo', 1, '00000000', 'ala@gmail.com', 'Alicja', 'Rojek', '2022-05-26'),
(38, 'dzialaj', 'haslo', 1, '123456789', 'dziala@dziala.com', 'Testowanko', 'Oby Działanko', '2022-06-05'),
(39, 'nowak', 'haslo', 1, '123456789', 'adam@gmail.com', 'Adam', 'Nowak', '2022-06-06');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `idzamowienie` int(11) NOT NULL,
  `data_zam` datetime NOT NULL,
  `iduzytkownik` int(11) NOT NULL,
  `idstatus` int(11) NOT NULL,
  `iddostawa` int(11) NOT NULL,
  `idplatnosc` int(11) NOT NULL,
  `wartosc_calkowita` decimal(6,2) NOT NULL,
  `adres_kod` varchar(8) NOT NULL,
  `adres_miasto` varchar(30) NOT NULL,
  `adres_ulica` varchar(30) NOT NULL,
  `adres_nr` varchar(5) NOT NULL,
  `adres_lokal` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`idzamowienie`, `data_zam`, `iduzytkownik`, `idstatus`, `iddostawa`, `idplatnosc`, `wartosc_calkowita`, `adres_kod`, `adres_miasto`, `adres_ulica`, `adres_nr`, `adres_lokal`) VALUES
(7, '2022-05-10 00:00:00', 2, 4, 2, 2, '61.99', '21-500', 'Biała Podlaska', 'Kremówkowa', '00', '23'),
(8, '2022-05-14 00:00:00', 2, 4, 3, 1, '22.99', '21-500', 'Biała Podlaska', 'Kremówkowa', '21', '37'),
(9, '2022-05-15 00:00:00', 7, 4, 1, 1, '496.18', '21-500', 'Biała Podlaska', 'Kremówkowa', '21', '37'),
(10, '2022-05-15 00:00:00', 3, 4, 2, 2, '147.93', '21-500', 'Biała Podlaska', 'Kremówkowa', '21', '37'),
(11, '2022-05-15 00:00:00', 3, 4, 1, 1, '149.93', '21-500', 'Biała Podlaska', 'Kremówkowa', '21', '37'),
(12, '2022-05-17 00:00:00', 4, 4, 1, 1, '134.46', '21-500', 'Biała Podlaska', 'Testowa', '21', '37'),
(13, '2022-05-18 00:00:00', 4, 4, 2, 3, '61.40', '21-500', 'Biała Podlaska', 'Testowa', '21', ''),
(14, '2022-05-19 00:00:00', 4, 4, 2, 1, '196.50', '05-310', 'Kałuszyn', 'Brzozowa', '4', ''),
(15, '2022-05-21 00:00:00', 18, 4, 2, 2, '101.15', '08-110', 'Siedlce', 'Borowikowa', '13', ''),
(16, '2022-03-08 00:00:00', 20, 4, 3, 1, '87.69', '08-110', 'Siedlce', 'Testowa', '13', ''),
(17, '2021-03-03 00:00:00', 10, 4, 4, 3, '277.38', '21-500', 'Biała Podlaska', 'Heheszkowa', '4', '10'),
(18, '2022-05-11 00:00:00', 15, 4, 1, 1, '68.46', '21-500', 'Biała Podlaska', 'Borowikowa', '13', '10'),
(19, '2020-05-01 00:00:00', 32, 4, 1, 1, '92.80', '08-110', 'Siedlce', 'Borowikowa', '4', '37'),
(20, '2022-01-01 00:00:00', 31, 4, 2, 3, '74.73', '08-110', 'Siedlce', 'Testowa', '4', '10'),
(21, '2022-05-22 00:00:00', 18, 4, 3, 1, '102.84', '21-500', 'Biała Podlaska', 'Borowikowa', '13', ''),
(22, '2022-05-22 00:00:00', 18, 3, 3, 1, '34.56', '21-500', 'Biała Podlaska', 'Borowikowa', '22', ''),
(23, '2021-11-10 00:00:00', 18, 4, 1, 1, '38.56', '21-500', 'Biała Podlaska', 'Heheszkowa', '4', ''),
(24, '2022-05-11 00:00:00', 18, 4, 1, 1, '103.44', '21-500', 'Biała Podlaska', 'Heheszkowa', '21', ''),
(25, '2022-02-09 00:00:00', 18, 4, 1, 1, '217.80', '21-500', 'Biała Podlaska', 'Heheszkowa', '21', ''),
(26, '2021-05-01 00:00:00', 18, 4, 1, 1, '86.53', '21-500', 'Biała Podlaska', 'Heheszkowa', '21', ''),
(27, '2022-05-22 00:00:00', 4, 3, 2, 1, '129.87', '21-500', 'Biała Podlaska', 'Heheszkowa', '4', '21'),
(30, '2022-05-22 00:00:00', 4, 2, 2, 2, '33.99', '21-500', 'Biała Podlaska', 'Malinowa', '17', '2'),
(31, '2022-05-23 00:00:00', 2, 2, 4, 1, '76.47', '21-500', 'Biała Podlaska', 'Heheszkowa', '22', ''),
(32, '2022-05-26 00:00:00', 37, 3, 4, 1, '114.99', '05-310', 'Kałuszyn', 'Brzozowa', '21', ''),
(33, '2022-06-05 00:00:00', 38, 1, 4, 2, '124.99', '21-500', 'Biała Podlaska', 'Działająca', '12', '96'),
(34, '2022-06-06 00:00:00', 39, 2, 3, 1, '88.96', '21-500', 'Biała Podlaska', 'Borowikowa', '15', ''),
(35, '2022-06-06 00:00:00', 39, 3, 2, 1, '495.00', '21-500', 'Biała Podlaska', 'Borowikowa', '4', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia_produkty`
--

CREATE TABLE `zamowienia_produkty` (
  `idzamowienie` int(11) NOT NULL,
  `idprodukt` int(11) NOT NULL,
  `cena_jednostkowa` decimal(6,2) NOT NULL,
  `ilosc` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zamowienia_produkty`
--

INSERT INTO `zamowienia_produkty` (`idzamowienie`, `idprodukt`, `cena_jednostkowa`, `ilosc`) VALUES
(7, 4, '21.50', 2),
(7, 5, '18.99', 1),
(8, 1, '9.99', 1),
(9, 2, '80.00', 3),
(9, 7, '29.99', 1),
(9, 1, '9.99', 1),
(9, 8, '24.90', 8),
(10, 5, '18.99', 7),
(11, 5, '18.99', 9),
(12, 7, '29.99', 1),
(12, 9, '21.99', 3),
(12, 4, '21.50', 1),
(13, 8, '24.90', 1),
(13, 4, '21.50', 1),
(14, 2, '80.00', 2),
(14, 4, '21.50', 1),
(15, 8, '24.90', 1),
(15, 6, '25.00', 2),
(15, 11, '11.25', 1),
(16, 1, '9.99', 2),
(16, 17, '17.00', 1),
(16, 33, '37.71', 1),
(17, 23, '19.28', 1),
(17, 18, '17.00', 1),
(17, 29, '43.22', 5),
(18, 12, '29.90', 1),
(18, 27, '21.56', 1),
(19, 32, '75.80', 1),
(20, 14, '7.99', 1),
(20, 15, '10.50', 1),
(20, 7, '29.99', 1),
(21, 23, '19.28', 4),
(21, 28, '12.72', 1),
(22, 27, '21.56', 1),
(23, 27, '21.56', 1),
(25, 10, '45.00', 1),
(25, 2, '80.00', 1),
(25, 32, '75.80', 1),
(26, 16, '20.99', 1),
(26, 25, '48.54', 1),
(27, 7, '29.99', 3),
(27, 8, '24.90', 1),
(30, 5, '18.99', 1),
(31, 1, '9.99', 3),
(31, 4, '21.50', 1),
(32, 1, '9.99', 1),
(32, 2, '80.00', 1),
(33, 1, '9.99', 1),
(33, 10, '45.00', 2),
(34, 5, '18.99', 4),
(35, 2, '80.00', 6);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dostawy`
--
ALTER TABLE `dostawy`
  ADD PRIMARY KEY (`iddostawa`);

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`idkategoria`);

--
-- Indeksy dla tabeli `kategorie_produkty`
--
ALTER TABLE `kategorie_produkty`
  ADD KEY `idprodukt` (`idprodukt`),
  ADD KEY `idkategoria` (`idkategoria`);

--
-- Indeksy dla tabeli `platnosci`
--
ALTER TABLE `platnosci`
  ADD PRIMARY KEY (`idplatnosc`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`idprodukt`);

--
-- Indeksy dla tabeli `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idrola`);

--
-- Indeksy dla tabeli `statusy`
--
ALTER TABLE `statusy`
  ADD PRIMARY KEY (`idstatus`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`iduzytkownik`),
  ADD KEY `idrola` (`idrola`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`idzamowienie`),
  ADD KEY `iduzytkownik` (`iduzytkownik`),
  ADD KEY `idstatus` (`idstatus`),
  ADD KEY `iddostawa` (`iddostawa`),
  ADD KEY `idplatnosc` (`idplatnosc`);

--
-- Indeksy dla tabeli `zamowienia_produkty`
--
ALTER TABLE `zamowienia_produkty`
  ADD KEY `idzamowienie` (`idzamowienie`),
  ADD KEY `idprodukt` (`idprodukt`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `dostawy`
--
ALTER TABLE `dostawy`
  MODIFY `iddostawa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `idkategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `platnosci`
--
ALTER TABLE `platnosci`
  MODIFY `idplatnosc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `idprodukt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT dla tabeli `role`
--
ALTER TABLE `role`
  MODIFY `idrola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `statusy`
--
ALTER TABLE `statusy`
  MODIFY `idstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `iduzytkownik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `idzamowienie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `kategorie_produkty`
--
ALTER TABLE `kategorie_produkty`
  ADD CONSTRAINT `kategorie_produkty_ibfk_1` FOREIGN KEY (`idprodukt`) REFERENCES `produkty` (`idprodukt`),
  ADD CONSTRAINT `kategorie_produkty_ibfk_2` FOREIGN KEY (`idkategoria`) REFERENCES `kategorie` (`idkategoria`);

--
-- Ograniczenia dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD CONSTRAINT `uzytkownicy_ibfk_1` FOREIGN KEY (`idrola`) REFERENCES `role` (`idrola`);

--
-- Ograniczenia dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`iduzytkownik`) REFERENCES `uzytkownicy` (`iduzytkownik`),
  ADD CONSTRAINT `zamowienia_ibfk_2` FOREIGN KEY (`idstatus`) REFERENCES `statusy` (`idstatus`),
  ADD CONSTRAINT `zamowienia_ibfk_3` FOREIGN KEY (`iddostawa`) REFERENCES `dostawy` (`iddostawa`),
  ADD CONSTRAINT `zamowienia_ibfk_4` FOREIGN KEY (`idplatnosc`) REFERENCES `platnosci` (`idplatnosc`);

--
-- Ograniczenia dla tabeli `zamowienia_produkty`
--
ALTER TABLE `zamowienia_produkty`
  ADD CONSTRAINT `zamowienia_produkty_ibfk_1` FOREIGN KEY (`idzamowienie`) REFERENCES `zamowienia` (`idzamowienie`),
  ADD CONSTRAINT `zamowienia_produkty_ibfk_2` FOREIGN KEY (`idprodukt`) REFERENCES `produkty` (`idprodukt`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
