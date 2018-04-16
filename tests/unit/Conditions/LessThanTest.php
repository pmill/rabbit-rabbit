<?php
namespace Tests\Unit\Conditions;

use PHPUnit\Framework\TestCase;
use pmill\RabbitRabbit\Conditions\LessThan;

class LessThanTest extends TestCase
{
    /**
     * @dataProvider shouldRunData
     */
    public function testShouldRun(int $lessThan, bool $inclusive, int $value, bool $expectedResult)
    {
        $condition = new LessThan($lessThan, $inclusive);
        $result = $condition->shouldRun($value);

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @return array
     */
    public function shouldRunData()
    {
        return [
            [5, true, 5, true],
            [5, false, 5, false],
            [5, true, 4, true],
            [5, false, 4, true],
            [5, true, 6, false],
        ];
    }
}
