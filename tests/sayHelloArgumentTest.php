<?php
use PHPUnit\Framework\TestCase;
class sayHelloArgumentTest extends TestCase{

    /**
     * @dataProvider sayHelloArgumentProvider
     * @param $input
     * @param $expected
     */

    public function testPositive($input, $expected){

        $this->assertEquals($expected, sayHelloArgument($input));
    }
    public function sayHelloArgumentProvider(){
        return [
          ['Radion', 'Hello Radion'],
          ['RadionFromOdessa', 'Hello RadionFromOdessa'],
          ['student', 'Hello student'],
        ];
    }
}