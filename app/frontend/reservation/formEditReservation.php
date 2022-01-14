<?php
$PageTitle = "Gestion des réservations";

function customPageHeader()
{ ?>
<?php }
include_once('../../frontend/constant/header.php');
include_once("../../controllers/reservationController.php");

$reservation = getReservationById($_GET['id']);
$test = "###";

// foreach ($reservation as $reservationInfos) {

?>

<section>
    <div class="ajout">
        <h1>Modification de la réservation du <?= $reservation['date']; ?></h1>
        <form method="POST" action="../../controllers/reservationController.php?action=update&id=<?= $reservation['id']; ?>">

            <div class="mb-3 row">
                <label for="price" class="col-sm-2 col-form-label">Price : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="price" name="price" value="<?= $reservation['price']; ?>" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="placeReserved" class="col-sm-2 col-form-label">Places reserved : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="placeReserved" name="placeReserved" value="<?= $reservation['place_reserved']; ?>" required>
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