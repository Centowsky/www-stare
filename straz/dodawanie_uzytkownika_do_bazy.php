<?php
        require_once("db.php");
        $conn = mysqli_connect($servername, $username, $password, $dbname);

		$pesel = $_POST['pesel'];
		$imie = $_POST['imie'];
		$nazwisko = $_POST['nazwisko'];
		$haslo = $_POST['haslo'];
		$uprawnienia = $_POST['uprawnienia'];
		
		$hash = password_hash($haslo,PASSWORD_BCRYPT);
		
		$sql = "INSERT INTO uzytkownicy (pesel, haslo, imie, nazwisko, uprawnienia) VALUES ('$pesel', '$hash', '$imie', '$nazwisko', '$uprawnienia')";
		$res = mysqli_query($conn, $sql);
		if($res)
		{
			echo "Registration successfully";
		}
        mysqli_close($conn);
?>