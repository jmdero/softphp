<?php
namespace App\Classes\Router\Routes\Route;
require_once 'app\classes\Router\abstracts\AbsRoute.php';
use App\Classes\Router\Abstracts\AbsRoute\AbsRoute as AbsRoute;
use Exception;
class Route extends AbsRoute{
    public string $route;
    public string $execute;
    public array $values;
    public array $values_positions;
    public function __construct(){}
    public function setInputs(array $properties){
        if(!empty($properties)){
            foreach($properties as $name=>$value){
                $method_name='set'.ucfirst($name);
                (method_exists($this,$method_name))?$this->$method_name($value):'';
            }
        }
    }
    protected function setExecute(string $controller){
        if(is_bool(strpos($controller,'::'))){
            throw new Exception('Unvalid format to call the execute method');
        }
        $this->execute=$controller;
        return true;
    }
    protected function setRoute(string $route){
        $this->route=$route;
        //$this->setValues();
    }
    protected function setValues(){
        //if(strpos('{',$this->route)!==false){
        //    var_dump($this->route);
        //}
    }
} 