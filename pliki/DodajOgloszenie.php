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

$userID = $_SESSION["current_firma"];  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST['action'] == 'daneOgloszenia') {
            $NazwaStanowiska = $_POST['nazwaStanowiska'];
            $PoziomZatrudnienia = $_POST['poziomZatrudnienia'];
            $RodzajUmowy = $_POST['rodzajUmowy'];
            $RodzajPracy = $_POST['rodzajPracy'];
            $PracaZdalna = $_POST['pracaZdalna'];
            $WidełkiWynagrodzenia = $_POST['widelkiWynagrodzenia'];
            $DniPracy = $_POST['widelkiWynagrodzenia'];
            $GodzinyPracy = $_POST['godzinyPracy'];
            $DataWygaśnięcia = $_POST['dataWygasniecia'];
            $Kategoria = $_POST['kategoria'];
            $OpisStanowiska = $_POST['opisStanowiska'];
            $Wymagania = $_POST['wymagania'];
            $Oferty = $_POST['oferty'];
            $Zdjecie = $_POST['zdj'];
    
            $updateQuery = "INSERT INTO `ogłoszeniapracy`(`Firma_id`, `NazwaStanowiska`, `PoziomZatrudnienia`, `RodzajUmowy`, `RodzajPracy`, `PracaZdalna`, `WidełkiWynagrodzenia`, `DniPracy`, `GodzinyPracy`, `DataWygaśnięcia`, `Kategoria`, `OpisStanowiska`, `Wymagania`, `Oferty`, `Zdjecie`) VALUES 
            ('$userID','$NazwaStanowiska','$PoziomZatrudnienia','$RodzajUmowy','$RodzajPracy','$PracaZdalna','$WidełkiWynagrodzenia','$DniPracy','$GodzinyPracy','$DataWygaśnięcia','$Kategoria','$OpisStanowiska','$Wymagania','$Oferty','$Zdjecie')";
    
            if ($mysqli->query($updateQuery) === TRUE) {
                echo '<meta http-equiv="refresh" content="0;url=PanelOgloszen.php">';
                exit();
            } else {
                echo "Błąd podczas aktualizacji danych: " . $mysqli->error;
            }
        }
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

    <div class="row card  card-body mt-4">
        <h2>Dodawanie Ogłoszenia</h2>
        <form action="DodajOgloszenie.php" method="post">
                <input type="hidden" name="action" value="daneOgloszenia">
                    <div class="col-md-12">
                        <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="imie" class="form-label">Nazwa stanowiska :</label>
                                    <input type="text" class="form-control" id="imie" name='nazwaStanowiska'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nazwisko" class="form-label">Poziom zatrudnienia :</label>
                                    <input type="text" class="form-control" id="nazwisko" name='poziomZatrudnienia'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="imie" class="form-label">Rodzaj umowy :</label>
                                    <select class="form-control" id="pracaZdalna" name="rodzajUmowy">
                                    <option value="NaCzasOkreslony">NaCzasOkreslony</option>
                                    <option value="NaCzasNieokreslony">NaCzasNieokreslony</option>
                                    <option value="OkresProbny">OkresProbny</option>
                                </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nazwisko" class="form-label">Rodzaj pracy :</label>
                                    <input type="text" class="form-control" id="nazwisko" name='rodzajPracy'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="imie" class="form-label">Praca zdalna :</label>
                                    <select class="form-control" id="pracaZdalnaa" name="pracaZdalna">
                                    <option value="TAK">TAK</option>
                                    <option value="NIE">NIE</option>
                                </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nazwisko" class="form-label">Widełki wynagrodzenia :</label>
                                    <input type="text" class="form-control" id="nazwisko" name='widelkiWynagrodzenia'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="imie" class="form-label">Godziny pracy :</label>
                                    <input type="text" class="form-control" id="imie" name='godzinyPracy'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nazwisko" class="form-label">Data wygaśnięcia :</label>
                                    <input type="date" class="form-control" id="nazwisko" name='dataWygasniecia'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="imie" class="form-label">Kategoria :</label>
                                    <select class="form-control" id="pracaZdalna" name="kategoria">
                                    <option value="inzynieria">inzynieria</option>
                                    <option value="mechanika">mechanika</option>
                                    <option value="medycyna">medycyna</option>
                                    <option value="informatyka">informatyka</option>
                                </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nazwisko" class="form-label">Opis stanowiska :</label>
                                    <input type="text" class="form-control" id="nazwisko" name='opisStanowiska'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="imie" class="form-label">Wymagania :</label>
                                    <input type="text" class="form-control" id="imie" name='wymagania'>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nazwisko" class="form-label">Oferty :</label>
                                    <input type="text" class="form-control" id="nazwisko" name='oferty'>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="nazwisko" class="form-label">Url zdjęcia ogłoszenia :</label>
                                    <input type="text" class="form-control" id="nazwisko" name='zdj'>
                                </div>
                            </div>
    
                            <button type="submit" class="btn btn-secondary">Zapisz Zmiany</button>
                        </div>
                    </form>


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