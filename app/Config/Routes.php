<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('game', 'GameController::index');
$routes->get('game/create', 'GameController::create');
$routes->post('game/start', 'GameController::start');
