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
    <link href="../css/join_game.css" rel="stylesheet">

    <title>Присоединиться к игре</title>
</head>
<body>

<?php require_once("../templates/header.php") ?>

<main>
    <section class="other_users_games">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-begin text-black" style="padding: 0 0 20px 0">Игры, к которым вы можете
                        присоединиться</h1>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название игры</th>
                            <th scope="col">Дата проведения</th>
                            <th scope="col">Ставка</th>
                            <th scope="col">Никнейм хоста</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once('../not_pages/get_joining_allow_lobbys.php');
                        $i = 1;
                        foreach ($res_my_lobbys_info as &$line) {

                            if($line['status'] != 1) continue;

                            $leave = '';
                            $join = '';

                            if ($line['user_game_status'] === null || $line['user_game_status'] == 1) {
                                $join = '';
                                $leave = 'disabled';
                            } else {
                                $join = 'disabled';
                                $leave = '';
                            }


                            echo '<tr>
                            <th scope="row">' . $i . '</th>
                            <td>' . $line['game_name'] . '</td>
                            <td>' . $line['time'] . '</td>
                            <td>' . $line['bet'] . '</td>
                            <td>' . $line['host_name'] . '</td>
                            <td>
                                <form action="../not_pages/add_gamer_to_lobby.php" method="post">
                                    <input type="hidden" name="session_id" value="' . $line['id'] . '" >
                                    <input type="hidden" name="bet" value="' . $line['bet'] . '" >
                                    <button type="submit" name="join" class="btn btn-success btn-sm" ' . $join . '>
                                        Запросить приглашение
                                    </button>                               
                                </form>
                            </td>
                            <td>
                                <form action="../not_pages/remove_gamer_from_lobby.php" method="post">
                                    <input type="hidden" name="back_page" value="join_game.php">
                                    <input type="hidden" name="session_id" value="' . $line['id'] . '" >
                                    <input type="hidden" name="bet" value="' . $line['bet'] . '" >
                                    <button type="submit" name="leave" class="btn btn-warning btn-sm" ' . $leave . '>
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
        </div>
    </section>
</main>


<?php require_once("../templates/footer.php") ?>

</body>
</html>

