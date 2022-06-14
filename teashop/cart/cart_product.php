<?php
    $pol = new mysqli("localhost", "root", "", "teashop");
    if ($pol->connect_error)
      die("brak połączenia z bazą");

      
    $zap = "SELECT idprodukt, nazwa, cena, na_stanie FROM produkty WHERE idprodukt = {$_POST["pid"]} AND czy_dostepny = 1";
    $wynik = $pol->query($zap);
    if ($wynik->num_rows > 0){
        $wiersz = $wynik->fetch_assoc();
        $quantity = min($_POST["qu"], $wiersz["na_stanie"], 9);
        $maxq = min(9, $wiersz["na_stanie"]);
        echo "
            <td class='p-4'>
                <div class='media align-items-center'>
                    <div class='media-body'>
                    <a href='../products/product_site.php?pid={$wiersz["idprodukt"]}' class='d-block text-dark'>{$wiersz["nazwa"]}</a>
                    </div>
                </div>
                </td>
                <td class='text-right font-weight-semibold align-middle p-4'>{$wiersz["cena"]}</td>
                <td class='align-middle p-4' data-product='{$wiersz["idprodukt"]}'><input type='number' min='1' max='{$maxq}' class='form-control' value='{$quantity}'></td>
                <td class='text-right font-weight-semibold align-middle p-4'>".number_format($quantity * $wiersz["cena"], 2)."</td>
                <td class='text-center align-middle px-0'>
                    <form action='cart_delete_product.php?pid={$wiersz["idprodukt"]}' method='post'>
                        <button id='delete' type='submit' class='shop-tooltip close float-none text-danger'>×</button>
                    </form>
                </td>";
                    session_start();
                    $_SESSION["total_price"] += $quantity * $wiersz["cena"];
                    $pol->close();
                }
    ?>


