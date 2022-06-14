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
        const LIST_LS = "lists";
        let lists = [];

        function saveStorage() {
        localStorage.setItem(LIST_LS, JSON.stringify(lists));
        //alert(lists);
        }

        function loadStorage() {
        const loadStorage = localStorage.getItem(LIST_LS);

        if (!loadStorage)
            return;
        
            const parsedList = JSON.parse(loadStorage);
            parsedList.forEach(list => lists.push(list));
        }

        function onAdd() {
            var qu = $("#inputQuantity").val();
            var text = <?php echo $_GET["pid"]; ?>;
            var exist = false;
            var i = 0;
            lists.forEach(list => 
            {
                if(list.text == text){
                    exist = true;
                    if(list.quantity == 9)
                        alert('Możesz kupić max. 9 sztuk danego produktu jako osoba prywatna. \nAby złożyć zamówienie hurtowe napisz do nas!');
                    else {
                    //let n = list.text;
                    let q = parseInt(qu, 10);
                    lists.splice(i, 1);
                    createItem(text, q);
                    }
                }
                i++;
            }
            );
        if(!exist)
            createItem(text, qu);
        alert('Dodano do koszyka.');
        }


        function createItem(text, qu) {
        var quantity = parseInt(qu);
        lists.push({ text, quantity});
        saveStorage();
        }


        function init() {
            loadStorage();
        }

        init();

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
                <li class="nav-item active">
                    <a class="nav-link" href="products.php">Produkty</a>
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
                <li class="nav-item">
                    <a class="nav-link" href="../cart/cart.php"><i class="fa fa-shopping-basket"></i> Koszyk</a>
                </li>
                </form>
            </div>
        </nav>
        <?php
            $pol = new mysqli("localhost", "root", "", "teashop");
            if ($pol->connect_error)
                die("brak połączenia z bazą");
            $zap = "SELECT nazwa, cena, na_stanie, opis, czy_dostepny FROM produkty where idprodukt = {$_GET["pid"]}";
            $wynik = $pol->query($zap);
            $prod = $wynik->fetch_assoc();
            $disabled = ($prod["czy_dostepny"] == 1)? "": "disabled";
            $zap = "SELECT k.nazwa FROM kategorie k INNER JOIN kategorie_produkty pk ON k.idkategoria = pk.idkategoria WHERE pk.idprodukt = {$_GET["pid"]}";
            $wynik = $pol->query($zap);
            //$kat = $wynik->fetch_assoc();
            $pol->close();
        ?>
        <div class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="http://www.eskleplewiatan.pl/zdjecia/3793_1.jpg" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">
                            <?php
                                if ($wynik->num_rows > 0){
                                    echo "<span>|</span>";
                                    while ($kat = $wynik->fetch_assoc())
                                        echo "<span>   {$kat["nazwa"]}   |</span>";
                                    }
                            ?>
                        </div>
                        <h1 class="display-5 fw-bolder"><?php echo $prod["nazwa"];?></h1>
                        <div class="fs-5 mb-5">
                            <span><?php echo $prod["cena"];?> zł</span>
                        </div>
                        <p class="lead"><?php echo $prod["opis"];?></p>
                        <div class="d-flex">
                            <input class="form-control text-center" id="inputQuantity" type="number" value="1" min="1" max="<?php echo min(9, $prod["na_stanie"]); ?>" style="max-width: 3rem" />
                            <button class="btn btn-primary" type="button" onclick="onAdd()" <?php echo $disabled; ?>>
                                Dodaj do koszyka
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br>

        <footer class="container-fluid text-center">
        <p>&copy Patrycja Zajączkowska Bazy Danych 2022 </p>  
        </footer>
    </body>
</html>
