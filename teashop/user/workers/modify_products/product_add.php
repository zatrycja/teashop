<?php
    $pol = new mysqli("localhost","root","","teashop");
    if ($pol->connect_error)
    die("brak połączenia z bazą");
    $state = $_POST["is_avaliable"];
    if($_POST["quantity"] == 0)
        $state = 0;
        
    $zap = "INSERT INTO produkty VALUES (0, '".$_POST["name"]."', '".$_POST["description"]."','".$_POST["price"]."', '".$_POST["quantity"]."', '".$state."')";
            
    if ($pol->query($zap) === TRUE){
            $zap = "SELECT idprodukt FROM produkty ORDER BY idprodukt DESC";
            $wynik = $pol->query($zap);
            // $wiersz = mysql_fetch_array($wynik);
            $wiersz = $wynik->fetch_assoc();
            $pid = $wiersz["idprodukt"];
            if (!empty($_POST["categories"]))
                foreach($_POST["categories"] as $cat){
                    $zap = "INSERT INTO kategorie_produkty VALUES(".$pid.", ".$cat.")";
                    $pol->query($zap);
                }
            
            echo "<script>alert('Pomyślnie dodano produkt.'); window.location = 'product_manage.php';</script>";
    }
    else
        echo "<script>alert('Wystąpił błąd podczas dodawania nowego produktu.'); window.location = 'product_manage.php';</script>";

$pol->close();
?>