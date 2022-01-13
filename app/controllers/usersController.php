<?php
    //require_once('../classes/User.php');

    function connectToDb() {
        //connection BDD paramètre : Host, port, dbname, identifiant, mdp
        $dbHost="localhost";
        $port=3306;
        $dbname="ipssi_php_db";
        $iden="root";
        $mdp="";
        try {
            $connexionDb = new PDO('mysql:host='.$dbHost.';port='.$port.';dbname='.$dbname,$iden,$mdp);
            return $connexionDb;
        } catch (PDOException $excep) {
            return $excep;
        }
    }

    function getAllUsers() {
        $connexionDb = connectToDb();
        $requete="SELECT * FROM user";
        $result = $connexionDb->query($requete);
        return $result;
    }

    // get all users
    function addUser() {
        $connexionDb = connectToDb();
        $requete = $connexionDb->prepare("INSERT INTO user (nom, prenom, age, email) VALUES (:nom, :prenom, :age, :email)");
        $requete->bindParam(':nom', $lastName);
        $requete->bindParam(':prenom', $firstName);
        $requete->bindParam(':age', $age);
        $requete->bindParam(':email', $email);
        $lastName = $_POST['lastName'];
        $firstName = $_POST['firstName'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        if ($requete->execute()){
            header('location:../frontend/users/indexUsers.php');
        }else {
            echo "erreur d'insertion";
        }
    }

    // get user by id
    function getUserById($idUser) {
        $connexionDb = connectToDb();
        $requete = "SELECT * FROM user WHERE id = $idUser";
        $result = $connexionDb->query($requete);
        return $result;
    }

    // delete user by id
    function deleteUserById($idUser) {
        $connexionDb = connectToDb();
        $requete = $connexionDb->prepare("DELETE FROM user WHERE id = :id");
        $requete->bindParam(':id', $id);
        $id = $idUser;
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