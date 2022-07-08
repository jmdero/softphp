<?php
namespace App\Classes\Router\Abstracts\AbsRoute;
abstract class AbsRoute{
    abstract public function setInputs(array $properties);
    abstract protected function setExecute(string $controller);
    abstract protected function setRoute(string $route);
}