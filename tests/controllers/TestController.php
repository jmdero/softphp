<?php
class TestController{
    public static function mainPage(){return 'mainPage';}
    public static function privatePage(){return 'private page';}
    public static function publicPage(){return 'public page';}
    public static function valuePage(){return 'value page:'.$_REQUEST['value'];}
}