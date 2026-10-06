<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'About::index');
$routes->get('/services', 'Services::index');
$routes->match(['get', 'post'], '/contact', 'Contact::index');
$routes->get('/register', 'Register::index');
$routes->post('/register', 'Register::create');
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::authenticate');
$routes->post('/logout', 'Login::logout');
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/account/(:num)', 'Dashboard::account/$1', ['filter' => 'auth']);
$routes->get('/accounts/new', 'Dashboard::newAccount', ['filter' => 'auth']);
$routes->post('/accounts', 'Dashboard::createAccount', ['filter' => 'auth']);
$routes->get('/accounts/(:num)/edit', 'Dashboard::editAccount/$1', ['filter' => 'auth']);
$routes->post('/accounts/(:num)', 'Dashboard::updateAccount/$1', ['filter' => 'auth']);
$routes->post('/accounts/(:num)/delete', 'Dashboard::deleteAccount/$1', ['filter' => 'auth']);
