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

if (isset($_SESSION["current_firma"])) {
    $navbarButton = '<a href="KontoFirma.php" role="button" class="btn btn-outline-dark" type="submit">KONTO</a>';

} else {

    $navbarButton = '<a href="StronaGlowna.php" role="button" class="btn btn-outline-dark" type="submit">ZALOGUJ</a>';
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['logout'])) {

        session_unset();
        session_destroy();


        echo '<meta http-equiv="refresh" content="0;url=StronaGlowna.php">';
        exit();
    }
}

$userID = $_SESSION["current_firma"];  


$query = "SELECT NazwaUzytkownika, Haslo FROM kontafirm WHERE Firma_id = $userID";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();

    $nazwaUzytkownikaFirmy = $userData['NazwaUzytkownika'];
    $Haslokontafirmy = $userData['Haslo'];
}

$query = "SELECT NazwaFirmy, AdresFirmy FROM firmy WHERE Firma_id = $userID";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();

    $NazwaFirmy = $userData['NazwaFirmy'];
    $AdresFirmy = $userData['AdresFirmy'];
}

$mysqli->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje Konto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
        <div class="container-fluid mt ">
            <img src="../Grafiki/LogoPortalu.png" style="width: 150px;" class="navbar-brand">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse w-100 " id="navbarNav">
                <ul class="navbar-nav ms-auto w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="StronaGlowna.php">Strona główna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="PanelOgloszen.php">Panel ogłoszeniowy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontakt.php">Kontakt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="polityka.php">Polityka prywatności</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <?php echo $navbarButton; ?>
                </form>
                
            </div>
        </div>
    </nav>
<div class="container mt-3">
    <div class="row card  card-body mt-4">
    </div>
</div>

<div class="container mt-5">

<?php 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['przyjmij'])) {
        $uzytkownik_id = $_POST['uzytkownik_id'];

        $host = "localhost";
                $username = "root";
                $password = "";
                $database = "bazaprojekt";

                $mysqli = new mysqli($host, $username, $password, $database);

                $zapytanie = "SELECT * FROM ogloszeniapracy WHERE Firma_id = $userID";
                $wyniki = $mysqli->query($zapytanie);

                while ($ogloszenie = $wyniki->fetch_assoc()) {

        $sprawdz_zduplikowane_query = "SELECT * FROM aplikacjeuzytkownika WHERE Uzytkownik_id = $uzytkownik_id AND ogloszenie_id = $ogloszenie[ogloszenie_id]";
        $sprawdz_zduplikowane_result = $mysqli->query($sprawdz_zduplikowane_query);
        }
        

        if ($sprawdz_zduplikowane_result->num_rows > 0) {
            echo '<div class="alert alert-warning" role="alert">Ten użytkownik już przesłał aplikację.</div>';
        } else {

            $data_aplikacji = date('Y-m-d H:i:s');
            $dodaj_aplikacje_query = "INSERT INTO aplikacjeuzytkownika (Uzytkownik_id, ogloszenie_id, DataAplikacji) VALUES ($uzytkownik_id, $ogloszenie_id, '$data_aplikacji')";

            if ($mysqli->query($dodaj_aplikacje_query) === TRUE) {
                echo '<div class="alert alert-success" role="alert">Aplikacja użytkownika została przesłana pomyślnie.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Błąd podczas przesyłania aplikacji: ' . $mysqli->error . '</div>';
            }
        }
    } elseif (isset($_POST['odrzuc'])) {
        $uzytkownik_id = $_POST['uzytkownik_id'];


        $host = "localhost";
                $username = "root";
                $password = "";
                $database = "bazaprojekt";

                $mysqli = new mysqli($host, $username, $password, $database);

                $zapytanie = "SELECT * FROM ogloszeniapracy WHERE Firma_id = $userID";
                $wyniki = $mysqli->query($zapytanie);

                while ($ogloszenie = $wyniki->fetch_assoc()) {

        $sprawdz_zduplikowane_query = "SELECT * FROM aplikacjeuzytkownika WHERE Uzytkownik_id = $uzytkownik_id AND ogloszenie_id = $ogloszenie[ogloszenie_id]";
        $sprawdz_zduplikowane_result = $mysqli->query($sprawdz_zduplikowane_query);

        

        if ($sprawdz_zduplikowane_result->num_rows > 0) {

            $data_aplikacji = date('Y-m-d H:i:s');
            $dodaj_aplikacje_query = "DELETE FROM aplikacjeuzytkownika WHERE Uzytkownik_id = $uzytkownik_id AND ogloszenie_id = $ogloszenie[ogloszenie_id]";

            if ($mysqli->query($dodaj_aplikacje_query) === TRUE) {
                echo '<div class="alert alert-success" role="alert">Aplikacja użytkownika została przesłana pomyślnie.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Błąd podczas przesyłania aplikacji: ' . $mysqli->error . '</div>';
            }
        }
    }
    }
}
?>



<div class="row card card-body mt-4">
    <h2>Aplikacje na ogłoszenie</h2>
    <?php

                $host = "localhost";
                $username = "root";
                $password = "";
                $database = "bazaprojekt";

                $mysqli = new mysqli($host, $username, $password, $database);

                $zapytanie = "SELECT * FROM ogloszeniapracy WHERE Firma_id = $userID";
                $wyniki = $mysqli->query($zapytanie);

                while ($ogloszenie = $wyniki->fetch_assoc()) {

    $zapytanie_aplikacje = "SELECT * FROM aplikacjeuzytkownika WHERE ogloszenie_id = $ogloszenie[ogloszenie_id]";
    $wyniki_aplikacje = $mysqli->query($zapytanie_aplikacje);
}
$wyniki->free_result();

    while ($aplikacja = $wyniki_aplikacje->fetch_assoc()) {
        $uzytkownik_id = $aplikacja['Uzytkownik_id'];
        $data_aplikacji = $aplikacja['DataAplikacji'];


        $zapytanie_uzytkownik = "SELECT * FROM uzytkownicy WHERE Uzytkownik_id = $uzytkownik_id";
        $wyniki_uzytkownik = $mysqli->query($zapytanie_uzytkownik);
        $uzytkownik = $wyniki_uzytkownik->fetch_assoc();


        echo '<div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">' . $uzytkownik['Imie'] . ' ' . $uzytkownik['Nazwisko'] . '</h5>
                    <p class="card-text">Data aplikacji: ' . $data_aplikacji . '</p>
                    <form method="post">
                        <input type="hidden" name="uzytkownik_id" value="' . $uzytkownik_id . '">
                        <button type="submit" name="przyjmij" class="btn btn-success mr-2">Przyjmij</button>
                        <button type="submit" name="odrzuc" class="btn btn-danger">Odrzuć</button>
                    </form>
                </div>
            </div>';
    }
    $wyniki_aplikacje->free_result();

    ?>
</div>


        
</div>
<footer class="container-fluid bg-light text-dark py-5 mt-5 shadow">
    <div class="row">
        <div class="col-md-4 text-center">
            <h3>Ogłoszenia</h3>
            <ul class="list-unstyled">
                <li><a href="#">Praca</a></li>
                <li><a href="#">Nieruchomości</a></li>
                <li><a href="#">Motoryzacja</a></li>
                <li><a href="#">Usługi</a></li>
            </ul>
        </div>
        
        <div class="col-md-4 text-center">
            <h3>Linki</h3>
            <ul class="list-unstyled">
                <li><a href="StronaGlowna.html">Strona główna</a></li>
                <li><a href="Onas.html">O nas</a></li>
                <li><a href="Kontakt.html">Kontakt</a></li>
                <li><a href="Regulamin.html">Regulamin</a></li>
            </ul>
        </div>
        
        <div class="col-md-4 text-center">
            <h3>Partnerzy</h3>
            <ul class="list-unstyled">
                <li><a href="#">Firma A</a></li>
                <li><a href="#">Firma B</a></li>
                <li><a href="#">Firma C</a></li>
            </ul>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12 text-center">
            <p>&copy; 2023 Twoja Strona z Ogłoszeniami. Wszelkie prawa zastrzeżone.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-lq0iPhPzGh8a7Xg8r9F6Q8cJqM8S+VvxQuDlEK3U/FO8fgwxRxMlWBRn4Hjd9agl" crossorigin="anonymous"></script>
</body>
</html>