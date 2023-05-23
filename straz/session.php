<?php
function session() {
    include("db.php");

    $conn = mysqli_connect("$servername", "$username", "$password", "$dbname");

    $pesel = $_SESSION['pesel'];
    $sql = "SELECT * FROM uzytkownicy WHERE pesel = '$pesel'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $_SESSION['zalogowany'] = true;
    $_SESSION['id'] = $row['id_uzytkownicy'];
    $_SESSION['pesel'] = $row['pesel'];
    $_SESSION['imie'] = $row['imie'];
    $_SESSION['nazwisko'] = $row['nazwisko'];
    $_SESSION['haslo_zmienione'] = $row['czy_zmienione'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['telefon'] = $row['telefon'];
    $_SESSION['data_urodzenia'] = $row['data_urodzenia'];
    $_SESSION['uprawnienia'] = $row['uprawnienia'];
    $_SESSION['stopien'] = $row['stopien'];
    $_SESSION['badania_lekarskie'] = $row['badania_lekarskie'];
    $_SESSION['kurs_podstawowy'] = $row['kurs_podstawowy'];
    $_SESSION['kurs_kpp'] = $row['kurs_kpp'];
    $_SESSION['kurs_kierowca'] = $row['kurs_kpp'];
    $_SESSION['kurs_dowodca'] = $row['kurs_dowodca'];
    $_SESSION['kurs_techniczny'] = $row['kurs_techniczny'];
    $_SESSION['kurs_poszukiwawczy'] = $row['kurs_poszukiwawczy'];
    $_SESSION['kurs_lpr'] = $row['kurs_lpr'];
    $_SESSION['kurs_sternik'] = $row['kurs_sternik'];
}
?>