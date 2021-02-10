<?php
use PHPUnit\Framework\TestCase;

class countArgumentsTest extends TestCase{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, countArguments(...$input));
    }

    public function positiveDataProvider()
    {
        return [
            [[], ['argument_count' => 0, 'argument_values' => [],]],
            [['str1'], ['argument_count' => 1, 'argument_values' => ['str1'],]],
            [['str1', 'str2'], ['argument_count' => 2, 'argument_values' => ['str1','str2'],]],
        ];
    }

}