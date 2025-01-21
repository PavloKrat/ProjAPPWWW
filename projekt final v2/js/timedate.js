// Funkcja do pobierania dzisiejszej daty i wyświetlania jej
function gettheDate() {
    Todays = new Date();  // Pobiera aktualną datę i godzinę
    TheDate = "" + (Todays.getMonth() + 1) + "/" + Todays.getDate() + "/" + (Todays.getYear() - 100);  // Formatuje datę w formacie MM/DD/YY
    document.getElementById("data").innerHTML = TheDate;  // Wyświetla datę w elemencie HTML o ID "data"
}
 
var timerID = null;  // Zmienna do przechowywania ID timera
var timerRunning = false;  // Flaga wskazująca, czy zegar jest uruchomiony

// Funkcja zatrzymująca zegar
function stopclock() {
    if (timerRunning)  // Jeśli zegar jest uruchomiony
        clearTimeout(timerID);  // Zatrzymuje zegar
    timerRunning = false;  // Ustawia flagę na fałsz
}
 
// Funkcja uruchamiająca zegar
function startclock() {
    stopclock();  // Zatrzymuje zegar, jeśli był uruchomiony
    gettheDate();  // Pobiera i wyświetla datę
    showtime();  // Uruchamia wyświetlanie godziny
}
 
// Funkcja do wyświetlania aktualnego czasu
function showtime() {
    var now = new Date();  // Pobiera aktualną datę i godzinę
    var hours = now.getHours();  // Pobiera godziny
    var minutes = now.getMinutes();  // Pobiera minuty
    var seconds = now.getSeconds();  // Pobiera sekundy
    var timeValue = "" + ((hours > 12) ? hours - 12 : hours);  // Formatuje godziny (12-godzinny format)
    timeValue += ((minutes < 10) ? ":0" : ":") + minutes;  // Formatuje minuty
    timeValue += ((seconds < 10) ? ":0" : ":") + seconds;  // Formatuje sekundy
    timeValue += (hours >= 12) ? " P.M." : " A.M.";  // Dodaje oznaczenie AM/PM
    document.getElementById("zegarek").innerHTML = timeValue;  // Wyświetla czas w elemencie HTML o ID "zegarek"
    timerID = setTimeout("showtime()", 1000);  // Ustawia ponowne wywołanie funkcji co 1 sekundę
    timerRunning = true;  // Ustawia flagę na true, oznaczając, że zegar jest uruchomiony
}
