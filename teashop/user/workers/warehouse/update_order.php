<?php
$pol = new mysqli("localhost", "root", "", "teashop");
if($pol->connect_error)
    die("brak połączenia z bazą");

$zap = "UPDATE zamowienia SET idstatus = {$_POST["order_status"]} WHERE idzamowienie = {$_GET["oid"]}";
if($pol->query($zap) === TRUE)
    echo "<script>alert('Dokonano zmiany statusu zamówienia nr {$_GET['oid']}.'); window.location = 'warehouse.php';</script>";
else
    echo "<script>alert('Wystąpił błąd podczas aktualizacji danych.'); window.location = 'warehouse.php';</script>";

$pol->close();
?>