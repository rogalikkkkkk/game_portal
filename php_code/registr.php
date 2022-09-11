<?php
session_start();

$login = $_REQUEST['login'];
$password = $_REQUEST['password'];
$email = $_REQUEST['email'];
$param_register_user = array(':user_login' => $login, ':user_password' => $password, ':user_email' => $email);

require_once('../not_pages/pdo_insert.php');

$check_existing_user = $pdo->prepare('
select id, login, password from user
where login = :user_login
');
$check_existing_user->execute(array(':user_login' => $login));
$res_check_existing_user = $check_existing_user->fetchAll(PDO::FETCH_ASSOC);

if (count($res_check_existing_user) > 0) {
    $_SESSION['message'] = 'Такой пользователь уже существует';
    header('Location: ../pages/registration.php');
} else {

    $added_user_id = $pdo->prepare('select get_created_user_id(:ulogin, :upassword, :uemail) from dual');
    $added_user_id->execute(array(':ulogin' => $login, ':upassword' => $password, ':uemail' => $email));
    $res_added_user_id = $added_user_id->fetchAll(PDO::FETCH_ASSOC);

    print_r($res_added_user_id);

//    $register_user = $pdo->prepare('
//    insert into user (login, password, email) VALUES (:user_login, :user_password, :user_email)
//    ');
//    $register_user->execute($param_register_user);

    $check_existing_user_by_id = $pdo->prepare('
    select id, login, password from user
    where id = :user_id
    ');
    $check_existing_user_by_id->execute(array(':user_id' => $res_added_user_id[0]["get_created_user_id('".$login."', '".$password."', '".$email."')"]));
    $res_check_existing_user_by_id = $check_existing_user_by_id->fetchAll(PDO::FETCH_ASSOC);

    $check_existing_user->execute(array(':user_login' => $login));
    $res_check_existing_user = $check_existing_user->fetchAll(PDO::FETCH_ASSOC);

    $register_user_profile = $pdo->prepare('
    insert into user_profile (user_id) values (:registred_user_id)
    ');
    $register_user_profile->execute(array(':registred_user_id' => $res_added_user_id[0]["get_created_user_id('".$login."', '".$password."', '".$email."')"]));

    $check_existing_user_profile = $pdo->prepare('
    select id from user_profile
    where user_id = :registred_user_id
    ');
    $check_existing_user_profile->execute(array(':registred_user_id' => $res_added_user_id[0]["get_created_user_id('".$login."', '".$password."', '".$email."')"]));
    $res_check_existing_user_profile = $check_existing_user_profile->fetchAll(PDO::FETCH_ASSOC);

    $_SESSION['user'] = [
        "id" => $res_added_user_id[0]["get_created_user_id('".$login."', '".$password."', '".$email."')"],
        "right_id" => 1,
        "profile_id" => $res_check_existing_user_profile[0]['id']
    ];

    setcookie("login", $res_check_existing_user_by_id[0]['login'], 0, "/");
    setcookie("password", $res_check_existing_user_by_id[0]['password'], 0, "/");

    print_r($res_check_existing_user_by_id[0]['login']);
    header('Location: ../pages/main.php');
}


