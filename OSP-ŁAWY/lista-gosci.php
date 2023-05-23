<!DOCTYPE html>
<html lang="pl_PL">

<head>
    <title>OSP Ławy - Lista gości</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Strona internetowa jednostki OSP KSRG Ławy znajdującej się w gminie Myślibórz. W jednosce funkcjonuje młodzieżowa drużyna pożarnicza.">
    <meta name="keywords" content="OSP, OSP-Ławy, osp-lawy, osp lawy, osp ławy, KSRG, MDP, MDP Ławy, Ławy, młodzieżowa drużyna pożarnicza, ochrona przeciwpożarowa, ratownictwo techniczne, myślibórz, powiat myśliborski, gmina myślibórz, lista gości">
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
                    <li class="nav-item active">
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

    <article>
<!---
            <div class="row">
                <div class="col-md-3">
                    <form action="lista-gosci" method="post">
						    <div class="input-group">
                                <textarea class="form-control" rows="5" name="wpis" placeholder="Wpis" maxlength="120" size="1" max="120" required></textarea>

                            </div>
						    <div class="input-group" style="margin-top: 1%">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user" aria-hidden="true" maxlength="1" size="1" max="20"></i></div>
                                </div>
                                <input type="text" class="form-control" name="podpis" placeholder="Podpis" required>
                            </div>
                            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top:1%;" name="dodaj">Dodaj</button>
                        <?php 

                            include("db_login.php");

                            $db = mysqli_connect("$servername", "$username", "$password", "$dbname");
                        
                            if (isset($_POST['dodaj'])) {
                                $wpis = $_POST['wpis'];
                                $podpis = $_POST['podpis'];
                                $data = date("Y-m-d");
                                            
                                $sql = "INSERT INTO wpisy (id, tekst, podpis, data, sprawdzone) VALUES ('', '$wpis', '$podpis', '$data', '0')";
                                mysqli_query($db, $sql);
                                echo "<script>";
                                echo "location.href='lista-gosci'";
                                echo "</script>";
                                }

                            ?>
                    </form>
                </div>
                <div class="col-md-9">
                    <?php
                    
                        $sql = "SELECT * FROM wpisy WHERE sprawdzone='1' ORDER BY id DESC ";
                        $result = mysqli_query($db, $sql);

                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                            echo "<div class='col-md-10 col-centered post'>";
                            echo "<p class='h4'> ".$row['tekst']."</p>";
                            echo "<p class='text-info h5 font-italic' style='text-align: right'> ".$row['podpis']."</p>";
                            echo "<p class='text-warning h6' style='text-align: right'> ".$row['data']."</p>";
                            echo "</div>";
                        }

                    ?>
                </div>
            </div>-->
<p class="text-info">W budowie</p>

    </article>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://use.fontawesome.com/9646649a77.js"></script>
</body>

</html>