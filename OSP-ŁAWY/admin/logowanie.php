<?php

	session_start();
    
?>
<!DOCTYPE html>
<html lang="pl_PL">

<head>
    <title>Panel Administratora | Logowanie</title>
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
                <ul class="navbar-nav navbar-right mr-right">
                    <li class="nav-item">
                        <a class="nav-link active" href="logowanie">Logowanie</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
 
    <article>
        <div class="col-md-8 col-centered panel bg-jasny border-ciemny">
            <img src="img/icon.png" alt="OSP Ławy" class="img-fluid">
            <form action="logowanie" method="post">
                <p class="h2 text-warning">Logowanie</p>
                <div class="row">
                    <div class="col-md-12 col-centered" style="margin-top: 1%;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
                            </div>
                            <input type="text" class="form-control" name="login" placeholder="Login" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-centered" style="margin-top: 1%;">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div>
                            </div>
                            <input type="password" class="form-control" name="haslo" placeholder="Haslo"
                                required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-centered" style="margin-top: 1%;">
                        <button type="submit" class="btn btn-primary" style="width: 100%; margin: 1% 0 3% 0" name="zaloguj">Zaloguj</button>
                    </div>
                </div>
                <?php
                    include("db_login.php");

                    $db = mysqli_connect("$servername", "$username", "$password", "$dbname");
                    $db->set_charset("utf8");

                    if (mysqli_connect_errno()) {
                        printf("Nie udalo sie polaczyc: %s\n", mysqli_connect_error());
                        exit();
                    }

                    $msg = '';
                    function writeError($msg) {
                        echo "<p class='error'>";
                        echo $msg;
                        echo "</p>";
                    }

                    if (isset($_POST['zaloguj'])) {

                        $login = $_POST['login'];
                        $haslo = $_POST['haslo'];

                        $sql = "SELECT * FROM osoby WHERE login = '$login'";
                        $result = mysqli_query($db, $sql);

                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                            
                            if ($result = mysqli_query($db,$sql)) {
                                $rowcount = mysqli_num_rows($result);
                                if ($rowcount == 0) {
                                    $msg = "Brak takiego konta w bazie danych!";
                                    writeError($msg);
                                } else {
                                    $haslo = md5($_POST['haslo']);
                                    if ($haslo == $row['haslo']) {
                                    if ($row['admin'] == '1') {
                                            $_SESSION['zalogowany'] = true;
                                            echo "<script>";
                                            echo "location.href='panel-administratora'";
                                            echo "</script>";
                                        } else {
                                            $msg = "Nie jestes administratorem!";
                                            writeError($msg);
                                        }
                                    } else {
                                        $msg = "Bledne haslo!";
                                        writeError($msg);
                                    }
                                } 
                            }
                        mysqli_close($db);
                    }

                    ?>
            </form>

            <div class="row">
                    <div class="col-md-6">
                        <a href="https://osp-lawy.pl/" target="_blank" title="OSP Ławy"><button class="btn btn-danger">OSP</button></a>
                    </div>
                    <div class="col-md-6">
                        <a href="https://osp-lawy.pl/mdp" target="_blank" title="MDP"><button class="btn btn-danger">MDP</button></a>
                    </div>
            </div>
            
        </div>
        
    </article>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://use.fontawesome.com/9646649a77.js"></script>
</body>

</html>