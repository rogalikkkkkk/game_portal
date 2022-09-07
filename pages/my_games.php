<?php session_start();
if (!isset($_COOKIE["login"])) {
    header('Location: ../index.php');
}
require_once ('../php_code/check_db.php');
//TODO: делать проверку на переход для админа и гигаадмина на всех страницах
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
    <link href="../css/my_games.css" rel="stylesheet">

    <link href="../datepicker/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="../datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="../datepicker/locales/bootstrap-datepicker.ru.min.js"></script>

    <title>Мои игры</title>
</head>
<body>

<?php require_once("../templates/header.php") ?>

<main>
    <section class="user_games">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-3">
                    <h1>Создайте свою игру</h1>
                </div>
            </div>
            <div class="row">
                <form action="../not_pages/create_new_session.php" method="post">
                    <div class="create_container">
                        <div class="row">
                            <?php if(isset($_SESSION['not_valid_gam_num_message'])) {
                                echo '<p class="wrong_gam_num">' . $_SESSION['not_valid_gam_num_message'] . '</p>';
                                unset($_SESSION['not_valid_gam_num_message']);
                            } ?>
                        </div>
                        <div class="row">
                            <div class="col-3 no-margin">
<!--                                <label for="gam_nam" class="mb-2">Popa</label>-->
                                <select class="form-select" id="gam_nam" name="gam_nam">
                                    <?php
                                    require_once ('../not_pages/get_all_games.php');

                                    foreach ($res_all_games as &$line) {
                                        echo '<option value="' . $line['id'] . '">' . $line['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-4 no-margin">
                                <div class="md-form md-outline input-with-post-icon">
<!--                                    <label for="game_dt" class="mb-2">Try me...</label>-->
                                    <input placeholder="Выберите дату игры" type="datetime-local" id="game_dt" name="game_dt" class="form-control" required>
                                    <?php
                                    echo '<script>
                                            elem = document.getElementById("game_dt")
                                            var iso = new Date();
                                            var isopl = new Date(iso.getTime() - (iso.getTimezoneOffset() - 1) * 60000).toISOString();
                                            var minDate = isopl.substring(0,isopl.length-8);
                                            console.log(minDate);
                                            elem.min = minDate
                                        </script>'
                                    ?>
                                </div>
                            </div>
                            <div class="col-2 no-margin input mb-3">
<!--                                <label for="gam_num" class="mb-2">Kkl</label>-->
                                <input type="number" class="form-control" id="gam_num" name="gam_num" placeholder="Число игроков" aria-label="gamers_number" min=1
                                       onkeyup="if(this.value<0)this.value=1">
                            </div>
                            <div class="col-2 no-margin input mb-3">
<!--                                <label for="gam_bet" class="mb-2">Kkl</label>-->
                                <input type="number" class="form-control" id="gam_bet" name="gam_bet" placeholder="Ставка" aria-label="bet" min=1
                                       onkeyup="if(this.value<0)this.value=1">
                            </div>
                            <div class="col-1 no-margin display-flex">
                                <button type="submit" class="btn btn-sm btn-dark">Создать</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-12">
                    <h1 class="text-begin text-black" style="padding: 0 0 20px 0">Игры, которые Вы создали</h1>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название игры</th>
                            <th scope="col">Дата проведения</th>
                            <th scope="col">Ставка</th>
                            <th scope="col">Статус игры</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once('../not_pages/get_user_hosted_games.php');
                        $i = 1;
                        foreach ($res_my_games_info as &$line) {
                            $dis = $line['status_name'] != 'открыта' ? 'disabled' : '';

                            echo '<tr>
                            <th scope="row">' . $i . '</th>
                            <td>' . $line['game_name'] . '</td>
                            <td>' . $line['time'] . '</td>
                            <td>' . $line['bet'] . '</td>
                            <td>' . $line['status_name'] . '</td>
                            <td>
                                <form action="choose_players.php" method="post">
                                    <input type="hidden" name="my_games_session_id" value="' . $line['id'] . '" >
                                    <button type="submit" class="btn btn-sm btn-dark"' . $dis . '>
                                        Выбрать игроков
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="../not_pages/delete_session.php" method="post">
                                    <input type="hidden" name="my_games_session_id_delete" value="' . $line['id'] . '" >
                                    <button type="submit" class="btn btn-danger btn-sm"' . $dis . '>
                                        Удалить игру
                                    </button>
                                </form>
                            </td>
                        </tr>';
                            $i++;
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12 pt-3">
                    <h1>Игры, в которых вы участвуете</h1>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название игры</th>
                            <th scope="col">Дата проведения</th>
                            <th scope="col">Ставка</th>
                            <th scope="col">Никнейм хоста</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once('../not_pages/get_joining_allow_lobbys.php');
                        $i = 1;
                        foreach ($res_my_lobbys_info as &$line) {

                            if ($line['user_game_status'] == 1 || $line['user_game_status'] == null || $line['status'] != 1) {
                                continue;
                            }


                            echo '<tr>
                            <th scope="row">' . $i . '</th>
                            <td>' . $line['game_name'] . '</td>
                            <td>' . $line['time'] . '</td>
                            <td>' . $line['bet'] . '</td>
                            <td>' . $line['host_name'] . '</td>
                            <td>
                                <form action="../not_pages/remove_gamer_from_lobby.php" method="post">
                                    <input type="hidden" name="back_page" value="my_games.php">
                                    <input type="hidden" name="session_id" value="' . $line['id'] . '" >
                                    <input type="hidden" name="bet" value="' . $line['bet'] . '" >
                                    <button type="submit" name="leave" class="btn btn-warning btn-sm">
                                        Выйти из игры
                                    </button>
                                </form>
                            </td>
                        </tr>';
                            $i++;
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
    </section>
</main>

<?php require_once("../templates/footer.php") ?>

</body>
</html>

