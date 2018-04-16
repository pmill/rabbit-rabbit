<?php
namespace Tests\Unit\Conditions;

use PHPUnit\Framework\TestCase;
use pmill\RabbitRabbit\Conditions\CountBetween;

class CountBetweenTest extends TestCase
{
    /**
     * @dataProvider shouldRunData
     */
    public function testShouldRun(int $from, int $to, bool $inclusive, int $value, bool $expectedResult)
    {
        $condition = new CountBetween($from, $to, $inclusive);
        $result = $condition->shouldRun($value);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @return array
     */
    public function shouldRunData()
    {
        return [
            [0, 5000, false, 0, false],
            [0, 5000, false, 5000, false],
            [0, 5000, false, 100, true],
            [0, 5000, true, 0, true],
            [0, 5000, true, 5000, true],
            [0, 5000, true, 6000, false],
            [0, 5000, false, 6000, false],
        ];
    }
}
