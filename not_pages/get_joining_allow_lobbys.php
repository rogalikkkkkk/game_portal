<?php

require_once('pdo_insert.php');

$my_lobbys_info = $pdo->prepare('
select 
id,
(select name from game
    where id = ses.game_id) as game_name,
time,
bet,
(select login from user join user_profile up on user.id = up.user_id
    where up.id = ses.user_profile_id) as host_name,
(select user_status_id from
session_user_profile right join session s on session_user_profile.session_id = s.id 
    and session_user_profile.user_profile_id = :logedin_user_id 
    where s.id = ses.id) as user_game_status,
status_id as status

from session as ses
where ses.user_profile_id != :logedin_user_id
');
$my_lobbys_info->execute(array(':logedin_user_id' => $_SESSION['user']['profile_id']));
$res_my_lobbys_info = $my_lobbys_info->fetchAll(PDO::FETCH_ASSOC);