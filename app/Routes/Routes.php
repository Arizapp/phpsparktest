<?php

use App\Libraries\RouteManager;

$pages = require(RouteManager::PATH . 'Pages.php');
$blog = require(RouteManager::PATH . 'Blog.php');
//$imoveis = require(RouteManager::PATH . 'Imoveis.php');

//$sys_routes = [];
//$sys_routes = array_merge($sys_routes, $pages);
//$routes->map($sys_routes);
foreach ($pages as $uri => $route) {
    if (is_array($route)) {
        $routes->add($uri, $route['route'], ['filter' => $route['filter']]);
    } else {
        $routes->add($uri, $route);
    }
}

$routes->add('imovel/(:any)', 'App\\Imoveis::index');
