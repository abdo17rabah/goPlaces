<?php
require_once('../class/BDD.php');
session_start();
function connexion()
{
    if (!empty($_POST["email"] && isset($_POST["email"]))) {


        $infoUser = new DBAccess();
        $database = $infoUser->dbConnection();

        if ($infoUser->recupMail($database, $_POST["email"])) {
            session_start();
            $_SESSION['user'] = $infoUser->recupMail($database, $_POST["email"]);
            header('location:../index.php?page=accueil');
        } else {
            header('location:../index.php?page=connexion');
        }
    }
}


function tripDetails($id)
{
    $infoUser = new DBAccess();
    $database = $infoUser->dbConnection();
    $infoUser->getTrip($database, $id);
    // header('location:http://localhost/goPlaces/app/frontend/tripDetails.php');
}
