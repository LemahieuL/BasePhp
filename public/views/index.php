<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Exo PDO partie 2</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?= PROJECT_LINK ?>/public/assets/css/style.css" />
    </head>
    <body>
        <a class="btn btn-primary" href="<?= $router->getFullUrl('addPatient'); ?>">Crée un(e) patient(e)</a>
        <a class="btn btn-primary" href="<?= $router->getFullUrl('showPatient'); ?>">Voir les patient(e)s</a>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    </body>
</html>
