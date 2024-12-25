<?php
require('function.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    if(checkPassword($_POST['login'], $_POST['password'])){
        session_start();
        $_SESSION['username'] = $_POST['login'];
        $_SESSION['auth'] = true;
        header('Location: ../index.php');
        exit;
    }
    else{
        $_SESSION['message'] = "Неверный логин или пароль.";

        header('Location: login.php');
        exit;
    }
}

$successMessage = '';
if (!empty($_SESSION['message'])) {
    $successMessage = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация Spa L'eau</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="header-content">
        <a href= "../index.php" class="logo_a"><h1>Spa L'eau</h1></a>
    </div>
    <div class="registration-cssave">
        <form action="login.php" method="post">
            <h3 class="text-center">Форма входа</h3>
            <div class="form-group">
                <input class="form-control item" type="text" name="login" maxlength="15" minlength="1" pattern="^[a-zA-Z0-9_.-]*$" id="username" placeholder="Логин" required>
            </div>
            <div class="form-group">
                <input class="form-control item" type="password" name="password" minlength="3" id="password" placeholder="Пароль" required>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block create-account" type="submit">Вход в аккаунт</button>
            </div>
            <?php if ($successMessage){ ?>
                <p><?= $successMessage ?></p>
            <?php } ?>
        </form>
    </div>
</body>
</html>