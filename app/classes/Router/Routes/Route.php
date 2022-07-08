<?php
namespace App\Classes\Router\Routes\Route;
require_once 'app\classes\Router\abstracts\AbsRoute.php';
use App\Classes\Router\Abstracts\AbsRoute\AbsRoute as AbsRoute;
class Route extends AbsRoute{
    public string $route;
    public string $execute;
    public function __construct(){}
    public function setInputs(array $properties){
        if(!empty($properties)){
            foreach($properties as $name=>$value){
                $method_name='set'.ucfirst($name);
                (method_exists($this,$method_name))?$this->$method_name($value):'';
            }
        }
    }
    protected function setExecute(string $controller){$this->execute=$controller;}
    protected function setRoute(string $route){$this->route=$route;}
} 