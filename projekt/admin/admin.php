<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); 
include_once 'cfg.php';
include_once 'showpage.php';
include_once 'admin_stron.php';
include_once 'zarzadzanieproduktami.php';


// Nawiązanie połączenia z bazą danych
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Funkcja wyświetlająca formularz logowania
function displayLoginForm() {
    return '
    <div class="logowanie">
        <h1 class="heading">Panel CMS:</h1>
        <div class="logowanie">
            <form method="post" name="LoginForm" action="">
                <table class="logowanie">
                    <tr><td class="log4_t">Login:</td><td><input type="text" name="login_email" class="logowanie" /></td></tr>
                    <tr><td class="log4_t">Hasło:</td><td><input type="password" name="login_pass" class="logowanie" /></td></tr>
                    <tr><td> </td><td><input type="submit" name="x1_submit" class="logowanie" value="Zaloguj" /></td></tr>
                </table>
            </form>
        </div>
    </div>';
}

// Obsługa logowania
if (isset($_POST['x1_submit'])) {
    if ($_POST['login_email'] == $GLOBALS['login'] && $_POST['login_pass'] == $GLOBALS['pass']) {
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

// Obsługa akcji na podstawie parametrów GET
if (isset($_GET['akcja'])) {
    $akcja = $_GET['akcja'];
    if ($akcja == 'lista') {
        echo displayPageList($conn);
    } elseif ($akcja == 'edytuj' && isset($_GET['id'])) {
        echo displayEditPageForm($conn, $_GET['id']);
    } elseif ($akcja == 'dodaj') {
        echo displayAddPageForm($conn);
    } elseif ($akcja == 'usun' && isset($_GET['id'])) {
        echo deletePage($conn, $_GET['id']);
    }
    
    elseif ($akcja == 'kategorie_lista') {
        echo displayCategoryList($conn);
    } elseif ($akcja == 'kategorie_dodaj') {
        echo displayAddCategoryForm($conn);
    } elseif ($akcja == 'kategorie_edytuj' && isset($_GET['id'])) {
        echo displayEditCategoryForm($conn, $_GET['id']);
    } elseif ($akcja == 'kategorie_usun' && isset($_GET['id'])) {
        echo deleteCategory($conn, $_GET['id']);
    }
    
     elseif ($akcja == 'produkt_lista') {
        echo displayProductList($conn);
    } elseif ($akcja == 'produkt_dodaj') {
        echo displayAddProductForm($conn);
    } elseif ($akcja == 'produkt_edytuj' && isset($_GET['id'])) {
        echo displayEditProductForm($conn, $_GET['id']);
    } elseif ($akcja == 'produkt_usun' && isset($_GET['id'])) {
         echo deleteProduct($conn, $_GET['id']);
    }
} else {
    echo displayPageList($conn);
}

// Linki do zarządzania kategoriami i produktami
echo "<br><br><a href='?akcja=kategorie_lista'>Zarządzaj Kategoriami</a>";
echo "<br><br><a href='?akcja=produkt_lista'>Zarządzaj Produktami</a>";

$conn->close();
?>
