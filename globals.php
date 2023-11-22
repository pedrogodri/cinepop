<?php 
    session_start();
    $BASE_URL = "http://" . $_SERVER["SERVER_NAME"] . ":80" . dirname($_SERVER["REQUEST_URI"]."?") . "/";
?>