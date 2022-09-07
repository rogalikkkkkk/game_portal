<?php

require_once ('pdo_insert.php');

$all_users = $pdo->prepare('
select user_id, login, password, email, r.right as rig, rating from full_user_info fui join rights r on r.id = fui.rights_id
where r.id != 3
');
$all_users->execute();
$res_all_users = $all_users->fetchAll(PDO::FETCH_ASSOC);

