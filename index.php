<?php
/**
* SoftPHP 
* @author Joan Muñoz Madero
* @version 0.0.0
*/
include 'app\functions\checkers';
require_once 'app\classes\Session\Session';
require_once 'app\classes\Router\Router';
use App\Classes\Session\Session as Session;
use App\Classes\Router\Router\Router as Router;
$session= new Session();
$router= new Router();
$router->startURL();