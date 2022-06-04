<?php
session_start();

include 'helpers.php';

if (!isset($_SESSION['token'])) {
} else {
    $now = time();
    
    if ($now > $_SESSION['expire']) {
        echo "<p align='center'>Session has been destoryed!!";
        header("Location: " . BASE_URL . 'actions/logout.php');
        exit();
    }
}

$menu = isset($_GET['menu']) ? $_GET['menu'] : 'home';

switch ($menu) {
    case 'home':
        $title = 'Home | Taniver GG';
        $content = 'views/home_view.php';
        break;
    case 'detail':
        $title = 'Detail Game | Taniver GG';
        $content = 'views/detail_game_view.php';
        break;
    case 'add_game':
        $title = 'Add Game | Taniver GG';
        $content = 'views/add_game_view.php';
        break;
    case 'login':
        $title = 'Login | Taniver GG';
        $content = 'views/login_view.php';
        break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title><?= $title; ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASE_URL ?>">Taniver</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= BASE_URL ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (!isset($_SESSION['token']) && $menu !== 'login') { ?>
                            <a class="nav-link" href="<?= BASE_URL  . '?menu=login' ?>" rel="noopener noreferrer">Login</a>
                        <?php }
                        ?>
                    </li>
                    <?php
                    if (isset($_SESSION['token'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL  . '?menu=add_game' ?>" rel="noopener noreferrer">Add Games</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL  . 'actions/logout.php' ?>" rel="noopener noreferrer">Logout</a>
                        </li>
                    <?php }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div>



    </div>
    <?php include $content ?>
</body>

</html>