<?php
namespace Tests\Classes\Router\Testings\RouterTesting;
require_once 'app/classes/Router/Router.php';
use App\Classes\Router\Router\Router as Router;
class RouterTesting extends Router{
    public function getRouteAndParameters(string $uri):array{return parent::getRouteAndParameters($uri);}
    public function getJSONRoutes(object $routes_types=null):object{return parent::getJSONRoutes($routes_types);}
    public function setClassRoutesList(object $routes_types):array{return parent::setClassRoutesList($routes_types);}
    public function setRoutes(){return parent::setRoutes();}
    public function setUri(string $uri=''){return parent::setUri($uri);}
}