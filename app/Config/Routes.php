<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/requests', 'Requests::List');
$routes->get('/requests/(:num)', 'Requests::GetRequestById/$1');
$routes->get('/requests/new', 'Requests::Create');
//$routes->post('/requests/new', 'Requests::Create');
$routes->post('/requests/edit', 'Requests::Edit');
$routes->get('/requests/edit/(:num)', 'Requests::Edit/$1');

/*
$routes->get('/samples/(:num)', '');
$routes->get('/samples/(:num)/details', '');
$routes->get('/samples/new', '');

$routes->get('/measurements/(:num)', '');
$routes->get('/measurements/new', '');
*/