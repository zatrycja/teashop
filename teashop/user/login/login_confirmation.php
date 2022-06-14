<?php
    session_start();
    $pol = new mysqli("localhost","root","","teashop");
    if ($pol->connect_error)
        die("brak połączenia z bazą");
    $zap = "SELECT iduzytkownik, idrola, login, haslo FROM uzytkownicy WHERE login ='".$_POST["login"]."' AND haslo = '".$_POST["haslo"]."'";
    $wynik = $pol->query($zap);
    $wiersz = $wynik->fetch_assoc();
    if ($wynik->num_rows == 1) {
        $_SESSION["user"] = $wiersz["iduzytkownik"];
        $_SESSION["user_rola"] = $wiersz["idrola"];
        header("Location: ../user.php"); 
    }
    else {
        echo "<script>
        alert('Niepoprawny login lub hasło.');
        window.location = 'login.php';</script>";
    }
    $pol->close();
?>