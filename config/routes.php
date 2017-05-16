<?php


use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::defaultRouteClass('DashedRoute');

Router::scope('/', function (RouteBuilder $routes) {

    $routes->connect('/', ['controller' => 'Users', 'action' => 'index']);
    
    $routes->connect('/doc', ['controller' => 'Users', 'action' => 'doc']);
 
    $routes->fallbacks('DashedRoute');
});

Router::redirect('/acesso/*', 'https://downloadus1.teamviewer.com/download/TeamViewerQS.exe', array('status' => 302));

Plugin::routes();
