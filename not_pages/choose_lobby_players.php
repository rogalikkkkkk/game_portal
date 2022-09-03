<?php

require_once ('pdo_insert.php');

$params_joining_lobby = array(':logedin_user_id' => $_SESSION['user']['profile_id'],
    ':chosen_session_id' => $_POST['my_games_session_id']);

$users_wants_in_lobby = $pdo->prepare('
select session_id, user_profile_id,
(select login from user as u join user_profile p on u.id = p.user_id
where p.id = sup.user_profile_id) as login,
(select rating from user_profile as up where up.id = sup.user_profile_id) as rating
from session_user_profile as sup
where session_id = :chosen_session_id 
and user_profile_id != :logedin_user_id
and user_status_id in (2, 3)
');
$users_wants_in_lobby->execute($params_joining_lobby);
$res_users_wants_in_lobby = $users_wants_in_lobby->fetchAll(PDO::FETCH_ASSOC);

