<?php
/**
* SoftPHP 
* @author Joan Muñoz Madero
* @version 0.0.0
*/
require_once __DIR__.'/app/SoftPHP/SoftPHP';
use App\SoftPHP\SoftPHP as SoftPHP;
$app= new SoftPHP();
$app->executeURL();