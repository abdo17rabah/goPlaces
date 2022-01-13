<?php
    $PageTitle = "Gestion des utilisateurs";

    function customPageHeader()
    { ?>
    <?php }
    include_once('../../frontend/constant/header.php');
    include_once("../../controllers/usersController.php");
    $user = getUserById($_GET['id']);
    $test = "###";
    foreach ($user as $userInfos) {
?>

<section>
    <div class="ajout">
        <h1>Modification de l'utilisateur <?= $userInfos['prenom']; ?></h1>
        <form method="POST" action="controller/action.php?action=modifier&id=<?= $userInfos['id']; ?>">
            <div class="mb-3 row">
                <label for="lastName" class="col-sm-2 col-form-label">Nom : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $userInfos['nom']; ?>" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="firstName" class="col-sm-2 col-form-label">Prénom : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $userInfos['prenom']; ?>" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="age" class="col-sm-2 col-form-label">Age : </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="age" name="age" value="<?= $userInfos['age']; ?>" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email : </label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="<?= $userInfos['email']; ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success validation">Enregistrer</button>
        </form>
    </div>
</section>

<?php
    }
    include_once('../../frontend/constant/footer.php');
?>