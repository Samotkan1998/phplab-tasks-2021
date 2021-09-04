<?php

use PHPUnit\Framework\TestCase;

require_once 'src/web/functions.php';

class GetUniqueFirstLettersTest extends TestCase
{
    protected function setUp(): void
    {
    }

    /**
     * @dataProvider positiveDataProvider
     * @param array $input
     */
    public function testPositive(array $input, $expected)
    {
        $this->assertEquals($expected, getUniqueFirstLetters($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            [
                [
                    ["name" => "Boise Airport"],
                    ["name" => "Baltimore Washington Airport"],
                    ["name" => "Charleston International Airport"],
                    ["name" => "Charlotte Douglas International Airport"],
                ],
                ['B', 'C'],
            ],
            [
                [
                    ["name" => "Dallas Love Field"],
                    ["name" => "Denver International"],
                    ["name" => "Dallas Ft Worth International"],
                    ["name" => "Detroit Metro Airport"],
                ],
                ['D'],
            ]
        ];
    }
}
