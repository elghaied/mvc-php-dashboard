<?php
require_once __DIR__ . './../vendor/autoload.php';



$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $routes = include __DIR__ . './../config/routes.php';
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
});


$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);


$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
      
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
     
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
   
        [$controller, $method] = explode('@', $routeInfo[1]);

        $controllerClass = new $controller;
     
        $controllerClass->$method();
        break;
}