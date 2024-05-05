<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "bazaprojekt";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Błąd połączenia z bazą danych: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == 'edytujOgloszenie') {
        $ogloszenie_id = $_POST['ogloszenie_id'] ?? null;
        
        if ($ogloszenie_id === null) {
            die("Błąd: Brak ID ogłoszenia.");
        }

        $zapytanie = "SELECT * FROM ogloszeniapracy WHERE ogloszenie_id = $ogloszenie_id";
        $wynik = $mysqli->query($zapytanie);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == 'edytujOgloszenie') {
        $NazwaStanowiska = $_POST['NazwaStanowiska'];
        $PoziomZatrudnienia = $_POST['Poziom'];
        $RodzajUmowy = $_POST['Rodzajumowy'];
        $RodzajPracy = $_POST['rodzajPracy'];
        $PracaZdalna = $_POST['pracaZdalna'];
        $WidełkiWynagrodzenia = $_POST['wynagrodzenie'];
        $DniPracy = $_POST['dnipracy'];
        $GodzinyPracy = $_POST['GodzinyPracy'];
        $DataWygaśnięcia = $_POST['dataWygasniecia'];
        $Kategoria = $_POST['kategoria'];
        $OpisStanowiska = $_POST['Opis'];
        $Wymagania = $_POST['Wymagania'];
        $Oferty = null;
        $Zdjecie = $_POST['Zdj'];

        $updateQuery = "UPDATE `ogloszeniapracy` SET `NazwaStanowiska`='$NazwaStanowiska', `PoziomZatrudnienia`='$PoziomZatrudnienia', `RodzajUmowy`='$RodzajUmowy', `RodzajPracy`='$RodzajPracy', `PracaZdalna`='$PracaZdalna', `WidelkiWynagrodzenia`='$WidełkiWynagrodzenia', `DniPracy`='$DniPracy', `GodzinyPracy`='$GodzinyPracy', `DataWygasniecia`='$DataWygaśnięcia', `Kategoria`='$Kategoria', `OpisStanowiska`='$OpisStanowiska', `Wymagania`='$Wymagania', `Oferty`='$Oferty', `Zdjecie`='$Zdjecie' WHERE ogloszenie_id='$ogloszenie_id'";


        if ($mysqli->query($updateQuery) === TRUE) {
            echo '<meta http-equiv="refresh" content="0;url=StronaOgloszenia.php?id=' . $ogloszenie_id  . '">';
            exit();
        } else {
            echo "Błąd podczas aktualizacji danych: " . $mysqli->error;
        }
    } elseif ($_POST['action'] == 'usunOgloszenie') {
        $ogloszenie_id = $_POST['ogloszenie_id'] ?? null;
        
        if ($ogloszenie_id === null) {
            die("Błąd: Brak ID ogłoszenia.");
        }

        $deleteQuery = "DELETE FROM ogloszeniapracy WHERE ogloszenie_id='$ogloszenie_id'";

        if ($mysqli->query($deleteQuery) === TRUE) {
            echo '<meta http-equiv="refresh" content="0;url=KontoFirma.php">';
            exit();
        } else {
            echo "Błąd podczas usuwania ogłoszenia: " . $mysqli->error;
        }
    }
}
?>