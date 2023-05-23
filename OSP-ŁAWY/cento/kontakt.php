<!DOCTYPE html>
<html lang="pl_PL">

<head>
    <title>Cento - WebSite | Kontakt</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Strona internetowa, portfolio i kontakt - Cento">
    <meta name="keywords" content="Cento, portfolio, kontakt, informacje, website">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/animate.css">
    <link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">
    <link rel="icon" href="img/icon.png">
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-sm navbar-dark sticky-top bg-primary sticky">		
			<a class="navbar-brand" class="" href="https://osp-lawy.pl/cento">
                <img src="img/icon.png" alt="Logo" style="width:40px; border-radius: 15px;"> 
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
                    <li class="nav-item active">
                        <a class="nav-link" href="kontakt">Kontakt</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>  

    <article>

        <div class="row">
            
            <div class="col-md-6 col-centered panel bg-ciemny">
                <form class="form-horizontal" action="kontakt" method="post">
                    
                    <p class="h1">Formularz kontaktowy</p>
                    <p class="text-info">Na wiadomości odpowiadam do 48h :)</p>

                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></div>
                          </div>
                          <input type="text" class="form-control" name="imie" placeholder="Twoje imię" required>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                          </div>
                          <input type="email" class="form-control" name="email" placeholder="Twój email" required>
                        </div>
                    </div>

                    <div class="col-auto">
                        <select name="kategoria" class="form-control">
                            <option selected disabled>Wybierz kategorię wiadomości</option>
                            <option value="Wspolpraca">Współpraca</option>
                            <option value="Pytanie">Pytanie</option>
                            <option value="Inne">Inne</option>
                        </select>       
                    </div>

                    <div class="col-auto" style=" margin: 1% 0 1% 0">
                        <div class="input-group mb-2">
                            <textarea class="form-control" name="tresc" rows="3" placeholder="Treść wiadomości" required></textarea>
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

                        $imie = $_POST['imie'];

                        $email = $_POST['email'];
                        
                        $kategoria = $_POST['kategoria'];

                        $tresc = $_POST['tresc'];

                        $data = date('d-m-Y');

                        $godzina = date('H:i:s');

                        $dokogo = "cent7331@gmail.com";

                        $tytul = $kategoria." | Cento";

                        $msg .= "------------------------------------------------" . "\n";
                        $msg .= "|       Formularz kontaktowy     |" . "\n";
                        $msg .= "------------------------------------------------" . "\n\n";
                        $msg .= $imie . " skontaktował/a się z tobą." . "\n";
                        $msg .= "Adres email do odpowiedzi: " . $email . "\n\n";
                        $msg .= "------------------------------------------------" . "\n\n";
                        $msg .= $tresc . "\n\n";
                        $msg .= "------------------------------------------------" . "\n\n";
                        $msg .= $data . "\n";
                        $msg .= $godzina;

                        $sukces = mail($dokogo, $tytul, $msg);

                        if ($sukces){
                            echo "<script>";
                            echo "location.href='home'";
                            echo "</script>";
                        }
                        else{
                            $msg = "Cos poszlo nie tak!";
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