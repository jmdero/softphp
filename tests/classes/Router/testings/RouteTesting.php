<?php
namespace Tests\Classes\Router\Testings\RouteTesting;
require_once 'app/classes/Router/Routes/Route.php';
use App\Classes\Router\Routes\Route\Route as Route;
class RouteTesting extends Route{
    public function setExecute(string $controller){return parent::setExecute($controller);}
    public function setRoute(string $route){return parent::setRoute($route);}
    public function setValues(){return parent::setValues();}
}