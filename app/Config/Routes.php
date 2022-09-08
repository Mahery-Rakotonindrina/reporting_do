<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/accueil', 'Accueil::index', ['as' => 'accueil']);
$routes->get('/param/client', 'Parametrage::GetCLient', ['as' => 'liste_client']);
$routes->post('/accueil/liste', 'Accueil::GetListeReporting', ['as' => 'liste_reporting']);
$routes->post('/accueil/visu_param', 'Accueil::VisuParameter', ['as' => 'visu_param']);
$routes->post('/param/projet', 'Parametrage::GetProjet', ['as' => 'liste_projet']);
$routes->post('/param/code', 'Parametrage::getCode', ['as' => 'liste_code']);
$routes->post('/param/add', 'Parametrage::newParam', ['as' => 'add_param']);
$routes->post('/param/param', 'Parametrage::getAllParameter', ['as' => 'get_parameter']);
$routes->post('/param/show', 'Parametrage::showParam', ['as' => 'show_param']);
$routes->post('/param/edit', 'Parametrage::editParam', ['as' => 'edit_param']);
$routes->post('/param/delete', 'Parametrage::deleteParam', ['as' => 'delete_param']);
$routes->post('/param/history', 'Parametrage::getParamHistory', ['as' => 'param_history']);
$routes->post('/interf/saisie', 'Saisie::getInterface', ['as' => 'interface_saisie']);
$routes->post('/interf/InsertUpdate', 'Saisie::InsertOrUpdateSaisie', ['as' => 'insert_update_saisie']);
$routes->post('/interf/ShowSaisie', 'Saisie::showSaisie', ['as' => 'show_saisie']);
$routes->post('/saisie/visu', 'Saisie::getAllSaisie', ['as' => 'visu_saisie']);
$routes->post('/saisie/updateJPlus', 'Saisie::UpdateDataJplus1', ['as' => 'udpate_plus']);

$routes->get('/saisie', 'API::getAllReporting', ['as' => 'api_ressource']);
$routes->get('/parametrage', 'API::getAllParametrage', ['as' => 'api_parametrage_ressource']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
