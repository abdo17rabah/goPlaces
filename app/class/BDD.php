<?php
// connexion avec mysqli 
class DBAccess
{

    public static function dbConnection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "goplaces";

        // création de la connexion avec la classe mysqli
        $mysqli = new mysqli($servername, $username, $password, $dbName);

        // vérification connection
        if ($mysqli->connect_error) {
            die("Echec de la connection: " . $mysqli->connect_error);
        }
        return $mysqli;
    }

    // Get all trips
    public static function getTrips($mysqli)
    {
        $sql = "SELECT * FROM trip";
        return $mysqli->query($sql);
    }

    // Get one trip
    public static function getTrip($mysqli, $id)
    {
        $sql = ("SELECT * FROM trip WHERE id = $id");
        return $mysqli->query($sql);
    }

    /**
     * examples de prof 
     */
    //récupération des utilisateurs en BDD
    public static function afficherUsers($mysqli)
    {
        $sql = "SELECT * FROM user";
        return $mysqli->query($sql);
    }

    //récupération d'un utilisateur en BDD
    public static function afficherUser($mysqli, $id)
    {
        //requete non préparé Attention Dangereux => risque d'injection SQL
        $sql = "SELECT * FROM user WHERE id = $id";
        return $mysqli->query($sql);
    }

    public static function recupMail($mysqli, $mail)
    {
        //requete non préparé Attention Dangereux => risque d'injection SQL
        $sql = "SELECT * FROM user WHERE email = '$mail'";
        return $mysqli->query($sql);
    }

    //ajout d'un utilisateur en BDD
    public static function addUser($mysqli, $nom, $prenom, $age, $email)
    {
        // Ici requete préparé => permet d'éviter l'injection sql
        // ici je ne mets pas d'ajout id car il est auto-incrémenté en base de données
        $stmt = mysqli_prepare($mysqli, "INSERT INTO `user` (nom, prenom, age, email) VALUES (?, ?, ?, ?)");
        //on aurait pu créer une classe user, si c'est le cas, on aurait pas utilisé la fonction
        //mysqli_stmt_bind_param() mais plutôt $stmt->bind_param()
        // 'ssis' signifie : string string integer string 
        mysqli_stmt_bind_param($stmt, 'ssis', $nomIncrement, $prenomIncrement, $ageIncrement, $emailIncrement);
        $nomIncrement = $nom;
        $prenomIncrement = $prenom;
        // ici le intval() va permettre de convertir le string en int
        $ageIncrement = intval($age);
        $emailIncrement = $email;
        // la fonction ne retourne rien car son objectif est juste d'envoyer en bdd
        $stmt->execute();
        // Fermeture de la connexion
        $mysqli->close();
        // header('location') pour renvoyer sur la page que l'on souhaite
    }

    public static function updateUser($mysqli, $id, $nom, $prenom, $age, $email)
    {
        $stmt = mysqli_prepare($mysqli, "UPDATE user SET nom = ?, prenom = ?, age = ?, email = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'ssisi', $nomIncrement, $prenomIncrement, $ageIncrement, $emailIncrement, $idIncrement);
        $idIncrement = $id;
        $nomIncrement = $nom;
        $prenomIncrement = $prenom;
        $ageIncrement = intval($age);
        $emailIncrement = $email;
        $stmt->execute();
        $mysqli->close();
    }

    public static function deleteUser($mysqli, $id)
    {
        $stmt = mysqli_prepare($mysqli, "DELETE FROM `user` WHERE `id` = ?");
        mysqli_stmt_bind_param($stmt, 'i', $idIncrement);
        $idIncrement = $id;
        $stmt->execute();
        $mysqli->close();
    }
}
