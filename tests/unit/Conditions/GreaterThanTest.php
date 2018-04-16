<?php
namespace Tests\Unit\Conditions;

use PHPUnit\Framework\TestCase;
use pmill\RabbitRabbit\Conditions\GreaterThan;

class GreaterThanTest extends TestCase
{
    /**
     * @dataProvider shouldRunData
     */
    public function testShouldRun(int $greaterThan, bool $inclusive, int $value, bool $expectedResult)
    {
        $condition = new GreaterThan($greaterThan, $inclusive);
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
            [5, true, 6, true],
            [5, false, 6, true],
            [5, true, 4, false],
        ];
    }
}
