<?php

require_once ('pdo_insert.php');

$all_users = $pdo->prepare('
select user.id, login, password, email, r.right as rig, rating from user join user_profile up on user.id = up.user_id join rights r on r.id = user.rights_id
where r.id != 3
');
$all_users->execute();
$res_all_users = $all_users->fetchAll(PDO::FETCH_ASSOC);

