<?php
$pol = new mysqli("localhost", "root", "", "teashop");
if($pol->connect_error)
    die("brak połączenia z bazą");

$zap = "UPDATE platnosci SET czy_dostepny = {$_POST["isavaliable"]} WHERE idplatnosc = {$_GET["pid"]}";
if($pol->query($zap) === TRUE)
    echo "<script>alert('Dokonano zmiany płatności nr {$_GET['pid']}.'); window.location = 'admin_panel.php';</script>";
else
    echo "<script>alert('Wystąpił błąd podczas aktualizacji danych.'); window.location = 'admin_panel.php';</script>";

$pol->close();
?>