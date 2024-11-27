<?php


use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


/*
$routes->group('dashboard', ['filter' => 'auth'], function ($routes) {
    //$routes->get('/', 'DashboardController::index');
    //$routes->get('profile', 'Dashboard::profile');
});
*/

$routes->get('/lang/{locale}', 'Language::index');
$routes->get('/', 'HomeController::index');
// Set default controller and 404 override
$routes->setDefaultController('DashboardController');
$routes->set404Override('App\Controllers\ErrorController::error_404');
// Authentication routes
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::processLogin');
$routes->get('logout', 'AuthController::logout');
$routes->get('projects', 'ProjectsController::index');
$routes->get('settings', 'SettingsController::index');
$routes->get('settings/editcompany', 'SettingsController::editcompany');
$routes->get('settings/gestionCommercial', 'SettingsController::gestionCommercial');
$routes->get('settings/refvente', 'SettingsController::refvente');
$routes->get('settings/listUser', 'SettingsController::listUser');
$routes->get('settings/compteBancaire', 'SettingsController::compteBancaire');
$routes->get('settings/paiecnss', 'SettingsController::paiecnss');
$routes->get('settings/smtp_settings', 'SettingsController::smtp_settings');
$routes->get('settings/notification', 'SettingsController::notification');
//$routes->get('settings/choice_template', 'SettingsController::choice_template');


$routes->post('projects/getProjects', 'ProjectsController::getProjects');
$routes->get('clients', 'ClientsController::index');
$routes->get('ventes', 'ClientsController::index');
$routes->get('expenses', 'ExpensesController::index');
$routes->get('reports', 'ReportsController::index');
$routes->get('clients/view/(:num)', 'ClientsController::view/$1');
$routes->get('ctickets/view/(:num)', 'CTicketsController::view/$1');
$routes->get('projects/view/(:num)', 'ProjectsController::view/$1');
$routes->get('clients/company/create', 'ClientsController::create');
$routes->get('ctickets/create', 'CTicketsController::create');
$routes->get('demandeConge', 'DemandeCongeController::index');
$routes->get('gestionpaie', 'GestionPaieController::index');
$routes->get('gestionpret', 'GestionPretController::index');
$routes->get('gestionprime', 'GestionPrimeController::index');
$routes->post('gestionpaie/gestionpaie/', 'GestionPaieController::index');
$routes->get('clients/ClientPassager', 'ClientsController::ClientPassager');
$routes->get('forgotpass', 'ForgotPassController::index');
// Dashboard route
$routes->get('dashboard', 'DashboardController::index');
$routes->get('ctickets', 'CTicketsController::index');
$routes->get('items', 'ItemsController::index');
$routes->get('estimates', 'EstimatesController::index');
$routes->get('avoir', 'AvoirController::index');
$routes->get('gestionsalarie', 'GestionSalarieController::index');
$routes->get('gestionconge', 'GestionCongeController::index');
$routes->get('subscriptions', 'SubscriptionsController::index');
$routes->get('invoices', 'InvoicesController::index');
$routes->post('ctickets/getTicketsToDatatables', 'CTicketsController::getTicketsToDatatables');
// Planification routes
$routes->get('planification', 'SaisietempsController::planification');
$routes->get('planification/(:num)/(:num)/(:num)', 'SaisietempsController::planification/$1/$2/$3');
// Saisie temps updates and deletions
$routes->get('saisietemps', 'SaisietempsController::index');
$routes->post('saisietemps/miseAJourTemps', 'SaisietempsController::miseAJourTemps/1');
$routes->post('planification/miseAJourTemps', 'SaisietempsController::miseAJourTemps/0');
$routes->delete('saisietemps/deleteTempsTicket/(:num)/(:num)/(:num)', 'SaisietempsController::deleteTempsTicket/1/$1/$2/$3');
$routes->delete('planification/deleteTempsTicket/(:num)/(:num)/(:num)/(:num)', 'SaisietempsController::deleteTempsTicket/0/$1/$2/$3/$4');
// Validation routes
$routes->get('validation', 'SaisietempsController::index');
$routes->get('calendar_conges_absences', 'CalendarCongesAbsencesController::index');
$routes->get('calendar_tickets', 'CalendarTicketsController::index');
$routes->get('suivi', 'SuiviController::index');

$routes->get('validation/(:num)/(:num)', 'SaisietempsController::validation/$1/$2');
$routes->post('valider-saisie', 'SaisietempsController::validerSaisie');
// Settings routes for projects and tasks
$routes->get('projects-params', 'SettingsController::indexParamsProjets');
$routes->get('refvente', 'SettingsController::refvente');
$routes->get('projects-params/taches-par-defaut', 'SettingsController::indexTacheParDefaut');
$routes->get('projects-params/taches-par-defaut/view/(:num)', 'SettingsController::indexTacheParDefaut/$1');
$routes->get('estimates/view/(:num)', 'EstimatesController::view/$1');
$routes->get('invoices/view/(:num)', 'InvoicesController::view/$1');
$routes->get('avoir/view/(:num)', 'AvoirController::view/$1');
$routes->get('gestionsalarie/view/(:num)', 'GestionSalarieController::view/$1');
