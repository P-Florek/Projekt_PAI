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

$userID = $_SESSION["current_user"];  

$query = "SELECT imie, nazwisko, DataUrodzenia, Email, NumerTelefonu, ZdjecieProfilowe, adres, AktualneStanowiskoPracy, opisStanowiskaPracy, Podsumowaniezawodowe, LinkedInProfil, GitHubProfil FROM uzytkownicy WHERE Uzytkownik_id = $userID";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();

    $imie = $userData['imie'];
    $nazwisko = $userData['nazwisko'];
    $dataUrodzenia = $userData['DataUrodzenia'];
    $email = $userData['Email'];
    $nrTel = $userData['NumerTelefonu'];
    $zdj = $userData['ZdjecieProfilowe'];
    $adres = $userData['adres'];
    $stanowiskoPracy = $userData['AktualneStanowiskoPracy'];
    $opisStanowiskaPracy = $userData['opisStanowiskaPracy'];
    $Podsumowaniezawodowe = $userData['Podsumowaniezawodowe'];
    $LinkedInProfil = $userData['LinkedInProfil'];
    $ProfilGIT = $userData['GitHubProfil'];
}

$wyksztalcenieQuery = "SELECT NazwaSzkolyUczelni, Lokalizacja, PoziomWyksztalcenia, Kierunek, Okres FROM wyksztalcenie WHERE Uzytkownik_id = $userID";
$wyksztalcenieResult = $mysqli->query($wyksztalcenieQuery);

if ($wyksztalcenieResult->num_rows > 0) {
    $wyksztalcenieData = $wyksztalcenieResult->fetch_assoc();

    $nazwaSzkolyUczelni = $wyksztalcenieData['NazwaSzkolyUczelni'];
    $lokalizacja = $wyksztalcenieData['Lokalizacja'];
    $poziomWyksztalcenia = $wyksztalcenieData['PoziomWyksztalcenia'];
    $kierunek = $wyksztalcenieData['Kierunek'];
    $okres = $wyksztalcenieData['Okres'];
} else {

    $insertQuery = "INSERT INTO wyksztalcenie (Uzytkownik_id, NazwaSzkolyUczelni, Lokalizacja, PoziomWyksztalcenia, Kierunek, Okres) VALUES ('$userID', 'brak', 'brak', 'brak', 'brak', 'brak')";

    if ($mysqli->query($insertQuery) === TRUE) {

        $wyksztalcenieQuery = "SELECT NazwaSzkolyUczelni, Lokalizacja, PoziomWyksztalcenia, Kierunek, Okres FROM wyksztalcenie WHERE Uzytkownik_id = $userID";
        $wyksztalcenieResult = $mysqli->query($wyksztalcenieQuery);

        if ($wyksztalcenieResult->num_rows > 0) {
            $wyksztalcenieData = $wyksztalcenieResult->fetch_assoc();

            $nazwaSzkolyUczelni = $wyksztalcenieData['NazwaSzkolyUczelni'];
            $lokalizacja = $wyksztalcenieData['Lokalizacja'];
            $poziomWyksztalcenia = $wyksztalcenieData['PoziomWyksztalcenia'];
            $kierunek = $wyksztalcenieData['Kierunek'];
            $okres = $wyksztalcenieData['Okres'];
        }
    } else {
        echo "Błąd podczas dodawania rekordu: " . $mysqli->error;
    }
}

$doswiadczenieQuery = "SELECT * FROM doswiadczenie WHERE Uzytkownik_id = $userID";
$doswiadczenieResult = $mysqli->query($doswiadczenieQuery);

if ($doswiadczenieResult->num_rows > 0) {
    $doswiadczenieData = $doswiadczenieResult->fetch_assoc();

    $stanowisko = $doswiadczenieData['Stanowisko'];
    $nazwaFirmy = $doswiadczenieData['NazwaFirmy'];
    $lokalizacjaDoswiadczenia = $doswiadczenieData['Lokalizacja'];
    $okresZatrudnienia = $doswiadczenieData['OkresZatrudnienia'];
    $obowiazki = $doswiadczenieData['Obowiazki'];
} else {
    $insertQuery = "INSERT INTO doswiadczenie (Uzytkownik_id, Stanowisko, NazwaFirmy, Lokalizacja, OkresZatrudnienia, Obowiazki) 
                    VALUES ('$userID', 'brak', 'brak', 'brak', 'brak', 'brak')";

    if ($mysqli->query($insertQuery) === TRUE) {

        $doswiadczenieQuery = "SELECT * FROM doswiadczenie WHERE Uzytkownik_id = $userID";
        $doswiadczenieResult = $mysqli->query($doswiadczenieQuery);

        if ($doswiadczenieResult->num_rows > 0) {
            $stanowisko = $doswiadczenieData['Stanowisko'];
            $nazwaFirmy = $doswiadczenieData['NazwaFirmy'];
            $lokalizacjaDoswiadczenia = $doswiadczenieData['Lokalizacja'];
            $okresZatrudnienia = $doswiadczenieData['OkresZatrudnienia'];
            $obowiazki = $doswiadczenieData['Obowiazki'];
        }
    } else {
        echo "Błąd podczas dodawania rekordu: " . $mysqli->error;
    }
}

$umiejetnosciQuery = "SELECT * FROM umiejetnosci WHERE Uzytkownik_id = $userID";
$umiejetnosciResult = $mysqli->query($umiejetnosciQuery);

$umiejetnosci = array();

if ($umiejetnosciResult->num_rows > 0) {
    while ($umiejetnoscData = $umiejetnosciResult->fetch_assoc()) {
        $umiejetnosci[] = $umiejetnoscData['NazwaUmiejetnosci'];
    }
} else {
    $umiejetnosci[] = "brak";

    $insertQuery = "INSERT INTO umiejetnosci (Uzytkownik_id, NazwaUmiejetnosci) VALUES ('$userID', 'brak')";

    if ($mysqli->query($insertQuery) === FALSE) {
        echo "Błąd podczas dodawania rekordu: " . $mysqli->error;
    }
}

$jezykiQuery = "SELECT * FROM jezyki WHERE Uzytkownik_id = $userID";
$jezykiResult = $mysqli->query($jezykiQuery);

$jezyki = array();

if ($jezykiResult->num_rows > 0) {
    while ($jezykData = $jezykiResult->fetch_assoc()) {
        $jezyki[] = array(
            'NazwaJezyka' => $jezykData['NazwaJezyka'],
            'PoziomZnajomosci' => $jezykData['PoziomZnajomosci']
        );
    }
} else {
    $jezyki[] = array(
        'NazwaJezyka' => "brak",
        'PoziomZnajomosci' => "brak"
    );

    $insertQuery = "INSERT INTO jezyki (Uzytkownik_id, NazwaJezyka, PoziomZnajomosci) VALUES ('$userID', 'brak', 'brak')";

    if ($mysqli->query($insertQuery) === FALSE) {
        echo "Błąd podczas dodawania rekordu: " . $mysqli->error;
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

    <div class="row card  card-body mt-4 shadow p-3 mb-5">
        <h2>Ustawienia Konta :</h2>
            <div class="col-md-12">
                <div class="row mt-2">
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="mb-3 col-md-6 d-grid gap-2">
                        <button class="btn btn-secondary" type="button">
                            Usuń Konto
                        </button>
                    </div>
                    <form class="mb-3 col-md-6 d-grid gap-2" method="post">
                        <button class="btn btn-secondary" type="submit" name="logout">Wyloguj się</button>
                    </form>

                </div>
            </div>


    </div>

    <div class="row card  card-body mt-4 shadow p-3 mb-5">
    <h2>Dane Użytkownika</h2>
        <div class="col-md-12">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="imie" class="form-label">Imię :</label>
                    <label for="imie" class="form-label" id="imie"><?php echo $imie; ?></label>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="Nazwisko" class="form-label">Nazwisko :</label>
                    <label for="Nazwisko" class="form-label" id="nazwisko"><?php echo $nazwisko; ?></label>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="DataUrodzenia" class="form-label">Data Urodzenia :</label>
                    <label for="DataUrodzenia" class="form-label" id="DataUrodzenia"><?php echo $dataUrodzenia; ?></label>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="ZdjecieProfilowe" class="form-label">Zdjecie Profilowe :</label>
                    <label for="imZdjecieProfiloweie" class="form-label" id="zdj"><?php echo $zdj; ?></label>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="Adres" class="form-label">Adres :</label>
                    <label for="Adres" class="form-label" id="adres"><?php echo $adres; ?></label>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="stanowiskoPracy" class="form-label">Aktualne stanowisko pracy :</label>
                    <label for="stanowiskoPracy" class="form-label" id="stanowiskoPracy"><?php echo $stanowiskoPracy; ?></label>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="opisStanowiskaPracy" class="form-label">Opis stanowiska pracy :</label>
                    <label for="opisStanowiskaPracy" class="form-label" id="opisStanowiskaPracy"><?php echo $opisStanowiskaPracy; ?></label>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="Podsumowaniezawodowe" class="form-label">Podsumowanie Zawodowe :</label>
                    <label for="Podsumowaniezawodowe" class="form-label" id="Podsumowaniezawodowe"><?php echo $Podsumowaniezawodowe; ?></label>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="LinkedInProfil" class="form-label">Linked in profil :</label>
                    <label for="LinkedInProfil" class="form-label" id="LinkedInProfil"><?php echo $LinkedInProfil; ?></label>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="ProfilGIT" class="form-label">profil GitHub :</label>
                    <label for="ProfilGIT" class="form-label" id="ProfilGIT"><?php echo $ProfilGIT; ?></label>
                </div>
            </div>
        </div>
        <p>
            <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
            Edytuj
            </button>
        </p>
        <div class="collapse" id="collapseExample2">
            <div class="card card-body">
                <form action="edytuj_profil.php" method="post">
                <input type="hidden" name="action" value="personalne">
                    <div class="col-md-12">
                        <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="imie" class="form-label">Imię</label>
                                    <input type="text" class="form-control" id="imie" name='imie' value="<?php echo $imie; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nazwisko" class="form-label">Nazwisko</label>
                                    <input type="text" class="form-control" id="nazwisko" name='nazwisko' value="<?php echo $nazwisko; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="dataUrodzenia" class="form-label">Data Urodzenia</label>
                                    <input type="date" class="form-control" id="DataUrodzenia" name='DataUrodzenia' value="<?php echo $dataUrodzenia; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="zdj" class="form-label">Zdjecie Profilowe</label>
                                    <input type="text" class="form-control" id="zdj" name='zdj' value="<?php echo $zdj; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="adres" class="form-label">Adres</label>
                                    <input type="text" class="form-control" id="adres" name='adres' value="<?php echo $adres; ?>">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="stanowiskoPracy" class="form-label">Aktualne stanowisko pracy</label>
                                    <input type="text" class="form-control" id="stanowiskoPracy" name='stanowiskoPracy' value="<?php echo $stanowiskoPracy; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="opisStanowiskaPracy" class="form-label">Opis stanowiska pracy</label>
                                    <input type="text" class="form-control" id="opisStanowiskaPracy" name='opisStanowiskaPracy' value="<?php echo $opisStanowiskaPracy; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="Podsumowaniezawodowe" class="form-label">Podsumowanie Zawodowe</label>
                                    <input type="text" class="form-control" id="Podsumowaniezawodowe" name='Podsumowaniezawodowe' value="<?php echo $Podsumowaniezawodowe; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="LinkedInProfil" class="form-label">Linked in profil</label>
                                    <input type="text" class="form-control" id="LinkedInProfil" name='LinkedInProfil' value="<?php echo $LinkedInProfil; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="ProfilGIT" class="form-label">profil GitHub</label>
                                    <input type="text" class="form-control" id="ProfilGIT" name='ProfilGIT' value="<?php echo $ProfilGIT; ?>">
                                </div>
                            </div>
    
                            <button type="submit" class="btn btn-secondary">Zapisz Zmiany</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>




    <div class="row card  card-body mt-4 shadow p-3 mb-5">
        <h2>Dane Kontaktowe</h2>
            <div class="col-md-12">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="Email" class="form-label">Email :</label>
                        <label for="Email" class="form-label" id="Email"><?php echo $email; ?></label>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="Nrtel" class="form-label">Numer telefonu :</label>
                        <label for="Nrtel" class="form-label" id="numerTelefonu"><?php echo $nrTel; ?></label>
                    </div>
                </div>
            </div>
            <p>
                <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">
                    Edytuj
                </button>
            </p>
                <div class="collapse" id="collapseExample3">
                    <div class="card card-body">
                        <form method="post" action="edytuj_profil.php">
                        <input type="hidden" name="action" value="kontaktowe">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="Email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="Email" name="email" value="<?php echo $email; ?>">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="numerTelefonu" class="form-label">Numer telefonu</label>
                                        <input type="text" class="form-control" id="numerTelefonu" name="nrtel" value="<?php echo $nrTel; ?>">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-secondary">Zapisz Zmiany</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>

    

        <div class="row card  card-body mt-4 shadow p-3 mb-5">
            <h2>Wykształcenie</h2>
                <div class="col-md-12">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="NazwaSzkoly" class="form-label">Nazwa szkoły/Uczelni :</label>
                            <label for="NazwaSzkoly" class="form-label" id="NazwaSzkoly"><?php echo $nazwaSzkolyUczelni; ?></label>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="Lokalizacja" class="form-label">Lokalizacja :</label>
                            <label for="Lokalizacja" class="form-label" id="Lokalizacja"><?php echo $lokalizacja; ?></label>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="PoziomWyksztalcenia" class="form-label">Poziom Wykształcenia :</label>
                            <label for="PoziomWyksztalcenia" class="form-label" id="PoziomWyksztalcenia"><?php echo $poziomWyksztalcenia; ?></label>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="Kierunek" class="form-label">Kierunek :</label>
                            <label for="Kierunek" class="form-label" id="Kierunek"><?php echo $kierunek; ?></label>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="Okres" class="form-label">Okres :</label>
                            <label for="Okres" class="form-label" id="Okres"><?php echo $okres; ?></label>
                        </div>
                    </div>
                </div>
                <p>
                    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample4">
                        Edytuj
                    </button>
                </p>
                    <div class="collapse" id="collapseExample4">
                        <div class="card card-body">
                        <form method="post" action="edytuj_profil.php">
                            <input type="hidden" name="action" value="wyksztalcenie">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="NazwaSzkoly" class="form-label">Nazwa szkoły/Uczelni</label>
                                            <input type="text" class="form-control" id="NazwaSzkoly" name="nazwaSzkoly" value="<?php echo $nazwaSzkolyUczelni; ?>">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="Lokalizacja" class="form-label">Lokalizacja</label>
                                            <input type="text" class="form-control" id="okalizacja" name="Lokalizacja" value="<?php echo $lokalizacja; ?>">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="PoziomWyksztalcenia" class="form-label">Poziom Wykształcenia</label>
                                            <input type="text" class="form-control" id="oziomWyksztalcenia" name="PoziomWyksztalcenia" value="<?php echo $poziomWyksztalcenia; ?>">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="Kierunek" class="form-label">Kierunek</label>
                                            <input type="text" class="form-control" id="ierunek" name="Kierunek" value="<?php echo $kierunek; ?>">
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label for="Okres" class="form-label">Okres</label>
                                            <input type="text" class="form-control" id="kres" name="Okres" value="<?php echo $okres; ?>">
                                        </div>
                                    </div>
                    
                                    <button type="submit" class="btn btn-secondary">Zapisz Zmiany</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>

            <div class="row card  card-body mt-4 shadow p-3 mb-5">
                <h2>Doświadczenie</h2>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="Stanowisko" class="form-label">Stanowisko :</label>
                                <label for="Stanowisko" class="form-label" id="stanowiska"><?php echo $stanowisko; ?></label>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="NazwaFirmy" class="form-label">Nazwa Firmy :</label>
                                <label for="NazwaFirmy" class="form-label" id="NazwaFirmy"><?php echo $nazwaFirmy; ?></label>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="Lokalizacja" class="form-label">Lokalizacja :</label>
                                <label for="Lokalizacja" class="form-label" id="Lokalizacja"><?php echo $lokalizacjaDoswiadczenia; ?></label>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="Okres" class="form-label">Okres Zatrudnienia :</label>
                                <label for="Okres" class="form-label" id="Okres"><?php echo $okresZatrudnienia; ?></label>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="Obowiązki" class="form-label">Obowiązki :</label>
                                <label for="Obowiązki" class="form-label" id="Obowiazki"><?php echo $obowiazki; ?></label>
                            </div>
                        </div>
                    </div>
                    <p>
                        <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample5">
                            Edytuj
                        </button>
                    </p>
                        <div class="collapse" id="collapseExample5">
                            <div class="card card-body">
                                <form method="post" action="edytuj_profil.php">
                                <input type="hidden" name="action" value="doswiadczenie">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="stanowiska" class="form-label">Stanowisko</label>
                                                <input type="text" class="form-control" id="stanowiska" name="stanowiskaa" value="<?php echo $stanowisko; ?>">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="NazwaFirmy" class="form-label">Nazwa Firmy</label>
                                                <input type="text" class="form-control" id="NazwaFirmy" name="NazwaFirmyy" value="<?php echo $nazwaFirmy; ?>">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="Lokalizacja" class="form-label">Lokalizacja</label>
                                                <input type="text" class="form-control" id="Lokalizacja" name="Lokalizacjaa" value="<?php echo $lokalizacjaDoswiadczenia; ?>">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="Okres" class="form-label">Okres Zatrudnienia</label>
                                                <input type="text" class="form-control" id="Okres" name="Okress" value="<?php echo $okresZatrudnienia; ?>">
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label for="Obowiązki" class="form-label">Obowiązki</label>
                                                <input type="text" class="form-control" id="Obowiazki" name="Obowiazkii" value="<?php echo $obowiazki; ?>">
                                            </div>
                                        </div>
       
                                        <button type="submit" class="btn btn-secondary">Zapisz Zmiany</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>


                <div class="row card  card-body mt-4 shadow p-3 mb-5">
                    <h2>Umiejętności</h2>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="nazwaUmiejetnosci" class="form-label">Nazwa Umiejętności :</label>
                                    <label for="nazwaUmiejetnosci" class="form-label" id="nazwaUmiejetnosci">
                                        <?php
                                        if ($umiejetnosci[0] !== "brak") {
                                            echo implode(', ', $umiejetnosci);
                                        } else {
                                            echo "Brak umiejętności";
                                        }
                                        ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <p>
                            <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample6" aria-expanded="false" aria-controls="collapseExample6">
                                Edytuj
                            </button>
                        </p>
                            <div class="collapse" id="collapseExample6">
                                <div class="card card-body">
                                    <form method="post" action="edytuj_profil.php">
                                    <input type="hidden" name="action" value="umiejetnosci">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label for="nazwaUmiejetnosci" class="form-label">Nazwa Umiejętności</label>
                                                    <input type="text" class="form-control" id="nazwaUmiejetnosci" name="nazwaUmiejetnoscii" value="<?php echo implode(', ', $umiejetnosci); ?>">
                                                </div>
                                            </div>
       
                                            <button type="submit" class="btn btn-secondary">Zapisz Zmiany</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                </div>


                <div class="row card  card-body mt-4 shadow p-3 mb-5">
                    <h2>Języki</h2>
                        <div class="col-md-12">
                            <div class="row">
                                <?php foreach ($jezyki as $jezyk): ?>
                                    <div class="mb-3 col-md-6">
                                        <label for="NazwaJezyka" class="form-label">Nazwa języka:</label>
                                        <label for="NazwaJezyka" class="form-label" id="NazwaJezyka"><?php echo $jezyk['NazwaJezyka']; ?></label>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="Poziom" class="form-label">Poziom znajomości:</label>
                                        <label for="Poziom" class="form-label" id="poziomZnajomosci"><?php echo $jezyk['PoziomZnajomosci']; ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <p>
                            <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample7" aria-expanded="false" aria-controls="collapseExample7">
                                Edytuj
                            </button>
                        </p>
                            <div class="collapse" id="collapseExample7">
                                <div class="card card-body">
                                    <form method="post" action="edytuj_profil.php">
                                    <input type="hidden" name="action" value="jezyki">
                                        <div class="col-md-12">
                                            <div class="row">
                                            <?php foreach ($jezyki as $jezyk): ?>
                                                <div class="mb-3 col-md-6">
                                                    <label for="NazwaJezyka" class="form-label">Nazwa języka:</label>
                                                    <input type="text" class="form-control" id="NazwaJezyka" name="NazwaJezykaa" value="<?php echo $jezyk['NazwaJezyka']; ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="Poziom" class="form-label">Poziom znajomości:</label>
                                                    <input type="text" class="form-control" id="poziomZnajomosci" name="poziomZnajomoscii" value="<?php echo $jezyk['PoziomZnajomosci']; ?>">
                                                </div>
                                            <?php endforeach; ?>
                                            </div>

                                            <button type="submit" class="btn btn-secondary">Zapisz Zmiany</button>
                                        </div>
                                    </form>
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

