<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.88.1">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" href="../css/registration.css">

    <title>Авторизация</title>
</head>
<body>

<main class="form-signin">
    <form action="../php_code/registr.php">

        <h1 class="h3 mb-3 fw-normal">Пожалуйста, авторизируйтесь</h1>

        <?php
        if (isset($_SESSION['message'])) {
            echo '<p class="wrong_login">' . $_SESSION['message'] . '</p>';
            unset($_SESSION['message']);
        }
        ?>

        <div class="form-floating">
            <input type="text" class="form-control" id="login" name="login" placeholder="name@example.com" required>
            <label for="login">Логин/никнейм</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <label for="password">Пароль</label>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            <label for="email">Эл.Почта</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Войти</button>
    </form>
</main>

</body>
</html>
