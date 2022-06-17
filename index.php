<?php
/**
* SoftPHP 
* @author Joan Muñoz Madero
* @version 0.0.0
*/
$dir=__DIR__;
include $dir.'\app\config\globals';
require_once APP_PATH.'\System\SoftPHP';
use App\System\SoftPHP as SoftPHP;
$app= new SoftPHP();
$app->executeURL();