<?php
$pol = new mysqli("localhost", "root", "", "teashop");
if($pol->connect_error)
    die("brak połączenia z bazą");

$zap = "UPDATE produkty SET na_stanie = {$_POST["quantity"]}, czy_dostepny = IF({$_POST["quantity"]} = 0, 0, 1) WHERE idprodukt = {$_GET["pid"]}";
if($pol->query($zap) === TRUE)
    echo "<script>alert('Dokonano zmiany.'); window.location = 'warehouse.php';</script>";
else
    echo "<script>alert('Wystąpił błąd podczas aktualizacji danych.'); window.location = 'warehouse.php';</script>";

$pol->close();
?>