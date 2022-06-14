<?php
    $pol = new mysqli("localhost", "root", "", "teashop");
    if ($pol->connect_error)
        die("brak połączenia z bazą");
    $zap = "SELECT cena FROM produkty WHERE idprodukt = {$_POST["pid"]} AND czy_dostepny = 1";
    $wynik = $pol->query($zap);
    if ($wynik->num_rows > 0) 
        while ($wiersz = $wynik->fetch_assoc()){
            $insert = "INSERT INTO zamowienia_produkty VALUES ({$_POST["oid"]}, {$_POST["pid"]}, {$wiersz["cena"]}, {$_POST["quantity"]})";
            $pol->query($insert);
            $update = "UPDATE produkty SET na_stanie = (na_stanie - {$_POST["quantity"]}), czy_dostepny = if((na_stanie - {$_POST["quantity"]}) > 0, 1, 0) WHERE idprodukt =  {$_POST["pid"]}";
            $pol->query($update);
        }
?>