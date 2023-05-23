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
    <title>MDP ŁAWY - Lista obecności</title>
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

<body style="overflow-x: scroll">
 
    <button class="btn btn-light" style="margin: 2vh; padding: 1vh;"><a href="https://osp-lawy.pl/mdp/" class="text-dark">Powrót do strony głownej</a></button>
    <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                        <th scope="col-auto"></th>
                        <?php
                            include("db_login.php");

                            function writeError($msg) {
                                echo "<div class='row'>";
                                echo "<div class='col-md-4 col-centered' style='margin-top: 2%;'>";
                                echo "<p class='error'>";
                                echo $msg;
                                echo "</p>";
                                echo "</div>";
                                echo "</div>";
                            }

                            $db = mysqli_connect("$servername", "$username", "$password", "$dbname");

                            $sql = "SELECT * FROM obecnosci ORDER BY id";
                            $result_sql = mysqli_query($db, $sql);

                            while($row_sql = mysqli_fetch_array($result_sql, MYSQLI_ASSOC)) {
                            echo "<th scope='col' class='text-warning'>".$row_sql['data_spotkania']."</th>";
                            }
                        ?>

                </tr>
            </thead>
            <tbody>
                        <?php

                        $query = "SELECT * FROM osoby WHERE mdp='1' ORDER BY id ASC";
                        $result = mysqli_query($db, $query);

                        $sql = "SELECT * FROM obecnosci ORDER BY id";
                        $result_sql = mysqli_query($db, $sql);
                        $ile = mysqli_num_rows($result_sql);

                        if ($ile != "0" ) {
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                echo "<tr><th scope='row'>".$row['imie']." ".$row['nazwisko']."</th>";
                                $sql = "SELECT * FROM obecnosci ORDER BY id";
                                $result_sql = mysqli_query($db, $sql);
                                while($row_sql = mysqli_fetch_array($result_sql, MYSQLI_ASSOC)) {
                                    if ($row_sql[$row['imie']."_".$row['nazwisko']] == "Tak") {
                                        echo "<td class='text-success'>✔</td>";
                                    } else {
                                        echo "<td class='text-danger'>✖</td>";
                                    }
                                }
                                echo "</tr>";
                            }
                        } else {
                            $msg = "Tabela jest pusta!";
                            writeError($msg); 
                        }

                        
                        ?>
            </tbody>
        </table>
    </article>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://use.fontawesome.com/9646649a77.js"></script>
</body>

</html>