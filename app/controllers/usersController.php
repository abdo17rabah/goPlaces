<?php

    include(__DIR__ .'/../database/Database.php');
    require_once (__DIR__ .'/../../environment.php');
    include_once(__DIR__ .'/../models/user/User.php');

    function getAllUsers() {
        $db = new Database($_ENV["SERVER"], $_ENV["DB"], $_ENV["USER"], $_ENV["PASSWORD"]);
        $connexionDb = $db->getConnection();
        $requete="SELECT * FROM user";
        $result = $connexionDb->query($requete);
        return $result;
    }

    // get all users
    function addUser($nameSession) {
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = 'USER';

        $db = new Database($_ENV["SERVER"], $_ENV["DB"], $_ENV["USER"], $_ENV["PASSWORD"]);
        $connexionDb = $db->getConnection();

        $requete = $connexionDb->prepare("INSERT INTO user (lastname, firstname, email, password, role) VALUES (:lastname, :firstname, :email, :password, :role)");
        $requete->bindParam(':lastname', $lastName);
        $requete->bindParam(':firstname', $firstName);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':password', $password);
        $requete->bindParam(':role', $role);
        if ($requete->execute()){
            header('location:../frontend/users/indexUsers.php?sess='.$nameSession);
        }else {
            echo "erreur d'insertion";
        }
    }

    // get user by id
    function getUserById($idUser) {
      $db = new Database($_ENV["SERVER"], $_ENV["DB"], $_ENV["USER"], $_ENV["PASSWORD"]);
        $connexionDb = $db->getConnection();

        $requete = "SELECT * FROM user WHERE id = $idUser";
        $result = $connexionDb->query($requete);
        return $result;
    }

    // delete user by id
    function deleteUserById($idUser, $nameSession) {
      $db = new Database($_ENV["SERVER"], $_ENV["DB"], $_ENV["USER"], $_ENV["PASSWORD"]);
        $connexionDb = $db->getConnection();

        $requete = $connexionDb->prepare("DELETE FROM user WHERE id = :id");
        $requete->bindParam(':id', $idUser);

        if ($requete->execute()){
            header('location:../frontend/users/indexUsers.php?sess='.$nameSession);
        }else {
            echo "erreur de suppression";
        }
    }

    // update user by id
    function updateUserById($idUser, $nameSession) {
        var_dump($_POST);
        $firstname = htmlspecialchars($_POST['firstName']);
        $lastname = htmlspecialchars($_POST['lastName']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

      $db = new Database($_ENV["SERVER"], $_ENV["DB"], $_ENV["USER"], $_ENV["PASSWORD"]);
        $connexionDb = $db->getConnection();

        $query = $connexionDb->prepare("UPDATE user SET firstname=:firstname, lastname=:lastname, email=:email, password=:password WHERE id = :id");
        $res = $query->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password,
            'id' => $idUser
        ]);

        if ($res){
            header('location:../frontend/users/indexUsers.php?sess='.$nameSession);
        }else {
            return false;
        }
    }

    // find an user by email. Login function
    function findUserByEmail($email){
      $db = new Database($_ENV["SERVER"], $_ENV["DB"], $_ENV["USER"], $_ENV["PASSWORD"]);
        $connexionDb = $db->getConnection();

        $requete = $connexionDb->prepare("SELECT * FROM user WHERE email = :email");
        $requete->bindParam(':email', $email);

        if ($requete->execute()){
            $user = $requete->fetch();
            return new User($user['id'], $user['firstname'], $user['lastname'], $user['email'], $user['password'], $user['role']);
        }else {
            return false;
        }
    }

    if(isset($_GET['action'])){
        switch($_GET['action']){
            case "addUser":
                addUser($nameSession);
                break;
            case "deletUserById":
                deleteUserById($_GET['id'], $nameSession);
                break;
            case 'updateUser':
                updateUserById($_GET['id'], $nameSession);
                break;
        }
    }
