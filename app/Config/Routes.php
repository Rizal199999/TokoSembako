<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ProductsController::index');
$routes->get('/base', 'Home::test');

//Note //: Kalo ingin nambahin statement di sini


//Note //: Kalo ingin nambahin statement di sini


//Noted //: biarkan statement ini dipaling bawah
$routes->get('/(:num)', 'ProductsController::indexWithPagination/$1');
// Noted //: pastikan dibawah dikosongkan!