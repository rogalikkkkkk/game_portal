<?php session_start();
if (!isset($_COOKIE["login"])) {
    header('Location: ../index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../css/my_profile.css" rel="stylesheet">

    <title>Профиль</title>
</head>
<body>

<?php require_once("../templates/header.php") ?>

<main>
    <section class="user_games">
        <div class="container">
            <div class="row">
                <div class="col-11 profileinfo">
                    <h1 class="text-begin text-black">Информация о вашем профиле</h1>
                </div>
                <div class="col-1 logoutbtn">
                    <form action="../php_code/logout.php">
                        <button type="submit" class="btn btn-danger btn-sm">
                            Выйти
                        </button>

                    </form>
                </div>
            </div>

            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-6 display-flex">
                            <div class="card text-white bg-secondary mb-3" style="min-width: 18rem; max-width: 20rem;">
                                <div class="card-header">Никнейм</div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php
                                        echo $_COOKIE["login"];
                                        ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 display-flex">
                            <div class="card text-white bg-secondary mb-3" style="min-width: 18rem; max-width: 20rem;">
                                <div class="card-header">Рейтинг</div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php require_once ('../not_pages/get_user_rating.php');
                                        echo $res_user_rating[0]['rating'] . ' pts.';
                                        ?>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h3 class="text-center text-black">
                        История игр
                    </h3>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название игры</th>
                            <th scope="col">Дата проведения</th>
                            <th scope="col">Ставка</th>
                            <th scope="col">Статус игры</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once ('../not_pages/get_user_history.php');
                        $i = 1;
                        foreach ($res_my_history_info as &$histline) {
                            $outcome = $histline['prize'] > 0 ? 'Выигрыш' : 'Проигрыш';
                            echo '<tr>
                            <th scope="row">' . $i . '</th>
                            <td>' . $histline['game_name'] .'</td>
                            <td>' . $histline['time'] .'</td>
                            <td>' . abs($histline['prize']) .'</td>
                            <td>' . $outcome .'</td>
                            </tr>';
                            $i++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once("../templates/footer.php") ?>

</body>
</html>

