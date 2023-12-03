<?php

    require_once("Movie.php");
    interface IMovieDAO
    {
        public function buildMovie($data);
        public function findAll();
        public function getLatestMovies();
        public function getMoviesByCategory($category);
        public function getMovieByUserId($id);
        public function findById($id);
        public function findByTitle($title);
        public function create(Movie $movie);
        public function update(Movie $movie);
        public function destroy($id);

    }
?>