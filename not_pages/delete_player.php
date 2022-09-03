<?php

session_start();

require_once ('pdo_insert.php');

$delete_player = $pdo->prepare('
delete from user where id = :user_id
');
$delete_player->execute(array(':user_id' => $_POST['user_id']));

header('Location: ../pages/show_players.php');