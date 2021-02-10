<?php
use PHPUnit\Framework\TestCase;

class countArgumentsWrapperTest extends TestCase{
    public function testCountArgumentsExceptionIfNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        countArgumentsWrapper('4', 3);
    }
}