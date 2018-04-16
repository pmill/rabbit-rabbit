<?php
namespace pmill\RabbitRabbit\Conditions;

class LessThan implements ConditionInterface
{
    /**
     * @var int
     */
    protected $lessThan;

    /**
     * @var bool
     */
    protected $inclusive = false;

    /**
     * LessThan constructor.
     *
     * @param int $lessThan
     * @param bool $inclusive
     */
    public function __construct(int $lessThan, bool $inclusive = false)
    {
        $this->lessThan = $lessThan;
        $this->inclusive = $inclusive;
    }

    /**
     * @param int $value
     *
     * @return bool
     */
    public function shouldRun($value)
    {
        if ($this->inclusive && $value <= $this->lessThan) {
            return true;
        }

        if (!$this->inclusive && $value < $this->lessThan) {
            return true;
        }

        return false;
    }
}
