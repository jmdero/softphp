<?php
/**
* SoftPHP 
* @author Joan Muñoz Madero
* @version 0.0.0
*/
$dir=__DIR__;
include $dir.'\app\config\globals';
include $dir.'\app\functions\checkers';
require_once APP_PATH.'\classes\Session\Session';
require_once APP_PATH.'\classes\Router\Router';
use App\Classes\Session\Session as Session;
use App\Classes\Router\Router\Router as Router;
$session= new Session();
$router= new Router();
$router->startURL();