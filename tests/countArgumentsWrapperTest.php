<?php
use PHPUnit\Framework\TestCase;

class countArgumentsWrapperTest extends TestCase{
    public function testcountArgumentsWrapper(){
        $this->expectException(InvalidArgumentException::class);
        countArgumentsWrapper('2','[]','33');
    }
}