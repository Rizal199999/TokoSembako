<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/base', 'Home::test');
$routes->get('/products/add', 'ProductsController::add');
$routes->post('/products/save', 'ProductsController::save');
$routes->get('/products/search_query', 'ProductsController::search_ajax');
$routes->get('/products', 'ProductsController::index');
$routes->post('/products/update/(:num)', 'ProductsController::update/$1'); // Rute untuk update produk