<?php
namespace App\Classes\Router\Routes\PublicRoute;
require_once 'app\classes\Router\Routes\Route.php';
require_once 'app\classes\Router\interfaces\Routes\IntPublicRoute.php';
use App\Classes\Router\Routes\Route\Route as Route;
use App\Classes\Router\Interfaces\Routes\IntPublicRoute\IntPublicRoute as IntRoute;
class PublicRoute extends Route implements IntRoute{
    private string $type='public';
} 