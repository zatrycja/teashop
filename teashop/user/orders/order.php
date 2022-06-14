<?php
    session_start();
    if (!isset($_SESSION["user_rola"]))
        echo "<script>window.location = '../login/login.php';</script>";
    $pol = new mysqli("localhost", "root", "", "teashop");
    if ($pol->connect_error)
        die("brak połączenia z bazą");
        
    $zap = "SELECT login, email, nr_telefonu FROM uzytkownicy WHERE iduzytkownik ='".$_SESSION["user"]."'";
    $wynik = $pol->query($zap);
    $user = $wynik->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="PL-pl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Zamówienie</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> 
<script>
    function changeTotal(price){
      let total = parseFloat(<?php echo $_SESSION["total_price"];?>) + parseFloat(price);
      $("strong").html(total.toFixed(2));
    };
</script>
<style>
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
<div class="user" id="change_data">
    <form action="order_add.php?" method="post">
      <h2>Zamówienie</h2>
      <hr>
        <h4>Dane adresowe</h4>
        <div class="form-group">
              <input type="text" class="form-control" name="street" placeholder="Ulica" required="required">
        </div>
        <div class="form-group">
              <input type="text" class="form-control" name="number" placeholder="Nr budynku" required="required">
        </div> 
        <div class="form-group">
              <input type="text" class="form-control" name="additional" placeholder="Nr lokalu">
        </div>    
        <div class="form-group">
              <input type="text" class="form-control" name="post_code" placeholder="Kod pocztowy" required="required">
        </div>
        <div class="form-group">
              <input type="text" class="form-control" name="city" placeholder="Miasto" required="required">
        </div>    
        <hr>
        <h4>Sposób dostawy</h4>
          <?php
            $zap = "SELECT * FROM dostawy";
            $wynik = $pol->query($zap);
            if ($wynik->num_rows > 0)
            while ($delivery = $wynik->fetch_assoc()){
              $temp = ($delivery["szacowany_czas"] == 1)? 'dzień' : 'dni';
              echo "<p><input type='radio' name='delivery' value='{$delivery["iddostawa"]}' onclick='changeTotal({$delivery["cena"]})' required='required'> {$delivery["nazwa"]} <small>+-{$delivery["szacowany_czas"]} {$temp}</small> <span id='delivery_price' value='{$delivery["cena"]}'>{$delivery["cena"]}</span>zł</p>"; 
            }
          ?>
        <hr>
        <h4>Metoda płatności</h4>
        <?php
            $zap = "SELECT * FROM platnosci where czy_dostepny = 1";
            $wynik = $pol->query($zap);
            if ($wynik->num_rows > 0)
            while ($payment = $wynik->fetch_assoc())
              echo "<p><input type='radio' name='payment' value='{$payment["idplatnosc"]}' required='required'> {$payment["nazwa"]}</p>"; 
            
          ?>
          <hr>
        <p>Łącznie: <strong><?php echo number_format($_SESSION["total_price"], 2);?></strong> zł</p>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg">Złóź zamówienie</button><br/>
            <a href='../../cart/cart.php'>Wróć do koszyka</a>
        </div>
      </form>
</div><br><br>
</body>
</html>
<?php
  $pol->close();
?>