-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Dec 09. 19:32
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `vedett_fajok`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allat`
--

CREATE TABLE `allat` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `ertekid` int(11) NOT NULL,
  `ev` int(4) DEFAULT NULL,
  `katid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `allat`
--

INSERT INTO `allat` (`id`, `nev`, `ertekid`, `ev`, `katid`) VALUES
(1768, 'dobozi pikkelyescsiga', 1, 0, 5),
(1772, 'ritka hegyiszitakötő', 1, 0, 8),
(1774, 'álolaszsáska', 1, 0, 8),
(1775, 'magyar tarsza', 1, 0, 8),
(1776, 'Stys-tarsza', 1, 0, 8),
(1779, 'beregi futrinka', 1, 0, 8),
(1780, 'magyar futrinka', 1, 0, 8),
(1781, 'zempléni futrinka', 1, 0, 8),
(1783, 'pusztai gyalogcincér', 1, 0, 8),
(1784, 'atracélcincér', 1, 0, 8),
(1786, 'remetebogár', 1, 0, 8),
(1788, 'drávai tegzes', 1, 0, 8),
(1789, 'mecseki őszitegzes', 1, 0, 8),
(1792, 'sztyeplepke', 1, 0, 8),
(1794, 'budai szakállasmoly', 1, 0, 8),
(1796, 'fóti boglárka', 1, 0, 8),
(1797, 'csíkos boglárka', 1, 0, 8),
(1799, 'ezüstsávos szénalepke', 1, 0, 8),
(1801, 'magyar ősziaraszoló', 1, 0, 8),
(1802, 'bükki hegyiaraszoló', 1, 0, 8),
(1803, 'Anker-araszoló', 1, 0, 8),
(1804, 'füstös ősziaraszoló', 1, 0, 8),
(1805, 'csüngőaraszoló', 1, 0, 8),
(1807, 'Metelka-medvelepke', 1, 0, 8),
(1809, 'keleti lápibagoly', 1, 0, 8),
(1810, 'magyar őszi-fésűsbagoly', 1, 0, 8),
(1811, 'díszes csuklyásbagoly', 1, 0, 8),
(1812, 'vértesi csuklyásbagoly', 1, 0, 8),
(1813, 'magyar tavaszi-fésűsbagoly', 1, 0, 8),
(1814, 'nagy szikibagoly', 1, 0, 8),
(1815, 'nagyfoltú bagoly', 1, 0, 8),
(1816, 'villányi télibagoly', 1, 0, 8),
(1821, 'tiszai ingola', 2, 1974, 2),
(1822, 'dunai ingola', 1, 1974, 2),
(1826, 'Petényi-márna', 1, 1974, 1),
(1829, 'lápi póc', 1, 1974, 1),
(1831, 'dunai galóca', 1, 1974, 1),
(1834, 'magyar bucó', 1, 1974, 1),
(1835, 'német bucó', 1, 1974, 1),
(1839, 'pannon gyík', 1, 1974, 6),
(1841, 'haragos sikló', 3, 1974, 6),
(1843, 'parlagi vipera', 4, 1974, 6),
(1847, 'kis kárókatona', 3, 1954, 3),
(1849, 'rózsás gödény', 2, 1954, 3),
(1850, 'borzas gödény', 2, 1954, 3),
(1853, 'bölömbika', 1, 1954, 3),
(1854, 'törpegém', 1, 1954, 3),
(1855, 'bakcsó', 1, 1954, 3),
(1856, 'üstökösgém', 2, 1912, 3),
(1857, 'kis kócsag', 2, 1912, 3),
(1858, 'nagy kócsag', 1, 1912, 3),
(1859, 'vörös gém', 2, 1954, 3),
(1861, 'fekete gólya', 3, 1906, 3),
(1862, 'fehér gólya', 1, 1906, 3),
(1864, 'batla', 2, 1912, 3),
(1865, 'kanalasgém', 3, 1912, 3),
(1868, 'kis lilik', 4, 1982, 3),
(1869, 'vörösnyakú lúd', 3, 1971, 3),
(1870, 'márványos réce', 2, 1971, 3),
(1871, 'cigányréce', 3, 1971, 3),
(1872, 'kékcsőrű réce', 3, 1954, 3),
(1875, 'halászsas', 2, 1954, 3),
(1877, 'darázsölyv', 1, 1954, 3),
(1878, 'barna kánya', 2, 1971, 3),
(1879, 'vörös kánya', 3, 1954, 3),
(1880, 'rétisas', 4, 1954, 3),
(1881, 'dögkeselyű', 1, 1954, 3),
(1882, 'barátkeselyű', 2, 1954, 3),
(1883, 'kígyászölyv', 3, 1954, 3),
(1884, 'fakó rétihéja', 1, 1954, 3),
(1885, 'hamvas rétihéja', 2, 1954, 3),
(1886, 'kis héja', 2, 1954, 3),
(1887, 'pusztai ölyv', 1, 1954, 3),
(1888, 'békászó sas', 4, 1954, 3),
(1889, 'fekete sas', 3, 1954, 3),
(1890, 'parlagi sas', 4, 1954, 3),
(1891, 'szirti sas', 3, 1954, 3),
(1892, 'törpesas', 3, 1954, 3),
(1893, 'héjasas', 1, 1954, 3),
(1895, 'fehérkarmú vércse', 3, 1906, 3),
(1896, 'kék vércse', 3, 1906, 3),
(1897, 'Eleonóra-sólyom', 1, 1971, 3),
(1898, 'Feldegg-sólyom', 1, 1996, 3),
(1899, 'kerecsensólyom', 4, 1954, 3),
(1900, 'északi sólyom', 1, 1996, 3),
(1901, 'vándorsólyom', 3, 1954, 3),
(1904, 'császármadár', 3, 1954, 3),
(1907, 'törpevízicsibe', 2, 1954, 3),
(1908, 'haris', 3, 1971, 3),
(1910, 'reznek', 2, 1954, 3),
(1911, 'túzok', 4, 1971, 3),
(1914, 'gólyatöcs', 2, 1954, 3),
(1915, 'gulipán', 2, 1954, 3),
(1917, 'ugartyúk', 2, 1901, 3),
(1919, 'székicsér', 3, 1901, 3),
(1920, 'feketeszárnyú székicsér', 3, 1954, 3),
(1922, 'széki lile', 3, 1901, 3),
(1923, 'lilebíbic', 2, 1954, 3),
(1925, 'nagy sárszalonka', 2, 1971, 3),
(1926, 'nagy goda', 1, 1954, 3),
(1927, 'vékonycsőrű póling', 4, 1954, 3),
(1928, 'nagy póling', 1, 1954, 3),
(1929, 'piroslábú cankó', 1, 1954, 3),
(1930, 'tavi cankó', 2, 1954, 3),
(1932, 'kis csér', 2, 1954, 3),
(1933, 'fattyúszerkő', 1, 1901, 3),
(1934, 'kormos szerkő', 2, 1901, 3),
(1935, 'fehérszárnyú szerkő', 2, 1901, 3),
(1938, 'gyöngybagoly', 1, 1901, 3),
(1940, 'uhu', 2, 1954, 3),
(1941, 'hóbagoly', 1, 1954, 3),
(1942, 'kuvik', 1, 1901, 3),
(1943, 'urali bagoly', 1, 1954, 3),
(1944, 'réti fülesbagoly', 2, 1901, 3),
(1947, 'gyurgyalag', 1, 1954, 3),
(1949, 'szalakóta', 3, 1901, 3),
(1952, 'fehérhátú fakopáncs', 1, 1901, 3),
(1955, 'sziki pacsirta', 2, 1971, 3),
(1957, 'vízirigó', 2, 1904, 3),
(1959, 'nagy fülemüle', 1, 1901, 3),
(1960, 'kövirigó', 3, 1901, 3),
(1962, 'csíkosfejű nádiposzáta', 3, 1901, 3),
(1964, 'kerti sármány', 2, 1901, 3),
(1968, 'kereknyergű patkósdenevér', 1, 1901, 7),
(1969, 'nagy patkósdenevér', 1, 1901, 7),
(1971, 'piszedenevér', 1, 1901, 7),
(1972, 'hosszúszárnyú denevér', 1, 1901, 7),
(1973, 'nagyfülű denevér', 1, 1901, 7),
(1974, 'tavi denevér', 1, 1901, 7),
(1975, 'csonkafülű denevér', 1, 1901, 7),
(1976, 'óriás-koraidenevér', 1, 1901, 7),
(1979, 'farkas', 2, 1993, 7),
(1981, 'vidra', 2, 1974, 7),
(1983, 'hiúz', 3, 1988, 7),
(1986, 'nyugati földikutya', 3, 1974, 7),
(1988, 'északi pocok', 2, 1974, 7),
(1990, 'csíkos szöcskeegér', 2, 1974, 7);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ertek`
--

CREATE TABLE `ertek` (
  `id` int(11) NOT NULL,
  `forint` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `ertek`
--

INSERT INTO `ertek` (`id`, `forint`) VALUES
(1, 100000),
(2, 250000),
(3, 500000),
(4, 1000000);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `admin` enum('igen','nem') DEFAULT 'nem',
  `bejelentkezve` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `nev`, `jelszo`, `admin`, `bejelentkezve`) VALUES
(1, 'abc123def456', '$2y$10$MAKQynZab7CoACALKQZEa.vxez1shlNDSTXAGQc3oLJuIajWpwu6u', 'nem', 1),
(2, 'admin', '$2y$10$OATHFXfTN58MMZkzFub4Ze5TqOyxRlv0rrW5kW9Egj8WU.LZK3YVC', 'igen', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kategoria`
--

CREATE TABLE `kategoria` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kategoria`
--

INSERT INTO `kategoria` (`id`, `nev`) VALUES
(1, 'halak\r'),
(2, 'körszájúak\r'),
(3, 'madarak\r'),
(4, 'kétéltűek\r'),
(5, 'puhatestűek\r'),
(6, 'hüllők\r'),
(7, 'emlősök\r'),
(8, 'ízeltlábúak\r');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `menunevek`
--

CREATE TABLE `menunevek` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `megjelenik` enum('mindig','bejelentkezve','kijelentkezes') DEFAULT 'mindig'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `menunevek`
--

INSERT INTO `menunevek` (`id`, `nev`, `link`, `parent_id`, `megjelenik`) VALUES
(1, 'védett fajok', 'vedettfajok.php', NULL, 'mindig'),
(2, 'rólunk', 'rolunk.php', NULL, 'mindig'),
(3, 'állatok', 'allatok.php', 1, 'mindig'),
(4, 'kategória', 'kategoria.php', 1, 'mindig'),
(5, 'kapcsolat', 'kapcsolat.php', NULL, 'bejelentkezve'),
(6, 'MNB', 'MNB.php', NULL, 'bejelentkezve'),
(7, 'PDF', 'PDF.php', NULL, 'bejelentkezve'),
(8, 'allat', 'allat.php', NULL, 'bejelentkezve'),
(9, 'regisztráció', 'regisztracio.php', NULL, 'kijelentkezes'),
(10, 'bejelentkezés', 'bejelentkezes.php', NULL, 'kijelentkezes'),
(11, 'kijelentkezés', 'kijelentkezes.php', NULL, 'bejelentkezve');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `allat`
--
ALTER TABLE `allat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ertekid` (`ertekid`,`katid`),
  ADD KEY `katid` (`katid`);

--
-- A tábla indexei `ertek`
--
ALTER TABLE `ertek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kategoria`
--
ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`);

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `allat`
--
ALTER TABLE `allat`
  ADD CONSTRAINT `allat_ibfk_1` FOREIGN KEY (`katid`) REFERENCES `kategoria` (`id`),
  ADD CONSTRAINT `allat_ibfk_2` FOREIGN KEY (`ertekid`) REFERENCES `ertek` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
