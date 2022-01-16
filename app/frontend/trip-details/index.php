<?php
session_start();
if (count($_SESSION) >= 1) {
  foreach ($_SESSION as $key => $value) {
    $nameSession = $key;
    $session = unserialize($value);
  }
} else {
  $session = null;
}

$PageTitle = "Trip details";

include_once('../../frontend/constant/header.php');
require_once(__DIR__ .'/../../controllers/tripController.php');
require_once(__DIR__ .'/../../controllers/cityController.php');

$trip = getTripById(htmlspecialchars($_GET["id"]));
$tripCitiesNames = array_column(getTripCitiesNames(htmlspecialchars($_GET["id"])), 'name');
$cities = array_column(getAllCitiesNames(), 'name');
?>
<div id="trip-details">
  <section class="next-trip">
    <div class="content">
      <p class="subtitle">Easy and Fast!</p>
      <h2 class="title">Book your Next Trip in 3 Easy Steps</h2>
      <div class="steps">
        <div class="step">
          <div class="icon"><img src="../../assets/nextsteps1.png" alt="" /></div>
          <div class="text">
            <h3 class="title">Choose Destination</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Quos, dolor!
            </p>
          </div>
        </div>
        <div class="step">
          <div class="icon"><img src="../../assets/nextsteps2.png" alt="" /></div>
          <div class="text">
            <h3 class="title">Make Payment</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Quos, dolor!
            </p>
          </div>
        </div>
        <div class="step">
          <div class="icon"><img src="../../assets/nextsteps3.png" alt="" /></div>
          <div class="text">
            <h3 class="title">Reach Airport on Selected Date</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Quos, dolor!
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="image">
      <img src="../../assets/traveller1.png" alt="" />
    </div>
  </section>
  <section class="next-trip">
    <div class="trip">
      <img src="../../assets/next trip.jpg" alt="" />
      <h3 class="title"><?= $trip['name']; ?></h3>
      <p class="subTitle"> Date | <?= date('d-m-Y', strtotime($trip['date'])); ?></p>
      <?php
      if(count($tripCitiesNames) > 0) {
        ?>
        <div class="icons">
          <div class="icon">
            <i class="fas fa-map"></i>
          </div>
          <p class="subTitle"> <?= implode(" | ", array_map('strtoupper', $tripCitiesNames)) ?></p>
        </div>
        <?php
      }
      ?>
      <div class="like">
        <div class="count">
          <i class="fas fa-skiing-nordic"></i>
          <span><?= $trip['place_available']; ?> places left</span>
        </div>
      </div>
      <?php
      if ($session) {
      ?>
        <div class="icons">
          <div class="icon" onclick="window.location='../reservation/fromAddReservation.php?id=<?= $trip['id']; ?>;'">
            <i class="fas fa-shopping-basket"></i>
          </div>
          <?php

          if ($session->getRole() == 'ADMIN') {
          ?>
          <div class="icon" onclick="switchVisible('trip-details', 'updateFormDiv');">
            <i class="fas fa-edit"></i>
          </div>
          <div class="icon" onclick="window.location='/controllers/tripController?action=delete&id='+<?= $trip['id']; ?>;">
            <i class="fas fa-trash-alt"></i>
          </div>
          <?php
          }
          ?>
        </div>
        <?php
      }
      ?>
    </div>
  </section>
</div>

<div class="container py-5" id="updateFormDiv" style="display: none;">
  <div class="col-lg-7 mx-auto">
    <div class="bg-white rounded-lg shadow-sm p-5">
      <div class="tab-content">
        <div id="nav-tab-card" class="tab-pane fade show active">
          <?php
          if(isset($_GET['message'])){
          ?>
            <p class="alert alert-success"><?=$_GET['message']?></p>
            <?php
          }
          ?>
          <form role="form" method="post" action="../../controllers/tripController.php?action=update">
            <input type="hidden" id="id" name="id" value="<?= $trip['id']; ?>">
            <div class="form-group">
              <label for="name">Trip's name</label>
              <input type="text" name="name" placeholder="Name" value="<?= $trip['name']; ?>" required class="form-control">
              <?php echo "<p class='text-danger'>$errName</p>";?>
            </div>
            <div class="form-group">
              <label for="date">Trip's date</label>
              <input type="datetime-local" name="date" value="<?= Date('Y-m-d\TH:i',strtotime($trip['date'])); ?>" min="<?php echo Date('Y-m-d\TH:i',time()) ?>" placeholder="Date" required class="form-control">
              <?php echo "<p class='text-danger'>$errDate</p>";?>
            </div>
            <div class="form-group">
              <label for="cities">Visited cities:</label>
              <select name="cities" id="cities" class="selectpicker" multiple data-live-search="true">
                <?php foreach($cities as $city){ ?>
                  <option value="<?php echo $city; ?>"><?php echo strtoupper($city); ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="price">Trip's price</label>
              <input type="text" name="price" placeholder="price" value="<?= $trip['price']; ?>" required class="form-control">
              <?php echo "<p class='text-danger'>$errPrice</p>";?>
            </div>
            <div class="form-group">
              <label for="availablePlaces">Trip's available places</label>
              <input type="text" name="availablePlaces" value="<?= $trip['place_available']; ?>" placeholder="Available places" required class="form-control">
              <?php echo "<p class='text-danger'>$errPlaces</p>";?>
            </div>
            <input type="hidden" name="hidden_cities" id="hidden_cities" />
            <button name="submit" type="submit" class="btn btn-primary btn-block rounded-pill shadow-sm my-3"> Confirm </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  <?php
  $js_array = json_encode($tripCitiesNames);
  echo "cities = ". $js_array . ";\n";
  ?>
  $('.selectpicker').selectpicker('val', cities);
  $('#cities').change(function(){
    $('#hidden_cities').val($('#cities').val());
  });
</script>
<?php
include_once('../../frontend/constant/footer.php');
?>
