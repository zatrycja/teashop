<?php
     $pol = new mysqli("localhost", "root", "", "teashop");
     if ($pol->connect_error)
         die("brak połączenia z bazą");
    session_start();
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
    $(document).ready(function(){
      var rid = <?php echo $_SESSION["user_rola"]; ?>;
      $("#workers").load("../../user_workers.php", {id: rid, xyz: "../../"});
      var klikaddpr = false;
      var klikaddcat = false;
      var klikdelcat = false;
                $("#add_product_form").hide();
                $("#add_category_form").hide();
                $("#modify_product_form").hide();
                $("#delete_category_form").hide();
                
                $("#modify_product").click(function (){
                  var idprodukt = $("#product").val();
                  if(idprodukt != -1){
                    $("#modify_product_form").show();
                    $("#modify_product_form").load("product_modify_form.php", {pid: idprodukt});
                  }
                });
                
                $("#add_product").click(function (){
                  klikaddpr = !klikaddpr;
                  if(klikaddpr)
                  $("#add_product_form").show();
                  else
                  $("#add_product_form").hide();
                  
                });
                $("#add_category").click(function (){
                  klikaddcat = !klikaddcat;
                  if(klikaddcat)
                  $("#add_category_form").show();
                  else
                  $("#add_category_form").hide();
                });
                $("#delete_category").click(function (){
                  klikdelcat = !klikdelcat;
                  if(klikdelcat)
                  $("#delete_category_form").show();
                  else
                  $("#delete_category_form").hide();
                });
              });
              function select(){
                var idprodukt = $("#product").val();
                $("#modify_product_form").load("product_modify_form.php", {pid: idprodukt});               
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
        <a class="nav-link" href="../../login/login.php"><i class="fa fa-form"></i> Twoje konto</a>
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

<div class="container" style="text-align: center;">
    <br/><br/>
        <h4>Dodaj nową kategorię</h4>
        <button class="btn btn-primary" id="add_category">Dodaj kategorię</button><br/>
        <div class="form" id="add_category_form">
          <form action="category_add.php" method="post">
              <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="Nazwa kategorii" required="required">
              </div>
              <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg">Dodaj</button>
              </div>
          </form>
        </div>

    <hr>
    <h4>Usuń istniejącą kategorię</h4>
    <button class="btn btn-primary" id="delete_category">Usuń kategorię</button><br/>
        <div class="form" id="delete_category_form">
          <form action="category_delete.php" method="post">
              <div class="form-group">
                  <select name="category">
                    <?php
                      $zap = "SELECT * FROM kategorie";
                      $wynik = $pol->query($zap);
                      if ($wynik->num_rows > 0)
                          while ($wiersz = $wynik->fetch_assoc())
                              echo "<option value='{$wiersz["idkategoria"]}'>{$wiersz["nazwa"]}</option>";
                    ?>
                    </select> 
              </div>
              <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg">Usuń</button>
              </div>
          </form>
        </div>

    <hr>
    <h4>Dodaj nowy produkt</h4>
    <button class="btn btn-primary" id="add_product">Dodaj nowy produkt</button>
    <div class="form" id="add_product_form">
        <form action="product_add.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Nazwa produktu" required="required">
            </div>
            <div class="form-group">
                <?php     
                    $zap = "SELECT idkategoria, nazwa FROM kategorie";
                    $wynik = $pol->query($zap);
                    echo "<p>Kategorie:</p>";
                    if ($wynik->num_rows > 0){
                      $licznik = 1;
                        while ($wiersz = $wynik->fetch_assoc()){
                          if($licznik == 3){
                            $br = "<br/>";
                            $licznik = 1;
                          }
                          else{
                            $br = ""; 
                            $licznik++;
                          };
                            echo "<input type='checkbox' name='categories[]' value='".$wiersz["idkategoria"]."'><label>".$wiersz["nazwa"]."</label>{$br}";
                          }
                         
                    }
                ?>
            </div>
            <div class="form-group">
                <input type="number" step="0.01" min="0" class="form-control" name="price" placeholder="Cena [zł]" required="required">
                <input type="number" min="0" class="form-control" name="quantity" placeholder="Ilość"required="required">
                </div>
                <div class="form-group">
                    <textarea name="description" placeholder="Wprowadź opis" rows="4" cols="50"></textarea>
                </div>
                <div class="form-group">
                    <span>Dostępny</span>
                    <select name="is_avaliable" required="required">
                        <option value="1">Tak</option>
                        <option value="0">Nie</option>
                    </select>
                </div>    
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">Zatwierdź</button>
                </div>
            </form>
        </div>
    <hr>
    <h4>Modyfikuj produkt z oferty</h4>
    <form>
      <select id="product" onchange="select()">
          <option value='-1' selected>-- Wybierz produkt --</option>
          <?php
            $zap = "SELECT idprodukt, nazwa FROM produkty ORDER BY nazwa";
            $wynik = $pol->query($zap);
            if ($wynik->num_rows > 0)
                while ($wiersz = $wynik->fetch_assoc())
                    echo "<option value='{$wiersz["idprodukt"]}'>{$wiersz["nazwa"]}</option>";
          ?>
        </select>
      </form><br/>
    <button type="submit" name="submit" class="btn btn-primary" id="modify_product">Modyfikuj produkt</button>

    <div class="form" id="modify_product_form">
    </div>
    <hr>
</div>

<footer class="container-fluid text-center">
  <p>&copy Patrycja Zajączkowska Bazy Danych 2022 </p>  
</footer>

</body>
</html>
<?php                     
  $pol->close();
?>