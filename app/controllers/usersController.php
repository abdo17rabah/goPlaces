<?php

    include(__DIR__ .'/../database/Database.php');
    require_once (__DIR__ .'/../../environment.php');

    function getAllUsers() {
        $db = new Database($_ENV["SERVER"], $_ENV["DB"], $_ENV["USER"], $_ENV["PASSWORD"]);
        $connexionDb = $db->getConnection();
        $requete="SELECT * FROM user";
        $result = $connexionDb->query($requete);
        return $result;
    }

    // get all users
    function addUser() {
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $email = $_POST['email'];

        $db = new Database('localhost', 'goPlaces', 'ipssi', 'ipssi');
        $connexionDb = $db->getConnection();

        $requete = $connexionDb->prepare("INSERT INTO user (lastname, firstname, email) VALUES (:lastname, :firstname, :email)");
        $requete->bindParam(':lastname', $lastName);
        $requete->bindParam(':firstname', $firstName);
        $requete->bindParam(':email', $email);
        if ($requete->execute()){
            header('location:../frontend/users/indexUsers.php');
        }else {
            echo "erreur d'insertion";
        }
    }

    // get user by id
    function getUserById($idUser) {
        $db = new Database('localhost', 'goPlaces', 'ipssi', 'ipssi');
        $connexionDb = $db->getConnection();

        $requete = "SELECT * FROM user WHERE id = $idUser";
        $result = $connexionDb->query($requete);
        return $result;
    }

    // delete user by id
    function deleteUserById($idUser) {
        $db = new Database('localhost', 'goPlaces', 'ipssi', 'ipssi');
        $connexionDb = $db->getConnection();

        $requete = $connexionDb->prepare("DELETE FROM user WHERE id = :id");
        $requete->bindParam(':id', $idUser);

        if ($requete->execute()){
            header('location:../frontend/users/indexUsers.php');
        }else {
            echo "erreur de suppression";
        }
    }

    // update user by id
    function updateUserById($idUser) {
        echo $idUser;
    }

    if(isset($_GET['action'])){
        switch($_GET['action']){
            case "addUser":
                addUser();
                break;
            case "deletUserById":
                deleteUserById($_GET['id']);
                break;
            case "updateUser":
                updateUserById($_GET['id']);
                break;
        }
    }
?>
