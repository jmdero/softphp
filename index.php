<?php
/**
* SoftPHP 
* @author Joan Muñoz Madero
* @version 0.0.0
*/ 
include './app/config/autoload.php';
require_once 'app\classes\Session\Session.php';
require_once 'app\functions\TextEdit.php';
require_once 'app\classes\Router\Router.php';
use App\Classes\Session\Session as Session;
use App\Classes\Router\Router\Router as Router;
$session= new Session;
$router= new Router;
$url_response=$router->executeURL();
echo $url_response();
