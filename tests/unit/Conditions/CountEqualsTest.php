<?php
namespace Tests\Unit\Conditions;

use PHPUnit\Framework\TestCase;
use pmill\RabbitRabbit\Conditions\CountEquals;

class CountEqualsTest extends TestCase
{
    /**
     * @dataProvider shouldRunData
     */
    public function testShouldRun(int $equals, int $value, bool $expectedResult)
    {
        $condition = new CountEquals($equals);
        $result = $condition->shouldRun($value);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @return array
     */
    public function shouldRunData()
    {
        return [
            [0, 0, true],
            [5000, 5000, true],
            [100, '100', true],
            [100, 101, false],
        ];
    }
}
