<?php
$param_credentials = array(':logedin_user_id' => $_SESSION['user']['profile_id']);

require_once ('pdo_insert.php');

$my_games_info = $pdo->prepare('
select 
id,
(select name from game
where id = s.game_id) as game_name,
    s.time as time,
    s.bet as bet,
(select name from status
where id = s.status_id) as status_name
    
    
from (
    select * from session
             where user_profile_id = :logedin_user_id
             and status_id != 2
) as s
');
$my_games_info->execute($param_credentials);
$res_my_games_info = $my_games_info->fetchAll(PDO::FETCH_ASSOC);
