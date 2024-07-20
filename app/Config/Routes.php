<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/requests', 'Requests::List');
$routes->post('/requests', 'Requests::List');
$routes->get('/requests/new', 'Requests::Create');
$routes->post('/requests/new', 'Requests::Create');
$routes->get('/requests/(:num)', 'Requests::GetRequestById/$1');
$routes->post('/requests/(:num)', 'Requests::GetRequestById/$1');
//$routes->post('/requests/edit', 'Requests::Edit');
$routes->get('/requests/edit/(:num)', 'Requests::Edit/$1');


$routes->get('/samples/(:num)', 'Samples::Edit/$1');
$routes->get('/samples/(:num)/details', 'Samples::Edit/$1');
$routes->post('/samples/new', 'Samples::Create');

/*
$routes->get('/measurements/(:num)', '');
$routes->get('/measurements/new', '');
*/