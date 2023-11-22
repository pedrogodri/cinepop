<?php 
    require_once("globals.php");
    require_once("db.php");
    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);
    
    $type = filter_input(INPUT_POST, "type");

    if($type === "register") {
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirm_password = filter_input(INPUT_POST, "confirmpassword");

        if($name && $lastname && $email && $password) {
            if($password === $confirm_password) {

            } else {
                $message->setMessage("As senhas não são iguais", "alert-danger", "back");
            }

        } else {
            $message->setMessage("Por favor, preencha todos os campos", "alert-danger", "back");
        }
    } else if($type === "login") {
    }
?>