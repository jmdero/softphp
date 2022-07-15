<?php
class TestController{
    public static function mainPage(){return 'mainPage';}
    public static function privatePage(){return 'private page';}
    public static function publicPage(){return 'public page';}
    public static function valuePage(){return 'value page:'.$_REQUEST['id'];}
    public static function namePage(){return 'name page:'.$_REQUEST['name'];}
    public static function fullPage(){return 'values id:'.$_REQUEST['id'].'/ name:'.$_REQUEST['name'];}
}