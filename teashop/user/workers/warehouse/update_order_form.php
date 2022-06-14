<?php
if($_POST["oid"] != -1){
    $pol = new mysqli("localhost", "root", "", "teashop");
    if ($pol->connect_error)
        die("brak połączenia z bazą");

    $zap = "SELECT z.idstatus, s.nazwa FROM zamowienia z INNER JOIN statusy s ON s.idstatus = z.idstatus WHERE z.idzamowienie={$_POST["oid"]}";
    $wynik = $pol->query($zap);
    $info = $wynik->fetch_assoc();
    echo"
        <form action='update_order.php?oid={$_POST["oid"]}' method='post'>
            <div class='form-group'>
                <span>Stan zamówienia nr:{$_POST["oid"]}</span>
                <select name='order_status'>";
                    $zap = "SELECT idstatus, nazwa FROM statusy";
                    $wynik = $pol->query($zap);
                    if ($wynik->num_rows > 0)
                        while ($wiersz = $wynik->fetch_assoc()){
                            $temp = ($wiersz['idstatus'] == $info["idstatus"])? 'selected': '';
                            echo "<option value='{$wiersz["idstatus"]}' {$temp}>{$wiersz["nazwa"]}</option>";}
            echo " </select>
            </div>
            <div class='form-group'>
                <button type='submit' class='btn btn-primary'>Zatwierdź</button>
            </div>
        </form>
    ";
    $pol->close();
    }
    else
        echo"
            <form>
                <div class='form-group'>
                    <span>Stan zamówienia nr:{$_POST["oid"]}</span>
                    <select name='order_status'>
                        <option>Wybierz nr zamówienia</option>
                    </select>
                </div>
                <div class='form-group'>
                    <button class='btn btn-primary' disabled>Zatwierdź</button>
                </div>
            </form>
            ";
?>