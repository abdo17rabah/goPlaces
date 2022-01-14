<?php
session_start();

require_once (__DIR__ .'/../database/Database.php');
require_once (__DIR__ .'/../../environment.php');
$db = new Database($_ENV["SERVER"], $_ENV["DB"], $_ENV["USER"], $_ENV["PASSWORD"]);
$CONNECTIONDB = $db->getConnection();

// functions
function getAllCitiesNames() {
  global $CONNECTIONDB;
  $requete = "SELECT city.name FROM city";
  return $CONNECTIONDB->query($requete)->fetchAll();
}
