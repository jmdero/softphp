<?php
namespace App\Classes\Router\Abstracts\AbsRouter;
abstract class AbsRouter{
    abstract protected function findUriOnRoutes():int|bool;
    abstract protected function getJSONRoutes(object $routes_types=null):object; 
    abstract protected function getRouteAndParameters(string $uri):array;
    abstract public function getRoutes():array; 
    abstract public function getRoutesPath():string; 
    abstract protected function setParametersFromUriString(string $parameters_string=''):array; 
    abstract protected function setRoutes(); 
    abstract protected function setUri(string $uri=''); 
    abstract public function setRoutesPath(string $routes_path); 
    abstract protected function setClassRoutesList(object $routes_types):array; 
    abstract public function executeURL();
}