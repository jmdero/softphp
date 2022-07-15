<?php
namespace App\Classes\Router\Router;
require_once 'app\classes\Router\abstracts\AbsRouter.php';
require_once 'app\classes\Router\Routes\PrivateRoute.php';
require_once 'app\classes\Router\Routes\PublicRoute.php';
use App\Classes\Router\Abstracts\AbsRouter\AbsRouter as AbsRouter;
use App\Classes\Router\Routes\PrivateRoute\PrivateRoute as PrivateRoute;
use App\Classes\Router\Routes\PublicRoute\PublicRoute as PublicRoute;
use Exception;
/**
 * It manage and control the app routes.
 * @version 0.0.0
 */
class Router extends AbsRouter{
    public bool  $routes_finded=false;
    private array $routes_objects;
    protected string $routes_path;
    private string $uri;
    public function __construct(string $uri=''){
       $this->setUri($uri);
       $this->setRoutesPath('app\config\routes.json');
    }
    protected function findUriOnRoutes():int|bool{
      $position=false;
      $explode_uri=explode('/',$this->uri);
      $routes_list=array_column($this->routes_objects,'route');
      foreach($routes_list as $key=>$route){
         $position=($this->uri===$route)?$key:$position;
         $explode_route=explode('/',$route);
         if(is_bool($position) and count($explode_route)===count($explode_uri) and is_int(strpos($route,'{'))){
            $is_same=true;
            foreach($explode_route as $key_route=>$value_route){
               if(is_bool(strpos($value_route,'{')) and $value_route!==$explode_uri[$key_route]){
                  $is_same=false;
                  break;
               }
            }
            $position=($is_same)?$key:$position;
         }
         if(is_int($position)){break;}
      }
      return $position;
    }
    protected function getJSONRoutes(object $routes_types=null):object{
        if(is_null($routes_types)){
            try{
                $routes_types=json_decode(file_get_contents($this->routes_path));
            }
            catch(Exception $e){
                echo $e->getMessage();
            }
        }
        return $routes_types;
    }
    protected function getRouteAndParameters(string $uri):array{
         if($uri===''){throw new Exception('Empty uri passed.');}
         $uri_explode=explode('?',$uri);
         $parameters=(array_key_exists(1,$uri_explode))?$this->setParametersFromUriString($uri_explode[1]):[];
         return array_merge(['route'=>trim($uri_explode[0],'/')],compact('parameters')); 
    }
    public function getRoutes():array{return $this->routes_objects;}
    public function getRoutesPath():string{return $this->routes_path;}
    protected function setClassRoutesList(object $routes_types):array{
       $routes=[]; 
       $private_route_model=new PrivateRoute();
       $public_route_model=new PublicRoute();
       foreach($routes_types as $type=>$routes_list){
          if(!empty(get_object_vars($routes_list))){
             foreach($routes_list as $uri=>$values){
                $new_route=($type==='private')?clone $private_route_model:clone $public_route_model;
                $new_route->setInputs(['route'=>$uri,'type'=>$type,'execute'=>$values->execute]);
                array_push($routes,$new_route);
             }
          }
       }
       return $routes; 
    }
    protected function setParametersFromUriString(string $parameters_string=''):array{
      $parameters=[];
      $parameters_list=explode('&',$parameters_string);
      if(!empty($parameters_list)){
         foreach($parameters_list as $key_value){
            $explode_key_value=explode('=',$key_value);
            if(array_key_exists(1,$explode_key_value) and $explode_key_value[1]!==''){
               $parameters[$explode_key_value[0]]=$explode_key_value[1];
            }
         }
      }
      return $parameters;
    } 
    protected function setRoutes(){
        $routes_types=$this->getJSONRoutes();
        $this->routes_objects=$this->setClassRoutesList($routes_types);
        $this->routes_finded=true;
    }
    public function setRoutesPath(string $routes_path){
       if(!file_exists($routes_path)){throw new Exception("'".$routes_path."' file not found.");}
       $this->routes_path=$routes_path; 
    } 
    protected function setUri(string $uri=''){$this->uri=($uri==='')?$_SERVER['REQUEST_URI']:$uri;}
    public function executeURL(){
      ($this->routes_finded==false)?$this->setRoutes():'';
      $position=$this->findUriOnRoutes();
      if($position===false){throw new Exception('404 Not Found');}
      return $this->routes_objects[$position]->execute;
    }
}