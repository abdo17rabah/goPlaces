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
        <div class="card text-center">
            <div class="card-header">
                <h5>trip title</h5>
            </div>
            <div class="card-body">
                <h6 class="card-title">villes</h6>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Book the trip</a>
            </div>
            <div class="card-footer text-muted">
                __ places left.
            </div>
        </div>
    </div>
</body>

</html>