<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('/loginForm', 'AuthController::loginForm');
$routes->post('/auth', 'AuthController::login');
$routes->get('/dashboard', 'UserController::dashboard');
$routes->get('/registroForm', 'AuthController::registroForm');
$routes->post('/registro', 'AuthController::registro');