<?php


use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


/*
$routes->group('dashboard', ['filter' => 'auth'], function ($routes) {
    //$routes->get('/', 'DashboardController::index', ['filter' => 'auth']);
    //$routes->get('profile', 'Dashboard::profile', ['filter' => 'auth']);
}, ['filter' => 'auth']);
*/

$routes->get('/lang/{locale}', 'Language::index');
$routes->get('/', function() {
    return redirect()->to('/login');
});
// Set default controller and 404 override
$routes->setDefaultController('DashboardController');
$routes->set404Override('App\Controllers\ErrorController::error_404');
// Authentication routes
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::processLogin');
$routes->get('logout', 'AuthController::logout');

$routes->get('projects', 'ProjectsController::index', ['filter' => 'auth']);
$routes->get('settings', 'SettingsController::index', ['filter' => 'auth']);
$routes->get('settings/editcompany', 'SettingsController::editcompany', ['filter' => 'auth']);
$routes->get('settings/gestionCommercial', 'SettingsController::gestionCommercial', ['filter' => 'auth']);
$routes->get('settings/refvente', 'SettingsController::refvente', ['filter' => 'auth']);
$routes->get('settings/listUser', 'SettingsController::listUser', ['filter' => 'auth']);
$routes->get('settings/compteBancaire', 'SettingsController::compteBancaire', ['filter' => 'auth']);
$routes->get('settings/paiecnss', 'SettingsController::paiecnss', ['filter' => 'auth']);
$routes->get('settings/smtp_settings', 'SettingsController::smtp_settings', ['filter' => 'auth']);
$routes->get('settings/notification', 'SettingsController::notification', ['filter' => 'auth']);
$routes->get('settings/choice_template', 'SettingsController::choice_template', ['filter' => 'auth']);


$routes->post('projects/getProjects', 'ProjectsController::getProjects', ['filter' => 'auth']);
$routes->get('clients', 'ClientsController::index', ['filter' => 'auth']);
$routes->get('ventes', 'ClientsController::index', ['filter' => 'auth']);
$routes->get('expenses', 'ExpensesController::index', ['filter' => 'auth']);
$routes->get('reports', 'ReportsController::index', ['filter' => 'auth']);
$routes->get('clients/view/(:num)', 'ClientsController::view/$1', ['filter' => 'auth']);
$routes->get('ctickets/view/(:num)', 'CTicketsController::view/$1', ['filter' => 'auth']);
$routes->get('projects/view/(:num)', 'ProjectsController::view/$1', ['filter' => 'auth']);
$routes->get('clients/company/create', 'ClientsController::create', ['filter' => 'auth']);
$routes->get('ctickets/create', 'CTicketsController::create', ['filter' => 'auth']);
$routes->get('demandeConge', 'DemandeCongeController::index', ['filter' => 'auth']);
$routes->get('gestionpaie', 'GestionPaieController::index', ['filter' => 'auth']);
$routes->get('gestionpret', 'GestionPretController::index', ['filter' => 'auth']);
$routes->get('gestionprime', 'GestionPrimeController::index', ['filter' => 'auth']);
$routes->post('gestionpaie/gestionpaie/', 'GestionPaieController::index', ['filter' => 'auth']);
$routes->get('clients/ClientPassager', 'ClientsController::ClientPassager', ['filter' => 'auth']);
$routes->get('forgotpass', 'ForgotPassController::index', ['filter' => 'auth']);
// Dashboard route
//$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth'], ['filter' => 'auth']);
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth'], ['filter' => 'auth']);
$routes->get('ctickets', 'CTicketsController::index', ['filter' => 'auth']);
$routes->get('items', 'ItemsController::index', ['filter' => 'auth']);
$routes->get('estimates', 'EstimatesController::index', ['filter' => 'auth']);
$routes->get('avoir', 'AvoirController::index', ['filter' => 'auth']);
$routes->get('gestionsalarie', 'GestionSalarieController::index', ['filter' => 'auth']);
$routes->get('gestionconge', 'GestionCongeController::index', ['filter' => 'auth']);
$routes->get('subscriptions', 'SubscriptionsController::index', ['filter' => 'auth']);
$routes->get('invoices', 'InvoicesController::index', ['filter' => 'auth']);
$routes->post('ctickets/getTicketsToDatatables', 'CTicketsController::getTicketsToDatatables', ['filter' => 'auth']);
// Planification routes
$routes->get('planification', 'SaisietempsController::planification', ['filter' => 'auth']);
$routes->get('planification/(:num)/(:num)/(:num)', 'SaisietempsController::planification/$1/$2/$3', ['filter' => 'auth']);
// Saisie temps updates and deletions
$routes->get('saisietemps', 'SaisietempsController::index', ['filter' => 'auth']);
$routes->post('saisietemps/miseAJourTemps', 'SaisietempsController::miseAJourTemps/1', ['filter' => 'auth']);
$routes->post('planification/miseAJourTemps', 'SaisietempsController::miseAJourTemps/0', ['filter' => 'auth']);
$routes->delete('saisietemps/deleteTempsTicket/(:num)/(:num)/(:num)', 'SaisietempsController::deleteTempsTicket/1/$1/$2/$3', ['filter' => 'auth']);
$routes->delete('planification/deleteTempsTicket/(:num)/(:num)/(:num)/(:num)', 'SaisietempsController::deleteTempsTicket/0/$1/$2/$3/$4', ['filter' => 'auth']);
// Validation routes
$routes->get('validation', 'SaisietempsController::index', ['filter' => 'auth']);
$routes->get('calendar_conges_absences', 'CalendarCongesAbsencesController::index', ['filter' => 'auth']);
$routes->get('calendar_tickets', 'CalendarTicketsController::index', ['filter' => 'auth']);
$routes->get('suivi', 'SuiviController::index', ['filter' => 'auth']);

$routes->get('validation/(:num)/(:num)', 'SaisietempsController::validation/$1/$2', ['filter' => 'auth']);
$routes->post('valider-saisie', 'SaisietempsController::validerSaisie', ['filter' => 'auth']);
// Settings routes for projects and tasks
$routes->get('projects-params', 'SettingsController::indexParamsProjets', ['filter' => 'auth']);
$routes->get('refvente', 'SettingsController::refvente', ['filter' => 'auth']);
$routes->get('projects-params/taches-par-defaut', 'SettingsController::indexTacheParDefaut', ['filter' => 'auth']);
$routes->get('projects-params/taches-par-defaut/view/(:num)', 'SettingsController::indexTacheParDefaut/$1', ['filter' => 'auth']);
$routes->get('estimates/view/(:num)', 'EstimatesController::view/$1', ['filter' => 'auth']);
$routes->get('invoices/view/(:num)', 'InvoicesController::view/$1', ['filter' => 'auth']);
$routes->get('avoir/view/(:num)', 'AvoirController::view/$1', ['filter' => 'auth']);
$routes->get('gestionsalarie/view/(:num)', 'GestionSalarieController::view/$1', ['filter' => 'auth']);
