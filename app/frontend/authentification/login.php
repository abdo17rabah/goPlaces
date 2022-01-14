<?php
include_once('../constant/header.php');
?>

<form action="../../controllers/authentificationController.php?action=login" method="post">
    <div class="row justify-content-center">
        <div class="col-4">
            <?php
            if (isset($_GET['msg_error'])) {
                echo '<div class="alert alert-danger" role="alert">
            ' . $_GET['msg_error'] . '</div>';
            }
            ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <label for="email">Email :</label>
        </div>
    </div>
    <div class="row justify-content-center mt-1">
        <div class="col-4">
            <input class="form-control" type="email" name="email">
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-4">
            <label for="password">Password :</label>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <input class="form-control" type="password" name="password">
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-auto">
            <button class="btn btn-success">Se connecter</button>
        </div>
    </div>
</form>

<?php
include_once('../constant/footer.php');
?>