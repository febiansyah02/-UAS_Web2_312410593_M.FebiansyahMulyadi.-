<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->resource('api/buku', ['controller' => 'Buku']);
$routes->post('api/login', 'Auth::login');
$routes->resource('api/peminjaman', ['controller' => 'Peminjaman']); // <-- Tambah baris ini