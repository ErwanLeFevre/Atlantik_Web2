<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('accueil', 'Visiteur::accueil');
//$routes->get('voirlesliaisons', 'Visiteur::voirLesLiaisons');

$routes->get('voirsecteursliaisons', 'Visiteur::voirSecteursLiaisons');

$routes->match(['get', 'post'], 'inscription', 'Visiteur::inscription');