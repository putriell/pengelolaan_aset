<?php

namespace Config;

use App\Controllers\DetailAset;
use CodeIgniter\Router\RouteCollection;
$routes = Services::routes();

/**
 * @var RouteCollection $routes
 */

$routes->group('', ['filter' => 'guest'], function($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('/home/search', 'Home::search');
    $routes->get('/login', 'Login::index');
    $routes->get('/home/login', 'Login::index');
    $routes->post('login/auth', 'Login::auth');
});
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/dashboard', 'Dashboard::index');
    $routes->get('/data_aset', 'DataAset::index');
    $routes->get('/user', 'User::index');
    $routes->get('logout', 'Login::logout');
    $routes->post('/user/ganti_password', 'User::ganti_password');
    $routes->post('/data_aset/simpan', 'DataAset::simpan');
    $routes->get('/data_aset/hapus/(:num)', 'DataAset::hapus/$1');
    $routes->get('/data_aset/edit/(:num)', 'DataAset::edit/$1');
    $routes->post('/data_aset/update', 'DataAset::update');
    $routes->get('/data_aset/search', 'DataAset::search');
    $routes->post('/user/simpan', 'User::simpan');
    $routes->get('/user/hapus/(:num)', 'User::hapus/$1');
    $routes->get('/user/edit/(:num)', 'User::edit/$1');
    $routes->post('/user/update', 'User::update'); 
    $routes->get('/user/search', 'User::search');
    $routes->get('/user/reset_password/(:num)', 'User::reset_password/$1');
    $routes->get('/detail_aset/(:any)', 'DataAset::getDetail/$1');


    $routes->setAutoRoute(true); 
});





