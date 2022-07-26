<?php
namespace App\Classes\Router\Routes\Route;
require_once './app/classes/Router/abstracts/AbsRoute.php';
use App\Classes\Router\Abstracts\AbsRoute\AbsRoute as AbsRoute;
use Exception;
class Route extends AbsRoute{
    public array $data=[];
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
    protected function setExecute(string $controller){
        if(is_bool(strpos($controller,'::'))){
            throw new Exception('Unvalid format to call the execute method');
        }
        $this->execute=$controller;
        return true;
    }
    protected function setRoute(string $route){
        $this->route=$route;
        $this->setDataFromRoute();
    }
    protected function setDataFromRoute(){
        if(is_int(strpos($this->route,'{'))){
            $data_list=getListFromCutString('{','}',$this->route);
            array_walk($data_list,fn($data_name)=>$this->data[$data_name]=null);
        }
    }
} 
