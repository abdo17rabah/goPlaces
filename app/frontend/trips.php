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
    <?php
    include_once('./constant/header.php');
    ?>
    <div class="container">
        <?php

        // // connexion bdd
        $dsn = 'mysql:dbname=goplaces;host=127.0.0.1';
        $user = 'root';
        $password = '';

        $PDO = new PDO($dsn, $user, $password);

        // recuperation des users
        $requete = "SELECT * FROM trip";
        $result = $PDO->query($requete);

        // $infoUser = new DBAccess();
        // $database = $infoUser->dbConnection();
        // $trips = $infoUser->getTrips($database);

        if (!$result) :
        ?>
            <p>No trip created.</p>

            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add new trip
            </button>

            <?php else :
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) :
            ?>
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="https://www.nacel.fr/medias/webp/2/produit/3717/sejour-linguistique-encadre-japon-tokyo.jpg?w=837&h=559&crop=center" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row["name"]; ?></h5>
                        <h6 class="card-text">city 1 - city 2 - city 3</h6>
                        <div class="card-text"><i class="fas fa-calendar-alt"></i> duration (days)</div>
                        <div class="card-text"><i class="fas fa-euro-sign"></i> <?= $row["price"]; ?> €</div>
                        <div class="card-text"><i class="fas fa-user-friends"></i> <?= $row["place_available"]; ?> place(s) left</div>
                        <!-- <a href="http://localhost/goPlaces/app/frontend/tripDetails.php" class="btn btn-primary mt-3">More details</a> -->

                        <a href="../controller/action.php?action=tripDetails&id=<?= $row['id']; ?>" class="btn btn-primary mt-3">More details</a>
                    </div>
                </div>
        <?php
            endwhile;
        endif;
        ?>
    </div>
</body>

</html>