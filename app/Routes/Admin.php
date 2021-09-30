<?php

use CodeIgniter\Router\RouteCollection;

$routes->add('admin/login', 'Admin\Login::index');
$routes->add('admin/sair', 'Admin\Login::logout');
$routes->group('admin', ['filter' => 'admin-auth'], function (RouteCollection $routes) {
    $routes->add('/', 'Admin\Home::index');
    /* Páginas */
    $routes->add('paginas', 'Admin\Pages::index');
    $routes->add('paginas/nova', 'Admin\Pages::new');
    $routes->add('pagina/del/(:num)', 'Admin\Pages::delete/$1');
    $routes->add('pagina/(:any)', 'Admin\Pages::edit/$1'); // Sempre por último do grupo de páginas
    /* Config */
    $routes->add('config', 'Admin\Config::index');
    $routes->add('config', 'Admin\Config::index');
    /* Usuários */
    $routes->add('usuarios', 'Admin\Users::index');
    $routes->add('usuarios', 'Admin\Users::index');
    $routes->add('usuarios/add', 'Admin\Users::add');
    $routes->add('usuarios/del/(:num)', 'Admin\Users::del/$1');
    /* Blog */
    $routes->add('blog', 'Admin\Blog::index');
    $routes->add('blog/(:any)', 'Admin\Blog::edit/$1');
    /* Produtos */
    $routes->add('produtos', 'Admin\Products::index');
    $routes->add('produtos/categorias', 'Admin\ProductCategories::index');
    $routes->add('produtos/pedidos', 'Admin\ProductInvoices::index');
    $routes->resource('api/produto/categorias', ['controller' => 'Admin\Api\ProductCategories']);
    $routes->post('api/produtos/(:num)', 'Admin\Api\Products::update/$1');
    $routes->resource('api/produtos', ['controller' => 'Admin\Api\Products']);
    /* Pedidos */
    $routes->add('pedidos', 'Admin\Invoices::index');
    $routes->add('pedidos/print/(:any)', 'Admin\Invoices::print/$1');
    $routes->get('api/pedidos/status/(:num)/(:num)', 'Admin\Api\Invoices::status/$1/$2');
    $routes->get('api/pedidos', 'Admin\Api\Invoices::index');
    /* Clientes */
    $routes->add('clientes', 'Admin\Customer::index');
    $routes->get('api/clientes', 'Admin\Api\Customer::index');
    $routes->get('api/cliente/(:num)/enable', 'Admin\Api\Customer::enable/$1');
    $routes->get('api/cliente/(:num)/disable', 'Admin\Api\Customer::disable/$1');
    /* Imóveis */
    $routes->add('imoveis', 'Admin\Imoveis::index');
    $routes->add('imoveis/novo', 'Admin\Imoveis::create');
    $routes->add('imovel/(:num)', 'Admin\Imoveis::edit/$1');
    $routes->get('api/imoveis', 'Admin\Api\Imoveis::index');
    $routes->post('api/imoveis/gallery/add', 'Admin\Api\Imoveis::galleryAdd');
    $routes->post('api/imoveis/gallery/delete', 'Admin\Api\Imoveis::galleryDelete');
    $routes->post('api/imoveis/gallery/order', 'Admin\Api\Imoveis::galleryOrder');
    /* Bairros */
    $routes->post('api/bairros', 'Admin\Api\Bairros::index');
});
