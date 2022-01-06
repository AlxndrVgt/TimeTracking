<?php
/**
 * AVOLUTIONS
 *
 * Just another open source PHP framework.
 *
 * @copyright   Copyright (c) 2019 - 2021 AVOLUTIONS
 * @license     MIT License (https://avolutions.org/license)
 * @link        https://avolutions.org
 */

use Avolutions\Routing\Route;
use Avolutions\Routing\RouteCollection;

$RouteCollection = $Application->get(RouteCollection::class);

/**
 * Register routes
 */
$RouteCollection->addRoute(new Route('/api/customers', [
    'controller' => 'Customer',
    'action' => 'index',
    'method' => 'GET'
]));

$RouteCollection->addRoute(new Route('/api/customers/<id>', [
    'controller' => 'Customer',
    'action' => 'view',
    'method' => 'GET'
]));

$RouteCollection->addRoute(new Route('/api/tasks', [
    'controller' => 'Task',
    'action' => 'index',
    'method' => 'GET'
]));

$RouteCollection->addRoute(new Route('/api/tasks/<id>', [
    'controller' => 'Task',
    'action' => 'view',
    'method' => 'GET'
]));

