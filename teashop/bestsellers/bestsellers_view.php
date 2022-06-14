<div class="container-fluid">
<?php
$pol = new mysqli("localhost", "root", "", "teashop");
if ($pol->connect_error)
    die("brak połączenia z bazą");

$zap = "SELECT p.idprodukt, p.nazwa, p.cena FROM produkty p INNER JOIN zamowienia_produkty zp ON zp.idprodukt = p.idprodukt WHERE p.czy_dostepny = 1 GROUP BY p.idprodukt ORDER BY SUM(zp.ilosc) desc limit 10";
$wynik = $pol->query($zap);
$licznik = 1;
$quantity = 1;
if ($wynik->num_rows > 0){
  echo "<div class='row'>";
    while ($wiersz = $wynik->fetch_assoc()){
            echo "
                <div class='col-md-3 col-sm-6'>
                  <div class='item'>
                    <img class='img-responsive' src='http://www.eskleplewiatan.pl/zdjecia/3793_1.jpg' alt='herbatka saga największe ścierwo'>
                    <div class='item-dtls'>
                      <h4><a href='../products/product_site.php?pid={$wiersz["idprodukt"]}' name='name'>{$wiersz["nazwa"]}</a></h4>
                      <span class='price lblue'>{$wiersz["cena"]}zł</span>
                    </div>
                    <div class='ecom bg-lblue'>
                      <a class='btn' onclick='onAdd({$wiersz["idprodukt"]}, {$quantity})' id='add_product'>Dodaj do koszyka</a>
                    </div>
                  </div>
              </div>
            ";
          
    }
    echo "</div>";
  }
?>
        