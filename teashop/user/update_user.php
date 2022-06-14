<?php
function alert($ann){
    echo "<script>
    alert('".$ann."');
    window.location = 'user.php';
    </script>";
}           

$pol = new mysqli("localhost","root","","teashop");
if ($pol->connect_error)
    die("brak połączenia z bazą");

if($_POST["password"] == $_POST["confirm_password"]){
    $zap = "SELECT * FROM uzytkownicy WHERE login ='".$_POST["login"]."'";
    $wynik = $pol->query($zap);
    
    if ($wynik->num_rows == 0) {
        $zap = "SELECT * FROM uzytkownicy WHERE email ='".$_POST["email"]."'";
        $wynik = $pol->query($zap);

        if ($wynik->num_rows == 0) {
            $zap = "SELECT * FROM uzytkownicy WHERE iduzytkownik ='{$_GET["uid"]}'";
            $wynik = $pol->query($zap);
            $wiersz = $wynik->fetch_assoc();

            if($_POST["login"] == "")
                $_POST["login"] = $wiersz["login"];
           
            if($_POST["nrtelefonu"] == "")
                $_POST["nrtelefonu"] = $wiersz["nr_telefonu"];
            
            if($_POST["email"] == "")
                $_POST["email"] = $wiersz["email"];
              
            if($_POST["password"] == "")
                $_POST["password"] = $wiersz["haslo"];
           
            $zap = "UPDATE uzytkownicy SET login = '".$_POST["login"]."', haslo = '".$_POST["password"]."', nr_telefonu = '".$_POST["nrtelefonu"]."', email = '".$_POST["email"]."' WHERE iduzytkownik = '".$_GET["uid"]."'";
            
            if ($pol->query($zap) === TRUE)
                alert("Pomyślnie zaktualizowano.");
            else
                alert("Wystąpił błąd podczas aktualizacji danych.");
        }
        else
            alert("Istnieje konto o podanym adresie email.");
    }
    else
        alert("Podany login jest już zajęty.");
}
else
    alert("Podano różne hasła.");
$pol->close();
?>