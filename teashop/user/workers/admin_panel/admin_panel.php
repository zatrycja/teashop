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
  var klik = false;
  var klik2 = false;
  var klik3 = false;
  var rid = <?php echo $_SESSION["user_rola"]; ?>;

        $(document).ready(function(){
            $("#workers").load("../../user_workers.php", {id: rid, xyz: "../../"});
            $("#update_role_form").hide();
            $("#add_payment_form").hide();
            $("#payment_delete_form").hide();


            $("#update_role").click(function (){
              klik = !klik;
              if(klik)
                $("#update_role_form").show();
              else
               $("#update_role_form").hide();
            });

            $("#add_payment").click(function (){
                  klik2 = !klik2;
                  if(klik2)
                  $("#add_payment_form").show();
                  else
                  $("#add_payment_form").hide();
                });

            $("#delete_payment").click(function (){

              klik3 = !klik3;
              if(klik3)
              $("#payment_delete_form").show();
              else
              $("#payment_delete_form").hide();
            });

        });

        function updateRole(){
            var iduser = $("#user").val();
            $("#update_role_form").load("update_role_form.php", {uid: iduser});               
        }

        function deletePayment(){
            var idpayment = $("#payment").val();
            $("#payment_delete_form").load("payment_delete_form.php", {pid: idpayment});               
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
  text-align:center;
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
<br/><br/>
   
<div class="container" style="text-align: center;">
    <h4>Role użytkowników</h4>
    <form>
        <select id="user" onchange="updateRole()">
            <option value='-1' style='text-align: center;' selected>-- Wybierz użytkownika --</option>
            <?php
                $zap = "SELECT CONCAT(u.imie, ' ', u.nazwisko) as name, u.login, u.iduzytkownik, r.nazwa as rola FROM uzytkownicy u INNER JOIN role r ON u.idrola = r.idrola WHERE u.login NOT REGEXP '^admin$' ORDER BY u.idrola DESC, u.nazwisko";
                $wynik = $pol->query($zap);
                if ($wynik->num_rows > 0)
                    while ($wiersz = $wynik->fetch_assoc()){
                        echo "<option value='{$wiersz["iduzytkownik"]}'>{$wiersz["rola"]} | {$wiersz["name"]} | login: {$wiersz["login"]} </option>";}
            ?>
        </select>
    </form><br/>
    <button type="submit" class="btn btn-primary" id="update_role">Zmień rolę użytkownika</button>
    <div class="form" id="update_role_form">
    </div>
</div><br/>
<hr><br/>

<div class="container" style="text-align: center;">
    <h4>Dodaj nowy sposób płatności</h4>
    <button class="btn btn-primary" id="add_payment">Dodaj płatność</button><br/>
        <div class="form" id="add_payment_form">
          <form action="payment_add.php" method="post">
              <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="Nazwa płatności" required="required">
              </div>
              <div class="form-group">
                      <button type="submit" class="btn btn-primary">Dodaj</button>
              </div>
          </form>
        </div>
        </div><br/><br/>

<hr>
<div class="container" style="text-align: center;">
    <h4>Zmień dostępność płatności</h4>
          <form >
              <div class="form-group">
                  <select id="payment" onchange="deletePayment()">
                    <option value='-1' selected>-- Wybierz płatność --</option>
                    <?php
                      $zap = "SELECT * FROM platnosci";
                      $wynik = $pol->query($zap);
                      if ($wynik->num_rows > 0)
                          while ($wiersz = $wynik->fetch_assoc())
                              echo "<option value='{$wiersz["idplatnosc"]}'>{$wiersz["nazwa"]}</option>";
                    ?>
                    </select> 
              </div>
            </form>
                  <button type="submit" class="btn btn-primary" id="delete_payment">Zmień płatność</button>
          <div class="form" id="payment_delete_form"></div>
    <hr>

    </div><br/><br/>

<footer class="container-fluid text-center">
  <p>&copy Patrycja Zajączkowska Bazy Danych 2022 </p>  
</footer>

</body>
</html>
