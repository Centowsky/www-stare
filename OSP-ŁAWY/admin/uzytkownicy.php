<?php

	session_start();
	
	if ($_SESSION['zalogowany']!="1")
	{
		header('Location: https://osp-lawy.pl/admin/logowanie ');
		exit();
    }
    
?>
<!DOCTYPE html>
<html lang="pl_PL">

<head>
    <title>Panel Administratora | Uzytkownicy</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Panel administartora dla OSP-LAWY.PL">
    <meta name="keywords" content="MDP, MDP Ławy, Ławy, OSP, OSP Ławy, młodzieżowa drużyna pożarnicza">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">
    <link rel="icon" href="img/icon.png">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-sm navbar-dark sticky-top bg-primary sticky">		
			<a class="navbar-brand text-dark" class="" href="https://osp-lawy.pl">
                <img src="img/icon.png" alt="Logo OSP Ławy" style="width:40px"> Panel Administratora
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav navbar-right mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="https://osp-lawy.pl/admin">Zarzadzanie<span class="sr-only"></span></a>
                    </li>
                </ul>
				<ul class="navbar-nav navbar-right mr-right">
					<li class='nav-item'>
                        <a class='nav-link' href='wyloguj'><i class='fa fa-sign-out' aria-hidden='true'></i></a>
					</li>
                </ul>
            </div>
        </nav>
    </header>

    <article>
        <div class="col-md-10 col-centered panel">
            <p class="h2 text-danger">UŻYTKOWNICY</p><br>
            <div class="row">
                <div class="col-md-6 bg-jasny border-ciemny">
                    <p class="h4 text-warning">Dodaj użytkownika</p>
                    <form action="uzytkownicy" method="post">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" class="form-control" name="imie" placeholder="Imie" required>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" class="form-control" name="nazwisko" placeholder="Nazwisko" required>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" class="form-control" name="login" placeholder="Login" required>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
                            </div>
                            <input type="password" class="form-control" name="haslo" placeholder="Haslo" required>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
                            </div>
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="input-group">
                            <select name="ranga" class="form-control" required>
                                <option disabled selected value="">Wybierz range</option>
                                <?php

                                    include("db_login.php");

                                    $db = mysqli_connect("$servername", "$username", "$password", "$dbname");
                                    $db->set_charset("utf8");

                                    function writeError($msg) {
                                        echo "<p class='error'>";
                                        echo $msg;
                                        echo "</p>";
                                    }

                                    $sql = "SELECT * FROM rangi ORDER BY id";
                                    $result = mysqli_query($db, $sql);
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo "<option value='".$row['ranga']."'>".$row['ranga']."</option> \n \t \t \t \t \t \t \t \t \t";
                                    }

                                    ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <textarea class="form-control" rows="5" id="opis" name="opis" placeholder="Opis"></textarea>
                         </div>
                        <div class="input-group">
                            <select name="uprawnienia" class="form-control" required>
                                <option disabled selected value="">Wybierz uprawnienia</option>
                                <option value="0">Brak</option>
                                <option value="1">Moze edytowac</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary submit" name="zarejestruj">Dodaj</button>
                        <?php

                            if (isset($_POST['zarejestruj'])) {

                                $login = $_POST['login'];
                                $imie = $_POST['imie'];
                                $nazwisko = $_POST['nazwisko'];
                                $kto = $imie."_".$nazwisko;
                                $email = $_POST['email'];
                                $haslo = $_POST['haslo'];
                                $ranga = $_POST['ranga'];
                                $opis = $_POST['opis'];
                                $uprawnienia = $_POST['uprawnienia'];

                                $sql = "SELECT * FROM osoby WHERE login = '$login'";
                                $sql1 = "SELECT * FROM osoby WHERE email = '$email'";

                                if ($result = mysqli_query($db,$sql1)) {
                                    $rowcount = mysqli_num_rows($result);
                                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                        if ($rowcount != 0) {
                                            $msg = "Ten email jest juz przypisany do jakiegos konta!";
                                            writeError($msg);
                                        } else {
                                            if ($result = mysqli_query($db,$sql)) {
                                                $rowcount = mysqli_num_rows($result);
                                                if ($rowcount == 0) {
                                                    if ((strlen($login) > 3 ) && (strlen($login) < 21 ))  {
                                                        if ((strlen($haslo) > 3 ) && (strlen($haslo) < 25 ))  {
                                                            $haslo = md5($_POST['haslo']);
                                                            $sql= "INSERT INTO osoby (id, login, haslo, email, imie, nazwisko, ranga, punkty, liczba_obecnosci, sort, opis, mdp, uprawnienia, admin) VALUES ('', '$login', '$haslo', '$email', '$imie', '$nazwisko', '$ranga', '0', '0', '', '$opis', '1', '$uprawnienia','0')";
                                                            $result = mysqli_query($db, $sql);
                                                            $add = "ALTER TABLE `obecnosci` ADD `$kto` VARCHAR( 255 )";
                                                            $add_result = mysqli_query($db, $add);
                                                            echo "<script>";
                                                            echo "location.href='uzytkownicy'";
                                                            echo "</script>";
                                                        } else {
                                                            $msg = "Haslo powinno zawierac od 4 do 24 znakow!";
                                                            writeError($msg);
                                                        }
                                                    } else {
                                                        $msg = "Login powinien zawierac od 4 do 20 liter!";
                                                        writeError($msg);
                                                    }
                                                } else {
                                                    $msg = "Podany uzytkownik juz istnieje!";
                                                    writeError($msg);
                                                }
                                            }
                                        }
                                    } else {
                                        $msg = "Zly format email!";
                                        writeError($msg);
                                    }
                                }

                                mysqli_close($db);

                            }

                        ?>
                    </form>
                </div>
                <div class="col-md-6 bg-jasny border-ciemny">
                    <form method="post" action="uzytkownicy">
                        <p class="h4 text-warning">Zmien sort</p>
                        <div class="input-group">
                            <select name="uzytkownik" class="form-control" required>
                                <option disabled selected value="">Wybierz uzytkownika</option>
                                <?php
                                    $sql = "SELECT * FROM osoby ORDER BY id";
                                    $result = mysqli_query($db, $sql);
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo "<option value='".$row['id']."'>".$row['imie']." ".$row["nazwisko"]."</option> \n \t \t \t \t \t \t \t \t \t";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-check" style="text-align: left;">
                                <input class="form-check-input" name="sort[]" type="checkbox" value="Koszarowka">
                                Koszarowka<br>
                                <input class="form-check-input" name="sort[]" type="checkbox" value="Czapka">
                                Czapka<br>
                                <input class="form-check-input" name="sort[]" type="checkbox" value="Koszulka">
                                Koszulka<br>
                                <input class="form-check-input" name="sort[]" type="checkbox" value="Dres">
                                Dres<br>
                                <input class="form-check-input" name="sort[]" type="checkbox" value="Buty">
                                Buty<br>
                        </div>
                        <button type="submit" class="btn btn-primary submit" name="zmien_sort">Zmien sort</button>
                        <?php

                            if (isset($_POST['zmien_sort'])) {  

                                $sort = implode(', ', $_POST['sort']);

                                $id = $_POST['uzytkownik'];
                                $sql = "UPDATE osoby SET sort = '$sort' WHERE id = '$id'";
                                $result = mysqli_query($db, $sql);

                            }

                        ?>
                    </form>
                </div>
                <div class="col-md-6 bg-jasny border-ciemny">
                    <form method="post" action="uzytkownicy">
                        <p class="h4 text-warning">Zmien haslo</p>
                        <div class="input-group">
                            <select name="uzytkownik" class="form-control" required>
                                <option disabled selected value="">Wybierz uzytkownika</option>
                                <?php
                                    $sql = "SELECT * FROM osoby ORDER BY id";
                                    $result = mysqli_query($db, $sql);
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo "<option value='".$row['id']."'>".$row['imie']." ".$row["nazwisko"]."</option> \n \t \t \t \t \t \t \t \t \t";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
                            </div>
                            <input type="password" class="form-control" name="haslo" placeholder="Podaj hasło" required>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
                            </div>
                            <input type="password" class="form-control" name="haslo_potwierdz" placeholder="Potwierdź hasło" required>
                        </div>
                        <button type="submit" class="btn btn-primary submit" name="zmien_haslo">Zmien haslo</button>
                        <?php

                            if (isset($_POST['zmien_haslo'])) {  
                                $haslo = md5($_POST['haslo']);
                                $haslo_potwierdz = md5($_POST['haslo_potwierdz']);
                                if ($haslo == $haslo_potwierdz) {
                                    $id = $_POST['uzytkownik'];
                                    $sql = "UPDATE osoby SET haslo = '$haslo_potwierdz' WHERE id = '$id'";
                                    $result = mysqli_query($db, $sql);
                                    echo "<script>";
                                    echo "location.href='uzytkownicy'";
                                    echo "</script>";
                                }
                            }

                            ?>
                    </form>
                </div>
                <div class="col-md-6 bg-jasny border-ciemny">
                    <form method="post" action="uzytkownicy">
                        <p class="h4 text-warning">Zmien email</p>
                        <div class="input-group">
                            <select name="uzytkownik" class="form-control" required>
                                <option disabled selected value="">Wybierz uzytkownika</option>
                                <?php
                                    $sql = "SELECT * FROM osoby ORDER BY id";
                                    $result = mysqli_query($db, $sql);
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo "<option value='".$row['id']."'>".$row['imie']." ".$row["nazwisko"]."</option> \n \t \t \t \t \t \t \t \t \t";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                            </div>
                            <input type="email" class="form-control" name="email" placeholder="Podaj email" required>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                            </div>
                            <input type="email" class="form-control" name="email_potwierdz" placeholder="Potwierdź email" required>
                        </div>
                        <button type="submit" class="btn btn-primary submit" name="zmien_email">Zmien email</button>
                        <?php

                            if (isset($_POST['zmien_email'])) {  

                                $email = $_POST['email'];
                                $email_potwierdz = $_POST['email_potwierdz'];
    
                                if ($email == $email_potwierdz) {

                                    $id = $_POST['uzytkownik'];
                                    $sql = "UPDATE osoby SET email = '$email_potwierdz' WHERE id = '$id'";
                                    $result = mysqli_query($db, $sql);
                                    echo "<script>";
                                    echo "location.href='uzytkownicy'";
                                    echo "</script>";
                                }
                            }

                        ?>
                    </form>
                </div>
                <div class="col-md-6 bg-jasny border-ciemny">
                    <form method="post" action="uzytkownicy">
                        <p class="h4 text-warning">Zmien punkty</p>
                        <div class="input-group">
                            <select name="uzytkownik" class="form-control" required>
                                <option disabled selected value="">Wybierz uzytkownika</option>
                                <?php
                                    $sql = "SELECT * FROM osoby ORDER BY id";
                                    $result = mysqli_query($db, $sql);
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo "<option value='".$row['id']."'>".$row['imie']." ".$row["nazwisko"]."</option> \n \t \t \t \t \t \t \t \t \t";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-circle" aria-hidden="true"></i></div>
                            </div>
                            <input type="number" class="form-control" name="punkty" placeholder="Liczba punktow" required>
                        </div>
                        <button type="submit" class="btn btn-primary submit" name="zmien_punkty">Zmien punkty</button>
                        <?php

                            if (isset($_POST['zmien_punkty'])) {  

                                $punkty = $_POST['punkty'];

                                $id = $_POST['uzytkownik'];
                                $sql = "UPDATE osoby SET punkty = '$punkty' WHERE id = '$id'";
                                $result = mysqli_query($db, $sql);
                                echo "<script>";
                                echo "location.href='uzytkownicy'";
                                echo "</script>";
                                }

                        ?>
                    </form>
                </div>
                <div class="col-md-6 bg-jasny border-ciemny">
                    <form method="post" action="uzytkownicy">
                        <p class="h4 text-warning">Zmien liczbe obecnosci</p>
                        <div class="input-group">
                            <select name="uzytkownik" class="form-control" required>
                                <option disabled selected value="">Wybierz uzytkownika</option>
                                <?php
                                    $sql = "SELECT * FROM osoby ORDER BY id";
                                    $result = mysqli_query($db, $sql);
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo "<option value='".$row['id']."'>".$row['imie']." ".$row["nazwisko"]."</option> \n \t \t \t \t \t \t \t \t \t";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-circle" aria-hidden="true"></i></div>
                            </div>
                            <input type="number" class="form-control" name="liczba_obecnosci" placeholder="Liczba obecnosci" required>
                        </div>
                        <button type="submit" class="btn btn-primary submit" name="zmien_obecnosci">Zmien liczbe obecnosci</button>
                        <?php

                            if (isset($_POST['zmien_obecnosci'])) {  

                                $liczba_obecnosci = $_POST['liczba_obecnosci'];

                                $id = $_POST['uzytkownik'];
                                $sql = "UPDATE osoby SET liczba_obecnosci = '$liczba_obecnosci' WHERE id = '$id'";
                                $result = mysqli_query($db, $sql);
                                echo "<script>";
                                echo "location.href='uzytkownicy'";
                                echo "</script>";
                            }

                        ?>
                    </form>
                </div>
                <div class="col-md-6 bg-jasny border-ciemny">
                    <form method="post" action="uzytkownicy">
                        <p class="h4 text-warning">Zmien range</p>
                        <div class="input-group">
                            <select name="uzytkownik" class="form-control" required>
                                <option disabled selected value="">Wybierz uzytkownika</option>
                                <?php
                                    $sql = "SELECT * FROM osoby ORDER BY id";
                                    $result = mysqli_query($db, $sql);
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo "<option value='".$row['id']."'>".$row['imie']." ".$row["nazwisko"]."</option> \n \t \t \t \t \t \t \t \t \t";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <select name="ranga" class="form-control" required>
                                <option disabled selected value="">Wybierz range</option>
                                <?php
                                    $sql = "SELECT * FROM rangi ORDER BY id";
                                    $result = mysqli_query($db, $sql);
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo "<option value='".$row['ranga']."'>".$row['ranga']."</option> \n \t \t \t \t \t \t \t \t \t";
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary submit" name="zmien_range">Zmien range</button>
                        <?php

                            if (isset($_POST['zmien_range'])) {  

                                $ranga = $_POST['ranga'];

                                $id = $_POST['uzytkownik'];
                                $sql = "UPDATE osoby SET ranga = '$ranga' WHERE id = '$id'";
                                $result = mysqli_query($db, $sql);
                                echo "<script>";
                                echo "location.href='uzytkownicy'";
                                echo "</script>";
                                }

                            ?>
                        </form>
                </div>
                <div class="col-md-6 bg-jasny border-ciemny">
                    <form method="post" action="uzytkownicy">
                        <p class="h4 text-warning">Zmien opis</p>
                        <div class="input-group">
                            <select name="uzytkownik" class="form-control" required>
                                <option disabled selected value="">Wybierz uzytkownika</option>
                                <?php
                                    $sql = "SELECT * FROM osoby ORDER BY id";
                                    $result = mysqli_query($db, $sql);
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo "<option value='".$row['id']."'>".$row['imie']." ".$row["nazwisko"]."</option> \n \t \t \t \t \t \t \t \t \t";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="input-group">
                            <textarea class="form-control" rows="5" name="opis" placeholder="Opis"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary submit" name="zmien_opis">Zmien opis</button>
                        <?php

                            if (isset($_POST['zmien_opis'])) {  

                                $opis = $_POST['opis'];

                                $id = $_POST['uzytkownik'];
                                $sql = "UPDATE osoby SET opis = '$opis' WHERE id = '$id'";
                                $result = mysqli_query($db, $sql);

                            }

                        ?>
                    </form>
                </div>
            </div>
        </div>

        <!--<div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-centered">
                    <div class="admin dodaj-aktywnosc">
                        <form method="post" action="uzytkownicy">
                            <h2 class="text-warning">Zmien opis</h2>
                            <div class="input-group">
                                <select name="uzytkownik" class="form-control" required>
                                    <option disabled selected value="">Wybierz uzytkownika</option>
                                        <?php
                                            $sql = "SELECT * FROM osoby ORDER BY id";
                                            $result = mysqli_query($db, $sql);
                                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                echo "<option value='".$row['id']."'>".$row['imie']." ".$row["nazwisko"]."</option> \n \t \t \t \t \t \t \t \t \t";
                                            }
                                        ?>
                                </select>
                            </div>
                            <div class="input-group">
                                <select name="kategoria" class="form-control" required>
                                    <option disabled selected value="">Wybierz kategorie</option>
                                        <?php
                                            $sql = "SELECT * FROM kategorie ORDER BY id";
                                            $result = mysqli_query($db, $sql);
                                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                echo "<option value='".$row['id']."'>".$row['kategoria']."</option> \n \t \t \t \t \t \t \t \t \t";
                                            }
                                        ?>
                                </select>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-circle" aria-hidden="true"></i></div>
                                </div>
                                <input type="number" class="form-control" name="liczba_punktow" placeholder="Liczba punktów" required>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                                </div>
                                <input type="date" class="form-control" name="data" required>
                            </div>
                            <button type="submit" class="btn btn-primary submit" name="dodaj_aktywnosc">Dodaj aktywność</button>
                            <?php

                                if (isset($_POST['dodaj_aktywnosc'])) {  

                                    $kategoria = $_POST['kategoria'];
                                    $liczba_punktow = $_POST['liczba_punktow'];
                                    $data = $_POST['data'];
                                    $id = $_POST['uzytkownik'];
                                    
                                    $sql = "SELECT * FROM osoby WHERE id = $id";
                                    $result = mysqli_query($db, $sql);
                                    $row = mysqli_fetch_array($result);
                                    $kto = $row['imie']." ".$row['nazwisko'];
                                    $punkty = $row['punkty'];
                                    $punkty = $punkty + $liczba_punktow;
                                    $add = "INSERT INTO aktywnosc (id, kategoria, data_dodania, kto, ilosc_punktow) VALUES ('', '$kategoria', '$data', '$kto', '$liczba_punktow')";
                                    $result_add = mysqli_query($db, $add);
                                    $query = "UPDATE osoby SET punkty = '$punkty' WHERE id = $id";
                                    $result = mysqli_query($db, $query);

                                }

                            ?>
                        </form>
                    </div>
                </div>
                <div class="col-md-10 col-centered">

                </div>
                <div class="col-md-10 col-centered">

                </div>
                <div class="col-md-10 col-centered">
                    <div class="admin dodaj-wyjazd">
                        <form method="post" action="uzytkownicy" enctype="multipart/form-data">
                            <h2 class="text-warning">Dodaj wyjazd</h2>
                            <div class="input-group">
                                <select name="rodzaj" class="form-control" required>
                                    <option disabled selected value="">Wybierz rodzaj wyjazdu</option>
                                    <option value="Pożar">Pożar</option>
                                    <option value="Miejscowe zagrożenie">Miejscowe zagrożenie</option>
                                    <option value="Wypadek">Wypadek</option>
                                </select>
							</div>
                            <div class="input-group">
                                <textarea class='form-control' rows='5' name='opis' placeholder='Podaj opis' required></textarea>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                                </div>
                                <input type="date" class="form-control" name="data" required>
                            </div>
                            <div class="input-group">
                                <input type="file" name="file" style="margin-top: 1%">
                            </div>
                            <button type="submit" class="btn btn-primary submit" name="dodaj_wyjazd">Dodaj wyjazd</button>
                            <?php

                                if(isset($_POST['dodaj_wyjazd'])) {

                                    $rodzaj = $_POST['rodzaj']; 
                                    $opis = $_POST['opis'];   
                                    $data = $_POST['data'];
                                        
                                    $file = $_FILES['file'];
    
                                    $file_name = $file['name'];
                                    $file_tmp = $file['tmp_name'];
                                    $file_size = $file['size'];
                                    $file_error = $file['error'];
    
                                    $file_ext = explode('.', $file_name);
                                    $file_ext = strtolower(end($file_ext));
    
                                    $allowed = array('png', 'jpg', 'jpeg');
    
                                    if(in_array($file_ext, $allowed)) {
                                        if ($file_error === 0 ) {
                                            if ($file_size <= 2097152) {
                                                $file_name_new = uniqid('', true) . '.' . $file_ext;
                                                $file_destination = '../img/wyjazdy/' . $file_name_new;
    
                                                if(move_uploaded_file($file_tmp, $file_destination)) {
                                                    $sql = "INSERT INTO ksiazka_wyjazdow (id, rodzaj, opis, zdjecie, data) VALUES ('', '$rodzaj', '$opis', '$file_destination', '$data')";
                                                    $result = mysqli_query($db, $sql);
                                                }
                                            }
                                        }
                                    } else {
                                        $sql = "INSERT INTO ksiazka_wyjazdow (id, rodzaj, opis, zdjecie, data) VALUES ('', '$rodzaj', '$opis', 'brak', '$data')";
                                        $result = mysqli_query($db, $sql);
                                    }
    
                                }

                            ?>
                        </form>
                    </div>
                </div>
                <div class="col-md-10 col-centered">

                </div>
                <div class="col-md-10 col-centered">

                </div>
                <div class="col-md-10 col-centered">

                </div>
                <div class="col-md-10 col-centered">

                </div>
                <div class="col-md-10 col-centered">

                </div>
                <div class="col-md-10 col-centered">
                    <div class="admin dodaj-mema">
                        <form method="post" action="uzytkownicy">
                        <h2 class="text-warning">Dodaj mema</h2>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-comments" aria-hidden="true"></i></div>
                                </div>
                                <input type="text" class="form-control" name="url" placeholder="Url obrazu" required>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-comments" aria-hidden="true"></i></div>
                                </div>
                                <input type="text" class="form-control" name="odnosnik" placeholder="Odnosnik do zdjecia" required>
                            </div>
                            <button type="submit" class="btn btn-primary submit" name="dodaj_mema">Dodaj mema</button>
                            <?php 
                        
                                if (isset($_POST['dodaj_mema'])) {
                                    $url = $_POST['url'];
                                    $odnosnik = $_POST['odnosnik'];
                                                
                                    $sql = "INSERT INTO memy (id, url, odnosnik) VALUES ('', '$url', '$odnosnik')";
                                    mysqli_query($db, $sql);
                                }

                            ?>
                        </form>
                    </div>
                </div>
                <div class="col-md-10 col-centered">

                </div>
                <div class="col-md-10 col-centered">

                </div>
                <div class="col-md-10 col-centered">
                    <div class="admin akceptacja-wpisow">
                        <form method="post" action="uzytkownicy">
                        <h2 class="text-warning">Akceptacja wpisow</h2>
                            <?php
                            
                                $sql = "SELECT * FROM wpisy WHERE sprawdzone='0' ORDER BY id ASC LIMIT 1";
                                $result = mysqli_query($db, $sql);

                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    echo "<p class='h3'>".$row['tekst']."</p>";
                                    echo "<p class='h5 text-primary'>".$row['podpis']."</p>";
                                    echo "<p class='h6 text-warning'>".$row['data']."</p>";
                                    echo "<button class='btn btn-success' style='margin-right: 2vh;' name='zatwierdz'>✔</button>";
                                    echo "<button class='btn btn-danger' name='odrzuc'>✖</button>";
                                    if (isset($_POST['zatwierdz'])){
                                        $add = "UPDATE `wpisy` SET sprawdzone = '1' WHERE sprawdzone='0'  ORDER BY id ASC LIMIT 1";
                                        $result1 = mysqli_query($db, $add);
                                    }
                                    if (isset($_POST['odrzuc'])){
                                        $add = "DELETE FROM wpisy WHERE sprawdzone='0' ORDER BY id ASC LIMIT 1";
                                        $result1 = mysqli_query($db, $add);
                                    }
                                }
                            
                            ?>
                        </form>
                    </div>
                </div>
                <div class="col-md-10 col-centered">
                    <div class="admin dodaj-post">
                        <form method="post" action="uzytkownicy" enctype="multipart/form-data">
                            <h2 class="text-warning">Dodaj post</h2>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-bullhorn" aria-hidden="true"></i></div>
                                </div>
                                <input type="text" class="form-control" name="tytul" placeholder="Podaj tytuł" required>
                            </div>
                            <div class="input-group">
                                <textarea class='form-control' rows='5' name='tresc' placeholder='Podaj tresc' required></textarea>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                                </div>
                                <input type="date" class="form-control" name="data" required>
                            </div>
                            <div class="input-group">
                                <input type="file" name="file">
                            </div>
                            <button type="submit" class="btn btn-primary submit" name="dodaj_post">Dodaj post</button>
                            <?php

                                if(isset($_POST['dodaj_post'])) {

                                    $tytul = $_POST['tytul']; 
                                    $tresc = $_POST['tresc'];   
                                    $data = $_POST['data'];

                                    $file = $_FILES['file'];

                                    $file_name = $file['name'];
                                    $file_tmp = $file['tmp_name'];
                                    $file_size = $file['size'];
                                    $file_error = $file['error'];

                                    $file_ext = explode('.', $file_name);
                                    $file_ext = strtolower(end($file_ext));

                                    $allowed = array('png', 'jpg', 'jpeg');

                                    if(in_array($file_ext, $allowed)) {
                                        if ($file_error === 0 ) {
                                            if ($file_size <= 2097152) {
                                                $file_name_new = uniqid('', true) . '.' . $file_ext;
                                                $file_destination = '../img/posty/' . $file_name_new;

                                                if(move_uploaded_file($file_tmp, $file_destination)) {
                                                    $sql = "INSERT INTO posty (id, tytul, tresc, zdjecie, data) VALUES ('', '$tytul', '$tresc', '$file_destination', '$data')";
                                                    mysqli_query($db, $sql);
                                                }
                                            }
                                        }
                                    } else {
                                        $sql = "INSERT INTO posty (id, tytul, tresc, zdjecie, data) VALUES ('', '$tytul', '$tresc', 'brak', '$data')";
                                        mysqli_query($db, $sql);
                                    }

                                }

                            ?>
                        </form>
                    </div>
                </div>
                <div class="col-md-10 col-centered">

                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <ul><b>Użytkownik:</b>
                        <li class="dodaj-uzytkownika">Dodaj uzytkownika</li>
                        <li class="zmien-haslo">Zmien haslo</li>
                        <li class="zmien-email">Zmien Email</li>
                        <li class="zmien-punkty">Zmien Punkty</li>
                        <li class="zmien-range">Zmien Range</li>
                        <li class="zmien-l-obecnosci">Zmien liczbe obecnosci</li>
                        <li class="zmien-sort">Zmien sort</li>
                        <li class="zmien-opis">Zmien opis</li>
                    </ul>     
                </div>
                <div class="col-md-2">
                    <ul><b>Aktywność:</b>
                        <li class="dodaj-aktywnosc">Dodaj</li>
                        <li class="zmien-aktywnosc">Zmien</li>
                        <li class="usun-aktywnosc">Usun</li>
                    </ul>   
                </div>
                <div class="col-md-2">
                    <ul><b>Książka wyjazdów:</b>
                        <li class="dodaj-wyjazd">Dodaj</li>
                        <li class="zmien-wyjazd">Zmien</li>
                        <li class="usun-wyjazd">Usun</li>
                    </ul>   
                </div>
                <div class="col-md-2">
                    <ul><b>Kategorie:</b>
                        <li class="dodaj-kategorie">Dodaj</li>
                        <li class="zmien-kategoie">Zmien</li>
                        <li class="usun-kategorie">Usun</li>
                    </ul>   
                </div>
                <div class="col-md-2">
                    <ul><b>Memy:</b>
                        <li class="dodaj-mema">Dodaj</li>
                        <li class="zmien-mema">Zmien</li>
                        <li class="usun-mema">Usun</li>
                    </ul>   
                </div>
                <div class="col-md-2">
                    <ul><b>Zarządzaj:</b>
                        <li class="akceptacja-wpisow">Akceptacja wpisow</li>
                        <li class="dodaj-post">Dodaj post</li>
                        <li class="zmien-ogloszenie">Zmien ogloszenie</li>
                    </ul>   
                </div>
            </div>
        </div>-->
    </article>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://use.fontawesome.com/9646649a77.js"></script>
</body>

</html>