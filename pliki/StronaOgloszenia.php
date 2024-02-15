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
                        <a href="Konto.php" role="button" class="btn btn-outline-dark" type="submit">KONTO</a>
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
                    <img src="../Grafiki/zdjecieOgloszenie.jpg" class="card-img-top" alt="Sample Image">
                    <div class="card-body">
                        <h2><label for="nazwaogloszenia" class="form-label">(NAZWA STANOWISKA)</label></h2>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="Lokalizacja" class="form-label">Lokalizacja :</label>
                                        <label for="Lokalizacja" class="form-label" id="Lokalizacja"></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="Umowa" class="form-label">Umowa :</label>
                                        <label for="Umowa" class="form-label" id="Umowa"></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="DataWygasniecia" class="form-label">Data Wygaśnięcia :</label>
                                        <label for="DataWygasniecia" class="form-label" id="DataWygasniecia"></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="zdalna" class="form-label">Praca zdalna :</label>
                                        <label for="zdalna" class="form-label" id="zdalna"></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="Wynagrodzenie" class="form-label">Wynagrodzenie :</label>
                                        <label for="Wynagrodzenie" class="form-label" id="Wynagrodzenie"></label>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h2>Opis Stanowiska</h2>
                            <div class="col-md-12">
                                <div class="row">

                                </div>
                            </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h2>Wymagania</h2>
                            <div class="col-md-12">
                                <div class="row">

                                </div>
                            </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                            <a href="StronaOgloszenia.html" role="button" class="btn btn-secondary d-grid gap-2">
                                Aplikuj
                            </a>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Oferujemy :</h5>
                        
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