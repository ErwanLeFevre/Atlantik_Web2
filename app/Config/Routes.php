<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('accueil', 'Visiteur::accueil');
//$routes->get('voirlesliaisons', 'Visiteur::voirLesLiaisons');
$routes->get('voirtarifsliaisons/(:alphanum)', 'Visiteur::voirTarifsLiaisons/$1');
$routes->get('voirsecteursliaisons', 'Visiteur::voirSecteursLiaisons');
//$routes->get('voirtarifsliaisons', 'Visiteur::voirTarifsLiaisons');

$routes->match(['get', 'post'], 'inscription', 'Visiteur::inscription');