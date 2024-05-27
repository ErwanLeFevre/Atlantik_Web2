<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('accueil', 'Visiteur::accueil');

$routes->get('voirsecteursliaisons/(:alphanum)', 'Visiteur::voirSecteursLiaisons/$1');
$routes->get('voirsecteursliaisons', 'Visiteur::voirSecteursLiaisons');
$routes->match(['get', 'post'], 'horairestraversees', 'Visiteur::voirHorairesTraversees');



$routes->match(['get', 'post'], 'connexion', 'Visiteur::seConnecter');
$routes->get('deconnexion', 'Client::seDeconnecter', ["filter"=> "filtreclient"]);

$routes->match(['get', 'post'], 'inscription', 'Visiteur::inscription');