<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::register_handler');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login_handler');
$routes->get('logout', 'Auth::logout');

$routes->group('/', ['filter' => 'auth'], function($routes) {
    $routes->group('profile', [], function($routes) {
        $routes->get('/', 'Profile::index');
        $routes->post('update/(:num)', 'Profile::update/$1');
    });

    $routes->group('tasks', [], function($routes) {
        $routes->get('/', 'Tasks::index');
        $routes->post('/', 'Tasks::create');
        $routes->put('(:num)', 'Tasks::update/$1');
        $routes->delete('(:num)', 'Tasks::delete/$1');
    });
});

$routes->group('api', ['filter' => 'apifilter', 'namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->get('tasks', 'TaskController::index'); // GET request for fetching tasks
    $routes->post('tasks', 'TaskController::create'); // POST request for creating a task
    $routes->get('tasks/(:num)', 'TaskController::show/$1'); // GET request for a specific task
    $routes->put('tasks/(:num)', 'TaskController::update/$1'); // PUT request for updating a task
    $routes->delete('tasks/(:num)', 'TaskController::delete/$1'); // DELETE request for deleting a task
});