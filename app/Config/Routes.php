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
$routes->post('/products/update/(:segment)', 'ProductsController::update/$1');
$routes->get('/get-data-modals/(:segment)', 'ProductsController::getDataById/$1');
$routes->delete('/products/delete/(:segment)', 'ProductsController::deleteProduct/$1');
$routes->get('/products/(:num)', 'ProductsController::pagination/$1');

