<?php

session_start();

require_once ('pdo_insert.php');

$delete_player = $pdo->prepare('
delete from user where login = :user_login
');

foreach ($_POST['user_id'] as &$value) {
    $delete_player->execute(array(':user_login' => $value));
}

header('Location: ../pages/show_players.php');