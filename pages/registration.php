<?php
require('function.php');
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login = $_POST['login'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $birthday = $_POST['birthday'];

    if(empty($login) || empty($password || empty($birthday))){
        $_SESSION['message'] = 'Логин, пароль и дата рождения не должны быть пустыми.';
        header('Location: registration.php');
        exit;
    }

    $file = '../data/data.php';
    $data = file_get_contents($file) ? include $file : [];
    
    if(existsUser($login)){
        $_SESSION['message'] = 'Пользователь с таким логином уже существует.';
        header('Location: registration.php');
        exit;
    }
    $data[] = ['login' => $login, 'password' => $password, 'birthday' => $birthday];
    file_put_contents($file, "<?php\n return " . var_export($data, true) . ";\n");

    $_SESSION['message'] = "Пользователь зарегистрирован.";

    header('Location: registration.php');
    exit;
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
    <title>Spa L'eau</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="header-content">
        <a href= "../index.php" class="logo_a"><h1>Spa L'eau</h1></a>
        </div>
        <form action="registration.php" class="form_registr" method="post">
            <h2>Регистрация</h2>
            <input name="login" type="text" placeholder="Логин" class="form-input" required>
            <input name="password" type="password" placeholder="Пароль" class="form-input" required>
            <label for="birthday">Укажите дату рождения:</label>
            <input name="birthday" type="date" class="form-input" required/>
            <input name="submit" type="submit" value="Зарегистрироваться" class="form-button">
            <?php if ($successMessage){ ?>
                <p><?= $successMessage ?></p>
            <?php } ?>
        </form>
        <nav class="auth-links">
            <a href="login.php" class="signup">Войти</a>
        </nav>
    </header>
    <main>
        <h1>Услуги</h1>
        <section class="product">
            <article>
                <img src="https://images.unsplash.com/photo-1519823551278-64ac92734fb1?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Массаж">
                <div class="article-meta">
                    Массаж<br>
                    Цена: 4000 рублей
                </div>
            </article>
            <article>
                <img src="https://images.unsplash.com/photo-1457972729786-0411a3b2b626?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Маникюр">
                <div class="article-meta">
                Маникюр<br>
                Цена: 3000 рублей
            </div>
            </article>
            <article>
                <img src="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Маска для лица">
                <div class="article-meta">
                Маска для лица<br>
                Цена: 2000 рублей
            </div>
            </article>
            <article>
                <img src="https://plus.unsplash.com/premium_photo-1661601792536-bc8947f0b35c?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NTN8fFNwYSUyMHNhbG9ufGVufDB8fDB8fHww" alt="Уход за волосами">
                <div class="article-meta">
                Уход за волосами<br>
                Цена: 5000 рублей
            </div>
            </article>
        </section>
        <h1>Акции</h1>
        <section class="product">
            <article>
                <img src="https://images.unsplash.com/photo-1519823551278-64ac92734fb1?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Массаж">
                <div class="article-meta">
                    Массаж<br>
                    Приводи подругу и аолучай скидку в 10%
                </div>
            </article>
            <article>
                <img src="https://images.unsplash.com/photo-1457972729786-0411a3b2b626?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Маникюр">
                <div class="article-meta">
                Маникюр<br>
                Каждый 5 маникюр 15% скидка
            </div>
            </article>
            <article>
                <img src="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Маска для лица">
                <div class="article-meta">
                Маска для лица<br>
                2 в 1
            </div>
            </article>
        </section>
        <h1>Фото</h1>
        <section class="product">
            <article class="photo">
                <img src="https://images.unsplash.com/photo-1591343395082-e120087004b4?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Массаж">
            </article>
            <article class="photo">
                <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Маникюр">
            </article>
            <article class="photo">
                <img src="https://images.unsplash.com/photo-1595871151608-bc7abd1caca3?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8U3BhJTIwc2Fsb258ZW58MHx8MHx8fDA%3D" alt="Маска для лица">
            </article>
            <article class="photo">
                <img src="https://images.unsplash.com/photo-1483137140003-ae073b395549?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fFNwYSUyMHNhbG9ufGVufDB8fDB8fHww" alt="Уход за волосами">
            </article>
            <article class="photo">
                <img src="https://plus.unsplash.com/premium_photo-1661675810415-8f7b1a388277?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fFNwYSUyMHNhbG9ufGVufDB8fDB8fHww" alt="Массаж">
            </article>
            <article class="photo">
                <img src="https://plus.unsplash.com/premium_photo-1661580204452-810b68d73978?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjV8fFNwYSUyMHNhbG9ufGVufDB8fDB8fHww" alt="Маникюр">
            </article>
            <article class="photo">
                <img src="https://images.unsplash.com/photo-1531299204812-e6d44d9a185c?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjR8fFNwYSUyMHNhbG9ufGVufDB8fDB8fHww" alt="Маска для лица">
            </article>
            <article class="photo">
                <img src="https://plus.unsplash.com/premium_photo-1661575373925-0219e6d3cfd6?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mjl8fFNwYSUyMHNhbG9ufGVufDB8fDB8fHww" alt="Уход за волосами">
            </article>
        </section>
    </main>
    <footer>
        <div class="links">
            <a href="#">Вакансии</a>
            <a href="#">Контакты</a>
            <a href="#">О нас</a>
            <a href="#">Правила</a>
        </div>
        <div class="copyright">Copyright &copy; Spa L'eau 2024</div>
    </footer>
</body>
</html>