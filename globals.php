<?php 
    session_start();
    $BASE_URL = "http://" . $_SERVER["SERVER_NAME"] . ":8080" . dirname($_SERVER["REQUEST_URI"]."?") . "/";
?>