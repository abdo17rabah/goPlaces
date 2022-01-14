<?php
include_once('../constant/header.php');
?>


<form action="../../controllers/authentificationController.php?action=registration" method="post">
    <div class="row justify-content-center mt-2">
        <div class="col-2">
            <label for="firstname">Firstname : </label>
        </div>
        <div class="col-auto">
            <input type="text" name="firstName">
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-2">
            <label for="lastname">Lastname : </label>
        </div>
        <div class="col-auto">
            <input type="text" name="lastName">
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-2">
            <label for="email">Email : </label>
        </div>
        <div class="col-auto">
            <input type="email" name="email">
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-2">
            <label for="password">Password : </label>
        </div>
        <div class="col-auto">
            <input type="password" name="password">
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-auto">
            <button class="btn btn-primary">S'inscrire</button>
        </div>
    </div>
</form>

<?php
include_once('../constant/footer.php');
?>