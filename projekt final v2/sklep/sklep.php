<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../cfg.php';
include_once '../admin/showpage.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

function pobierzWszystkieKategorie($conn) {
    $query = "SELECT id, nazwa FROM kategorie";
    $result = $conn->query($query);
    if (!$result) return [];
    $kategorie = [];
    while ($row = $result->fetch_assoc()) {
        $kategorie[] = $row;
    }
    return $kategorie;
}

function pobierzWszystkieProdukty($conn) {
    $query = "SELECT * FROM produkty";
    $result = $conn->query($query);
    if (!$result) return [];
    $produkty = [];
    while ($row = $result->fetch_assoc()) {
        $produkty[] = $row;
    }
    return $produkty;
}

function dodajDoKoszyka($id_prod, $ile_sztuk) {
    if (!isset($_SESSION['koszyk'])) {
        $_SESSION['koszyk'] = [];
    }
    $_SESSION['koszyk'][] = [
        'id_prod' => intval($id_prod),
        'ile_sztuk' => intval($ile_sztuk),
        'data' => time()
    ];
}

function usunZKoszyka($index) {
    if (isset($_SESSION['koszyk'][$index])) {
        unset($_SESSION['koszyk'][$index]);
        $_SESSION['koszyk'] = array_values($_SESSION['koszyk']);
    }
}

function pokazKoszyk() {
    return isset($_SESSION['koszyk']) ? $_SESSION['koszyk'] : [];
}

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

if (isset($_GET['dodaj_do_koszyka'])) {
    dodajDoKoszyka($_GET['id_prod'], $_GET['ile_sztuk']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_GET['usun_z_koszyka'])) {
    usunZKoszyka($_GET['index']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

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
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        main {
            padding: 20px;
        }
        .produkt {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: white;
            padding: 10px;
        }
        .produkt img {
            max-width: 150px;
            height: auto;
            margin-right: 15px;
        }
        .produkt-info {
            flex: 1;
        }
        .koszyk {
            border-top: 2px solid #007bff;
            margin-top: 30px;
            padding-top: 15px;
        }
        .koszyk ul {
            list-style: none;
            padding: 0;
        }
        .koszyk ul li {
            border-bottom: 1px dashed #ccc;
            padding: 10px 0;
        }
        footer {
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            margin-top: 20px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
		 ul {
            list-style-type: none;
            padding: 0;
            margin: 0; 
        }

        li {
            display: inline;
            margin-right: 10px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Koszyk Zakupów</h1>
    <ul>
        <li><a href="../index.php?id=4">Strona Główna</a></li>
    </ul>
    </header>
    <main>
        <section>
            <h2>Produkty</h2>
            <?php foreach ($kategorie as $kategoria) : ?>
                <h3><?php echo htmlspecialchars($kategoria['nazwa']); ?></h3>
                <?php foreach ($produkty as $produkt) : ?>
                    <?php if ($produkt['kategoria_id'] == $kategoria['id']) : ?>
                        <div class="produkt">
                            <img src="<?php echo htmlspecialchars($produkt['zdjecie'] ?? 'placeholder.jpg'); ?>" alt="Zdjecie produktu">
                            <div class="produkt-info">
                                <strong><?php echo htmlspecialchars($produkt['tytul']); ?></strong><br>
                                Cena netto: <?php echo number_format($produkt['cena_netto'], 2); ?> PLN<br>
                                Podatek VAT: <?php echo $produkt['podatek_vat'] * 100; ?>%<br>
                                <form method="GET">
                                    <input type="hidden" name="dodaj_do_koszyka" value="true">
                                    <input type="hidden" name="id_prod" value="<?php echo $produkt['id']; ?>">
                                    Ilość: <input type="number" name="ile_sztuk" value="1" min="1" style="width: 50px;">
                                    <button type="submit">Dodaj do koszyka</button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </section>

        <section class="koszyk">
            <h2>Twój Koszyk</h2>
            <?php if (!empty($koszyk)) : ?>
                <ul>
                    <?php foreach ($koszyk as $index => $item) : ?>
                        <?php
                        $query = "SELECT tytul, zdjecie FROM produkty WHERE id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $item['id_prod']);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $produkt = $result->fetch_assoc();
                        ?>
                        <li>
                            <strong><?php echo htmlspecialchars($produkt['tytul']); ?></strong><br>
                            <img src="<?php echo htmlspecialchars($produkt['zdjecie'] ?? 'placeholder.jpg'); ?>" alt="Zdjecie produktu" style="max-width: 50px; height: auto;"><br>
                            Ilość: <?php echo $item['ile_sztuk']; ?>
                            <a href="?usun_z_koszyka=true&index=<?php echo $index; ?>">Usuń</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p>Łączna cena: <?php echo number_format($cenaCalkowita, 2); ?> PLN</p>
            <?php else : ?>
                <p>Twój koszyk jest pusty.</p>
            <?php endif; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Koszyk Zakupów</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>

