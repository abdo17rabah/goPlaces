<?php
session_start();

include(__DIR__ .'/../database/Database.php');
require_once (__DIR__ .'/../../environment.php');
$db = new Database($_ENV["SERVER"], $_ENV["DB"], $_ENV["USER"], $_ENV["PASSWORD"]);
$CONNECTIONDB = $db->getConnection();

function createNewTrip() {
  global $CONNECTIONDB;
  $tripName = $_POST['name'];
  $tripDate = $_POST['tripDate'];
  $price = $_POST['price'];
  $availablePlaces = $_POST['availablePlaces'];

  $requete = $CONNECTIONDB->prepare("INSERT INTO trip (name, date, price, place_available) VALUES (:tripName ,:tripDate, :price, :availablePlaces)");
  $requete->bindParam(':tripName', $tripName);
  $requete->bindParam(':tripDate', $tripDate);
  $requete->bindParam(':price', $price);
  $requete->bindParam(':availablePlaces', $availablePlaces);
  if ($requete->execute()){
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

    // create and attach cities
    foreach($diff as $city){
      $req = $CONNECTIONDB->prepare("INSERT INTO city (name) VALUES (:cityName)");
      $req->bindParam(':cityName', $city);
      if (!$req->execute()){
        $message = 'Error, please try later!';
        header('location:../frontend/trips/index.php?message='.urlencode($message));
      }
    }

    //get cities ids
    $req = "SELECT city.id FROM city WHERE name IN ('".implode("','",$cities)."')";
    $queryRes = $CONNECTIONDB->query($req)->fetchAll();
    $queryRes = array_column($queryRes, 'id');

    // insert rows in pivot table
    foreach ($queryRes as $id) {
      $req = $CONNECTIONDB->prepare("INSERT INTO `trip_city` (trip_id, city_id) VALUES (:trip_id ,:city_id)");
      $req->bindParam(':trip_id', $_POST["id"]);
      $req->bindParam(':city_id', $id);
      if (!$req->execute()){
        $message = 'Error, please try later!';
        header('location:../frontend/trips/index.php?message='.urlencode($message));
      }
    }

    $sql = "UPDATE trip SET name=?, date=?, price=?, place_available=? WHERE id=?";
    $stmt= $CONNECTIONDB->prepare($sql);
    $res = $stmt->execute([$_POST['name'], $_POST['date'], $_POST['price'], $_POST['availablePlaces'], $_POST['id']]);

    if ($res){
      $message = 'Success ! Trip updated';
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
  $requete = "SELECT city.name FROM city, `trip_city` TC WHERE TC.trip_id = $tripId";
  return $CONNECTIONDB->query($requete)->fetchAll();
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

