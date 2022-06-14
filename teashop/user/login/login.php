<?php
    session_start();
        if (isset($_SESSION["user_rola"]))
            header("Location: ../user.php");
?>
<!DOCTYPE html>
<html lang="PL-pl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Logowanie</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> 
<style>
.login-form {
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    font-weight: bold;
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
</style>
</head>
<body>
<div class="login-form">
    <form action="login_confirmation.php" method="post">
        <h2 class="text-center">Logowanie</h2>       
        <div class="form-group">
            <input type="text" class="form-control" placeholder="login" name="login" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="hasło" name="haslo" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Zaloguj się</button>
        </div>       
    </form>
    <p class="text-center"><a href="../register/register.html">Zarejestruj się</a></p>
    <p class="text-center"><a href="../../index.html">Powrót</a></p>

</div>
</body>
</html>