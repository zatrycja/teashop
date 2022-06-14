<?php
    session_start();
    $pol = new mysqli("localhost", "root", "", "teashop");
    if ($pol->connect_error)
        die("brak połączenia z bazą");
        
    $zap = "SELECT z.idzamowienie, DATE_FORMAT(z.data_zam, '%d-%m-%Y') as 'data', s.nazwa as 'status', d.nazwa as 'dostawca', d.cena as 'dostawa_cena', p.nazwa as 'platnosc',
             z.wartosc_calkowita, z.adres_kod, z.adres_miasto, z.adres_ulica, concat(z.adres_nr, ' ',z.adres_lokal) as 'budynek' FROM (((dostawy d INNER JOIN zamowienia z ON z.iddostawa = d.iddostawa) 
             INNER JOIN platnosci p ON z.idplatnosc = p.idplatnosc) INNER JOIN statusy s ON z.idstatus = s.idstatus) WHERE z.iduzytkownik = {$_SESSION["user"]} 
             AND z.idzamowienie ={$_GET["oid"]}";
    $wynik = $pol->query($zap);
    $wiersz = $wynik->fetch_assoc();

    $adres1 = 'ul.' .$wiersz["adres_ulica"].' '.$wiersz["budynek"];
    $adres2 = $wiersz["adres_kod"].', '.$wiersz["adres_miasto"];

?>
<!DOCTYPE html>
<html lang="PL-pl">
<head>
  <title>Herbaciany Zakątek</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> 
  <style>

/* Remove the jumbotron's default bottom margin */ 
 .jumbotron {
  margin-bottom: 0;
}

/* Add a gray background color and some padding to the footer */
footer {
  background-color: #f2f2f2;
  padding: 25px;
}

.form-control, .btn {        
  border-radius: 3px;
}
      </style>
  </head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Herbaciany Zakątek</h1>      
    <p>najlepsza herbata online</p>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../../index.html">Strona główna</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../products/products.php">Produkty</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../bestsellers/bestsellers.php">Bestsellery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../contact.html">Kontakt</a>
      </li>
    </ul>
    <ul id="workers" class="navbar-nav mr-auto">
    </ul>
    <form class="form-inline my-2 my-lg-0">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../login/login.php"><i class="fa fa-user"></i> Twoje konto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../cart/cart.php"><i class="fa fa-shopping-basket"></i> Koszyk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../login/logout.php"><i class="fa fa-sign-out"></i> Wyloguj</a>
      </li>
    </form>
  </div>
</nav>

    <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-10 col-xl-8">
        <div class="card" style="border-radius: 10px;">
          <div class="card-header px-4 py-5">
            <h5 class="text-muted mb-0">Szczegóły zamówienia</h5>
          </div>
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0">Produkty</p>
              <p class="small text-muted mb-0">Nr zamówienia : <?php echo $wiersz["idzamowienie"]; ?></p>
            </div>
            <?php
                $zap = "SELECT zp.idprodukt, p.nazwa, zp.cena_jednostkowa, zp.ilosc FROM zamowienia_produkty zp INNER JOIN produkty p ON zp.idprodukt = p.idprodukt WHERE zp.idzamowienie = {$_GET["oid"]} ";
                $wynik = $pol->query($zap);
                if ($wynik->num_rows > 0) 
                    while ($produkt = $wynik->fetch_assoc())
                        echo "
                            <div class='card shadow-0 border mb-4'>
                            <div class='card-body'>
                                <div class='row'>
                                
                                <div class='col-md-4 text-center d-flex justify-content-center align-items-center'>
                                    <a href='../../products/product_site.php?pid={$produkt["idprodukt"]}' class='text-muted mb-0'>{$produkt["nazwa"]}</a>
                                </div>
                                <div class='col-md-4 text-center d-flex justify-content-center align-items-center'>
                                    <p class='text-muted mb-0 small'>Ilość: {$produkt["ilosc"]}</p>
                                </div>
                                <div class='col-md-4 text-center d-flex justify-content-center align-items-center'>
                                    <p class='text-muted mb-0 small'>{$produkt["cena_jednostkowa"]} zł/szt.</p>
                                </div>
                                </div>
                            </div>
                            </div>
                            ";
            ?>

            <div class="d-flex justify-content-between pt-2">
              <p class="fw-bold mb-0">Szczegóły:</p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Łącznie:</span> <?php echo number_format($wiersz["wartosc_calkowita"] - $wiersz["dostawa_cena"], 2); ?>zł</p>
            </div>

            <div class="d-flex justify-content-between pt-2">
              <p class="text-muted mb-0">Dane adresowe:</p>
              <p class="text-muted mb-0">Metoda płatności:</p>
            </div>

            <div class="d-flex justify-content-between">
              <p class="text-muted mb-0"><?php echo $adres1, ', ', $adres2; ?></p>
              <p class="text-muted mb-0"><?php echo $wiersz["platnosc"]; ?></p>
            </div>

            <div class="d-flex justify-content-between mb-5">
              <p class="text-muted mb-0">Dostawa : <?php echo $wiersz["dostawca"]; ?></p>
              <p class="text-muted mb-0"><span class="fw-bold me-4">Koszt wysyłki: </span><?php echo number_format($wiersz["dostawa_cena"], 2); ?> zł</p>
            </div>
          </div>
          <div class="card-footer border-1 px-4 py-5"
            style="border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
            <h5 class="d-flex align-items-center justify-content-end text-uppercase mb-0">Całkowity koszt: <?php echo number_format($wiersz["wartosc_calkowita"], 2); ?> zł</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
  <p class="text-center"><a href="../user.php">Powrót</a></p>
    <br/><br/>

<footer class="container-fluid text-center">
  <p>&copy Patrycja Zajączkowska Bazy Danych 2022 </p>  
</footer>

</body>
</html>