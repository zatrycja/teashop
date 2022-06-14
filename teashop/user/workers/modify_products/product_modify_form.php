  <?php
  //echo "<p>{$_POST["pid"]}</p>";
    $pol = new mysqli("localhost", "root", "", "teashop");
    if ($pol->connect_error)
        die("brak połączenia z bazą");

    $zap = "SELECT nazwa, cena, opis, na_stanie, czy_dostepny FROM produkty WHERE idprodukt={$_POST["pid"]}";
    $wynik = $pol->query($zap);
    $info = $wynik->fetch_assoc();
  ?>
  <form action="product_modify.php?pid=<?php echo $_POST["pid"];?>" method="post">
    <div class="form-group">
        <span>Nazwa:</span>
        <input type="text" class="form-control" name="name" value="<?php echo $info["nazwa"];?>" required="required">
    </div>
    <div class="form-group">
        <?php
            $create = "CREATE TABLE temp (kid integer(11))";
            $wynik = $pol->query($create);
            $zap = "INSERT INTO temp(kid) SELECT k.idkategoria FROM kategorie k WHERE k.idkategoria IN (SELECT pk.idkategoria FROM kategorie_produkty pk WhERE idprodukt={$_POST["pid"]} )";
            $wynik = $pol->query($zap);
            echo "<p>Kategorie:</p>";
            $zap = "SELECT * FROM kategorie";
            $wynik = $pol->query($zap);
            $licznik = 1;
            // $br = "";
            
            while ($wiersz = $wynik->fetch_assoc()){
              if($licznik == 3){
                $br = "<br/>";
                $licznik = 1;
              }
              else{
                $br = ""; 
                $licznik++;
              };

                $zap2 = "SELECT * FROM kategorie WHERE idkategoria = {$wiersz["idkategoria"]} AND idkategoria IN (SELECT kid FROM temp)";
                $wynik2 = $pol->query($zap2);

                if ($wynik2->num_rows > 0)
                  echo "<input type='checkbox' name='categories[]' value='".$wiersz["idkategoria"]."' checked><label>".$wiersz["nazwa"]."</label>{$br}";
                else
                  echo "<input type='checkbox' name='categories[]' value='".$wiersz["idkategoria"]."'><label>".$wiersz["nazwa"]."</label>{$br}";
              }
              $zap3 = "DROP TABLE temp";
              $wynik3 = $pol->query($zap3);
        ?>
    </div>
    <div class="form-group">
        <span>Cena[zł]:</span>
        <input type="number" step="0.01" min="0" class="form-control" name="price" value="<?php echo $info["cena"];?>" required="required">
        <span>Na stanie [szt.]:</span>
        <input type="number" min="0" class="form-control" name="quantity" value="<?php echo $info["na_stanie"];?>"required="required">
        </div>
        <div class="form-group">
          <span>Opis:
          <textarea name="description" rows="4" cols="50"><?php echo $info["opis"];?></textarea></span>
        </div>
        <div class="form-group">
            <span>Dostępny</span>
            <select name="is_avaliable" required="required">
              <?php
                $zap = "SELECT czy_dostepny FROM produkty WHERE idprodukt = {$_POST["pid"]}";
                $wynik = $pol->query($zap);
                $wiersz = $wynik->fetch_assoc();
                if($wiersz["czy_dostepny"] == 0) {
                 echo "<option value='1'>Tak</option>";
                 echo "<option value='0' selected='selected'>Nie</option>";
                }
                else {
                  echo "<option value='1' selected='selected'>Tak</option>";
                  echo "<option value='0'>Nie</option>";
                }
              ?>
            </select>
        </div>    
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg">Zatwierdź</button>
        </div>
    </form>
</div>
<?php
    $pol->close();
?>