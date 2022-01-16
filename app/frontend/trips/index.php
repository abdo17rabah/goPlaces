<?php
error_reporting(E_ERROR | E_PARSE);

$PageTitle = "Our trips";

include_once('../../frontend/constant/header.php');
require_once(__DIR__ . '/../../controllers/tripController.php');
require_once(__DIR__ . '/../../controllers/cityController.php');

$trips = getAllTrips();
$cities = array_column(getAllCitiesNames(), 'name');
?>
  <section class="starter">
    <div class="content">
      <p class="subTitle">Best Trips around the world</p>
      <h1 class="title">
        Travel, <span>Discover</span> and enjoy a new and full life
      </h1>
      <div class="description">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam
        molestias, vel aliquid at praesentium quo.
      </div>
    </div>
    <div class="image">
      <img src="assets/traveller1.png" alt="" />
    </div>
  </section>
  <section class="destination" id="div1">
    <p class="subtitle">Discover our</p>
    <h2 class="title">Destinations</h2>
    <?php
    if ($trips) {
      foreach ($trips as $trip) {
        $cityNames = array_column(getTripCitiesNames($trip["id"]), 'name');
    ?>
        <div class="cards">
          <div class="card" style="cursor: pointer;" onclick="window.location='../trip-details/index.php?id='+<?= $trip['id']; ?>;">
            <div class="image">
              <img src="../../assets/destination1.png" alt="" />
            </div>
            <div class="content">
              <h3><?= $trip['name']; ?></h3>
              <h3><?= $trip['price']; ?> €</h3>
            </div>
            <div class="content">
              <div class="time">
                <i class="fas fa-location-arrow"></i>
                <h4><?= date('d-m-Y', strtotime($trip['date'])); ?></h4>
              </div>
              <div class="like">
                <div class="count">
                  <i class="fas fa-skiing-nordic"></i>
                  <span><?= $trip['place_available']; ?> places left</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
    } else {
      ?>
      <p class="subtitle">No Trips are available for the moment</p>
    <?php
    }
    ?>
  </section>
  <?php
  if ($session->getRole() == 'ADMIN') {
  ?>
    <button name="addButton" type="button" class="btn btn-primary btn-block rounded-pill shadow-sm my-3" onclick="switchVisible('div1', 'addFormDiv');"> Add new trip </button>
  <?php
  }
  ?>

<div class="container py-5" id="addFormDiv" style="display: none;">
  <div class="col-lg-7 mx-auto">
    <div class="bg-white rounded-lg shadow-sm p-5">
      <div class="tab-content">
        <div id="nav-tab-card" class="tab-pane fade show active">
          <?php
          if (isset($_GET['message'])) {
          ?>
            <p class="alert alert-success"><?= $_GET['message'] ?></p>
          <?php
          }
          ?>
          <form role="form" method="post" action="../../controllers/tripController.php?action=create">
            <input type="hidden" id="id" name="id">
            <div class="form-group">
              <label for="name">Trip's name</label>
              <input type="text" name="name" placeholder="Name" required class="form-control">
              <?php echo "<p class='text-danger'>$errName</p>"; ?>
            </div>
            <div class="form-group">
              <label for="date">Trip's date</label>
              <input type="datetime-local" name="date" min="<?php echo Date('Y-m-d\TH:i', time()) ?>" placeholder="Date" required class="form-control">
              <?php echo "<p class='text-danger'>$errDate</p>"; ?>
            </div>
            <div class="form-group">
              <label for="cities">Visited cities:</label>
              <select name="cities" id="allCities" class="selectpicker" multiple data-live-search="true">
                <?php foreach ($cities as $city) { ?>
                  <option value="<?php echo $city; ?>"><?php echo strtoupper($city); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="price">Trip's price</label>
              <input type="text" name="price" placeholder="price" required class="form-control">
              <?php echo "<p class='text-danger'>$errPrice</p>"; ?>
            </div>
            <div class="form-group">
              <label for="availablePlaces">Trip's available places</label>
              <input type="text" name="availablePlaces" placeholder="Available places" required class="form-control">
              <?php echo "<p class='text-danger'>$errPlaces</p>"; ?>
            </div>
            <input type="hidden" name="hidden_cities" id="hidden_cities2" />
            <button name="submit" type="submit" class="btn btn-primary btn-block rounded-pill shadow-sm my-3"> Add </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $('#allCities').change(function() {
    $('#hidden_cities2').val($('#allCities').val());
  });
</script>
<?php
include_once('../../frontend/constant/footer.php');
?>
