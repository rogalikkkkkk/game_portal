<?php
session_start();
$login = $_REQUEST['login'];
$password = $_REQUEST['password'];
$param_credentials = array(':user_login' => $login, ':user_password' => $password);

require_once ('../not_pages/pdo_insert.php');

$check_cred = $pdo->prepare('
select id, login, password, rights_id from user
where login = :user_login and password = :user_password
');
$check_cred->execute($param_credentials);
$res_check_cred = $check_cred->fetchAll(PDO::FETCH_ASSOC);

if (count($res_check_cred) == 0) {
    $_SESSION['message'] = 'Неверный логин или пароль';
    header('Location: ../index.php');
} else {
    $get_user_profile_id = $pdo->prepare('
    select * from user_profile
    where user_id = :checked_user_id
    ');
    $get_user_profile_id->execute(array(':checked_user_id' => $res_check_cred[0]['id']));
    $res_get_user_profile_id = $get_user_profile_id->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['user'] = [
        "id" => $res_check_cred[0]['id'],
        "right_id" => $res_check_cred[0]['rights_id'],
        "profile_id" => $res_get_user_profile_id[0]['id']
    ];

    setcookie("login", $login, 0, "/");
    setcookie("password", $password, 0, "/");

    header('Location: ../pages/main.php');
}