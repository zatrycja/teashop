<?php
$pol = new mysqli("localhost", "root", "", "teashop");
if($pol->connect_error)
    die("brak połączenia z bazą");

$zap = "UPDATE uzytkownicy SET idrola = {$_POST["user_role"]} WHERE iduzytkownik = {$_GET["uid"]}";
if($pol->query($zap) === TRUE)
    echo "<script>alert('Dokonano zmiany roli użytkownika nr {$_GET['uid']}.'); window.location = 'admin_panel.php';</script>";
else
    echo "<script>alert('Wystąpił błąd podczas aktualizacji danych.'); window.location = 'admin_panel.php';</script>";

$pol->close();
?>