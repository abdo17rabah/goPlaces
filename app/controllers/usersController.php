<?php
    //require_once('../classes/User.php');

    // var_dump('../database\Database.php');
    // die;

    require_once('../database/Database.php');
    // $db = new Database('localhost', 'goPlaces', 'ipssi', 'ipssi');
    // $connexionDb = $db->getConnection();
    var_dump($ok);
    die;
    // include('../classes/Database.php');

    // function connectToDb() {
    //     //connection BDD paramètre : Host, port, dbname, identifiant, mdp
    //     $dbHost="localhost";
    //     $port=3306;
    //     $dbname="ipssi_php_db";
    //     $iden="root";
    //     $mdp="";
    //     try {
    //         $connexionDb = new PDO('mysql:host='.$dbHost.';port='.$port.';dbname='.$dbname,$iden,$mdp);
    //         return $connexionDb;
    //     } catch (PDOException $excep) {
    //         return $excep;
    //     }
    // }

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
        $age = $_POST['age'];
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
?>