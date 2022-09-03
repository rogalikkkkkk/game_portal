<?php
session_start();

$params_new_session = array(':chosen_game_id' => $_POST['gam_nam'], ':logedin_user' => $_SESSION['user']['profile_id'],
    ':chosen_date' => $_POST['game_dt'] . ":00", ':chosen_gam_num' => $_POST['gam_num'], ':chosen_bet' => $_POST['gam_bet']);

print_r($params_new_session);
require_once ('pdo_insert.php');

$gam_num_diaposon = $pdo->prepare('
select users_min, users_max from game
where id = :chosen_game_id
');
$gam_num_diaposon->execute(array(':chosen_game_id' => $_POST['gam_nam']));
$res_gam_num_diaposon = $gam_num_diaposon->fetchAll(PDO::FETCH_ASSOC);

if ($_POST['gam_num'] < $res_gam_num_diaposon[0]['users_min']
|| $_POST['gam_num'] > $res_gam_num_diaposon[0]['users_max']) {
$_SESSION['not_valid_gam_num_message'] = 'Для данной игры указанное число игроков недоступно';
} else {
    $create_new_session_sql = $pdo->prepare('
    insert into session (game_id, user_profile_id, time, members_number, bet)  value (:chosen_game_id, :logedin_user, :chosen_date, :chosen_gam_num, :chosen_bet)
    ');
    $create_new_session_sql->execute($params_new_session);

    $get_created_session = $pdo->prepare('
    select * from session where game_id = :chosen_game_id and user_profile_id = :logedin_user and time = :chosen_date
        and members_number = :chosen_gam_num and bet = :chosen_bet
    ');
    $get_created_session->execute($params_new_session);
    $sess_id = $get_created_session->fetchAll(PDO::FETCH_ASSOC)[0]['id'];

    $params_new_sup = array(':new_session_id' =>  $sess_id, ':logedin_user' => $_SESSION['user']['profile_id'], ':chosen_bet' => $_POST['gam_bet']);

    $create_new_sup_sql = $pdo->prepare('
    insert into session_user_profile (session_id, user_profile_id, prize, user_status_id) 
        value (:new_session_id, :logedin_user, :chosen_bet, 2) 
    ');
    $create_new_sup_sql->execute($params_new_sup);
}
header('Location: ../pages/my_games.php');

