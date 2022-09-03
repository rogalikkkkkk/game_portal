<?php
session_start();
if (!isset($_COOKIE["login"])) {
    header('Location: ../index.php');
}
require_once ('../not_pages/choose_lobby_players.php');
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
    <link href="../css/choose_players.css" rel="stylesheet">

    <title>Выбор игроков</title>
</head>
<body>

<?php require_once ("../templates/header.php")?>

<main>
    <section class="user_games">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="my_games.php" method="post">
                        <button type="submit" class="btn btn-sm btn-dark">
                            Вернуться назад
                        </button>
                    </form>
                    <h1 class="text-begin text-black" style="padding: 0 0 20px 0">Эти игроки хотят сыграть с вами</h1>
                    <form action="../not_pages/equip_lobby.php" method="post">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Никнейм пользователя</th>
                                <th scope="col">Рейтинг пользователя</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 0;
                            foreach ($res_users_wants_in_lobby as &$line) {
                                $i++;
                                echo '<tr>
                                <th scope="row">
                                    <input type="hidden" name="unselected_users_' . $i . '" value="' . $line['user_profile_id'] . '">
                                    <input class="form-check-input" type="checkbox" name="user_id_' . $i . '" value="' . $line['user_profile_id'] . '">
                                </th>
                                <td>' . $line['login'] . '</td>
                                <td>' . $line['rating'] . '</td>
                            </tr>';
                            }

                            echo '<input type="hidden" name="all_wanted_users_count" value="' . $i . '">
                            <input type="hidden" name="chose_session_id" value="' . $_POST['my_games_session_id'] . '">
                            ';
                            ?>
                            </tbody>
                        </table>
                        <?php
                        if(isset($_SESSION['wrong_chosen_gam_num'])) {
                            echo '<p class="wrong_gam_num">' . $_SESSION['wrong_chosen_gam_num'] . '</p>';
                            unset($_SESSION['wrong_chosen_gam_num']);
                        }
                        ?>
                        <div class="d-grid col-4 mx-auto">
                           <button class="btn btn-success mt-3" type="submit">Выбрать отмеченных участников</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once ("../templates/footer.php")?>

</body>
</html>