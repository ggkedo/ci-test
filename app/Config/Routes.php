<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Requests::List');

$routes->get('/requests', 'Requests::List');
$routes->post('/requests', 'Requests::List');
$routes->get('/requests/new', 'Requests::Create');
$routes->post('/requests/new', 'Requests::Create');
$routes->get('/requests/(:num)', 'Requests::GetRequestById/$1');
$routes->post('/requests/(:num)', 'Requests::GetRequestById/$1');
$routes->get('/requests/edit/(:num)', 'Requests::Edit/$1');
$routes->post('/requests/edit/(:num)', 'Requests::Edit/$1');

$routes->post('/samples/new', 'Samples::Create');
$routes->get('/samples/(:num)', 'Samples::Edit/$1');
$routes->post('/samples/(:num)', 'Samples::Edit/$1');

$routes->post('/measurements/new', 'Measurements::Create');
$routes->get('/measurements/(:num)', 'Measurements::Edit/$1');
$routes->post('/measurements/(:num)', 'Measurements::Edit/$1');

$routes->get('/projects', 'Projects::List');
$routes->post('/projects', 'Projects::List');
$routes->get('/projects/new', 'Projects::Create');
$routes->post('/projects/new', 'Projects::Create');
$routes->get('/projects/(:num)', 'Projects::Edit/$1');
$routes->post('/projects/(:num)', 'Projects::Edit/$1');