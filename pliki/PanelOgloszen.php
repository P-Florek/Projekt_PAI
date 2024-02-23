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
    $navbarButtonDodajOgloszenie = null;
} else if(isset($_SESSION["current_firma"])){
    $navbarButton = '<a href="KontoFirma.php" role="button" class="btn btn-outline-dark" type="submit">KONTO</a>';
    $navbarButtonDodajOgloszenie = '<a href="DodajOgloszenie.php" role="button" class="btn btn-outline" type="submit">DODAJ SWOJE OGŁOSZENIE</a>';
} else{
    $navbarButton = '<a href="StronaGlowna.php" role="button" class="btn btn-outline-dark" type="submit">ZALOGUJ</a>';
    $navbarButtonDodajOgloszenie = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Ogłoszeń</title>
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
                        <a class="nav-link disabled" href="PanelOgloszen.php">Panel ogłoszeniowy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontakt.php">Kontakt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="polityka.php">Polityka prywatności</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <?php echo $navbarButtonDodajOgloszenie; ?>
                </form>
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

    <?php 
        $kategoria = $_GET['category'] ?? 'Wszystkie';
        $sortowanie = $_GET['sorting'] ?? 'Wszystkie';
        $zdalnaPraca = $_GET['zdalna'] ?? 'Wszystkie';
        $rodzajUmowy = $_GET['rodzajUmowy'] ?? 'Wszystkie';
    ?>

    <div class="container mt-5">
    <form method="get" action="PanelOgloszen.php">
    <div class="row mb-3">
        <div class="col-md-2">
            <label for="category">Kategoria:</label>
            <select class="form-select" name="category" id="category">
                <option value="Wszystkie" <?php echo ($kategoria == 'Wszystkie') ? 'selected' : ''; ?>>Wszystkie</option>
                <option value="inzynieria" <?php echo ($kategoria == 'inzynieria') ? 'selected' : ''; ?>>Inżynieria</option>
                <option value="mechanika" <?php echo ($kategoria == 'mechanika') ? 'selected' : ''; ?>>Mechanika</option>
                <option value="medycyna" <?php echo ($kategoria == 'medycyna') ? 'selected' : ''; ?>>Medycyna</option>
                <option value="informatyka" <?php echo ($kategoria == 'informatyka') ? 'selected' : ''; ?>>Informatyka</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="sorting">Sortowanie:</label>
            <select class="form-select" name="sorting">
                <option value="Wszystkie" <?php echo ($sortowanie == 'Wszystkie') ? 'selected' : ''; ?>>Wszystkie</option>
                <option value="najnowsze" <?php echo ($sortowanie == 'najnowsze') ? 'selected' : ''; ?>>Najnowsze</option>
                <option value="najtansze" <?php echo ($sortowanie == 'najtansze') ? 'selected' : ''; ?>>Najtańsze</option>
                <option value="najdrozsze" <?php echo ($sortowanie == 'najdrozsze') ? 'selected' : ''; ?>>Najdroższe</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="zdalna">Praca zdalna:</label>
            <select class="form-select" name="zdalna">
                <option value="Wszystkie" <?php echo ($zdalnaPraca == 'Wszystkie') ? 'selected' : ''; ?>>Wszystkie</option>
                <option value="TAK" <?php echo ($zdalnaPraca == 'TAK') ? 'selected' : ''; ?>>TAK</option>
                <option value="NIE" <?php echo ($zdalnaPraca == 'NIE') ? 'selected' : ''; ?>>NIE</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="rodzajUmowy">Rodzaj umowy:</label>
            <select class="form-select" name="rodzajUmowy">
                <option value="Wszystkie" <?php echo ($rodzajUmowy == 'Wszystkie') ? 'selected' : ''; ?>>Wszystkie</option>
                <option value="NaCzasOkreslony" <?php echo ($rodzajUmowy == 'NaCzasOkreslony') ? 'selected' : ''; ?>>NaCzasOkreslony</option>
                <option value="NaCzasNieokreslony" <?php echo ($rodzajUmowy == 'NaCzasNieokreslony') ? 'selected' : ''; ?>>NaCzasNieokreslony</option>
                <option value="OkresProbny" <?php echo ($rodzajUmowy == 'OkresProbny') ? 'selected' : ''; ?>>OkresProbny</option>
            </select>
        </div>
        <div class="col-md-4 d-grid gap-2">
            <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Filtruj</button>
        </div>
    </div>
</form>
        <div class="row mb-3">
            <form class="form-inline row mb">
                <div class="col-md-10">
                    
                    <input class="form-control mr-sm-2" type="search" placeholder="Szukaj ogłoszenia ..." aria-label="Search">

                </div>
                <div class="col-md-2 d-grid gap-2">

                    <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Szukaj</button>

                </div>
            </form>
        </div>

        <div class="row">
        <div class="col-lg-8">
        
            
        <?php
            $zapytanie = "SELECT * FROM ogłoszeniapracy WHERE 1";

            if ($kategoria != 'Wszystkie') {
                $zapytanie .= " AND Kategoria = '$kategoria'";
            }

            if ($zdalnaPraca != 'Wszystkie') {
                $zapytanie .= " AND PracaZdalna = 'TAK'";
            }

            if ($rodzajUmowy != 'Wszystkie') {
                $zapytanie .= " AND RodzajUmowy = '$rodzajUmowy'";
            }

            if ($sortowanie == 'Wszystkie') {
                $zapytanie .= " ORDER BY WidełkiWynagrodzenia ASC";
            } elseif ($sortowanie == 'najdrozsze') {
                $zapytanie .= " ORDER BY WidełkiWynagrodzenia DESC";
            } else {
                //$zapytanie .= " ORDER BY DataDodania DESC";
            }


            $wyniki = $mysqli->query($zapytanie);


            while ($ogloszenie = $wyniki->fetch_assoc()) {

                echo '<div class="card mb-4">
                        <img src="' . $ogloszenie['Zdjecie'] . '" class="card-img-top" alt="Ogłoszenie">
                        <div class="card-body">
                            <h5 class="card-title">' . $ogloszenie['NazwaStanowiska'] . '</h5>
                            <p class="card-text">' . $ogloszenie['OpisStanowiska'] . '</p>
                            <a href="StronaOgloszenia.php?id=' . $ogloszenie['ogłoszenie_id'] . '" role="button" class="btn btn-secondary">
                                Zobacz szczegóły
                            </a>
                        </div>
                    </div>';
            }


            $wyniki->free_result();
            ?>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ostatnie ogłoszenia</h5>
                        <ul class="list-group">
                            <div class="card mb-4">
                                <img src="../Grafiki/zdjecieOgloszenie.jpg" class="card-img-top" alt="Sample Image">
                                <div class="card-body">
                                    <h5 class="card-title">Tytuł ogłoszenia</h5>
                                    <p class="card-text">Opis ogłoszenia. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Zobacz szczegóły
                                    </button>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <img src="../Grafiki/zdjecieOgloszenie.jpg" class="card-img-top" alt="Sample Image">
                                <div class="card-body">
                                    <h5 class="card-title">Tytuł ogłoszenia</h5>
                                    <p class="card-text">Opis ogłoszenia. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Zobacz szczegóły
                                    </button>
                                </div>
                            </div>
                            
                        </ul>
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