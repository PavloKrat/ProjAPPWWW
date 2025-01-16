<?php
// Rozpoczęcie sesji i ustawienia wyświetlania błędów
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Wczytanie plików konfiguracyjnych i funkcji
include_once 'cfg.php';
include_once 'showpage.php';

// Połączenie z bazą danych
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Funkcja do pobierania wszystkich kategorii
function pobierzWszystkieKategorie($conn) {
    $query = "SELECT id, nazwa, matka FROM kategorie";
    $result = $conn->query($query);
    if (!$result) return [];
    $kategorie = [];
    while ($row = $result->fetch_assoc()) {
        $kategorie[] = $row;
    }
    return $kategorie;
}

// Funkcja do pobierania wszystkich produktów
function pobierzWszystkieProdukty($conn) {
    $query = "SELECT id, tytul, cena_netto, podatek_vat, kategoria_id FROM produkty";
    $result = $conn->query($query);
    if (!$result) return [];
    $produkty = [];
    while ($row = $result->fetch_assoc()) {
        $produkty[] = $row;
    }
    return $produkty;
}

// Funkcja do dodawania produktu do koszyka
function dodajDoKoszyka($id_prod, $ile_sztuk, $wielkosc) {
    if (!isset($_SESSION['koszyk'])) {
        $_SESSION['koszyk'] = [];
    }
    // Dodawanie nowego produktu do koszyka
    $_SESSION['koszyk'][] = [
        'id_prod' => $id_prod,
        'ile_sztuk' => $ile_sztuk,
        'wielkosc' => $wielkosc,
        'data' => time()
    ];
}

// Funkcja do usuwania produktu z koszyka
function usunZKoszyka($index) {
    if (isset($_SESSION['koszyk'][$index])) {
        unset($_SESSION['koszyk'][$index]);
        $_SESSION['koszyk'] = array_values($_SESSION['koszyk']); // Resetowanie indeksów
    }
}

// Funkcja do wyświetlania koszyka
function pokazKoszyk() {
    return isset($_SESSION['koszyk']) ? $_SESSION['koszyk'] : [];
}

// Funkcja do obliczania łącznej ceny koszyka
function obliczCeneCalkowita($conn) {
    $koszyk = pokazKoszyk();
    $cenaCalkowita = 0;
    foreach ($koszyk as $item) {
        $query = "SELECT cena_netto, podatek_vat FROM produkty WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $item['id_prod']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($produkt = $result->fetch_assoc()) {
            $cenaCalkowita += $produkt['cena_netto'] * (1 + $produkt['podatek_vat']) * $item['ile_sztuk'];
        }
        $stmt->close();
    }
    return $cenaCalkowita;
}

// Obsługa dodawania do koszyka
if (isset($_GET['dodaj_do_koszyka'])) {
    dodajDoKoszyka($_GET['id_prod'], $_GET['ile_sztuk'], $_GET['wielkosc']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Obsługa usuwania z koszyka
if (isset($_GET['usun_z_koszyka'])) {
    usunZKoszyka($_GET['index']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Pobieranie danych
$kategorie = pobierzWszystkieKategorie($conn);
$produkty = pobierzWszystkieProdukty($conn);
$koszyk = pokazKoszyk();
$cenaCalkowita = obliczCeneCalkowita($conn);

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koszyk Zakupów</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        header {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            text-align: center;
        }
        header h1 {
            margin: 0;
        }
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            background-color: #0056b3;
        }
        nav ul li {
            margin: 0 10px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        nav ul li a:hover {
            background-color: #004494;
        }
        main {
            padding: 20px;
        }
        .kategoria, .koszyk {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }
        .kategoria h3 {
            margin-top: 0;
        }
        .produkt {
            padding: 10px 0;
            border-bottom: 1px dashed #ddd;
        }
        .produkt:last-child {
            border-bottom: none;
        }
        .koszyk ul {
            list-style: none;
            padding: 0;
        }
        .koszyk ul li {
            padding: 10px 0;
            border-bottom: 1px dashed #ddd;
        }
        .koszyk ul li:last-child {
            border-bottom: none;
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: #007bff;
            color: #fff;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Koszyk Zakupów</h1>
        <nav>
            <ul>
                <li><a href="index.php?id=4">Strona Główna</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="produkty">
            <h2>Katalog Produktów</h2>
            <?php if (!empty($kategorie)) : ?>
                <?php foreach ($kategorie as $kategoria) : ?>
                    <div class="kategoria">
                        <h3><?php echo htmlspecialchars($kategoria['nazwa']); ?></h3>
                        <?php foreach ($produkty as $produkt) : ?>
                            <?php if ($produkt['kategoria_id'] == $kategoria['id']) : ?>
                                <div class="produkt">
                                    <strong><?php echo htmlspecialchars($produkt['tytul']); ?></strong><br>
                                    Cena netto: <?php echo number_format($produkt['cena_netto'], 2); ?> PLN<br>
                                    <form method="GET">
                                        <input type="hidden" name="dodaj_do_koszyka" value="true">
                                        <input type="hidden" name="id_prod" value="<?php echo $produkt['id']; ?>">
                                        Ilość: <input type="number" name="ile_sztuk" value="1" min="1" style="width: 50px;">
                                        <input type="hidden" name="wielkosc" value="domyślna">
                                        <button type="submit">Dodaj do koszyka</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Brak dostępnych kategorii.</p>
            <?php endif; ?>
        </section>

        <section class="koszyk">
            <h2>Twój Koszyk</h2>
            <?php if (!empty($koszyk)) : ?>
                <ul>
                    <?php foreach ($koszyk as $index => $item) : ?>
                        <li>
                            ID Produktu: <?php echo $item['id_prod']; ?> | Ilość: <?php echo $item['ile_sztuk']; ?> | Wielkość: <?php echo $item['wielkosc']; ?>
                            <a href="?usun_z_koszyka=true&index=<?php echo $index; ?>">Usuń</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p>Łączna Cena: <?php echo number_format($cenaCalkowita, 2); ?> PLN</p>
            <?php else : ?>
                <p>Twój koszyk jest pusty.</p>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Koszyk Zakupów.</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
