<!DOCTYPE html>
<html lang="pl_PL">

<head>
    <title>OSP Ławy - Strona głowna | OSP-LAWY.PL</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Strona internetowa jednostki OSP KSRG Ławy znajdującej się w gminie Myślibórz. W jednosce funkcjonuje młodzieżowa drużyna pożarnicza.">
    <meta name="keywords" content="OSP, OSP-Ławy, osp-lawy, osp lawy, osp ławy, KSRG, MDP, MDP Ławy, Ławy, młodzieżowa drużyna pożarnicza, ochrona przeciwpożarowa, ratownictwo techniczne, myślibórz, powiat myśliborski, gmina myślibórz, strona główna">
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
                        <a class="nav-link active" href="https://osp-lawy.pl/">Strona główna <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
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

        <!--<div class="container text-dark">

            <div class="modal show in" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title text-danger">UWAGA!</h3>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->


        <div class="col-md-10 col-centered bg-semi-transparent" style="margin-top: 3%;">
                <h1 class="text-primary">Aktualności</h1>
                <?php
                    include("db_login.php");

                    $db = mysqli_connect("$servername", "$username", "$password", "$dbname");
                    $db->set_charset("utf8");

                    $sql = "SELECT * FROM posty WHERE aktualne = '1' order by id  DESC LIMIT 5";
                    $result = mysqli_query($db, $sql);

                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                        echo "<div class='row post'>";
                        if($row['zdjecie']=='brak') {
                            echo "<div class='col-md-12'>";
                            echo "<h2 class='text-warning'>".$row['tytul']."</h2>";
                            echo "<p class='h4'>".$row['tresc']."</p>";
                            echo "<h6 class='text-danger'>".$row['data']."</h4>";
                            echo "</div>";
                        } else {
                            echo "<div class='col-md-4'>";
                            echo "<a target='_blank' href='".$row['zdjecie']."'><img src='".$row['zdjecie']."' alt='".$row['zdjecie']."' class='img-fluid'></a>" ;  
                            echo "</div>";
                            echo "<div class='col-md-8'>";
                            echo "<h2 class='text-warning'>".$row['tytul']."</h2>";
                            echo "<p class='h4'>".$row['tresc']."</p>";
                            echo "<h6 class='text-danger'>".$row['data']."</h6>";
                            echo "</div>";
                        }
                        echo "</div>";
                    }
                ?>

        </div>
        <div class="col-md-10 col-centered bg-semi-transparent" style="margin-top: 3%;">
        <h1 class="text-primary">Strażacki humor</h1>
        <div id="carousel" class="carousel slide " data-ride="carousel">
                        <div class="carousel-inner">
                            <?php 
                                $query = "SELECT * FROM memy ORDER BY id DESC";
                                $result = mysqli_query($db, $query);
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    echo    "<div class='carousel-item'>
                                                <div class='card'>
                                                    <div class='card-body' style='padding: 2vh;'>
                                                        <a target='_blank' href='". $row['odnosnik'] ."'><img class='img-fluid' src='". $row['url'] ."' alt='". $row['url'] ."'></a>
                                                    </div>
                                                </div>
                                            </div>";
                                }
                            ?>
                        </div>
                        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon text-warning" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next text-warning" href="#carousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon text-warning" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div> 
        </div>
        <div class="col-md-10 col-centered" style="margin-top: 3%;">
            <div class="row">
                <div class="col-md-3 bg-semi-transparent" style="margin-top: 1%;">
                    <h2 class="text-primary">Dane</h2>
                    <h3 class="text-info">KRS</h3><p>0000183197</h3>
                    <h3 class="text-info">NIP</h3><p>5971641589</p>
                    <h3 class="text-info">REGON</h3><p>812685794</p>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4 bg-semi-transparent" style="margin-top: 1%;">
                    <h1 class="text-primary">Nasz Fanpage</h1>
                    <div id="fb-root"></div>
                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v3.2&appId=144474696338835&autoLogAppEvents=1"></script>
                    <div class="fb-page" data-href="https://www.facebook.com/osplawy/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/osplawy/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/osplawy/">OSP Ławy</a></blockquote></div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3 bg-semi-transparent" style="margin-top: 1%;">
                    <h2 class="text-primary">Kontakt</h2>
                    <h3 class="text-danger">Administratorzy: </h3>
                    <h3 class="text-info">Główny</h3><p>cento@osp-lawy.pl</p>
                    <h3 class="text-info">Główny</h3><p>brothan@osp-lawy.pl</p>
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