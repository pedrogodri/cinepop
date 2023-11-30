<?php 
    require_once("globals.php");
    require_once("db.php");
    require_once("models/User.php");
    require_once("models/Message.php");
    require_once("dao/UserDAO.php");

    $message = new Message($BASE_URL);

    $userDAO = new UserDAO($conn, $BASE_URL);
    
    $type = filter_input(INPUT_POST, "type");

    if($type === "register") {
        $name = filter_input(INPUT_POST, "name");
        $lastname = filter_input(INPUT_POST, "lastname");
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");
        $confirm_password = filter_input(INPUT_POST, "confirmpassword");

        if($name && $lastname && $email && $password) {
            if($password === $confirm_password) {
                if($userDAO->findByEmail($email) === false) {
                    $user = new User();
                    
                    $userToken = $user->generateToken();
                    $finalPasword = $user->generatePassword($password);
                    
                    $user->name = $name;
                    $user->lastname = $lastname;
                    $user->email = $email;
                    $user->password = $finalPasword;
                    $user->token = $userToken;

                    $auth = true;

                    $userDAO->create($user, $auth);
                } else {
                    $message->setMessage("Usuário já cadastrado, tente novamente.", "alert-danger", "back");
                }
            } else {
                $message->setMessage("As senhas não são iguais", "alert-danger", "back");
            }

        } else {
            $message->setMessage("Por favor, preencha todos os campos", "alert-danger", "back");
        }
    } else if($type === "login") {
        $email = filter_input(INPUT_POST, "email");
        $password = filter_input(INPUT_POST, "password");

        if($userDAO->authenticateUser($email, $password)) {
            $message->setMessage("Seja bem-vindo!", "alert-success", "editprofile.php");
        } else {
            $message->setMessage("Email ou senha incorretos", "alert-danger", "back");
        }
    } else {
        $message->setMessage("Informações inválidas", "alert-danger", "index.php");
    }
?>