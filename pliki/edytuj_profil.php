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

    if ($_POST['action'] == 'personalne') {
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        $dataUrodzenia = $_POST['DataUrodzenia'];
        $zdj = $_POST['zdj'];
        $adres = $_POST['adres'];
        $stanowiskoPracy = $_POST['stanowiskoPracy'];
        $opisStanowiskaPracy = $_POST['opisStanowiskaPracy'];
        $Podsumowaniezawodowe = $_POST['Podsumowaniezawodowe'];
        $LinkedInProfil = $_POST['LinkedInProfil'];
        $ProfilGIT = $_POST['ProfilGIT'];

        $updateQuery = "UPDATE użytkownicy SET imię='$imie', nazwisko='$nazwisko', DataUrodzenia='$dataUrodzenia', ZdjęcieProfilowe='$zdj', adres='$adres', AktualneStanowiskoPracy='$stanowiskoPracy', opisStanowiskaPracy='$opisStanowiskaPracy', Podsumowaniezawodowe='$Podsumowaniezawodowe', LinkedInProfil='$LinkedInProfil', GitHubProfil='$ProfilGIT' WHERE Użytkownik_id = $_SESSION[current_user]";

        if ($mysqli->query($updateQuery) === TRUE) {
            echo '<meta http-equiv="refresh" content="0;url=Konto.php">';
            exit();
        } else {
            echo "Błąd podczas aktualizacji danych: " . $mysqli->error;
        }
    }

    if ($_POST['action'] == 'danefirma') {
        $nazwa = $_POST['nazwafirma'];
        $adres = $_POST['adresfirma'];

        $updateQuery = "UPDATE firmy SET NazwaFirmy='$nazwa', AdresFirmy='$adres' WHERE Firma_id = $_SESSION[current_firma]";

        if ($mysqli->query($updateQuery) === TRUE) {
            echo '<meta http-equiv="refresh" content="0;url=KontoFirma.php">';
            exit();
        } else {
            echo "Błąd podczas aktualizacji danych: " . $mysqli->error;
        }
    }

    if ($_POST['action'] == 'danekontafirmy') {
        $nazwa = $_POST['nazwauzytkownikafirmy'];
        $haslo = $_POST['haslouzytkownikafirmy'];

        $updateQuery = "UPDATE kontafirm SET NazwaUżytkownika='$nazwa', Hasło='$haslo' WHERE Firma_id = $_SESSION[current_firma]";

        if ($mysqli->query($updateQuery) === TRUE) {
            echo '<meta http-equiv="refresh" content="0;url=KontoFirma.php">';
            exit();
        } else {
            echo "Błąd podczas aktualizacji danych: " . $mysqli->error;
        }
    }


    if ($_POST['action'] == 'kontaktowe') {
        $email = $_POST['email'];
        $nrTel = $_POST['nrtel'];

        $updateQuery = "UPDATE użytkownicy SET Email='$email', NumerTelefonu='$nrTel' WHERE Użytkownik_id = $_SESSION[current_user]";

        if ($mysqli->query($updateQuery) === TRUE) {
            echo '<meta http-equiv="refresh" content="0;url=Konto.php">';
            exit();
        } else {
            echo "Błąd podczas aktualizacji danych kontaktowych: " . $mysqli->error;
        }
    }

    if ($_POST['action'] == 'wyksztalcenie') {
        $nazwaSzkoly = $_POST['nazwaSzkoly'];
        $lokalizacja = $_POST['Lokalizacja'];
        $poziomWyksztalcenia = $_POST['PoziomWyksztalcenia'];
        $kierunek = $_POST['Kierunek'];
        $okres = $_POST['Okres'];

        $updateQuery = "UPDATE wykształcenie SET NazwaSzkolyUczelni='$nazwaSzkoly', Lokalizacja='$lokalizacja', PoziomWykształcenia='$poziomWyksztalcenia', Kierunek='$kierunek', Okres='$okres' WHERE Użytkownik_id = $_SESSION[current_user]";

        if ($mysqli->query($updateQuery) === TRUE) {
            echo '<meta http-equiv="refresh" content="0;url=Konto.php">';
            exit();
        } else {
            echo "Błąd podczas aktualizacji danych wykształcenia: " . $mysqli->error;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if ($_POST['action'] == 'doswiadczenie') {
            $stanowisko = $_POST['stanowiskaa'];
            $nazwaFirmy = $_POST['NazwaFirmyy'];
            $lokalizacjaDoswiadczenia = $_POST['Lokalizacjaa'];
            $okresZatrudnienia = $_POST['Okress'];
            $obowiazki = $_POST['Obowiazkii'];
    
            $updateQuery = "UPDATE doświadczenie SET Stanowisko='$stanowisko', NazwaFirmy='$nazwaFirmy', Lokalizacja='$lokalizacjaDoswiadczenia', OkresZatrudnienia='$okresZatrudnienia', Obowiązki='$obowiazki' WHERE Użytkownik_id = $_SESSION[current_user]";
    
            if ($mysqli->query($updateQuery) === TRUE) {
                echo '<meta http-equiv="refresh" content="0;url=Konto.php">';
                exit();
            } else {
                echo "Błąd podczas aktualizacji danych doświadczenia: " . $mysqli->error;
            }
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if ($_POST['action'] == 'umiejetnosci') {
            $umiejetnosci = explode(', ', $_POST['nazwaUmiejetnoscii']);
    
            $updateQuery = "UPDATE umiejętności SET NazwaUmiejętności=CONCAT('$umiejetnosci') WHERE Użytkownik_id = $_SESSION[current_user]";
    
            if ($mysqli->query($updateQuery) === TRUE) {
                echo '<meta http-equiv="refresh" content="0;url=Konto.php">';
                exit();
            } else {
                echo "Błąd podczas aktualizacji danych umiejętności: " . $mysqli->error;
            }
        }
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['action'] == 'jezyki') {

        $nazwaJezyka = $_POST['NazwaJezykaa'];
        $poziomZnajomosci = $_POST['poziomZnajomoscii'];

        $updateQuery = "UPDATE języki SET NazwaJęzyka='$nazwaJezyka', PoziomZnajomości='$poziomZnajomosci' WHERE Użytkownik_id = $_SESSION[current_user]";

        if ($mysqli->query($updateQuery) === TRUE) {
            echo '<meta http-equiv="refresh" content="0;url=Konto.php">';
            exit();
        } else {
            echo "Błąd podczas aktualizacji danych języków: " . $mysqli->error;
        }
    }
}
}

$mysqli->close();
?>