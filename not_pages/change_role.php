<?php
session_start();

require_once ('pdo_insert.php');

if ($_POST['op_num'] == 1) {
    $make_user_admin = $pdo->prepare('
    update user set rights_id = 2
    where user.id = :selected_user_id
    ');
    $make_user_admin->execute(array(':selected_user_id' => $_POST['user_id']));

    $create_new_admin = $pdo->prepare('
    insert into admin (user_id, lastname) value (:selected_user_id, :admins_surname)
    ');
    $create_new_admin->execute(array(':selected_user_id' => $_POST['user_id'], ':admins_surname' => $_POST['admin_surname']));

} else if ($_POST['op_num'] == 2) {
    $make_admin_user = $pdo->prepare('
    update user set rights_id = 1
    where user.id = :selected_user_id
    ');
    $make_admin_user->execute(array(':selected_user_id' => $_POST['user_id']));

    $delete_admin = $pdo->prepare('
    delete from admin where user_id = :selected_user_id
    ');
    $delete_admin->execute(array(':selected_user_id' => $_POST['user_id']));
}

header('Location: ../pages/show_all_users.php');

//print_r($_POST['user_id']);