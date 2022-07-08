<?php
namespace App\Classes\Router\Routes\PrivateRoute;
require_once 'app\classes\Router\Routes\Route.php';
require_once 'app\classes\Router\interfaces\Routes\IntPrivateRoute.php';
use App\Classes\Router\Routes\Route\Route as Route;
use App\Classes\Router\Interfaces\Routes\IntPrivateRoute\IntPrivateRoute as IntRoute;
class PrivateRoute extends Route implements IntRoute{
    private string $type='private';
} 