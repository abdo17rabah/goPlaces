<?php
    include_once('../constant/header.php');
?>

<form action="../../controllers/authentificationController.php?action=registration" method="post">
    <label for="firstname">Firstname : </label>
    <input type="text" name="firstName">

    <label for="lastname">Lastname : </label>
    <input type="text" name="lastName">

    <label for="email">Email : </label>
    <input type="email" name="email">

    <label for="password">Password : </label>
    <input type="password" name="password">

    <button>S'inscrire</button>
</form>

<?php 
    include_once('../constant/footer.php');
?>