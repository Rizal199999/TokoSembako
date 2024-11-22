<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('index', 'Home::index');
$routes->get('/base', 'Home::test');
$routes->get('products/add', 'ProductsController::add');
$routes->post('products/tambah', 'ProductsController::save');
$routes->get('/products/search_query', 'ProductsController::search_ajax');
$routes->get('/products', 'ProductsController::index');
$routes->get('products/detail/(:num)', 'ProductsController::detail/$1');
$routes->post('/products/update/(:num)', 'ProductsController::update/$1'); // Rute untuk update produk$
$routes->get('/products/delete/(:num)', 'ProductsController::delete/$1');
$routes->get('products/(:num)', 'Products::indexWithPagination/$1');