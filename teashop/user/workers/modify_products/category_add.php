<?php
    $pol = new mysqli("localhost","root","","teashop");
    if ($pol->connect_error)
    die("brak połączenia z bazą");
    $zap = "INSERT INTO kategorie VALUES (0, '".$_POST["name"]."')";
            
    if ($pol->query($zap) === TRUE)
        echo "<script>alert('Pomyślnie dodano kategorię.'); window.location = 'product_manage.php';</script>";
    
    else
        echo "<script>alert('Wystąpił błąd podczas dodawania kategorii.'); window.location = 'product_manage.php';</script>";

$pol->close();
?>