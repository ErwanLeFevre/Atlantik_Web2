<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('accueil', 'Visiteur::accueil');
//$routes->get('voirlesliaisons', 'Visiteur::voirLesLiaisons');
$routes->get('voirsecteursliaisons/(:alphanum)', 'Visiteur::voirSecteursLiaisons/$1');
$routes->get('voirsecteursliaisons', 'Visiteur::voirSecteursLiaisons');
//$routes->get('voirtarifsliaisons', 'Visiteur::voirTarifsLiaisons');

$routes->get('connexion', 'Visiteur::seConnecter');
$routes->get('deconnexion', 'Client::seDeconnecter', ["filter"=> "filtresuper"]);

$routes->match(['get', 'post'], 'inscription', 'Visiteur::inscription');