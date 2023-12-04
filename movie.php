<?php 
    require_once("templates/header.php");

    require_once("models/Movie.php");
    require_once("dao/MovieDAO.php");

    $id = filter_input(INPUT_GET, "id");
    $movie;
    $movieDAO = new MovieDAO($conn, $BASE_URL);

    if(empty($id)) {
        $message->setMessage("O filme não foi encontrado", "alert-danger", "index.php");
    } else {
        $movie = $movieDAO->findById($id);

        if(!$movie) {
            $message->setMessage("O filme não foi encontrado", "alert-danger", "index.php");
        }
    }

    $userOwnsMovie = false;

    if(!empty($userData)) {
        if($userData->id === $movie->users_id) {
            $userOwnsMovie = true;
        }
    }


?>

<div id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-1 col-md-6 movie-container">
            <h1 class="page-title"><?= $movie->title ?></h1>
            <p class="movie-details">
                <span>Duração: <?= $movie->length ?></span>
                <span class="pipe"></span>
                <span><?= $movie->category ?></span>
                <span class="pipe"></span>
                <span><i class="fas fa-star"></i>9</span>
            </p>
        </div>
    </div>
</div>

<?php
    require_once("templates/footer.php");
?>