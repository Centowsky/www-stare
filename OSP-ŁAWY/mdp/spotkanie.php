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
    <title>MDP ŁAWY - Spotkanie</title>
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
                            <a class="dropdown-item active" href="spotkanie">Spotkanie</a>
                            <a class="dropdown-item" href="aktywnosci">Aktywności</a>
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
        <div class="col-md-10 col-centered">
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

    ?>

            <form action="spotkanie" method="post" class="bg-panel">
            
                    <div class="col-md-6 col-centered">
                        <h1 class="text-warning">Dodaj spotkanie</h1> 
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                            </div>
                            <input type="date" class="form-control" name="data" required>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%; margin: 1% 0 3% 0" name="dodaj">Dodaj</button>
                    </div>
                    
                    <?php
                        if(isset($_POST['data'])) {
                            $data = $_POST['data'];
                            if (isset($_POST['dodaj'])) {
                                        $add = "INSERT INTO `obecnosci` (id, data_spotkania) VALUES ('', '$data')";
                                        $result = mysqli_query($db, $add);
                                        echo "<script>";
                                        echo "location.href='spotkanie'";
                                        echo "</script>";
                                }
                            }

                        ?>
                        </form>
            
            <form method="post" action="spotkanie">
                    <div class="col-md-12 col-centered bg-panel" style="margin-top: 2%; padding: 1% 0 4% 0">
                    <?php       
                            
                                        $sql= "SELECT * FROM `obecnosci` ORDER BY id DESC LIMIT 1";
                                        $result = mysqli_query($db, $sql);
                                        $row = mysqli_fetch_array($result);

                                        $data = $row['data_spotkania'];
                                        echo "<p class='text-warning h3'>Sprawdzasz z dnia: <b class='text-info'>".$data."</b></p><br><br>";

                                        $sql = "SELECT * FROM `osoby` WHERE mdp= '1' ORDER BY id";
                                        $result = mysqli_query($db, $sql);

                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $kto = $row['imie']."_".$row['nazwisko'];
                                        $sql1= "SELECT * FROM `obecnosci` ORDER BY id DESC LIMIT 1";
                                        $result1 = mysqli_query($db, $sql1);
                                        $row1 = mysqli_fetch_array($result1);
                                        echo "<p class='h4 text-primary'>".$row['imie']." ".$row['nazwisko']."</p>";
                                            if ($row1[$kto]=='Tak') {
                                                echo "<div class='form-check form-check-inline'>
                                                    <input class='form-check-input' type='radio' name='".$row['id']."' value='Tak' checked>
                                                    <label class='form-check-label'>Obecny</label></div>
                                                    <div class='form-check form-check-inline'>
                                                    <input class='form-check-input' type='radio' name='".$row['id']."' value='Nie'>
                                                    <label class='form-check-label'>Nieobecny</label>
                                                    </div><br><br>";
                                            } else {
                                                echo "<div class='form-check form-check-inline'>
                                                    <input class='form-check-input' type='radio' name='".$row['id']."' value='Tak'>
                                                    <label class='form-check-label'>Obecny</label></div>
                                                    <div class='form-check form-check-inline'>
                                                    <input class='form-check-input' type='radio' name='".$row['id']."' value='Nie' checked>
                                                    <label class='form-check-label'>Nieobecny</label>
                                                    </div><br><br>";
                                            }
                                        }
                                        echo "<button class='btn btn-success' type='submit' style='width: 50%' name='wyslij'>Wyslij</button>";


                                            if(isset($_POST['wyslij'])){
                                                $sqlcount = "SELECT * FROM `osoby`";
                                                $resultcount = mysqli_query($db, $sqlcount);
                                                $ile = mysqli_num_rows($resultcount);
                                                $i;
                                                for ($i=1; $i<=$ile; $i++){
                                                    $value = $_POST[$i];
                                                    if (!empty($_POST[$i])) {

                                                        $sql = "SELECT * FROM `osoby` WHERE id = '$i'";
                                                        $result = mysqli_query($db, $sql);
                                                        $row = mysqli_fetch_array($result);
                                                        $kto = $row['imie']."_".$row['nazwisko'];

                                                        $add = "UPDATE `obecnosci` SET $kto = '$value' WHERE data_spotkania = '$data'";
                                                        $result = mysqli_query($db, $add);
                                                    }
                                                }
                                           
                                               echo "<script>";
                                               echo "location.href='spotkanie'";
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