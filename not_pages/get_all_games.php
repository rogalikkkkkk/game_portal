<?php

require_once ('pdo_insert.php');

$all_games = $pdo->prepare('
select * from game
');
$all_games->execute();
$res_all_games = $all_games->fetchAll(PDO::FETCH_ASSOC);
