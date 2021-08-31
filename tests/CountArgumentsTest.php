<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($array, $expected)
    {
        $this->assertEquals($expected, $this->functions->countArguments(...$array));
    }

    public function positiveDataProvider(): array
    {
        return [
            [
                [],
                [
                    'argument_count' => 0,
                    'argument_values' => []
                ]
            ],
            [
                ['test'],
                [
                    'argument_count' => 1,
                    'argument_values' => [
                        0 => 'test'
                    ]
                ]
            ],
            [
                ['test', 'test2', 'test3'],
                [
                    'argument_count' => 3,
                    'argument_values' => [
                        0 => 'test', 1 => 'test2', 2 => 'test3'
                    ]
                ]
            ]
        ];
    }
}
