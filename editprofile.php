<?php 
    require_once("templates/header.php");
    require_once("models/User.php");
    require_once("dao/UserDAO.php");

    $userDAO = new UserDAO($conn, $BASE_URL);
    $userData = $userDAO->verifyToken(true);
    $user = new User();

    $fullName = $user->getfullName($userData);

    if($userData->image == "") {
        $userData->image = "user.png";
    }
?>

<div id="main-container" class="container-fluid">
    <div class="col-md-12">
        <form action="<?=$BASE_URL ?>user_process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update">
            <div class="row">
                <div class="col-md-4">
                    <h1><?= $fullName ?></h1>
                    <p class="page-description">Altera seus dados no formulário abaixo:</p>
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome" value="<?= $userData->name ?>">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Sobrenome:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite seu sobrenome" value="<?= $userData->lastname ?>">
                    </div>
                    <div class="form-group">
                        <label for="lastname">E-mail:</label>
                        <input type="text" class="form-control disabled" id="email" name="email" placeholder="Digite seu e-mail" value="<?= $userData->email ?>" readonly>
                    </div>
                    <input type="submit" class="btn form-btn" value="Alterar">
                </div>
                <div class="col-md-4">
                    <div id="profile-img-container" style="background-image: url('<?=$BASE_URL ?>img/users/<?= $userData->image?>');"></div>
                    <div class="form-group">
                        <label for="image">Foto:</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label for="bio">Sobre você:</label>
                        <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Conte quem você é, o que faz e onde trabalha...">
                        <?= $userData->bio?>
                        </textarea>
                    </div>
                </div>
            </div>
        </form> 
    </div>
</div>

<?php 
    require_once("templates/footer.php");
?>
