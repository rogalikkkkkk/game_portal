<?php

require_once ('pdo_insert.php');

//TODO: использовать вместо запроса данные сессии
$check_admin = $pdo->prepare('
select * from user where id = :logedin_user_id
and rights_id = 2
');
$check_admin->execute(array( ':logedin_user_id' => $_SESSION['user']['id']));
$res_check_admin = $check_admin->fetchAll(PDO::FETCH_ASSOC);

if(count($res_check_admin) != 0) {
    echo '<li class="nav-item">
                    <a class="nav-link" href="../pages/show_players.php">Просмотреть всех пользователей</a>
                </li>';
}

