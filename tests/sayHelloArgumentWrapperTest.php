<?php
use PHPUnit\Framework\TestCase;

class sayHelloArgumentWrapperTest extends TestCase
{

    public function testNegative(){
        $this->expectException(InvalidArgumentException::class);
        sayHelloArgumentWrapper([1,2,3]);
    }

}