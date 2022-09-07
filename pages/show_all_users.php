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
                    <h1 class="text-begin text-black" style="padding: 0 0 10px 0">Игроки, зарегистрированные на портале</h1>
                    <p>Администратором можно сделать только игрока с нулевым рейтингом</p>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Логин игрока</th>
                            <th scope="col">Пароль игрока</th>
                            <th scope="col">Email</th>
                            <th scope="col">Права</th>
                            <th scope="col">Рейтинг</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once('../not_pages/get_all_users.php');
                        $i = 1;
                        foreach ($res_all_users as &$line) {
                            $op_num = '';

                            if ($line['rating'] == 0 && $line['rig'] == 'юзер') {
                                $res_button = '
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#surname_modal' . $line['user_id'] . '">
                                        Сделать администратором
                                    </button>
                                    <div class="modal fade" id="surname_modal' . $line['user_id'] . '" tabindex="-1" role="dialog" aria-labelledby="surname_modalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="surname_modalLabel">Фамилия администратора</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="input-group mb-3">
                                                      <input type="text" class="form-control" id="admin_surname" name="admin_surname" placeholder="Введите фамилию" aria-label="Введите фамилию" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                $op_num = 1;
                            } else {
                                if ($line['rig'] == 'админ') {
                                    $res_button = '<button type="submit" name="join" class="btn btn-warning btn-sm">
                                        Сделать юзером
                                    </button> ';
                                    $op_num = 2;
                                }
                                else {
                                    $res_button = '<button type="submit" name="join" class="btn btn-success btn-sm" disabled>
                                        Сделать администратором
                                    </button> ';
                                }
                            }


                            echo '<tr>
                            <th scope="row">' . $i . '</th>
                            <td>' . $line['login'] . '</td>
                            <td>' . $line['password'] . '</td>
                            <td>' . $line['email'] . '</td>
                            <td>' . $line['rig'] . '</td>
                            <td>' . $line['rating'] . '</td>
                            <td>
                                <form action="../not_pages/change_role.php" method="post">
                                    <input type="hidden" name="user_id" value="' . $line['user_id'] . '">
                                    <input type="hidden" name="op_num" value="' . $op_num . '">
                                    ' . $res_button . '                               
                                </form>
                            </td>
                        </tr>';
                            $i++;
                        }
                        ?>
                        </tbody>
                    </table>


                    <!-- Modal -->
                </div>
            </div>
        </div>
    </section>
</main>


<?php require_once("../templates/footer.php") ?>

</body>
</html>


