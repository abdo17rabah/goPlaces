<?php
session_start();

require_once (__DIR__ .'/../database/Database.php');
require_once (__DIR__ .'/../../environment.php');
$db = new Database($_ENV["SERVER"], $_ENV["DB"], $_ENV["USER"], $_ENV["PASSWORD"]);
$CONNECTIONDB = $db->getConnection();

function createNewTrip() {
  global $CONNECTIONDB;
  if (empty($_POST['name'])) {
    $errName = 'Please enter trip\'s name';
  }

  if (empty($_POST['hidden_cities'])) {
    $errCities = 'Please choose at least one city';
  }

  if (!$_POST['date']) {
    $errDate = 'Please enter a valid date';
  }

  if (!$_POST['price'] || !is_numeric($_POST['price'])) {
    $errPrice = 'Please enter a valid price';
  }

  if (!$_POST['availablePlaces'] || !is_int((int) is_numeric($_POST['availablePlaces']))) {
    $errPlaces = 'Please enter a valid number of places';
  }

  $requete = $CONNECTIONDB->prepare("INSERT INTO trip (name, date, price, place_available) VALUES (:tripName ,:tripDate, :price, :availablePlaces)");
  $requete->bindParam(':tripName', $_POST['name']);
  $requete->bindParam(':tripDate', $_POST['date']);
  $requete->bindParam(':price', $_POST['price']);
  $requete->bindParam(':availablePlaces', $_POST['availablePlaces']);
  if ($requete->execute()){
    // attach cities to trip
    $cities = explode(",", $_POST['hidden_cities']);
    //attach attach cities
    $stm = "SELECT id FROM trip ORDER BY id DESC LIMIT 1;";
    $res = $CONNECTIONDB->query($stm)->fetch();
    attachCitiesToTrip($CONNECTIONDB, $res['id'], $cities);
    $message = 'Success ! Trip added!';
  }else {
    $message = 'Error, please try later!';
  }
  header('location:../frontend/trips/index.php?message='.urlencode($message));
}

function updateTrip() {
  global $CONNECTIONDB;

  if (empty($_POST['name'])) {
    $errName = 'Please enter trip\'s name';
  }

  if (empty($_POST['hidden_cities'])) {
    $errCities = 'Please choose at least one city';
  }

  if (!$_POST['date']) {
    $errDate = 'Please enter a valid date';
  }

  if (!$_POST['price'] || !is_numeric($_POST['price'])) {
    $errPrice = 'Please enter a valid price';
  }

  if (!$_POST['availablePlaces'] || !is_int((int) is_numeric($_POST['availablePlaces']))) {
    $errPlaces = 'Please enter a valid number of places';
  }

  if (empty($errName) && empty($errDate) && empty($errPrice) && empty($errPlaces) && empty($errCities)) {
    $sql = "UPDATE trip SET name=?, date=?, price=?, place_available=? WHERE id=?";
    $stmt= $CONNECTIONDB->prepare($sql);
    $res = $stmt->execute([$_POST['name'], $_POST['date'], $_POST['price'], $_POST['availablePlaces'], $_POST['id']]);

    if ($res){
      $message = 'Success ! Trip updated';
      //update trip cities
      $cities = explode(",", $_POST['hidden_cities']);
      $tripCitiesNames = array_column(getTripCitiesNames($_POST["id"]), 'name');
      $diff = array_diff($cities,$tripCitiesNames);

      // delete form cities
      $req = $CONNECTIONDB->prepare("DELETE FROM `trip_city` TC WHERE TC.trip_id = :id");
      $req->bindParam(':id', $_POST['id']);
      if (!$req->execute()){
        $message = 'Error, please try later!';
        header('location:../frontend/trips/index.php?message='.urlencode($message));
      }

      //attach attach cities
      attachCitiesToTrip($CONNECTIONDB, $_POST['id'], $cities);
    } else {
      $message = 'Error, please try later!';
    }
  } else {
    $message = 'Error, please try later!';
  }
  header('location:../frontend/trips/index.php?message='.urlencode($message));
}

function deleteTrip($id) {
  global $CONNECTIONDB;
  $res = $CONNECTIONDB->prepare("DELETE FROM trip WHERE id = :id");
  $res->bindParam(':id', $id);

  if ($res->execute()){
    $message = 'Success ! Trip deleted';
  } else {
    $message = 'Error, please try later!';
  }
  header('location:../frontend/trips/index.php?message='.urlencode($message));
}

function getAllTrips() {
  global $CONNECTIONDB;
  $requete="SELECT * FROM trip";
  $result = $CONNECTIONDB->query($requete);
  return $result->fetchAll();
}

function getTripById($tripId) {
  global $CONNECTIONDB;
  $requete = "SELECT * FROM trip WHERE id = $tripId";
  return $CONNECTIONDB->query($requete)->fetch();
}

function getTripCitiesNames($tripId) {
  global $CONNECTIONDB;
  $requete = "SELECT city.name FROM city, `trip_city` TC WHERE city.id = TC.city_id AND TC.trip_id = $tripId";
  return $CONNECTIONDB->query($requete)->fetchAll();
}

function attachCitiesToTrip($CONNECTIONDB, $tripId, $cities) {
  $req = "SELECT city.id FROM city WHERE name IN ('".implode("','",$cities)."')";
  $queryRes = $CONNECTIONDB->query($req)->fetchAll();
  $queryRes = array_column($queryRes, 'id');

  // insert rows in pivot table
  foreach ($queryRes as $id) {
    $req = $CONNECTIONDB->prepare("INSERT INTO `trip_city` (trip_id, city_id) VALUES (:trip_id ,:city_id)");
    $req->bindParam(':trip_id', $tripId);
    $req->bindParam(':city_id', $id);
    if (!$req->execute()){
      $message = 'Error, please try later!';
      header('location:../frontend/trips/index.php?message='.urlencode($message));
    }
  }
}

if(isset($_GET['action'])){
  switch($_GET['action']){
    case "create":
      createNewTrip();
      break;
    case "delete":
      deleteTrip($_GET['id']);
      break;
    case "update":
      updateTrip();
      break;
  }
}

