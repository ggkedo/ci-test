<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/requests', 'Requests::List');
$routes->get('/requests/(:num)', 'Requests::GetRequestById/$1');
$routes->get('/requests/new', 'Home::index');

/*
$routes->get('/sample/(:num)', '');
$routes->get('/sample/(:num)/details', '');
$routes->get('/sample/new', '');

$routes->get('/measurement/(:num)', '');
$routes->get('/measurement/new', '');
*/