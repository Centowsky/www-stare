<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: logowanie');
		exit();
    } else {
        include("refresh.php");

        refresh();
    }
    
?>
<!DOCTYPE html>
<html lang="pl_PL">

<head>
    <title>MDP ŁAWY - Konto</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
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
                            <a class="dropdown-item" href="aktualizacja-profilow">Aktualizacja profilow</a>
                        </div>
                    </li>
    
                </ul>
                <ul class="navbar-nav navbar-right mr-right">
                    <li class="nav-item">
                        <a class="nav-link active" href="konto"><i class="fa fa-user" aria-hidden="true"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="wyloguj"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
 
    <article>
        <div class="col-md-8 col-centered bg-panel">
        <form action="konto" method="post">
                <p class="h2 text-warning">Zmiana hasla</p>
                    <div class="row">
                        <div class="col-md-12 col-centered" style="margin-top: 1%;">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
                                </div>
                                <input type="password" class="form-control" name="haslo" placeholder="Podaj nowe hasło" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-centered" style="margin-top: 1%;">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
                                </div>
                                <input type="password" class="form-control" name="haslo_potwierdz" placeholder="Powtórz nowe hasło"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-centered" style="margin-top: 1%;">
                            <button type="submit" class="btn btn-info" style="width: 100%; margin: 1% 0 3% 0" name="zmien">Zmień</button>
                        </div>
                    </div>
                    <?php
        include("db_login.php");

        $db = mysqli_connect("$servername", "$username", "$password", "$dbname");

        if (mysqli_connect_errno()) {
            printf("Nie udalo sie polaczyc: %s\n", mysqli_connect_error());
            exit();
        }

        $msg = '';
        function writeError($msg) {
            echo "<div class='row'>";
            echo "<div class='col-md-4 col-centered' style='margin-top: 2%;'>";
            echo "<p class='error'>";
            echo $msg;
            echo "</p>";
            echo "</div>";
            echo "</div>";
        }

        if (isset($_POST['zmien'])) {

        $haslo = $_POST['haslo'];
        $haslo_potwierdz = $_POST['haslo_potwierdz'];
        $id = $_SESSION['id'];

        if ($haslo == $haslo_potwierdz) {
            $haslo = md5($_POST['haslo']);
            $haslo_potwierdz = md5($_POST['haslo_potwierdz']);
            $sql = "UPDATE osoby SET haslo = '$haslo' WHERE id = '$id'";
            $result = mysqli_query($db, $sql);
        } else {
            $msg = "HasĹ‚a siÄ™ nie zgadzajÄ…";
            echo $msg;
        }

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