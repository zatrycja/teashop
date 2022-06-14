<?php
    $pol = new mysqli("localhost","root","","teashop");
    if ($pol->connect_error)
        die("brak połączenia z bazą");

    $state = $_POST["is_avaliable"];
    if($_POST["quantity"] == 0)
        $state = 0;
 
    $zap = "UPDATE produkty SET nazwa = '".$_POST["name"]."', opis = '".$_POST["description"]."', cena = '".$_POST["price"]."', na_stanie = '".$_POST["quantity"]."', czy_dostepny = {$state} WHERE idprodukt = '".$_GET["pid"]."'";
    
    if ($pol->query($zap) === TRUE){
        $zap = "DELETE FROM kategorie_produkty WHERE idprodukt = {$_GET["pid"]}";
        $pol->query($zap);
        if (!empty($_POST["categories"]))
                foreach($_POST["categories"] as $cat){
                    $zap = "INSERT INTO kategorie_produkty VALUES({$_GET["pid"]}, {$cat})";
                    $pol->query($zap);
                }
        echo "<script> alert('Zmodyfikowano produkt.'); window.location = 'product_manage.php'; </script>";
    }
    else
        echo "<script> alert('Nastąpił błąd podczas modyfikacji produktu.'); window.location = 'product_manage.php'; </script>";
    $pol->close();
?>