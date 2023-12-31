<?php 

    require_once("models/IUserDAO.php");
    require_once("models/Message.php");

    class UserDAO implements IUserDAO {

        private $conn;
        private $url;
        private $message;

        public function __construct(PDO $conn, $url) { 
            $this->conn = $conn;
            $this->url = $url;
            $this->message = new Message($url);
        }

        public function buildUser($data) {
            $user = new User();
            $user->id = $data["id"];
            $user->name = $data["name"];
            $user->lastname = $data["lastname"];
            $user->email = $data["email"];
            $user->password = $data["password"];
            $user->image = $data["image"];
            $user->bio = $data["bio"];
            $user->token = $data["token"];

            return $user;
        }
        public function create(User $user, $authUser = false) {
            $stmt = $this->conn->prepare("INSERT INTO users(name, lastname, email, password, token) VALUES (:name, :lastname, :email, :password, :token)");
            $stmt->bindParam(":name", $user->name);
            $stmt->bindParam(":lastname", $user->lastname);
            $stmt->bindParam(":email", $user->email);
            $stmt->bindParam(":password", $user->password);
            $stmt->bindParam(":token", $user->token);

            $stmt->execute();

            if($authUser) {
                $this->setTokenSession($user->token);
            }
        }
        public function update(User $user, $redirect = false) {
            $stmt = $this->conn->prepare("UPDATE users SET
            name = :name,
            lastname = :lastname,
            email = :email,
            image = :image,
            bio = :bio,
            token = :token
            WHERE id = :id");
            // $stmt->bind_param("ssii", $nome, $sobrenmome);
            $stmt->bindParam(":id", $user->id);
            $stmt->bindParam(":name", $user->name);
            $stmt->bindParam(":lastname", $user->lastname);
            $stmt->bindParam(":email", $user->email);
            $stmt->bindParam(":image", $user->image);
            $stmt->bindParam(":bio", $user->bio);
            $stmt->bindParam(":token", $user->token);

            $stmt->execute();

            if($redirect) {
                $this->message->setMessage("Perfil atualizado com sucesso", "alert-success", "editprofile.php");
            }
        }
        public function verifyToken($protected = true) {
            if(!empty($_SESSION["token"])) {
                $token = $_SESSION["token"];
                $user = $this->findByToken($token);

                if($user) {
                    return $user;
                } else if($protected) {
                    $this->message->setMessage("Faça a autentificação para acesar esta página!", "alert-danger", "index.php");
                }
            } else if($protected) {
                $this->message->setMessage("Faça a autentificação para acesar esta página!", "alert-danger", "index.php");
            }
        }
        public function setTokenSession($token, $redirect = true) {
            $_SESSION["token"] = $token;

            if($redirect) {
                $this->message->setMessage("Seja bem-vindo!", "alert-success", "editprofile.php");
            }
        }
        public function authenticateUser($email, $password) {
            $user = $this->findByEmail($email);
            if($user) {
                if(password_verify($password, $user->password)) {
                    $token = $user->generateToken();
                    $this->setTokenSession($token, false);

                    $user->token = $token;
                    $this->update($user, false);
                    
                    return true;
                } else {
                    return false;   
                }
            } else {
                return false;
            }
        }
        public function findByToken($token) {
            if($token != "") {
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
                $stmt->bindParam(":token", $token);
                $stmt->execute();
                
                if($stmt->rowCount() > 0) {
                    $data = $stmt->fetch();
                    $user = $this->buildUser($data);
                    return $user;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        public function findByEmail($email) {
            if($email != "") {
                $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
                $stmt->bindParam(":email", $email);
                $stmt->execute();
                
                if($stmt->rowCount() > 0) {
                    $data = $stmt->fetch();
                    $user = $this->buildUser($data);
                    return $user;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
        public function findById($user) {

        }

        public function destroyToken() {
            $_SESSION["token"] = "";

            $this->message->setMessage("Você saiu", "alert-success", "index.php");
        }
        public function changePassword(User $user) {
            $stmt = $this->conn->prepare("UPDATE users SET password = :password WHERE id = :id");
            $stmt->bindParam(":id", $user->id);
            $stmt->bindParam(":password", $user->password);

            $stmt->execute();

            $this->message->setMessage("Senha alterada com sucesso!", "alert-success", "editprofile.php");
        }
    }

?>