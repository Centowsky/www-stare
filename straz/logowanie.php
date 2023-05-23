<?php
	session_start();
	if (isset($_SESSION['zalogowany']))
	{
		header('Location: profil.php');
		exit();
    } 
?>
<!DOCTYPE html>
<html lang="pl_PL">

<head>
    <title>Tytuł</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fixed.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="img/icon.png">
</head>

<body>

    <nav class="navbar navbar-expand-sm navbar-dark sticky-top bg-danger sticky">		
		<a class="navbar-brand" href="#">
            <img src="img/icon.png" alt="Logo" style="width:40px; border-radius: 15px;"> 
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav navbar-right mr-auto">
                <li class="nav-item">
                    <a class="nav-link active font-weight-bold" href="">OSP Ławy <span class="sr-only"></span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-md-4 border border-light border-2 rounded bg-secondary text-start">
                <form method="post" action="logowanie.php">
                    <div class="mb-3">
                        <label for="pesel" class="form-label">PESEL</label>
                        <input name="pesel" type="text" class="form-control" id="pesel" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Hasło</label>
                        <input name="password" type="password" class="form-control" id="password" required>
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary">Zaloguj</button>
                </form>
                <?php 
                    require_once("db.php");
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    if (mysqli_connect_errno()) {
                        printf("Nie udalo sie polaczyc: %s\n", mysqli_connect_error());
                        exit();
                    }

                    $msg = '';
                    function blad($msg) {
                        echo "<p class='text-warning'>".$msg."</p>";
                    }

                    if(isset($_POST['submit'])){
                        $pesel = trim($_POST['pesel']);
                        $haslo = $_POST['password'];
                    
                        $sql = "SELECT * FROM uzytkownicy WHERE pesel = '".$pesel."'";
                        $res = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                                
                        if ($res = mysqli_query($conn,$sql)) {
                            $rowcount = mysqli_num_rows($res);
                            if ($rowcount == 0) {
                                $msg = "Brak takiego konta w bazie danych!";
                                blad($msg);
                            } else {
                                if(password_verify($haslo,$row['haslo'])){
                                    session_start();
                                    $_SESSION['zalogowany'] = true;
                                    $_SESSION['pesel'] = $pesel;
                                    header("Location:profil.php");
                                } else {
                                    $msg = "Hasło jest niepoprawne!";
                                    blad($msg);
                                }
                            } 
                        }
                    }
                    mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://kit.fontawesome.com/57516c6d9a.js" crossorigin="anonymous"></script>
</body>

</html>