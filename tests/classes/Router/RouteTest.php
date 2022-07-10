<?php
require_once 'tests/classes/Router/testings/RouteTesting.php';
use Tests\Classes\Router\Testings\RouteTesting\RouteTesting as RouteTesting;
use PHPUnit\Framework\TestCase;
class RouteTest extends TestCase{
    private static RouteTesting $route;
    public static function setUpBeforeClass():void{static::$route=new RouteTesting;}
    public function providertestsetExecute(){
        return [
            [0,'TestingController::publicPage'],
            [1,'TestingControllerpublicPage'],
        ];
    }
    /**
     * @dataProvider providertestsetExecute
     */
    public function testsetExecute(int $key,string $execute){
        ($key>0)?$this->expectException(Exception::class):'';
        static::$route->setExecute($execute);
        $this->assertSame($execute,static::$route->execute);
    }
}