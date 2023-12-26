<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Route to display the login form
$routes->get('admin/login', 'AuthController::showLogin');
$routes->post('admin/login', 'AuthController::login');
$routes->get('admin/logout', 'AuthController::logout');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('students', 'AdminController::getStudents');
    $routes->get('file/upload', 'AdminController::showUploadForm');
    $routes->post('file/process_excel_upload', 'AdminController::upload');
});

// $routes->get('/', 'HomeController::index');

// $routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
//     $routes->get('/', 'AdminController::index');
//     $routes->get('/login', 'AuthController::showLogin');
//     $routes->post('login', 'AuthController::login');
//     $routes->get('logout', 'AuthController::logout');
// });


