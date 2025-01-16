var computed = false;  // Zmienna śledząca, czy obliczenia zostały wykonane
var decimal = 0;  // Zmienna śledząca, czy wprowadzono już przecinek dziesiętny

// Funkcja do konwersji jednostek
function convert(entryform, from, to) {
    convertfrom = from.selectedIndex;  // Pobiera indeks wybranej jednostki do konwersji (z pola "from")
    convertto = to.selectedIndex;  // Pobiera indeks jednostki docelowej (z pola "to")
    entryform.display.value = (entryform.input.value * from[convertfrom].value / to[convertto].value);  // Wykonuje konwersję i wyświetla wynik w polu "display"
}

// Funkcja do dodawania znaków do wejścia (np. liczby)
function addChar(input, character) {
    // Jeśli wprowadzony znak to kropka i nie jest jeszcze wprowadzone "0" lub kropka, lub jeśli znak nie jest kropką
    if ((character == "." && decimal == "0") || character != ".") {
        (input.value == "" || input.value == "0") ? input.value = character : input.value += character;  // Dodaje znak do pola wejściowego (input)
        convert(input.form, input.form.measure1, input.form.measure2);  // Wykonuje konwersję po dodaniu znaku
        computed = true;  // Ustawia flagę na true, że obliczenia zostały wykonane
        if (character == ".") {  // Jeśli dodano kropkę
            decimal = 1;  // Ustawia zmienną decimal na 1 (oznacza, że wprowadzono kropkę)
        }
    }
}

// Funkcja otwierająca okno (np. do wyświetlania wyników lub innych informacji)
function openVothcom() {
    window.open("", "Display window", "toolbar=no,directories=no,menubar=no");  // Otwiera puste okno bez paska narzędzi, menu itp.
}

// Funkcja do czyszczenia formularza
function clear(form) {
    form.input.value = 0;  // Ustawia pole wejściowe na 0
    form.display.value = 0;  // Ustawia pole wyświetlania na 0
    decimal = 0;  // Ustawia zmienną decimal z powrotem na 0 (brak kropki)
}

// Funkcja do zmiany koloru tła strony na podstawie podanego hex
function changeBackground(hexNumber) {
    document.bgColor = hexNumber;  // Ustawia kolor tła strony na podany w parametrze hex
}
