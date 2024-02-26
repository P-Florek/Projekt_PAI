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


if (isset($_SESSION["current_user"])) {
    $navbarButton = '<a href="Konto.php" role="button" class="btn btn-outline-dark" type="submit">KONTO</a>';
} else if(isset($_SESSION["current_firma"])){
    $navbarButton = '<a href="KontoFirma.php" role="button" class="btn btn-outline-dark" type="submit">KONTO</a>';
} else{
    $navbarButton = '<a href="StronaGlowna.php" role="button" class="btn btn-outline-dark" type="submit">ZALOGUJ</a>';
}
?>

<?php

$ogloszenie_id = $_GET['id'] ?? null;


if (!isset($ogloszenie_id) || !is_numeric($ogloszenie_id)) {

    echo 'Nieprawidłowe ogłoszenie.';
    exit();
}


$zapytanie = "SELECT * FROM ogloszeniapracy WHERE ogloszenie_id = $ogloszenie_id";
$wynik = $mysqli->query($zapytanie);


if ($wynik->num_rows === 0) {
    echo 'Ogłoszenie nie istnieje.';
    exit();
}


$ogloszenie = $wynik->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ogłoszenie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <img src="<?php echo $ogloszenie['Zdjecie']; ?>" class="card-img-top" alt="Ogłoszenie">
                    <div class="card-body">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="Lokalizacja" class="form-label"><strong>Nazwa stanowiska :</strong></label>
                                        <label for="Lokalizacja" class="form-label" id="Lokalizacja"><?php echo $ogloszenie['NazwaStanowiska']; ?></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="Umowa" class="form-label"><strong>Kategoria :</strong></label>
                                        <label for="Umowa" class="form-label" id="Umowa"><?php echo $ogloszenie['Kategoria']; ?></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="DataWygasniecia" class="form-label"><strong>Rodzaj umowy :</strong></label>
                                        <label for="DataWygasniecia" class="form-label" id="DataWygasniecia"><?php echo $ogloszenie['RodzajUmowy']; ?></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="zdalna" class="form-label"><strong>Opis stanowiska :</strong></label>
                                        <label for="zdalna" class="form-label" id="zdalna"><?php echo $ogloszenie['OpisStanowiska']; ?></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="Wynagrodzenie" class="form-label"><strong>Poziom zatrudnienia :</strong></label>
                                        <label for="Wynagrodzenie" class="form-label" id="Wynagrodzenie"><?php echo $ogloszenie['PoziomZatrudnienia']; ?></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="Lokalizacja" class="form-label"><strong>Rodzaj pracy :</strong></label>
                                        <label for="Lokalizacja" class="form-label" id="Lokalizacja"><?php echo $ogloszenie['RodzajPracy']; ?></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="Umowa" class="form-label"><strong>Praca zdalna :</strong></label>
                                        <label for="Umowa" class="form-label" id="Umowa"><?php echo $ogloszenie['PracaZdalna']; ?></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="DataWygasniecia" class="form-label"><strong>Wynagrodzenie :</strong></label>
                                        <label for="DataWygasniecia" class="form-label" id="DataWygasniecia"><?php echo $ogloszenie['WidelkiWynagrodzenia']; ?></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="zdalna" class="form-label"><strong>Dni pracy :</strong></label>
                                        <label for="zdalna" class="form-label" id="zdalna"><?php echo $ogloszenie['DniPracy']; ?></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="Lokalizacja" class="form-label"><strong>Data wygaśnięcia :</strong></label>
                                        <label for="Lokalizacja" class="form-label" id="Lokalizacja"><?php echo $ogloszenie['DataWygasniecia']; ?></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="Umowa" class="form-label"><strong>Godziny pracy :</strong></label>
                                        <label for="Umowa" class="form-label" id="Umowa"><?php echo $ogloszenie['GodzinyPracy']; ?></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="DataWygasniecia" class="form-label"><strong>Wymagania :</strong></label>
                                        <label for="DataWygasniecia" class="form-label" id="DataWygasniecia"><?php echo $ogloszenie['Wymagania']; ?></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="zdalna" class="form-label"><strong>Oferty :</strong></label>
                                        <label for="zdalna" class="form-label" id="zdalna"><?php echo $ogloszenie['Oferty']; ?></label>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                            <a href="EdytacjaOgloszenia.php" role="button" class="btn btn-secondary d-grid gap-2">
                                Zapisz
                            </a>
                    </div>
                </div>
            </div>
        </div>
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

<?php
$wynik->free_result();
?>