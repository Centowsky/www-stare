<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: logowanie.php');
		exit();
    } else {
        require_once("session.php");
        session();
    }
    
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <?php
        echo "<title>".$_SESSION['imie']." ".$_SESSION['nazwisko']." | osp-lawy.pl</title>\n";
    ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php require("db.php"); $conn = mysqli_connect($servername, $username, $password, $dbname); if (mysqli_connect_errno()) { printf("Nie udalo sie polaczyc: %s\n", mysqli_connect_error()); exit();} $sql = "SELECT * FROM strona WHERE id_strona = '1'";  $res = mysqli_query($conn, $sql);  $row = mysqli_fetch_array($res, MYSQLI_ASSOC); echo $row['opis']?>">
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
                    <a class="nav-link" href="profil.php">Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" title="Wyloguj" href="wyloguj.php"><i class="fas fa-sign-out-alt"></i></a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="border border-primary border-2 rounded bg-light text-dark py-1">
                    <img class="img-avatar rounded mx-auto d-block" src="img/avatars/<?php echo strtolower($_SESSION['nazwisko']."_".$_SESSION['imie'])?>.jpg" alt="<?php echo $_SESSION['imie']." ".$_SESSION['nazwisko']?>"><br>
                    <a class="btn btn-lg" href="profil.php" role="button"><?php echo $_SESSION['imie']." ".$_SESSION['nazwisko']?></a>
                    <?php switch($_SESSION['uprawnienia']){
                        case 1: echo "<p class='h5'>Redaktor</p>\n\t\t\t\t\t<a href='#'><button class='btn btn-sm m-1 btn-success'>Dodaj wpis</button></a>\n\t\t\t\t\t<a href='#'><button class='btn btn-sm m-1 btn-primary'>Moje dane</button></a>\n";
                        break; 
                        case 2: echo "<p class='h5'>Moderator</p>\n\t\t\t\t\t<a href='#'><button class='btn btn-sm m-1 btn-success'>Dodaj wpis</button></a>\n\t\t\t\t\t<a href='#'><button class='btn btn-sm m-1 btn-danger'>Zarządzaj</button></a>\n\t\t\t\t\t<a href='#'><button class='btn btn-sm m-1 btn-primary'>Moje dane</button></a>\n";  
                        break; 
                        case 9: echo "<p class='h5'>Administrator</p>\n\t\t\t\t\t<a href='ustawienia.php?profil=".$_SESSION['id']."'><button class='btn btn-sm m-1 btn-success'>Dodaj wpis</button></a>\n\t\t\t\t\t<a href='#'><button class='btn btn-sm m-1 btn-danger'>Zarządzaj</button></a>\n\t\t\t\t\t<a href='#'><button class='btn btn-sm m-1 btn-primary'>Moje dane</button></a>\n"; 
                        break; 
                        default: echo "<p class='h5'>Użytkownik</p>\n\t\t\t\t\t<a href='ustawienia.php?profil=".$_SESSION['id']."'><button class='btn btn-sm m-1 btn-primary'>Moje dane</button></a>\n"; break;}?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="border border-primary border-2 rounded bg-light text-dark">
                    <table class="table table-striped table-secondary">
                        <thead>
                            <th class="text-primary" colspan="3">Zarządzaj danymi</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Imie i nazwisko</th>
                                <td><?php echo $_SESSION['imie']." ".$_SESSION['nazwisko']?></td>
                                <td><i class="fas fa-lock text-danger"></i></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?php echo $_SESSION['email']?></td>
                                <td><a href="#"><button class="btn btn-sm btn-info btn-ch-email">Zmień</button></a></td>
                            </tr>
                            <tr>
                                <th>Hasło</th>
                                <td><?php if($_SESSION['haslo_zmienione']=="1"){ echo "**********";} else { echo "<span class='text-danger fw-bold'>Twoje hasło musi zostać zmienione</span>";}?></td>
                                <td><button class="btn btn-sm btn-info btn-ch-password">Zmień</button></td>
                            </tr>
                            <tr>
                                <th>Telefon</th>
                                <td><?php echo $_SESSION['telefon']?></td>
                                <td><button class="btn btn-sm btn-info btn-ch-number">Zmień</button></td>
                            </tr>
                            <tr>
                                <th>Funkcja</th>
                                <td><?php echo $_SESSION['stopien']?></td>
                                <td><i class="fas fa-lock text-danger"></i></td>
                            </tr>
                            <tr>
                                <th>Data urodzenia</th>
                                <td><?php echo $_SESSION['data_urodzenia']?></td>
                                <td><i class="fas fa-lock text-danger"></i></td>
                            </tr>
                            <tr>
                                <th>Badania lekarskie</th>
                                <td><?php echo $_SESSION['badania_lekarskie']?></td>
                                <td><i class="fas fa-lock text-danger"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-8">
                <div class="border border-primary border-2 rounded bg-light text-dark py-3">
                    <p class="h5 fw-bold text-primary">Akutalizacja danych</p>
                    <form method="post" action="ustawienia.php" id="f-ch-email">
                        <div class="mb-3">
                            <label for="stary_email" class="form-label">Stary adres email</label>
                            <input name="stare_email" type="email" class="form-control mb-3" id="stary_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="nowy_email" class="form-label">Nowy adres email</label>
                            <input name="nowy_email" type="email" class="form-control" id="nowy_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="powtorz_email" class="form-label">Powtórz nowe email</label>
                            <input name="powtorz_email" type="email" class="form-control" id="powtorz_email" required>
                        </div>
                        <button name="ch-email" type="submit" class="btn btn-primary btn-ch-email">Zmień email</button>
                    </form>
                    <?php 
                            require("db.php");
                            $conn = mysqli_connect($servername, $username, $password, $dbname);
                            if (mysqli_connect_errno()) {
                                printf("Nie udalo sie polaczyc: %s\n", mysqli_connect_error());
                                exit();
                            };

                            $msg = '';
                            function blad($msg) {
                                echo "<p class='text-danger'>".$msg."</p>";
                            }

                            if(isset($_POST['ch-email'])){
                                $id = $_SESSION['id'];
                                $stary_email = $_POST['stary_email'];
                                $nowy_email = $_POST['nowy_email'];
                                $powtorz_email = $_POST['powtorz_email'];
                                                    
                                $sql = "SELECT * FROM uzytkownicy WHERE email = $nowy_email";
                                $res = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                                $rowcount = mysqli_num_rows($res);
                                        
                                if ($rowcount == 0) {
                                    $sql = "SELECT * FROM uzytkownicy WHERE id_uzytkownicy = $id";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    if($stary_email == $row['email']) {
                                        if ($nowy_email == $powtorz_email) {
                                            $up = "UPDATE uzytkownicy SET haslo = '".$hash."', czy_zmienione = '1' WHERE id_uzytkownicy = $id";
                                            $result = mysqli_query($conn, $up);
                                            echo "<p class='text-info'>Hasło zostało zmienione!</p>";
                                        } else {
                                            $msg = "Emaile się nie zgadają!";
                                            blad($msg);
                                        }
                                    } else {
                                        $msg = "Wpisz poprawnie swój obecny email!";
                                        blad($msg);
                                    }
                                } else {
                                    $msg = "Taki email jest już w użyciu!";
                                    blad($msg);
                                }
                            } 
                            mysqli_close($conn);
                            echo "\n";
                        ?>
                    <form method="post" action="ustawienia.php" id="f-ch-password">
                        <div class="mb-3">
                            <label for="stare_haslo" class="form-label">Stare hasło</label>
                            <input name="stare_haslo" type="password" class="form-control mb-3" id="stare_haslo" required>
                        </div>
                        <div class="mb-3">
                            <label for="nowe_haslo" class="form-label">Nowe hasło</label>
                            <input name="nowe_haslo" type="password" class="form-control" id="nowe_haslo" required>
                        </div>
                        <div class="mb-3">
                            <label for="powtorz_haslo" class="form-label">Powtórz nowe hasło</label>
                            <input name="powtorz_haslo" type="password" class="form-control" id="powtorz_haslo" required>
                        </div>
                        <button name="ch-password" type="submit" class="btn btn-primary btn-ch-password">Zmień hasło</button>
                    </form>
                    <?php 
                            $conn = mysqli_connect($servername, $username, $password, $dbname);
                            if (mysqli_connect_errno()) {
                                printf("Nie udalo sie polaczyc: %s\n", mysqli_connect_error());
                                exit();
                            };

                            if(isset($_POST['ch-password'])){
                                $id = $_SESSION['id'];
                                $stare_haslo = $_POST['stare_haslo'];
                                $nowe_haslo = $_POST['nowe_haslo'];
                                $powtorz_haslo = $_POST['powtorz_haslo'];
                                                    
                                $sql = "SELECT * FROM uzytkownicy WHERE id_uzytkownicy = $id";
                                $res = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                                        
                                if(password_verify($stare_haslo,$row['haslo'])){
                                    if(strlen($nowe_haslo) > 6 && strlen($nowe_haslo) < 21 ) {
                                        if($nowe_haslo == $powtorz_haslo){
                                            $hash = password_hash($powtorz_haslo,PASSWORD_BCRYPT);
                                            $up = "UPDATE uzytkownicy SET haslo = '".$hash."', czy_zmienione = '1' WHERE id_uzytkownicy = $id";
                                            $result = mysqli_query($conn, $up);
                                            echo "<p class='text-info'>Hasło zostało zmienione!</p>";
                                        } else {
                                            $msg = "Hasła się nie zgadzają!";
                                            blad($msg);
                                        }
                                    } else {
                                        $msg = "Hasło nie spełnia wymagań! Powinno zawierać od 7 do 20 znaków!";
                                        blad($msg);
                                    }
                                } else {
                                    $msg = "Wpisałeś złe hasło!";
                                    blad($msg);
                                }
                            } 
                            mysqli_close($conn);
                            echo "\n";
                        ?>
                    <form method="post" action="ustawienia.php" id="f-ch-password">
                        <div class="mb-3">
                            <label for="stare_haslo" class="form-label">Stare hasło</label>
                            <input name="stare_haslo" type="password" class="form-control mb-3" id="stare_haslo" required>
                        </div>
                        <div class="mb-3">
                            <label for="nowe_haslo" class="form-label">Nowe hasło</label>
                            <input name="nowe_haslo" type="password" class="form-control" id="nowe_haslo" required>
                        </div>
                        <div class="mb-3">
                            <label for="powtorz_haslo" class="form-label">Powtórz nowe hasło</label>
                            <input name="powtorz_haslo" type="password" class="form-control" id="powtorz_haslo" required>
                        </div>
                        <button name="ch-password" type="submit" class="btn btn-primary btn-ch-password">Zmień hasło</button>
                    </form>
                    <?php 
                            $conn = mysqli_connect($servername, $username, $password, $dbname);
                            if (mysqli_connect_errno()) {
                                printf("Nie udalo sie polaczyc: %s\n", mysqli_connect_error());
                                exit();
                            };

                            if(isset($_POST['ch-password'])){
                                $id = $_SESSION['id'];
                                $stare_haslo = $_POST['stare_haslo'];
                                $nowe_haslo = $_POST['nowe_haslo'];
                                $powtorz_haslo = $_POST['powtorz_haslo'];
                                                    
                                $sql = "SELECT * FROM uzytkownicy WHERE id_uzytkownicy = $id";
                                $res = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);;
                                        
                                if(password_verify($stare_haslo,$row['haslo'])){
                                    if(strlen($nowe_haslo) > 6 && strlen($nowe_haslo) < 21 ) {
                                        if($nowe_haslo == $powtorz_haslo){
                                            $hash = password_hash($powtorz_haslo,PASSWORD_BCRYPT);
                                            $up = "UPDATE uzytkownicy SET haslo = '".$hash."', czy_zmienione = '1' WHERE id_uzytkownicy = $id";
                                            $result = mysqli_query($conn, $up);
                                            echo "<p class='text-info'>Hasło zostało zmienione!</p>";
                                        } else {
                                            $msg = "Hasła się nie zgadzają!";
                                            blad($msg);
                                        }
                                    } else {
                                        $msg = "Hasło nie spełnia wymagań! Powinno zawierać od 7 do 20 znaków!";
                                        blad($msg);
                                    }
                                } else {
                                    $msg = "Wpisałeś złe hasło!";
                                    blad($msg);
                                }
                            } 
                            mysqli_close($conn);
                            echo "\n";
                        ?>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/57516c6d9a.js" crossorigin="anonymous"></script>
</body>

</html>