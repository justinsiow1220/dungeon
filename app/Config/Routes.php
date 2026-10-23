<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('game', 'GameController::index');
$routes->get('game/create', 'GameController::create');
$routes->post('game/start', 'GameController::start');
$routes->get('game/battle', 'GameController::battle');
$routes->post('game/attack', 'GameController::attack');
$routes->post('game/battle/restart', 'GameController::restartBattle');
