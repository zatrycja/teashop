<?php
session_start();
$pol = new mysqli("localhost", "root", "", "teashop");
if ($pol->connect_error)
    die("brak połączenia z bazą");
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
<script>
  var klik = false;
  var klik2 = false;
  var rid = <?php echo $_SESSION["user_rola"]; ?>;
        $(document).ready(function(){
            $("#workers").load("../../user_workers.php", {id: rid,  xyz: "../../"});
            changeQuantity();           
            $("#change_quantity_form").hide();
            $("#update_order_form").hide();

            $("#change_quantity").click(function (){
              klik = !klik;
              if(klik)
                $("#change_quantity_form").show();
              else
               $("#change_quantity_form").hide();
            });

            $("#update_order").click(function (){
              klik2 = !klik2;
              if(klik2)
                $("#update_order_form").show();
              else
               $("#update_order_form").hide();
            });

        });
        function changeQuantity(){
            var idprodukt = $("#product").val();
            $("#change_quantity_form").load("product_quantity_form.php", {pid: idprodukt});               
        }

        function updateOrder(){
            var idorder = $("#order").val();
            $("#update_order_form").load("update_order_form.php", {oid: idorder});               
        }
    </script>
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
    .form {
      min-width: 450px;
      max-width: 600px;
      margin: 30px auto;
      border-radius: 3px;
      margin-bottom: 15px;
      background: #f7f7f7;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      padding: 30px;
    }

    .info .row div:first-child {
	    padding-right: 10px;
    }
    .info .row div:last-child {
	    padding-left: 10px; 
    }
    .form h2  {
      color: #333;
      font-weight: bold;
      margin-top: 0;
    }
    .form hr  {
      margin: 0 -30px 20px;
    }    
    .form .info {
      margin-bottom: 20px;
    }
   
    .form .btn {        
      font-size: 15px;
      min-width: 140px;
    }

    .form .hint-text  {
      padding-bottom: 15px;
      text-align: center;
    }

    .form-group {
      text-align: center;
    }

    .form-group input{
      margin: 0px 0px 0px 0px;
    }

    .form-group label{
      margin: 0px 20px 0px 3px;
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
        <a class="nav-link" href="../../../index.html">Strona główna</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../../products/products.php">Produkty</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../../bestsellers/bestsellers.php">Bestsellery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../../contact.html">Kontakt</a>
      </li>
    </ul>
    <ul id="workers" class="navbar-nav mr-auto">
    </ul>
    <form class="form-inline my-2 my-lg-0">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="../../login/login.php"><i class="fa fa-user"></i> Twoje konto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../../cart/cart.php"><i class="fa fa-shopping-basket"></i> Koszyk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../../login/logout.php"><i class="fa fa-sign-out"></i> Wyloguj</a>
      </li>
    </form>
  </div>
</nav>
<br/>
<div class="container" style="text-align: center;">
    <h4>Zmień stan magazynowy produktu</h4>
    <form>
        <select id="product" onchange="changeQuantity()">
            <option value='-1' selected>-- Wybierz produkt --</option>
            <?php
                $zap = "SELECT idprodukt, nazwa, na_stanie FROM produkty ORDER BY na_stanie, nazwa";
                $wynik = $pol->query($zap);
                if ($wynik->num_rows > 0)
                    while ($wiersz = $wynik->fetch_assoc()){
                       $temp = ($wiersz["na_stanie"] == 0)? ' (brak)': '('.$wiersz["na_stanie"].')';
                        echo "<option value='{$wiersz["idprodukt"]}'>{$temp} | {$wiersz["nazwa"]} </option>";}
            ?>
        </select>
    </form><br/>
    <button type="submit" name="submit" class="btn btn-primary" id="change_quantity">Zmień stan magazynowy</button>
    <div class="form" id="change_quantity_form">
    </div>
</div><br/><hr><br/>
<div class="container" style="text-align: center;">
    <h4>Zmień stan przetwarzanego zamówienia</h4>
    <form>
        <select id="order" onchange="updateOrder()">
            <option value='-1' selected>-- Wybierz zamówienie --</option>
            <?php
                $zap = "SELECT DATE_FORMAT(z.data_zam, '%d-%m-%Y') as datka, z.idzamowienie, z.idstatus FROM zamowienia z WHERE z.idstatus != 4 ORDER BY z.data_zam";
                $wynik = $pol->query($zap);
                if ($wynik->num_rows > 0)
                    while ($wiersz = $wynik->fetch_assoc()){
                        echo "<option value='{$wiersz["idzamowienie"]}'>{$wiersz["datka"]} | nr: {$wiersz["idzamowienie"]} </option>";}
            ?>
        </select>
    </form><br/>
    <button type="submit" class="btn btn-primary" id="update_order">Zmień status zamówienia</button>
    <div class="form" id="update_order_form">
    </div>
</div><br/><br/>


<footer class="container-fluid text-center">
  <p>&copy Patrycja Zajączkowska Bazy Danych 2022 </p>  
</footer>

</body>
</html>
