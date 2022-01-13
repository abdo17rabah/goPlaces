<!doctype html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title><?= isset($PageTitle) ? $PageTitle : "Go Places" ?></title>
  <?php if (function_exists('customPageHeader')) {
    customPageHeader();
  } ?>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 px-3">
    <a class="navbar-brand" href="#">GoPlaces</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="http://localhost/goPlaces/app/frontend/trips.php">Trips <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Reservations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">My reservations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Profile</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">

    <!-- <nav>
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
          <li><a href="#">Users</a></li>
          <li><a href="#">My reservations</a></li>
          <li><a href="#">Profile</a></li>
        </ul>
      </div>
    </nav> -->