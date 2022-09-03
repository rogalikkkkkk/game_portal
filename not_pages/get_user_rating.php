<?php
$param_credentials = array(':logedin_user_id' => $_SESSION['user']['id']);

require_once ('pdo_insert.php');

$user_rating = $pdo->prepare('
select rating from user_profile
where user_id = :logedin_user_id
');
$user_rating->execute($param_credentials);
$res_user_rating = $user_rating->fetchAll(PDO::FETCH_ASSOC);
