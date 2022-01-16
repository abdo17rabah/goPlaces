<?php
$PageTitle = "Gestion des réservations";

function customPageHeader()
{ ?>
<?php }
include_once('../../frontend/constant/header.php');
include_once("../../controllers/reservationController.php");
require_once(__DIR__ .'/../../controllers/tripController.php');
require_once(__DIR__ .'/../../controllers/cityController.php');

$test = "###";

$trip = getTripById(htmlspecialchars($_GET["id"]));
$tripCitiesNames = array_column(getTripCitiesNames(htmlspecialchars($_GET["id"])), 'name');

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
        <div class="count">
          <i class="fas fa-skiing-nordic"></i>
          <span><?= $trip['price']; ?> €</span>
        </div>
      </div>
    </div>
  </section>
</div>

  <section>
    <div class="ajout">
      <h1>Confirmer votre reservation</h1>
      <form method="POST" action="../../controllers/reservationController.php?action=update">
        <input type="hidden" id="id" name="id" value="<?= $trip['id']; ?>">
        <input type="hidden" id="id" name="id" value="<?= $trip['price']; ?>">
        <input type="hidden" id="id" name="id" value="<?= $trip['place_available']; ?>">
        <input type="hidden" id="id" name="id" value="<?= $trip['date']; ?>">
        <div class="mb-3 row">
          <label for="placeReserved" class="col-sm-2 col-form-label">Places reserved : </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="placeReserved" name="placeReserved" value="" required>
          </div>
        </div>

        <button type="submit" class="btn btn-success validation">Enregistrer</button>
      </form>
    </div>
  </section>

<?php
// }

include_once('../../frontend/constant/footer.php');
?>
