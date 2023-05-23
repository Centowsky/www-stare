<?php

	session_start();
	
	if ($_SESSION['uprawnienia']!="1" && $_SESSION['admin']!="1")
	{
		header('Location: https://osp-lawy.pl/mdp');
		exit();
    }
    
?>
<!DOCTYPE html>
<html lang="pl_PL">

<head>
    <title>MDP ŁAWY - Aktywności</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Strona internetowa młodzieżowej drużyny pożarniczej w Ławach - MDP ŁAWY">
    <meta name="keywords" content="MDP, MDP Ławy, Ławy, OSP, OSP-Ławy, młodzieżowa drużyna pożarnicza">
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
                <img src="img/icon.png" alt="Logo OSP Ławy" style="width:40px"> OSP Ławy
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav navbar-right mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="https://osp-lawy.pl/mdp">Strona główna <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="twoj-profil">Twój profil</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lista</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown03">
                            <a class="dropdown-item" href="lista-obecnosci">Obecności</a>
                            <a class="dropdown-item" href="lista-statystyki">Statystyki</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Zarządzaj</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown03">
                            <a class="dropdown-item" href="spotkanie">Spotkanie</a>
                            <a class="dropdown-item active" href="aktywnosci">Aktywności</a>
                            <a class="dropdown-item" href="sprawdz-profil">Sprawdz profil</a>
                            <a class="dropdown-item" href="aktualizacja-profilow">Aktualizacja profilow</a>
                        </div>
                    </li>
    
                </ul>
                <ul class="navbar-nav navbar-right mr-right">
                    <li class="nav-item">
                        <a class="nav-link" href="konto"><i class="fa fa-user" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="wyloguj"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <article>
        <div class="col-md-10 col-centered bg-panel">

<form action="aktywnosci" method="post">
            
            <div class="col-md-8 col-centered">
                <h1 class="text-warning">Dodaj punkty</h1>
                <select name="uzytkownik" class="form-control" required>
                    <option disabled selected value="">Wybierz uzytkownika</option>
                        <?php

                            include("db_login.php");

                            $db = mysqli_connect("$servername", "$username", "$password", "$dbname");

                            function writeError($msg) {
                                echo "<div class='row'>";
                                echo "<div class='col-md-4 col-centered' style='margin-top: 2%;'>";
                                echo "<p class='error'>";
                                echo $msg;
                                echo "</p>";
                                echo "</div>";
                                echo "</div>";
                            }

                            $sql = "SELECT * FROM osoby where mdp='1' ORDER BY id";
                            $result = mysqli_query($db, $sql);
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                echo "<option value='".$row['id']."'>".$row['imie']." ".$row['nazwisko']."</option>";
                            }

                            

                        ?>
                    </select>
                    <select name="kategoria" class="form-control" style="margin-top: 1%" required>
                    <option disabled selected value="">Wybierz kategorie</option>
                        <?php
                            $sql = "SELECT * FROM kategorie ORDER BY id";
                            $result = mysqli_query($db, $sql);
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                echo "<option value='".$row['kategoria']."'>".$row['kategoria']."</option>";
                            }

                            

                        ?>
                    </select>
                <div class="input-group" style="margin-top: 1%">
                    <input type="number" class="form-control" name="liczba" placeholder="Liczba punktów" required>
                </div>
                <div class="input-group" style="margin-top: 1%">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                    </div>
                    <input type="date" class="form-control" name="data" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; margin: 1% 0 3% 0" name="dodaj">Dodaj</button>
            </div>
            <?php



                                if (isset($_POST['dodaj'])) {
                                    if (!empty($_POST['uzytkownik'])) {
                                        if (!empty($_POST['kategoria'])) {
                                            $id = $_POST['uzytkownik'];        
                                            $kategoria = $_POST['kategoria'];
                                            $dodane_punkty = $_POST['liczba'];
                                            $data = $_POST['data'];
                                            $sql = "SELECT * FROM osoby WHERE id = $id";
                                            $result = mysqli_query($db, $sql);
                                            $row = mysqli_fetch_array($result);
                                            $kto = $row['imie']." ".$row['nazwisko'];
                                            $punkty = $row['punkty'];
                                            $punkty = $punkty + $dodane_punkty;
                                            $add = "INSERT INTO aktywnosc (id, kategoria, data_dodania, kto, ilosc_punktow) VALUES ('', '$kategoria', '$data', '$kto', '$dodane_punkty')";
                                            $result_add = mysqli_query($db, $add);
                                            $query = "UPDATE osoby SET punkty = '$punkty' WHERE id = $id";
                                            $result = mysqli_query($db, $query);
                                            echo "<script>";
                                            echo "location.href='aktywnosci.php'";
                                            echo "</script>"; 
                                        } else {
                                            $msg = "Wybierz kategorie!";
                                            writeError($msg);
                                        }
                                    } else {
                                        $msg = "Wybierz komu chcesz dodaj punkty!";
                                        writeError($msg);
                                    }
                                              
                        }
                    
                ?>
                </form>
              
                <form action="aktywnosci" method="post">
    
    <div class="col-md-8 col-centered" style="margin-top: 2%;">
                <h1 class="text-warning">Sprawdz punkty</h1> 
                <select name="data" class="form-control" required>
                    <option disabled selected value="">Wybierz date</option>
                        <?php
                            $sql = "SELECT `kategoria`, `data_dodania`, 'kto', 'ilosc_punktow' FROM `aktywnosc` GROUP BY data_dodania";
                            $result = mysqli_query($db, $sql);
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                echo "<option value='".$row['data_dodania']."'>".$row['data_dodania']."</option>";
                            }

                            

                        ?>
                    </select>
                    <button type="submit" class="btn btn-primary" style="width: 100%; margin: 1% 0 3% 0" name="wybierz">Wybierz</button>
            </div>
            <div class="col-md-8 col-centered" style="margin-top: 2%">
        <table class="table table-striped table-dark table-sm">
            <thead>
                <tr><?php 

                    if (isset($_POST['wybierz'])) {
                        $data = $_POST['data'];
                        $query = "SELECT * FROM aktywnosc WHERE data_dodania = '$data' ORDER BY kto";
                        $result = mysqli_query($db, $query);
                        $rowcount = mysqli_num_rows($result);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        if ($rowcount != 0){
                            echo "<th scope='col'><b><u>Data: ".$row['data_dodania']."</u></b></th>";
                        } else {
                            $msg = "Nie znaleziono dnia w bazie danych";
                            writeError($msg);
                        }
                        echo "</th><th scope='col'>Kategoria</th><th scope='col'>Punkty</th></tr></thead><tbody>";
                         }
                
            if (isset($_POST['data'])) {
                $data = $_POST['data'];
                $query = "SELECT * FROM aktywnosc WHERE data_dodania = '$data' ORDER BY kto";
                $result = mysqli_query($db, $query);
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<tr><th scope='row'>".$row['kto']."</th>";
                        echo "<td>".$row['kategoria']."</td>";
                        echo "<td>".$row['ilosc_punktow']."</td>";
                        echo "</tr>";
                    }
                }

                
                ?>
            </tbody>
        </table>
    </div>
    </form>
    <form action="aktywnosci" method="post">
    
    <div class="col-md-8 col-centered" style="margin-top: 1%;">
                <h1 class="text-warning">Dodaj kategorie</h1>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fa fa-comments" aria-hidden="true"></i></div>
                    </div>
                    <input type="text" class="form-control" name="kategoria" placeholder="Podaj kategorie" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; margin: 1% 0 3% 0" name="dodaj-kategorie">Dodaj</button>
            </div>
            
            <?php               
                   if (isset($_POST['dodaj-kategorie'])) {
                                $kategoria = $_POST['kategoria'];
                                $sql = "INSERT INTO kategorie (id, kategoria) VALUES ('', '$kategoria')";
                                $result = mysqli_query($db, $sql);
                                echo "<script>";
                                echo "location.href='aktywnosci'";
                                echo "</script>";
                    }

                ?>
                </form>

                </div>
        </article>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://use.fontawesome.com/9646649a77.js"></script>
</body>

</html>