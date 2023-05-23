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
    <title>MDP ŁAWY - Strona główna</title>
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
                <img src="img/icon.png" alt="Logp OSP Ławy" style="width:40px"> OSP Ławy
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav navbar-right mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="https://osp-lawy.pl/mdp">Strona główna <span class="sr-only"></span></a>
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
                    <?php

                    if (!isset($_SESSION['zalogowany']))
                    {
                        echo "<li class='nav-item'>
                                <a class='nav-link' href='logowanie'>Logowanie</a>
                              </li>";
                    } else {
                        echo "<li class='nav-item'>
                                <a class='nav-link' href='konto'><i class='fa fa-user' aria-hidden='true'></i></a>
                              </li>";
                        echo "<li class='nav-item'>
                                <a class='nav-link' href='wyloguj'><i class='fa fa-sign-out' aria-hidden='true'></i></a>
                              </li>";
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>
 
    <article>
        <!--<div class="modal show in" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-danger">UWAGA!</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p class="text-dark">Strona w przebudowie. Niektóre funkcje mogą nie działać poprawnie!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
                    </div>
                </div>
            </div>
        </div>-->

        <div class="col-md-10 col-centered bg-panel">
            <h1 class="text-danger">MDP Ławy</h1>
            <img src="img/icon.png" alt="OSP Ławy" class="img-fluid">
        </div>
        <div class="col-md-10 col-centered bg-panel">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-striped table-dark">
                        <thead>
                            <h3 class="bg-dark text-danger">Punktacja <i class="fa fa-trophy text-warning" aria-hidden="true"></i></h3>
                                <tr>
                                    <th scope="col-auto"><b><u>Imie i nazwisko</u></b></th>
                                    <?php
                                        include("db_login.php");

                                        function writeError($msg) {
                                            echo "<div class='row'>";
                                            echo "<div class='col-md-4 col-centered' style='margin-top: 2%;'>";
                                            echo "<p class='error'>";
                                            echo $msg;
                                            echo "</p>";
                                            echo "</div>";
                                            echo "</div>";
                                        }
            
                                        $db = mysqli_connect("$servername", "$username", "$password", "$dbname");

                                        echo "<th scope='col'><b><u>Punkty</u></b></th>";
                                        ?>
                                </tr>
                        </thead>
                        <tbody>
                            <?php

                                $sql = "SELECT * FROM osoby ORDER BY punkty DESC LIMIT 3";
                                $result = mysqli_query($db, $sql);
                                $ile = mysqli_num_rows($result);

                                if ($ile != "0" ) {
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        if (!isset($_SESSION['zalogowany']))
                                        {
                                            echo "<tr><th scope='row'>".$row['imie']."</th>";
                                        } else {
                                            echo "<tr><th scope='row'>".$row['imie']." ".$row['nazwisko']."</th>";
                                        }
                                        echo "<td>".$row['punkty']."</td></tr>";
                                        }
                                    }    
                            ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="col-md-6">
                    <table class="table table-striped table-dark">
                        <thead>
                            <h3 class="bg-dark text-danger">Obecnosci <i class="fa fa-trophy text-warning" aria-hidden="true"></i></h3>
                                <tr>
                                    <th scope="col-auto"><b><u>Imie i nazwisko</u></b></th>
                                    <?php
                                        echo "<th scope='col'><b><u>Obecnosci</u></b></th>";
                                        ?>
                                </tr>
                        </thead>
                        <tbody>
                            <?php

                                $sql = "SELECT * FROM osoby ORDER BY liczba_obecnosci DESC LIMIT 3";
                                $result = mysqli_query($db, $sql);
                                $ile = mysqli_num_rows($result);

                                if ($ile != "0" ) {
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        if (!isset($_SESSION['zalogowany']))
                                        {
                                            echo "<tr><th scope='row'>".$row['imie']."</th>";
                                        } else {
                                            echo "<tr><th scope='row'>".$row['imie']." ".$row['nazwisko']."</th>";
                                        }
                                        echo "<td>".$row['liczba_obecnosci']."</td></tr>";
                                        }
                                    }    
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-10 col-centered bg-panel">
                    <table class="table table-striped table-dark">
                        <thead>
                            <h3 class="bg-dark text-danger" style="margin: 0">Punkty z ostatniego spotkania <i class="fa fa-star text-warning" aria-hidden="true"></i></h3>
                            <tr>
                                <?php 
                                    $query = "SELECT * FROM aktywnosc ORDER BY data_dodania DESC LIMIT 1";
                                    $result = mysqli_query($db, $query);
                                    $row = mysqli_fetch_array($result);
                                    $data = $row['data_dodania'];
                                    $query = "SELECT * FROM aktywnosc WHERE data_dodania = '$data'";
                                    $result = mysqli_query($db, $query);
                                    $rowcount = mysqli_num_rows($result);
                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    if ($rowcount != 0){
                                        echo "<th scope='col'><b><u>Data: ".$row['data_dodania']."</u></b></th>";
                                    }
                                    ?>
                                    </th>
                                    <th scope='col'><b><u>Kategoria</u></b></th>
                                    <th scope='col'><b><u>Punkty</u></b></th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php     
                                    $query = "SELECT * FROM aktywnosc ORDER BY data_dodania DESC LIMIT 1";
                                    $result = mysqli_query($db, $query);
                                    $row = mysqli_fetch_array($result);
                                    $data = $row['data_dodania'];
                                    $query = "SELECT * FROM aktywnosc WHERE data_dodania = '$data'";
                                    $result = mysqli_query($db, $query);
                                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        if (!isset($_SESSION['zalogowany']))
                                        {
                                            echo "<tr><th scope='row'>Nie jesteś zalogowany!</th>";
                                        } else {
                                            echo "<tr><th scope='row'>".$row['kto']."</th>";
                                        }  
                                        echo "<td>".$row['kategoria']."</td>";
                                        echo "<td>".$row['ilosc_punktow']."</td>";
                                    }
                                ?>    
                            </tr>
                        </tbody>
                    </table>
                </div>
                

        </article>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://use.fontawesome.com/9646649a77.js"></script>
</body>

</html>