<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moja_strona";

$login = "admin";
$pass = "1234";

// Tworzenie połączenia
$conn = new mysqli($servername, $username, $password, $dbname);

// Sprawdzanie połączenia
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

// Ustawienie kodowania znaków na UTF-8
$conn->set_charset("utf8");
?>
