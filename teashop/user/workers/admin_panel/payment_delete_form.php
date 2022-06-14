<?php
if($_POST["pid"] != -1){
    $pol = new mysqli("localhost", "root", "", "teashop");
    if ($pol->connect_error)
        die("brak połączenia z bazą");

    $zap = "SELECT czy_dostepny from platnosci WHERE idplatnosc={$_POST["pid"]}";
    $wynik = $pol->query($zap);
    $info = $wynik->fetch_assoc();
    
    echo"
        <form action='payment_delete.php?pid={$_POST["pid"]}' method='post'>
            <div class='form-group'>";
    
    if ($info["czy_dostepny"] == 1)
        echo "
                <p><input type='radio' name='isavaliable' value='1' checked> Dostępna
                <input type='radio' name='isavaliable' value='0'> Niedostępna</p>";
      
    else
    echo "
            <p><input type='radio' name='isavaliable' value='1'> Dostępna
            <input type='radio' name='isavaliable' value='0' checked> Niedostępna</p>";
    
    echo "
            </div>
            <div class='form-group'>
                <button type='submit' class='btn btn-primary'>Zatwierdź</button>
            </div>
        </form>
    ";
    $pol->close();
    }
    else
        echo"
            <form>
                <div class='form-group'>
                <select name='user_role'>
                        <option>Wybierz płatność</option>
                    </select>
                </div>
                <div class='form-group'>
                    <button class='btn btn-primary' disabled>Zatwierdź</button>
                </div>
            </form>
            ";
?>