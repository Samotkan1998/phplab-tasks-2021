<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
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

        $this->functions->countArgumentsWrapper(...$values);
    }

    public function negativeDataProvider(): array
    {
        return [
            [
                [3, 'test'],
            ],
            [
                [null, false, 10],
            ],
            [
                [true, false, ['1', '2', 3]]
            ]
        ];
    }
}
