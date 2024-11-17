<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/(:num)', 'ProductsController::index/$1');
$routes->get('/base', 'Home::test');