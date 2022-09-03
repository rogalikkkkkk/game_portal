<?php
session_start();
$half_joining_params = array(':chosen_session_id' => intval($_POST['session_id']), ':loggedin_user' => intval($_SESSION['user']['profile_id']));
$joining_params = array(':chosen_session_id' => intval($_POST['session_id']), ':loggedin_user' => intval($_SESSION['user']['profile_id']),
    ':bet' => intval($_POST['bet']));

require_once('pdo_insert.php');

$chck_existing_sup = $pdo->prepare('
select count(*) as cnt, user_status_id as usi from session_user_profile
where session_id = :chosen_session_id and user_profile_id = :loggedin_user
');
$chck_existing_sup->execute($half_joining_params);
$res_chck_existing_sup = $chck_existing_sup->fetchAll(PDO::FETCH_ASSOC);


if($res_chck_existing_sup[0]['cnt'] == 0) {
    $add_gamer_to_lobby = $pdo->prepare('
    insert into session_user_profile (session_id, user_profile_id, prize, user_status_id) 
    values (:chosen_session_id, :loggedin_user, :bet, 2)
    ');
    $add_gamer_to_lobby->execute($joining_params);
} else if ($res_chck_existing_sup[0]['usi'] == 1) {
    $upd_gamer_to_lobby = $pdo->prepare('
    update session_user_profile set user_status_id = 2
    where session_id = :chosen_session_id and user_profile_id = :loggedin_user
    ');
    $upd_gamer_to_lobby->execute($half_joining_params);
}

header('Location: ../pages/join_game.php');
