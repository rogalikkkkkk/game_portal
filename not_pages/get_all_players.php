<?php

require_once ('pdo_insert.php');

$all_players = $pdo->prepare('
select user_id, login, password, email, r.right as rig, rating from full_user_info fui join rights r on r.id = fui.rights_id
where r.id = 1
');
$all_players->execute();
$res_all_players = $all_players->fetchAll(PDO::FETCH_ASSOC);


