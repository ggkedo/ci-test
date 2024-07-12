<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/requests', 'Home::index');
$routes->get('/requests/(:num)', 'Requests::GetRequestById/$1');
