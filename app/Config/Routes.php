<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('/home', 'AuthController::index');
$routes->get('/loginForm', 'AuthController::loginForm');
$routes->post('/auth', 'AuthController::login');
$routes->get('/dashboard', 'UserController::dashboard');
$routes->get('/registroForm', 'AuthController::registroForm');
$routes->post('/registro', 'AuthController::registro');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/delete/(:num)', 'UserController::delete/$1');
$routes->post('/update/(:num)', 'UserController::update/$1');
$routes->get('/edit/(:num)', 'UserController::edit/$1');