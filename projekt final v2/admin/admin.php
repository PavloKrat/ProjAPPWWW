<?php
// Konfiguracja bazy danych i ustawienia
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include_once '../cfg.php';
include_once 'showpage.php';
include_once 'admin_stron.php';
include_once 'zarzadzanieproduktami.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Błąd połączenia z bazą danych: " . $conn->connect_error);
}

// Funkcja wyświetlająca formularz logowania
function displayLoginForm() {
    return '<div class="logowanie">
                <h1>Panel Administracyjny</h1>
                <form method="post">
                    <label>Login:</label>
                    <input type="text" name="login_email" required><br>
                    <label>Hasło:</label>
                    <input type="password" name="login_pass" required><br>
                    <button type="submit" name="x1_submit">Zaloguj</button>
                </form>
            </div>';
}

// Funkcja wyświetlająca przycisk powrotu do panelu
function displayBackToPanelButton() {
    return '<div class="back-to-panel">
                <a href="admin.php" class="btn-back">Powrót do Panelu Głównego</a>
            </div>';
}

// Obsługa logowania
if (isset($_POST['x1_submit'])) {
    if ($_POST['login_email'] === $login && $_POST['login_pass'] === $pass) {
        $_SESSION['zalogowany'] = true;
    } else {
        echo "<p style='color:red;'>Błędny login lub hasło!</p>";
        echo displayLoginForm();
        exit();
    }
}

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['zalogowany'])) {
    echo displayLoginForm();
    exit();
}

// Obsługa akcji w panelu administracyjnym
if (isset($_GET['akcja'])) {
    $akcja = $_GET['akcja'];
    switch ($akcja) {
        case 'lista':
            echo displayPageList($conn);
            echo displayBackToPanelButton();
            break;
        case 'edytuj':
            echo isset($_GET['id']) ? displayEditPageForm($conn, $_GET['id']) : "<p>Błędne ID strony</p>";
            echo displayBackToPanelButton();
            break;
        case 'dodaj':
            echo displayAddPageForm($conn);
            echo displayBackToPanelButton();
            break;
        case 'usun':
            echo isset($_GET['id']) ? deletePage($conn, $_GET['id']) : "<p>Błędne ID strony</p>";
            echo displayBackToPanelButton();
            break;
        case 'kategorie_lista':
            echo displayCategoryList($conn);
            echo displayBackToPanelButton();
            break;
        case 'kategorie_dodaj':
            echo displayAddCategoryForm($conn);
            echo displayBackToPanelButton();
            break;
        case 'kategorie_edytuj':
            echo isset($_GET['id']) ? displayEditCategoryForm($conn, $_GET['id']) : "<p>Błędne ID kategorii</p>";
            echo displayBackToPanelButton();
            break;
        case 'kategorie_usun':
            echo isset($_GET['id']) ? deleteCategory($conn, $_GET['id']) : "<p>Błędne ID kategorii</p>";
            echo displayBackToPanelButton();
            break;
        case 'produkt_lista':
            echo displayProductList($conn);
            echo displayBackToPanelButton();
            break;
        case 'produkt_dodaj':
            echo displayAddProductForm($conn);
            echo displayBackToPanelButton();
            break;
        case 'produkt_edytuj':
            echo isset($_GET['id']) ? displayEditProductForm($conn, $_GET['id']) : "<p>Błędne ID produktu</p>";
            echo displayBackToPanelButton();
            break;
        case 'produkt_usun':
            echo isset($_GET['id']) ? deleteProduct($conn, $_GET['id']) : "<p>Błędne ID produktu</p>";
            echo displayBackToPanelButton();
            break;
        default:
            echo "<p>Nieznana akcja</p>";
    }
} else {
    echo "<h1>Witaj w panelu administracyjnym!</h1>";
    echo "<ul class='menu'>
            <li><a href='?akcja=lista'>Zarządzaj stronami</a></li>
            <li><a href='?akcja=kategorie_lista'>Zarządzaj kategoriami</a></li>
            <li><a href='?akcja=produkt_lista'>Zarządzaj produktami</a></li>
          </ul>";
}

echo "<div class='header-buttons'>";
echo "<a href='../index.php?id=4' class='button'>Wróć na stronę główną</a>";
echo "</div>";
$conn->close();
?>

<style>
    body {
        font-family: 'Roboto', Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
        color: #333;
    }
    h1 {
        text-align: center;
        color: #444;
        margin-top: 20px;
    }
    .menu {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin: 20px 0;
    }
    .menu li {
        margin: 0 10px;
    }
    .menu li a {
        text-decoration: none;
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .menu li a:hover {
        background-color: #0056b3;
    }
    .logowanie {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }
    .logowanie input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .logowanie button {
        width: 100%;
        background: #007bff;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .logowanie button:hover {
        background: #0056b3;
    }
    .header-buttons {
        text-align: center;
        margin-top: 20px;
    }
    .button {
        background-color: #28a745;
        color: white;
        text-decoration: none;
        padding: 10px 15px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .button:hover {
        background-color: #218838;
    }
    .btn-back {
        display: block;
        width: max-content;
        margin: 20px auto;
        padding: 10px 15px;
        text-align: center;
        background: #007bff;
        color: white;
        border-radius: 5px;
        text-decoration: none;
    }
    .btn-back:hover {
        background: #0056b3;
    }
</style>
