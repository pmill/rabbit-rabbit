<?php
namespace pmill\RabbitRabbit;

interface RuleInterface
{
    /**
     * @param int $readyMessageCount
     */
    public function run(int $readyMessageCount): void;

    /**
     * @return string
     */
    public function getVHostName(): string;

    /**
     * @return string
     */
    public function getQueueName(): string;
}
