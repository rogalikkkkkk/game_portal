<?php
$param_credentials = array(':logedin_user_id' => $_SESSION['user']['profile_id']);

require_once ('pdo_insert.php');


$my_history_info = $pdo->prepare('
select 
(select name from game
where id = source.game_id) as game_name,
    time,
    prize
from (select time, prize, game_id from ((select * from session_user_profile
               where user_profile_id = :logedin_user_id) as sup join session on (session.id = sup.session_id))) as source
');
$my_history_info->execute($param_credentials);
$res_my_history_info = $my_history_info->fetchAll(PDO::FETCH_ASSOC);