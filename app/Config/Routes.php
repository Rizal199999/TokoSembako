<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Halaman login dan logout
// Halaman login dan logout
/** @get ini untuk menampilkan halaman register */
$routes->get('/register', 'Auth::showRegister');
/**@post ini untuk mengirim data ke sistem dan database  */
$routes->post('/register', 'Auth::processRegister');


$routes->get('/login', 'Auth::loginView');
$routes->post('/login', 'Auth::loginProcess');

$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Auth::dashboard');


// Rute untuk pemilik
    $routes->get('/products', 'ProductsController::index');  // products.php
    $routes->get('/products/add', 'ProductsController::add'); // Tambah produk
    $routes->post('/products/save', 'ProductsController::save'); // Simpan produk
    $routes->post('/products/update/(:segment)', 'ProductsController::update/$1'); // Update produk
    $routes->delete('/products/delete/(:segment)', 'ProductsController::deleteProduct/$1'); // Hapus produk
    $routes->get('/price_management', 'PriceManagementController::index'); // management_price.php
    $routes->post('/selling_price/save', 'PriceManagementController::save'); // Simpan harga jual
    $routes->get('/selling_price', 'PriceManagementController::sellingPrices'); // Daftar harga jual
    $routes->get('/selling_price/search', 'SellingPriceController::search_query'); // Cari harga jual
    $routes->get('/price_management/search', 'PriceManagementController::search_query'); // Cari harga di price management
    $routes->get('/selling_price/delete/(:num)', 'PriceManagementController::returnNull/$1'); // Hapus harga jual
    $routes->get('/products/(:num)', 'ProductsController::pagination/$1'); // Pagination produk
    $routes->get('/products/search_ajax', 'ProductsController::searchAjax');
    $routes->get('/products/getDataById/(:num)', 'ProductsController::getDataById/$1');
    $routes->get('/products/filterByPrice/(:any)/(:any)', 'ProductsController::filterByPrice/$1/$2');
    $routes->get('/products/filterByStock/(:any)', 'ProductsController::filterByStock/$1');
    $routes->get('/sort-comparison/(:any)', 'ProductsController::sortComparison/$1');

// Rute untuk karyawan
    $routes->get('/selling_price', 'PriceManagementController::sellingPrices'); // selling_price.php
    $routes->get('/products/search_query', 'ProductsController::search_ajax'); // Pencarian produk
    $routes->get('/get-data-modals/(:segment)', 'ProductsController::getDataById/$1'); // Data produk untuk modal