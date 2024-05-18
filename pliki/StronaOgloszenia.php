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
    $PrzyciskAplikacji = '<button type="submit" class="add-button text-center">Aplikuj już teraz</button>';
} else if(isset($_SESSION["current_firma"])){
    $navbarButton = '<a href="KontoFirma.php" role="button" class="btn btn-outline-dark" type="submit">KONTO</a>';
    $PrzyciskAplikacji = '<button type="submit" class="add-button text-center" disabled>Aplikuj już teraz</button>';
} else{
    $navbarButton = '<a href="StronaGlowna.php" role="button" class="btn btn-outline-dark" type="submit">ZALOGUJ</a>';
    $PrzyciskAplikacji = '<button type="submit" class="add-button text-center" disabled>Aplikuj już teraz</button>';
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

if (isset($_SESSION["current_user"])) {
    
    $userID = $_SESSION["current_user"];
    $user_query = "SELECT * FROM uzytkownicy WHERE Uzytkownik_id = $userID";
    $user_result = $mysqli->query($user_query); 
    $user_data = $user_result->fetch_assoc();
} else if(isset($_SESSION["current_firma"])){
    
    

} else{
    
}
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bazaprojekt";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Połączenie nieudane: " . $conn->connect_error);
    }

    $check_sql = "SELECT COUNT(*) FROM aplikacjeuzytkownika WHERE Uzytkownik_id = ? AND ogloszenie_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii", $userID, $ogloszenie_id);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($count > 0) {
        $Powiadomienie = '<div class="alert alert-success" role="alert">
        Zaaplikowales juz na to ogłoszenie !
        </div>';
        $PrzyciskAplikacji = '<button type="submit" class="add-button text-center" disabled>Aplikuj już teraz</button>';
    } else {
        $Powiadomienie = '<div class="alert alert-danger" role="alert">
        Nie aplikowałes jeszcze na to ogłoszenie.
        </div>';
    }




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bazaprojekt";
    

    $conn = new mysqli($servername, $username, $password, $dbname);
    

    if ($conn->connect_error) {
        die("Połączenie nieudane: " . $conn->connect_error);
    }

    $imie = $_POST['imie'] ?? '';
    $nazwisko = $_POST['nazwisko'] ?? '';
    $email = $_POST['email'] ?? '';




    $uzytkownik_id = $userID;
    $ogloszenie = $ogloszenie_id;
    $data_aplikacji = date('Y-m-d H:i:s'); 


    $sql = "INSERT INTO aplikacjeuzytkownika (Uzytkownik_id, ogloszenie_id, DataAplikacji) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $uzytkownik_id, $ogloszenie, $data_aplikacji);

    if ($stmt->execute()) {
        echo "Aplikacja została złożona pomyślnie!";
        echo '<meta http-equiv="refresh" content="0;url=StronaOgloszenia.php?id=' . $ogloszenie.'">';exit();
        $Powiadomienie = '<div class="alert alert-success" role="alert">
        A simple success alert—check it out!
        </div>';
    } else {
        echo "Błąd: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ogłoszenie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>

    .advertisement {
      margin-bottom: 15px;
    }

   
    .advertisement h2 {
      font-size: 18px;
    }

    .advertisement label {
      font-size: 13px;
    }


    .add-button {
      border: 2px solid #555; 
      border-radius: 5px;
      padding: 10px 20px;
      background-color: #f8f9fa; 
      color: #333; 
    }

    .add-button:hover {
      background-color: #e9ecef; 
    }
  </style>
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
                                
                                    <div class="container mt-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="advertisement bg-light p-3">
                                                <h2>Nazwa stanowiska :</h2>
                                                <label for="Lokalizacja" class="form-label" id="Lokalizacja"><?php echo $ogloszenie['NazwaStanowiska']; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="advertisement bg-light p-3">
                                                <h2>Kategoria :</h2>
                                                <label for="Umowa" class="form-label" id="Umowa"><?php echo $ogloszenie['Kategoria']; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="advertisement bg-light p-3">
                                                <h2>Rodzaj umowy :</h2>
                                                <label for="DataWygasniecia" class="form-label" id="DataWygasniecia"><?php echo $ogloszenie['RodzajUmowy']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="advertisement bg-light p-3">
                                                <h2>Opis stanowiska :</h2>
                                                <label for="zdalna" class="form-label" id="zdalna"><?php echo $ogloszenie['OpisStanowiska']; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="advertisement bg-light p-3">
                                                <h2>Poziom zatrudnienia :</h2>
                                                <label for="Wynagrodzenie" class="form-label" id="Wynagrodzenie"><?php echo $ogloszenie['PoziomZatrudnienia']; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="advertisement bg-light p-3">
                                                <h2>Rodzaj pracy :</h2>
                                                <label for="Lokalizacja" class="form-label" id="Lokalizacja"><?php echo $ogloszenie['RodzajPracy']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="advertisement bg-light p-3">
                                                <h2>Praca zdalna :</h2>
                                                <label for="Umowa" class="form-label" id="Umowa"><?php echo $ogloszenie['PracaZdalna']; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="advertisement bg-light p-3">
                                                <h2>Wynagrodzenie :</h2>
                                                <label for="DataWygasniecia" class="form-label" id="DataWygasniecia"><?php echo $ogloszenie['WidelkiWynagrodzenia']; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="advertisement bg-light p-3">
                                                <h2>Dni pracy :</h2>
                                                <label for="zdalna" class="form-label" id="zdalna"><?php echo $ogloszenie['DniPracy']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="advertisement bg-light p-3">
                                                <h2>Data wygaśnięcia :</h2>
                                                <label for="Lokalizacja" class="form-label" id="Lokalizacja"><?php echo $ogloszenie['DataWygasniecia']; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="advertisement bg-light p-3">
                                                <h2>Godziny pracy :</h2>
                                                <label for="Umowa" class="form-label" id="Umowa"><?php echo $ogloszenie['GodzinyPracy']; ?></label>s
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="advertisement bg-light p-3">
                                                <h2>Wymagania :</h2>
                                                <label for="DataWygasniecia" class="form-label" id="DataWygasniecia"><?php echo $ogloszenie['Wymagania']; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="advertisement2 bg-light p-3">
                                                    <h2>Jestes zainteresowany ?</h2>
                                                    <form method="post">
                                                        <div class="mb-3 col-md-12">
                                                        <input type="text" class="form-control" name="imie" placeholder="Imię" value="<?php echo $user_data['Imie']; ?>" required>
                                                        </div>
                                                        <div class="mb-3 col-md-12">
                                                        <input type="text" class="form-control" name="nazwisko" placeholder="Nazwisko" value="<?php echo $user_data['Nazwisko']; ?>" required>
                                                        </div>
                                                        <div class="mb-3 col-md-12">
                                                        <input type="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo $user_data['Email']; ?>" required>
                                                        </div>
                                                        
                                                        
                                                        

                                                        <div class="mb-3 col-md-12">
                                                        <form class="d-flex">
                                                            <?php echo $PrzyciskAplikacji; ?>
                                                        </form>
                                                        </div>
                                                        <form class="d-flex">
                                                            <?php echo $Powiadomienie; ?>
                                                        </form>
                                                    </form>
                                                    
                        </div>
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