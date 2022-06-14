<div class="container-fluid">
<?php
$pol = new mysqli("localhost", "root", "", "teashop");
if ($pol->connect_error)
    die("brak połączenia z bazą");

  switch($_GET["type"]){
    case 1: 
      $zap = "SELECT idprodukt as produkt, nazwa, cena FROM produkty WHERE czy_dostepny = 1 ORDER BY nazwa"; break;
    case 2:
      $zap = "SELECT idprodukt as produkt, nazwa, cena FROM produkty WHERE czy_dostepny = 1 ORDER BY nazwa DESC"; break;
    case 3: 
      $zap = "SELECT idprodukt as produkt, nazwa, cena FROM produkty WHERE czy_dostepny = 1 ORDER BY cena"; break;
    case 4:
      $zap = "SELECT idprodukt as produkt, nazwa, cena FROM produkty WHERE czy_dostepny = 1 ORDER BY cena DESC"; break;
    case 5:
      $zap = "SELECT p.idprodukt as produkt, p.nazwa, p.cena, ifnull((select sum(zp.ilosc) from zamowienia_produkty zp where zp.idprodukt = produkt group by zp.idprodukt), 0) as ile FROM produkty p LEFT JOIN zamowienia_produkty zp ON p.idprodukt = zp.idprodukt WHERE czy_dostepny = 1 GROUP BY p.idprodukt ORDER BY ile DESC"; break;

      // ifnull((select sum(zp.ilosc) from zamowienia_produkty zp where zp.idprodukt = produkt group by zp.idprodukt), 0) as ilosc
  }
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
                        <h4><a href='product_site.php?pid={$wiersz["produkt"]}' name='name'>{$wiersz["nazwa"]}</a></h4>
                        <span class='price lblue'>{$wiersz["cena"]}zł</span>
                      </div>
                      <div class='ecom bg-lblue'>
                        <a class='btn' onclick='onAdd({$wiersz["produkt"]}, {$quantity})' id='add_product'>Dodaj do koszyka</a>
                      </div>
                    </div>
                </div>
              ";
            
      }
      echo "</div>";
    }
?>
        