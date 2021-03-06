<!doctype html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- CSS only -->
  <link rel="stylesheet" href="../../style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  <title><?= isset($PageTitle) ? $PageTitle : "Go Places" ?></title>
</head>

<?php
include_once(__DIR__ .'/../../models/user/User.php');
session_start();

if (count($_SESSION) >= 1) {
  foreach ($_SESSION as $key => $value) {
    $nameSession = $key;
    $session = unserialize($value);
  }
} else {
  $session = null;
}
?>

<body>
  <div class="scrollToTop"><i class="fas fa-chevron-up"></i></div>
  <div class="container">
    <nav>
      <div class="nav-container">
        <div class="brand" onclick="window.location='/index.php';">Go Places</div>
        <div class="responsive-toggle">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="links">
        <ul>
          <li><a href="#" onclick="window.location='frontend/trips/index.php';">Trips</a></li>
          <?php

          if ($session && $session->getRole() == 'ADMIN') {
          ?>
            <li><a href="./../reservation/reservations.php?sess=<?php echo $nameSession ?>">All reservations</a></li>
            <li><a href="#" onclick="window.location='../users/indexUsers.php?sess=<?php echo $nameSession ?>';">Users</a></li>
          <?php
          } else if ($session) {
          ?>
            <li><a href="./../users/usersReservations.php?sess=<?php echo $nameSession ?>">My reservations</a></li>
          <?php
          }
          ?>
          <?php
          if (!$session) {
          ?>
            <li><a href="#" onclick="window.location='../authentification/registration.php';">Registration</a></li>
          <?php
          }
          ?>

          <?php

          if ($session) {
          ?>
            <li><a href="../../controllers/authentificationController.php?action=logout&sess=<?php echo $_GET['sess'] ?>">Logout</a></li>
          <?php
          } else {
          ?>
            <li><a href="#" onclick="window.location='../authentification/login.php';">Login</a></li>
          <?php
          }
          ?>
        </ul>
      </div>
    </nav>
