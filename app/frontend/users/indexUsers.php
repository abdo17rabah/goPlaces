<?php

$PageTitle = "Gestion des utilisateurs";

include_once('../../frontend/constant/header.php');
include_once("../../controllers/usersController.php");

?>

<section>
    <h1>Liste des utilisateurs</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Identifiant</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $users = getAllUsers();
                if(!$users) {
                    echo "<p>no user</p>";
                } else {
                    while($user = $users->fetch(PDO::FETCH_NUM)) {
                        ?>
                        <tr>
                            <?php
                                foreach($user as $data){
                                    ?>
                                    <td><?php echo $data; ?></td>
                                    <?php
                                }
                            ?>
                            <td>
                                <a class="btn btn-primary" href="./formEditUser.php?&id=<?= $user[0]; ?>" role="button">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a class="btn btn-danger" href="../../controllers/usersController.php?action=deletUserById&id=<?= $user[0]; ?>" role="button" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ?'));">
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
    <button type="button" class="btn btn-primary validation" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ajouter
    </button>
</section>

<!-- Modal for add new user -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajout d'un utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="../../controllers/usersController.php?action=addUser">
                <div class="modal-body">

                    <div class="mb-3 row">
                        <label for="lastName" class="col-sm-2 col-form-label">Nom </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lastName" name="lastName" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="firstName" class="col-sm-2 col-form-label">Prénom </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="firstName" name="firstName" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email </label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success validation">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once('../../frontend/constant/footer.php');
?>