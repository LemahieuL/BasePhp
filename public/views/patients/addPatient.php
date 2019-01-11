<?php ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Exercice PDO partie 2 ajout patient</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?= PROJECT_LINK ?>/public/assets/css/style.css" />
    </head>
    <body>
        <div class="container">
            <form method="post" action="<?= $router->getFullUrl('createPatient'); ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputLastName">Nom <?= isset($errors['lastName']) ? $errors['lastName'] : ''; ?></label>
                        <input type="text" class="form-control" name="inputLastName" id="inputFirstName" placeholder="Nom">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputFirstName">Prénom <?= isset($errors['firstName']) ? $errors['firstName'] : ''; ?></label>
                        <input type="text" class="form-control" name="inputFirstName" id="inputLastName" placeholder="Prénom">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputBirthDate">Date de naissance <?= isset($errors['birthDate']) ? $errors['birthDate'] : ''; ?></label>
                        <input type="text" class="form-control" name="inputBirthDate" id="inputBirthDate" >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPhone">Téléphone <?= isset($errors['phone']) ? $errors['phone'] : ''; ?></label>
                        <input type="text" class="form-control" name="inputPhone" id="inputPhone" placeholder="0604540304">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail">Email <?= isset($errors['mail']) ? $errors['mail'] : ''; ?></label>
                    <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Email">
                </div>
                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
            <a class="btn btn-primary" href="<?= $router->getFullUrl('index'); ?>" >Page D'accueil</a>
             
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" ></script>
        <script>
            $(function () {
                $('#inputBirthDate').mask('00/00/0000', {placeholder: '__/__/____'});
                $('#inputPhone').mask('00.00.00.00.00');
            })
        </script>
    </body>
</html>
