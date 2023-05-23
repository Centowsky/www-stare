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
    <title>MDP ŁAWY - Statystyki</title>
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
    <button class="btn btn-danger" style="margin: 2vh; padding: 1vh;"><a href="https://osp-lawy.pl/mdp/" class="text-light">Powrót do strony głownej</a></button>
        <table class="table table-striped table-light text-dark">
                <thead>
                <th scope="col-auto"><b><u>Imie i nazwisko</b></u></th>
                <th scope='col'><b><u>Ranga</b></u></th>
                <th scope='col'><b><u>Punkty</b></u></th>
                <th scope='col'><b><u>Liczba obecnosci</b></u></th>
                <th scope='col'><b><u>Razem</b></u></th>

                        </tr>
                    </thead>
                <tbody>
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
                                        $query = "SELECT * FROM osoby ORDER BY nazwisko";
                                        $result = mysqli_query($db, $query);
                                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                echo "<tr><th scope='row'>".$row['imie']." ".$row['nazwisko']."</th>";
                                                echo "<td>".$row['ranga']."</td>";
                                                echo "<td>".$row['punkty']."</td>";
                                                $kto = $row['imie']."_".$row['nazwisko'];
                                                echo "<td>";
                                                $sql = "SELECT * FROM obecnosci WHERE $kto = 'Tak'";
                                                $result1 = mysqli_query($db, $sql);
                                                $ile = mysqli_num_rows($result1); 
                                                echo $ile;
                                                echo "</td>";
                                                $punkty = $row['punkty'];
                                                $suma = $punkty + $ile;
                                                echo "<td>".$suma."</td>";
                                                echo "</tr>";
                                            }
                                        ?>
                </tbody>
                </table>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://use.fontawesome.com/9646649a77.js"></script>
</body>

</html>