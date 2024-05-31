<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('accueil', 'Visiteur::accueil');
$routes->match(['get', 'post'], 'inscription', 'Visiteur::inscription');


$routes->get('voirsecteursliaisons/(:alphanum)', 'Visiteur::voirSecteursLiaisons/$1');
$routes->get('voirsecteursliaisons', 'Visiteur::voirSecteursLiaisons');
$routes->match(['get', 'post'], 'horairestraversees', 'Visiteur::voirHorairesTraversees');


$routes->match(['get', 'post'], 'connexion', 'Visiteur::connexion');
$routes->get('deconnexion', 'Client::deconnexion' );


$routes->match(['get', 'post'], 'modification', 'Client::Modification');



$routes->get('confirmerreservation', 'Client::confirmerReservation' );
$routes->post('reserver/(:alphanum)', 'Client::reserver/$1');
$routes->get('compte-rendu/(:alphanum)', 'Client::compteRendu/$1');
$routes->get('historique', 'Client::historique');
