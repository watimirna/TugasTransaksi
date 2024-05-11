<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/barang', 'Barang::index');
$routes->get('/barang/(:num)', 'Barang::detail/$1');
$routes->post('/barang/insertData', 'Barang::insertData');
$routes->post('/barang/updateData/(:num)', 'Barang::updateData/$1');
$routes->get('/barang/deleteData/(:num)', 'Barang::deleteData/$1');

$routes->get('/customer', 'Customer::index');
$routes->get('/customer/(:num)', 'Customer::detail/$1');
$routes->post('/customer/insertData', 'Customer::insertData');
$routes->post('/customer/updateData/(:num)', 'Customer::updateData/$1');
$routes->get('/customer/deleteData/(:num)', 'Customer::deleteData/$1');

$routes->get('/transaksi', 'Transaksi::index');
$routes->get('transaksi/input', 'TransaksiController::input');
$routes->post('transaksi/save', 'Transaksi::save');

$routes->get('/transaksi_detail', 'TransaksiMaster::detail');
$routes->post('/transaksi_detail/insertData', 'TransaksiMaster::insertDataDetail');
$routes->post('/transaksi_detail/updateData/(:num)', 'TransaksiMaster::updateDataDetail/$1');
$routes->get('/transaksi_detail/deleteData/(:num)', 'TransaksiMaster::deleteDataDetail/$1');

$routes->get('/transaksi_header', 'TransaksiMaster::header');
$routes->post('/transaksi_header/insertData', 'TransaksiMaster::insertDataHeader');
$routes->post('/transaksi_header/updateData/(:num)', 'TransaksiMaster::updateDataHeader/$1');
$routes->get('/transaksi_header/deleteData/(:num)', 'TransaksiMaster::deleteDataHeader/$1');
