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