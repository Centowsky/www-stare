<!DOCTYPE html>
<html lang="pl_PL">

<head>
    <title>Cento - WebSite</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Strona internetowa młodzieżowej drużyny pożarniczej w Ławach - MDP ŁAWY">
    <meta name="keywords" content="MDP, MDP Ławy, Ławy, OSP, OSP-Ławy, młodzieżowa drużyna pożarnicza">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">
    <link rel="icon" href="../img/icon.png">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-sm navbar-dark sticky-top bg-primary sticky">		
			<a class="navbar-brand" class="" href="https://osp-lawy.pl/cento">
                <img src="../img/icon.png" alt="Logo" style="width:40px; border-radius: 15px;"> 
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav navbar-right mr-auto">
                    <li class="nav-item">
                        <a class="nav-link active font-weight-bold" href="https://osp-lawy.pl/cento">Cento | Website <span class="sr-only"></span></a>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-right mr-right">
                    <li class="nav-item">
                        <a class="nav-link" href="informacje">Informacje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="portfolio">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontakt">Kontakt</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>  

    <article>

    <div class="row">
            
            <div class="col-md-6 col-centered bg-panel">
                <form class="form-horizontal" action="index.php" method="post">
                    
                    <p class="h1">Sito Eratostenesa</p>

                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">Numer</div>
                          </div>
                          <input type="number" class="form-control" name="liczba" placeholder="Podaj liczbe większą od 2" required>
                        </div>
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary" style="width: 100%; margin: 1% 0 1% 0" name="wyslij">Wyślij</button>
                    </div>

                    <?php

                    if (isset($_POST['wyslij'])) {

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

                        $n = $_POST['liczba'];

                        if ($n > 2) {
                            
                                $table = array_fill(2, $n-1, '');

                                for($h = 2; ($h * $h) <= $n; ++$h)
                                {
                                for($i = ($h * $h); $i <= $n; $i += $h)
                                {
                                unset($table[$i]);
                                }
                                }

                                foreach ($table as $klucz => $wartosc)
                                    echo $klucz." -> ".$wartosc."<br>\n";
    
                                
                        } else {
                            $msg = 'Liczba '.$n.' jest mniejsza od 2!';
                            writeError($msg);
                        }
                    }

                    ?>
                </form>
            </div>

        </div>

    </article>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://use.fontawesome.com/9646649a77.js"></script>
</body>

</html>