<?php
namespace pmill\RabbitRabbit\Conditions;

class GreaterThan implements ConditionInterface
{
    /**
     * @var int
     */
    protected $greaterThan;

    /**
     * @var bool
     */
    protected $inclusive = false;

    /**
     * GreaterThan constructor.
     *
     * @param int $greaterThan
     * @param bool $inclusive
     */
    public function __construct(int $greaterThan, bool $inclusive = false)
    {
        $this->greaterThan = $greaterThan;
        $this->inclusive = $inclusive;
    }

    /**
     * @param int $value
     *
     * @return bool
     */
    public function shouldRun($value)
    {
        if ($this->inclusive && $value >= $this->greaterThan) {
            return true;
        }

        if (!$this->inclusive && $value > $this->greaterThan) {
            return true;
        }

        return false;
    }
}
