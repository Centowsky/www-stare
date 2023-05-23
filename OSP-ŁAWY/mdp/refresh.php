<?php

function refresh() {
    include("db_login.php");

    $db = mysqli_connect("$servername", "$username", "$password", "$dbname");
    
    //SESJA
    $login = $_SESSION['login'];
    $sql = "SELECT * FROM osoby WHERE login = '$login'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $_SESSION['zalogowany'] = true;
    $_SESSION['id'] = $row['id'];
    $_SESSION['login'] = $row['login'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['imie'] = $row['imie'];
    $_SESSION['nazwisko'] = $row['nazwisko'];
    $_SESSION['ranga'] = $row['ranga'];
    $_SESSION['punkty'] = $row['punkty'];
    $_SESSION['liczba_obecnosci'] = $row['liczba_obecnosci'];
    $_SESSION['sort'] = $row['sort'];
    $_SESSION['opis'] = $row['opis'];
    $_SESSION['admin'] = $row['admin'];
    $_SESSION['uprawnienia'] = $row['uprawnienia'];

    $login = $_SESSION['login'];
    $kto = $_SESSION['imie']."_".$_SESSION['nazwisko'];
    $_SESSION['kto'] = $kto;
    $kto2 = $_SESSION['imie']." ".$_SESSION['nazwisko'];
    $_SESSION['kto2'] = $kto2;

    $sql = "SELECT * FROM `osoby` ORDER BY id";
    $result = mysqli_query($db, $sql);
    while($row  = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        //SUMA PUNKTOW
        $kto = $row['imie']." ".$row['nazwisko'];
        $login = $row['login'];
        $query = "SELECT SUM(ilosc_punktow) AS suma FROM aktywnosc WHERE kto = '$kto'";
        $result_q = mysqli_query($db, $query);
        $row_q = mysqli_fetch_array($result_q);
        $suma = $row_q['suma'];
        $update = "UPDATE `osoby` SET punkty = '$suma' WHERE login = '$login'";
        $result_u = mysqli_query($db, $update);
    
        //SUMA OBECNOSCI
        $kto = $row['imie']."_".$row['nazwisko'];
        $login = $row['login'];
        $query = "SELECT * FROM `obecnosci` WHERE $kto = 'Tak'";
        $result_q = mysqli_query($db, $query);
        $ile = mysqli_num_rows($result_q);
        $update = "UPDATE `osoby` SET liczba_obecnosci = '$ile' WHERE login = '$login'";
        $result_u = mysqli_query($db, $update);
    };

}

?>