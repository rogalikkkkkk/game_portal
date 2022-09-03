<?php
session_start();
$half_joining_params = array(':chosen_session_id' => intval($_POST['session_id']), ':loggedin_user' => intval($_SESSION['user']['profile_id']));

require_once('pdo_insert.php');

$upd_gamer_to_lobby = $pdo->prepare('
update session_user_profile set user_status_id = 1
where session_id = :chosen_session_id and user_profile_id = :loggedin_user
');
$upd_gamer_to_lobby->execute($half_joining_params);

header('Location: ../pages/' . $_POST['back_page']);
