
<?php
if($_POST["pid"] != -1){
    $pol = new mysqli("localhost", "root", "", "teashop");
    if ($pol->connect_error)
        die("brak połączenia z bazą");

    $zap = "SELECT na_stanie FROM produkty WHERE idprodukt={$_POST["pid"]}";
    $wynik = $pol->query($zap);
    $info = $wynik->fetch_assoc();
    echo"
        <form action='product_quantity.php?pid={$_POST["pid"]}' method='post'>
            <div class='form-group'>
                <span>Ilość na stanie:</span>
                <input type='number' class='form-control' name='quantity' value='{$info["na_stanie"]}' min='0' required='required'>
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
                    <span>Ilość na stanie:</span>
                    <input type='number' class='form-control' name='quantity' placeholder='Wybierz produkt' min='0' disabled>
                </div>
                <div class='form-group'>
                    <button class='btn btn-primary' disabled>Zatwierdź</button>
                </div>
            </form>
            ";
?>