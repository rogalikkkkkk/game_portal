<?php
//session_start();
//
//$pdo = new PDO("mysql:host=localhost;dbname=portal_db", 'root', 'vertrigo');
//$params = array(':username' => 'EmilMemil', ':email' => 'test@gmail.com');
//
//$tst = $pdo->prepare('
//    select * from user
//    where login = "Lizuha"
//    ');
//
//$tst->execute();
//$res = $tst->fetchAll(PDO::FETCH_ASSOC);
//
//$liz = $res[0]['login'];
//$points = $res[0]['password'];
//
//
//$param_game_id = array(':game_id' => 1);
//
//$game_name_by_id = $pdo->prepare('
//select * from game
//where id = :game_id
//');
//$game_name_by_id->execute($param_game_id);
//$res_game_name_by_id = $game_name_by_id->fetchAll(PDO::FETCH_ASSOC);
//
//
//$hosted_lobbys = $pdo->prepare('
//select * from session
//where user_profile_id = 1
//');
//$hosted_lobbys->execute();
//$res_hosted_lobbys = $hosted_lobbys->fetchAll(PDO::FETCH_ASSOC);
//
//
//
//
//
//
//
//
//$my_games_info = $pdo->prepare('
//select
//(select name from game
//where id = s.game_id) as game_name,
//    s.time as time,
//    s.bet as bet,
//(select name from status
//where id = s.status_id) as status_name
//
//
//from (
//    select * from session
//             where user_profile_id = 1
//) as s
//');
//$my_games_info->execute();
//$res_my_games_info = $my_games_info->fetchAll(PDO::FETCH_ASSOC);
//$params_new_session = array(':chosen_game_id' => $_POST['gam_nam'], ':logedin_user' => $_SESSION['user']['profile_id'],
//    ':chosen_date' => "'" . $_POST['game_dt'] . ":00'", ':chosen_gam_num' => $_POST['gam_num'], ':chosen_bet' => $_POST['gam_bet']);
//print_r($params_new_session);