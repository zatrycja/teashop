<?php
$pol = new mysqli("localhost", "root", "", "teashop");
if ($pol->connect_error)
    die("brak połączenia z bazą");

switch ($_POST["report"]) {
    case 1: { 
        if(!$_POST["date_from"] || !$_POST["date_to"])
        echo "
        <script>
        alert('Podaj przedział czasowy!');
        </script>
        ";
        else{
            $zap = "SELECT p.nazwa, SUM(zp.ilosc) AS ile 
                    FROM ((produkty p 
                        INNER JOIN zamowienia_produkty zp ON p.idprodukt = zp.idprodukt)
                        INNER JOIN zamowienia z ON z.idzamowienie = zp.idzamowienie) 
                    WHERE z.data_zam BETWEEN CAST('{$_POST["date_from"]}' AS DATE) AND CAST('{$_POST["date_to"]}' AS DATE) 
                    GROUP BY zp.idprodukt 
                    ORDER BY ile DESC, p.nazwa";
           
            if($wynik = $pol->query($zap))
                if ($wynik->num_rows > 0) {
                    $lp = 1;
                    echo "<table class='table table-striped'>
                    <thead>
                        <th scope='col'>Lp.</th>
                        <th scope='col'>Nazwa produktu</th>
                        <th scope='col'>Ilość [szt.]</th>
                    </thead>
                    <tbody>";
                    while ($wiersz = $wynik->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$lp}</td>";
                        echo "<td>{$wiersz["nazwa"]}</td>";
                        echo "<td>{$wiersz["ile"]}</td>";
                        echo "</tr>";
                        $lp++;
                    }
                    echo "</tbody></table>";
                }
                else
                    echo "<h5>Brak danych.</h5>";
        }
    }; break;
    case 2: {
        $zap = "SELECT DISTINCT 
                    p.idprodukt AS produkt,
                    p.nazwa,
                    IFNULL((SELECT SUM(zp.ilosc) FROM zamowienia_produkty zp 
                        WHERE zp.idprodukt = produkt group by zp.idprodukt), 0) as ogolnie, 
                    IFNULL((SELECT SUM(zp.ilosc) FROM zamowienia_produkty zp INNER JOIN zamowienia z ON zp.idzamowienie = z.idzamowienie 
                        WHERE zp.idprodukt = produkt AND DAY(z.data_zam) = DAY(CURDATE()) AND MONTH(z.data_zam) = MONTH(CURDATE()) AND YEAR(z.data_zam) = YEAR(CURDATE()) GROUP BY zp.idprodukt), 0) AS 'dzien',
                    IFNULL((SELECT SUM(zp.ilosc) FROM zamowienia_produkty zp INNER JOIN zamowienia z ON zp.idzamowienie = z.idzamowienie 
                        WHERE zp.idprodukt = produkt AND MONTH(z.data_zam) = MONTH(CURDATE()) AND YEAR(z.data_zam) = YEAR(CURDATE()) GROUP BY zp.idprodukt), 0) AS 'miesiac',
                    IFNULL((SELECT SUM(zp.ilosc) FROM zamowienia_produkty zp INNER JOIN zamowienia z ON zp.idzamowienie = z.idzamowienie 
                        WHERE zp.idprodukt = produkt AND YEAR(z.data_zam) = YEAR(CURDATE()) GROUP BY zp.idprodukt), 0) as 'rok'
                FROM produkty p 
                    LEFT JOIN zamowienia_produkty zp ON p.idprodukt = zp.idprodukt 
                ORDER BY ogolnie DESC, p.nazwa";

            if($wynik = $pol->query($zap))
                if ($wynik->num_rows > 0) {
                    $lp = 1;
                    echo "<table class='table table-striped'>
                    <thead>
                        <th scope='col'>Lp.</th>
                        <th scope='col'>Nazwa produktu</th>
                        <th scope='col'>Ogólnie [szt.]</th>
                        <th scope='col'>Dzisiaj [szt.]</th>
                        <th scope='col'>W tym miesiącu [szt.]</th>
                        <th scope='col'>W tym roku [szt.]</th>
                    </thead>
                    <tbody>";
                    while ($wiersz = $wynik->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$lp}</td>";
                        echo "<td>{$wiersz["nazwa"]}</td>";
                        echo "<td>{$wiersz["ogolnie"]}</td>";
                        echo "<td>{$wiersz["dzien"]}</td>";
                        echo "<td>{$wiersz["miesiac"]}</td>";
                        echo "<td>{$wiersz["rok"]}</td>";
                        echo "</tr>";
                        $lp++;
                    }
                    echo "</tbody></table>";
                }
    }; break;
    case 3: {
        $zap = "SELECT DISTINCT 
                    p.idprodukt AS produkt,
                    p.nazwa,
                    IFNULL((SELECT SUM(zp.ilosc) FROM zamowienia_produkty zp 
                        WHERE zp.idprodukt = produkt GROUP BY zp.idprodukt), 0) AS ilosc,
                    IFNULL((SELECT SUM(zp.ilosc * zp.cena_jednostkowa) AS dochod FROM zamowienia_produkty zp 
                        WHERE zp.idprodukt = produkt GROUP BY zp.idprodukt), 0.00) AS zarobek
                FROM produkty p 
                    LEFT JOIN zamowienia_produkty zp ON p.idprodukt = zp.idprodukt 
                ORDER BY zarobek DESC, ilosc DESC, p.nazwa";

        if($wynik = $pol->query($zap))
            if ($wynik->num_rows > 0) {
                $lp = 1;
                echo "<table class='table table-striped'>
                <thead>
                    <th scope='col'>Lp.</th>
                    <th scope='col'>Nazwa produktu</th>
                    <th scope='col'>Ilość [szt.]</th>
                    <th scope='col'>Zarobek [zł]</th>
                </thead>
                <tbody>";
                while ($wiersz = $wynik->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$lp}</td>";
                    echo "<td>{$wiersz["nazwa"]}</td>";
                    echo "<td>{$wiersz["ilosc"]}</td>";
                    echo "<td>{$wiersz["zarobek"]}</td>";
                    echo "</tr>";
                    $lp++;
                }
                echo "</tbody></table>";
            }
    }; break;
    case 4: {
        $zap = "SELECT 
                    d.nazwa, 
                    COUNT(z.iddostawa) AS ilosc 
                FROM dostawy d 
                    LEFT JOIN zamowienia z ON d.iddostawa = z.iddostawa 
                GROUP BY z.iddostawa 
                ORDER BY COUNT(z.iddostawa) DESC";

        if($wynik = $pol->query($zap))
            if ($wynik->num_rows > 0) {
                $lp = 1;
                echo "<table class='table table-striped'>
                <thead>
                    <th scope='col'>Lp.</th>
                    <th scope='col'>Nazwa dostawy</th>
                    <th scope='col'>Ilość [szt.]</th>
                </thead>
                <tbody>";
                while ($wiersz = $wynik->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$lp}</td>";
                    echo "<td>{$wiersz["nazwa"]}</td>";
                    echo "<td>{$wiersz["ilosc"]}</td>";
                    echo "</tr>";
                    $lp++;
                }
                echo "</tbody></table>";
        }
    }; break;
    
    case 5: {
        $zap0 = "CREATE TABLE temp (
                                    idkategoria integer(11),
                                    ile_sprzedanych integer(11)
                                    )";

        if($pol->query($zap0) === TRUE){
            $zap1 = "INSERT INTO temp(
                                    SELECT 
                                        kp.idkategoria, 
                                        SUM(zp.ilosc) 
                                    FROM zamowienia_produkty zp 
                                        RIGHT JOIN kategorie_produkty kp ON zp.idprodukt = kp.idprodukt GROUP BY kp.idkategoria
                                    )";

            if ($pol->query($zap1) === TRUE){
                $zap2 = "SELECT 
                            k.nazwa AS kategoria, 
                            (CASE
                                WHEN t.ile_sprzedanych IS NULL THEN 'niewybieralna'
                                WHEN (t.ile_sprzedanych / (SELECT SUM(zp.ilosc) FROM zamowienia_produkty zp)) < 0.25  THEN 'słabo wybieralna'
                                WHEN (t.ile_sprzedanych / (SELECT SUM(zp.ilosc) FROM zamowienia_produkty zp)) BETWEEN 0.25 AND 0.65 THEN 'średnio wybieralna'
                                ELSE 'mocno wybieralna' END
                            ) AS wybieralnosc
                        FROM kategorie k 
                            INNER JOIN temp t ON k.idkategoria = t.idkategoria ORDER BY k.nazwa";

                if($wynik = $pol->query($zap2)){
                    if ($wynik->num_rows > 0) {
                        $lp = 1;
                        echo "<table class='table table-striped'>
                        <thead>
                            <th scope='col'>Lp.</th>
                            <th scope='col'>Kategoria</th>
                            <th scope='col'>Wybieralność</th>
                        </thead>
                        <tbody>";
                        while ($wiersz = $wynik->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$lp}</td>";
                            echo "<td>{$wiersz["kategoria"]}</td>";
                            echo "<td>{$wiersz["wybieralnosc"]}</td>";
                            echo "</tr>";
                            $lp++;
                        }
                        echo "</tbody></table>";
                    $zap3 = "DROP TABLE temp";
                    if ($pol->query($zap3) === TRUE)
                        echo "";
                    }
                }
            }
        }
    }; break;

    case 6: {
        $zap = "SELECT 
                    u.login, 
                    CONCAT(u.imie, ' ', u.nazwisko) AS dane, 
                    COUNT(z.idzamowienie) AS ile 
                FROM uzytkownicy u 
                    INNER JOIN zamowienia z ON u.iduzytkownik = z.iduzytkownik 
                WHERE u.login NOT REGEXP '^admin$' 
                GROUP BY z.iduzytkownik HAVING COUNT(z.idzamowienie) > 1 
                ORDER BY ile DESC";

        if($wynik = $pol->query($zap))
            if ($wynik->num_rows > 0) {
                $lp = 1;
                echo "<table class='table table-striped'>
                <thead>
                    <th scope='col'>Lp.</th>
                    <th scope='col'>Login</th>
                    <th scope='col'>Imię i nazwisko</th>
                    <th scope='col'>Zamówienia</th>
                </thead>
                <tbody>";
                while ($wiersz = $wynik->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$lp}</td>";
                    echo "<td>{$wiersz["login"]}</td>";
                    echo "<td>{$wiersz["dane"]}</td>";
                    echo "<td>{$wiersz["ile"]}</td>";
                    echo "</tr>";
                    $lp++;
                }
                echo "</tbody></table>";
        }
    }; break;

    case 7: {
        $zap = "SELECT
                    u.login, 
                    CONCAT(u.imie, ' ', u.nazwisko) AS dane,
                    COUNT(z.idzamowienie) AS ile,
                    (CASE
                        WHEN COUNT(z.idzamowienie) < 2 THEN 'nowy klient'
                        WHEN COUNT(z.idzamowienie) BETWEEN 2 AND 5 THEN 'mało kupujący'
                        WHEN COUNT(z.idzamowienie) BETWEEN 6 AND 10 THEN 'średnio kupujący'
                        WHEN COUNT(z.idzamowienie) BETWEEN 11 AND 20 THEN 'stały klient'
                        ELSE 'najwierniejszy klient' END
                    ) AS stopien_wtajemniczenia
                FROM uzytkownicy u 
                    LEFT JOIN zamowienia z ON u.iduzytkownik = z.iduzytkownik 
                WHERE u.login NOT REGEXP '^admin$' 
                GROUP BY u.iduzytkownik 
                ORDER BY ile DESC, u.login";

        if($wynik = $pol->query($zap))
            if ($wynik->num_rows > 0) {
                $lp = 1;
                echo "<table class='table table-striped'>
                <thead>
                    <th scope='col'>Lp.</th>
                    <th scope='col'>Login</th>
                    <th scope='col'>Imię i nazwisko</th>
                    <th scope='col'>Stopień wtajemniczenia</th>
                </thead>
                <tbody>";
                while ($wiersz = $wynik->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$lp}</td>";
                    echo "<td>{$wiersz["login"]}</td>";
                    echo "<td>{$wiersz["dane"]}</td>";
                    echo "<td>{$wiersz["stopien_wtajemniczenia"]}</td>";
                    echo "</tr>";
                    $lp++;
                }
                echo "</tbody></table>";
        }
    }; break;

    case 8: {
        $zap = "SELECT
                    (SELECT COUNT(iduzytkownik) FROM uzytkownicy 
                        WHERE idrola = 1) AS ogolnie, 
                    (SELECT COUNT(iduzytkownik) FROM uzytkownicy 
                        WHERE idrola = 1 AND DAY(data_rejestracji) = DAY(CURDATE()) AND MONTH(data_rejestracji) = MONTH(CURDATE()) 
                            AND YEAR(data_rejestracji) = YEAR(CURDATE())) AS dzien,
                    (SELECT COUNT(iduzytkownik) FROM uzytkownicy 
                        WHERE idrola = 1 AND MONTH(data_rejestracji) = MONTH(CURDATE()) AND YEAR(data_rejestracji) = YEAR(CURDATE())) AS miesiac,
                    (SELECT COUNT(iduzytkownik) FROM uzytkownicy 
                        WHERE idrola = 1 AND YEAR(data_rejestracji) = YEAR(CURDATE())) AS rok";

        if($wynik = $pol->query($zap))
            if ($wynik->num_rows > 0) {
                echo "<table class='table table-striped'>
                <thead>
                    <th scope='col'>Ogólnie</th>
                    <th scope='col'>Dzisiaj</th>
                    <th scope='col'>W tym miesiącu</th>
                    <th scope='col'>W tym roku</th>
                </thead>
                <tbody>";
                while ($wiersz = $wynik->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$wiersz["ogolnie"]}</td>";
                    echo "<td>{$wiersz["dzien"]}</td>";
                    echo "<td>{$wiersz["miesiac"]}</td>";
                    echo "<td>{$wiersz["rok"]}</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
        }
    }; break;
}
$pol -> close();
?>