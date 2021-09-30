<?php

$routes->get('/', 'App\Home::index');
$routes->get('assine-agora/(:any)', 'App\Subscribe::index/$1');
$routes->get('area-de-cobertura/bairros/(:num)', 'App\AreaDeCobertura::bairros/$1');

$routes->post('contato/enviar', 'App\Contato::enviar');


$routes->get('comprar', 'App\Imoveis::comprar');
$routes->get('alugar', 'App\Imoveis::alugar');
$routes->get('investir', 'App\Imoveis::investir');
$routes->get('imoveis/busca', 'App\Imoveis::busca');

$routes->post('api/bairros', 'App\Api\Bairros::index');