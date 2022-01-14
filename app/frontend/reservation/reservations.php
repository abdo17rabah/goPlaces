<?php

$PageTitle = "Gestion des réservations";

include_once('../../frontend/constant/header.php');
include_once("../../controllers/reservationController.php");

?>

<section>
    <h1>Liste des réservations</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Identifiant</th>
                <th scope="col">Date</th>
                <th scope="col">Price</th>
                <th scope="col">Places réservés</th>
                <th scope="col">Circuit id</th>
                <th scope="col">Utilisateur id</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $reservations = getAllReservations();
            if (!$reservations) {
                echo "<p>no reservation</p>";
            } else {
                // while ($reservation = $reservations->fetch(PDO::FETCH_NUM)) {
                foreach ($reservations as $reservation) {
            ?>
                    <tr>
                        <?php
                        foreach ($reservation as $data) {
                        ?>
                            <td><?php echo $data; ?></td>
                        <?php
                        }
                        ?>
                        <td>
                            <a class="btn btn-primary" href="./formEditUser.php?&id=<?= $reservation[0]; ?>" role="button">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a class="btn btn-danger" href="../../controllers/usersController.php?action=deletUserById&id=<?= $reservation[0]; ?>" role="button" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ?'));">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</section>

<?php
include_once('../../frontend/constant/footer.php');
?>