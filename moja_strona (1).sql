-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 21 2025 г., 09:38
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `moja_strona`
--

-- --------------------------------------------------------

--
-- Структура таблицы `kategorie`
--

CREATE TABLE `kategorie` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `matka` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `kategorie`
--

INSERT INTO `kategorie` (`id`, `nazwa`, `matka`) VALUES
(1, 'Elektronika', 0),
(2, 'Komputery', 1),
(3, 'Laptopy', 2),
(4, 'Akcesoria', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `page_list`
--

CREATE TABLE `page_list` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `page_list`
--

INSERT INTO `page_list` (`id`, `page_title`, `page_content`, `status`) VALUES
(3, 'Mosty', '<h1>Najdłuższe mosty świata</h1>\r\n<!-- Nagłówek strony, informujący o temacie (najdłuższe mosty świata) -->\r\n\r\n<table border=\"1\">\r\n    <tr>\r\n        <!-- Nagłówki tabeli -->\r\n        <th>Nazwa mostu</th>\r\n        <th>Długość</th>\r\n        <th>Kraj</th>\r\n    </tr>\r\n    <tr>\r\n        <!-- Pierwszy wiersz tabeli z danymi mostu Danyang–Kunshan -->\r\n        <td>Most Danyang–Kunshan</td>\r\n        <td>164.8 km</td>\r\n        <td>Chiny</td>\r\n    </tr>\r\n    <tr>\r\n        <!-- Drugi wiersz tabeli z danymi mostu Changhua–Kaohsiung Viaduct -->\r\n        <td>Changhua–Kaohsiung Viaduct</td>\r\n        <td>157.3 km</td>\r\n        <td>Tajwan</td>\r\n    </tr>\r\n    <tr>\r\n        <!-- Trzeci wiersz tabeli z danymi mostu Lake Pontchartrain Causeway -->\r\n        <td>Lake Pontchartrain Causeway</td>\r\n        <td>38.4 km</td>\r\n        <td>USA</td>\r\n    </tr>\r\n</table>\r\n\r\n<body onload=\"startclock()\">\r\n    <!-- Funkcja startclock() uruchamiana przy załadowaniu strony, wyświetlająca zegar i datę -->\r\n    <div id=\"zegarek\"></div>  <!-- Miejsce na wyświetlanie zegara -->\r\n    <div id=\"data\"></div>  <!-- Miejsce na wyświetlanie daty -->\r\n    \r\n    <script>\r\n        // Efekt animacji dla elementu z ID animacjaTestowa1, który po kliknięciu zmienia swoje właściwości\r\n        $(\"#animacjaTestowa1\").on(\"click\", function(){\r\n            $(this).animate({\r\n                width: \"500px\",  // Zmienia szerokość na 500px\r\n                opacity: 0.4,  // Zmienia przezroczystość na 0.4\r\n                fontSize: \"3em\",  // Zmienia rozmiar czcionki na 3em\r\n                borderWidth: \"10px\"  // Zwiększa grubość ramki do 10px\r\n            }, 1500);  // Animacja trwa 1500ms (1.5 sekundy)\r\n        });\r\n\r\n        // Efekty animacji dla elementów z klasą color-button na zdarzenie mouseover i mouseout\r\n        $(\".color-button\").on(\"mouseover\", function(){\r\n                $(this).animate({\r\n                   width: 150  // Zwiększa szerokość elementu do 150px\r\n                }, 800);  // Animacja trwa 800ms\r\n        }).on(\"mouseout\", function(){\r\n            $(this).animate({\r\n                width: 100  // Przywraca szerokość do 100px\r\n            }, 800);  // Animacja trwa 800ms\r\n        });\r\n        \r\n        // Efekt powiększania dla elementu zegarek na zdarzenie mouseover i mouseout\r\n        $(\"#zegarek\").on(\"mouseover\", function(){\r\n            $(this).css(\"transform\", \"scale(1.2)\");  // Powiększa element 1.2 razy\r\n        }).on(\"mouseout\", function(){\r\n            $(this).css(\"transform\", \"scale(1)\");  // Przywraca normalny rozmiar\r\n        });\r\n        \r\n        // Efekt zmiany przezroczystości i powiększania dla elementu data na zdarzenie mouseover i mouseout\r\n        $(\"#data\").on(\"mouseover\", function(){\r\n            $(this).animate({\r\n                 opacity: 0.5  // Zmniejsza przezroczystość do 0.5\r\n            }, 300);  // Animacja trwa 300ms\r\n            $(this).css(\"transform\", \"scale(1.1)\");  // Powiększa element o 1.1 razy\r\n        }).on(\"mouseout\", function(){\r\n            $(this).animate({\r\n                 opacity: 1  // Przywraca pełną przezroczystość\r\n            }, 300);  // Animacja trwa 300ms\r\n            $(this).css(\"transform\", \"scale(1)\");  // Przywraca normalny rozmiar\r\n        });\r\n    </script>\r\n</body>\r\n', 1),
(4, 'Strona główna', '<h1>Największe Mosty Świata</h1>\r\n<p><b>Mosty</b> to jedne z najbardziej imponujących konstrukcji stworzonych przez człowieka. Są nie tylko narzędziami transportowymi, ale także symbolami technologicznego rozwoju i inżynierii.</p>\r\n\r\n<!-- Sekcja z opisem Mostu Danyang–Kunshan -->\r\n<div class=\"container\">\r\n    <img src=\"images/237.jpg\" alt=\"Most Danyang–Kunshan\" class=\"img-left\">\r\n    <p>Najdłuższym mostem na świecie jest <b>Most Danyang–Kunshan</b>, który znajduje się w Chinach i ma długość aż 164,8 km. To monumentalna konstrukcja, która jest częścią linii kolejowej Pekin–Szanghaj.</p>\r\n</div>\r\n\r\n<!-- Sekcja z opisem Lake Pontchartrain Causeway -->\r\n<div class=\"container\">\r\n    <img src=\"images/1.jpg\" alt=\"Lake Pontchartrain Causeway\" class=\"img-right\">\r\n    <p><b>Lake Pontchartrain Causeway</b> w Stanach Zjednoczonych to najdłuższy most w USA. Jego długość wynosi 38,4 km i łączy miasta Mandeville i Metairie w stanie Luizjana.</p>\r\n</div>\r\n\r\n<!-- Sekcja z opisem Changhua–Kaohsiung Viaduct -->\r\n<div class=\"container\">\r\n    <img src=\"images/50504879058_dc2908b902_h.jpg\" alt=\"Changhua–Kaohsiung Viaduct\" class=\"img-left\">\r\n    <p><b>Changhua–Kaohsiung Viaduct</b> na Tajwanie to drugi najdłuższy most na świecie, mający 157,3 km. Jest częścią tajwańskiej szybkiej kolei, zapewniając stabilną trasę dla pociągów o dużej prędkości.</p>\r\n</div>\r\n\r\n<!-- Sekcja z przyciskami zmieniającymi kolor tła -->\r\n<section class=\"color-change\">\r\n    <form method=\"post\" name=\"background\">\r\n        <!-- Przyciski zmieniające kolor tła na różne kolory -->\r\n        <input type=\"button\" value=\"żółty\" onclick=\"changeBackground(\'#FFFF00\')\" class=\"color-button\">\r\n        <input type=\"button\" value=\"czarny\" onclick=\"changeBackground(\'#000000\')\" class=\"color-button\">\r\n        <input type=\"button\" value=\"biały\" onclick=\"changeBackground(\'#FFFFFF\')\" class=\"color-button\">\r\n        <input type=\"button\" value=\"zielony\" onclick=\"changeBackground(\'#00FF00\')\" class=\"color-button\">\r\n        <input type=\"button\" value=\"niebieski\" onclick=\"changeBackground(\'#0000FF\')\" class=\"color-button\">\r\n        <input type=\"button\" value=\"pomarańczowy\" onclick=\"changeBackground(\'#FF8000\')\" class=\"color-button\">\r\n        <input type=\"button\" value=\"szary\" onclick=\"changeBackground(\'#C0C0C0\')\" class=\"color-button\">\r\n        <input type=\"button\" value=\"czerwony\" onclick=\"changeBackground(\'#FF0000\')\" class=\"color-button\">\r\n    </form>\r\n</section>\r\n\r\n<body onload=\"startclock()\">\r\n    <!-- Zegar wyświetlający aktualny czas -->\r\n    <div id=\"zegarek\"></div>\r\n    <!-- Wyświetlanie daty -->\r\n    <div id=\"data\"></div>\r\n\r\n    <!-- Skrypty JavaScript -->\r\n    <script>\r\n        // Animacja dla elementu o ID animacjaTestowa1\r\n        $(\"#animacjaTestowa1\").on(\"click\", function(){\r\n            $(this).animate({\r\n                width: \"500px\",\r\n                opacity: 0.4,\r\n                fontSize: \"3em\",\r\n                borderWidth: \"10px\"\r\n            }, 1500);\r\n        });\r\n\r\n        // Efekty animacji dla przycisków zmiany koloru tła\r\n        $(\".color-button\").on(\"mouseover\", function(){\r\n            $(this).animate({ width: 150 }, 800); // Zwiększa szerokość\r\n        }).on(\"mouseout\", function(){\r\n            $(this).animate({ width: 100 }, 800); // Przywraca szerokość\r\n        });\r\n\r\n        // Efekt powiększania dla zegarka\r\n        $(\"#zegarek\").on(\"mouseover\", function(){\r\n            $(this).css(\"transform\", \"scale(1.2)\");\r\n        }).on(\"mouseout\", function(){\r\n            $(this).css(\"transform\", \"scale(1)\");\r\n        });\r\n\r\n        // Efekty dla daty: zmiana przezroczystości i rozmiaru\r\n        $(\"#data\").on(\"mouseover\", function(){\r\n            $(this).animate({ opacity: 0.5 }, 300);\r\n            $(this).css(\"transform\", \"scale(1.1)\");\r\n        }).on(\"mouseout\", function(){\r\n            $(this).animate({ opacity: 1 }, 300);\r\n            $(this).css(\"transform\", \"scale(1)\");\r\n        });\r\n    </script>\r\n</body>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 1),
(5, 'Galeria', '<h1>Galeria Największych Mostów Świata</h1>\r\n\r\n<!-- Galeria obrazów z klasą gallery -->\r\n<div class=\"gallery\">\r\n    <!-- Każdy obraz w galerii ma atrybut alt dla dostępności -->\r\n    <img src=\"images/Akashi_Bridge.jpg\" alt=\"Most 1\" class=\"gallery-img\">\r\n    <img src=\"images/0.jpg\" alt=\"Most 2\" class=\"gallery-img\">\r\n    <img src=\"images/MK_w_pełnej_krasie.jpg\" alt=\"Most 3\" class=\"gallery-img\">\r\n    <img src=\"images/0007OCAMLD1293PD-C324-F4.jpg\" alt=\"Most 4\" class=\"gallery-img\">\r\n    <img src=\"images/golden-gate-bridge-w-san-francisco_1100511.jpg\" alt=\"Most 5\" class=\"gallery-img\">\r\n    <img src=\"images/000HARC5Q7TI41T3-C461-F4.jpg\" alt=\"Most 6\" class=\"gallery-img\">\r\n    <img src=\"images/gf-ZzgC-dxLh-NDEv_ta-galeria-ok-zobacz-najdluzszy-most-na-swiecie-1920x1080-nocrop.jpg\" alt=\"Most 7\" class=\"gallery-img\">\r\n    <img src=\"images/sunshine-skyway-bridge-bfafbfe94a309bfe33b3542d339ddb80.jpg\" alt=\"Most 8\" class=\"gallery-img\">\r\n    <img src=\"images/Jintang_Bridge Liujinguang wikimedia_92537292fc.jpg\" alt=\"Most 9\" class=\"gallery-img\">\r\n    <img src=\"images/Najdluzszy-most-morski-na-swiecie-Fot-1.jpg\" alt=\"Most 10\" class=\"gallery-img\">\r\n</div>\r\n\r\n<!-- Początek ciała dokumentu -->\r\n<body onload=\"startclock()\"> <!-- Funkcja startclock() uruchamiana przy ładowaniu strony -->\r\n    <!-- Element do wyświetlania aktualnego czasu -->\r\n    <div id=\"zegarek\"></div>\r\n    <!-- Element do wyświetlania aktualnej daty -->\r\n    <div id=\"data\"></div>\r\n\r\n    <!-- Skrypt z efektami wizualnymi przy użyciu jQuery -->\r\n    <script>\r\n        // Animacja dla elementu z id \"animacjaTestowa1\"\r\n        $(\"#animacjaTestowa1\").on(\"click\", function(){\r\n            $(this).animate({\r\n                width: \"500px\", // Zwiększenie szerokości\r\n                opacity: 0.4,  // Zmniejszenie przezroczystości\r\n                fontSize: \"3em\", // Zwiększenie rozmiaru czcionki\r\n                borderWidth: \"10px\" // Zwiększenie szerokości obramowania\r\n            }, 1500); // Czas trwania animacji: 1500 milisekund\r\n        });\r\n \r\n        // Animacja dla przycisków z klasą color-button podczas najechania myszką\r\n        $(\".color-button\").on(\"mouseover\", function(){\r\n            $(this).animate({\r\n                width: 150 // Zwiększenie szerokości\r\n            }, 800); // Czas trwania: 800 milisekund\r\n        }).on(\"mouseout\", function(){\r\n            $(this).animate({\r\n                width: 100 // Powrót do początkowej szerokości\r\n            }, 800);\r\n        });\r\n\r\n        // Efekt skalowania dla elementu z id \"zegarek\"\r\n        $(\"#zegarek\").on(\"mouseover\", function(){\r\n            $(this).css(\"transform\", \"scale(1.2)\"); // Zwiększenie skali\r\n        }).on(\"mouseout\", function(){\r\n            $(this).css(\"transform\", \"scale(1)\"); // Powrót do początkowej skali\r\n        });\r\n		\r\n        // Efekt animacji dla elementu z id \"data\"\r\n        $(\"#data\").on(\"mouseover\", function(){\r\n            $(this).animate({\r\n                opacity: 0.5 // Zmniejszenie przezroczystości\r\n            }, 300); // Czas trwania: 300 milisekund\r\n            $(this).css(\"transform\", \"scale(1.1)\"); // Zwiększenie skali\r\n        }).on(\"mouseout\", function(){\r\n            $(this).animate({\r\n                opacity: 1 // Powrót do początkowej przezroczystości\r\n            }, 300);\r\n            $(this).css(\"transform\", \"scale(1)\"); // Powrót do początkowej skali\r\n        });\r\n    </script>\r\n</body>\r\n', 1),
(6, 'Historia', '<h1>Historia Mostów</h1>\r\n<!-- Nagłówek strony, opisujący temat historii mostów -->\r\n\r\n<!-- Pierwsza sekcja z obrazem i tekstem -->\r\n<div class=\"container\">\r\n    <img src=\"images/alcantara.jpg\" alt=\"Stary most\" class=\"img-left\">\r\n    <!-- Obrazek przedstawiający stary most z klasyfikacją \"img-left\" (lewa strona) -->\r\n    <p>Historia mostów sięga czasów starożytnych. Już w starożytności budowano pierwsze drewniane i kamienne mosty, które miały ułatwić przeprawy przez rzeki. Najstarsze mosty pochodziły z czasów Mezopotamii, Egiptu i Chin.</p>\r\n    <!-- Tekst opisujący historię pierwszych mostów w starożytności -->\r\n</div>\r\n\r\n<!-- Druga sekcja z obrazem i tekstem -->\r\n<div class=\"container\">\r\n    <img src=\"images/ponte-vecchio-2073980_960_720.jpg\" alt=\"Średniowieczny most\" class=\"img-right\">\r\n    <!-- Obrazek mostu Ponte Vecchio z klasyfikacją \"img-right\" (prawa strona) -->\r\n    <p>W średniowieczu rozwój inżynierii pozwolił na budowanie bardziej zaawansowanych mostów, które nie tylko były użyteczne, ale również stanowiły imponujące dzieła architektoniczne. Przykładem jest most Ponte Vecchio we Florencji, który powstał w XIV wieku.</p>\r\n    <!-- Tekst opisujący mosty średniowieczne i przykład Ponte Vecchio -->\r\n</div>\r\n\r\n<!-- Trzecia sekcja z obrazem i tekstem -->\r\n<div class=\"container\">\r\n    <img src=\"images/6828749-millau-viaduct-jest-przerzucony-nad-rzeka-tarn-na.jpg\" alt=\"Nowoczesny most\" class=\"img-left\">\r\n    <!-- Obrazek nowoczesnego mostu (Millau Viaduct) z klasyfikacją \"img-left\" (lewa strona) -->\r\n    <p>Wraz z rozwojem nowoczesnych technologii, mosty zaczęły przybierać gigantyczne rozmiary. Przykładem są współczesne mosty wiszące i wantowe, które pozwalają na przekraczanie szerokich rzek, dolin, a nawet oceanów.</p>\r\n    <!-- Tekst opisujący rozwój mostów w erze nowoczesnej technologii -->\r\n</div>\r\n\r\n<body onload=\"startclock()\">\r\n    <!-- Funkcja startclock() uruchamiana przy załadowaniu strony, wyświetlająca zegar i datę -->\r\n    \r\n    <div id=\"zegarek\"></div>\r\n    <!-- Miejsce na wyświetlanie zegara -->\r\n    \r\n    <div id=\"data\"></div>\r\n    <!-- Miejsce na wyświetlanie daty -->\r\n    \r\n    <script>\r\n        // Efekt animacji dla elementu z ID animacjaTestowa1, który po kliknięciu zmienia swoje właściwości\r\n        $(\"#animacjaTestowa1\").on(\"click\", function(){\r\n            $(this).animate({\r\n                width: \"500px\",  // Zmienia szerokość na 500px\r\n                opacity: 0.4,  // Zmienia przezroczystość na 0.4\r\n                fontSize: \"3em\",  // Zmienia rozmiar czcionki na 3em\r\n                borderWidth: \"10px\"  // Zwiększa grubość ramki do 10px\r\n            }, 1500);  // Animacja trwa 1500ms (1.5 sekundy)\r\n        });\r\n\r\n        // Efekty animacji dla elementów z klasą color-button na zdarzenie mouseover i mouseout\r\n        $(\".color-button\").on(\"mouseover\", function(){\r\n                $(this).animate({\r\n                   width: 150  // Zwiększa szerokość elementu do 150px\r\n                }, 800);  // Animacja trwa 800ms\r\n        }).on(\"mouseout\", function(){\r\n            $(this).animate({\r\n                width: 100  // Przywraca szerokość do 100px\r\n            }, 800);  // Animacja trwa 800ms\r\n        });\r\n        \r\n        // Efekt powiększania dla elementu zegarek na zdarzenie mouseover i mouseout\r\n        $(\"#zegarek\").on(\"mouseover\", function(){\r\n            $(this).css(\"transform\", \"scale(1.2)\");  // Powiększa element 1.2 razy\r\n        }).on(\"mouseout\", function(){\r\n            $(this).css(\"transform\", \"scale(1)\");  // Przywraca normalny rozmiar\r\n        });\r\n        \r\n        // Efekt zmiany przezroczystości i powiększania dla elementu data na zdarzenie mouseover i mouseout\r\n        $(\"#data\").on(\"mouseover\", function(){\r\n            $(this).animate({\r\n                 opacity: 0.5  // Zmniejsza przezroczystość do 0.5\r\n            }, 300);  // Animacja trwa 300ms\r\n            $(this).css(\"transform\", \"scale(1.1)\");  // Powiększa element o 1.1 razy\r\n        }).on(\"mouseout\", function(){\r\n            $(this).animate({\r\n                 opacity: 1  // Przywraca pełną przezroczystość\r\n            }, 300);  // Animacja trwa 300ms\r\n            $(this).css(\"transform\", \"scale(1)\");  // Przywraca normalny rozmiar\r\n        });\r\n    </script>\r\n</body>\r\n', 1),
(7, 'Kontakt', '<h1>Skontaktuj się z nami</h1>\r\n<!-- Nagłówek strony, zapraszający do kontaktu -->\r\n\r\n<form action=\"mailto:example@mail.com\" method=\"post\" enctype=\"text/plain\">\r\n    <!-- Formularz do wysyłania wiadomości na podany adres email (wysyła dane w formacie tekstowym) -->\r\n    \r\n    <label for=\"name\">Imię:</label>\r\n    <!-- Etykieta dla pola imienia -->\r\n    <input type=\"text\" id=\"name\" name=\"name\"><br><br>\r\n    <!-- Pole tekstowe do wpisania imienia -->\r\n    \r\n    <label for=\"email\">Email:</label>\r\n    <!-- Etykieta dla pola email -->\r\n    <input type=\"email\" id=\"email\" name=\"email\"><br><br>\r\n    <!-- Pole do wpisania adresu email (z walidacją poprawności formatu) -->\r\n    \r\n    <label for=\"message\">Wiadomość:</label><br>\r\n    <!-- Etykieta dla pola wiadomości -->\r\n    <textarea id=\"message\" name=\"message\" rows=\"5\" cols=\"40\"></textarea><br><br>\r\n    <!-- Pole tekstowe do wpisania wiadomości (wielowierszowe) -->\r\n    \r\n    <input type=\"submit\" value=\"Wyślij\">\r\n    <!-- Przycisk do wysyłania formularza -->\r\n</form>\r\n\r\n<body onload=\"startclock()\">\r\n    <!-- Funkcja startclock() uruchamiana przy załadowaniu strony, wyświetlająca zegar i datę -->\r\n    \r\n    <div id=\"zegarek\"></div>\r\n    <!-- Miejsce na wyświetlanie zegara -->\r\n    \r\n    <div id=\"data\"></div>\r\n    <!-- Miejsce na wyświetlanie daty -->\r\n    \r\n    <script>\r\n        // Efekt animacji dla elementu z ID animacjaTestowa1, który po kliknięciu zmienia swoje właściwości\r\n        $(\"#animacjaTestowa1\").on(\"click\", function(){\r\n            $(this).animate({\r\n                width: \"500px\",  // Zmienia szerokość na 500px\r\n                opacity: 0.4,  // Zmienia przezroczystość na 0.4\r\n                fontSize: \"3em\",  // Zmienia rozmiar czcionki na 3em\r\n                borderWidth: \"10px\"  // Zwiększa grubość ramki do 10px\r\n            }, 1500);  // Animacja trwa 1500ms (1.5 sekundy)\r\n        });\r\n\r\n        // Efekty animacji dla elementów z klasą color-button na zdarzenie mouseover i mouseout\r\n        $(\".color-button\").on(\"mouseover\", function(){\r\n                $(this).animate({\r\n                   width: 150  // Zwiększa szerokość elementu do 150px\r\n                }, 800);  // Animacja trwa 800ms\r\n        }).on(\"mouseout\", function(){\r\n            $(this).animate({\r\n                width: 100  // Przywraca szerokość do 100px\r\n            }, 800);  // Animacja trwa 800ms\r\n        });\r\n        \r\n        // Efekt powiększania dla elementu zegarek na zdarzenie mouseover i mouseout\r\n        $(\"#zegarek\").on(\"mouseover\", function(){\r\n            $(this).css(\"transform\", \"scale(1.2)\");  // Powiększa element 1.2 razy\r\n        }).on(\"mouseout\", function(){\r\n            $(this).css(\"transform\", \"scale(1)\");  // Przywraca normalny rozmiar\r\n        });\r\n        \r\n        // Efekt zmiany przezroczystości i powiększania dla elementu data na zdarzenie mouseover i mouseout\r\n        $(\"#data\").on(\"mouseover\", function(){\r\n            $(this).animate({\r\n                 opacity: 0.5  // Zmniejsza przezroczystość do 0.5\r\n            }, 300);  // Animacja trwa 300ms\r\n            $(this).css(\"transform\", \"scale(1.1)\");  // Powiększa element o 1.1 razy\r\n        }).on(\"mouseout\", function(){\r\n            $(this).animate({\r\n                 opacity: 1  // Przywraca pełną przezroczystość\r\n            }, 300);  // Animacja trwa 300ms\r\n            $(this).css(\"transform\", \"scale(1)\");  // Przywraca normalny rozmiar\r\n        });\r\n    </script>\r\n</body>\r\n\r\n', 1),
(8, 'Filmy', '<h1>Filmy o Największych Mostach Świata</h1>\r\n<p>Odkryj najdłuższe i najbardziej imponujące mosty świata dzięki poniższym filmom.</p>\r\n\r\n<div class=\"video-container\">\r\n    <h3>Most Danyang–Kunshan</h3>\r\n    <iframe width=\"800\" height=\"800\" src=\"https://www.youtube.com/embed/Q-2-7BfFtpo?si=GQspH9GGmzi4qG0-\" title=\"Most Danyang–Kunshan\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n</div>\r\n\r\n<div class=\"video-container\">\r\n    <h3>Lake Pontchartrain Causeway</h3>\r\n    <iframe width=\"800\" height=\"800\" src=\"https://www.youtube.com/embed/5xNegQlUtr8?si=spsf_EqbDvIpz9mj\" title=\"Lake Pontchartrain Causeway\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n</div>\r\n\r\n<div class=\"video-container\">\r\n    <h3>Golden Gate Bridge</h3>\r\n    <iframe width=\"800\" height=\"800\" src=\"https://www.youtube.com/embed/C8ZwEbhrco0?si=ynj-hbzTPNzEMnrC\" title=\"Golden Gate Bridge\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>\r\n</div>', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `tytul` varchar(255) NOT NULL,
  `opis` text NOT NULL,
  `cena_netto` decimal(10,2) NOT NULL,
  `podatek_vat` decimal(4,2) NOT NULL,
  `ilosc_sztuk` int(11) NOT NULL DEFAULT 0,
  `kategoria_id` int(11) DEFAULT NULL,
  `zdjecie` blob DEFAULT NULL,
  `gabaryt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `produkty`
--

INSERT INTO `produkty` (`id`, `tytul`, `opis`, `cena_netto`, `podatek_vat`, `ilosc_sztuk`, `kategoria_id`, `zdjecie`, `gabaryt`) VALUES
(1, 'Laptop INTEL', '', 1000.00, 0.00, 0, 3, 0x68747470733a2f2f696d672e676b6263646e2e636f6d2f73332f702f323032302d30372d32302f43454e4156412d46313538472d4c6170746f702d31352d362d496e63682d496e74656c2d43656c65726f6e2d4a343130352d3847422d31323847422d53696c7665722d3930383530362d2e6a7067, NULL),
(2, 'Słuchawki HyperX', '', 25.00, 0.23, 0, 4, 0x68747470733a2f2f63646e2e782d6b6f6d2e706c2f692f73657475702f696d616765732f70726f642f6269672f70726f647563742d6e65772d6269672c2c323031372f31322f70725f323031375f31325f32325f31325f31375f33315f3739395f30302e6a7067, NULL),
(3, 'Klawiatura Logitech', '', 75.00, 0.00, 0, 1, 0x68747470733a2f2f696d6167652e63656e656f7374617469632e706c2f646174612f70726f64756374732f3135363831363937342f692d6b6c61776961747572612d6c6f6769746563682d672d70726f2d782d746b6c2d6c6967687473706565642d74616374696c652d637a61726e792d3932303031323133362e6a7067, NULL),
(12, 'Komputer', '321321', 4500.00, 0.00, 1, 2, 0x68747470733a2f2f656e637279707465642d74626e332e677374617469632e636f6d2f73686f7070696e673f713d74626e3a414e64394763543569776548756d575a5072316e6c79374b6c5667743245704774756e657650394d5f2d70304a6b4b516e354e484348676e753970624e64673145396a6276323251424d394630304e767a5836665971362d62446d525f546d7a785473437738446162464d6d6e776963515739775834384749697655, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `page_list`
--
ALTER TABLE `page_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategoria_id` (`kategoria_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `page_list`
--
ALTER TABLE `page_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `produkty`
--
ALTER TABLE `produkty`
  ADD CONSTRAINT `produkty_ibfk_1` FOREIGN KEY (`kategoria_id`) REFERENCES `kategorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
