<?php
session_start();
$pol = new mysqli("localhost", "root", "", "teashop");
if ($pol->connect_error)
    die("brak połączenia z bazą");
    
$zap = "SELECT login, email, nr_telefonu FROM uzytkownicy WHERE iduzytkownik ='".$_SESSION["user"]."'";
$wynik = $pol->query($zap);
$wiersz = $wynik->fetch_assoc();
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
      var rid = <?php echo $_SESSION["user_rola"]; ?>;
      $(document).ready(function(){
          $("#workers").load("../../user_workers.php", {id: rid, xyz: "../../"});
          $("#reports").hide();

          $("#generate_report").click(function (){
              $("#report_result").empty();
              var r = $("#report").val();
              $("#report_result").load('report_generate.php', {report: r, date_from: $("#date_from").val(), date_to: $("#date_to").val()});
          });
      });

      function showButton(){
        $("#reports").empty();
        if($("#report").val() != -1) {
          $("#reports").show();

          if($("#report").val() == 1) {
            var data1 = "Od: <input type='date' id='date_from' required><br/><br/>";
            var data2 = "Do: <input type='date' id='date_to' required><br/><br/>";
            $("#reports").prepend("<h5>Przedział czasowy</h5>",data1, data2);
          }
        }
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
    .user {
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
    .user h2  {
      color: #333;
      font-weight: bold;
      margin-top: 0;
    }
    .user hr  {
      margin: 0 -30px 20px;
    }    
    .user .info {
      margin-bottom: 20px;
    }
   
    .user .btn {        
      font-size: 15px;
      min-width: 140px;
    }

    .user .hint-text  {
      padding-bottom: 15px;
      text-align: center;
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
</nav><br/>

<div id='reports_div' class="container" style="text-align: center;">
    <h4>Raporty</h4>
    <form action>
        <select id="report" onchange="showButton()">
            <option value='-1' selected>-- Wybierz raport --</option>
            <option value='1'>Raport sprzedaży na przestrzeni podanego czasu</option>
            <option value='2'>Ogólny raport sprzedaży</option>
            <option value='3'>Zarobek z produktów</option>
            <option value='4'>Najchętniej wybierane sposoby dostawy</option>
            <option value='5'>Najczęściej wybierane kategorie</option>
            <option value='6'>Nieokazyjni klienci</option>
            <option value='7'>Podział klientów ze względu na ilość zamówień</option>
            <option value='8'>Raport przybyłych zarejestrowanych klientów</option>
        </select>
    </form><br/>
    <div id='reports'></div>
    <div class="form" id="report_form">
        <button type="sumbit" class='btn btn-primary' id='generate_report'>Wygeneruj raport</button><br/><br/>
        <div id="report_result"></div>
    </div>
</div><br/>
<hr><br/>
      <br><br>


<footer class="container-fluid text-center">
  <p>&copy Patrycja Zajączkowska Bazy Danych 2022 </p>  
</footer>

</body>
</html>
