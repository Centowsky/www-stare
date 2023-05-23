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
    <title>MDP ŁAWY - Sprawdź profil</title>
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
                            <a class="dropdown-item active" href="sprawdz-profil">Sprawdz profil</a>
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
        <div class="col-md-10 col-centered">

            <form action="sprawdz-profil" method="post">
            
                    <div class="col-md-4 col-centered bg-dark" style="margin-top: 2%">
                        <h1 class="text-warning">Wybierz użytkownika</h1> 
                        
                            <select name="uzytkownik" class="form-control">
                            <option selected disabled>Wybierz kogo profil chcesz sprawdzic</option>
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
                                    
                                    $sql = "SELECT * FROM osoby WHERE mdp= '1' ORDER BY id";
                                    $result = mysqli_query($db, $sql);
                                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        echo "<option value=".$row['id'].">".$row['imie']." ".$row['nazwisko']."</option>";
                                    }

                                    

                                ?>
                            </select>
                            <button type="submit" class="btn btn-primary" style="width: 100%; margin: 1% 0 3% 0" name="wybierz">Wybierz</button>
                    </div>
                        
                    <?php

                        if(isset($_POST['uzytkownik'])) {
                            if (isset($_POST['wybierz'])) {
                                $id = $_POST['uzytkownik'];

                                $sql = "SELECT * FROM osoby WHERE id = '$id'";
                                $result = mysqli_query($db, $sql);
                                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                $kto = $row['imie']."_".$row['nazwisko'];
                                $imienazwisko = $row['imie']." ".$row['nazwisko'];
                                $sort = $row['sort'];
                                $opis = $row['opis'];
                                $email = $row['email'];

                                echo "
                                <div class='col-md-10 col-centered bg-panel'>
            <h1 class='text-danger'>".$imienazwisko."</h1>
            <h4>".$row['ranga']."</h4>
        </div>
        <br>
        <div class='col-md-10 col-centered bg-panel'>
            <div class='row'>
                <div class='col-md-6'>";
                        $sql = 'SELECT * FROM obecnosci';
                        $result = mysqli_query($db, $sql);
                        $ile = mysqli_num_rows($result);
                        $procent = 100;
                        echo "<h4 class='text-primary'>Obecnosci</h4>";
                        echo "<div class='progress'><div class='progress-bar bg-warning' role='progressbar' style='min-height: 2vh; width: ".$row['liczba_obecnosci']/$ile * $procent."%' aria-valuenow='".$row['liczba_obecnosci']."' aria-valuemin='0' aria-valuemax=".$ile."></div></div>";
                        echo $row['liczba_obecnosci'].'/'.$ile.'<br>';    
                echo "</div>
                <div class='col-md-6'>";
                        $ile = 100;
                        $procent = 100;
                        echo "<h4 class='text-primary'>Punkty</h4>";
                        echo "<div class='progress'><div class='progress-bar bg-success' role='progressbar' style='min-height: 2vh; width: ".$row['punkty']/$ile * $procent."%' aria-valuenow='".$row['punkty']."' aria-valuemin='0' aria-valuemax=".$ile."></div></div>";
                        echo $row['punkty'].'/'.$ile.'<br>';
                echo "</div>
            </div>
        </div>
        <br>
        <div class='col-md-10 col-centered bg-panel'>
            <div class='row'>
                <div class='col-md-6'>
                    <h4 class='text-primary'>Twoje obecnosci</h4>
                    <div class='row bg-white border border-danger rounded'>";  
                            $sql = "SELECT * FROM `obecnosci` WHERE $kto = 'Tak'";
                            $result = mysqli_query($db, $sql);
                            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<div class='col-md-4'>".$row['data_spotkania']."</div>";
                            };
                   echo "</div>
                </div>
                <div class='col-md-6'>
                    <h4 class='text-primary'>Twoje punkty</h4>
                    <div class='row bg-white border border-danger rounded'>";
                            $sql1 = "SELECT * FROM aktywnosc WHERE kto = '$imienazwisko'";
                            $result1 = mysqli_query($db, $sql1);
                            while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                            echo "<div class='row'><div class='col-md-6'>".$row1['kategoria']."</div><div class='col-md-3'>".$row1['data_dodania']."</div><div class='col-md-3'>".$row1['ilosc_punktow']."</div></div><hr>";
                            };
                    echo "</div>
                </div>
            </div>
        </div>
        <br>
        <div class='col-md-10 col-centered bg-panel'>
            <div class='row'>
                <div class='col-md-4'>
                    <p class='font-weight-bold text-primary h5'>Sort</p>
                    <p>".$sort."</p>
                </div>
                <div class='col-md-4'>
                    <p class='font-weight-bold text-primary h5'>Opis</p>
                    <p>".$opis."</p>
                </div>
                <div class='col-md-4'>
                    <p class='font-weight-bold text-primary h5'>Email</p>
                    <p>".$email."</p>
                </div>
            </div>
        </div>";
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