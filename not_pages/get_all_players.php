<?php

require_once ('pdo_insert.php');

$all_players = $pdo->prepare('
select user.id, login, password, email, r.right as rig, rating from user join user_profile up on user.id = up.user_id join rights r on r.id = user.rights_id
where r.id = 1
');
$all_players->execute();
$res_all_players = $all_players->fetchAll(PDO::FETCH_ASSOC);


