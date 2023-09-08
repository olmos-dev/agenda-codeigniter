<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/home','InicioController::index');

//lista contactos
$routes->get('/contactos','ContactosController::index');
//edita un contacto
$routes->get('/contactos/editar/(:num)','ContactosController::edit/$1');
//mostrar
$routes->get('/contactos/ver/(:num)','ContactosController::show/$1');
//guarda un contacto
$routes->post('/contactos','ContactosController::store');
//actualiza un contacto
$routes->put('/contactos/(:num)','ContactosController::update/$1');
//elimina un contacto
$routes->delete('/contactos/(:num)','ContactosController::destroy/$1');