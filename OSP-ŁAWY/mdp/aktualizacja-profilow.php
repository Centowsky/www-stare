<?php

	session_start();
	
	if ($_SESSION['uprawnienia']!="1" && $_SESSION['admin']!="1")
	{
		header('Location: https://osp-lawy.pl/mdp');
		exit();
    } else {
        include("refresh.php");

        refresh();
    }
    
?>
<!DOCTYPE html>
<html lang="pl_PL">

<head>
    <title>MDP ŁAWY - Aktualizacja profilów</title>
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
                            <a class="dropdown-item" href="aktywnosci">Aktywności</a>
                            <a class="dropdown-item" href="sprawdz-profil">Sprawdz profil</a>
                            <a class="dropdown-item active" href="aktualizacja-profilow">Aktualizacja profilow</a>
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

        <form action="aktualizacja-profilow" method='post'>
            <div class="col-md-4 col-centered bg-dark" style="margin-top: 2%;">
                        <h1 class="text-warning">Zmien range i opis</h1> 
            <select name="uzytkownik" class="form-control" style="margin-top: 1%" required>
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

                        $sql = "SELECT * FROM osoby ORDER BY id";
                        $result = mysqli_query($db, $sql);
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<option value='".$row['id']."'>".$row['imie']." ".$row['nazwisko']."</option>";
                        }



                        ?>
                            </select>
            <select name="ranga" class="form-control" style="margin-top: 1%" required>
                        <option disabled selected value="">Wybierz range</option>
                        <?php

                        $sql = "SELECT * FROM rangi ORDER BY id";
                        $result = mysqli_query($db, $sql);
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<option value='".$row['ranga']."'>".$row['ranga']."</option>";
                        }

                        ?>
                            </select>
            <textarea class='form-control' rows='5' id='opis' name='opis' placeholder='Podaj opis' style="margin-top: 1%" required></textarea>
            <button type='submit' class='btn btn-primary' style="width: 100%; margin: 1% 0 3% 0" name='zaktualizuj'>Zaktualizuj</button>

                <?php

                if (isset($_POST['zaktualizuj'])) {
                    $id = $_POST['uzytkownik'];
                $ranga = $_POST['ranga'];
                $opis = $_POST['opis'];
                    $add = "UPDATE `osoby` SET ranga = '$ranga', opis = '$opis' WHERE id = '$id'";
                    $result = mysqli_query($db, $add);
                    echo "<script>";
                    echo "location.href='aktualizacja-profilow'";
                    echo "</script>";
                }

                ?>

            </form></div>
            <br>
            <form action="aktualizacja-profilow" method='post'>
            
            <div class="col-md-4 col-centered bg-dark" style="margin-top: 1%;">
                <h1 class="text-warning">Dodaj sort</h1>
                <select name="uzytkownik" class="form-control">
                    <option selected disabled>Komu chcesz dodac</option>
                        <?php

                        $sql = "SELECT * FROM osoby ORDER BY id";
                        $result = mysqli_query($db, $sql);
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<option value=".$row['id'].">".$row['imie']." ".$row['nazwisko']."</option>";
                                        }

                                        

                        ?>
                </select>
                <div class="form-check" style="text-align: left">
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
                            <button type="submit" class="btn btn-primary" style="width: 100%; margin: 1% 0 3% 0" name="dodaj">Dodaj</button>
                        </div>
                            
            </div>
            <?php 
                        
                        if (isset($_POST['dodaj'])) {
                                        $checkBox = implode(', ', $_POST['sort']);
                                        $id = $_POST['uzytkownik'];
                                        
                                        $sql = "UPDATE osoby SET sort = '$checkBox' WHERE id = '$id'";
                                        $result = mysqli_query($db, $sql);
                                        echo "<script>";
                                        echo "location.href='aktualizacja-profilow'";
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