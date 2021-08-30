<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider negativeDataProvider
     * @expectedException InvalidArgumentException
     */
    public function testNegative($values)
    {
        $this->expectException(InvalidArgumentException::class);

        $this->functions->sayHelloArgumentWrapper($values);
    }

    public function negativeDataProvider(): array
    {
        return [
            [null],
            [
                ['green', 'pink', 'red']
            ],
            [
                ['key' => 'digit']
            ]
        ];
    }
}
