<?php

setlocale(LC_TIME, 'fr_FR.utf8');

define('PROJECT_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('PROJECT_SOURCE', '');//permet de definir le nom de dossier à partir du domaine auquel il appartient.
define('PROJECT_LIBS', PROJECT_ROOT . PROJECT_SOURCE); 
define('PROJECT_LINK', 'http://basephp' . PROJECT_SOURCE);


require PROJECT_LIBS . '/vendor/autoload.php';

$router = new \App\Routes\Router('url');

require PROJECT_LIBS . '/init/routes.php';

$router->run();
