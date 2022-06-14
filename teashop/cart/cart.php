<?php
    session_start();
    if(!isset($_SESSION["total_price"]))
      $_SESSION["total_price"] = 0;
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
  
      const LIST_LS = "lists";
      let lists = [];
      deleteBtn = document.querySelector("#delete");

    function loadStorage() {
      const loadStorage = localStorage.getItem(LIST_LS);

      if (!loadStorage) {
        return;
      }

      const parsedList = JSON.parse(loadStorage);
      parsedList.forEach(list => createItem(list.text, list.quantity, true));
    }
    function saveStorage() {
      localStorage.setItem(LIST_LS, JSON.stringify(lists));
    }

    function createItem(text, quantity, create) {
      // alert(text+' '+quantity);
      if(create){
        table = document.querySelector("#products_view");
        const tr = document.createElement("tr");
        $(tr).load("cart_product.php", {pid: text, qu: quantity});  
        table.appendChild(tr);
      }
      lists.push({ text, quantity});
      saveStorage();
    }

    function updateQuantity(q, input){
      var value = parseInt($(input).parent().data("product"));
      var qu = parseInt(q);
      // alert(value+' '+q);
      var i = 0;
      lists.forEach(list => 
      {
        if(list.text == value){
          lists.splice(i, 1);
          createItem(value, qu, false)
          // lists.push({value, qu});
          }
        i++;
      }
      );
      saveStorage();
    }

    function init() {
      loadStorage();
  }

    function clearCart(){
      localStorage.clear();
      window.location = 'cart.php';
    }
   
    $(document).bind('keyup mouseup', ':.form-control', function() {
      var vals =  $('input').val();
      updateQuantity(vals, $('input'));
    });
    init();

    $(".refresh").click(function(){
      window.location = 'cart.php';
    });
    
    });
  </script>
  <style>
          /* Remove the navbar's default rounded borders and increase the bottom margin */ 
      .navbar {
      margin-bottom: 50px;
      border-radius: 0;
      }
      
      /* Remove the jumbotron's default bottom margin */ 
      .jumbotron {
      margin-bottom: 0;
      }
  
      /* Add a gray background color and some padding to the footer */
      footer {
      background-color: #f2f2f2;
      padding: 25px;
      }

      .cart-item-thumb {
          display: block;
          width: 10rem
      }

      .ui-w-40 {
          width: 40px !important;
          height: auto;
      }

      .card{
          box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);    
      }

      .ui-product-color {
          display: inline-block;
          overflow: hidden;
          margin: .144em;
          width: .875rem;
          height: .875rem;
          border-radius: 10rem;
          -webkit-box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
          box-shadow: 0 0 0 1px rgba(0,0,0,0.15) inset;
          vertical-align: middle;
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
            <form class="form-inline my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="../user/login/login.php"><i class="fa fa-user"></i> Twoje konto</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="../cart/cart.php"><i class="fa fa-shopping-basket"></i> Koszyk</a>
            </li>
            </form>
        </div>
    </nav>

    <br><br><br>

    <div class="container px-3 my-5 clearfix">
        <div class="card">
            <div class="card-header">
                <h2>Koszyk</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered m-0">
                    <thead>
                      <tr>
                        <th class="text-center py-3 px-4" style="min-width: 400px;">Nazwa produktu</th>
                        <th class="text-right py-3 px-4" style="width: 100px;">Cena jednostkowa</th>
                        <th class="text-center py-3 px-4" style="width: 120px;">Ilość</th>
                        <th class="text-right py-3 px-4" style="width: 100px;">Łączna cena</th>
                        <form action="cart_delete_product.php" method="post">
                          <th class="text-center align-middle py-3 px-0" style="width: 40px;"><button type="submit"><i class="fa fa-trash" id="clear"></i></button></th>
                        </form>
                      </tr>
                    </thead>
                    <tbody id="products_view">
            
                    </tbody>
                  </table>
                </div>
            
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                    <div class="mt-4">
                      <label class="text-muted font-weight-normal m-0">Całkowity koszt</label>
                      <div class="text-large"><strong><?php echo number_format($_SESSION["total_price"], 2);?> zł</strong></div>
                    </div>
                </div>
            
                <div class="float-left">
                  <a href='cart.php'>Zatwierdź zmiany</a><br/></br>
                </div>
                <div class="float-right">
                  <a class="mt-2 mr-3" href="../products/products.php">Powrót do zakupów</a>
                  <button class="btn btn-primary mt-2" style="color:white;" onclick="window.location = '../user/orders/order.php'" <?php $disabled = ($_SESSION["total_price"] == 0)? 'disabled': ''; echo $disabled?>>Złóż zamówienie</button>
                </div>
            
              </div>
          </div>
      </div>
    <br><br>

    <footer class="container-fluid text-center">
        <p>&copy Patrycja Zajączkowska Bazy Danych 2022 </p>  
    </footer>
</body>
</html>
<?php
  $_SESSION["total_price"] = 0;
?>