<?php
session_start();

require_once ('pdo_insert.php');

$from = "sea77030@gmail.com";
$subject = "Запись на игру";

$headers = "Content-type: text/html; charset=utf-8\r\n" . "From: $from" . "\r\n" . "Reply-To: $from" . "\r\n" . "X-Mailer: PHP/" . phpversion();


$get_session_members_number = $pdo->prepare('
select members_number from session 
where id = :chosen_session_id
');
$get_session_members_number->execute(array(':chosen_session_id' => $_POST['chose_session_id']));
$res_get_session_members_number = $get_session_members_number->fetchAll(PDO::FETCH_ASSOC);


$chosen_users_id = array($_SESSION['user']['profile_id']);
$not_chosen_users_id = array();

for ($j=1; $j<=$_POST['all_wanted_users_count']; $j++) {
    if(isset($_POST['user_id_' . $j])) {
        $chosen_users_id[] = $_POST['user_id_' . $j];
    } else {
        $not_chosen_users_id[] = $_POST['unselected_users_' . $j];
    }
}

if(count($chosen_users_id) == $res_get_session_members_number[0]['members_number']) {

    $make_session_equip = $pdo->prepare('
    update session set status_id = 3
    where id = :chosen_session_id
    ');
    $make_session_equip->execute(array(':chosen_session_id' => $_POST['chose_session_id']));

    foreach ($chosen_users_id as &$user) {
        $make_user_in_game = $pdo->prepare('
        update session_user_profile set user_status_id = 3
        where session_id = :chosen_session_id and user_profile_id = :user
        ');
        $make_user_in_game->execute(array(':chosen_session_id' => $_POST['chose_session_id'],
            ':user' => $user));

        $this_user_email = $pdo->prepare('
        select email from full_user_info
        where id = :user
        ');
        $this_user_email->execute(array(':user' => $user));
        $res_this_user_email = $this_user_email->fetchAll(PDO::FETCH_ASSOC);
        $to = $res_this_user_email[0]['email'];
        $this_session_time = $pdo->prepare('
        select time from session where id = :chosen_session_id
        ');
        $this_session_time->execute(array(':chosen_session_id' => $_POST['chose_session_id']));
        $res_this_session_time = $this_session_time->fetchAll(PDO::FETCH_ASSOC);
        $message = 'Вы будете участвовать в игре в' . $res_this_session_time[0]['time'] . 'Не забудьте!';
        mail($to, $subject, $message, $headers);
    }

    foreach ($not_chosen_users_id as &$user) {
        $make_user_in_game = $pdo->prepare('
        update session_user_profile set user_status_id = 1
        where session_id = :chosen_session_id and user_profile_id = :user
        ');
        $make_user_in_game->execute(array(':chosen_session_id' => $_POST['chose_session_id'],
            ':user' => $user));

    }
    header('Location: ../pages/my_games.php');
} else {
    $_SESSION['wrong_chosen_gam_num'] = 'Выбрано некорректное число пользователей';

    echo '
    <form action="../pages/choose_players.php" method="post" id="skip">
        <input type="hidden" id="skip" name="my_games_session_id" value="' . $_POST['chose_session_id'] . '">
    </form>
    <script>
        document.getElementById("skip").submit();
    </script>
    ';
}
