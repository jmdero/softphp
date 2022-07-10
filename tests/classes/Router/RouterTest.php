<?php
require_once 'tests/classes/Router/testings/RouterTesting.php';
use PHPUnit\Framework\TestCase;
use Tests\Classes\Router\Testings\RouterTesting\RouterTesting as RouterTesting;
class RouterTest extends TestCase {
    private static RouterTesting $router;
    private static function checkFindRoutes(){
        (static::$router->routes_finded===false)?static::$router->setRoutes():'';
    }
    private static function checkRoutesTypes(object $routes_types=null){
        static::$router->routes_types=(is_null(static::$router->routes_types))?static::$router->getJSONRoutes($routes_types):static::$router->routes_types;
    }
    public static function setUpBeforeClass():void{
        $_SERVER['REQUEST_URI']='/';
        static::$router=new RouterTesting;
        static::$router->routes_array=[];
        static::$router->routes_types=null;
        static::$router->setRoutesPath('tests\config\routes.json');
    }
    public function testRoutesPathExists(){
        $routes_path=static::$router->getRoutesPath(); 
        $this->assertFileExists($routes_path);
    }
    public function testsetRoutesPathException(){
        $fail_path='test/url/testing.php';
        $this->expectException(Exception::class);
        static::$router->setRoutesPath($fail_path);
    }
    public function providergetJSONRoutes():array{
        $object_test=new RouterTesting('/');
        return [[null],[$object_test],['empty']];
    }
    /**
     * @dataProvider providergetJSONRoutes
     */
    public function testgetJSONRoutes($input){
        $res=($input==='empty')?static::$router->getJSONRoutes():static::$router->getJSONRoutes($input);
        $this->assertIsObject($res);
    }
    public function providerJSONRouteHasProperties(){
        return [['private'],['public']];
    }
    /**
     * @dataProvider providerJSONRouteHasProperties
     */
    public function testJSONRoutesHasProperties($find_key){
        $this->checkRoutesTypes();
        $this->assertTrue(property_exists(static::$router->routes_types,$find_key));
    }
    public function testsetClassRoutesList(){
        $this->checkRoutesTypes();
        $this->assertIsArray(static::$router->setClassRoutesList(static::$router->routes_types));
    }
    public function testsetRoutesIsNotEmptyArray(){
        $this->checkFindRoutes();
        $routes=static::$router->getRoutes();
        $this->assertIsArray($routes);
        $this->assertTrue((count($routes)>0));
    }
    public function providergetRouteAndParameters(){
        return [
            ['',''],
            ['test/user',['route'=>'test/user','parameters'=>[]]],
            ['test/user?name',['route'=>'test/user','parameters'=>[]]],
            ['test/user?name=',['route'=>'test/user','parameters'=>[]]],
            ['test/user?name=Peter',['route'=>'test/user','parameters'=>['name'=>'Peter']]],
            ['test/user?name=Max&surname=Power',['route'=>'test/user','parameters'=>['name'=>'Max','surname'=>'Power']]]
        ];
    }
    /**
     * @dataProvider providergetRouteAndParameters 
     */
    public function testgetRouteAndParameters($uri,$expected){
       ($uri==='')?$this->expectException(Exception::class):'';
       $res=static::$router->getRouteAndParameters($uri); 
       ($uri!=='')?$this->assertSame($res,$expected):'';
    }
    public function providerexecuteURL(){
        return [
            ['/','TestController::mainPage'],
            ['/test_private','TestController::privatePage'],
            ['/test_public','TestController::publicPage'],
            ['/test/public','TestController::publicPage'],
            ['/test/public/150','TestController::publicPage'],
        ];
    }
    /**
     * @dataProvider providerexecuteURL 
     */
    public function testexecuteURL($uri,$expected){
        static::$router->setUri($uri);
        $this->assertSame(static::$router->executeURL(),$expected);
    }
    public function testexecuteURLException(){
        static::$router->setUri('/error');
        $this->expectException(Exception::class);
        static::$router->executeURL();
    }
}