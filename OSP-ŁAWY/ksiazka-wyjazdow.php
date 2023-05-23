<!DOCTYPE html>
<html lang="pl_PL">

<head>
    <title>OSP Ławy - Książka wyjazdów</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Strona internetowa jednostki OSP KSRG Ławy znajdującej się w gminie Myślibórz. W jednosce funkcjonuje młodzieżowa drużyna pożarnicza.">
    <meta name="keywords" content="OSP, OSP-Ławy, osp-lawy, osp lawy, osp ławy, KSRG, MDP, MDP Ławy, Ławy, młodzieżowa drużyna pożarnicza, ochrona przeciwpożarowa, ratownictwo techniczne, myślibórz, powiat myśliborski, gmina myślibórz, książka wyjazdów">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">
    <link rel="icon" href="img/icon.png">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-sm navbar-dark sticky-top bg-danger sticky">
            <a class="navbar-brand" href="https://osp-lawy.pl/" style="background-color: #FFF; border-radius: 10px; color: #000; padding-right: 6px; padding-left: 6px">
                <img src="img/icon.png" alt="Logo" style="width:40px"> OSP ŁAWY
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav navbar-right mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="https://osp-lawy.pl/">Strona główna <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="ksiazka-wyjazdow">Książka wyjazdów</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="historia">Historia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pojazd">Pojazd</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="galeria">Galeria</a>
                    </li>                   
                    <li class="nav-item">
                        <a class="nav-link" href="https://rcb.gov.pl/raport-dobowy/" target="_blank">Ostrzeżenia pogodowe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lista-gosci">Lista gości</a>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-right mr-right">
                    <li class="nav-item">
                        <a class="nav-link" href="https://osp-lawy.pl/mdp">MDP</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
 
    <article class="home">

    <div class="col-md-8 col-centered bg-semi-transparent">
        <p class="h1 text-primary">Podsumowanie</p>
        <table class="table table-dark table-bordered">
            <thead>
                <tr>
                <th scope="col">Rodzaj</th>
                <th scope="col">Liczba wyjazdów</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-danger">
                <th scope="row">Pożar</th>
                    <td>
                        <?php
                            include("db_login.php");

                            $db = mysqli_connect("$servername", "$username", "$password", "$dbname");
			$db->set_charset("utf8");
                                
                            $sql = "SELECT * FROM ksiazka_wyjazdow WHERE rodzaj = 'Pożar'";
                            $result = mysqli_query($db, $sql);
                            $ile = mysqli_num_rows($result);
                            echo $ile;

                        ?>
                    </td>
                </tr>
                <tr class="bg-primary">
                <th scope="row">Miejscowe zagrożenie</th>
                    <td>
                        <?php

                            $sql = "SELECT * FROM ksiazka_wyjazdow WHERE rodzaj = 'Miejscowe zagrożenie'";
                            $result = mysqli_query($db, $sql);
                            $ile = mysqli_num_rows($result);
                            echo $ile;

                        ?>
                    </td>
                </tr>
                <tr class="bg-info">
                <th scope="row">Wypadek</th>
                    <td>
                        <?php

                            $sql = "SELECT * FROM ksiazka_wyjazdow WHERE rodzaj = 'Wypadek'";
                            $result = mysqli_query($db, $sql);
                            $ile = mysqli_num_rows($result);
                            echo $ile;

                        ?>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

        <div class="col-md-10 col-centered bg-semi-transparent" style="margin-top: 3%;">
                <p class="h1 text-primary">Ostatnie wyjazdy</p>
                <?php
                    

                    $sql = "SELECT * FROM ksiazka_wyjazdow order by data DESC LIMIT 10";
                    $result = mysqli_query($db, $sql);

                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        echo "<div class='row post'>";
                        if($row['zdjecie']=='brak') {
                            echo "<div class='col-md-12'>";
                            echo "<p class='h2 text-danger'> ".$row['rodzaj']."</p>";
                            echo "<p class='h5'> ".$row['opis']."</p>";
                            echo "<p class='text-warning h6'> ".$row['data']."</p>";
                            echo "</div>"."\n";
                        } else {
                            echo "<div class='col-md-4'>";
                            echo "<a target='_blank' href='".$row['zdjecie']."'><img src='".$row['zdjecie']."' alt='".$row['zdjecie']."' class='img-fluid'></a>" ;  
                            echo "</div>";
                            echo "<div class='col-md-8'>";
                            echo "<p class='h2 text-danger'> ".$row['rodzaj']."</p>";
                            echo "<p class='h5'> ".$row['opis']."</p>";
                            echo "<p class='text-warning h6'> ".$row['data']."</p>";
                            echo "</div>"."\n";
                        }
                        echo "</div>";
                    }
                ?>

        </div>
    </article>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://use.fontawesome.com/9646649a77.js"></script>
</body>

</html>