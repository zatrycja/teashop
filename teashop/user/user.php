<?php
session_start();
$pol = new mysqli("localhost", "root", "", "teashop");
if ($pol->connect_error)
    die("brak połączenia z bazą");
    
$zap = "SELECT login, email, nr_telefonu, imie, nazwisko FROM uzytkownicy WHERE iduzytkownik ='".$_SESSION["user"]."'";
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
  var klik = false;
  var rid = <?php echo $_SESSION["user_rola"]; ?>;
        $(document).ready(function(){
            $("#workers").load("user_workers.php", {id: rid, xyz: ""});
            $("#change_data").hide();
            $("#change").click(function (){
              klik = !klik;
              if(klik)
              $("#change_data").show();
              else
              $("#change_data").hide();
              
            });
        });
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
        <a class="nav-link" href="../index.html">Strona główna</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../products/products.php">Produkty</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../bestsellers/bestsellers.php">Bestsellery</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../contact.html">Kontakt</a>
      </li>
    </ul>
    <ul id="workers" class="navbar-nav mr-auto">
    </ul>
    <form class="form-inline my-2 my-lg-0">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../user/login/login.php"><i class="fa fa-user"></i> Twoje konto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../cart/cart.php"><i class="fa fa-shopping-basket"></i> Koszyk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../user/login/logout.php"><i class="fa fa-sign-out"></i> Wyloguj</a>
      </li>
    </form>
  </div>
</nav>

<div class="user">
      <h2>Informacje o użytkowniku</h2>
      <hr>
      <div class="info">
        <div class="row">
          <div class="col"><p>Imię: </p></div>
          <div class="col"><p><?php echo $wiersz["imie"]; ?></p></div>
        </div>
      </div>   
      <div class="info">
        <div class="row">
          <div class="col"><p>Nazwisko: </p></div>
          <div class="col"><p><?php echo $wiersz["nazwisko"]; ?></p></div>
        </div>
      </div>   
      <div class="info">
        <div class="row">
          <div class="col"><p>Login: </p></div>
          <div class="col"><p><?php echo $wiersz["login"]; ?></p></div>
        </div>
      </div>        
      <div class="info">
        <div class="row">
          <div class="col"><p>Nr telefonu: </p></div>
          <div class="col"><p><?php if($wiersz["nr_telefonu"] == null) echo"-"; else echo $wiersz["nr_telefonu"]; ?></p></div>
        </div>
      </div>   	
      <div class="info">
        <div class="row">
          <div class="col"><p>Adres email: </p></div>
          <div class="col"><p><?php echo $wiersz["email"]; ?></p></div>
        </div>
      </div>
      <div class="info">
        <button type="submit" class="btn btn-primary btn-lg" id="change">Zmień dane</button>
      </div>
	</div>

  <div class="user" id="change_data">
    <form action="update_user.php?source=user.php&uid=<?php echo $_SESSION["user"];?>" method="post">
      <p>Wypełnij pola, które chcesz zmienić</p>
      <hr>
        <div class="form-group">
            <input type="text" class="form-control" name="login" placeholder="Nowy login">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="nrtelefonu" placeholder="Nowy nr telefonu">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Nowy email">
        </div>
        <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Nowe hasło">
        </div>
        <div class="form-group">
              <input type="password" class="form-control" name="confirm_password" placeholder="Potwierdź hasło">
        </div>        
        <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg">Zatwierdź</button>
        </div>
      </form>
	</div><br><br>

  <div class="container-fluid text-center">
    <hr/><br/>
  <h2>Historia zamówień</h2></sbr/>
        <?php
        $pol = new mysqli("localhost", "root", "","teashop");
        if ($pol->connect_error)
            die("brak połączenia z bazą");

       $zap = " SELECT z.idzamowienie, DATE_FORMAT(z.data_zam, '%d-%m-%Y') as data_zam, z.wartosc_calkowita, s.nazwa from zamowienia z inner join statusy s on z.idstatus = s.idstatus where z.iduzytkownik = '{$_SESSION["user"]}' ORDER BY data_zam DESC, z.idzamowienie DESC";
        if($wynik = $pol->query($zap))
        if ($wynik->num_rows > 0) {
            echo "<table class='table table-striped'>
              <thead>
                <th scope='col'>Nr zamówienia</th>
                <th scope='col'>Data</th>
                <th scope='col'>Wartość</th>
                <th scope='col'>Status</th>
              </thead>
              <tbody>";
            while ($wiersz = $wynik->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='orders/order_details.php?oid={$wiersz["idzamowienie"]}'>".$wiersz["idzamowienie"].".<a/></td>";
                echo "<td>".$wiersz["data_zam"]."</td>";
                echo "<td>".$wiersz["wartosc_calkowita"]." zł</td>";
                echo "<td>".$wiersz["nazwa"]."</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        }
      else
        echo "<p>Brak zamówień do wyświetlenia.";
        $pol->close();
        ?>
      </div>
      <br><br>


<footer class="container-fluid text-center">
  <p>&copy Patrycja Zajączkowska Bazy Danych 2022 </p>  
</footer>

</body>
</html>
