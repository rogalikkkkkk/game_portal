<?php
require_once ('../not_pages/pdo_insert.php');

$datime = new DateTime(substr(date('c'), 0, -6));
$st = $datime->format('Y-m-d H:i:s');

$check_datetime = $pdo->prepare('
call check_closing(:current_datetime)
');
$check_datetime->execute(array(':current_datetime' => $st));