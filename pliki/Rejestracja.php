<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Główna</title>
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
                        <a class="nav-link disabled" href="StronaGlowna.php">Strona główna</a>
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
        <div class="jumbotron text-center">
            <h1 class="display-4">Zarejestruj się!</h1>
            <p class="lead"></p>
            <hr class="my-4">
        </div>

        <div class="row mb-6">
            <form class="form-inline row mb">
            <div class="row">
                <div class="col-6">
                    <div class="card card-body">
                        <form>

                            <h2 class="display-6  text-center">Dla Firm</h2>

                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label for="nazwa" class="form-label">Nazwa Użytkownika</label>
                                        <input type="text" class="form-control" id="nazwa">
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="haslo" class="form-label">Hasło</label>
                                        <input type="text" class="form-control" id="haslo">
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="nazwaFirmy" class="form-label">Nazwa Firmy</label>
                                        <input type="text" class="form-control" id="nazwaFirmy">
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label for="AdresFirmy" class="form-label">Adres firmy</label>
                                        <input type="text" class="form-control" id="AdresFirmy">
                                    </div>
                                    <div class="text-center">
                                        <a class="btn col-md-6 btn-secondary btn-lg mx-auto d-block" href="Rejestracja.html" role="button">Zarejestruj się</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card card-body">
                            <form>

                                <h2 class="display-6  text-center">Użytkownik</h2>
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label for="imie" class="form-label">Imię</label>
                                            <input type="text" class="form-control" id="imie">
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label for="nazwisko" class="form-label">Nazwisko</label>
                                            <input type="text" class="form-control" id="nazwisko">
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label for="Email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="Email">
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label for="Haslo" class="form-label">Hasło</label>
                                            <input type="text" class="form-control" id="Haslo">
                                        </div>
                                        <div class="text-center">
                                            <a class="btn col-md-6 btn-secondary btn-lg mx-auto d-block" href="Rejestracja.html" role="button">Zarejestruj się</a>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
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