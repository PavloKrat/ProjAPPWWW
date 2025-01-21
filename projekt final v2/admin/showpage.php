<?php

// Funkcja do zabezpieczenia danych wejściowych (usunięcie niechcianych znaków i konwersja znaków specjalnych)
function sanitize($data) {
    return htmlspecialchars(trim($data ?? ''));
}

// Funkcja do pobierania produktu na podstawie jego ID
function fetchProductById($conn, $id)
{
  $stmt = $conn->prepare("SELECT * FROM produkty WHERE id = ? LIMIT 1");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result === false || $result->num_rows === 0) {
    $stmt->close();
    return null;
  }
  $produkt = $result->fetch_assoc();
  $stmt->close();
  return $produkt;
}

// Funkcja do formatowania ceny w formacie polskim
function formatPrice($price) {
    return number_format($price, 2, ',', ' ');
}

// Funkcja do pobierania strony na podstawie ID
function fetchPage($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM page_list WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result === false || $result->num_rows === 0) {
      return null;
    }
    $page = $result->fetch_assoc();
    $stmt->close();
    return $page;
}

// Funkcja do pobierania kategorii na podstawie ID
function fetchCategoryById($conn, $id){
  $stmt = $conn->prepare("SELECT * FROM kategorie WHERE id = ? LIMIT 1");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result === false || $result->num_rows === 0) {
      $stmt->close();
      return null;
   }
  $kategoria = $result->fetch_assoc();
  $stmt->close();
  return $kategoria;
}

// Funkcja do pobierania listy wszystkich stron
function fetchAllPages($conn) {
    $query = "SELECT id, page_title FROM page_list LIMIT 100";
    $result = $conn->query($query);

    if (!$result) {
        return null; 
    }

    $pages = [];
    while ($row = $result->fetch_assoc()) {
        $pages[] = $row;
    }
    return $pages;
}

// Funkcja do pobierania kategorii dla rozwijanej listy
function fetchCategoriesForDropdown($conn) {
  $query = "SELECT id, nazwa FROM kategorie LIMIT 100";
  $result = $conn->query($query);
  if (!$result) {
      return null;
  }
  $kategorie = "";
  while ($row = $result->fetch_assoc()) {
      $kategorie .= "<option value='" . $row['id'] . "'>" . sanitize($row['nazwa'] ?? '') . "</option>";
  }
   return $kategorie;
}

// Funkcja do generowania drzewa kategorii (dla panelu administratora)
 function generateCategoryTree($conn, $parent = 0, $level = 0) {
    $wynik = "<ul>";
    $stmt = $conn->prepare("SELECT * FROM kategorie WHERE matka = ?");
    $stmt->bind_param("i", $parent);
    $stmt->execute();
     $result = $stmt->get_result();
      if (!$result) {
        return "Database error: " . $conn->error;
    }
    while ($row = $result->fetch_assoc()) {
        $wynik .= "<li>" . str_repeat("    ", $level) .
        "ID: " . $row['id'] . " | " .
        "Nazwa: " . sanitize($row['nazwa'] ?? '') . " | " .
        "Matka: " . $row['matka'] . " | " .
        "<a href='?akcja=kategorie_edytuj&id=" . $row['id'] . "'>Edytuj</a> | " .
        "<a href='?akcja=kategorie_usun&id=" . $row['id'] . "'>Usuń</a>";
        $wynik .= generateCategoryTree($conn, $row['id'], $level + 1);
        $wynik .= "</li>";
    }
    $wynik .= "</ul>";
     $stmt->close();
    return $wynik;
}

// Funkcja do generowania drzewa kategorii (dla frontendu strony)
function generateCategoryTreeFront($conn, $parent = 0, $level = 0) {
    $stmt = $conn->prepare("SELECT * FROM kategorie WHERE matka = ?");
    $stmt->bind_param("i", $parent);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        return "Database error: " . $conn->error;
    }
    $wynik = "<ul>";
    while ($row = $result->fetch_assoc()) {
        $wynik .= "<li>" . str_repeat("    ", $level) . sanitize($row['nazwa']);
        $wynik .= generateCategoryTreeFront($conn, $row['id'], $level + 1);
        $wynik .= "</li>";
    }
    $wynik .= "</ul>";
    $stmt->close();
    return $wynik;
}
?>