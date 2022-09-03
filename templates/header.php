<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08"
                aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="main.php">GamePortal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['user']['right_id'] != 1) {
                        echo 'disabled';} ?>" href="my_games.php">Мои игры</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['user']['right_id'] != 1) {
                        echo 'disabled';} ?>" href="join_game.php">Присоединиться к игре</a>
                </li>
                <?php
                require_once ('../not_pages/is_gigadmin.php');
                ?>
                <?php
                require_once ('../not_pages/is_admin.php');
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="my_profile.php">Мой профиль</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
