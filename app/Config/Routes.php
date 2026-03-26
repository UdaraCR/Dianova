<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('register', 'UserController::register');
$routes->get('login', 'UserController::login');
$routes->post('doRegister', 'UserController::doRegister');
$routes->post('doLogin', 'UserController::doLogin');
$routes->get('logout', 'UserController::logout');

$routes->get('dashboard', 'Dashboard::index');

$routes->get('dashboard/sugar', 'Dashboard::sugar');
$routes->get('dashboard/nutrition', 'Dashboard::nutrition');
$routes->get('dashboard/exercise', 'Dashboard::exercise');
$routes->get('dashboard/medication', 'Dashboard::medication');
$routes->get('dashboard/healthAdvice', 'Dashboard::healthAdvice');

$routes->get('sugar/edit/(:num)', 'Dashboard::edit/$1');
$routes->post('sugar/update/(:num)', 'Dashboard::update/$1');
$routes->post('sugar/store', 'Dashboard::store');
$routes->get('sugar/delete/(:num)', 'Dashboard::delete/$1');

$routes->get('dashboard/nutrition-suggest', 'Dashboard::nutritionSuggest');