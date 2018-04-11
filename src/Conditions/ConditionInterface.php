<?php
namespace pmill\RabbitRabbit\Conditions;

interface ConditionInterface
{
    /**
     * @param mixed $value
     *
     * @return bool
     */
    public function shouldRun($value);
}
