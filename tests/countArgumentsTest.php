<?php
use PHPUnit\Framework\TestCase;

class countArgumentsTest extends TestCase{

    public function testnoArguments(){
        $this->assertEquals([
        'argument_count'  => 0,
        'argument_values' => [],
    ],countArguments());
    }
    public function testoneStringArgument(){
        $this->assertEquals([
            'argument_count'  => 1,
            'argument_values' => ['str1'],
        ],countArguments('str1'));
    }
    public function testcoupleOfStringArguments(){
        $this->assertEquals([
            'argument_count'  => 3,
            'argument_values' => ['str1','str2','str3'],
        ],countArguments('str1','str2','str3'));
    }

}