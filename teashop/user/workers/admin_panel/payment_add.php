<?php
    $pol = new mysqli("localhost","root","","teashop");
    if ($pol->connect_error)
    die("brak połączenia z bazą");
    $zap = "INSERT INTO platnosci VALUES (0, '".$_POST["name"]."', 1)";
            
    if ($pol->query($zap) === TRUE)
        echo "<script>alert('Pomyślnie dodano płatność.'); window.location = 'admin_panel.php';</script>";
    
    else
        echo "<script>alert('Wystąpił błąd podczas dodawania płatności.'); window.location = 'admin_panel.php';</script>";

$pol->close();
?>