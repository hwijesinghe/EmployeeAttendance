<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
//$routes->setDefaultController('Home');
$routes->setDefaultController('AuthController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
$routes->get('/', 'AuthController::index');
$routes->get('/register', 'AuthController::register');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/dashboard', 'EmployeeController::index');
$routes->get('/user/dashboard', 'UsersController::dashboard');
$routes->get('/user/report', 'UsersController::report');
$routes->get('/user/past_attendence', 'UsersController::attendence_list');
$routes->match(['get', 'post'], '/user/attendence', 'UsersController::attendence');
$routes->get('/employee/list', 'EmployeeController::listing');
$routes->match(['get', 'post'], '/employee/new_employee', 'EmployeeController::new_employee');
$routes->post('/employee/update_employee', 'EmployeeController::update_employee');
$routes->get('/employee/edit_employee/(:any)', 'EmployeeController::edit_employee/$1');


$routes->group('api', function($routes){
    $routes->group('employee', function($routes){
        $routes->get('emp_attendence', 'UsersController::emp_attendence');
        $routes->get('emp_attendence_by_id/(:any)', 'UsersController::emp_attendence_by_id/$1');
        $routes->get('empAattendenceById/(:any)', 'UsersController::empAattendenceById/$1');
    });
});


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
