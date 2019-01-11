<?php

/*Route de Base*/
$router->get('/404', 'Index#NotFound', 'default');//page erreur 404.
$router->get('/', 'Index#getHome', 'index');//page au lancement du site.

/* route GET */
$router->get('/ajout-patient.php', 'Patient#addPatient', 'addPatient');
$router->get('/voir-patient.php', 'Patient#showPatient', 'showPatient');

/* route POST*/
$router->post('/create-patient.php', 'Patient#createPatient', 'createPatient');