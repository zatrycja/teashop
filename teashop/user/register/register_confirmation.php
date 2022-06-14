<?php
function alert($ann, $location){
    echo "<script>
    alert('".$ann."');
    window.location = '".$location."';</script>";
}

$pol = new mysqli("localhost","root","","teashop");
if ($pol->connect_error)
    die("brak połączenia z bazą");

if($_POST["password"] == $_POST["confirm_password"]){
    $zap = "SELECT * FROM uzytkownicy WHERE login ='{$_POST["login"]}'";
    $wynik = $pol->query($zap);
    
    if ($wynik->num_rows == 0) {
        $zap = "SELECT * FROM uzytkownicy WHERE email ='{$_POST["email"]}'";
        $wynik = $pol->query($zap);

        if ($wynik->num_rows == 0) {
            $zap = "INSERT INTO uzytkownicy VALUES (0, '{$_POST["login"]}', '{$_POST["password"]}', 1, '{$_POST["nrtelefonu"]}', '{$_POST["email"]}', '{$_POST["name"]}', '{$_POST["surname"]}', CURDATE())";
            
            if ($pol->query($zap) === TRUE)
                alert("Pomyślnie zarejestrowano.", "../login/login.php");
            else
                alert("Wystąpił błąd podczas rejestracji.", "../login/login.php");
        }
        else
            alert("Istnieje konto o podanym adresie email.", "register.html");
    }
    else
        alert("Podany login jest już zajęty.", "register.html");
}
else
    alert("Podano różne hasła.", "register.html");
$pol->close();
?>