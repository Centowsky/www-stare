<?php
	session_start();
	if (isset($_SESSION['zalogowany']))
	{
		require_once("session.php");
        session();
    } 
?>
<!DOCTYPE html>
<html lang="pl_PL">

<head>
    <title><?php require("db.php"); $conn = mysqli_connect($servername, $username, $password, $dbname); if (mysqli_connect_errno()) { printf("Nie udalo sie polaczyc: %s\n", mysqli_connect_error()); exit();} $sql = "SELECT * FROM strona WHERE id_strona = '1'";  $res = mysqli_query($conn, $sql);  $row = mysqli_fetch_array($res, MYSQLI_ASSOC); echo $row['tytul']?></title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php $sql = "SELECT * FROM strona WHERE id_strona = '1'";  $res = mysqli_query($conn, $sql);  $row = mysqli_fetch_array($res, MYSQLI_ASSOC); echo $row['opis']?>">
    <meta name="keywords" content="<?php $sql = "SELECT * FROM tagi"; $res = mysqli_query($conn, $sql); while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){ echo $row['nazwa'].", "; }; ?>strona WWW">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fixed.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="img/icon.png">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top">
        <a class="navbar-brand" href="#">
            <img src="img/icon.png" alt="Logo" style="width:35px; padding: 5px;"> OSP ŁAWY
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="o-nas.php">O nas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="wyjazdy.php">Wyjazdy</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Jednostka</a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Historia</a></li>
                        <li><a class="dropdown-item" href="#">Pojazdy</a></li>
                        <li><a class="dropdown-item" href="#">Dokumenty</a></li>
                        <li><a class="dropdown-item" href="#">Kontakt</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="galeria.php">Galeria</a>
                </li>
                <li class="nav-item">
                    <?php 
                        if (isset($_SESSION['zalogowany'])) {
                            echo "<a class='nav-link' href='profil.php'>Profil</a>\n";
                        } else {
                            echo "<a class='nav-link' href='logowanie.php'>Profil</a>\n";
                        }                  
                    ?>
                </li>
                <li class="nav-item">
                    <?php 
                        if (isset($_SESSION['zalogowany'])) {
                            echo "<a class='nav-link' title='Wyloguj' href='wyloguj.php'><i class='fas fa-sign-out-alt'></i></a>\n";
                        } else {
                            echo "<a class='nav-link' title='Zaloguj' href='logowanie.php'><i class='fas fa-sign-in-alt'></i></a>\n";
                        }                  
                    ?>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <form action="dodawanie_uzytkownika_do_bazy.php" method="post">
            <input type="number" placeholder="PESEL" name="pesel"></input><br>
            <input type="text" placeholder="Imie" name="imie"></input><br>
            <input type="text" placeholder="Nazwisko" name="nazwisko"></input><br>
            <input type="text" placeholder="Haslo" name="haslo"></input><br>
            <input type="number" placeholder="Uprawnienia" name="uprawnienia"></input><br>
            <button type="submit">Dodaj</button>
        </form>
    </div>

    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/57516c6d9a.js" crossorigin="anonymous"></script>
</body>

</html>