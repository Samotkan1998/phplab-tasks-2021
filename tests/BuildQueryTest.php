<?php

use PHPUnit\Framework\TestCase;

require_once 'src/web/functions.php';

class BulidQueryTest extends TestCase
{
    protected function setUp(): void
    {
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($page, $firstNameLetter, $state, $sortOption, $expected)
    {
        $this->assertEquals($expected, buildQuery($page, $firstNameLetter, $state, $sortOption));
    }

    public function positiveDataProvider()
    {
        return [
            [
                1, 'A', 'Georgia', 'name',
                'page=1&filter_by_first_letter=A&filter_by_state=Georgia&sort=name',
            ],
            [
                1, 'O', 'California', 'code',
                'page=1&filter_by_first_letter=O&filter_by_state=California&sort=code',
            ],
            [
                1, 'O', 'California', null,
                'page=1&filter_by_first_letter=O&filter_by_state=California',
            ],
            [
                1, null, 'California', null,
                'page=1&filter_by_state=California',
            ],
        ];
    }
}
