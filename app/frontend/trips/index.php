<?php

$PageTitle="Our trips";

include_once('../../frontend/constant/header.php');
require_once(__DIR__ .'/../../controllers/tripController.php');

$trips = getAllTrips();
?>
  <section class="destination">
    <p class="subtitle">Discover our</p>
    <h2 class="title">Destinations</h2>
    <?php
    if ($trips) {
      foreach ($trips as $trip) {
        $cityNames = array_column(getTripCitiesNames($trip["id"]), 'name');
        ?>
        <div class="cards">
          <div class="card" style="cursor: pointer;" onclick="window.location='/frontend/trip-details/index.php?id='+<?= $trip['id']; ?>;">
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
include_once('../../frontend/constant/footer.php');
?>
