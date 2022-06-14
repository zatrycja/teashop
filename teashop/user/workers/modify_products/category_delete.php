<?php
    $pol = new mysqli("localhost","root","","teashop");
    if ($pol->connect_error)
    die("brak połączenia z bazą");
    $zap = "DELETE FROM kategorie_produkty WHERE idkategoria = {$_POST["category"]}";
            
    if ($pol->query($zap) === TRUE){
        $zap = "DELETE FROM kategorie WHERE idkategoria = {$_POST["category"]}";
        if ($pol->query($zap) === TRUE)
            echo "<script>alert('Pomyślnie usunięto kategorię.'); window.location = 'product_manage.php';</script>";
    }
    
    else
        echo "<script>alert('Wystąpił błąd podczas usuwania kategorii.'); window.location = 'product_manage.php';</script>";

$pol->close();
?>