<?php
session_start();

include(__DIR__ . '/../database/Database.php');
require_once(__DIR__ . '/../../environment.php');
$db = new Database($_ENV["SERVER"], $_ENV["DB"], $_ENV["USER"], $_ENV["PASSWORD"]);
$CONNECTIONDB = $db->getConnection();

function createNewReservation()
{
    global $CONNECTIONDB;
    $date = $_POST['date'];
    $price = $_POST['price'];
    $placeReserved = $_POST['placeReserved'];
    $tripId = $_POST['tripId'];
    $userId = $_POST['userId'];

    $requete = $CONNECTIONDB->prepare("INSERT INTO reservation (date, price, place_reserved, trip_id, user_id) VALUES (:date ,:price, :placeReserved, :tripId, :userId)");
    $requete->bindParam(':date', $date);
    $requete->bindParam(':price', $price);
    $requete->bindParam(':placeReserved', $placeReserved);
    $requete->bindParam(':tripId', $tripId);
    $requete->bindParam(':userId', $userId);

    if ($requete->execute()) {
        header('location:../frontend/reservation/reservations.php');
    } else {
        $_SESSION['message'] = 'Error, please try later!';
    }
}

function updateReservation($id)
{
    global $CONNECTIONDB;

    if (!$id || !is_numeric($id)) {
        $errPrice = 'id invalid';
    }

    if (!$_POST['price'] || !is_numeric($_POST['price'])) {
        $errPrice = 'Please enter a valid price';
    }

    if (!$_POST['placeReserved'] || !is_int((int) is_numeric($_POST['placeReserved']))) {
        $errPlaces = 'Please enter a valid number of places';
    }

    if (empty($errPrice) && empty($errPlaces)) {
        $sql = "UPDATE reservation SET price=?, place_reserved=? WHERE id=?";
        $stmt = $CONNECTIONDB->prepare($sql);
        $res = $stmt->execute([$_POST['price'], $_POST['placeReserved'], $id]);

        if ($res) {
            $_SESSION['message'] = 'Success ! reservation updated';
        } else {
            $_SESSION['message'] = 'Error, please try later!';
        }
    } else {
        $_SESSION['message'] = 'Error, please try later!';
    }
    header('location:../frontend/reservation/reservations.php');
}

function deleteReservation($id)
{
    global $CONNECTIONDB;
    $res = $CONNECTIONDB->prepare("DELETE FROM reservation WHERE id = :id");
    $res->bindParam(':id', $id);

    if ($res->execute()) {
        $_SESSION['message'] = 'Success ! reservation deleted';
    } else {
        $_SESSION['message'] = 'Error, please try later!';
    }
    header('location:../frontend/reservation/reservations.php');
}

function getAllReservations()
{
    global $CONNECTIONDB;

    $requete = "SELECT reservation.id, reservation.date, reservation.price, reservation.place_reserved, user.firstname, user.lastname, trip.name FROM reservation JOIN user ON reservation.user_id = user.id JOIN trip ON reservation.trip_id = trip.id";

    $result = $CONNECTIONDB->query($requete);
    return $result;
}

function getReservationById($reservationId)
{
    global $CONNECTIONDB;
    $requete = "SELECT * FROM reservation WHERE id = $reservationId";
    return $CONNECTIONDB->query($requete)->fetch();
}

/**
 * todo
 */
function getReservationUserFullName($userId)
{
    global $CONNECTIONDB;
    $requete = "SELECT user.firstname, user.lastname FROM user WHERE user.user_id = $userId";
    return $CONNECTIONDB->query($requete)->fetchAll();
}

function getReservationTripName($tripId)
{
    global $CONNECTIONDB;
    $requete = "SELECT trip.name FROM trip WHERE trip.id = $tripId";
    return $CONNECTIONDB->query($requete)->fetchAll();
}

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "create":
            createNewReservation();
            break;
        case "delete":
            deleteReservation($_GET['id']);
            break;
        case "update":
            updateReservation($_GET['id']);
            break;
    }
}
