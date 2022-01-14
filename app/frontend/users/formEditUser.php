<?php
    $PageTitle = "Gestion des utilisateurs";

    function customPageHeader()
    { ?>
    <?php }
    include_once('../../frontend/constant/header.php');
    include_once("../../controllers/usersController.php");
    $user = (getUserById($_GET['id']))->fetch();
    $test = "###";
?>

<section>
    <div class="ajout">
        <h1>Modification de l'utilisateur <?= $user['firstname']; ?></h1>
        <form method="POST" action="../../controllers/usersController.php?action=updateUser&id=<?php echo $user['id']; ?>">
            <div class="mb-3 row">
                <label for="lastName" class="col-sm-2 col-form-label">Nom : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $user['lastname']; ?>" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="firstName" class="col-sm-2 col-form-label">Prénom : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $user['firstname']; ?>" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email : </label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Password : </label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" value="<?= $user['password']; ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-success validation">Enregistrer</button>
        </form>
    </div>
</section>

<?php
    include_once('../../frontend/constant/footer.php');
?>