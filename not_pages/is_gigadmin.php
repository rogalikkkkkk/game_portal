<?php

require_once ('pdo_insert.php');

//TODO: использовать вместо запроса данные сессии
$check_gigadmin = $pdo->prepare('
select * from user where id = :logedin_user_id
and rights_id = 3
');
$check_gigadmin->execute(array( ':logedin_user_id' => $_SESSION['user']['id']));
$res_check_gigadmin = $check_gigadmin->fetchAll(PDO::FETCH_ASSOC);

if(count($res_check_gigadmin) != 0) {
    echo '<li class="nav-item">
                    <a class="nav-link" href="../pages/show_all_users.php">Просмотреть всех пользователей</a>
                </li>';
}

