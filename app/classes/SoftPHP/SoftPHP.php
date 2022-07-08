<?php
namespace App\Classes\SoftPHP;
require_once 'app\classes\SoftPHP\interfaces\App.php';
require_once 'app\classes\Session\abstracts\AbsSession.php';
//require_once APP_PATH.'\classes\Router\Router';
use App\Classes\SoftPHP\Interfaces\App as App;
use App\Classes\Session\Abstracts\AbsSession\AbsSessions as AbsSessions;
//use App\Classes\Router\Router as Router;
/**
 * Main app class.
 * @version 0.0.0
 */
class SoftPHP implements App{
    protected Router $router;
    protected AbsSessions $session;
    public function __construct(Sessions $session){
        $this->session = $session;
        $this->session->start();
    }
    public function executeURL(){
      //  $url=($url==='')?$_SERVER['REQUEST_URI']:$url;
      //  $this->router= new Router();
    }
}