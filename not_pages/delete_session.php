<?php
session_start();

require_once ('pdo_insert.php');

$delete_session = $pdo->prepare('
delete from session where session.id = :chosen_delete_session_id
');
$delete_session->execute(array(':chosen_delete_session_id' => $_POST['my_games_session_id_delete']));
header('Location: ../pages/my_games.php');
