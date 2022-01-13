<!doctype html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
  <!-- CSS only -->
  <link rel="stylesheet" href="../../style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
  <title><?= isset($PageTitle) ? $PageTitle : "Go Places"?></title>
  <?php if (function_exists('customPageHeader')){
    customPageHeader();
  }?>
</head>
<body>
  <div class="scrollToTop"><i class="fas fa-chevron-up"></i></div>
  <div class="container">
    <nav>
      <div class="nav-container">
        <div class="brand">Go Places</div>
        <div class="responsive-toggle">
          <i class="fas fa-bars"></i>
        </div>
      </div>
      <div class="links">
        <ul>
          <li><a href="#">Trips</a></li>
          <li><a href="#">Reservations</a></li>
          <li><a href="frontend/users/indexUsers.php">Users</a></li>
          <li><a href="#">My reservations</a></li>
          <?php 
            
            if(isset($_GET['sess'])){
              echo '<li><a href="frontend/users/account.php?sess='.$_GET['sess'].'">My profile</a></li>';
              echo '<li><a href="controllers/authentificationController.php?action=logout&sess='.$_GET['sess'].'">Logout</a></li>';
            } else {
              echo '<li><a href="frontend/authentification/login.php">Login</a></li>';
            }
          ?>
        </ul>
      </div>
    </nav>
