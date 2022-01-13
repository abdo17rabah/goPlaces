<?php
    
    include_once(__DIR__ .'/../database/Database.php');
    include_once(__DIR__ .'/../classes/User.php');
    
    function getAllUsers() {
        // $connexionDb = connectToDb();
        $db = new Database('localhost', 'goPlaces', 'ipssi', 'ipssi');
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
        $password = $_POST['password'];
        $role = 'USER';

        $db = new Database('localhost', 'goPlaces', 'ipssi', 'ipssi');
        $connexionDb = $db->getConnection();

        $requete = $connexionDb->prepare("INSERT INTO user (lastname, firstname, email, password, role) VALUES (:lastname, :firstname, :email, :password, :role)");
        $requete->bindParam(':lastname', $lastName);
        $requete->bindParam(':firstname', $firstName);
        $requete->bindParam(':email', $email);
        $requete->bindParam(':password', $password);
        $requete->bindParam(':role', $role);
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

    // find an user by email. Login function
    function findUserByEmail($email){
        $db = new Database('localhost', 'goPlaces', 'ipssi', 'ipssi');
        $connexionDb = $db->getConnection();
        
        $requete = $connexionDb->prepare("SELECT * FROM user WHERE email = :email");
        $requete->bindParam(':email', $email);
        
        if ($requete->execute()){
            $user = $requete->fetch();
            return new User($user['firstname'], $user['lastname'], $user['email'], $user['password'], $user['role']);
        }else {
            return false;
        }
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