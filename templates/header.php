<?php
    require_once("globals.php");
    require_once("db.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);

    $flassMessage = $message->getMessage();

    if(!empty($flassMessage["msg"])) {
        $message->clearMessage();
    }

    $userDAO = new UserDAO($conn, $BASE_URL);
    $userData = $userDAO->verifyToken(false);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinePop</title>
    <link rel="shortcut icon" href="<?= $BASE_URL ?>img/logo.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles.css">
</head>

<body>
    <header>
        <nav class="navbar bg-body-tertiary bg-color-header bold">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= $BASE_URL ?>index.php">
                    <img src="<?= $BASE_URL ?>img/logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                    <span class="text-white">Cinepop</span> 
                </a>
                <ul class="nav justify-content-center">
                    <?php if($userData): ?>
                        <li class="nav-item lista-hover">
                            <a class="nav-link active text-white " aria-current="page" href="<?= $BASE_URL ?>newmovie.php">
                                <i class="far fa-plus-square"></i>
                                Incluir Filmes
                            </a>
                        </li>
                        <li class="nav-item lista-hover">
                            <a class="nav-link active text-white " aria-current="page" href="<?= $BASE_URL ?>dashboard.php">
                                Meus Filmes
                            </a>
                        </li>
                        <li class="nav-item lista-hover">
                            <a class="nav-link bold text-white " aria-current="page" href="<?= $BASE_URL ?>editprofile.php">
                                <?= $userData->name ?>
                            </a>
                        </li>
                        <li class="nav-item lista-hover">
                            <a class="nav-link active text-white " aria-current="page" href="<?= $BASE_URL ?>logout.php">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Sair
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item lista-hover">
                            <a class="nav-link active text-white " aria-current="page" href="<?= $BASE_URL ?>auth.php">
                                <i class="fa-solid fa-user"></i>
                                Entrar | Cadastrar
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                <form action="" method="get" class="d-flex justify-content-center" role="search">
                    <input class="form-control me-2" name="q" id="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-green" type="submit"><i class="fas fa-search fa-green"></i></button>
                </form>
            </div>
        </nav>
    </header>
    <?php if (!empty($flassMessage["msg"])) : ?>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
                <div class="msg <?= $flassMessage["type"] ?> alert text-center" role="alert" *ngIf="sucessoFeedback">
                    <?= $flassMessage["msg"] ?>
                </div>
            </div>
        </div>
    <?php endif; ?>