<?php
include('cfg.php'); // Połączenie z bazą danych
include('showpage.php'); // Funkcja do obsługi strony z bazy danych
include('contact.php');

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); // Raportowanie błędów z pominięciem NOTICE i WARNING

// Pobieranie ID strony z URL lub ustawienie domyślnej wartości
$page_id = isset($_GET['id']) ? intval($_GET['id']) : 1; // Domyślnie wyświetla stronę z ID = 1

// Funkcja do pobierania danych strony z bazy
function pobierzStrone($conn, $page_id) {
    $query = "SELECT page_title, page_content FROM page_list WHERE id = ? AND status = 1 LIMIT 1";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Błąd zapytania: " . $conn->error);
    }

    $stmt->bind_param("i", $page_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Pobieranie danych strony
$page = pobierzStrone($conn, $page_id);

if ($page) {
    $page_title = htmlspecialchars($page['page_title']);
    $page_content = $page['page_content'];
} else {
    $page_title = "Strona nie znaleziona";
    $page_content = "<p>Przepraszamy, żądana strona nie istnieje.</p>";
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Language" content="pl">
    <meta name="Author" content="Pavlo Krat">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="css/styl.css">
    <script src="js/kolorujtlo.js" type="text/javascript"></script>
    <script src="js/timedate.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <!-- Menu nawigacyjne -->
    <div class="menu">
        <ul>
            <li><a href="index.php?id=4">Strona Główna</a></li>
            <li><a href="index.php?id=3">Mosty</a></li>
            <li><a href="index.php?id=5">Galeria</a></li>
            <li><a href="index.php?id=6">Historia</a></li>
            <li><a href="index.php?id=7">Kontakt</a></li>
            <li><a href="index.php?id=8">Filmy</a></li>
            <li><a href="sklep.php">Sklep</a></li>
        </ul>
    </div>

    <!-- Główna zawartość strony -->
    <main>
        <h1><?php echo $page_title; ?></h1>
        <div>
            <?php echo $page_content; ?>
        </div>
    <?php PokazKontakt(); ?>
    </main>

    <!-- Stopka strony -->
    <footer>
         <?php
        $nrIndeksu = 169300;
        $nrGrupy = 2;
        echo "Autor:Pavlo Krat " . $nrIndeksu . " grupa " . $nrGrupy . "<br/><br/>";
        ?>

        <p>&copy; 2024 Największe Mosty Świata.</p>
    </footer>
</body>
</html>



















