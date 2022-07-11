<?php
namespace App\Classes\Router\Abstracts\AbsRoute;
require_once 'app\functions\TextEdit.php';
abstract class AbsRoute{
    abstract public function setInputs(array $properties);
    abstract protected function setExecute(string $controller);
    abstract protected function setRoute(string $route);
    abstract protected function setDataFromRoute();
}