<?php
namespace pmill\RabbitRabbit\Conditions;

class CountEquals implements ConditionInterface
{
    /**
     * @var int
     */
    protected $equals;

    /**
     * CountEquals constructor.
     * @param int $equals
     */
    public function __construct(int $equals)
    {
        $this->equals = $equals;
    }

    /**
     * @param int $value
     *
     * @return bool
     */
    public function shouldRun($value)
    {
        return $this->equals === $value;
    }
}
