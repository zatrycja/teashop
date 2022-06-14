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
	  	$(document).ready(
		function(){
			var theValue = <?php echo $_POST["sort"]; ?>;
			$('option[value=' + theValue + ']')
				.attr('selected',true);
		});

		const LIST_LS = "lists";
		let lists = [];

		function sort(){
			//alert($("#sort_type").val());
		}

		function saveStorage() {
		localStorage.setItem(LIST_LS, JSON.stringify(lists));
		}

		function loadStorage() {
		const loadStorage = localStorage.getItem(LIST_LS);

		if (!loadStorage) {
			return;
		}
			const parsedList = JSON.parse(loadStorage);
		parsedList.forEach(list => lists.push(list));
		}

		function onAdd(text, qu) {
			var exist = false;
			var i = 0;
			lists.forEach(list => 
			{
				if(list.text == text){
					exist = true;
					if(list.quantity == 9)
						alert('Możesz kupić max. 9 sztuk danego produktu jako osoba prywatna. \nAby złożyć zamówienie hurtowe napisz do nas!');
					else {
					let n = list.text;
					let q = parseInt(list.quantity, 10) + 1;
					lists.splice(i, 1);
					createItem(text, q);
					}
				}
				i++;
			}
			);
		if(!exist)
			createItem(text, qu);
		}


		function createItem(text, qu) {
		var quantity = parseInt(qu);
		lists.push({ text, quantity});
		saveStorage();
		alert("Dodano do koszyka");
		}

		function init() {
			loadStorage();
		}

		init();

	</script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      /* margin-bottom: 50px; */
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



.bg-lblue {
  background-color: #32c8de !important;
}

/* Button classes */
.btn {
    border-radius: 2px;
	position: relative;
}
.btn.btn-no-border {
	border: 0px !important;
}

.btn.btn-lblue {
	color: #ffffff;
	background: #32c8de;
	border: 1px solid #1faabe;
}
.btn.btn-lblue:hover,
.btn.btn-lblue:focus,
.btn.btn-lblue.active,
.btn.btn-lblue:active {
	background: #1faabe;
	color: #ffffff;
}

.shop-items{
	max-width:1150px;
	margin:10px auto;
	padding:0px 20px;
}
.shop-items .item {
	position: relative;
	max-width: 360px;
	margin: 15px auto;
	padding: 5px;
	text-align: center;
	border-radius: 4px;
	overflow: hidden;
	border:2px solid #eee;
}
.shop-items .item:hover{	
	border:2px solid #32c8de;
}
.shop-items .item img {
	width: 100%;
	max-width: 360px;
	margin: 0 auto;
	border: 1px solid #eee;
	border-radius: 3px;
}
.shop-items .item  .item-dtls h4 {
	margin-top: 13px;
	margin-bottom: 10px;
	text-transform: uppercase;
}
.shop-items .item  .item-dtls .price {
	display: block;
	margin-bottom: 13px;
	font-size: 25px;
}
.shop-items .item  .ecom {
	position: absolute;
	top: 100%;
	left: 0;
	width: 100%;
	padding-bottom:10px;
	padding-top: 10px;
	-webkit-transition: all 0.35s ease-in;
	-moz-transition: all 0.35s ease-in;
	-ms-transition: all 0.35s ease-in;
	-o-transition: all 0.35s ease-in;
	transition: all 0.35s ease-in;
}
.shop-items .item:hover  .ecom { 
	margin-top: -50px; 
}
.shop-items .item  .ecom  a.btn{
	border:1px solid #fff;
	color:#fff;
	background:transparent;
	-webkit-transition: all 0.35s ease-in;
	-moz-transition: all 0.35s ease-in;
	-ms-transition: all 0.35s ease-in;
	-o-transition: all 0.35s ease-in;
	transition: all 0.35s ease-in;
}
.shop-items .item  .ecom  a.btn:hover{
	background:#fff;
	color:#777;
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
      <li class="nav-item">
        <a class="nav-link" href="../cart/cart.php"><i class="fa fa-shopping-basket"></i> Koszyk</a>
      </li>
    </form>
  </div>
</nav>

<div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-2" style="border: #f2f2f2 solid; padding-right: 25px; padding-top: 25px;">
				<form id="select_category" action="productscat.php" method="post">
					<h4>Sortowanie</h4>
					<select name="sort">
						<option value="1">Alfabetycznie rosnąco</option>
						<option value="2">Alfabetycznie malejąco</option>
						<option value="3">Cena: od najniższej</option>
						<option value="4">Cena: od najwyżej</option>
						<option value="5">Popularność</option>
					</select><br/><br/>
					<h4>Kategorie</h4><br/>
				
					<?php
						$pol = new mysqli("localhost", "root", "", "teashop");
						if ($pol->connect_error)
							die("brak połączenia z bazą");     

						$zap = "SELECT idkategoria, nazwa FROM kategorie";
						$wynik = $pol->query($zap);
						if ($wynik->num_rows > 0)
							while ($wiersz = $wynik->fetch_assoc()){
								$checked = false;
								foreach($_POST["categories"] as $cat)
									if($cat == $wiersz["idkategoria"])
											$checked = true;                              
							
							if($checked)
								echo "<input type='checkbox' name='categories[]' value='{$wiersz["idkategoria"]}' checked>  {$wiersz["nazwa"]}<br/><br/>";
							else
								echo "<input type='checkbox' name='categories[]' value='{$wiersz["idkategoria"]}'>  {$wiersz["nazwa"]}<br/><br/>";
						}
					?>
					<br/>
					<button type="sumbit" class="btn btn-primary" id="filter">Filtruj i sortuj produkty</button>
				</form>
                <br/>
            </div>
			<div class="shop-items col-10" id="items">
            <!-- <div class="container-fluid"> -->
				<?php
					// $pol = new mysqli("localhost", "root", "", "teashop");
					// if ($pol->connect_error)
					//     die("brak połączenia z bazą");
				$cats = array();
				$results = array();
				if (!empty($_POST["categories"]))
					foreach($_POST["categories"] as $cat){
									$cats[] = $cat;
									$zap = "SELECT p.idprodukt AS produkt, p.nazwa, p.cena FROM produkty p INNER JOIN kategorie_produkty kp ON p.idprodukt = kp.idprodukt WHERE p.czy_dostepny = 1 AND kp.idkategoria = {$cat}";
									if($_POST["sort"] == 1)
										$wynik = $pol->query($zap." ORDER BY nazwa asc");
									else if($_POST["sort"] == 2)
										$wynik = $pol->query($zap." ORDER BY nazwa desc");
									else if($_POST["sort"] == 3)
										$wynik = $pol->query($zap." ORDER BY cena asc");
									else if($_POST["sort"] == 4)
										$wynik = $pol->query($zap." ORDER BY cena desc");
									else if($_POST["sort"] == 5){
										$zap = "SELECT p.idprodukt AS produkt, p.nazwa, p.cena, ifnull((select sum(zp.ilosc) from zamowienia_produkty zp where zp.idprodukt = produkt group by zp.idprodukt), 0) as ile FROM ((produkty p LEFT JOIN zamowienia_produkty zp ON p.idprodukt = zp.idprodukt) INNER JOIN kategorie_produkty kp ON p.idprodukt = kp.idprodukt) WHERE czy_dostepny = 1 AND kp.idkategoria = {$cat} GROUP BY p.idprodukt ORDER BY ile DESC";
										$wynik = $pol->query($zap);
									}
									$results[] = $wynik;
								}
					else
						echo "<script>window.location = 'products.php'</script>";
									
				echo "<div class='row'>";

				foreach($results as $wynik){
				$licznik = 1;
				$quantity = 1;
				if ($wynik->num_rows > 0){
					while ($wiersz = $wynik->fetch_assoc()){
							echo "<div class='col-md-3 col-sm-6'>
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
				}
				}
				echo "</div>";
				$pol->close();
				?>
        
            </div>
    </div>

  
</div>

<footer class="container-fluid text-center">
  <p>&copy Patrycja Zajączkowska Bazy Danych 2022 </p>  
</footer>

</body>
</html>
