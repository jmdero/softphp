<?php
use PHPUnit\Framework\TestCase;
require_once 'app\functions\TextEdit.php';
class TextEditTest extends TestCase {
    public function providertestcutStringBetween(){
        return [
            ['{','}','test/id',''],
            ['{','}','test/{id}','id'],
            ['{','}','test/{id}/','id'],
            ['{','}','test/{id}/test','id'],
            ['{','','test/{id}/test','id}/test'],
            ['','}','test/{id}/test','test/{id'],
            ['','','test/{id}/test','test/{id}/test']
        ];
    }
    /**
     * @dataProvider providertestcutStringBetween
     */
    public function testcutStringBetween(string $start_character,string $end_character,string $text,string $expected){
        $this->assertSame(cutStringBetween($start_character,$end_character,$text),$expected);
    }
    public function providertestgetListFromCutString(){
        return [
            ['{','}','test/',[]],
            ['{','}','test/{id}',['id']],
            ['{','}','test/{id}/{name}',['id','name']],
            ['{','}','{id}/test/{name}',['id','name']],
            ['{','','test/{id}',[]],
            ['','}','test/{id}',[]],
            ['','','test/{id}',[]],
        ];
    }
    /**
     * @dataProvider providertestgetListFromCutString
     */
    public function testgetListFromCutString(string $start_character,string $end_character,string $text,array $expected){
        $this->assertSame(getListFromCutString($start_character,$end_character,$text),$expected);
    }
}