<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
      const LIST_LS = "lists";
      let lists = [];

    function loadStorage() {
      const loadStorage = localStorage.getItem(LIST_LS);

      if (!loadStorage) {
        return;
      }

      const parsedList = JSON.parse(loadStorage);
      parsedList.forEach(list => createItem(list.text, list.quantity));
    }

    function saveStorage() {
      localStorage.setItem(LIST_LS, JSON.stringify(lists));
    }

    function createItem(text, quantity) {
      lists.push({text, quantity});
      saveStorage();
    }

    function init() {
      loadStorage();
    }

    function addToDB(order) {
        lists.forEach(list => 
            {   
                $("p").load("order_add_product.php", {oid: order, pid: list.text, quantity:list.quantity});
            }
	    );
      localStorage.clear();
    }

    init();
  </script>
  <html><p></html>
<?php
    session_start();
    $pol = new mysqli("localhost", "root", "", "teashop");
    if ($pol->connect_error)
        die("brak połączenia z bazą");
    $zap = "SELECT cena FROM dostawy WHERE iddostawa = {$_POST["delivery"]}";
    $wynik = $pol->query($zap);
            if ($wynik->num_rows > 0)
              while ($delivery = $wynik->fetch_assoc())
    $total = number_format($delivery["cena"] + $_SESSION["total_price"], 2);

    $zap = "INSERT INTO zamowienia VALUES (0, CURDATE(), {$_SESSION["user"]}, IF({$_POST["payment"]} = 1, 2, 1), {$_POST["delivery"]}, {$_POST["payment"]}, {$total}, 
            '{$_POST["post_code"]}', '{$_POST["city"]}', '{$_POST["street"]}', '{$_POST["number"]}', '{$_POST["additional"]}')";
    if ($pol->query($zap) === TRUE){
        $last_id = $pol->insert_id;
        echo "<script>addToDB({$last_id});";
        echo "window.location = '../user.php';</script>";
    }
    else
        // echo "{$_SESSION["user"]}, {$_POST["payment"]}, {$_POST["delivery"]}, {$_POST["payment"]}, {$_SESSION["total_price"]}, 
        // {$_POST["post_code"]}, {$_POST["city"]}, {$_POST["street"]}, {$_POST["number"]}, {$_POST["additional"]}";
        echo "<script>alert('Wystąpił błąd, spróbuj ponownie.'); window.location = '../user.php';</script>";


    $pol->close();
?>

