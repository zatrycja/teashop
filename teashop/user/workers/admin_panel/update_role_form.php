<?php
if($_POST["uid"] != -1){
    $pol = new mysqli("localhost", "root", "", "teashop");
    if ($pol->connect_error)
        die("brak połączenia z bazą");

    $zap = "SELECT u.iduzytkownik, r.nazwa, u.idrola FROM uzytkownicy u INNER JOIN role r ON r.idrola = u.idrola WHERE u.iduzytkownik={$_POST["uid"]}";
    $wynik = $pol->query($zap);
    $info = $wynik->fetch_assoc();
    echo"
        <form action='update_role.php?uid={$_POST["uid"]}' method='post'>
            <div class='form-group'>
                <span>Rola użytkownika:</span>
                <select name='user_role'>";
                    $zap = "SELECT idrola, nazwa FROM role";
                    $wynik = $pol->query($zap);
                    if ($wynik->num_rows > 0)
                        while ($wiersz = $wynik->fetch_assoc()){
                            $temp = ($wiersz['idrola'] == $info["idrola"])? 'selected': '';
                            echo "<option value='{$wiersz["idrola"]}' {$temp}>{$wiersz["nazwa"]}</option>";}
            echo " </select>
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
                <span>Rola użytkownika nr:{$_POST["uid"]}</span>
                <select name='user_role'>
                        <option>Wybierz użytkownika</option>
                    </select>
                </div>
                <div class='form-group'>
                    <button class='btn btn-primary' disabled>Zatwierdź</button>
                </div>
            </form>
            ";
?>