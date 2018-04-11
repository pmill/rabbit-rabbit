<?php
namespace pmill\RabbitRabbit\Conditions;

class CountBetween implements ConditionInterface
{
    /**
     * @var int
     */
    protected $from;

    /**
     * @var int
     */
    protected $to;

    /**
     * @var bool
     */
    protected $inclusive = false;

    /**
     * CountBetween constructor.
     *
     * @param int $from
     * @param int $to
     * @param bool $inclusive
     */
    public function __construct(int $from, int $to, bool $inclusive = false)
    {
        $this->from = $from;
        $this->to = $to;
        $this->inclusive = $inclusive;
    }

    /**
     * @param int $value
     *
     * @return bool
     */
    public function shouldRun($value)
    {
        if ($this->inclusive && $value >= $this->from && $value <= $this->to) {
            return true;
        }

        if (!$this->inclusive && $value > $this->from && $value < $this->to) {
            return true;
        }

        return false;
    }
}
